<?php

namespace Brainvire\ContactBook\Model\Api;

class ContactBookManagement implements \Brainvire\ContactBook\Api\ContactBookManagementInterface
{
    const SEVERE_ERROR = 0;
    const SUCCESS = 1;
    const LOCAL_ERROR = 2;

    protected $_contactBookFactory;

    public function __construct(
        \Brainvire\ContactBook\Model\ContactBookFactory $contactBookFactory

    ) {
        $this->_contactBookFactory = $contactBookFactory;
    }

    /**
     * get Contact Book Api data.
     *
     * @api
     *
     * @param int $contact_id
     *
     * @return \Brainvire\ContactBook\Api\Data\ContactBookManagementInterface
     */
    public function getApiData($contact_id)
    {
        try {
            $model = $this->_contactBookFactory
                ->create();

            if (!$model->getContactId()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('no data found')
                );
            }

            return $model;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $returnArray['error'] = $e->getMessage();
            $returnArray['status'] = 0;
            $this->getJsonResponse(
                $returnArray
            );
        } catch (\Exception $e) {
            $this->createLog($e);
            $returnArray['error'] = __('unable to process request');
            $returnArray['status'] = 2;
            $this->getJsonResponse(
                $returnArray
            );
        }
    }
}