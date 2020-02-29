<?php

namespace App\Entity;
 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
 
/**
 * @ORM\Entity
 */

class Page
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $title;
    
    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="page.blank_content")
     * @Assert\Length(min=10, minMessage="page.too_short_content")
     */
    private $content;
    
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $enabled;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Assert\Type(type="\DateTime")
     */
    private $createdAt;

      /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="blogPosts")
     */
    private $category;


     /**
     * @ORM\Column(type="string")
     */
    private $brochureFilename;

    public function getBrochureFilename()
    {
        return $this->brochureFilename;
    }

    public function setBrochureFilename($brochureFilename)
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
    }
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
        
    public function setId(?int $id): void
    {
        $this->id = $id;
    }    
 
    public function getTitle(): ?string
    {
        return $this->title;
    }
 
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
       
    public function getContent(): ?string
    {
        return $this->content;
    }
 
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
 
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }
        
    public function setEnabled(?bool $enabled): void
    {
        $this->enabled = $enabled;
    }
    
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
 
    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}