<?php
namespace ZC\Entity;

class ProductTest
    extends \ModelTestCase
{



    public function testCanAddProductsToPurchase()
    {
        //SETUP
        $orange = $this->getOrange();
        $apple = $this->getApple();

        $purchase = $this->getPurchase();
        $purchase->products = array($orange,$apple);
        $em = $this->doctrineContainer->getEntityManager();

        $em->persist($orange);
        $em->persist($apple);
        $em->persist($purchase);
        $em->flush();

        //ACT
        $purchaseFromDb = $em->find('ZC\Entity\Purchase',$purchase->id);

        $total = 0;

        foreach($purchaseFromDb->products as $product)
        {
            $total = $total + $product->amount;
        }
        //ASSERT
        $this->assertEquals($apple->amount + $orange->amount , $total);
    }

    public function testProductHasManyPurchases()
    {
        $em = $this->doctrineContainer->getEntityManager();
        $john = $this->getTestUser("John");
        $em->persist($john);
        $em->flush();

        //john makes a purchase:
        $purchase = $this->getPurchase();
        
        $orange = $this->getOrange();
        // special (lots of oranges!):
        $orange->amount = 10.99;

        $purchase->products = array($orange, $this->getApple());
        $john = $em->find('ZC\Entity\User',$john->id);
        $purchase->user = $john;

        $em->persist($purchase->products[0]);
        $em->persist($purchase->products[1]);
        $em->persist($purchase);

        //make another purchase:
        $purchase2 = $this->getPurchase();
        $purchase2->user = $john;
        $purchase2->products = array($this->getApple(), $this->getOrange());
        $em->persist($purchase2->products[0]);
        $em->persist($purchase2->products[1]);
        $em->persist($purchase2);
        $em->flush();

        $em->clear();
        $john = $em->find('ZC\Entity\User',1);
        
        $this->assertEquals(2, count($john->purchases));    
    }

    public function testCanCreateLineItems()
    {
        $product = new Product();
        $product->name = "foo";
        $product->amount = 1;
        $em = $this->doctrineContainer->getEntityManager();
        $em->persist($product);
        
        $purchase = $this->getPurchase();
        $purchase->products->add($product);
        $em->persist($purchase);
        $em->flush();
        $purchases = $em->createQuery('select p from \ZC\Entity\Purchase p')->execute();
        
        $this->assertEquals(1, count($purchases[0]->products));
    }
    
    
    
    
}