<?php

class Model_Filial extends \Orm\Model
{
	protected static $_properties = array(
                'id',
		'organisation_id' => array(
                    'data_type' => 'int',
                    'ladel' => 'organisation_id',
                    'validation' => array('required')
                ),
		
		'country_id' => array(
                    'data_type' => 'int',
                    'ladel' => 'country_id',
                    'validation' => array('required')
                ),
		'region_id' => array(
                    'data_type' => 'int',
                    'ladel' => 'region_id',
                    'validation' => array('required')
                ),
		'sity_id' => array(
                    'data_type' => 'int',
                    'ladel' => 'sity_id',
                    'validation' => array('required')
                ),
		'title' => array(
                    'data_type' => 'varchar',
                    'ladel' => 'title',
                    'validation' => array('required', 'min_length' => array(3), 'max_length' => array(50))
                ),
		'user_id',
		'adress' => array(
                    'data_type' => 'varchar',
                    'ladel' => 'adress',
                    'validation' => array('required', 'min_length' => array(3), 'max_length' => array(50))
                ),
		'phone' => array(
                    'data_type' => 'varchar',
                    'ladel' => 'phone',
                    'validation' => array('required', 'min_length' => array(3), 'max_length' => array(50))
                ),
		'ovner' => array(
                    'data_type' => 'varchar',
                    'ladel' => 'ovner',
                    'validation' => array('required', 'min_length' => array(3), 'max_length' => array(50))
                ),
		'logo',
                'status',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);
        
        protected static $_belongs_to = array(
            'country' => array(
                'key_from' => 'country_id',
                'model_to' => 'Model_Country',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            'region' => array(
                'key_from' => 'region_id',
                'model_to' => 'Model_Region',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            'city' => array(
                'key_from' => 'sity_id',
                'model_to' => 'Model_Sity',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            'organisation' => array(
                'key_from' => 'organisation_id',
                'model_to' => 'Model_Organisation',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            )
        );
        
	protected static $_table_name = 'filials';

}
