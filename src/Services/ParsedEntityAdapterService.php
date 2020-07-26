<?php

namespace App\Services;

use App\Interfaces\ParsedEntityContractInterface;

/**
 * Class ParsedEntityAdapterService
 * @package App\Services
 */
class ParsedEntityAdapterService implements ParsedEntityContractInterface
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $images = [];

    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @inheritDoc
     */
    public function getImages(): string
    {
        return serialize($this->images);
    }

    /**
     * @inheritDoc
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @inheritDoc
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * @inheritDoc
     */
    public function setImages(array $images)
    {
        $this->images = $images;
    }

    /**
     * @return ParsedEntityContractInterface
     */
    public function getParsedEntity(): ParsedEntityContractInterface
    {
        return new self;
    }
}
