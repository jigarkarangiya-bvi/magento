<?php
namespace Brainvire\ContactBook\Block;

class FeaturedProducts extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context, 
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;        
        $this->catalogProductVisibility = $catalogProductVisibility;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getProducts()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection = $this->_productCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_featured', '1')
            ->addCategoriesFilter(['in' => '4']);
        $collection->setVisibility($this->catalogProductVisibility->getVisibleInCatalogIds());
        return $collection;
    }   

}