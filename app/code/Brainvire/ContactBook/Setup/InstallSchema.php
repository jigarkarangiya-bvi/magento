<?php

namespace Brainvire\ContactBook\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface {

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context) {
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('brainvire_contactbook_contacts')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('brainvire_contactbook_contacts')
			)
				->addColumn(
					'contact_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary' => true,
						'unsigned' => true,
					],
					'Contact ID'
				)
				->addColumn(
					'name',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Contact Name'
				)
				->addColumn(
					'mob_num',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Mobile Number'
				)
				->addColumn(
					'created_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
					'Created At'
				)->addColumn(
				'updated_at',
				\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
				null,
				['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
				'Updated At')
				->setComment('Contact Table');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('brainvire_contactbook_contacts'),
				$setup->getIdxName(
					$installer->getTable('brainvire_contactbook_contacts'),
					['name', 'mob_num'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['name', 'mob_num'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}
		$installer->endSetup();
	}
}