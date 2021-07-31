<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
	public function __construct()
	{
		$this->usermod = new UserModel;
	}

	public function index()
	{
		if (is_login()) {
			return redirect()->to('/admin/dashboard');
		} elseif (has_cookie(env('app.sessionCookieName'))) {
			$cookie = get_cookie(env('app.sessionCookieName'));
			if ($this->usermod->validateCookie($cookie)) {
				return redirect()->to('/admin/dashboard');
			} else {
				return redirect()->to('/auth/login');
			}
		} else {
			return redirect()->to('/auth/login');
		}
	}

	public function login()
	{
		if (is_login()) {
			return redirect()->to('/admin/dashboard');
		}

		return view('form_login');
	}

	public function doLogin()
	{
		$rules = [
			'email' => 'required|valid_email',
			'password' => 'required|min_length[8]'
		];

		if ( ! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');
		$remember = $this->request->getPost('remember');
		
		$user = $this->usermod->where('email', $email)->first();
		if ($user) {
			if (password_verify($password, $user->password)) {
				unset($user->password);
				$user->logged_in = bin2hex(random_bytes(5));
				session()->set((array)$user);

				if ($remember) {
					$key = md5(time());
					set_cookie(env('app.sessionCookieName'), $key, 3600*24*30);
					$this->usermod->update($user->id, ['remember_code' => $key]);
				}
				return redirect()->to('/admin/dashboard');
			} else {
				return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
			}
		} else {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}

	public function logout()
	{
		delete_cookie(env('app.sessionCookieName'));
		session()->destroy();
		return redirect()->to('/');
	}
}
