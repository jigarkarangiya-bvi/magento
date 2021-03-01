<?php

namespace Brainvire\ContactBook\Model;

class ContactBook implements \Brainvire\ContactBook\Model\Api\Data\ContactBookManagementInterface
{
    public function getContactId()
    {
        return 1;
    }

    public function setContactId($contact_id)
    {
    }

    public function getName()
    {
        return 'this is test name';
    }

    public function setName($name)
    {

    }


    public function getMobNum()
    {
        return 'this is test Mobile Number';
    }

    public function setMobNum($mob_num)
    {

    }
}