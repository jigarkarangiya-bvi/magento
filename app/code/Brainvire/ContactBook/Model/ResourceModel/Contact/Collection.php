<?php
namespace Brainvire\ContactBook\Model\ResourceModel\Contact;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    
    public function _construct()
    {
        $this->_init(
            \Brainvire\ContactBook\Model\Contact::class,
            \Brainvire\ContactBook\Model\ResourceModel\Contact::class
        );
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }
}
