<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $fillable = ['quantity'];

    function rel_to_product()
    {
        return $this->belongsTo(products::class, 'product_id','product_photo');

}
}
