<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Joueur>
     */
    #[ORM\OneToMany(targetEntity: Joueur::class, mappedBy: 'equipe')]
    private Collection $joueurs;

    /**
     * @var Collection<int, MatchF>
     */
    #[ORM\OneToMany(targetEntity: MatchF::class, mappedBy: 'equipe2')]
    private Collection $matchFs;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
        $this->matchFs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): static
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
            $joueur->setEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): static
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getEquipe() === $this) {
                $joueur->setEquipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MatchF>
     */
    public function getMatchFs(): Collection
    {
        return $this->matchFs;
    }

    public function addMatchF(MatchF $matchF): static
    {
        if (!$this->matchFs->contains($matchF)) {
            $this->matchFs->add($matchF);
            $matchF->setEquipe2($this);
        }

        return $this;
    }

    public function removeMatchF(MatchF $matchF): static
    {
        if ($this->matchFs->removeElement($matchF)) {
            // set the owning side to null (unless already changed)
            if ($matchF->getEquipe2() === $this) {
                $matchF->setEquipe2(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom ?? ''; // Returns the name of the team or an empty string if null
    }
}
