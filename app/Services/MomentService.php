<?php

namespace App\Services;

use App\Models\Moment;
use App\Models\SendNotification;
use App\Models\UserActionNotes;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MomentService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

      public function highlightedMoment($id) {

        try {

            $moment = Moment::where('id', $id)->with('user')->firstOrFail();
            $moment->highlightStatus = 'highlighted';
            $moment->highlight_by_admin = Auth::Id();
            $moment->save();

            $msg = 'Highlighted User successfully';

            $getstatus = SendNotification::where('type', 'highlight_moment')->orderBy('id', 'desc')->first();
            // send pushnotification
            if(!empty($getstatus) && $moment->user->isHighlighted == '0'){
                $userData =  [
                    'type' => 'highlight_moment',
                    'userId' => $moment->userId,
                    'title' => $getstatus->text,
                    'message' => $getstatus->description,
                    'first_name' => $moment->user->first_name,
                    'last_name' => $moment->user->last_name,
                    'profile_pic' => $moment->user->profile_pic,
                    'momentId' => $moment->id,
                ];

                $url = env('CURRENTLY_API_END_POINT') .'activities/send-highlight-notification';
                Http::withToken(env('CURRENTLY_APIBEARER_TOKEN'))->post($url, $userData);
            }

            //store log table
            $data = new UserActionNotes();
            $data->userId = $id ;
            $data->notes = 'highlight';
            $data->action_taken_by = Auth::id();
            $data->type = 'highlighted';
            $data->save();

            $arr = array("status" => 200, "msg" => $msg ,"data" =>null);

        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "data" => null);
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $arr = array("status" => 400, "msg" => $msg, "data" => null);
        }

        return $arr;
    }
}
