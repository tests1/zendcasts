<?php
/**
 * Description of TemplatePickerTest
 *
 * @author jon
 */
class ZC_Controller_Plugin_TemplatePickerTest
    extends ControllerTestCase
{
    private $bb      = 'Blackberry8310/4.2.2 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/-1';
    private $iphone  = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16';
    private $android = 'Mozilla/5.0 (Linux; U; Android 2.1; en-us; Nexus One Build/ERD62) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 –Nexus ';


    public function testCanCreateTemplatePicker()
    {
        $tp = new ZC_Controller_Plugin_TemplatePicker();
        $this->assertType('Zend_Controller_Plugin_Abstract',$tp);
    }

    public function testTemplatePickerCanDetectProperUserAgent()
    {
        $tp = new ZC_Controller_Plugin_TemplatePicker();
        $tp->setUserAgent($this->bb);
        $this->assertEquals('blackberry', $tp->getPlatformLayout());
        $tp->setUserAgent($this->iphone);
        $this->assertEquals('iphone', $tp->getPlatformLayout());
        $tp->setUserAgent($this->android);
        $this->assertEquals('android', $tp->getPlatformLayout());
        $tp->setUserAgent('some dummy text');
        $this->assertEquals('default', $tp->getPlatformLayout());
    }


    public function testCanSetLayoutBasedOnUserAgent()
    {
        $_SERVER['HTTP_USER_AGENT'] = $this->bb;
        $tp = new ZC_Controller_Plugin_TemplatePicker();
        $tp->preDispatch($this->getRequest());
        $this->assertEquals('blackberry',
                Zend_Layout::getMvcInstance()->getLayout());
        
    }
    
    
    
}

