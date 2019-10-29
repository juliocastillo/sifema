<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MntMenu
 *
 * @ORM\Table(name="mnt_menu", indexes={@ORM\Index(name="IDX_83F4AFF992F1A2E0", columns={"id_modulo_sistema"}), @ORM\Index(name="IDX_83F4AFF94EF458F6", columns={"id_users_add"}), @ORM\Index(name="IDX_83F4AFF9DBD0331B", columns={"id_users_modify"})})
 * @ORM\Entity
 */
class MntMenu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="llave primaria"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_menu_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="menu", type="string", length=255, nullable=true, options={"comment"="numbre del testo a mostrar de menu nivel 1"})
     */
    private $menu;

    /**
     * @var int|null
     *
     * @ORM\Column(name="orden", type="smallint", nullable=true, options={"comment"="ordenar las opciones del menu"})
     */
    private $orden;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true, options={"comment"="activo o no"})
     */
    private $activo;

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
     * @var \CtlModuloSistema
     *
     * @ORM\ManyToOne(targetEntity="CtlModuloSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulo_sistema", referencedColumnName="id")
     * })
     */
    private $idModuloSistema;

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

    /**
      *
      * @ORM\OneToMany(targetEntity="MntDetalleMenu", mappedBy="idMenu", cascade={"all"}, orphanRemoval=true)
      *
      */
     private $detalleMenu;

     public function __construct()
     {
         $this->detalleMenu = new ArrayCollection();
     }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenu(): ?string
    {
        return $this->menu;
    }

    public function setMenu(?string $menu): self
    {
        $this->menu = $menu;

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

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

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

    public function getIdModuloSistema(): ?CtlModuloSistema
    {
        return $this->idModuloSistema;
    }

    public function setIdModuloSistema(?CtlModuloSistema $idModuloSistema): self
    {
        $this->idModuloSistema = $idModuloSistema;

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

    /**
     * @return Collection|MntDetalleMenu[]
     */
    public function getDetalleMenu(): Collection
    {
        return $this->detalleMenu;
    }

    public function addDetalleMenu(MntDetalleMenu $detalleMenu): self
    {
        if (!$this->detalleMenu->contains($detalleMenu)) {
            $this->detalleMenu[] = $detalleMenu;
            $detalleMenu->setIdMenu($this);
        }

        return $this;
    }

    public function removeDetalleMenu(MntDetalleMenu $detalleMenu): self
    {
        if ($this->detalleMenu->contains($detalleMenu)) {
            $this->detalleMenu->removeElement($detalleMenu);
            // set the owning side to null (unless already changed)
            if ($detalleMenu->getIdMenu() === $this) {
                $detalleMenu->setIdMenu(null);
            }
        }

        return $this;
    }


}
