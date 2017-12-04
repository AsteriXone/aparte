<?php

namespace AppBundle\Entity;

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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroCitas", type="integer")
     */
    private $numeroCitas;

    /**
     * @ORM\OneToMany(targetEntity="CuadranteGrupo", mappedBy="cuadrante")
     */
    private $cuadranteGrupo;

    /**
     * @ORM\OneToMany(targetEntity="DiaCuadrante", mappedBy="cuadrante")
     */
    private $diaCuadrante;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->nombre;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cuadrante
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cuadranteGrupo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cuadranteGrupo
     *
     * @param \AppBundle\Entity\CuadranteGrupo $cuadranteGrupo
     *
     * @return Cuadrante
     */
    public function addCuadranteGrupo(\AppBundle\Entity\CuadranteGrupo $cuadranteGrupo)
    {
        $this->cuadranteGrupo[] = $cuadranteGrupo;

        return $this;
    }

    /**
     * Remove cuadranteGrupo
     *
     * @param \AppBundle\Entity\CuadranteGrupo $cuadranteGrupo
     */
    public function removeCuadranteGrupo(\AppBundle\Entity\CuadranteGrupo $cuadranteGrupo)
    {
        $this->cuadranteGrupo->removeElement($cuadranteGrupo);
    }

    /**
     * Get cuadranteGrupo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCuadranteGrupo()
    {
        return $this->cuadranteGrupo;
    }

    /**
     * Add diaCuadrante
     *
     * @param \AppBundle\Entity\DiaCuadrante $diaCuadrante
     *
     * @return Cuadrante
     */
    public function addDiaCuadrante(\AppBundle\Entity\DiaCuadrante $diaCuadrante)
    {
        $this->diaCuadrante[] = $diaCuadrante;

        return $this;
    }

    /**
     * Remove diaCuadrante
     *
     * @param \AppBundle\Entity\DiaCuadrante $diaCuadrante
     */
    public function removeDiaCuadrante(\AppBundle\Entity\DiaCuadrante $diaCuadrante)
    {
        $this->diaCuadrante->removeElement($diaCuadrante);
    }

    /**
     * Get diaCuadrante
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiaCuadrante()
    {
        return $this->diaCuadrante;
    }

    /**
     * Set numeroCitas
     *
     * @param integer $numeroCitas
     *
     * @return Cuadrante
     */
    public function setNumeroCitas($numeroCitas)
    {
        $this->numeroCitas = $numeroCitas;

        return $this;
    }

    /**
     * Get numeroCitas
     *
     * @return integer
     */
    public function getNumeroCitas()
    {
        return $this->numeroCitas;
    }
}
