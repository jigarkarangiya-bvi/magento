<?php
namespace Brainvire\ContactBook\Block;

class ContactList extends \Magento\Framework\View\Element\Template
{
    public $contactCollection;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Brainvire\ContactBook\Model\ResourceModel\Contact\CollectionFactory $contactCollection,
        array $data = []
    ) {
        $this->contactCollection = $contactCollection;
        parent::__construct($context, $data);
    }

    public function getContacts()
    {
        $collection = $this->contactCollection->create();
        return $collection;
    }
}