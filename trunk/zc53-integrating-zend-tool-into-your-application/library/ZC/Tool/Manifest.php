<?php
/**
 * Description of Manifest
 *
 * @author jon
 */
require_once 'ZC/Tool/VisitorProvider.php';
class ZC_Tool_Manifest
    implements Zend_Tool_Framework_Manifest_Interface,
        Zend_Tool_Framework_Manifest_ProviderManifestable,
        Zend_Tool_Framework_Manifest_MetadataManifestable
{
    public function getProviders()
    {
        return array(
            new ZC_Tool_VisitorProvider()
            );
    }
    public function getMetadata()
    {
        return array(
          new Zend_Tool_Framework_Metadata_Basic(
             array(
                 "name" => "argv",
                 "value" => $_SERVER['argv']
                  )
            )
        );
    }
}

