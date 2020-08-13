<?php

namespace App\Transformers;

use App\Models\Playlist;
use Flugg\Responder\Transformers\Transformer;

class PlaylistTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [

    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
        'slots' => SlotTransformer::class,
    ];

    /**
     * Transform the model.
     *
     * @return array
     */
    public function transform(Playlist $playlist)
    {
        return $playlist->toArray();
    }

    public function loadSlots($query)
    {
        return $query->orderBy('seq', 'asc')->get();
    }
}
