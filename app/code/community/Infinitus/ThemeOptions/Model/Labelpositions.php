<?php class Infinitus_ThemeOptions_Model_Labelpositions
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'top-left', 'label'=>Mage::helper('themeoptions')->__('Top Left')),
            array('value'=>'top-right', 'label'=>Mage::helper('themeoptions')->__('Top Right')),        
            array('value'=>'bottom-left', 'label'=>Mage::helper('themeoptions')->__('Bottom Left')),
            array('value'=>'bottom-right', 'label'=>Mage::helper('themeoptions')->__('Bottom Right'))
        );
    }

}?>