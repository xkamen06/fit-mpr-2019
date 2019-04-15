<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App
 */
class Project extends Model
{
    /**
     * Table DB
     * @var string
     */
    protected $table = 'project';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'estimated_price', 'estimated_time', 'date_from', 'date_to', 'id_user', 'status'
    ];

    /**
     * Get author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    /**
     * Get comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Note', 'id_project', 'id')->orderBy('id', 'asc');
    }

    /**
     * Get phases
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phases()
    {
        return $this->hasMany('App\Phase', 'id_project', 'id')->orderBy('id', 'asc');
    }

    /**
     * Get actual phase
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function actualPhase()
    {
        return $this->hasOne('App\Phase', 'id_project', 'id')->where('state', 'V řešení');
    }
}
