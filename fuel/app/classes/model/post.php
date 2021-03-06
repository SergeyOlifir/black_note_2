<?php

class Model_Post extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'type' => array(
                    'data_type' => 'int',
                    'ladel' => 'type',
                    'validation' => array('required')
                ),
                'object' => array(
                    'data_type' => 'int',
                    'ladel' => 'object',
                    'validation' => array('required')
                ),
		'organisation_id' => array(
                    'data_type' => 'int',
                    'ladel' => 'organisation_id',
                    'validation' => array('required')
                ),
		'filial_id',
		'title' => array(
                    'data_type' => 'text',
                    'ladel' => 'title',
                    'validation' => array('required')
                ),
		'user_id',
		'body'  => array(
                    'data_type' => 'text',
                    'ladel' => 'body',
                    'validation' => array('required')
                ),
                'status',
		'created_at',
		'updated_at',
	);
        
        protected static $_belongs_to = array(
            'organisation' => array(
                'key_from' => 'organisation_id',
                'model_to' => 'Model_Organisation',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            'user' => array(
                'key_from' => 'user_id',
                'model_to' => 'Model_User',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            
            'filial' => array(
                'key_from' => 'filial_id',
                'model_to' => 'Model_Filial',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
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
	protected static $_table_name = 'posts';
        
        public static $post_types = array(
            '0' => 'Жалоба',
            '1' => 'Благодарность',
        );
        
        public static $post_objects = array(
            '1' => 'Продавцы',
            '2' => 'Исполнители',
            '3' => 'Работодатели',
            '4' => 'Работники',
            '5' => 'Партнеры',
            '6' => 'Заказчики',
            '7' => 'Покупатели',
        );
        
        public static $post_status = array(
            2 => 'Ожидает Модерации',
            0 => 'Не принятая',
            3 => 'Принятая'
        );

}
