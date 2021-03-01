<?php
namespace Brainvire\ContactBook\Block;
use Magento\Framework\View\Element\Template;

class ListContacts extends \Magento\Framework\View\Element\Template
{
    private $_contacts;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Brainvire\ContactBook\Model\Contacts $contacts,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_contacts = $contacts;
        $this->_resource = $resource;

        parent::__construct(
            $context,
            $data
        );
    }

    public function getContacts()
    {
        $collection = $this->_contacts->getCollection();
        return $collection;
    }
}
