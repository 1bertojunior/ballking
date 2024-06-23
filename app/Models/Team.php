<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'abb',
        'championship_id',
    ];

    public function championship(){
        return $this->belongsTo(Championship::class);
    }

    public function teamEditions(){
        return $this->hasMany(TeamEdition::class);
    }
}