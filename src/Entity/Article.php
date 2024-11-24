<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Cocur\Slugify\Slugify;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;



#[ORM\Entity(repositoryClass: ArticleRepository::class)]

#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\Column(length: 120)]
    private ?string $auteur = null;


    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDePublication = null;

    /**
     * @var ?Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'articles')]
    private ?Collection $tags;

    /**
     * @var ?Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'article')]
    private ?Collection $commentaires;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?MatchF $matchf = null;


    #[Vich\UploadableField(mapping: 'article_images', fileNameProperty: 'imageName')]
    #[Assert\Image(
        mimeTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
        mimeTypesMessage: 'Please upload a valid image file (jpeg, png, gif , webp).'
    )]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName = null; // Champ pour stocker le nom de l'image dans la base de données


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getDateDePublication(): ?\DateTimeInterface
    {
        return $this->dateDePublication;
    }

    public function setDateDePublication(\DateTimeInterface $dateDePublication): static
    {
        $this->dateDePublication = $dateDePublication;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticle() === $this) {
                $commentaire->setArticle(null);
            }
        }

        return $this;
    }

    public function getMatchf(): ?MatchF
    {
        return $this->matchf;
    }

    public function setMatchf(?MatchF $matchf): static
    {
        $this->matchf = $matchf;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            // Update the timestamp when a new file is uploaded
            $this->updatedAt = new \DateTimeImmutable('now');
        }
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;
        return $this;
    }

    private ?string $webpImageName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function getWebpImageName(): ?string
    {
        return $this->webpImageName;
    }

    public function setWebpImageName(?string $webpImageName): self
    {
        $this->webpImageName = $webpImageName;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }


    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setSlugTitre(): void
    {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->titre);
    }
}
