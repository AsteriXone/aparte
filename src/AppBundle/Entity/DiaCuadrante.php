<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiaCuadrante
 *
 * @ORM\Table(name="dia_cuadrante")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiaCuadranteRepository")
 */
class DiaCuadrante
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

    /**
     * @ORM\OneToMany(targetEntity="DescansoDia", mappedBy="diaCuadrante", cascade={"persist", "remove"})
     */
    private $descansoDia;

    /**
     * @ORM\ManyToOne(targetEntity="Cuadrante", inversedBy="diaCuadrante")
     */
    private $cuadrante;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getCuadrante()->getNombre();
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DiaCuadrante
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
     * @return DiaCuadrante
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
     * @return DiaCuadrante
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
     * Set cuadrante
     *
     * @param \AppBundle\Entity\Cuadrante $cuadrante
     *
     * @return DiaCuadrante
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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->descansoDia = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add descansoDium
     *
     * @param \AppBundle\Entity\DescansoDia $descansoDium
     *
     * @return DiaCuadrante
     */
    public function addDescansoDium(\AppBundle\Entity\DescansoDia $descansoDium)
    {
        $this->descansoDia[] = $descansoDium;

        return $this;
    }

    /**
     * Remove descansoDium
     *
     * @param \AppBundle\Entity\DescansoDia $descansoDium
     */
    public function removeDescansoDium(\AppBundle\Entity\DescansoDia $descansoDium)
    {
        $this->descansoDia->removeElement($descansoDium);
    }

    /**
     * Get descansoDia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDescansoDia()
    {
        return $this->descansoDia;
    }
}
