<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmSmsHistory extends Model
{
    use HasFactory;

    public function topic()
    {
        return $this->hasOne(CrmCommunicatoinTopic::class, 'id', 'topic_id');
    }

    public function customer()
    {
        return $this->hasOne(Customers::class, 'id', 'customer_id');
    }
}
