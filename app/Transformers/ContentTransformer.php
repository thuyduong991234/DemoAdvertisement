<?php

namespace App\Transformers;

use App\Models\Content;
use Flugg\Responder\Transformers\Transformer;

class ContentTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Content $content
     * @return array
     */
    public function transform(Content $content)
    {
        return [
            'id' => $content->id,
            'content_name' => $content->content_name,
            'content_type' => $content->content_type,
            'seq' => $content->pivot->seq,
            'seconds' => $content->pivot->seconds
        ];
    }
}
