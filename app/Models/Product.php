<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'line_id', 'code', 'name'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function line()
    {
        return $this->belongsTo(ProductionLine::class, 'line_id');
    }

    public function machineRecords()
    {
        return $this->hasMany(MachineRecord::class);
    }
}


