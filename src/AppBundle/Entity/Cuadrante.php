<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cuadrante
 *
 * @ORM\Table(name="cuadrante")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CuadranteRepository")
 */
class Cuadrante
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
     * @var string
     *
     * @ORM\Column(name="nombre_cuadrante", type="string", length=255, unique=true)
     */
    private $nombreCuadrante;

    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="cuadrantes")
     * @ORM\JoinColumn(name="id_grupo", referencedColumnName="id")
     */
    protected $grupo;

    /**
     * @ORM\OneToMany(targetEntity="CuadranteDia", mappedBy="cuadrante")
     */
    protected $cuadrante_dia;

    public function __construct()
    {
        $this->dias_cuadrante = new ArrayCollection();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->nombreCuadrante." - ". $this -> getGrupo();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreCuadrante
     *
     * @param string $nombreCuadrante
     *
     * @return Cuadrante
     */
    public function setNombreCuadrante($nombreCuadrante)
    {
        $this->nombreCuadrante = $nombreCuadrante;

        return $this;
    }

    /**
     * Get nombreCuadrante
     *
     * @return string
     */
    public function getNombreCuadrante()
    {
        return $this->nombreCuadrante;
    }

    /**
     * Set grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return Cuadrante
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
     * Add cuadranteDium
     *
     * @param \AppBundle\Entity\CuadranteDia $cuadranteDium
     *
     * @return Cuadrante
     */
    public function addCuadranteDium(\AppBundle\Entity\CuadranteDia $cuadranteDium)
    {
        $this->cuadrante_dia[] = $cuadranteDium;

        return $this;
    }

    /**
     * Remove cuadranteDium
     *
     * @param \AppBundle\Entity\CuadranteDia $cuadranteDium
     */
    public function removeCuadranteDium(\AppBundle\Entity\CuadranteDia $cuadranteDium)
    {
        $this->cuadrante_dia->removeElement($cuadranteDium);
    }

    /**
     * Get cuadranteDia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCuadranteDia()
    {
        return $this->cuadrante_dia;
    }
}
