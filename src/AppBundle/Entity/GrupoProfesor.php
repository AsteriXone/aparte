<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoProfesor
 *
 * @ORM\Table(name="grupo_profesor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GrupoProfesorRepository")
 */
class GrupoProfesor
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
     * @ORM\Column(name="grupo_id", type="integer")
     */
    private $grupoId;

    /**
     * @var int
     *
     * @ORM\Column(name="profesor_id", type="integer")
     */
    private $profesorId;

    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="grupos_profesores")
     */
    private $grupo;

    /**
     * @ORM\ManyToOne(targetEntity="Profesor", inversedBy="grupos_profesores")
     */
    private $profesor;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getProfesor()." para grupo ".$this->getGrupo();
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
     * Set grupoId
     *
     * @param integer $grupoId
     *
     * @return GrupoProfesor
     */
    public function setGrupoId($grupoId)
    {
        $this->grupoId = $grupoId;

        return $this;
    }

    /**
     * Get grupoId
     *
     * @return int
     */
    public function getGrupoId()
    {
        return $this->grupoId;
    }

    /**
     * Set profesorId
     *
     * @param integer $profesorId
     *
     * @return GrupoProfesor
     */
    public function setProfesorId($profesorId)
    {
        $this->profesorId = $profesorId;

        return $this;
    }

    /**
     * Get profesorId
     *
     * @return int
     */
    public function getProfesorId()
    {
        return $this->profesorId;
    }

    /**
     * Set grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return GrupoProfesor
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
     * Set profesor
     *
     * @param \AppBundle\Entity\Profesor $profesor
     *
     * @return GrupoProfesor
     */
    public function setProfesor(\AppBundle\Entity\Profesor $profesor = null)
    {
        $this->profesor = $profesor;

        return $this;
    }

    /**
     * Get profesor
     *
     * @return \AppBundle\Entity\Profesor
     */
    public function getProfesor()
    {
        return $this->profesor;
    }
}
