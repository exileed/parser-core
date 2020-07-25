<?php

namespace App\Interfaces;

/**
 * Interface ParserPostsStorageInterface
 *
 * @package App\Interfaces
 */
interface ParserPostsStorageInterface
{
    const PARAMETER_URL = 'url';
    const PARAMETER_TITLE = 'title';
    const PARAMETER_BODY = 'body';
    const PARAMETER_IMAGES = 'images';
    /**
     * @param array $data
     */
    public function saveParsedData(array $data);
}