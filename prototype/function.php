<?php
session_start();

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

class Register extends Connection{
  public function registration($fname, $username, $email, $password, $confirmpassword, $no_telp, $pp, $role){
    $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
      return 10;
      // Username or email has already taken
    }
    else{
      if($password == $confirmpassword){
        // $password = password_hash($password, PASSWORD_DEFAULT);
        $pp = $_FILES['pp']['name'];
        $query = "INSERT INTO users(id,fname,username,email,password,no_telepon,pp,role) VALUES(NULL, '$fname', '$username', '$email', '$password', '$no_telp', '$pp', '$role')";
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
}

class Login extends Connection{
  public $id;
  public function login($usernameemail, $password){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
      if($password == $row["password"]){
        $this->id = $row["id"];
        if($row["role"] == 1){
          if($row["nik"] == 'false'){
            return 1;
          }
          else{
            return 2;
          }
          
        // Login successful
        }
        elseif($row["role"] == 2){
          if($row["nik"] == 'false'){
            return 1;
          }
          else{
            return 3;
          }
        }
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

  public function lastLogin($id){
    mysqli_query($this->conn, "UPDATE users SET last_login = current_timestamp() where id = $id");
  }
}

class Select extends Connection{
  public function selectUserById($id){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
    return mysqli_fetch_assoc($result);
  
  }

  public function selectProductById($id){
    $result = mysqli_query($this->conn, "SELECT * FROM produk WHERE id = $id");
    return mysqli_fetch_assoc($result);
  
  }

  public function selectProgresById($id){
    $data = mysqli_query($this->conn, "SELECT * FROM progres_pengrajin WHERE id_users = $id");
    $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
		
		return $rows;
  
  }

  public function specifySelectProduct($user)
	{
		$data = mysqli_query($this->conn, "select * from produk where id='$user'");
		$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
		
		return $rows;
	}

  public function selectUserByUsername($username){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE username = $username");
    return mysqli_fetch_all($result);
  
  }

  public function editThisUser($id){
    mysqli_query($this->conn, "update users set npwp='");

  }

  public function checkUpgradeInformation($id){
    $result=mysqli_query($this->conn, "SELECT * FROM upgrade Where id_users = '$id'");
    return mysqli_num_rows($result);
  }
  
}

class Specify extends Connection{
  public function selectUserById($id)
  {
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return ($rows);
  }
  public function dataUser($user)
	{
		$data = mysqli_query($this->conn, "select * from users where id='$user'");
		$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
		
		return $rows;
	}
  
}
class Upgrade extends Connection{
  public function upgradeUserRequest($npwp, $nik, $no_rekening, $bukti_ktp ,$id_users)
	{
    $bukti_ktp = $_FILES['bukti_ktp']['name'];
		$query = "insert into upgrade(id,npwp,nik,no_rekening,bukti_ktp,id_users) values (NULL,'$npwp','$nik','$no_rekening','$bukti_ktp',$id_users)";
    mysqli_query($this->conn, $query);
    return 2;
	}
  
  public function checkThisUser($id){
    $data = mysqli_query($this->conn, "select * from upgrade where id='$id'");
		$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
		
		return $rows;
  }
  public function checkForValidation($id_users, $npwp, $nik, $no_rekening, $deskripsi){
    mysqli_query($this->conn, "update users set npwp='$npwp', nik='$nik', no_rekening='$no_rekening', deskripsi='$deskripsi' where id=$id_users");
  }

  public function updateDescription($id,$deskripsi){
    mysqli_query($this -> conn, "update users set deskripsi='$deskripsi' where id = '$id'");
  }
}

class Invest extends Connection{
  public function investThisUser($id_investor,$id_pengrajin, $jumlah_dana)
  {
    mysqli_query($this->conn, "INSERT INTO invest(id,id_investor,id_pengrajin,jumlah_dana,status,mou) VALUES(NULL,$id_investor,$id_pengrajin,$jumlah_dana,'0','MOU belum dibuat')");
  }
  public function removeThisUser($id)
  {
    mysqli_query($this->conn, "delete from invest where id='$id'");
  }
  public function getFromThisRowAsPengrajin($id_pengrajin)
  {
    $data = mysqli_query($this->conn, "SELECT id,id_investor,id_pengrajin,jumlah_dana,status,status_investor,status_pengrajin, tanggal, tanggal + INTERVAL '3' year as tanggal_pengembalian FROM invest where id_pengrajin='$id_pengrajin'");
		$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
		
		return $rows;
  }
  public function getFromThisRowAsInvestor($id_investor)
  {
    $data = mysqli_query($this->conn, "SELECT id,id_investor,id_pengrajin,jumlah_dana,status,status_investor,status_pengrajin, tanggal, tanggal + INTERVAL '3' year as tanggal_pengembalian FROM invest where id_investor='$id_investor'");
    $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);

    return $rows;
  }
  public function getIDFromThisRow($id)
  {
    $data = mysqli_query($this->conn, "select * from invest where id='$id'");
		$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
		
		return $rows;
  }
  public function acceptThisRequest($id)
  {
    $pengrajin_status = "Permintaan diterima,Memproses MOU";
    $investor_status = "Permintaan diterima, Menyiapkan MOU";
    $status="1";
    mysqli_query($this->conn, "update invest set status_pengrajin='$pengrajin_status', status_investor='$investor_status', status='$status' where id='$id'");
  }

  public function sendToAdmins($id_investor,$id_pengrajin,$jumlah,$metode,$nomer,$bukti,$id_invest)
  {
    $query = "INSERT INTO bayar(id,id_investor,id_pengrajin,jumlah,metode,nomer,bukti,status,id_invest) VALUES(NULL, '$id_investor', '$id_pengrajin', $jumlah,'$metode', '$nomer', '$bukti', '1', '$id_invest')";
    mysqli_query($this->conn, $query);
    return 1;
  }
  public function sendBackToAdmins($id_investor,$id_pengrajin,$jumlah,$metode,$nomer,$bukti,$id_invest)
  {
    $query = "INSERT INTO bayar(id,id_investor,id_pengrajin,jumlah,metode,nomer,bukti,status,id_invest) VALUES(NULL, '$id_investor', '$id_pengrajin', $jumlah,'$metode', '$nomer', '$bukti', '3', '$id_invest')";
    mysqli_query($this->conn, $query);
    return 1;
  }
  public function afterSend($id)
  {
    $status = "6";
    $status_investor = "Sudah dibayar, sedang diproses";
    mysqli_query($this->conn, "update invest set status='$status', status_investor='$status_investor' where id='$id'");
  }
  public function afterSendBack($id)
  {
    $status = "9";
    $status_pengrajin = "Sudah dikirim, sedang diproses";
    mysqli_query($this->conn, "update invest set status='$status', status_pengrajin='$status_pengrajin' where id='$id'");
  }

  public function selectThisID($id)
  {
    $status="5";
    mysqli_query($this->conn, "update invest set status='$status' where id='$id'");

  }
  public function uploadThisMOU($id,$mou)
  {
    $status_investor="MOU sudah dikirim ke Pengrajin";
    $status_pengrajin="Harap lengkapi MOU berikut";
    $status="3";
    mysqli_query($this->conn, "update invest set status_investor ='$status_investor', status_pengrajin ='$status_pengrajin', status ='$status',mou='$mou' where id='$id'");
  }
  public function tenggatPengembalian($id)
  {
    $status_investor="Menunggu proses pengembalian dari Pengrajin";
    $status_pengrajin="Harap segera melakukan pengembalian";
    $status="8";
    mysqli_query($this->conn, "update invest set status_investor ='$status_investor', status_pengrajin ='$status_pengrajin', status ='$status' where id='$id'");
  }
}

class Investation extends Connection{

}

class Send extends Connection{
  public function getPengrajinFromThisRow($id_pengrajin)
  {
    $data = mysqli_query($this->conn, "select * from invest where id_pengrajin='$id_pengrajin'");
		$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
		
		return $rows;
  }
  public function getFromThisRow($id_investor)
  {
    $data = mysqli_query($this->conn, "SELECT id,id_investor,id_pengrajin,jumlah_dana,status_investor,status_pengrajin, status, tanggal + INTERVAL '3' year as tanggal FROM `invest` where id_investor='$id_investor'");
		$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
		
		return $rows;
  }
  public function getFromThisRowAsPengrajin($id_pengrajin)
  {
    $data = mysqli_query($this->conn, "SELECT id,id_investor,id_pengrajin,jumlah_dana,status_investor,status_pengrajin, status, tanggal, tanggal + INTERVAL '3' year as tanggal_pengembalian FROM `invest` where id_pengrajin='$id_pengrajin'");
    $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);

    return $rows;
  }
  public function getFromThisRowAsInvestor($user)
  {
    $data = mysqli_query($this->conn, "SELECT id,id_investor,id_pengrajin,jumlah_dana,status_investor,status_pengrajin, status tanggal, tanggal + INTERVAL '3' year as tanggal_pengembalian FROM `invest` where nama_pengrajin='$user'");
    $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);

    return $rows;
  }
  public function RequestFromThisUser($id, $dana)
  {
    mysqli_query($this->conn, "update users set dana=$dana where id='$id'");
  }
  public function SendToThisUser($id, $dana)
  {
    mysqli_query($this->conn, "update users set dana=$dana where id='$id'");
  }

  public function SendBackToInvestor($id_investor, $dana){
    mysqli_query($this->conn, "update users set dana=$dana where id_investor='$id_investor'");
  }
  public function removeThisRow($id)
	{
		mysqli_query($this->conn, "delete from invest where id='$id'");
	}
}


class Edit extends Connection{
  public function editUsername($id,$username)
  {
    mysqli_query($this->conn, "update users set username='$username' where id = '$id'");
  }
  public function editEmail($id,$email)
  {
    mysqli_query($this->conn, "update users set email='$email' where id = '$id'");
  }
  public function editPassword($id,$password)
  {
    mysqli_query($this->conn, "update users set password='$password' where id = '$id'");
  }
  public function editdata($id,$email,$username,$password,$no_telepon)
  {
    mysqli_query($this->conn, "update users set email='$email', username='$username', password='$password', no_telepon='$no_telepon' where id = '$id'");
  }
}
class MOU extends Connection{
  public function InvestorMOU($id, $mou)
  {
    $status_investor = "Menunggu MOU pengrajin";
    $status_pengrajin = "Harap isi pada bagian dua";
    $status = "3";

    mysqli_query($this->conn, "update invest set status_investor='$status_investor', status_pengrajin='$status_pengrajin', status='$status', mou='$mou' where id='$id'");
  }
  public function PengrajinMOU($id, $mou)
  {
    $status_investor = "Memproses MOU ke admin";
    $status_pengrajin = "Memproses MOU ke admin";
    $status = "4";

    mysqli_query($this->conn, "update invest set status_investor='$status_investor', status_pengrajin='$status_pengrajin', status='$status', mou='$mou' where id='$id'");
  }
}
class Date extends Connection{
  public function tanggalIndonesia($tanggal) 
  {
    $bulan = array (
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
      );
      
      $pecahkan = explode('-', $tanggal);
      
      // variabel pecahkan 0 = tanggal
      // variabel pecahkan 1 = bulan
      // variabel pecahkan 2 = tahun
       
      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];

  }
  public function ambilTanggalPrediksi($hari)
  {
    date_default_timezone_set('Asia/Jakarta');
    $dateBaru = new DateTime();
    $interval = new DateInterval($hari) ;
    $dateBaru->add($interval);
    return $dateBaru->format('Y-m-d');
  }
  public function ambilTanggalSekarang()
  {
    date_default_timezone_set('Asia/Jakarta');
    $dateSekarang = new DateTime();
    return $dateSekarang->format('Y-m-d');
  }
}
class Progres extends Connection{
  public function tambahProgresDenganGambar($id_product, $gambar, $tanggal_mulai, $prediksi, $id_users)
  {
    mysqli_query($this->conn, "INSERT INTO progres_pengrajin (id, id_produk, foto, tanggal_mulai, tanggal_selesai, id_users) VALUES (NULL, '$id_product', '$gambar', '$tanggal_mulai', '$prediksi', '$id_users')");
  }
  public function tambahProgresTanpaGambar($id_product, $tanggal_mulai, $prediksi, $id_users)
  {
    $gambar = "none.png";
    mysqli_query($this->conn, "INSERT INTO progres_pengrajin (id, id_produk, foto, tanggal_mulai, tanggal_selesai, id_users) VALUES (NULL, '$id_product', '$gambar', '$tanggal_mulai', '$prediksi', '$id_users')");
  }
}