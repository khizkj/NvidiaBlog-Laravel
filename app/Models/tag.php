<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{

    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function blog(){
        return $this->belongsToMany(Blog::class);
    }
}
