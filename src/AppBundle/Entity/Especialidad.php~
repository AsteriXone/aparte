<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Especialidad
 *
 * @ORM\Table(name="especialidad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EspecialidadRepository")
 */
class Especialidad
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Grupo", mappedBy="especialidad")
     */
    private $grupo;

    public function __construct()
    {
        $this->grupo = new ArrayCollection();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getNombre();
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
     * @return Especialidad
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
     * Add grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return Especialidad
     */
    public function addGrupo(\AppBundle\Entity\Grupo $grupo)
    {
        $this->grupos[] = $grupo;

        return $this;
    }

    /**
     * Remove grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     */
    public function removeGrupo(\AppBundle\Entity\Grupo $grupo)
    {
        $this->grupos->removeElement($grupo);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * Get grupo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupo()
    {
        return $this->grupo;
    }
}
