<?php

class m150523_190433_task extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this -> createTable('task',array(
            'id'=> 'pk',
            'users_id' => 'integer NOT NULL',
            'name' => 'string NOT NULL',
            'type' => 'string NOT NULL',
            'status' => 'string NOT NULL',
            'created' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',

        ),'engine=InnoDB');

        $this -> createTable('task_data',array(
            'id' => 'pk',
            'task_id' => 'INTEGER NOT NULL',
            'description' => 'string NOT NULL',
            'index_nano_n' => 'INTEGER NOT NULL',
            'index_nano_m' => 'INTEGER NOT NULL',
            'length_link' =>  'FLOAT NOT NULL',
            'indent_radius_inside' => 'FLOAT NOT NULL',
            'indent_radius_outwards' => 'FLOAT NOT NULL',
            'nuclear_charge'=> 'INTEGER NOT NULL',
            'valence_electrons'=> 'INTEGER NOT NULL',
            's_orbital'=> 'FLOAT NOT NULL',
            'p_orbital'=> 'FLOAT NOT NULL',
            'd_orbital'=> 'FLOAT NOT NULL',
            'f_orbital'=> 'FLOAT NOT NULL',
            'g_orbital'=> 'FLOAT NOT NULL',
            'auto_calculate'=> 'BOOLEAN NOT NULL',
            'max_energy'=> 'INTEGER NOT NULL',
            'accuracy_calculation'=> 'FLOAT NOT NULL',
            'number_points'=> 'INTEGER NOT NULL',
            'calculation_zone' => 'BOOLEAN NOT NULL',
            'max_energy_graph'=> 'INTEGER NOT NULL',
            'min_energy_graph'=> 'INTEGER NOT NULL',
            'time_calculation'=> 'INTEGER NOT NULL',

        ), 'engine=InnoDB');

        $this->addForeignKey('task_data_task_id_fkey', 'task_data', 'task_id', 'task', 'id', 'CASCADE');
	}

	public function safeDown()
	{
        $this->dropForeignKey('task_data_task_id_fkey', 'task_data');
        $this->dropTable('task_data');
        $this->dropTable('task');

	}
}