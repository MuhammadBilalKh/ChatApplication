<?php

namespace App\Http\Controllers;

use App\Models\FriendShip;
use App\Models\JobPosting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SiteController extends Controller
{
    public function create_friend_request(Request $request)
    {

        $createRequest = FriendShip::create([
            'receiver_id' => $request->memberID,
            'sender_id' => Auth::user()->user_id,
            'status' => FRIEND_REQUEST_STATUS_PENDING,
        ]);

        if ($createRequest) {
            return response()->json([
                'status' => REQUEST_PROCESSED,
            ]);
        } else {
            return response()->json([
                'status' => REQUEST_GOT_ERROR,
            ]);
        }
    }

    public function list(Request $request)
    {
        $membersQuery = User::where(['status' => ACCOUNT_STATUS_ACTIVE])->newQuery();

        if ($request->filled('members_search')) {
            $membersQuery->where('username', 'LIKE', '%'.$request->members_search.'%');
        }

        $membersQuery->orderByDesc('user_id');
        $members = $membersQuery->paginate(10);

        return view('users.people', [
            'members' => $members,
        ])->render();
    }

    public function games()
    {
        return view('users.games');
    }

    public function jobs_listing(Request $request)
    {
        $jobPostingQuery = JobPosting::query();

        if ($request->filled('search_keywords')) {
            $jobPostingQuery->where('title', 'LIKE', '%'.$request->search_keywords.'%');
        }

        if (!empty($request->filter_job_type) && is_array($request->filter_job_type)) {
            $validJobTypes = array_filter($request->filter_job_type);

            if (!empty($validJobTypes)) {
                $jobPostingQuery->where(function ($query) use ($validJobTypes) {
                    foreach ($validJobTypes as $type) {
                        $query->orWhere('job_type', $type);
                    }
                });
            }
        }

        if ($request->filled('search_location')) {
            $jobPostingQuery->where('location', 'LIKE', '%'.$request->search_location.'%');
        }

        $jobPostingQuery->where(['publishing_status' => PUBLISHING_STATUS_PUBLIC]);
        $jobPostingsList = $jobPostingQuery->orderBy('created_at', 'DESC')->paginate(10);

        return view('users.jobs.listing', [
            'list' => $jobPostingsList,
        ]);
    }

    public function submit_job(Request $request)
    {

        if ($request->isMethod(FORM_METHOD_POST)) {
            $request->validate([
                'job_title' => 'required',
                'job_type' => 'required|integer|in:1,2,3,4,5',
                'description' => 'required',
                'application_email' => 'required',
            ]);

            $postingType = $request->submit_job;

            if ($request->hasFile('company_logo')) {
                $path = $request->file('company_logo')->store('company_logos', 'public');
            } else {
                $path = null;
            }

            $jobPosting = JobPosting::create([
                'submittion_type' => $postingType,
                'title' => $request->job_title,
                'job_type' => $request->job_type,
                'description' => $request->description,
                'application_email' => $request->application_email,
                'company_name' => $request->company_name,
                'company_url' => $request->company_website,
                'tagline' => $request->company_tagline,
                'video' => $request->company_video,
                'twitter_username' => $request->company_twitter,
                'company_logo' => $path,
                'location' => $request->location,
                'is_remotely_available' => $request->remote_position,
                'salary' => $request->salary,
                'posted_by' => Auth::user()->user_id,
                'publishing_status' => $postingType,
                'job_notes' => $request->description,
                'views_count' => 0,
                'publishing_status' => PUBLISHING_STATUS_DRAFT,
            ]);

            if ($jobPosting) {
                if ($postingType == 'Preview') {
                    return redirect()->route('posts.view_job_posting', ['jobID' => Crypt::encrypt($jobPosting->job_posting_id)]);
                } elseif ($postingType == 'Draft') {

                }
            }
        }

        return view('users.jobs.create_jobs');
    }

    public function cancel_friend_request()
    {
        return response()->json([
            'status' => REQUEST_PROCESSED,
            'message' => 'Friend request cancelled successfully',
        ]);
    }

    public function view_job_posting($jobID, Request $request)
    {
        try {
            $decryptedJobID = Crypt::decrypt($jobID);
        } catch (Exception $ex) {
            dd([$ex->getMessage(), $ex->getLine()]);
        }

        $jobData = JobPosting::find($decryptedJobID);

        return view('users.jobs.preview', [
            'data' => $jobData,
        ]);
    }

    public function manage_job_posting()
    {
        $jobPostingsList = JobPosting::where(['posted_by' => Auth::user()->user_id, 'publishing_status' => PUBLISHING_STATUS_DRAFT])->orderBy('created_at', 'DESC')->paginate(10);

        return view('users.jobs.manage_job_posting', [
            'list' => $jobPostingsList,
        ]);
    }
}
