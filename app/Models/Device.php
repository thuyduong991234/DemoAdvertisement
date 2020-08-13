<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UtilTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    const UPDATED_AT = null;
    use UtilTrait, Filterable;
    public $incrementing = false;
    protected $dateFormat = 'U';
    protected $table = 'devices';
    protected $fillable = [
        'contract_id',
        'device_name',
        'socket_id',
        'platform',
        'additions',
        'comment'
    ];

    public function filterName($query, $value)
    {
        return $query->where('device_name', 'LIKE', '%' . $value . '%');
    }

    public function getCreatedAtAttribute()
    {
        return date("Y-m-d H:i:s", $this->attributes['created_at']);
    }
}
