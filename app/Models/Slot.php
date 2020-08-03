<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    const UPDATED_AT = null;
    use UtilTrait, Filterable;
    public $incrementing = false;
    protected $dateFormat = 'U';
    protected $table = 'slots';
    protected $fillable = [
        'playlist_id',
        'slot_name'
    ];

    public function filterName($query, $value)
    {
        return $query->where('slot_name', 'LIKE', '%' . $value . '%');
    }

    public function getCreatedAtAttribute()
    {
        return date("Y-m-d H:i:s", $this->attributes['created_at']);
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class,'slot_contents', 'slot_id', 'content_id')->withPivot([
            'seq',
            'seconds'
        ]);
    }
}
