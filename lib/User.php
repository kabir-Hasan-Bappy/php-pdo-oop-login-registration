<?php
	include_once 'Session.php';
	include 'Database.php';
class User
{
	private $db;
	public function __construct()
	{
		$this->db = new Database();
	}
	public function userregistration($data)
	{
		$name = $data['name'];
		$username = $data['username'];
		$email = $data['email'];
		$password = $data['password'];

		$chk_mail = $this->emailCheck($email);

		if (empty($name) || empty($username) || empty($email) || empty($password )) {
			$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Field must not be empty..</div>";
			return $msg;
		}

		if (strlen($username) < 3) {
			$msg = "<div class='alert alert-danger'><strong>ERROR ! </strong>Username is too short.</div>";
			return $msg;
		}
		 elseif(preg_match('/[^a-z0-9_-]+/i' , $username))
		 {

		 	$msg = "<div class='alert alert-danger'><strong>ERROR !</strong>Username contain only alphanumerical, dashes, and underscore.</div>";
		 	return $msg;
		 }
		 if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) { 
		 	$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Email Address is not Valid</div>";
		 	return $msg;
		 }

		 if ($chk_mail== true) {
		 	$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Email Address is already Exist.</div>";
		 	return $msg;
		 }
		 $password = md5($data['password']);
		 $sql = "INSERT INTO users( name, username, email, password ) VALUES( :name, :username, :email, :password  )";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt -> bindValue(':name', $name);
        $stmt -> bindValue(':username', $username);
        $stmt -> bindValue(':email', $email);
        $stmt -> bindValue(':password', $password);
        $result =  $stmt->execute();

        if ($result) {
            $message = "<div class='alert alert-success'><strong>Thank your! </strong>You have been successfully registered!</div>";
            return $message;
        } else {
            $message = "<div class='alert alert-danger'><strong>Sorry! </strong>there has been problem with your data!</div>";
            return $message;
        }

    }
public function emailCheck($email){
		$sql = "SELECT email FROM users WHERE email=:email";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function getUserLogin($email, $password){

		$sql = "SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function userLogin($data){

		$email = $data['email'];
		$password = md5($data['password']);

		$chk_mail = $this->emailCheck($email);

		if (empty($email) || empty($password )) {
			$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Field must not be empty..</div>";
			return $msg;
		}

		if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) { 
		 	$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Email Address is not Valid</div>";
		 	return $msg;
		 }

		 if ($chk_mail== false) {
		 	$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Email Address is not registered.</div>";
		 	return $msg;
		 }
		 $result = $this->getUserLogin($email, $password);
		 if ($result) {
		 	Session::init();
		 	Session::set('login', true);
		 	Session::set('id', $result->id);
		 	Session::set('name', $result->name);
		 	Session::set('username', $result->username);
		 	Session::set('loginmsg', "<div class='alert alert-success mt-2'><strong>SUCCESS! </strong>You Are Logged In.</div>");
		 	header('Location: index.php');
		 }else{
		 	$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Data not Found.</div>";
		 	return $msg;
		 }

	}
 public function getUserData()
{
	$sql = 'SELECT id, name, username, email FROM users ORDER BY id DESC';
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
}

public function getUserById($userid)
{
	$sql = 'SELECT * FROM users WHERE id=:id LIMIT 1';
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':id', $userid);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result;
}

public function userUpdate($userid, $data)
{
		$name = $data['name'];
		$username = $data['username'];
		$email = $data['email'];

		
		if (empty($name) || empty($username) || empty($email) ) {
			$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Field must not be empty..</div>";
			return $msg;
		}
 

		 $sql = "UPDATE users SET name = :name, username = :username, email = :email WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt -> bindValue(':name', $name);
        $stmt -> bindValue(':username', $username);
        $stmt -> bindValue(':email', $email);
        $stmt -> bindValue(':id', $userid);
        $result =  $stmt->execute();

        if ($result) {
            $message = "<div class='alert alert-success'><strong>Thank your! </strong>Userdata updated Successfully!</div>";
            return $message;
        } else {
            $message = "<div class='alert alert-danger'><strong>Sorry! </strong>Not Updated!</div>";
            return $message;
        }

}

private function checkPass($userid,$oldpass)
{
	$password = md5($oldpass);
	$sql = "SELECT password FROM users WHERE  id = :id AND password=:password";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':id', $userid);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return true;
		}
		else{
			return false;
		}
}

public function updatepass($userid, $data)
{
	$oldpass = $data['oldpass'];
	$newpass = $data['newpass'];
	$chk_pass = $this->checkPass( $userid, $oldpass);
	if (empty($oldpass) || empty($newpass)) {
		$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Field must not be Empty..</div>";
			return $msg;
	}

	
		if ($chk_pass == false) {
			$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Old Password not Exist. </div>";
			return $msg;
		}

		if (strlen($newpass) < 6) {
			$msg = "<div class='alert alert-danger'><strong>ERROR! </strong>Password is too short.</div>";
			return $msg;
		}

		$password = md5($newpass);

$sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt -> bindValue(':password', $password);
        $stmt -> bindValue(':id', $userid);
        $result =  $stmt->execute();

        if ($result) {
            $message = "<div class='alert alert-success'><strong>Thank your! </strong>Password updated Successfully!</div>";
            return $message;
        } else {
            $message = "<div class='alert alert-danger'><strong>Sorry! </strong>Not Updated!</div>";
            return $message;
        }
	
}



}
?>