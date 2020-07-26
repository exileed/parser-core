<?php

namespace App\Interfaces;

/**
 * Interface ParserClientServiceInterface
 * @package App\Interfaces
 */
interface ParserClientServiceInterface
{

    /**
     * @param string $url
     *
     * @return void
     */
    public function updateClientStateContent(string $url);

    /**
     * @return array
     */
    public function getPostsLinksCollection(): array;

    /**
     * @return string
     */
    public function getPostTitle(): string;

    /**
     * @return string
     */
    public function getPostBody(): string;

    /**
     * @return array
     */
    public function getPostImages(): array;
}
