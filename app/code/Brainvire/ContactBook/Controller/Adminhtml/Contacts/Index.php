<?php

namespace Brainvire\ContactBook\Controller\Adminhtml\Contacts;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Brainvire_ContactBook::contactbook');
        $resultPage->addBreadcrumb(__('Contacts'), __('Contacts'));
        $resultPage->getConfig()->getTitle()->prepend(__('All Contacts'));
 
        return $resultPage;
	}


}