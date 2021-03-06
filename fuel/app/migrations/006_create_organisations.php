<?php

namespace Fuel\Migrations;

class Create_organisations
{
	public function up()
	{
		\DBUtil::create_table('organisations', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'organisation_type' => array('constraint' => 11, 'type' => 'int'),
			'sfera_type' => array('constraint' => 11, 'type' => 'int'),
			'country_id' => array('constraint' => 11, 'type' => 'int'),
			'region_id' => array('constraint' => 11, 'type' => 'int'),
			'sity_id' => array('constraint' => 11, 'type' => 'int'),
			'title' => array('constraint' => 50, 'type' => 'varchar'),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'adress' => array('constraint' => 50, 'type' => 'varchar'),
			'phone' => array('constraint' => 50, 'type' => 'varchar'),
			'ovner' => array('constraint' => 100, 'type' => 'varchar'),
			'logo' => array('type' => 'text', 'null' => true),
                        'status' => array('type' => 'int'),
                        'raiting' => array('type' => 'int', 'default' => 0),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('organisations');
	}
}