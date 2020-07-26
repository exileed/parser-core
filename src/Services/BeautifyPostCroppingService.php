<?php

namespace App\Services;

use App\Entity\Parsing;
use App\Entity\Post;
use App\Interfaces\BeautyPostsCropperInterface;
use function Symfony\Component\String\u;

/**
 * Class BeautifyPostCroppingService
 * @package App\Services
 */
class BeautifyPostCroppingService implements BeautyPostsCropperInterface
{

    /**
     * @inheritDoc
     */
    public function cropPostsForParsingEntity(Parsing $parsing)
    {
        foreach ($parsing->getPosts() as $post) {
            $this->cropPost($post);
        }
    }

    /**
     * @inheritDoc
     */
    public function cropPost(Post $post)
    {
        $croppedContent= u($post->getBody())->truncate(BeautyPostsCropperInterface::MAX_BODY_LENGTH);
        foreach (BeautyPostsCropperInterface::ENDING_BLACKLIST as $search)
        {
            $blacklistSearchIndex = u($croppedContent)->indexOfLast($search);
            $lastWordIndex = u($croppedContent)->indexOfLast(' ') + 1;
            if ($blacklistSearchIndex !== null) {
                $isBadEnding = $blacklistSearchIndex >= $lastWordIndex;
                if (true === $isBadEnding) {
                    $croppedContent = u($croppedContent)->truncate($blacklistSearchIndex);
                }
            }
        }

        $croppedContent .= BeautyPostsCropperInterface::ENDING_POST;
        $post->setBody($croppedContent);
    }
}
