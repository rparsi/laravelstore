<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBundle extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_bundles_products');
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany('App\PurchaseOrderItem');
    }
}
