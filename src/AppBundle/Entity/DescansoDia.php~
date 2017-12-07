<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DescansoDia
 *
 * @ORM\Table(name="descanso_dia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DescansoDiaRepository")
 */
class DescansoDia
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
     * @ORM\ManyToOne(targetEntity="DiaCuadrante", inversedBy="descansoDia")
     */
    private $diaCuadrante;


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
     * Set diaCuadrante
     *
     * @param \AppBundle\Entity\DiaCuadrante $diaCuadrante
     *
     * @return DescansoDia
     */
    public function setDiaCuadrante(\AppBundle\Entity\DiaCuadrante $diaCuadrante = null)
    {
        $this->diaCuadrante = $diaCuadrante;

        return $this;
    }

    /**
     * Get diaCuadrante
     *
     * @return \AppBundle\Entity\DiaCuadrante
     */
    public function getDiaCuadrante()
    {
        return $this->diaCuadrante;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     *
     * @return DescansoDia
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
     * @return DescansoDia
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
}
