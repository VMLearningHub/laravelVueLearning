<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use TwoFactorAuthenticatable;
    use SoftDeletes;


    protected $table = 'admins';
    protected $guard_name = 'web';

    protected $appends = ['formatted_created_at','formatted_diff_for_humans'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'phone',
        'gauth_id',
        'gauth_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    // protected $appends = [
    //     'profile_photo_url',
    // ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->addHours(5)->addMinutes(30)->format('d/M/Y h:i A');
    }
    public function getFormattedDiffForHumansAttribute()
    {
        $last_online_timestamp = \Carbon\Carbon::parse($this->created_at)->setTimezone('Asia/Kolkata');
        return $last_online_timestamp->diffForHumans([ 'parts' => 2, 'join' => ', ', ], CarbonInterface::DIFF_RELATIVE_AUTO, true);
    }
}
