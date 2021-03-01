<?php
namespace Brainvire\ContactBook\Model;

class Contact extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const NOROUTE_ENTITY_ID = 'no-route';
    const ENTITY_ID = 'contact_id';
    const CACHE_TAG = 'brainvire_contactbook_contacts';
    protected $_cacheTag = 'brainvire_contactbook_contacts';
    protected $_eventPrefix = 'brainvire_contactbook_contacts';
    
    public function _construct()
    {
        $this->_init(\Brainvire\ContactBook\Model\ResourceModel\Contact::class);
    }
    
    public function load($id, $field = null)
    {
        if ($id === null) {
            return $this->noRoute();
        }
        return parent::load($id, $field);
    }
    
    public function noRoute()
    {
        return $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }
}
