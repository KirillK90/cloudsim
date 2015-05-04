<?php

class m141226_103928_create_users extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable('users', array(
			'id' => 'pk',
			'created' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'email' => 'varchar(64) NOT NULL',
			'name' => 'varchar(32) NOT NULL',
			'password' => 'varchar(32) NOT NULL',
			'role' => 'varchar(32) NOT NULL',
            'activation_key' => 'varchar(32) NOT NULL',
            'status' => 'boolean NOT NULL DEFAULT false',
		), 'engine=InnoDB');

		$this->createIndex('users_email_idx','users','email', true);
	}

	public function safeDown()
	{
		$this->dropTable('users');
	}
}