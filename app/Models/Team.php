<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'anzahl_open', 'anzahl_frauen', 'turnier_id', 'division_id'
    ];

    public function turnier()
    {
        return $this->belongsTo('App/Models/Turnier');
    }

    public function division()
    {
        return $this->belongsTo('App/Models/Division');
    }
}
