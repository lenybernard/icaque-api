<?php

namespace AppBundle\Entity\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any offered product or service. For example: a pair of shoes; a concert ticket; the rental of a car; a haircut; or an episode of a TV show streamed online.
 *
 * @see http://schema.org/Product Documentation on Schema.org
 *
 * @Iri("http://schema.org/Product")
 *
 * @ORM\Entity
 * @ORM\Table("Food")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", length=15, type="string")
 * @ORM\DiscriminatorMap(
 *     {
 *     "fruit"="AppBundle\Entity\Product\Fruit",
 *     "vegetable"="AppBundle\Entity\Product\Vegetable",
 *     }
 * )
 */
abstract class Food
{
    /**
     * @var int
     *
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;
    /**
     * @var string A short description of the item.
     *
     * @ORM\Column(nullable=true)
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/description")
     */
    private $description;
    /**
     * @var string An image of the item. This can be a [URL](http://schema.org/URL) or a fully described [ImageObject](http://schema.org/ImageObject).
     *
     * @ORM\Column(nullable=true)
     * @Assert\Url
     * @Iri("https://schema.org/image")
     */
    private $image;
    /**
     * @var string The name of the item.
     *
     * @ORM\Column(nullable=true)
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/name")
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\FoodBasket", mappedBy="food")
     */
    private $baskets;

    public function __construct()
    {
        $this->baskets = new ArrayCollection();
    }

    public function addBasket(\AppBundle\Entity\FoodBasket $foodBasket)
    {
        $this->baskets[] = $foodBasket;

        return $this;
    }

    public function removeBasket(\AppBundle\Entity\FoodBasket $foodBasket)
    {
        $this->baskets->removeElement($foodBasket);
    }

    public function getBaskets()
    {
        return $this->baskets;
    }

    /**
     * Sets id.
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets image.
     *
     * @param string $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Gets image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
