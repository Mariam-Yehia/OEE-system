<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['line_id', 'record_id', 'name', 'description', 'status'];

    public function line()
    {
        return $this->belongsTo(ProductionLine::class, 'line_id');
    }

    public function machineRecords()
    {
        return $this->hasMany(MachineRecord::class);
    }
}

