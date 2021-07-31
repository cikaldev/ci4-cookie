<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
	public function index()
	{
		echo 'Dashboard ' . anchor(route_to('logout'), 'Logout');
	}
}
