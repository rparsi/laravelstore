<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLog extends Model
{
    public function purchaseOrder()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }
}
