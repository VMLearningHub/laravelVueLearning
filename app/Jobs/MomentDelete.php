<?php

namespace App\Jobs;

use App\Models\Moment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MomentDelete implements ShouldQueue
{
    use Queueable;
    public $input;
    /**
     * Create a new job instance.
     */
    public function __construct($input)
    {
        $this->onQueue('adminv5');
        $this->input = $input;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $input = $this->input;
        $activityData = Moment::where('id', $input['id'])->first();
        $activityData->deleted_by_user_type = "admin";
        $activityData->moment_verified_status = 'rejected';
        $activityData->deleted_by_userId = $input['authId'];
        $activityData->deletedAt = $input['deletedAt'];

        $activityData->save();
        DB::table('activity_categorymaster')->where('activity_id', $input['id'])->delete();

        $activity = Moment::where('userId', $activityData->userId)->orderBy('id', 'desc')->select('id', 'userId', 'createdAt', 'category')->first();
        // Last_activity_timestamp update deleted by update
        if (!empty($activity)) {
            $usergt = User::where('id', $activityData->userId)->first();
            $usergt->last_activity_timestamp = $activity->createdAt;
            $usergt->total_activities_count = --$usergt->total_activities_count;
            $usergt->save();
        }

        try {
            // revert-streak apii thi arya mongodb ma moment no count -1 karave and timestamp -24 hours karave
            // arya side thi status handle nahi karavela etale my side thi only call karavani handel mahi karavo to koi problem nahi
            $url = env('CURRENTLY_API_END_POINT') .'users/revert-streak?user_id='.$activityData->id.'&activity_id='.$activityData->userId;
            Http::withToken(env('CURRENTLY_APIBEARER_TOKEN'))->post($url);
        } catch (\Throwable $th) {
            Log::info('users-revert-streak-response :'.$th->getMessage());
        }

        try {

            $deleteArrData =  [
                'id' => $activityData->userId,
                'title' => $activity->category.' moment was removed',
                'message' => 'We couldn\'t verify what you are doing clearly from far.',
                'activity_id'=>(int)$activityData->id,
            ];

            $url = env('CURRENTLY_API_END_POINT') .'activities/delete-act-notification';
            $response = Http::withToken(env('CURRENTLY_APIBEARER_TOKEN'))->post($url, $deleteArrData);
            $status = $response->status();
            if ($status != 201) {
                $deleteArrData['response'] = $response;
                Log::error($deleteArrData);
            }

        } catch (\Throwable $th) {
            Log::info('delete-act-notification :'.$th->getMessage());
        }

        try {
            $report = Report::where('activityId', $input['id'])->first();

            if ($report) {
                $report->update([
                    'resolution_status' => 'closed',
                    'action_taken'      => 'content_removed',
                ]);
            }
        } catch (\Throwable $th) { }


    }
}
