<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This is a dummy entity. Remove it!
 */
#[ApiResource(mercure: true)]
#[ORM\Entity]
class Category
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

    /** The description of the category. */
    #[ORM\Column(type: 'text')]
    public string $description = '';


    /** 
     * @var Product[]|ArrayCollection
     * Available product for this category. */
     #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'category', cascade: ['persist', 'remove'])]
    public iterable $products;

    public function __construct()
    {
        $this->products = new ArrayCollection(); // Initialize $products as a Doctrine collection
    }

    public function getId(): ?int
    {
        return $this->id;
    }

     // Adding both an adder and a remover as well as updating the reverse relation is mandatory
    // if you want Doctrine to automatically update and persist (thanks to the "cascade" option) the related entity
    public function addProduct(Product $product): void
    {
        $product->category = $this;
        $this->products->add($product);
    }

    public function removeProduct(Product $product): void
    {
        $product->category  = null;
        $this->products->removeElement($product);
    }


}

