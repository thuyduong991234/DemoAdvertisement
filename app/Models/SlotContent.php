<?php

namespace App\Models;

use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;

class SlotContent extends Model
{
    //
    const UPDATED_AT = null;
    use UtilTrait;
    public $incrementing = false;
    protected $dateFormat = 'U';
    protected $table = 'slot_contents';
    protected $fillable = [
      'slot_id',
      'content_id',
      'seq',
      'seconds'
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
