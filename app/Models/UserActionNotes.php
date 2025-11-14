<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserActionNotes extends Model
{
    protected $table = 'user_action_notes_log';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $fillable = [
        'userId',
        'notes',
        'action_taken_by',
        'type',
    ];

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->updatedAt)->addHours(5)->addMinutes(30)->format('M d Y | h:i A');
    }
}
