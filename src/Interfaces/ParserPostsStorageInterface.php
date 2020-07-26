<?php

namespace App\Interfaces;

/**
 * Interface ParserPostsStorageInterface
 *
 * @package App\Interfaces
 */
interface ParserPostsStorageInterface
{

    /**
     * @param ParsedEntityContractInterface[] $data
     */
    public function saveParsedData(array $data);
}
