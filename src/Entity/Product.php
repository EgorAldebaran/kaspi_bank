<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    public const CHK = 1;
    public const SAV = 2;
    public const MM = 3;
    public const CD = 4;
    public const MRT = 5;
    public const AUT = 6;
    public const BUS = 7;
    public const SBL = 8;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ProductType $product_type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_offered = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_retired = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Account::class)]
    private Collection $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProductType(): ?ProductType
    {
        return $this->product_type;
    }

    public function setProductType(?ProductType $product_type): static
    {
        $this->product_type = $product_type;

        return $this;
    }

    public function getDateOffered(): ?\DateTimeInterface
    {
        return $this->date_offered;
    }

    public function setDateOffered(?\DateTimeInterface $date_offered): static
    {
        $this->date_offered = $date_offered;

        return $this;
    }

    public function getDateRetired(): ?\DateTimeInterface
    {
        return $this->date_retired;
    }

    public function setDateRetired(?\DateTimeInterface $date_retired): static
    {
        $this->date_retired = $date_retired;

        return $this;
    }

    /**
     * @return Collection<int, Account>
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    public function addAccount(Account $account): static
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts->add($account);
            $account->setProduct($this);
        }

        return $this;
    }

    public function removeAccount(Account $account): static
    {
        if ($this->accounts->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getProduct() === $this) {
                $account->setProduct(null);
            }
        }

        return $this;
    }
}
