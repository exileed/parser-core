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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function getImagesToArray(): array
    {
        $imagesUnserialized = unserialize($this->images);
        return $imagesUnserialized !== false ? $imagesUnserialized : [];
    }

    public function setImages(string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getParsing(): ?Parsing
    {
        return $this->parsing;
    }

    public function setParsing(?Parsing $parsing): self
    {
        $this->parsing = $parsing;

        return $this;
    }
}
