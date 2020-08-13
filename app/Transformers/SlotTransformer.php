<?php

namespace App\Transformers;

use App\Models\Content;
use App\Models\Slot;
use Flugg\Responder\Transformers\Transformer;

class SlotTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        //'contents' => ContentTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
        'contents' => ContentTransformer::class,
    ];

    /**
     * Transform the model.
     *
     * @param
     * @return array
     */
    public function transform(Slot $slot)
    {
        return [
            'id' => $slot->id,
            'playlist_id' => $slot->playlist_id,
            'slot_name' => $slot->slot_name
        ];
    }

    public function loadContents($query)
    {
        return $query->orderBy('seq', 'asc')->get();
    }
}
