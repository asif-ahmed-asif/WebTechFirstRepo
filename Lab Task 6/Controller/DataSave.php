<?php 
require_once 'model.php';
	function DataSave($data)
	{
		$login['uid'] = $data['uid'];
		$login['password'] = $data['password'];
		$login['type'] = "l";
		$login['status'] = "i";

		AddIntoLogin($login);

		$librarian['uid'] = $data['uid'];
		$librarian['name'] = $data['name'];
		$librarian['email'] = $data['email'];
		$librarian['dob'] = $data['dd']."-".$data['mm']."-".$data['yyyy'];
		$librarian['address'] = $data['address'];
		$librarian['gender'] = $data['gender'];
		$librarian['picture'] = $data['picture'];

		AddIntoLibrarian($librarian);

		return true;

	}
	
       
  

 ?>