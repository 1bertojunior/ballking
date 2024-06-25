<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchup extends Model
{
    use HasFactory;

    protected $table = "matchups";

    protected $fillable = [
        'start',
        'team_home_score',
        'team_away_score',
        'round_id',
        'team_home_id',
        'team_away_id',
    ];

    public function round(){
        return $this->belongsTo(Round::class);
    }

    public function teamHome(){
        return $this->belongsTo(TeamEdition::class, 'team_home_id');
    }

    public function teamAway(){
        return $this->belongsTo(TeamEdition::class, 'team_away_id');
    }
    
}
