<?php

$this->startSetup();
$table = $this->getConnection()
    ->newTable($this->getTable('vijay_festivalbackgroundimage/festivalbackground'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity'  => true,
            'nullable'  => false,
            'primary'   => true,
        ),
        'Festivalbackground ID'
    )
    ->addColumn(
        'festivalname',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'Festival Name'
    )
    ->addColumn(
        'startdate',
        Varien_Db_Ddl_Table::TYPE_DATETIME, 255,
        array(
            'nullable'  => false,
        ),
        'Festival Start Date'
    )
    ->addColumn(
        'enddate',
        Varien_Db_Ddl_Table::TYPE_DATETIME, 255,
        array(
            'nullable'  => false,
        ),
        'Festival End Date'
    )
	->addColumn(
        'background_target',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'Background Target'
    )
	->addColumn(
        'background_custom_target',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Custom Target'
    )
    ->addColumn(
        'type',
        Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
        	'unsigned'  => true,
            'nullable'  => false,
        ),
        'Background Type'
    )
    ->addColumn(
        'background',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'background'
    )
    ->addColumn(
        'status',
        Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(),
        'Enabled'
    )
    ->addColumn(
        'updated_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Festivalbackground Modification Time'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Festivalbackground Creation Time'
    ) 
    ->setComment('Festivalbackground Table');
$this->getConnection()->createTable($table);
$this->endSetup();
