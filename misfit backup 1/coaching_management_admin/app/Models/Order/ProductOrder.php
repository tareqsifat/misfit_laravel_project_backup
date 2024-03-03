<?php

namespace App\Models\Order;

use App\Models\Accounts\BranchAccountLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    public function order_details()
    {
        return $this->hasMany(ProductOrderDetail::class, 'order_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function account_log()
    {
        return $this->hasOne(BranchAccountLog::class, 'id', 'account_log_id');
    }
}
