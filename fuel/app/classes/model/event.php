<?php

class Model_Event extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'title',
        'description',
        'user_id',
        'place',
        'start_date',
        'end_date',
        'public',
        'status',
        'code',
        'pakage_id',
        'created_at',
        'updated_at',
    );
    protected static $_has_many = array(
        'images' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Images',
            'key_to' => 'event_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );    
    protected static $_many_many = array(
        'joined_users' => array(
            'table_through' => 'events_in_guests',
            'key_from' => 'id',
            'key_through_from' => 'event_id',
            'key_through_to' => 'user_id',
            'model_to' => 'Model_User',
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
    protected static $_table_name = 'events';

    public static function GenerateKey() {
        return str_replace('.', '-', uniqid('', TRUE));
    }

    public static function FindeByKey($key) {
        return $query = self::query()->where('code', $key)->get_one();
    }

    public static function SortEvents($post=false,$userId) {
            (isset($post['sort']['start_date']) && $post['sort']['start_date'] !='default' ? $date = $post['sort'] : $date = array('id' => 'asc') );
            (isset($post['filter']['public']) && $post['filter']['public'] !='default'? $public = $post['filter']['public'] : $public = 1 );
            (isset($post['filter']['status']) && $post['filter']['status'] !='default'? $status = $post['filter']['status'] : $status = 'draft' );
            (isset($post['search'])? $search = $post['search'] : $search = '' );
            
            $result = Model_Event::find('all', array(
                'order_by' => $date,
                'where' => array(
                    array('user_id', '=', $userId),
                    array('public', '=', $public),
                    array('status', '=', $status),
                    array('title', 'LIKE', '%'.$search.'%'),
                ),
            ));
            return $result;       
    }

    public static function listEvenst() {
        return Model_Event::find('all');
    }

    public function JoinUserToEvent($model_user = null) {
        if (in_array($model_user, $this->joined_users)) {
            return false;
        } else {
            $model_user->joined_events[] = $this;
            $model_user->save();
            return true;
        }
    }

}
