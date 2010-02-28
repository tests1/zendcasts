<?php
/**
 * Description of MoreInformation
 *
 * @author jon
 */
class ZC_Form_Decorator_MoreInformation
    extends Zend_Form_Decorator_Abstract
{
    public function render($content)
    {
        $placement = $this->getPlacement();
        $text = $this->getOption('text');
        $output = '<p class="more_information">' . $text . '</p>';
        switch($placement)
        {
            case 'PREPEND':
                return $output . $content;
            case 'APPEND':
            default:
                return $content . $output;
        }
    }

}

