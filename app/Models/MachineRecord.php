<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MachineRecord extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'machine_id', 'user_id', 'quantity', 'start_time', 'end_time'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

