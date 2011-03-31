<?php
namespace ZC\Entity;
/**
 * @Entity
 * @Table(name="products")
 * @author jon
 */
class Product
{
    /**
     *
     * @var integer $id
     * @Column(name="id", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ManyToMany(targetEntity="Purchase", mappedBy="products", cascade={"ALL"})
     */
    private $purchases;

    /**
     *
     * @Column(type="string")
     */
    private $name;

    /**
     *
     * @Column(type="decimal", precision=2,scale=4)
     */
    private $amount;


    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property,$value)
    {
        $this->$property = $value;
    }
}