<?php
namespace ZC\Entity;

/**
 * Description of PurchaseTest
 *
 * @author jon
 */
class PurchaseTest 
    extends \ModelTestCase
{
    public function testPurchaseAmountIsUpdatedOnSave()
    {
        $purchase = $this->getPurchase();
        $purchase->products = array($this->getOrange(), $this->getApple());
        $em = $this->doctrineContainer->getEntityManager();
        $em->persist($purchase);
        $em->flush();
        $this->assertEquals($this->getOrange()->amount + $this->getApple()->amount,
                            $purchase->amount);
    }
}

