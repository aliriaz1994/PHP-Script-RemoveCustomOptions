<?php
use Magento\Framework\App\Bootstrap;

include 'app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();

$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

$categoryId = 44;
$category = $objectManager->create('\Magento\Catalog\Model\Category')->load($categoryId);
$subcats = $category->getChildrenCategories();
$changeFlag = 0;


foreach ($subcats as $subcat) {
$_category = $objectManager->create('Magento\Catalog\Model\Category')->load($subcat->getId());
//echo "<pre>";print_r($_category);exit;

        //echo $subcat->getId();exit;
    if($subcat->getId() == '2302')    // Shaker Antique, Shaker Cinder Category ID
    {
            $_subcats = $_category->getChildrenCategories();
                foreach ($_subcats as $_subcat) {
                    $_subcategory = $objectManager->create('Magento\Catalog\Model\Category')->load($_subcat->getId());
                    $categoryProducts = $_subcategory->getProductCollection()->addAttributeToSelect('*');
                    foreach ($categoryProducts as $categoryProduct) {
                        $productId = $categoryProduct->getId();
                        //echo $categoryProduct->getId()."<br>";

                        $product = $objectManager->create('\Magento\Catalog\Model\Product')->load($productId);
                        if($productId == '2687'){ $changeFlag = 1; } 
                            
                            if($changeFlag == 1){
                                if ($product->getOptions()) {
                                    foreach ($product->getOptions() as $opt) {
                                        $opt->delete();
                                    }
                                    //$product->setHasOptions(0)->save();
                                }
                            }   
                                          
                    }
                }
    }
}

