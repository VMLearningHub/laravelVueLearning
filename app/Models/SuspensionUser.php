<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuspensionUser extends Model
{
    protected $table = 'suspension_records';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $fillable = [
        'user_id',
        'suspended_by',
        'duration',
        'suspended_from',
        'suspended_until',
        'type',
        'moment_id',
        'invitedUserIdsRaw',
        'message',
        'activated_by'
    ];
}
