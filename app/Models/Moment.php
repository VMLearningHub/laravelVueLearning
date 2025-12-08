<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id')->select('id', 'profile_pic', 'first_name', 'last_name', 'username', 'phone_number','isHighlighted', 'total_activities_count','profile_visibility','nominated_by');
    }

    public function privatebyuser(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'private_by_admin', 'id');
    }

    public function highlightedbyuser(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'highlight_by_admin', 'id');
    }

}
