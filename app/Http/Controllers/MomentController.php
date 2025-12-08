<?php

namespace App\Http\Controllers;

use App\Models\Moment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MomentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Moments/index');
    }

    public function watchList(Request $request)
    {
        $input = $request->all();

        $searchTerm = $input['search']??null;
        $input['tabbing'] = $input['tabbing']??null;

        try {
            $data = Moment::where('status', '!=', 'moderated')->with(['user','privatebyuser:id,name','highlightedbyuser:id,name']);

                if ($input['tabbing'] == 'restore') {
                    $data = $data->onlyTrashed()->whereIn('deleted_by_user_type', ['admin', 'ai_model'])->orderBy('deletedAt', 'desc');
                } elseif ($input['tabbing'] == 'highlighted') {
                    $data = $data->where(function ($query) {
                        $query->whereHas('user', function ($q) {
                            $q->where('isHighlighted', 1);
                        })->whereIn('highlightStatus', ['highlighted', 'default'])
                            ->orWhereHas('user', function ($q) {
                                $q->where('isHighlighted', 0);
                            })->where('highlightStatus', 'highlighted');
                    })->whereNull('deleted_by_user_type')->orderBy('id', 'desc');
                } elseif ($input['tabbing'] == 'private') {
                    $data = $data->whereNull('deleted_by_user_type')
                        ->where("visibility", "friends")->orderBy('id', 'desc');
                } elseif ($input['tabbing'] == 'deletedAi') {
                    $data = $data->onlyTrashed()->orWhereIn('deleted_by_user_type', ['admin', 'ai_model'])->orderBy('deletedAt', 'desc');
                } else {
                    $data = $data->whereNull('deleted_by_user_type')->orderBy('id', 'desc');
                }

                // $pageSize = 500;
                $pageSize = env('PAGINATION_PAR_PAGE');
                $moments_lists = $data->paginate($pageSize);
                // echo "<pre>";
                // print_r($moments_lists->toArray());
                // exit();
                $arr = [
                    'status' => 200,
                    'msg' => 'success',
                    'data' => $moments_lists,
                ];
        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "data" => null);
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "data" => null);
        }
        return response()->json($arr);
    }
}
