<?php

namespace Fuel\Migrations;

class Add_field_to_post
{
	public function up()
	{
            \DBUtil::add_fields('posts', array(
                'object' => array('constraint' => 11, 'type' => 'int'),
            ));
		
	}

	public function down()
	{
		\DBUtil::drop_fields('posts', 'object');
	}
}