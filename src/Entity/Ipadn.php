<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints AS Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IpadnRepository")
 * @Vich\Uploadable
 */
class Ipadn
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Entrez le titre de la page")
     */
    protected $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Renseignez le sommaire de la page")
     */
    protected $small_content;

    /**
     * @Assert\File(
     *     maxSize="3M",
     *     mimeTypes={"image/png", "image/jpeg", "image/jpg"}
     * )
     * @Vich\UploadableField(mapping="ipadn_image", fileNameProperty="imageName", size="imageSize")
     * @var File $imageFile
     */
    protected $imageFile;


    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $imageSize;

    /**
     * @var string $imageName
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $imageName;

    /**
     * @var
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\IpItemAdn", mappedBy="ipadn")
     */
    protected $ipitemadn;


    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->ipitemadn = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSmallContent(): ?string
    {
        return $this->small_content;
    }

    public function setSmallContent(string $small_content): self
    {
        $this->small_content = $small_content;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     * @throws \Exception
     */
    public function setImageFile(?File $image = null): void
    {
        $this->imageFile = $image;
        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->created = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'images/ipadn';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../../public/'.$this->getUploadDir();
    }

    /**
     * @return string
     */
    public function getAssertPath()
    {
        return $this->getUploadDir().'/'.$this->imageName;
    }

    /**
     * @return Collection|IpItemAdn[]
     */
    public function getIpitemadn(): Collection
    {
        return $this->ipitemadn;
    }

    public function addIpitemadn(IpItemAdn $ipitemadn): self
    {
        if (!$this->ipitemadn->contains($ipitemadn)) {
            $this->ipitemadn[] = $ipitemadn;
            $ipitemadn->setIpadn($this);
        }

        return $this;
    }

    public function removeIpitemadn(IpItemAdn $ipitemadn): self
    {
        if ($this->ipitemadn->contains($ipitemadn)) {
            $this->ipitemadn->removeElement($ipitemadn);
            // set the owning side to null (unless already changed)
            if ($ipitemadn->getIpadn() === $this) {
                $ipitemadn->setIpadn(null);
            }
        }

        return $this;
    }
}
