<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'voucher_id',
        'withdraw_id',
        'product_id',
        'cfrs',
        'coin_amount',
        'last_action_timestamp',
        'category',
        'order_status',
        'comments',
        'razorpay_payour_id',
        'action_taken_by_id',
        'order_uid',
        'penalty_amount',
        'penalty_action_by_id',
        'penalty_amount_date',
        'rule_no',
        'reason_para',
        'payment_status',
        'utr_number',
        'denomination',
        'brandName',
        'brandLogo',
        'withdrawal_multiplier'
    ];
}
