<?php
namespace Brainvire\ContactBook\Controller\Adminhtml\Contacts;
 
use Magento\Backend\App\Action;
 
class Delete extends Action
{
    protected $_model;
 
    /**
     * @param Action\Context $context
     * @param \Brainvire\ContactBook\Model\Contacts $model
     */
    public function __construct(
        Action\Context $context,
        \Brainvire\ContactBook\Model\Contacts $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }
 
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Brainvire_ContactBook::contacts_delete');
    }
 
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $contact_id = $this->getRequest()->getParam('contact_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($contact_id) {
            try {
                $model = $this->_model;
                $model->load($contact_id);
                $model->delete();
                $this->messageManager->addSuccess(__('Contact deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['contact_id' => $contact_id]);
            }
        }
        $this->messageManager->addError(__('Contact does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}