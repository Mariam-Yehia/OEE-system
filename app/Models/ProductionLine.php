<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProductionLine extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'description'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function machines()
    {
        return $this->hasMany(Machine::class, 'line_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'line_id');
    }
}

