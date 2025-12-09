<?php

namespace App\Http\Controllers;

use App\Models\Moment;
use App\Models\Order;
use App\Models\PntfToken;
use App\Models\Report;
use App\Models\SuspensionUser;
use App\Models\User;
use App\Models\UserActionNotes;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Users/index');
    }

    public function userList(Request $request)
    {
        $input = $request->all();
        $status = $input['tabbing']??null;
        $search = $input['search']??null;

        try {


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

            if ($status == 'inside') {
                $users_lists = $users_lists ->where('nominated_by_id', '!=', null)
                ->whereNotIn('status', ['Deactivated', 'deleted'])->where('deletedAt', null);
            }elseif($status == 'outside'){
                $users_lists = $users_lists->where('nominated_by_id', null);
            }elseif($status == 'deactivated'){
                $users_lists = $users_lists->where('status', 'deactivated');
            }elseif($status == 'deleted'){
                $users_lists = $users_lists->where('status', 'deleted');
            }elseif($status == 'highlighted'){
                $users_lists = $users_lists ->where('nominated_by_id', '!=', null)
                ->where('status', '!=', "Deactivated")
                ->where('status', '!=', "deleted")
                ->where('isHighlighted','1')
                ->where('deletedAt', null);
            }elseif($status == 'nominated_by_currently'){
                $users_lists = $users_lists
                ->withTrashed()
                ->where(function ($q) {
                    $q->where('nominated_by_id', 1);
                    $q->OrwhereNull('nominated_by_id');
                });
            }else{
                $users_lists = $users_lists ->where('nominated_by_id', '!=', null)->whereNotIn('status', ['Deactivated', 'deleted'])->where('deletedAt', null);
            }

            $this->applySearch($users_lists, $search );

            $users_lists = $users_lists->paginate(30);
            // echo "<pre>";
            // print_r($users_lists->toArray());
            // exit();
            //  $users_lists = $users_lists->simplePaginate(30);

            $arr = ['status'=>200, 'msg'=>'succes', 'data'=> $users_lists];
        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "data" => null);
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "data" => null);
        }

        return response()->json($arr, $arr['status']);
    }

    protected function applySearch($query, $search){

        return $query->when($search, function($query, $searchTerm){
            $query->where(function ($q) use ($searchTerm)  {
                $q->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
                $q->orWhere('username', 'like', '%' . $searchTerm . '%');
                $q->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $searchTerm . '%');
                $q->orWhere(DB::raw("LOWER(CONCAT(first_name, last_name))"), 'like', '%' . strtolower($searchTerm) . '%');
            });
        });
    }

     public function countUserData() {

        $startDate = $this->startDate?? Carbon::now()->startOfDay()->subHour(5)->subMinutes(30);
        $endDate = $this->endDate?? Carbon::now();

        $userDataCount = DB::table('users')
            ->selectRaw('COUNT(*) as total_user')
            ->selectRaw('SUM(status = "deactivated") as deactivated_user')
            ->selectRaw('SUM(status = "deleted") as deleted_user')
            // ->selectRaw('SUM(status = "inactive") as inactive_user')
            ->selectRaw('SUM(CASE WHEN nominated_by_id = 1 OR nominated_by_id IS NULL THEN 1 ELSE 0 END) AS totalNominatedby')
            ->selectRaw('SUM(nominated_by_id IS NOT NULL AND status != "deactivated" AND deletedAt IS NULL) as active_user')
            ->selectRaw('SUM(nominated_by_id IS NULL AND status = "active") as waiting_user')
            ->selectRaw('SUM(nominated_by_id IS NOT NULL AND status != "deactivated" AND status != "deleted" AND deletedAt IS NULL AND isHighlighted = 1) as highlighted_user')
            // ->selectRaw('SUM(deletedAt IS NOT NULL) as deletedAt_user')

            ->selectRaw('SUM(createdAt BETWEEN ? AND ?) as today_user', [$startDate, $endDate])
            ->selectRaw('SUM(nominated_by_id IS NULL AND createdAt BETWEEN ? AND ?) as todayWaitingUser', [$startDate, $endDate])
            ->selectRaw('SUM(nominated_by_id IS NOT NULL AND status != "deactivated" AND deletedAt IS NULL AND createdAt BETWEEN ? AND ?) as todayActiveUser', [$startDate, $endDate])
            ->selectRaw('SUM(status = "deactivated" AND updatedAt BETWEEN ? AND ?) as todayDeactiveUser', [$startDate, $endDate])
            ->selectRaw('SUM(status = "deleted" AND updatedAt BETWEEN ? AND ?) as todayDeletedUser', [$startDate, $endDate])
            ->selectRaw('SUM(CASE WHEN (nominated_by_id = 1 OR nominated_by_id IS NULL) AND createdAt BETWEEN ? AND ? THEN 1 ELSE 0 END) AS todayNominatedby', [$startDate, $endDate])
            ->first();

            // echo "<pre>";
            // print_r($userDataCount);
            // exit();
            return response()->json($userDataCount);
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


    public function suspendUser(Request $request) {
        $input = $request->all();
        try {
            $data = new SuspensionUser();
            $data->user_id = $input['id'];
            $data->suspended_by = Auth::id();
            $data->duration = 4;
            $data->type =  'other';
            $data->message = $input['message']??'Your account is suspended due to Currently Guideline Violation.';
            $data->save();

            $msg ='Success';
            $arr = ['status' => 200, "msg" => $msg, "data" => $data];

        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        }

        return response()->json($arr);

    }
}
