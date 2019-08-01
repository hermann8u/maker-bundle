<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe")
     */
    private $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe ...$recipes): self
    {
        foreach ($recipes as $recipe) {
            if (!$this->recipes->contains($recipe)) {
                $this->recipes[] = $recipe;
            }
        }

        return $this;
    }

    public function removeRecipe(Recipe ...$recipes): self
    {
        foreach ($recipes as $recipe) {
            if ($this->recipes->contains($recipe)) {
                $this->recipes->removeElement($recipe);
            }
        }

        return $this;
    }
}
