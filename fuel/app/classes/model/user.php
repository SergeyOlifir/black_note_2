<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.6
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */
class Model_User extends \Auth\Model\Auth_User {

    protected static $_has_many = array(
        'images' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Images',
            'key_to' => 'user_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
        'events' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Event',
            'key_to' => 'user_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );
    protected static $_many_many = array(
        'joined_events' => array(
            'table_through' => 'events_in_guests',
            'key_from' => 'id',
            'key_through_from' => 'user_id',
            'key_through_to' => 'event_id',
            'model_to' => 'Model_Event',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
        'roles' => array(
            'key_from' => 'id',
            'model_to' => 'Model\\Auth_Role',
            'key_to' => 'id',
            'table_through' => null,
            'key_through_from' => 'user_id',
            'key_through_to' => 'role_id',
        ),
        'permissions' => array(
            'key_from' => 'id',
            'model_to' => 'Model\\Auth_Permission',
            'key_to' => 'id',
            'table_through' => null,
            'key_through_from' => 'user_id',
            'key_through_to' => 'perms_id',
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

}
