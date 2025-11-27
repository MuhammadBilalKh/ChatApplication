<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\AdvertMedia;
use App\Models\Category;
use App\Models\FeaturedAdvert;
use App\Models\FeaturedPackage;
use App\Models\FriendShip;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\GroupMeta;
use App\Models\JobPosting;
use App\Models\Message;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

        if (! empty($request->filter_job_type) && is_array($request->filter_job_type)) {
            $validJobTypes = array_filter($request->filter_job_type);

            if (! empty($validJobTypes)) {
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
                'is_remotely_available' => 1,
                'salary' => $request->salary,
                'posted_by' => Auth::user()->user_id,
                'publishing_status' => $postingType,
                'job_notes' => $request->description,
                'views_count' => 0,
                'publishing_status' => PUBLISHING_STATUS_PUBLIC,
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

    public function cancel_friend_request(Request $request)
    {
        FriendShip::where(function ($query) use ($request) {
            $authUserId = Auth::user()->user_id;
            $memberId = $request->member_id;
            $query->where('sender_id', $authUserId)
                ->where('receiver_id', $memberId);
        })->orWhere(function ($query) use ($request) {
            $authUserId = Auth::user()->user_id;
            $memberId = $request->member_id;
            $query->where('sender_id', $memberId)
                ->where('receiver_id', $authUserId);
        })->delete();

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

    public function load_profile_pictures(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 6;

        $getUploadedPosts = Post::where(['user_id' => Auth::user()->user_id])->pluck('post_id')->toArray();

        $getMediaPosts = PostMedia::with('getPost', 'getPost.postUploadedBy')
            ->whereIn('post_id', $getUploadedPosts)
            ->where('media_type', MEDIA_TYPE_IMAGE)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'status' => REQUEST_PROCESSED,
            'images' => $getMediaPosts->items(),
            'pagination' => [
                'current_page' => $getMediaPosts->currentPage(),
                'last_page' => $getMediaPosts->lastPage(),
                'per_page' => $getMediaPosts->perPage(),
                'total' => $getMediaPosts->total(),
                'has_more' => $getMediaPosts->hasMorePages(),
            ],
        ]);
    }

    public function list_friends()
    {
        $userId = Auth::user()->user_id;

        $friends = FriendShip::with(['getSender', 'getReceiver'])
            ->where('status', FRIEND_REQUEST_STATUS_ACCEPTED)
            ->where(function ($q) use ($userId) {
                $q->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->orderByDesc('accepted_at')
            ->get();

        return view('users.profile.friends', [
            'friends' => $friends,
        ])->render();
    }

    public function list_requests()
    {
        $request = FriendShip::with('getSender')->where([
            'receiver_id' => Auth::user()->user_id,
            'status' => FRIEND_REQUEST_STATUS_ACCEPTED,
        ])->get();

        return view('users.profile.requests', [
            'requests' => $request,
        ])->render();
    }

    public function manage_request_response(Request $request)
    {
        $requestType = $request->response;
        $receiverId = Auth::user()->user_id;
        $memberID = $request->memberID;
        $acceptanceType = '';

        if ($requestType == '1') {
            $acceptanceType = 'Accepted';
            FriendShip::where([
                'receiver_id' => $receiverId,
                'sender_id' => $memberID,
            ])->update([
                'status' => FRIEND_REQUEST_STATUS_ACCEPTED,
                'accepted_at' => now(),
            ]);
        } elseif ($requestType == '0') {
            $acceptanceType = 'Rejected';
            FriendShip::where([
                'receiver_id' => $receiverId,
                'sender_id' => $memberID,
            ])->delete();
        }

        return redirect()->back()->with('success', 'Friend Request '.ucwords($acceptanceType).' Successfully.');
    }

    public function manage_categories(Request $request)
    {
        return view('users.category.index');
    }

    public function manage_advertisments(Request $request)
    {
        $activeTab = $request->get('tab', 'all');

        if ($activeTab === 'categories') {
            $categories = Category::withCount('adverts')->get();

            return view('users.advertisment.index', [
                'categories' => $categories,
                'activeTab' => $activeTab,
            ]);
        }

        $advertsQuery = Advert::query();

        if ($request->filled('category')) {
            $advertsQuery->where('category_id', $request->input('category'));
        }

        if ($request->filled('adverts_sort')) {
            [$key, $direction] = explode('-', $request->input('adverts_sort')) + [null, null];
            if (in_array($key, ['price', 'title']) && in_array($direction, ['asc', 'desc'])) {
                $advertsQuery->orderBy($key, $direction);
            }
        }

        if ($activeTab === 'featured') {
            $advertsQuery->orderByDesc('is_featured');
        }

        $adverts = $advertsQuery->paginate(10);

        $categories = [];
        if ($activeTab === 'categories') {
            $categories = Category::withCount('adverts')->get();
        }

        return view('users.advertisment.index', [
            'adverts' => $adverts,
            'categories' => $categories,
            'activeTab' => $activeTab,
        ]);
    }

    public function show_advertisment_content(Request $request)
    {
        $viewType = $request->view_type;
        $view = '';

        if ($viewType == 'list') {
            $featuredAdverts = FeaturedAdvert::with('getAdvertisment')->where('is_featured', 2)->get();
            $view = view('users.advertisment.list', [
                'featuredAdverts' => $featuredAdverts,
            ])->render();
        } elseif ($viewType == 'categories') {
            $categories = Category::all();

            $view = view('users.advertisment.categories.index', [
                'categories' => $categories,
            ]);
        } elseif ($viewType == 'create') {
            $view = view('users.advertisment.submit', [
                'categories' => Category::whereStatus(CATEGORY_STATUS_ACTIVE)->get(),
            ]);
        } elseif ($viewType == 'mark-featured') {
            $pendingFeaturedAds = Advert::with('getAdvertMedia', 'getCategory')->where([
                'approval_status' => ADVERT_STATUS_PENDING,
                'posted_by' => Auth::user()->user_id,
            ])->get();

            $view = view('users.advertisment.mark_featured', [
                'pendingAdverts' => $pendingFeaturedAds,
                'packages' => FeaturedPackage::all(),
            ]);
        } elseif ($viewType == 'pending-for-approval') {

            $pendingApproval = FeaturedAdvert::with('getAdvertisment', 'getAdvertisment.getAdvertMedia')->where([
                'is_featured' => 1,
            ])->orderByDesc('created_at')->get();

            return view('users.advertisment.pending_for_approval', [
                'pendingApproval' => $pendingApproval,
            ]);
        }

        return $view;
    }

    public function store_category(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'title' => 'required|min:3',
        ]);

        Category::create([
            'category_title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Category Added Successfully.');
    }

    public function edit_category(Request $request)
    {
        return view('users.advertisment.categories.edit', [
            'category' => Category::find($request->category_id),
        ]);
    }

    public function update_category(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'title' => 'required|min:5',
        ]);

        Category::where(['category_id' => $id])->update([
            'category_title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Category Updated Successfully.');
    }

    public function save_advert(Request $request)
    {
        $request->validate([
            'adverts_phone' => 'required',
            'advert_category' => 'required|numeric',
            'post_title' => 'required',
            'post_content' => 'required',
            'adverts_price' => 'required',
            'adverts_location' => 'nullable',
            'website_address' => 'nullable',
            'media_input.*' => 'file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:10240',
        ]);

        $createAdvert = Advert::create([
            'advertisment_title' => $request->post_title,
            'approval_status' => Auth::user()->user_type == USER_TYPE_ADMIN ? ADVERT_STATUS_APPROVED : ADVERT_STATUS_PENDING,
            'category_id' => $request->advert_category,
            'description' => $request->post_content,
            'location' => $request->adverts_location,
            'phone_number' => $request->adverts_phone,
            'posted_by' => Auth::user()->user_id,
            'price' => $request->adverts_price,
            'advertisment_code' => Str::uuid(),
            'ip_address' => $request->ip(),
        ]);

        if ($createAdvert && $request->hasFile('media_input')) {
            foreach ($request->file('media_input') as $file) {
                $path = $file->store('adverts', 'public');

                AdvertMedia::create([
                    'advertisment_id' => $createAdvert->advertisment_id,
                    'media_path' => $path,
                    'media_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Advertisment Posted Successfully.');
    }

    public function ViewAdvert($id)
    {
        $advertPackageID = FeaturedAdvert::where([
            'advertisment_id' => $id,
        ])->value('package_id');

        if (! empty($advertPackageID)) {
            $packageData = FeaturedPackage::where(['package_id' => $advertPackageID])->first();
        } else {
            $packageData = [];
        }

        $advertData = Advert::with('getCategory', 'advertPostedBy', 'getAdvertMedia')->findOrFail($id);

        if ($advertData->posted_by != Auth::user()->user_id) {
            abort(403, 'Unauthorized Access');
        } else {
            return view('users.advertisment.view', [
                'advert' => $advertData,
                'packageData' => $packageData,
            ]);
        }
    }

    public function mark_advertisment_for_featured(Request $request)
    {
        $advertismentCode = Advert::whereAdvertismentCode($request->advertisment_id)->value('advertisment_id');

        $alreadyFeatured = FeaturedAdvert::where([
            'advertisment_id' => $advertismentCode,
            'is_featured' => 1,
        ])->exists();

        $alreadyApprovedFeatured = FeaturedAdvert::where([
            'advertisment_id' => $advertismentCode,
            'is_featured' => 2,
        ])->exists();

        if ($alreadyFeatured || $alreadyApprovedFeatured) {
            return redirect()->back()->with('error', 'The Selected Advertisment is Already Pending for Approval Or Approved');
        } else {
            FeaturedAdvert::create([
                'advertisment_id' => $advertismentCode,
                'package_id' => $request->package,
                'is_featured' => Auth::user()->user_type == USER_TYPE_ADMIN ? 2 : 1,
            ]);

            Advert::where([
                'advertisment_code' => $request->advertisment_id,
            ])->update([
                'approval_status' => 2,
            ]);

            return redirect()->back()->with('success', 'Advertisment Have Been Forwarded to Admin For Approval');
        }
    }

    public function manageFeaturedAdvertStatus(Request $request)
    {
        $advertismentID = Advert::where(['advertisment_code' => $request->advertisment_id])->value('advertisment_id');

        $packageID = FeaturedAdvert::where([
            'advertisment_id' => $advertismentID,
            'is_featured' => 1,
        ])->value('package_id');

        Advert::where([
            'advertisment_id' => $advertismentID,
        ])->update([
            'approval_status' => 2,
        ]);

        FeaturedAdvert::where([
            'advertisment_id' => $advertismentID,
            'package_id' => $packageID,
            'is_featured' => 1,
        ])->update([
            'is_featured' => $request->approval_status == 'approve' ? 2 : 3,
        ]);

        return redirect()->back()->with('success', 'Selected Featured Have Been Marked '.ucfirst($request->approval_status).' Successfully.');
    }

    public function manage_friend_request(Request $request)
    {
        $friendShip = new FriendShip;

        if ($request->action == 'send') {

            $friendShip->sender_id = Auth::user()->user_id;
            $friendShip->receiver_id = str_replace('friend-', ' ', $request->receiverID);
            $friendShip->status = FRIEND_REQUEST_STATUS_PENDING;

            $friendShip->save();
        } else {
            $friendShip->where(['sender_id' => Auth::user()->user_id, 'receiver_id' => str_replace('friend-', ' ', $request->receiverID)])->delete();
        }

        return response()->json([
            'status' => REQUEST_PROCESSED,
        ]);
    }

    public function load_messages(Request $request): \Illuminate\Http\JsonResponse
    {
        $userId = Auth::user()->user_id;
        $otherUserId = $request->input('user_id');

        $messages = Message::query()
            ->where(function ($query) use ($userId, $otherUserId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $otherUserId);
            })->orWhere(function ($query) use ($userId, $otherUserId) {
                $query->where('sender_id', $otherUserId)
                    ->where('receiver_id', $userId);
            })
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->reverse()
            ->values()
            ->map(function ($message) {
                return [
                    'message_id' => $message->id,
                    'sender_id' => $message->sender_id,
                    'receiver_id' => $message->receiver_id,
                    'message' => $message->message,
                    'created_at' => $message->created_at,
                ];
            });

        return response()->json([
            'messages' => $messages,
            'status' => 'success',
        ]);
    }

    public function send_message(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'receiver' => 'required|integer|exists:users,user_id',
            'message' => 'required|string|max:1000',
        ], [
            'receiver.required' => 'Receiver is required.',
            'receiver.exists' => 'Receiver must be a valid user.',
            'message.required' => 'Message cannot be empty.',
            'message.max' => 'Message is too long.',
        ]);

        $senderId = Auth::user()->user_id;
        $receiverId = $request->input('receiver');
        $body = $request->input('message');

        try {
            $message = Message::create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'message' => $body,
                'message_type' => 'text',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message.',
                'errMessage' => $e->getMessage(),
            ], 500);
        }

        try {
            Http::post('http://localhost:3002/send', [
                'sender_id' => Auth::id(),
                'receiver_id' => $receiverId,
                'message' => $request->message,
                'created_at' => now()->format('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }

    public function manage_shops()
    {
        return view('users.shops.index');
    }
}
