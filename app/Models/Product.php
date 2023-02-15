<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 */
class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }

    public function getImage(): string {
        if (!empty($this->image) && is_file(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('images/not_found.jpg');
    }
}
