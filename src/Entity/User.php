<?php
# api/src/Entity/User.php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use App\State\UserPasswordHasher;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(processor: UserPasswordHasher::class),
        new Get(),
        new Put(processor: UserPasswordHasher::class),
        new Patch(processor: UserPasswordHasher::class),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:create', 'user:update']],
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity('email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Groups(['user:read'])]
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    private ?string $plainPassword = null;

    
    #[ORM\Column(type: 'json')]
    #[Groups(['user:read','user:create', 'user:update'])]
    private array $roles = [];
    
    
    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

#[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $postalcode = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $numtel = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $carbrand = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:read','user:create', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $username = null;

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

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $painPassword): self
    {
        $this->plainPassword = $painPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        // if ($roles[0]) {
         $this->roles = $roles;
        //  return $this;
        // }
        // $this->roles = 'ROLE_USER';
       

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
     
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalcode(string $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getNumtel(): ?string
    {
        return $this->numtel;
    }

    public function setNumtel(string $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getCarbrand(): ?string
    {
        return $this->carbrand;
    }

    public function setCarbrand(string $carbrand): self
    {
        $this->carbrand = $carbrand;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}