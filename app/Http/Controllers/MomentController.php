<?php

namespace App\Http\Controllers;

use App\Jobs\MomentDelete;
use App\Models\Moment;
use App\Services\MomentService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


    public function updateModerationScore(Request $request, MomentService $momentService){
        $input = $request->all();
        try {
            $data = Moment::where('id', $input['id'])->firstOrFail();
            // echo "<pre>";
            // print_r($data->toArray());
            // exit();
            if ($data) {

                if (
                    $input['score'] >= 0
                    && $input['score'] <= env('THRESHOLD_HIGHLIGHT', 20)
                ) {

                    if ($data['highlightStatus'] != "highlighted") {
                        $momentService->highlightedMoment($input['id']);
                    }
                } else {
                    if($data['updated_moderation_score'] > env('THRESHOLD_HIGHLIGHT', 20)){
                        $data->highlightStatus = 'not_highlighted';
                    }
                }


                $data->updated_moderation_score = $input['score'];
                $data->moderation_updated_by_id = Auth::Id();
                $data->save();
                $msg = 'success';
                $arr = ['status' => 200, "msg" => $msg, "data" => $input['id'], "updated_moderation_score" => $input['score']];
            }else {
                $msg = 'error';
                $arr = ['status' => 400, "msg" => $msg, "data" => null];
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "data" => null);
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "data" => null);
        }
        return response()->json($arr,$arr['status'] );
    }

    public function deleteMoment($id) {
        try {
            $input['authId'] = Auth::id();
            $input['id'] = $id;
            $input['deletedAt'] = Carbon::now()->format('Y-m-d H:i:s');

            Moment::where('id', $id)->update([
                'deleted_by_user_type' => "admin"
            ]);

            MomentDelete::dispatch($input);

            $msg = 'success';
            $arr = array("status" => 200, "msg" => $msg, "data" => null);
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
