<?php

class Model_Organisation extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'organisation_type' => array(
                    'data_type' => 'int',
                    'ladel' => 'organisation_type',
                    'validation' => array('required')
                ),
		'sfera_type' => array(
                    'data_type' => 'int',
                    'ladel' => 'sfera_type',
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
                'raiting',
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
            )
        );
        
        protected static $_has_many = array(
            'filials' => array(
                'key_from' => 'id',
                'model_to' => 'Model_Filial',
                'key_to' => 'organisation_id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            
            'posts' => array(
                'key_from' => 'id',
                'model_to' => 'Model_Post',
                'key_to' => 'organisation_id',
                'cascade_save' => true,
                'cascade_delete' => false,
            )
        );
        
	protected static $_table_name = 'organisations';
        
        public static $organisation_types = array(
            '0' => array(
                    'title' => 'Организация или частное лицо',
                    'id' => '0'
                ),
            '1' => array(
                    'title' => 'Государственное учреждение',
                    'id' => '1'
                )
        );
        
        public function unmoderated_filials() {
            return Model_Filial::query()
                    ->where('organisation_id', $this->id)
                    ->where('status', 1)
                    ->get();
        }


        public static $organisation_sferes_types = array(
            '0' => array(
                '0' => array(
                    'title' => 'OrganisationSfera0',
                    'id' => '0'
                ),
                '1' => array(
                    'title' => 'OrganisationSfera1',
                    'id' => '1'
                ),
                '2' => array(
                    'title' => 'OrganisationSfera2',
                    'id' => '2'
                )
            ),
            
            '1' => array(
                '0' => array(
                    'title' => 'GosSfera0',
                    'id' => '0'
                ),
                '1' => array(
                    'title' => 'GosSfera1',
                    'id' => '1'
                ),
                '2' => array(
                    'title' => 'GosSfera2',
                    'id' => '2'
                )
            )
        );
        
        public static $organisation_status = array(
            1 => 'Ожидает Модерации',
            0 => 'Не принятая',
            2 => 'Принятая'
        );

}
