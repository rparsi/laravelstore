<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function purchaseOrderStatus()
    {
        return $this->belongsTo('App\PurchaseOrderStatus');
    }

    public function purchaseOrderLogs()
    {
        return $this->hasMany('App\PurchaseOrderLog');
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany('App\PurchaseOrderItem');
    }
}
