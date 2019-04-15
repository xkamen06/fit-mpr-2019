<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Phase
 * @package App
 */
class Phase extends Model
{
    /**
     * Table DB
     * @var string
     */
    protected $table = 'phase';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_project', 'id_user', 'id_phase_enum', 'description', 'price', 'spent_time', 'date_from', 'date_to', 'state'
    ];

    /**
     * Get phase enum
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phaseEnum()
    {
        return $this->belongsTo('App\PhaseEnum', 'id_phase_enum', 'id');
    }

    /**
     * Get author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
