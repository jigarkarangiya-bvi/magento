<?php
namespace Brainvire\ContactBook\Model;
 
use \Magento\Framework\Model\AbstractModel;
 
class Contacts extends AbstractModel
{
    const CONTACT_ID = 'contact_id'; // We define the id fieldname
 
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'contactbook';
 
    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'contacts';
 
    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = self::CONTACT_ID;
 
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Brainvire\ContactBook\Model\ResourceModel\Contacts');
    }
}