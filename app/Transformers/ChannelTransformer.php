<?php

namespace App\Transformers;

use App\Models\Channel;
use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
{
    public function transform(Channel $channel)
    {
        return [
            'name'  => $channel->name,
            'slug'  => $channel->slug,
            'image' => $channel->getImage()
        ];
    }

}