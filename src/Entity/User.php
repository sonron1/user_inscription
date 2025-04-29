<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private ?int $id = null;

  #[ORM\Column(type: 'string', length: 180, unique: true)]
  #[Assert\NotBlank]
  #[Assert\Email]
  private ?string $email = null;

  #[ORM\Column(type: 'json')]
  private array $roles = [];

  #[ORM\Column(type: 'string')]
  #[Assert\NotBlank]
  private ?string $password = null;

  #[ORM\Column(type: 'string', length: 100)]
  private ?string $nom = null;

  #[ORM\Column(type: 'string', length: 100)]
  private ?string $prenom = null;

  #[ORM\Column(type: 'boolean')]
  private bool $isVerified = false;

  #[ORM\Column(type: 'string', nullable: true)]
  private ?string $token = null;

  #[ORM\Column(type: 'datetime_immutable')]
  private \DateTimeImmutable $dateInscription;

  public function __construct()
  {
    $this->dateInscription = new \DateTimeImmutable();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getUserIdentifier(): string
  {
    return $this->email;
  }

  public function getRoles(): array
  {
    $roles = $this->roles;
    // Garantir qu'un utilisateur ait toujours au moins ce rôle
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
  }

  public function setRoles(array $roles): self
  {
    $this->roles = $roles;

    return $this;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }

  public function getNom(): ?string
  {
    return $this->nom;
  }

  public function setNom(string $nom): self
  {
    $this->nom = $nom;

    return $this;
  }

  public function getPrenom(): ?string
  {
    return $this->prenom;
  }

  public function setPrenom(string $prenom): self
  {
    $this->prenom = $prenom;

    return $this;
  }

  public function isVerified(): bool
  {
    return $this->isVerified;
  }

  public function setIsVerified(bool $isVerified): self
  {
    $this->isVerified = $isVerified;

    return $this;
  }

  public function getToken(): ?string
  {
    return $this->token;
  }

  public function setToken(?string $token): self
  {
    $this->token = $token;

    return $this;
  }

  public function getDateInscription(): \DateTimeImmutable
  {
    return $this->dateInscription;
  }

  public function setDateInscription(\DateTimeImmutable $date): self
  {
    $this->dateInscription = $date;

    return $this;
  }

  // Méthodes imposées par les interfaces
  public function eraseCredentials(): void
  {
    // Efface les données sensibles ici (ex: mot de passe en clair)
  }
}
