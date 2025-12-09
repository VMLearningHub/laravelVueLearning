<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendNotification extends Model
{
    protected $table = 'send_push_notification';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $fillable = [
        'id',
        'text',
        'description',
        'type',
    ];
}
