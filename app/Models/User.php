<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable
{
    use Notifiable, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'vorname', 'nachname', 'geburtsdatum', 'dfv_nr', 'phone', 'strasse_nr', 'plz', 'ort', 'geschlecht', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['fullname'];

    protected $dates = [ 'created_at', 'updated_at', 'geburtsdatum' ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['vorname', 'nachname'])
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setGeburtsdatumAttribute($date)
    {
        if ($date) {
            $this->attributes['geburtsdatum'] = Carbon::createFromFormat('d.m.Y', $date);
        }
    }

    public function getGeburtsdatumAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y') : '';
    }

    public function getFullnameAttribute()
    {
        return $this->vorname . " " . $this->nachname;
    }


}
