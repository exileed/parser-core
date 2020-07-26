<?php

namespace App\Interfaces;

/**
 * Interface ParsedEntityContractInterface
 * @package App\Interfaces
 */
interface ParsedEntityContractInterface
{
    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     *
     * @return string
     */
    public function getBody(): string;

    /**
     *
     * @return string serialized
     */
    public function getImages(): string;

    /**
     * @param string $url
     *
     * @return void
     */
    public function setUrl(string $url);

    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title);

    /**
     * @param string $body
     *
     * @return void
     */
    public function setBody(string $body);

    /**
     * @param array $images
     *
     * @return void
     */
    public function setImages(array $images);

    /**
     * @return ParsedEntityContractInterface
     */
    public function getParsedEntity(): self ;
}
