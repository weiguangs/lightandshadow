<?php

class Infinitus_Htmlcompression_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag('htmlcompression/general_settings/enable');
    }
}