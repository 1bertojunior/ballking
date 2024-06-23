<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoundType extends Model{

    use HasFactory;

    protected $table = "round_types";

    protected $fillable = [
        'name',
    ];

    public function rounds(){
        return $this->hasMany(Round::class);
    }

}