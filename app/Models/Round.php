<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $table = "rounds";

    protected $fillable = [
        'round',
        'round_type_id',
        'championship_edition_id'
    ];

    public function roundType(){
        return $this->belongsTo(RoundType::class);
    }

    public function championshipEdition(){
        return $this->belongsTo(ChampionshipEdition::class);
    }
}
