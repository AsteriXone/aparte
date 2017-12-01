<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoMuestra
 *
 * @ORM\Table(name="grupo_muestra")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GrupoMuestraRepository")
 */
class GrupoMuestra
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
     * @var int
     *
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="gruposMuestras")
     */
    private $grupo;

    /**
     * @ORM\ManyToOne(targetEntity="Muestra", inversedBy="gruposMuestras")
     */
    private $muestra;

    /**
     * @var int
     *
     * @ORM\Column(name="muestra_id", type="integer", nullable=true)
     */
    private $muestraId;

    /**
     * @var int
     *
     * @ORM\Column(name="grupo_id", type="integer", nullable=true)
     */
    private $grupoId;


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
     * Set precio
     *
     * @param integer $precio
     *
     * @return GrupoMuestra
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return integer
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    

    /**
     * Set grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return GrupoMuestra
     */
    public function setGrupo(\AppBundle\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \AppBundle\Entity\Grupo
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set muestra
     *
     * @param \AppBundle\Entity\Muestra $muestra
     *
     * @return GrupoMuestra
     */
    public function setMuestra(\AppBundle\Entity\Muestra $muestra = null)
    {
        $this->muestra = $muestra;

        return $this;
    }

    /**
     * Get muestra
     *
     * @return \AppBundle\Entity\Muestra
     */
    public function getMuestra()
    {
        return $this->muestra;
    }

    /**
     * Set muestraId
     *
     * @param integer $muestraId
     *
     * @return GrupoMuestra
     */
    public function setMuestraId($muestraId)
    {
        $this->muestraId = $muestraId;

        return $this;
    }

    /**
     * Get muestraId
     *
     * @return integer
     */
    public function getMuestraId()
    {
        return $this->muestraId;
    }

    /**
     * Set grupoId
     *
     * @param integer $grupoId
     *
     * @return GrupoMuestra
     */
    public function setGrupoId($grupoId)
    {
        $this->grupoId = $grupoId;

        return $this;
    }

    /**
     * Get grupoId
     *
     * @return integer
     */
    public function getGrupoId()
    {
        return $this->grupoId;
    }
}
