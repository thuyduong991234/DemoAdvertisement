<?php

namespace App\Models;

use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SlotContent extends Pivot
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
}
