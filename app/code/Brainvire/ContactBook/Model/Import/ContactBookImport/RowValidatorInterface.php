<?php
namespace Brainvire\ContactBook\Model\Import\ContactBookImport;
interface RowValidatorInterface extends \Magento\Framework\Validator\ValidatorInterface
{
       const ERROR_NAME_IS_EMPTY = 'EmptyName';
    /**
     * Initialize validator
     *
     * @return $this
     */
    public function init($context);
}