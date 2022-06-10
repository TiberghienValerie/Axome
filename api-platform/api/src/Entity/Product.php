<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a dummy entity. Remove it!
 */
#[ApiResource(mercure: true)]
#[ORM\Entity]
class Product
{
    /**
     * The entity ID
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    /**
     * A Title
     */
    #[ORM\Column]
    #[Assert\NotBlank]
    public string $title = '';

    /** The description of the product. */
    #[ORM\Column(type: 'text')]
    public string $description = '';

    /** The price of the product. */
    #[ORM\Column]
    #[Assert\Range(minMessage: 'The price must be superior to 0.', min: 0)]
    public float $price = 0.0;

    /** The category this product is about. */
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    public ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}

