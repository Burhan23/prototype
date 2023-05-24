<?php
session_start();

//Class induk yang mengkoneksikan ke database
class Connection{
  public $host = "localhost";
  public $user = "root";
  public $password = "";
  public $db_name = "prototype";
  public $conn;

  public function __construct(){
    $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
  }
}

class Account extends Connection {
  public $id;
  public function registration($name, $username, $email, $password, $confirmpassword){
    $duplicate = mysqli_query($this->conn, "SELECT * FROM admin_mrkayu WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
        return 10;
          // Username or email has already taken
      }
      else{
        if($password == $confirmpassword){
            $query = "INSERT INTO admin_mrkayu VALUES('', '$name', '$username', '$email', '$password')";
            mysqli_query($this->conn, $query);
            return 1;
            // Registration successful
      }
        else{
      return 100;
            // Password does not match
      }
    }
  }
  public function login($usernameemail, $password){
    $result = mysqli_query($this->conn, "SELECT * FROM admin_mrkayu WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
      if($password == $row["password"]){
        $this->id = $row["id"];
        return 1;
        // Login successful
      }
      else{
        return 10;
        // Wrong password
      }
    }
    else{
      return 100;
      // User not registered
    }
  }
  public function idUser(){
    return $this->id;
  }
}

//Class child berisikan fungsi pengambilan data(Read)
class Select extends Connection{
  public function ambilAdminID($id)
  {
    $result = mysqli_query($this->conn, "SELECT * FROM admin_mrkayu WHERE id = $id");
    return mysqli_fetch_assoc($result);
  }
  function tampilkanDataUser()
  {
	$data = mysqli_query($this->conn, "select * from users");
	$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
	return $rows;
  }
  function tampilkanDataUserBerdasarkanID($id)
  {
	$data = mysqli_query($this->conn, "select * from users where id='$id'");
	$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
	return $rows;
  } 
}

//Class child berisikan fungsi memasukkan data(Add)
class Insert extends Connection{

}

//Class child berisikan fungsi mengubah data(Update)
class Update extends Connection{

}

//Class child berisikan fungsi(Delete)
class Delete extends Connection{

}



