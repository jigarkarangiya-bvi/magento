<?php
namespace Brainvire\ContactBook\Controller\Adminhtml\Contacts;
 
use Magento\Backend\App\Action;
 
class Edit extends Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
 
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;
 
    /**
     * @var \Brainvire\ContactBook\Model\Contacts
     */
    protected $_model;
 
    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Brainvire\ContactBook\Model\Contacts $model
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Brainvire\ContactBook\Model\Contacts $model
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->_model = $model;
        parent::__construct($context);
    }
 
    /**
     * {@inheritdoc}
     */
    
 
    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Brainvire_ContactBook::department')
            ->addBreadcrumb(__('Contacts'), __('Contacts'))
            ->addBreadcrumb(__('Manage Contacts'), __('Manage Contacts'));
        return $resultPage;
    }
 
    /**
     * Edit Contacts
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $contact_id = $this->getRequest()->getParam('contact_id');
        $model = $this->_model;
 
        // If you have got an id, it's edition
        if ($contact_id) {
            $model->load($contact_id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This contact not exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
 
                return $resultRedirect->setPath('*/*/');
            }
        }
 
        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
 
        $this->_coreRegistry->register('contactbook_contacts', $model);
 
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $contact_id ? __('Edit Contact') : __('New Contact'),
            $contact_id ? __('Edit Contact') : __('New Contact')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Contacts'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getName() : __('New Contact'));
 
        return $resultPage;
    }
}