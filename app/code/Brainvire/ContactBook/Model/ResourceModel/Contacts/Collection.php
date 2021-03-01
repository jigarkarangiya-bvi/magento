<?php
namespace Brainvire\ContactBook\Model\ResourceModel\Contacts;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'contact_id';
	protected $_eventPrefix = 'brainvire_contactbook_contacts_collection';
	protected $_eventObject = 'contacts_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Brainvire\ContactBook\Model\Contacts', 'Brainvire\ContactBook\Model\ResourceModel\Contacts');
	}

}