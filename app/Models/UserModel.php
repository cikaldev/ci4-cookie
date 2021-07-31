<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tb_user';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $protectFields        = true;
	protected $allowedFields        = [
		'email','password','name','remember_code'
	];

	public function validateCookie($cookie)
	{
		$row = $this->db->table($this->table)->where('remember_code', $cookie)->first();
		if ($row) {
			unset($row->password);
			$row->logged_in = bin2hex(random_bytes(10));
			session()->set((array)$row);
			return true;
		} else {
			return false;
		}
	}
}