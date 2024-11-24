<?php

namespace App\Entity;

use App\Repository\MatchFRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchFRepository::class)]
class MatchF
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'matchFs')]
    private ?self $equipe1 = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'equipe1')]
    private Collection $matchFs;

    #[ORM\ManyToOne(inversedBy: 'matchFs')]
    private ?Equipe $equipe2 = null;

    #[ORM\Column(length: 15)]
    private ?string $score_equipe1 = null;

    #[ORM\Column(length: 15)]
    private ?string $score_equipe2 = null;

    /**
     * @var Collection<int, Article>
     */
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'matchf')]
    private ?Collection $articles;

    public function __construct()
    {
        $this->matchFs = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getEquipe1(): ?self
    {
        return $this->equipe1;
    }

    public function setEquipe1(?self $equipe1): static
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMatchFs(): Collection
    {
        return $this->matchFs;
    }

    public function addMatchF(self $matchF): static
    {
        if (!$this->matchFs->contains($matchF)) {
            $this->matchFs->add($matchF);
            $matchF->setEquipe1($this);
        }

        return $this;
    }

    public function removeMatchF(self $matchF): static
    {
        if ($this->matchFs->removeElement($matchF)) {
            // set the owning side to null (unless already changed)
            if ($matchF->getEquipe1() === $this) {
                $matchF->setEquipe1(null);
            }
        }

        return $this;
    }

    public function getEquipe2(): ?Equipe
    {
        return $this->equipe2;
    }

    public function setEquipe2(?Equipe $equipe2): static
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    public function getScoreEquipe1(): ?string
    {
        return $this->score_equipe1;
    }

    public function setScoreEquipe1(string $score_equipe1): static
    {
        $this->score_equipe1 = $score_equipe1;

        return $this;
    }

    public function getScoreEquipe2(): ?string
    {
        return $this->score_equipe2;
    }

    public function setScoreEquipe2(string $score_equipe2): static
    {
        $this->score_equipe2 = $score_equipe2;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setMatchf($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getMatchf() === $this) {
                $article->setMatchf(null);
            }
        }

        return $this;
    }
}
