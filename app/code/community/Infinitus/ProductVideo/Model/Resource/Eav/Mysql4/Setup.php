<?php
class Infinitus_ProductVideo_Model_Resource_Eav_Mysql4_Setup extends Mage_Catalog_Model_Resource_Eav_Mysql4_Setup
{
    public function getDefaultEntities()
    {
        return array(
           'catalog_product' => array(
                'entity_model'      => 'catalog/product',
                'attribute_model'   => 'catalog/resource_eav_attribute',
                'table'             => 'catalog/product',
                'additional_attribute_table' => 'catalog/eav_attribute',
                'entity_attribute_collection' => 'catalog/product_attribute_collection',
                'attributes'        => array(
                	'infinitus_video_code' => array(
                        'group'             => 'Video',
                        'type'              => 'varchar',
                        'backend'           => '',
                        'frontend'          => '',
                        'label'             => 'Youtube Code',
                        'input'             => 'text',
                        'class'             => '',
                        'source'            => '',
                        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                        'visible'           => true,
                        'required'          => false,
                        'user_defined'      => false,
                        'default'           => '',
                        'searchable'        => false,
                        'filterable'        => false,
                        'comparable'        => false,
                        'visible_on_front'  => false,
                        'unique'            => false,
                    ),

                    'infinitus_video_title' => array(
                        'group'             => 'Video',
                        'type'              => 'varchar',
                        'backend'           => '',
                        'frontend'          => '',
                        'label'             => 'Video Title',
                        'input'             => 'text',
                        'class'             => '',
                        'source'            => '',
                        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                        'visible'           => true,
                        'required'          => false,
                        'user_defined'      => false,
                        'default'           => '',
                        'searchable'        => false,
                        'filterable'        => false,
                        'comparable'        => false,
                        'visible_on_front'  => false,
                        'unique'            => false,
                    ),
                    
                    'infinitus_video_thumb_width' => array(
                    	'group'             => 'Video',
                        'type'              => 'int',
                        'backend'           => '',
                        'frontend'          => '',
                        'label'             => 'Video Thumbnail Width',
                        'input'             => 'text',
                        'class'             => 'validate-number',
                        'source'            => '',
                        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                        'visible'           => true,
                        'required'          => false,
                        'user_defined'      => false,
                        'default'           => '',
                        'searchable'        => false,
                        'filterable'        => false,
                        'comparable'        => false,
                        'visible_on_front'  => false,
                        'unique'            => false,
                    ),

                    'infinitus_video_thumb_height' => array(
                    	'group'             => 'Video',
                        'type'              => 'int',
                        'backend'           => '',
                        'frontend'          => '',
                        'label'             => 'Video Thumbnail Height',
                        'input'             => 'text',
                        'class'             => 'validate-number',
                        'source'            => '',
                        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                        'visible'           => true,
                        'required'          => false,
                        'user_defined'      => false,
                        'default'           => '',
                        'searchable'        => false,
                        'filterable'        => false,
                        'comparable'        => false,
                        'visible_on_front'  => false,
                        'unique'            => false,
                    ),

                    'infinitus_video_width' => array(
                    	'group'             => 'Video',
                        'type'              => 'int',
                        'backend'           => '',
                        'frontend'          => '',
                        'label'             => 'Video Width',
                        'input'             => 'text',
                        'class'             => 'validate-number',
                        'source'            => '',
                        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                        'visible'           => true,
                        'required'          => false,
                        'user_defined'      => false,
                        'default'           => '',
                        'searchable'        => false,
                        'filterable'        => false,
                        'comparable'        => false,
                        'visible_on_front'  => false,
                        'unique'            => false,
                    ),

                    'infinitus_video_height' => array(
                    	'group'             => 'Video',
                        'type'              => 'int',
                        'backend'           => '',
                        'frontend'          => '',
                        'label'             => 'Video Height',
                        'input'             => 'text',
                        'class'             => 'validate-number',
                        'source'            => '',
                        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
                        'visible'           => true,
                        'required'          => false,
                        'user_defined'      => false,
                        'default'           => '',
                        'searchable'        => false,
                        'filterable'        => false,
                        'comparable'        => false,
                        'visible_on_front'  => false,
                        'unique'            => false,
                    ),
                ),
			),
        );
    }
}