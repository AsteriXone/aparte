<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incidencia
 *
 * @ORM\Table(name="incidencia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IncidenciaRepository")
 */
class Incidencia
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
     * @ORM\Column(name="incidencia", type="text")
     */
    private $incidencia;

    /**
     * @ORM\ManyToOne(targetEntity="GruposUsuarios", inversedBy="incidencias")
     */
    private $grupo_usuario;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getIncidencia();
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
     * Set incidencia
     *
     * @param string $incidencia
     *
     * @return Incidencia
     */
    public function setIncidencia($incidencia)
    {
        $this->incidencia = $incidencia;

        return $this;
    }

    /**
     * Get incidencia
     *
     * @return string
     */
    public function getIncidencia()
    {
        return $this->incidencia;
    }

    /**
     * Set grupoUsuario
     *
     * @param \AppBundle\Entity\GruposUsuarios $grupoUsuario
     *
     * @return Incidencia
     */
    public function setGrupoUsuario(\AppBundle\Entity\GruposUsuarios $grupoUsuario = null)
    {
        $this->grupo_usuario = $grupoUsuario;

        return $this;
    }

    /**
     * Get grupoUsuario
     *
     * @return \AppBundle\Entity\GruposUsuarios
     */
    public function getGrupoUsuario()
    {
        return $this->grupo_usuario;
    }
}
