<?php

use Orm\Model;

class Model_Images extends Model
{
    protected static $_properties = array(
        'id',
        'event_id',
        'user_id',
        'thumb_small',
        'thumb_middle',
        'thumb_large',
        'thumb_foursquare',
        'origin',
        'comment'
    );
    protected static $_observers = array(
        'Orm\Observer_ImageSaver' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => false,
        )
    );
    
    protected static $_has_one = array(
        'user' => array(
            'key_from' => 'user_id',
            'model_to' => 'Model_User',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
        'event' => array(
            'key_from' => 'event_id',
            'model_to' => 'Model_Event',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );    
    protected static $_table_name = 'images';

}

?>
