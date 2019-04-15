<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PhaseEnum
 * @package App
 */
class PhaseEnum extends Model
{
    /**
     * Table DB
     * @var string
     */
    protected $table = 'phase_enum';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
    ];
}
