<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $appends = ['formatted_created_at','formatted_diff_for_humans'];

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'gender',
        'username',
        'profile_pic',
        'dob',
        'status',
        'bio',
        'total_invite_credits',
        'invite_credits_left',
        'profile_visibility',
        'nominated_by',
        'nominated_by_id',
        'total_activities_count',
        'deletedAt',
        'updatedAt',
        'createdAt',
        'deactivated_by_type',
        'nominee_count',
        'last_activity_timestamp',
        'is_permanent_waiting',
        'last_online_timestamp',
        'belongs_to_tournament',
        'followingCount',
        'followersCount',
        'last_launch_time',
        'link_code',
        'deleted_by_id',
        'cover_image',
        'isHighlighted',

    ];

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->createdAt)->addHours(5)->addMinutes(30)->format('d/M/Y h:i A');
    }
    public function getFormattedDiffForHumansAttribute()
    {
        $last_online_timestamp = \Carbon\Carbon::parse($this->createdAt)->setTimezone('Asia/Kolkata');
        return $last_online_timestamp->diffForHumans([ 'parts' => 2, 'join' => ', ', ], CarbonInterface::DIFF_RELATIVE_AUTO, true);
    }

    public function getBirthYearAttribute()
    {
        if ($this->dob) {
            $dob = \Carbon\Carbon::parse($this->dob);
            $now = Carbon::now();
            $diff = $dob->diff($now);
            return $diff->y . '.' . $diff->m;
        } else {
            $diffYears = 0;
        }
        return $diffYears;
    }


}
