<?php

namespace App\Http\Controllers;

use App\Models\FriendShip;
use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $postings = JobPosting::orderByDesc("created_at")->paginate(10);
        return view('users.jobs.listing', [
            'postings' => $postings,
        ]);
    }

    public function submit_job(Request $request){

        if($request->isMethod(FORM_METHOD_POST)){
            $request->validate([
                'job_title' => "required",
                'job_type' => 'required|integer|in:1,2,3,4,5',
                "description" => "required",
                "application_email" => "required",
            ]);

            $postingType = $request->submit_job;

            if ($request->hasFile('company_logo')) {
                $path = $request->file('company_logo')->store('company_logos', 'public');
            } else {
                $path = null;
            }

            $jobPosting = JobPosting::create([
                'submittion_type' => JOB_SUBMITTION_DRAFT,
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
            ]);
        }

        return view('users.jobs.create_jobs');
    }

    public function cancel_friend_request()
    {
        return response()->json([
            'status' => REQUEST_PROCESSED,
        ]);
    }

    public function view_job_posting(){
        return view('users.jobs.preview');
    }
}
