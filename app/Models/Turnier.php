<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Turnier extends Model
{
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'von_datum', 'bis_datum', 'strasse_nr', 'ort', 'plz', 'land', 'beschreibung', 'teamfee', 'untergrund', 'indoor_outdoor', 'status', 'slug'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['adresse'];

    protected $table = 'turniere';

    protected $dates = [ 'created_at', 'updated_at', 'von_datum', 'bis_datum' ];

    protected $casts = [
        'untergrund' => 'array',
        'indoor_outdoor' => 'array',
    ];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['divisionen', 'teams'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'jahr'])
            ->saveSlugsTo('slug');
    }

    public function divisionen()
    {
        return $this->belongsToMany('App\Models\Division', 'division_turnier', 'turnier_id', 'division_id');
    }

    public function teams()
    {
        return $this->hasMany('App\Models\Team');
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

    public function scopeComing($query)
    {
        return $query->where('von_datum', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function setVonDatumAttribute($date)
    {
        $this->attributes['von_datum'] = Carbon::createFromFormat('d.m.Y', $date);
    }

    public function getVonDatumAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y') : '';
    }

    public function setBisDatumAttribute($date)
    {
        $this->attributes['bis_datum'] = Carbon::createFromFormat('d.m.Y', $date);
    }

    public function getBisDatumAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y') : '';
    }

    public function getAdresseAttribute()
    {
        return  $this->strasse_nr .
                ($this->strasse_nr ? nl2br("\n") : "" ).
                $this->plz .
                ($this->plz ? " " : "") .
                $this->ort .
                ($this->ort ? ", " : "") .
                $this->land;
    }

    public function getBeschreibungAttribute($text)
    {
        return nl2br($text);
    }
}
