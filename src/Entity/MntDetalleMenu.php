<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntDetalleMenu
 *
 * @ORM\Table(name="mnt_detalle_menu", indexes={@ORM\Index(name="IDX_65C06A16F6252691", columns={"id_menu"}), @ORM\Index(name="IDX_65C06A164EF458F6", columns={"id_users_add"}), @ORM\Index(name="IDX_65C06A16DBD0331B", columns={"id_users_modify"})})
 * @ORM\Entity
 */
class MntDetalleMenu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="llave primaria"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_detalle_menu_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="submenu", type="string", length=255, nullable=true, options={"comment"="text a mostrar menu de nivel 2"})
     */
    private $submenu;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true, options={"comment"="activo o no"})
     */
    private $activo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="orden", type="smallint", nullable=true, options={"comment"="ordenar las opciones del menu"})
     */
    private $orden;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true, options={"comment"="url a ejecutar"})
     */
    private $url;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_add", type="datetime", nullable=true, options={"comment"="fecha de adicion del registro"})
     */
    private $dateAdd;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_modify", type="datetime", nullable=true)
     */
    private $dateModify;

    /**
     * @var \MntMenu
     *
     * @ORM\ManyToOne(targetEntity="MntMenu", inversedBy="detalleMenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_menu", referencedColumnName="id")
     * })
     */
    private $idMenu;


    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_users_add", referencedColumnName="id")
     * })
     */
    private $idUsersAdd;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_users_modify", referencedColumnName="id")
     * })
     */
    private $idUsersModify;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubmenu(): ?string
    {
        return $this->submenu;
    }

    public function setSubmenu(?string $submenu): self
    {
        $this->submenu = $submenu;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->dateAdd;
    }

    public function setDateAdd(?\DateTimeInterface $dateAdd): self
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    public function getDateModify(): ?\DateTimeInterface
    {
        return $this->dateModify;
    }

    public function setDateModify(?\DateTimeInterface $dateModify): self
    {
        $this->dateModify = $dateModify;

        return $this;
    }

    public function getIdMenu(): ?MntMenu
    {
        return $this->idMenu;
    }

    public function setIdMenu(?MntMenu $idMenu): self
    {
        $this->idMenu = $idMenu;

        return $this;
    }

    public function getIdUsersAdd(): ?Users
    {
        return $this->idUsersAdd;
    }

    public function setIdUsersAdd(?Users $idUsersAdd): self
    {
        $this->idUsersAdd = $idUsersAdd;

        return $this;
    }

    public function getIdUsersModify(): ?Users
    {
        return $this->idUsersModify;
    }

    public function setIdUsersModify(?Users $idUsersModify): self
    {
        $this->idUsersModify = $idUsersModify;

        return $this;
    }


}
