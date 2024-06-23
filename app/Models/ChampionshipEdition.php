<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChampionshipEdition extends Model
{
    use HasFactory;

    protected $table = 'championship_editions';

    protected $fillable = [
        'year',
        'start',
        'end',
        'championship_id',
    ];

    public function championshipEditions()
    {
        return $this->hasMany(ChampionshipEdition::class);
    }

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }

}