<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField([
			'email' => ['type'=>'VARCHAR', 'constraint'=>50,'unique'=>true],
			'password' => ['type'=>'VARCHAR', 'constraint'=>200],
			'name' => ['type'=>'VARCHAR', 'constraint'=>50],
			'remember_code' => ['type'=>'TEXT', 'null'=>true],
		]);
		$this->forge->createTable('tb_user', true);
	}

	public function down()
	{
		$this->forge->dropTable('tb_user', true);
	}
}
