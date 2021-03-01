<?php

namespace Brainvire\ContactBook\Api;

interface ContactBookManagementInterface
{
    /**
     * get ContactBook Api data.
     *
     * @api
     *
     * @param int $contact_id
     *
     * @return \Brainvire\ContactBook\Api\Data\ContactBookManagementInterface
     */
    public function getApiData($contact_id);
}