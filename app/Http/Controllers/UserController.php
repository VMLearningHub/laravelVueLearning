<?php

namespace App\Http\Controllers;

use App\Models\Moment;
use App\Models\Order;
use App\Models\PntfToken;
use App\Models\Report;
use App\Models\User;
use App\Models\UserActionNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $search = $input['search']??null;

        $users_lists = User::query()->select(
            'users.id',
            'users.profile_pic',
            'users.first_name',
            'users.last_name',
            'users.username',
            'users.phone_number',
            'users.gender',
            'users.dob',
            'users.nominated_by',
            'users.nominated_by_id',
            'users.status',
            'users.last_launch_time',
            'users.createdAt',
            'users.isHighlighted',
            'users.profile_visibility',
            'users.deactivated_by_type',
            'users.deleted_by_id',
            'users.user_level',
        )->orderBy('id','desc');

        $this->applySearch($users_lists, $search );
        $users_lists = $users_lists->selectRaw('(SELECT SUM(user_sessions.difference) FROM user_sessions WHERE user_sessions.userId = users.id) AS totalSeconds')
        ->selectRaw('(SELECT COUNT(*) FROM activities WHERE users.id = activities.userId) AS totle_activite_count')
        ->selectRaw('(SELECT COUNT(*) FROM activities WHERE users.id = activities.userId AND activities.deletedAt IS NOT NULL AND activities.deleted_by_user_type = "admin" ) AS totle_deleted_admin_activite_count')
        ->selectRaw('(SELECT COUNT(*) FROM activities WHERE users.id = activities.userId AND activities.deletedAt IS NOT NULL AND activities.deleted_by_user_type = "user" ) AS totle_deleted_user_activite_count')
        ->selectRaw('(SELECT COUNT(*) FROM users AS laravel_reserved_0 WHERE users.id = laravel_reserved_0.nominated_by_id) AS totle_nominated_by_id_count');

         $users_lists = $users_lists->paginate(30);

        // echo "<pre>";
        // print_r($users_lists->toArray());
        // exit();

        return Inertia::render('Users/index', compact('users_lists', 'search'));
    }

    protected function applySearch($query, $search){
        $searchTerm = str_replace(' ', '%', $search);
        return $query->when($search, function($query, $searchTerm){
            $query->where(function ($q) use ($searchTerm)  {
                $q->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
                $q->orWhere('username', 'like', '%' . $searchTerm . '%');
                $q->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $searchTerm . '%');
                $q->orWhere(DB::raw("LOWER(CONCAT(first_name, last_name))"), 'like', '%' . strtolower($searchTerm) . '%');
            });
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletebyAdmin = Auth::user()->id;
        User::where('id', $id)->update(['status' => 'deactivated', 'deactivated_by_type' => 'admin', 'deleted_by_id'=> $deletebyAdmin]);
        Moment::where('userId', $id)->where('deletedAt', null)->update(['status' => 'deactivated']);
        PntfToken::where('userId', $id)->update(['fcm_token' => null]);
        UserActionNotes::create([
            'userId'=>$id,
            'notes'=>Auth::user()->name.' deactived user.',
            'action_taken_by'=>$deletebyAdmin,
            'type'=>'deactivated'
        ]);
            //report-user
            if (Report::where('reported_user', $id)->exists()) {
                try {
                    Report::where('reported_user', $id)->update(['resolution_status' => 'closed', 'action_taken' => 'account_restricted']);

                } catch (\Throwable $th) { }
            }

            Order::where('user_id', $id)->whereIn('order_status', ['placed', 'requested'])
            ->update(['order_status' => 'rejected']);
            // ->pluck('id')->toArray();
            // if(!empty($orderIdsArray)) {
            //     $adminId = Auth::id();
            //     foreach ($orderIdsArray as $orderid) {
            //         $arrData = [
            //             'adminId'=> $adminId,
            //             'orderid'=>$orderid,
            //             'notes'=>'',
            //         ];
            //         ReconcileAmount::dispatch($arrData);
            //     }
            // }

            return redirect()->route('users.index')->with('message', 'user deactived successfilly');


    }
}
