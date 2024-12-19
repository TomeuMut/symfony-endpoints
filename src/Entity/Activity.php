<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list', 'detail'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list', 'detail'])]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['list'])]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['detail'])]
    #[Assert\NotBlank]
    private ?string $longDescription = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['list', 'detail'])]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?float $price = null;

    /**
     * This is a relation between Activity and Supplier entities print in activity table the supplier_id
     *      
     */
    #[ORM\ManyToOne(targetEntity: Supplier::class)]
    #[ORM\JoinColumn(nullable: true)] 
    private $supplier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(?string $longDescription): static
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;
        return $this;
    }
}
