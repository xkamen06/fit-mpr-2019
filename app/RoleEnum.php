<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleEnum
 * @package App
 */
class RoleEnum extends Model
{
    /**
     * Table DB
     * @var string
     */
    protected $table = 'role_enum';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
    ];
}
