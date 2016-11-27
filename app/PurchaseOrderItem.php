<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    public function purchaseOrder()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function productBundle()
    {
        return $this->belongsTo('App\ProductBundle');
    }
}
