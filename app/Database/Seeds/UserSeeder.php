<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$this->db->table('tb_user')->insert([
			'email' => 'admin@email.com',
			'password' => password_hash('password', PASSWORD_DEFAULT),
			'name' => 'user satu'
		]);
	}
}
