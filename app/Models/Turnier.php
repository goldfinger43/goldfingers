<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;

class Turnier extends Model
{
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'von_datum', 'bis_datum', 'strasse_nr', 'ort', 'plz', 'land', 'beschreibung', 'teamfee', 'untergrund', 'status', 'slug'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    protected $dates = [ 'created_at', 'updated_at', 'von_datum', 'bis_datum'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'jahr'])
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

    public function getJahrAttribute()
    {
        return $this->von_datum->format('Y') : '';
    }

    public function scopeComing($query)
    {
        return $query->where('von_datum', '>=', Carbon::now()->format('Y-m-d'));
    }
}
