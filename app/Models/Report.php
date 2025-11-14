<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $table = 'reports';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $fillable = [
        'activityId',
        'userId',
        'raisedByUsername',
        'resolution_status',
        'type',
        'report_cat_one_id',
        'report_cat_two_id',
        'report_cat_three_id',
        'reported_user',
        'admin_id',
        'assign_id',
        'createdAt',
        'updatedAt',
        'deletedAt',
        'action_taken',
        'notes',
        'closed_action_date',
        'action_taken_by_id',
    ];
}
