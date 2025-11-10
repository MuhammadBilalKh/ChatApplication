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
            dd($request);
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
