

<?php
  $_product = $this->getProduct();
  $_helper = $this->helper('catalog/output');
  $slideshow_enable = intval(Mage::getStoreConfig('imagezoomconfig/general/slideshow_enable'));
	$images_to_show = Mage::getStoreConfig('imagezoomconfig/imagezoom_images/imagesToShow');
	$images_to_show = $images_to_show != '' ? $images_to_show : 999;
	$main_image_product_width = intval(Mage::getStoreConfig('themeoptions_general/prodcuts_details_page/product_main_width'));
	if(!$main_image_product_width) {
		$main_image_product_width = 326;
	}
	$main_image_product_height = intval(Mage::getStoreConfig('themeoptions_general/prodcuts_details_page/product_main_height'));
	if(!$main_image_product_height) {
		$main_image_product_height = 370;
	}
	$thumb_image_product_width = intval(Mage::getStoreConfig('themeoptions_general/prodcuts_details_page/product_thumbnail_width'));
	if(!$thumb_image_product_width) {
		$thumb_image_product_width = 65;
	}
	$thumb_image_product_height = intval(Mage::getStoreConfig('themeoptions_general/prodcuts_details_page/product_thumbnail_height'));
	if(!$thumb_image_product_height) {
		$thumb_image_product_height = 74;	
	}
	$img_arr = array();
	if ($_product->getTypeId() == 'configurable') {
		
		$_childProducts = Mage::getModel('catalog/product_type_configurable')->getUsedProductCollection($_product);
		
		if (count($_childProducts) > 0) {
			$cnt = 0;
			$js = '';
			foreach ($_childProducts as $_child) {
				$_child_images = $this->helper('imagezoom')->getAllImages($_child);
				foreach($_child_images as $_child_image) {
					$img_arr[$cnt] = array(
										'id' => $_child->getId(),
										'small_image' => (string)$this->helper('catalog/image')->init($this->getProduct(), 'thumbnail', $_child_image->getFile())->resize($zoom_image_size),
										'big_image' => (string)$this->helper('catalog/image')->init($this->getProduct(), 'image', $_child_image->getFile()),
										'thumb' => (string)$this->helper('catalog/image')->init($this->getProduct(), 'thumbnail', $_child_image->getFile())->resize(56),
										'label' => (string)$this->htmlEscape($_child_image->getLabel()),
										'main_image' => (string)$_child_image['main_image']
									);
					$cnt++;
				}
			}
		}
	
		
	
	} else if($_product->getTypeId() == 'grouped') { //TODO
		//$_childProducts = $_product->getTypeInstance()->getAssociatedProducts();
	}	

?>   
<script type="text/javascript">
  var assocIMG = { // Added
  <?php
  	if(isset($img_arr) && count($img_arr) > 0) {
		$dados = array();
		foreach ($img_arr as $img) {
			if ($img['main_image']) {
				$dados[] = "small_image_".$img['id'].":'".$img['small_image']."'";
				$dados[] = "big_image_".$img['id'].":'".$img['big_image']."'";
			}
		}
	  	echo implode(',', $dados );   
	}
  ?>
  }   
</script>

<script type="text/javascript">
	function jSelectImage(id) {
		hideSelected(id);
		
		if (assocIMG['big_image_'+id] && assocIMG['small_image_'+id]) {
			// Destroy the previous zoom
			jQuery('#image-zoom').data('zoom').destroy();
			// Change the biglink to point to the new big image.
			jQuery('#image-zoom').attr('href', assocIMG['big_image_'+id]);
			// Change the small image to point to the new small image.
			jQuery('#image-zoom img').attr('src', assocIMG['small_image_'+id]);
			// Init a new zoom with the new images.				
			jQuery('#image-zoom').CloudZoom();
			//console.log('yes')
		}
	}
	
	function hideSelected(id) {
		console.log(id);
		var add = $$('.more-views li.add');
		if (add && add.length > 0) {
			$('show-all').show();
			add.each(function(item,i){
				item.hide();
				var className = 'item-'+id;
				
				if (item.hasClassName(className)){
					item.show();
				}
			})
		}
	}
	
	function showAll() {
		var add = $$('.more-views li.add');
		if (add && add.length > 0) {
			$('show-all').hide();
			add.each(function(item,i){
				item.show();				
			})
		}	
	}
	jQuery(document).ready(function(){
		jQuery(".colorbox-group").colorbox({rel:'colorbox-group',opacity:0.5});
	});
	jQuery(function(jQuery) {
		jQuery('.itemslider-thumbnails').flexslider({
			namespace: "thumb-list-",
			animation: "slide",
			easing: "easeInQuart",
			animationSpeed: 300,
			animationLoop: false,
			slideshow: false,			
			pauseOnHover: true,
			controlNav: false,
			itemWidth: 77,
			move: 1
		});
	});	
</script>
<?php 
	$sale = false;
	$new_label = Mage::getStoreConfig('themeoptions_general/prodcuts_list_page/new_product_label', $storeId);
	$new_position = Mage::getStoreConfig('themeoptions_general/prodcuts_list_page/new_product_label_position', $storeId);
	$sale_label = Mage::getStoreConfig('themeoptions_general/prodcuts_list_page/sale_product_label', $storeId);
	$sale_position = Mage::getStoreConfig('themeoptions_general/prodcuts_list_page/sale_product_label_position', $storeId);
	if ($new_label)
	{
		$specialPrice = number_format($_product->getFinalPrice(), 2);
		$regularPrice = number_format($_product->getPrice(), 2);
		if ($specialPrice != $regularPrice){
	       	$sale = true;
		}
	}
    
	$new = false;
	if ($sale_label)
	{
        $now = date("Y-m-d H:m:s");   
        $newFromDate = $_product->getNewsFromDate();
        $newToDate = $_product->getNewsToDate();                                               
        if($newFromDate < $now && $newToDate > $now){
            $new = true;
        }
	}
    
    if($new){
        ?>
            <div class="infinitus-label detail-label new-<?php echo $new_position?>" style="z-index:999"><?php echo $this->__('New') ?></div>
        <?php
    }
    
    if($sale){
        ?>
            <div class="infinitus-label detail-label sale-<?php echo $sale_position?>" style="z-index:999"><?php echo $this->__('Sale') ?></div>
        <?php
    }
?>
<p class="product-image">
    <a href="<?php echo $this->helper('catalog/image')->init($_product, 'image'); ?>" class="cloud-zoom" id="image-zoom" rel="<?php echo $this->helper('imagezoom')->getZoomConfig(); ?>">
	<?php
        $_img = '<img src="'.$this->helper('catalog/image')->init($_product, 'image')->resize($main_image_product_width,$main_image_product_height).'" alt="'.$this->htmlEscape($this->getImageLabel()).'" title="'.$this->htmlEscape($this->getImageLabel()).'" />';
        echo $_helper->productAttribute($_product, $_img, 'image');
    ?>
	</a>
	<?php if($slideshow_enable):?>
	<a class="zoom-image colorbox-group cboxElement" title="<?php echo $this->htmlEscape($this->getImageLabel());?>" href="<?php echo $this->helper('catalog/image')->init($_product, 'image'); ?>">Zoom Image</a>
	<?php endif;?>
</p>


<?php if (count($this->getGalleryImages()) > 0 || (isset($_childProducts) && count($_childProducts) > 0) ): ?>
<div class="more-view-title">More View</div>
<div class="more-views">
<div class="itemslider-thumbnails more-views-col4">
    <ul class="slides">
    <?php foreach ($this->getGalleryImages() as $_image): ?>
        <li>
            <a href="<?php echo $this->helper('catalog/image')->init($this->getProduct(), 'image', $_image->getFile()); ?>" class="cloud-zoom-gallery colorbox-group cboxElement" title="<?php echo $this->htmlEscape($_image->getLabel()) ?>"
				rel="useZoom: 'image-zoom', smallImage: '<?php  echo $this->helper('catalog/image')->init($this->getProduct(), 'thumbnail', $_image->getFile())->resize($main_image_product_width,$main_image_product_height) ?>'" >
				<img src="<?php  echo $this->helper('catalog/image')->init($this->getProduct(), 'thumbnail', $_image->getFile())->resize($thumb_image_product_width,$thumb_image_product_height) ?>" alt="<?php echo $this->htmlEscape($_image->getLabel()) ?>" />
			</a>
        </li>
    <?php endforeach; ?>
	<?php if (isset($_childProducts) && count($_childProducts) > 0):?>
		<?php $cnt = 0; ?>
		<?php foreach ($img_arr as $img): ?>
        <li class="add item-<?php echo $img['id']; ?>">
            <a href="<?php echo $img['big_image']; ?>" class="cloud-zoom-gallery colorbox-group cboxElement" title="<?php echo $img['label'] ?>"
				rel="useZoom: 'image-zoom', smallImage: '<?php  echo $img['small_image']; ?>'" >
				<img src="<?php  echo $img['thumb']; ?>" alt="<?php echo $img['label'] ?>" />
			</a>
        </li>	
		<?php $cnt++; ?>	
		<?php endforeach; ?>
	<?php endif; ?>
    </ul>
</div>	
</div>
<?php endif; ?>