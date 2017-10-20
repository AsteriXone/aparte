<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CuadranteDia
 *
 * @ORM\Table(name="cuadrante_dia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CuadranteDiaRepository")
 */
class CuadranteDia
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time")
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time")
     */
    private $horaFin;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->prueba;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Cuadrante", inversedBy="cuadrante_dia")
     * @ORM\JoinColumn(name="id_cuadrante", referencedColumnName="id")
     */
    protected $cuadrante;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return CuadranteDia
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     *
     * @return CuadranteDia
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFin
     *
     * @param \DateTime $horaFin
     *
     * @return CuadranteDia
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return \DateTime
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set prueba
     *
     * @param string $prueba
     *
     * @return CuadranteDia
     */
    public function setPrueba($prueba)
    {
        $this->prueba = $prueba;

        return $this;
    }

    /**
     * Get prueba
     *
     * @return string
     */
    public function getPrueba()
    {
        return $this->prueba;
    }

    /**
     * Set cuadrante
     *
     * @param \AppBundle\Entity\Cuadrante $cuadrante
     *
     * @return CuadranteDia
     */
    public function setCuadrante(\AppBundle\Entity\Cuadrante $cuadrante = null)
    {
        $this->cuadrante = $cuadrante;

        return $this;
    }

    /**
     * Get cuadrante
     *
     * @return \AppBundle\Entity\Cuadrante
     */
    public function getCuadrante()
    {
        return $this->cuadrante;
    }
}
