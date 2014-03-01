<?php

class Model_Country extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
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
	protected static $_table_name = 'countries';
        
        protected static $_has_many = array(
            'regions' => array(
                'key_from' => 'id',
                'model_to' => 'Model_Region',
                'key_to' => 'country_id',
                'cascade_save' => true,
                'cascade_delete' => false,
            )
        );
        
        public static function get_array_for_select() {
            $countrys = self::find('all');
            $result = array();
            foreach ($countrys as $country) {
                $result[$country->id] = $country->title;
            }
            
            return $result;
        }

}
