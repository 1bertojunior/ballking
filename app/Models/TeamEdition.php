<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamEdition extends Model{
    use HasFactory;

    protected $table = 'team_editions';

    protected $fillable = [
        'team_id',
        'championship_edition_id',
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function championshipEditions() {
        return $this->hasMany(ChampionshipEdition::class);
    }

    public function homeMatchups()
    {
        return $this->hasMany(Matchup::class, 'team_home_id');
    }

    public function awayMatchups()
    {
        return $this->hasMany(Matchup::class, 'team_away_id');
    }
}