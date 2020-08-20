<?php

namespace App\Models;

use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlaylistSlot extends Pivot
{
    //
    const UPDATED_AT = null;
    use UtilTrait;
    public $incrementing = false;
    protected $dateFormat = 'U';
    protected $table = 'playlist_slots';
    protected $fillable = [
        'slot_id',
        'playlist_id',
        'seq',
        'seconds'
    ];

}
