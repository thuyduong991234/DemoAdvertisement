<?php

namespace App\Models;

use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;

class PlaylistSlot extends Model
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

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
