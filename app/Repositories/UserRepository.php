<?php

namespace App\Repositories;

use App\Models\User;
use Hash;

class UserRepository 
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}
	
	public function registerUser($request)
	{
        $data = json_decode($request->getContent(), true);
        $this->user->name = $data['name'];
        $this->user->email = $data['email'];
        $this->user->password = bcrypt($data['password']);
        $this->user->save();
	}


	public function getUserRequestNumber($id)
	{
		$user = $this->user->find($id);
		return $user->request_number;
	}

	public function increaseRequestNumber($id)
	{
		$user = $this->user->find($id);
		$user->request_number = $user->request_number + 1;
		$user->save();
	}

}