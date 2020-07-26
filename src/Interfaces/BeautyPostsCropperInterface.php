<?php

namespace App\Interfaces;

use App\Entity\Parsing;
use App\Entity\Post;

/**
 * Interface BeautyPostsCropperInterface
 * @package App\Interfaces
 */
interface BeautyPostsCropperInterface
{
    const MAX_BODY_LENGTH = 200;
    const ENDING_POST = '...';

    // can be expanded (o_0)
    const ENDING_BLACKLIST =
        ['сук', 'бля', 'ху', 'пизд', 'ублюд', 'гавн', 'чмо', 'dick', 'damn', 'shit', 'bitch', 'ass'];

    /**
     * @param Parsing $parsing
     *
     * @return void
     */
    public function cropPostsForParsingEntity(Parsing $parsing);

    /**
     * @param Post $post
     *
     * @return void
     */
    public function cropPost(Post $post);
}
