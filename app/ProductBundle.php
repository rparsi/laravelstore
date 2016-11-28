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

    public function coupons()
    {
        return $this->belongsToMany('App\Coupon', 'coupons_product_bundles');
    }
}
