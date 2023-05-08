<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table ='order_items';
    protected $fillable =[
        'pro_id',
        'order_id',
        'qty',
        'price',
    ];
    public function products()
    {
        return $this->belongsTo(Product::class,'pro_id','id');
    }
}
