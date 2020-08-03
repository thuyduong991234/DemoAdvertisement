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
        'contents' => ContentTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param
     * @return array
     */
    public function transform(Slot $slot)
    {
        return $slot->toArray();
    }

    public function includeContents(Slot $slot)
    {
        return $slot->contents;
    }
}
