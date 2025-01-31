<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = [
        'name',
        'abb',
        'state_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function championships()
    {
        return $this->hasMany(Championship::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
