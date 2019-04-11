<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $table = 'phase';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_project', 'id_user', 'id_phase_enum', 'description', 'price', 'spent_time', 'date_from', 'date_to', 'state'
    ];
}
