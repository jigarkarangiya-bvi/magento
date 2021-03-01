<?php
namespace Brainvire\ContactBook\Model\Api\Data;


interface ContactBookManagementInterface
{
    const CONTACT_ID = 'contact_id';

    const NAME = 'name';

    const MOB_NUM = 'mob_num';

    public function getContactId();


    public function setContactId($contact_id);

    public function getName();

    public function setName($name);

    public function getMobNum();

    public function setMobNum($mob_num);
}