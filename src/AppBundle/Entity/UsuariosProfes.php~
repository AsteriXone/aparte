<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuariosProfes
 *
 * @ORM\Table(name="usuarios_profes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuariosProfesRepository")
 */
class UsuariosProfes
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
     * @ORM\Column(name="usuario_id", type="integer")
     */
    private $usuarioId;

    /**
     * @var int
     *
     * @ORM\Column(name="profesor_id", type="integer")
     */
    private $profesorId;

    /**
     * @var int
     *
     * @ORM\Column(name="grupo_id", type="integer")
     */
    private $grupoPerteneciente;



    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usuarios_profes")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Profesor", inversedBy="usuarios_profes")
     */
    private $profesor;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return UsuariosProfes
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set profesorId
     *
     * @param integer $profesorId
     *
     * @return UsuariosProfes
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
     * Set usuario
     *
     * @param \AppBundle\Entity\User $usuario
     *
     * @return UsuariosProfes
     */
    public function setUsuario(\AppBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\User
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set profesor
     *
     * @param \AppBundle\Entity\Profesor $profesor
     *
     * @return UsuariosProfes
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

    /**
     * Set usuarioId
     *
     * @param integer $usuarioId
     *
     * @return UsuariosProfes
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return integer
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * Set grupoPerteneciente
     *
     * @param integer $grupoPerteneciente
     *
     * @return UsuariosProfes
     */
    public function setGrupoPerteneciente($grupoPerteneciente)
    {
        $this->grupoPerteneciente = $grupoPerteneciente;

        return $this;
    }

    /**
     * Get grupoPerteneciente
     *
     * @return integer
     */
    public function getGrupoPerteneciente()
    {
        return $this->grupoPerteneciente;
    }
}
