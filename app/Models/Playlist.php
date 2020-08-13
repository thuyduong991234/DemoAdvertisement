<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    //
    use UtilTrait, Filterable;
    public $incrementing = false;
    protected $dateFormat = 'U';
    protected $table = 'playlists';
    protected $fillable = [
        'contract_id',
        'playlist_name',
        'refresh_span_seconds',
        'version_update_type',
        'comment',
        'seconds'
    ];

    public function filterName($query, $value)
    {
        return $query->where('playlist_name', 'LIKE', '%' . $value . '%');
    }

    public function getCreatedAtAttribute()
    {
        return date("Y-m-d H:i:s", $this->attributes['created_at']);
    }

    public function slots()
    {
        return $this->belongsToMany(Slot::class,'playlist_slots', 'playlist_id', 'slot_id')->withPivot([
            'seq',
            'seconds'
        ]);
    }
}
