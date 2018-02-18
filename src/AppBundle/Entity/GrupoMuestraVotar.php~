<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoMuestraVotar
 *
 * @ORM\Table(name="grupo_muestra_votar")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GrupoMuestraRepository")
 */
class GrupoMuestraVotar
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
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="gruposMuestrasVotar")
     */
    private $grupo;

    /**
     * @ORM\ManyToOne(targetEntity="MuestraVotar", inversedBy="gruposMuestrasVotar")
     */
    private $muestraVotar;

    /**
     * @var int
     *
     * @ORM\Column(name="grupo_id", type="integer")
     */
    private $grupoId;

    /**
     * @var int
     *
     * @ORM\Column(name="muestra_votar_id", type="integer")
     */
    private $muestraVotarId;

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
     * Set muestraVotar
     *
     * @param \AppBundle\Entity\MuestraVotar $muestraVotar
     *
     * @return GrupoMuestraVotar
     */
    public function setMuestraVotar(\AppBundle\Entity\MuestraVotar $muestraVotar = null)
    {
        $this->muestraVotar = $muestraVotar;

        return $this;
    }

    /**
     * Get muestraVotar
     *
     * @return \AppBundle\Entity\MuestraVotar
     */
    public function getMuestraVotar()
    {
        return $this->muestraVotar;
    }

    /**
     * Set grupoId
     *
     * @param integer $grupoId
     *
     * @return GrupoMuestraVotar
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

    /**
     * Set muestraVotarId
     *
     * @param integer $muestraVotarId
     *
     * @return GrupoMuestraVotar
     */
    public function setMuestraVotarId($muestraVotarId)
    {
        $this->muestraVotarId = $muestraVotarId;

        return $this;
    }

    /**
     * Get muestraVotarId
     *
     * @return integer
     */
    public function getMuestraVotarId()
    {
        return $this->muestraVotarId;
    }
}
