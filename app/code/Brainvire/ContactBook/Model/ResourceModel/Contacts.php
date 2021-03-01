<?php

namespace Brainvire\ContactBook\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contacts extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('brainvire_contactbook_contacts', 'contact_id');
    }
}