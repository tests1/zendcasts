<?php
/**
 * Description of VisitorProvider
 *
 * @author jon
 */
class ZC_Tool_VisitorProvider
    extends Zend_Tool_Project_Provider_Abstract
    implements Zend_Tool_Framework_Provider_Pretendable
{
    public function show()
    {
        date_default_timezone_set('America/New_York');

        $fileContents = file_get_contents(realpath(__DIR__) . '/../../../logs/visitors.xml');
        $xml = '<root>' . $fileContents . '</root>';
        $report = "-------" . PHP_EOL .
                  "Visitors" . PHP_EOL .
                  "Timezone: " . date('e') . PHP_EOL;

        $xmlElements = simplexml_load_string($xml);
        $firstRequestTime = $xmlElements->children()->visitor[0]->REQUEST_TIME;
        $firstDate = new Zend_Date($firstRequestTime);

        foreach($xmlElements as $visitor)
        {
            $curDate = new Zend_Date((string)$visitor->REQUEST_TIME);
            if ($curDate->compare($firstDate->get(Zend_Date::DATES), Zend_Date::DATES))
                $report .= '===== NEW DATE =====' . PHP_EOL;

            $report .= date('d-M-Y h:i:s',(string) $visitor->REQUEST_TIME) . ': '
                    .$visitor->HTTP_USER_AGENT . PHP_EOL;

            $firstDate = $curDate;
        }

        $this->_registry->getResponse()->appendContent($report);
    }
    
    public function hello($name = 'World')
    {
        $this->_registry->getResponse()->appendContent("Hello, {$name}!");
    }
    
}

