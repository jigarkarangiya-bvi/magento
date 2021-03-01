<?php
namespace Brainvire\ContactBook\Controller\Adminhtml\Contacts;
 
use Magento\Backend\App\Action;
 
class Save extends Action
{
    /**
     * @var \Brainvire\ContactBook\Model\Contacts
     */
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
    
 
    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Brainvire\ContactBook\Model\Contacts $model */
            $model = $this->_model;
 
            $contact_id = $this->getRequest()->getParam('contact_id');
            if ($contact_id) {
                $model->load($contact_id);
            }
 
            $model->setData($data);
 
            $this->_eventManager->dispatch(
                'contactbook_contacts_prepare_save',
                ['contacts' => $model, 'request' => $this->getRequest()]
            );
 
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Contacts saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['contact_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the department'));
            }
 
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['contact_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
