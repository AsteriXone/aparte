<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Muestra
 *
 * @ORM\Table(name="muestra")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MuestraRepository")
 * @Vich\Uploadable
 */
class Muestra
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="muestra_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var int
     */
    private $muestraSeleccionada;

    /**
     * @var int
     */
    private $precioMuestraGrupo;


    /**
     * @ORM\OneToMany(targetEntity="GrupoMuestra", mappedBy="muestra", cascade={"persist", "remove"})
     */
    private $gruposMuestras;

    /**
     * @ORM\OneToMany(targetEntity="UsuariosMuestras", mappedBy="muestra", cascade={"persist", "remove"})
     */
    private $usuarios_muestras;


    public function __construct()
    {
        $this->gruposMuestras = new ArrayCollection();
        $this->usuarios_muestras = new ArrayCollection();
        $this->muestraSeleccionada = 0;
    }


    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getImageName();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getMuestraSeleccionada()
    {
        return $this->muestraSeleccionada;
    }

    /**
     * @param int $accion
     *
     * @return Muestra
     */
    public function setMuestraSeleccionada($accion)
    {
        $this->muestraSeleccionada = $accion;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrecioMuestraGrupo()
    {
        return $this->precioMuestraGrupo;
    }

    /**
     * @param int $precio
     *
     * @return Muestra
     */
    public function setPrecioMuestraGrupo($precio)
    {
        $this->precioMuestraGrupo = $precio;

        return $this;
    }

    /**
     * Add gruposMuestra
     *
     * @param \AppBundle\Entity\GrupoMuestra $gruposMuestra
     *
     * @return Muestra
     */
    public function addGruposMuestra(\AppBundle\Entity\GrupoMuestra $gruposMuestra)
    {
        $this->gruposMuestras[] = $gruposMuestra;

        return $this;
    }

    /**
     * Remove gruposMuestra
     *
     * @param \AppBundle\Entity\GrupoMuestra $gruposMuestra
     */
    public function removeGruposMuestra(\AppBundle\Entity\GrupoMuestra $gruposMuestra)
    {
        $this->gruposMuestras->removeElement($gruposMuestra);
    }


    /**
     * Get gruposMuestras
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGruposMuestras()
    {
        return $this->gruposMuestras;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Muestra
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Muestra
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add usuariosMuestra
     *
     * @param \AppBundle\Entity\UsuariosMuestras $usuariosMuestra
     *
     * @return Muestra
     */
    public function addUsuariosMuestra(\AppBundle\Entity\UsuariosMuestras $usuariosMuestra)
    {
        $this->usuarios_muestras[] = $usuariosMuestra;

        return $this;
    }

    /**
     * Remove usuariosMuestra
     *
     * @param \AppBundle\Entity\UsuariosMuestras $usuariosMuestra
     */
    public function removeUsuariosMuestra(\AppBundle\Entity\UsuariosMuestras $usuariosMuestra)
    {
        $this->usuarios_muestras->removeElement($usuariosMuestra);
    }

    /**
     * Get usuariosMuestras
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosMuestras()
    {
        return $this->usuarios_muestras;
    }
}
