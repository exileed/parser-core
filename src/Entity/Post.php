<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="text")
     */
    private $images;

    /**
     * @ORM\Column(type="text")
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Parsing::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parsing;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return $this
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImages(): ?string
    {
        return $this->images;
    }

    /**
     * @return array
     */
    public function getImagesToArray(): array
    {
        $imagesUnserialized = unserialize($this->images);
        return $imagesUnserialized !== false ? $imagesUnserialized : [];
    }

    /**
     * @param string $images
     *
     * @return $this
     */
    public function setImages(string $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Parsing|null
     */
    public function getParsing(): ?Parsing
    {
        return $this->parsing;
    }

    /**
     * @param Parsing|null $parsing
     *
     * @return $this
     */
    public function setParsing(?Parsing $parsing): self
    {
        $this->parsing = $parsing;

        return $this;
    }
}
