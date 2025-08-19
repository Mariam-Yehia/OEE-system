<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductionLine;
use App\Models\Product;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];

    public function productionLines()
    {
        return $this->hasMany(ProductionLine::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
