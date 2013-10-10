<?php
$installer = $this;
$installer->startSetup();
//Category
$attribute_data = array(
        'group'             => 'Infinitus Theme Options',
        'type'              => 'int',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Apply Custom',
        'input'             => 'select',
        'class'             => '',
        'source'            => 'eav/entity_attribute_source_boolean',
        'global'            => true,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => false,
        'default'           => 0,
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'unique'            => false,
);
$installer->addAttribute('catalog_category', 'in_cat_menu_status', $attribute_data);

$attribute_data = array(
        'group'             => 'Infinitus Theme Options',
        'type'              => 'varchar',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Background Color',
        'input'             => 'text',
        'class'             => '',
        'source'            => '',
        'global'            => true,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => false,
        'default'           => '#FFFFFF',
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'unique'            => false,
    );
$installer->addAttribute('catalog_category', 'in_cat_menu_background_color', $attribute_data);

$attribute_data = array(
        'group'             => 'Infinitus Theme Options',
        'type'              => 'varchar',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Text Color',
        'input'             => 'text',
        'class'             => '',
        'source'            => '',
        'global'            => true,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => false,
        'default'           => '#FFFFFF',
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'unique'            => false,
    );
$installer->addAttribute('catalog_category', 'in_cat_menu_text_color', $attribute_data);

$attribute_data = array(
        'group'             => 'Infinitus Theme Options',
        'type'              => 'varchar',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Background Hover',
        'input'             => 'text',
        'class'             => '',
        'source'            => '',
        'global'            => true,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => false,
        'default'           => '#FFFFFF',
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'unique'            => false,
    );
$installer->addAttribute('catalog_category', 'in_cat_menu_hover_bg_color', $attribute_data);
$attribute_data = array(
        'group'             => 'Infinitus Theme Options',
        'type'              => 'varchar',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Hover Text',
        'input'             => 'text',
        'class'             => '',
        'source'            => '',
        'global'            => true,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => false,
        'default'           => '#FFFFFF',
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'unique'            => false,
    );
$installer->addAttribute('catalog_category', 'in_cat_menu_text_hover', $attribute_data);
$installer->endSetup(); 