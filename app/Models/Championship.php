<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    use HasFactory;

    protected $table = 'championships';

    protected $fillable = [
        'name',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function championshipEditions(){
        return $this->hasMany(ChampionshipEdition::class);
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }

}
