<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'route'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
