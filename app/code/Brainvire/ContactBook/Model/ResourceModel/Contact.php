<?php
namespace Brainvire\ContactBook\Model\ResourceModel;

class Contact extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init("brainvire_contactbook_contacts", "contact_id");
    }
}
