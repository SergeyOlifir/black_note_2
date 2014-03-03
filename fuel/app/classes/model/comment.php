<?php

class Model_Comment extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'parent_id',
		'post_id',
		'user_id',
                'comment'
	);
        
        protected static $_belongs_to = array(
            'user' => array(
                'key_from' => 'user_id',
                'model_to' => 'Model_User',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
        );
        
         protected static $_has_many = array(
            'comments' => array(
                'key_from' => 'parent_id',
                'model_to' => 'Model_Comment',
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
	protected static $_table_name = 'comments';

}
