<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    use UtilTrait, Filterable;
    public $incrementing = false;
    public $timestamps = FALSE;
    protected $table = 'contents';

    public function filterName($query, $value)
    {
        return $query->where('content_name', 'LIKE', '%' . $value . '%');
    }

    public function filterType($query, $value)
    {
        return $query->where('content_type', $value);
    }

    public function getCreatedAtAttribute()
    {
        return date("Y-m-d H:i:s", $this->attributes['created_at']);
    }

    public function getUpdatedAtAttribute()
    {
        return date("Y-m-d H:i:s", $this->attributes['updated_at']);
    }
}
