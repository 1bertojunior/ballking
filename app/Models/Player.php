<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'city_id',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }
}
