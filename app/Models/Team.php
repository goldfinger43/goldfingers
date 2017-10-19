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

    protected $with = [ 'division', 'users' ];

    public function turnier()
    {
        return $this->belongsTo(Turnier::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user', 'user_id', 'team_id');
    }
}
