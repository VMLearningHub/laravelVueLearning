<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PntfToken extends Model
{
    protected $table = 'pntf_tokens';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $fillable = [
        'userId',
        'device_type',
        'device_id',
        'fcm_token'
    ];

}
