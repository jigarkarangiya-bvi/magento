<?php

namespace Brainvire\ContactBook\Controller\Adminhtml\Contacts;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends \Magento\Backend\App\Action
{
    /** @var JsonFactory  */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $contactId) {
                    /** @var \Brainvire\ContactBook\Model\Contacts $model */
                    $model = $this->_objectManager->create('Brainvire\ContactBook\Model\Contacts');
                    $model->load($contactId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$contactId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithContactsId(
                            $model,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param \Brainvire\ContactBook\Model\Contacts $contact
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithContactsId(\Brainvire\ContactBook\Model\Contacts $contact, $errorText)
    {
        return '[Contact ID: ' . $contact->getId() . '] ' . $errorText;
    }

}
