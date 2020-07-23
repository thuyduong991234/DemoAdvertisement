<?php

namespace App\Models;

use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    use UtilTrait;
    public $incrementing = false;
    public $timestamps = FALSE;
    protected $table = 'slots';
}
