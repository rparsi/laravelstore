<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productType()
    {
        return $this->belongsTo('App\ProductType');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }

    public function productOptions()
    {
        return $this->hasMany('App\ProductOption');
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany('App\PurchaseOrderItem');
    }

    public function productBundles()
    {
        return $this->belongsToMany('App\ProductBundle', 'product_bundles_products');
    }

    public function coupons()
    {
        return $this->belongsToMany('App\Coupon', 'coupons_products');
    }
}
