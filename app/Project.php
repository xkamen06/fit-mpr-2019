<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'estimated_price', 'estimated_time', 'date_from', 'date_to', 'id_user', 'status'
    ];
}
