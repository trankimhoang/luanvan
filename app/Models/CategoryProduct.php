<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 */
class CategoryProduct extends Model
{
    protected $table = 'categories_product';

    protected $fillable = [
        'name',
        'image'
    ];

    public function product(){
        return $this->hasMany(Product::class, 'category_id');
    }

    public function getImage(): string {
        if (!empty($this->image) && is_file(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('images/not_found.jpg');
    }
}
