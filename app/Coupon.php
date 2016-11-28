<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product', 'coupons_products');
    }

    public function productBundles()
    {
        return $this->belongsToMany('App\ProductBundle', 'coupons_product_bundles');
    }

    public function purchaseOrders()
    {
        return $this->belongsToMany('App\PurchaseOrder', 'purchase_orders_coupons');
    }
}
