<?php

class Infinitus_OneClickInstaller_Adminhtml_InstallerFormController extends Mage_Adminhtml_Controller_Action
{
    protected $_storeId = null;

    public function indexAction()
    {
        $this->loadLayout()->renderLayout();
    }
    
		protected function deleteBlock($id){
	        $block = Mage::getModel('cms/block')
	                ->setStoreId($this->_storeId)
	                ->load($id);
	
			$block->delete();
		}
    
    public function uninstallAction()
    {
		$post = $this->getRequest()->getPost();
		$message = "";
        try {
            if (empty($post)) {
                Mage::throwException($this->__('Invalid form data.'));
            }
			$storeId = $post['design']['store_id'];		
			$this->_storeId = $storeId;	
			
			$this->deleteBlock('home_3_banner');
			$this->deleteBlock('product_custom_tab_1');
			$this->deleteBlock('product_custom_tab_2');
			$this->deleteBlock('detail_product_right');
			$this->deleteBlock('block-top-left');
			$this->deleteBlock('block_custom_menu');
			$this->deleteBlock('block_inner_category_page');			
			$this->deleteBlock('block_custom_slidebar_1');
			$this->deleteBlock('block_custom_slidebar_2');
			$this->deleteBlock('block_custom_slidebar_3');
			$this->deleteBlock('block_detail_product_page_1');
			$this->deleteBlock('block_detail_product_page_2');
			$this->deleteBlock('block_cart_below_total');
			$this->deleteBlock('block_replace_crosssel');
			$this->deleteBlock('block_checkout_top');
			$this->deleteBlock('block_checkout_bottom');
			$this->deleteBlock('block_checkout_right_top');
			$this->deleteBlock('block_checkout_right_bottom');
			$this->deleteBlock('call_info');
			$this->deleteBlock('shipping_info');
			$this->deleteBlock('aditional_footer_right');
			$this->deleteBlock('aditional_footer_left');
			$this->deleteBlock('block_top_cart');
			$this->deleteBlock('block_contact_top');
			$this->deleteBlock('block_contact_bottom');
			$this->deleteBlock('block_header_right');
			$this->deleteBlock('block_bottom_right');
			$this->deleteBlock('block_about_box');
			$this->deleteBlock('block_contact_box');
			$this->deleteBlock('block_brand_list');
			$this->deleteBlock('block_3_home_banner_right');
			if($storeId == 0) {
				$scope = 'default';
			}else{
				$scope = 'stores';
			}
			Mage::getConfig()->saveConfig('design/package/name','default', $scope, $storeId);
			Mage::getConfig()->saveConfig('design/theme/template', 'default', $scope, $storeId);
			Mage::getConfig()->saveConfig('design/theme/skin', 'default', $scope, $storeId);
			Mage::getConfig()->saveConfig('design/theme/layout', 'default', $scope, $storeId);
			Mage::getConfig()->saveConfig('design/theme/default', 'default', $scope, $storeId);
			
			$message = $this->__('Maxxi theme was uninstalled successfully. ');
			Mage::getSingleton('adminhtml/session')->addSuccess($message);
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
		$this->_redirect('*/*');		
    }
    public function installAction()
    {
      $post = $this->getRequest()->getPost();
      $message = "";
      try {
      	if (empty($post)) {
                Mage::throwException($this->__('Invalid form data.'));
        }
				$storeId 			= $post['design']['store_id'];
				$InstallBlock 	= $post['design']['install_block'];
				$InstallSlideshow 	= $post['design']['install_slideshow'];
				$stores = array($storeId); 	//Used at all blocks
				$RootCategoryId = Mage::app()->getStore($storeId)->getRootCategoryId();			
				$infinitus_uploaded = false;
				$design = Mage::getModel('core/design_package')->getPackageList();
				foreach ($design as $package){
					if($package == "infinitus") {
						$infinitus_uploaded = true;
						break;
					}
				}
				if (!$infinitus_uploaded){
					Mage::throwException($this->__('Maxxi Theme was not found. Please upload the theme first.'));				
				}					
				if($storeId == 0) {
					$scope = 'default';
				}else{
					$scope = 'stores';
				}
				//Configuration 
				//Design
				Mage::getConfig()->saveConfig('design/package/name', "infinitus", $scope, $storeId);
				Mage::getConfig()->saveConfig('design/theme/template', "maxxi", $scope, $storeId);
				Mage::getConfig()->saveConfig('design/theme/skin', "maxxi", $scope, $storeId);		
				Mage::getConfig()->saveConfig('design/theme/layout', "maxxi", $scope, $storeId);
				Mage::getConfig()->saveConfig('design/theme/default', "maxxi", $scope, $storeId);
				//Coppyright
				Mage::getConfig()->saveConfig('design/footer/copyright', "&copy; 2013 Maxxi Theme. All Rights Reserved.",$scope, $storeId);
				//Header
				Mage::getConfig()->saveConfig('design/header/logo_src', "images/logo.png", $scope, $storeId);
				//Setup Static Block
				if($InstallBlock == 1) {
				//Home page content
				Mage::getConfig()->saveConfig('themeoptions_homepage_content/homepagecontent/first_status', 1, $scope, $storeId);
				Mage::getConfig()->saveConfig('themeoptions_homepage_content/homepagecontent/homerowamount', 1, $scope, $storeId);
				Mage::getConfig()->saveConfig('themeoptions_homepage_content/homepagecontent/homeinfostype_1_1', 2, $scope, $storeId);
				Mage::getConfig()->saveConfig('themeoptions_homepage_content/homepagecontent/homecoltitle_1_1', '', $scope, $storeId);
				Mage::getConfig()->saveConfig('themeoptions_homepage_content/homepagecontent/homecustomblock_1_1', 'home_3_banner', $scope, $storeId);
				
					// Home page 3 banner
					$content = '<div class="col3-set">
<div class="col-1"><img src="{{media url="wysiwyg/01.jpg"}}" alt="" /></div>
<div class="col-2"><img src="{{media url="wysiwyg/01.jpg"}}" alt="" /></div>
<div class="col-3"><img src="{{media url="wysiwyg/01.jpg"}}" alt="" /></div>
</div>';
					$data = array("title" => "Home page 3 banner", 
								  "identifier" => "home_3_banner",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__('Home page 3 banner block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}
					// Custom Tab 1
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Block Custom Tab 1</span> You can put content here</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Custom Tab 1", 
								  "identifier" => "product_custom_tab_1",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Custom Tab 1 block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}
					// Custom Tab 2
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Block Custom Tab 2</span> You can put content here</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Custom Tab 2", 
								  "identifier" => "product_custom_tab_2",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Custom Tab 2 block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}					
					// Details product right
					$content = '<p style="text-align: center;"><img src="{{media url="wysiwyg/detail-sample1_1.jpg"}}" alt="" /></p>
<p style="text-align: center;"><img src="{{media url="wysiwyg/detail-sample2_1.jpg"}}" alt="" /></p>';
					$data = array("title" => "Details product right", 
								  "identifier" => "detail_product_right",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Details product right block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}						
					// Block Top Left
					$content = '<p>Call Us +001 555 801</p>';
					$data = array("title" => "Block Top Left", 
								  "identifier" => "block-top-left",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block Top Left block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
					// Block Custom Menu
					$content = '<div class="col4-set">
<div class="col-1">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce suscipit bibendum risus, eget faucibus sapien cursus quis. Integer ultrices tempor sapien, quis mollis elit ornare at.</p>
</div>
<div class="col-2">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce suscipit bibendum risus, eget faucibus sapien cursus quis. Integer ultrices tempor sapien, quis mollis elit ornare at.</p>
</div>
<div class="col-3">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce suscipit bibendum risus, eget faucibus sapien cursus quis. Integer ultrices tempor sapien, quis mollis elit ornare at.</p>
</div>
<div class="col-4">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce suscipit bibendum risus, eget faucibus sapien cursus quis. Integer ultrices tempor sapien, quis mollis elit ornare at.</p>
</div>
</div>';
					$data = array("title" => "Block Custom", 
								  "identifier" => "block_custom_menu",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__('Custom Menu block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
					// Block Inner Category Page
					$content = '<div class="col3-set">
<div class="col-1"><img src="{{media url="wysiwyg/sam.jpg"}}" alt="" /></div>
<div class="col-2"><img src="{{media url="wysiwyg/sam.jpg"}}" alt="" /></div>
<div class="col-3"><img src="{{media url="wysiwyg/sam.jpg"}}" alt="" /></div>
</div>';
					$data = array("title" => "Block Inner Category Page", 
								  "identifier" => "block_inner_category_page",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block Inner Category Page created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
					// Custom Slidebar 1
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Maxxi</span> Responsive Magento Theme</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Custom Slidebar 1", 
								  "identifier" => "block_custom_slidebar_1",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Custom Slidebar 1 block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}											
					// Custom Slidebar 2
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Maxxi</span> Responsive Magento Theme</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Custom Slidebar 2", 
								  "identifier" => "block_custom_slidebar_2",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Custom Slidebar 2 block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
					// Custom Slidebar 3
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Maxxi</span> Responsive Magento Theme</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Custom Right Slidebar", 
								  "identifier" => "block_custom_slidebar_3",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Custom Slidebar 2 block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
					// Block Detail product page 1
					$content = '<div style="background-color: #f5f5f5; padding: 10px; margin-bottom: 10px; margin-top: 10px;"><span class="icon-shipping">shipping</span>This product <strong><span style="color: #ca3400; text-transform: uppercase;">Shiping Free</span></strong></div>';
					$data = array("title" => "Block Detail product page 1", 
								  "identifier" => "block_detail_product_page_1",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block Detail product page 1 created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}						
					// Block Detail product page 2
					$content = '<div style="border-top: #f5f5f5 solid 1px; border-bottom: #f5f5f5 solid 1px; padding: 10px; margin-bottom: 10px; margin-top: 10px;"><img style="float: left; padding-right: 10px; margin-top: -20px;" src="http://nunakidz.com/demo/bigstore/media/wysiwyg/sample-seal.png" alt="" /> We guarantee that We is authorized to sell this product and that every brand we sell is authentic.</div>';
					$data = array("title" => "Block Detail product page 2", 
								  "identifier" => "block_detail_product_page_2",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block Detail product page 2 created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}												
					// Block cart below total
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Block Under Cart Page</span> You can put content here</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Block cart below total", 
								  "identifier" => "block_cart_below_total",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block cart below total created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
					// Block replace Crossel
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Block Replace Block Crosssel</span> You can put content here</p>
</div>';
					$data = array("title" => "Block replace Crossel", 
								  "identifier" => "block_replace_crosssel",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block replace Crossel bottom created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}															
					// Bock checkout top
					$content = '<div class="maxxi-static-block-box" style="margin-bottom: 10px;">
<p><span class="focus">Bock checkout top</span> You can put content here</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Bock checkout top", 
								  "identifier" => "block_checkout_top",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Bock checkout top created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}		
					// Block checkout bottom
					$content = '<div class="maxxi-static-block-box" style="margin-bottom: 10px;">
<p><span class="focus">Bock checkout bottom</span> You can put content here</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Block checkout bottom", 
								  "identifier" => "block_checkout_bottom",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block checkout bottom created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}					
					// Block checkout right top
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Maxxi</span> Responsive Magento Theme</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Block checkout right top", 
								  "identifier" => "block_checkout_right_top",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block checkout right top created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}																
					// Block checkout right bottom
					$content = '<div class="maxxi-static-block-box">
<p><span class="focus">Maxxi</span> Responsive Magento Theme</p>
<p><button class="button" title="Shopping Now" onclick="window.location=\'#\';" type="button"><span><span>Shopping Now</span></span></button></p>
</div>';
					$data = array("title" => "Block checkout right bottom", 
								  "identifier" => "block_checkout_right_bottom",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block checkout right bottom created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
					//Call info
					$content = '<div class="call-info-icon">&nbsp;</div>
<div class="call-info-content">(055) 18-32-195-98 <br /> (055) 18-32-195-98</div>';
					$data = array("title" => "Call info", 
								  "identifier" => "call_info",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Call info block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}			
					//Shipping Info
					$content = '<div class="shipping-info-icon">&nbsp;</div>
<div class="shipping-info-content">Free Shipping <br /> <span>On Order Over $99.00</span></div>';
					$data = array("title" => "Shipping Info", 
								  "identifier" => "shipping_info",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Shipping Info block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
					//Footer right
					$content = '<div class="social-links">
<h4>FLLOW US</h4>
<ul>
<li><a class="facebook" href="#"><span>facebook</span></a></li>
<li><a class="twitter" href="#"><span>twitter</span></a></li>
<li><a class="youtube" href="#"><span>youtube</span></a></li>
<li class="last"><a class="rss" href="#"><span>rss</span></a></li>
</ul>
</div>
<div class="payment-methods">
<h4>CONNECT PAYMENT</h4>
<div class="connect-payment">&nbsp;</div>
</div>';
					$data = array("title" => "Footer right", 
								  "identifier" => "aditional_footer_right",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Footer right block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}																								
					//Bottom menu
					$content = '<div class="bottom-menu-column">
<div class="shippingpolicy" style="width: 140px; float: left;">
<h4>Our Offers</h4>
<ul class="bottom-menu">
<li><a href="#">New products</a></li>
<li><a href="#">Top sellers</a></li>
<li><a href="#">Specials</a></li>
<li><a href="#">Manufacturers</a></li>
<li><a href="#">Suppliers</a></li>
<li><a href="#">Specials</a></li>
<li><a href="#">Service</a></li>
</ul>
</div>
<div class="shippingpolicy" style="width: 150px; float: left;">
<h4>Shipping Info</h4>
<ul class="bottom-menu">
<li><a href="#">Returns</a></li>
<li><a href="#">Delivery</a></li>
<li><a href="#">Service</a></li>
<li><a href="#">Gift Cards</a></li>
<li><a href="#">Mobile</a></li>
<li><a href="#">Gift Cards</a></li>
<li><a href="#">Manufacturers</a></li>
</ul>
</div>
<div class="shippingpolicy" style="width: 150px; float: left;">
<h4>Our Account</h4>
<ul class="bottom-menu">
<li><a href="#">Your Account</a></li>
<li><a href="#">information</a></li>
<li><a href="#">Addresses</a></li>
<li><a href="#">Discount</a></li>
<li><a href="#">Orders history</a></li>
<li><a href="#">Addresses</a></li>
<li><a href="#">Search Terms</a></li>
</ul>
</div>
</div>';
					$data = array("title" => "Bottom menu", 
								  "identifier" => "aditional_footer_left",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Bottom menu block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}							
	// Block top cart
					$content = '<p><img src="{{media url="wysiwyg/vseal.gif"}}" alt="" /></p>';
					$data = array("title" => "Block Top cart", 
								  "identifier" => "block_top_cart",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block Top cart created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
	// Block contact top
					$content = '<div class="col2-set">
<div class="col-1">
<h3>Address &amp; Directions:</h3>
We are moving to a new location and will update the contact information very soon.</div>
<div class="col-1">
<h3>Media Contact</h3>
<p>If you are interested in working with us and want to hold the beauty of our work in your own hands, simply request a FO Promo Box. We&rsquo;ll send you a copy of it, directly to your doorstep.</p>
</div>
</div>';
					$data = array("title" => "Block Contact Top", 
								  "identifier" => "block_contact_top",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block Contact Top created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}		
	// Block contact bottom
					$content = '<h3>Maps</h3>
<p><img src="{{media url="wysiwyg/map.jpg"}}" alt="" /></p>';
					$data = array("title" => "Block Contact Bottom", 
								  "identifier" => "block_contact_bottom",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block Contact Bottom created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
	// Block header right
					$content = '<p><img src="{{media url="wysiwyg/freeshipping.png"}}" alt="" /></p>';
					$data = array("title" => "Block Header Right", 
								  "identifier" => "block_header_right",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block header right created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}		
	// Block bottom right
					$content = '<p><img src="{{media url="wysiwyg/connect-payment.png"}}" alt="" /></p>';
					$data = array("title" => "Block Bottom Right", 
								  "identifier" => "block_bottom_right",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block header right created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}			
	// Block About Box
					$content = '<h4>ABOUT RESPONSIVE THEME</h4>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo, quis pretium turpis neque eget nulla. Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo,</p>
<p><a href="#"><span>BUY THIS THEME</span></a></p>';
					$data = array("title" => "Block About Box", 
								  "identifier" => "block_about_box",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}		
	// Block Contact Box
					$content = '<h4>Contact us</h4>
<p class="phone">Phone: 8(802)234-5678, 8(803)234-5678</p>
<p class="fax">Fax: 8(800)234-5678</p>
<p class="support">Support: <span>support@shop.com</span> Sale: <span>sales@shop.com</span></p>
<ul class="social-icons">
<li class="facebook"><a href="#"><img src="{{media url="wysiwyg/facebook_1.png"}}" alt="" /></a></li>
<li class="twitter"><a href="#"><img src="{{media url="wysiwyg/twitter.png"}}" alt="" /></a></li>
<li class="youtube"><a href="#"><img src="{{media url="wysiwyg/youtube_1.png"}}" alt="" /></a></li>
<li class="linkedin"><a href="#"><img src="{{media url="wysiwyg/linkedin.png"}}" alt="" /></a></li>
<li class="googleplus"><a href="#"><img src="{{media url="wysiwyg/googleplus.png"}}" alt="" /></a></li>
</ul>';
					$data = array("title" => "Block Contact Box", 
								  "identifier" => "block_contact_box",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}	
	// Block Brand list
					$content = '<ul class="slides">
<li><img src="{{media url="wysiwyg/logo1.png"}}" alt="" /></li>
<li><img src="{{media url="wysiwyg/logo2.png"}}" alt="" /></li>
<li><img src="{{media url="wysiwyg/logo3.png"}}" alt="" /></li>
<li><img src="{{media url="wysiwyg/logo04.png"}}" alt="" /></li>
<li><img src="{{media url="wysiwyg/logo05.png"}}" alt="" /></li>
<li><img src="{{media url="wysiwyg/logo06.png"}}" alt="" /></li>
</ul>';
					$data = array("title" => "Block Brand list", 
								  "identifier" => "block_brand_list",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}			
	// Block Brand list
					$content = '<ul>
<li><img src="{{media url="wysiwyg/block_home_banner_right_1.jpg"}}" alt="" /> <a href="#"><span>Buy this</span> Theme</a></li>
<li><img src="{{media url="wysiwyg/block_home_banner_right_2.jpg"}}" alt="" /> <a href="#"><span>Buy this</span> Theme</a></li>
<li><img src="{{media url="wysiwyg/block_home_banner_right_3.jpg"}}" alt="" /> <a href="#"><span>Buy this</span> Theme</a></li>
</ul>';
					$data = array("title" => "Block 3 Banner right", 
								  "identifier" => "block_3_home_banner_right",
								  "stores" => $stores, 
								  "is_active" => 1, 
								  "content" => $content);
					$model = Mage::getModel('cms/block'); // loads cms/block model
					$model->setData($data); // add data to a model
		      try {
						$model->save();				      
						$message .= $this->__(' Block created.');
		      } catch (Exception $e){
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						$this->_redirect('*/*');
						return;
					}																						
         //End Setup Static Block					
				}
if($InstallSlideshow==1) {
					// Home page slideshow
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/status', 1, $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/slideshow_type', 1, $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_1', 'Sample Slide Title 1', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_1', 'sample/default/01.jpg', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_1', '', $scope, $storeId);
		
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_2', 'Sample Slide Title 2', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_2', 'sample/default/01.jpg', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_2', '', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_3', 'Sample Slide Title 3', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_3', 'sample/default/01.jpg', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_3', '', $scope, $storeId);				
}				
if($InstallSlideshow==2) {
					// Home page slideshow
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/status', 1, $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/slideshow_type', 3, $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_1', 'Sample Slide Title 1', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_1', 'sample/flexslider/01.jpg', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_1', '', $scope, $storeId);
		
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_2', 'Sample Slide Title 2', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_2', 'sample/flexslider/01.jpg', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_2', '', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_3', 'Sample Slide Title 3', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_3', 'sample/flexslider/01.jpg', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_3', '', $scope, $storeId);				
				}			
						
				if($InstallSlideshow==3) {
											// Home page slideshow
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/status', 1, $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryinfotype', 2, $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/slideshow_type', 1, $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_1', 'Sample Slide Title 1', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_1', 'sample/04.png', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_1', '', $scope, $storeId);
		
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_2', 'Sample Slide Title 2', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_2', 'sample/04.png', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_2', '', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetitle_3', 'Sample Slide Title 3', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimage_3', 'sample/04.png', $scope, $storeId);
						Mage::getConfig()->saveConfig('themeoptions_homepage/homepage_gallery/homegalleryimagetext_3', '', $scope, $storeId);				
				}				
				
				$model = Mage::getModel('core/store');
				$storeName = Mage::getModel('core/store')->load($storeId)->getName();
				$storeCode = Mage::getModel('core/store')->load($storeId)->getCode();
				$store = Mage::app()->getStore($storeId);
			
				$message = $this->__('Maxxi Theme was successfully installed on <i>'.$storeName.'</i>!');
        Mage::getSingleton('adminhtml/session')->addSuccess($message);
      } catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
      }
      $this->_redirect('*/*');
		}    
}