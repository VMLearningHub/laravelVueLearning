<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Moment extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $table = 'activities';

    protected $fillable = [
        'username',
        'hashtags',
        'mentions',
        'caption',
        'media_type',
        'media_back',
        'media_front',
        'category',
        'category_id',
        'visibility',
        'status',
        'like_count',
        'view_count',
        'isLikedByMe',
        'isSavedByMe',
        'report_weightage',
        'userId',
        'cat_dark_theme_image',
        'cat_light_theme_image',
        'createdAt',
        'updatedAt',
        'deletedAt',
        'location',
        'deleted_by_user_type',
        'video_thumbnail',
        'media_back_multiples',
        'private_by_admin',
        'moment_verified_status',
        'deleted_by_userId',
        'reject_or_approve_by',
        'reject_or_approve_date',
        'subcategory_id',
        'subcategory',
        'highlightStatus',
        'moderation_score',
        'updated_moderation_score',
        'raw_moderation_score',
        'moderation_updated_by_id'
    ];

}
