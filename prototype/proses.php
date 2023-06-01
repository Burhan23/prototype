<?php 
include 'db_conn.php';
include 'function.php';
$db = new database();
$register = new Register();
$upgrade = new Upgrade();
$specify = new Specify();
$invest = new Invest();
$send = new Send();
$edit = new Edit();
$mou = new MOU();
$progres = new Progres();
$dateSekarang = new DateTime();
$date = new Date();

$select = new Select();

if(!empty($_SESSION["id"])){
  $user = $select->selectUserById($_SESSION["id"]);
}
else{
  header("Location: login.php");
}



 
$aksi = $_GET['aksi'];
if($aksi == "tambah"){
	if (($_FILES['gambar']['name']!="")){
	// Where the file is going to be stored
		$target_dir = "uploads/";
		$file = $_FILES['gambar']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$x = explode('.', $file);
		$ekstensi = strtolower(end($x));
		$ext = $path['extension'];
		$movefile = $filename.time().".".$ext;
		$temp_name = $_FILES['gambar']['tmp_name'];
		$path_filename_ext = $target_dir.$movefile;
	
	// Check if file already exists
		if (file_exists($path_filename_ext)) {
			echo "Sorry, file already exists.";
		}else{
			move_uploaded_file($temp_name,$path_filename_ext);
			echo "Congratulations! File Uploaded Successfully.";
		}
		$db->input($_POST['nama_product'],$movefile,$_POST['deskripsi'],$_REQUEST['id_users']);
 		header("location:index_pengrajin.php");
	}
 	
} elseif($aksi == "update"){
 	$db->update($_REQUEST['id'],$_POST['nama_product'],$_POST['deskripsi']);
 	header("location:index_pengrajin.php");
} elseif($aksi == "hapus"){
	$db->hapus($_GET['id']);
	header("location:index_pengrajin.php");
} elseif($aksi == "regist"){
	if (($_FILES['pp']['name']!="")){
		$target_dir = "foto_profil/";
		$file = $_FILES['pp']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		$temp_name = $_FILES['pp']['tmp_name'];
		$path_filename_ext = $target_dir.$filename.".".$ext;
		if (file_exists($path_filename_ext)) {
			echo "Sorry, file already exists.";
		}else{
			move_uploaded_file($temp_name,$path_filename_ext);
			echo "Congratulations! File Uploaded Successfully.";
		}
	}
	$result = $register->registration($_POST["fname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"],$_POST['no_telp'], $_POST["pp"], $_POST["role"] );
	header("location:login.php");
	
} elseif($aksi == "upgrade"){
	if (($_FILES['bukti_ktp']['name']!="")){
		$target_dir = "upgrade/";
		$file = $_FILES['bukti_ktp']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		$temp_name = $_FILES['bukti_ktp']['tmp_name'];
		$path_filename_ext = $target_dir.$filename.".".$ext;
		if (file_exists($path_filename_ext)) {
			echo "Sorry, file already exists.";
		}else{
			move_uploaded_file($temp_name,$path_filename_ext);
			echo "Congratulations! File Uploaded Successfully.";
		}
	}
	$upgrade->upgradeUserRequest($_POST['npwp'],$_POST['nik'],$_POST['no_rekening'],$_POST['bukti_ktp'],$_REQUEST['id_users']);
 	header("location:dashboard.php");
} elseif($aksi == "invest"){

	$invest->investThisUser($_REQUEST['id_investor'],$_REQUEST['id_pengrajin'],(int)$_POST['jumlah_dana']);
	header("location:index_investor.php");

} elseif($aksi == "accept"){

	$invest->acceptThisRequest($_REQUEST['id']);
	header("location:approval_invest.php");

} elseif ($aksi == "decline") {

	$detail = $specify->dataUser($_GET['username']);;

	foreach ($detail as $akun){
		$jumlah_dana = (int)$_REQUEST['jumlah_dana'];
		$dana = $akun['dana'] + $jumlah_dana +10000;
		$send->SendBackToInvestor($_REQUEST['username'],$dana);
		$send->removeThisRow($_REQUEST['id']);
		header("location: profile.php");
	}
} elseif ($aksi == "valid"){
	$upgrade->checkForValidation($_REQUEST['npwp'],$_REQUEST['nik'],$_REQUEST['no_rekening'],$_REQUEST['deskripsi'],$_REQUEST['id_users']);
} elseif($aksi == "bayar"){
	if (($_FILES['bukti']['name']!="")){
		$target_dir = "topup/";
		$file = $_FILES['bukti']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		$movefile = "Bayar_Pemberian_".$_POST['metode'].$_REQUEST['id_invest'].".".$ext;
		$temp_name = $_FILES['bukti']['tmp_name'];
		$path_filename_ext = $target_dir.$movefile;
		if (file_exists($path_filename_ext)) {
			echo "Sorry, file already exists.";
		}else{
			move_uploaded_file($temp_name,$path_filename_ext);
			echo "Congratulations! File Uploaded Successfully.";
		}
	}
	$result = $invest->sendToAdmins($_REQUEST['id_investor'], $_REQUEST['id_pengrajin'], (int)$_REQUEST['jumlah'], $_POST["metode"], $_POST["nomer"] , $movefile , $_REQUEST['id_invest']);
	$invest->afterSend($_REQUEST['id_invest']);
	header("location:awaiting_invest.php");

}elseif($aksi == "update_deskripsi"){
	$upgrade->updateDescription($_REQUEST['id'],$_POST['deskripsi']);
	header("location:deskripsi.php");
} elseif($aksi == "update_deskripsi2"){
	$db->update($_REQUEST['id'],$_POST['nama_product'],$_POST['deskripsi']);
	header("location:index_pengrajin.php");
} elseif($aksi == "edit_profile") {
	if ($_POST['old_password'] == $_REQUEST['passwordlama']) {
		$edit->editdata($_REQUEST['id'],$_POST['email'],$_POST["username"],$_POST['password'],$_POST['no_telp']);
		
		header("location:profile.php");
	} else echo "PASSWORD SALAH";
} elseif($aksi == "kembalikan"){
	if (($_FILES['bukti']['name']!="")){
		$target_dir = "kembalikan/";
		$file = $_FILES['bukti']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		$temp_name = $_FILES['bukti']['tmp_name'];
		$movefile = "Bayar_Pengembalian_".$_REQUEST['metode'].$_REQUEST['id_invest'].".".$ext;
		$path_filename_ext = $target_dir.$filename.".".$ext;
		if (file_exists($path_filename_ext)) {
			echo "Sorry, file already exists.";
		}else{
			move_uploaded_file($temp_name,$path_filename_ext);
			echo "Congratulations! File Uploaded Successfully.";
		}
	}
	$result = $invest->sendBackToAdmins($_REQUEST['id_investor'], $_REQUEST['id_pengrajin'], (int)$_REQUEST['jumlah'], $_POST["metode"], $_POST["nomer"] , $movefile , $_REQUEST['id_invest']);
	$invest->afterSendBack($_REQUEST['id_invest']);
	header("location:approval_invest.php");

} else if ($aksi == "mou") {
	if (($_FILES['mou']['name']!="")){
		// Where the file is going to be stored
			$target_dir = "MOU/";
			$file = $_FILES['mou']['name'];
			$path = pathinfo($file);
			$filename = $path['filename'];
			$x = explode('.', $file);
			$ekstensi = strtolower(end($x));
			$ext = $path['extension'];
			if ($_REQUEST['role'] == '1') {
				$movefile = "SURAT_PERJANJIAN_INVESTASI"."_".$_REQUEST['id']."_".$_REQUEST['investor']."-".$_REQUEST['pengrajin'].".".$ext;
			} else if ($_REQUEST['role'] == 2) {
				$movefile = "SURAT_PERJANJIAN_INVESTASI"."_".$_REQUEST['id']."_".$_REQUEST['pengrajin'].".".$ext;
			}
			$temp_name = $_FILES['mou']['tmp_name'];
			$path_filename_ext = $target_dir.$movefile;
		
		// Check if file already exists
			if (file_exists($path_filename_ext)) {
				echo "Sorry, file already exists.";
			}else{
				move_uploaded_file($temp_name,$path_filename_ext);
				echo "Congratulations! File Uploaded Successfully.";
			}
			if ($_REQUEST['role'] == '2') {
			$mou->InvestorMOU($_REQUEST['id'],$movefile);
			header("location:awaiting_invest.php");
			} else if ($_REQUEST['role'] == '1') {
			$mou->PengrajinMOU($_REQUEST['id'],$movefile);
			header("location:approval_invest.php");
			}
		}
} else if ($aksi == 'progres') {
	date_default_timezone_set('Asia/Jakarta');
	$hariini = $dateSekarang->format('Y-m-d');
	$waktuini = $date->tanggalIndonesia($hariini);
	if (isset($_FILES['progres']['name'])){
		if (($_FILES['progres']['name']!="")){
			$target_dir = "progres/";
			$file = $_FILES['progres']['name'];
			$path = pathinfo($file);
			$filename = $path['filename'];
			$ext = $path['extension'];
			$movefile = "Progres_".$_REQUEST['id_produk']."_".$_REQUEST['id_users']."_".$waktuini.".".$ext;
			$temp_name = $_FILES['progres']['tmp_name'];
			$path_filename_ext = $target_dir.$movefile;
			if (file_exists($path_filename_ext)) {
				echo "Sorry, file already exists.";
			}else{
				move_uploaded_file($temp_name,$path_filename_ext);
				echo "Congratulations! File Uploaded Successfully.";
			}
		}
		$progres->tambahProgresDenganGambar($_REQUEST['id_produk'],$movefile,$_REQUEST['tanggal_mulai'],$_REQUEST['prediksi'],$_REQUEST['id_users']);
		header("location:progres.php");
	} else {
		$progres->tambahProgresTanpaGambar($_REQUEST['id_produk'],$_REQUEST['tanggal_mulai'],$_REQUEST['prediksi'],$_REQUEST['id_users']);
		header("location:progres.php");
	}

} elseif ($aksi == 'ubahmulai') {
	date_default_timezone_set('Asia/Jakarta');
	$progres->editTanggalMulai($_REQUEST['id'],$_REQUEST['tanggal_mulai']);
	header("location:progres.php");
} elseif ($aksi == 'ubahselesai') {
	//if ($_REQUEST['status'] == '50') {
		?>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
		rel="stylesheet" 
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
		crossorigin="anonymous">
		<div style="padding-top: 40px;" class="card" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                </div>
                <div class="modal-body">
                        <div style="color:white">↓</div>
                        <label style="color:black"for="gambar" class="form-label" >Perpanjang prediksi selesai sudah pernah anda perpanjang</label>
                        <div style="color:white">↓</div>
                        <div style="color:white">↓</div>
                </div>
                <div class="modal-footer">
                    <a href="progres.php" class="btn btn-danger">Kembali Ke Halaman Progres</a>
                    </form>
                </div>
                </div>
            </div>
			</div>
			<?php
	//} else {
	$progres->editTanggalSelesai($_REQUEST['id'],$_POST['perpanjang'],$_REQUEST['tanggal_selesai']);
	header("location:progres.php");
	//}
	
} elseif ($aksi == 'selesai') {
	date_default_timezone_set('Asia/Jakarta');
	$hariini = $dateSekarang->format('Y-m-d');
	$waktuini = $date->tanggalIndonesia($hariini);
		if (($_FILES['selesai']['name']!="")){
			$target_dir = "progres/";
			$file = $_FILES['selesai']['name'];
			$path = pathinfo($file);
			$filename = $path['filename'];
			$ext = $path['extension'];
			$movefile = "selesai_".$_REQUEST['id_produk']."_".$_REQUEST['id_users']."_".$waktuini.".".$ext;
			$temp_name = $_FILES['selesai']['tmp_name'];
			$path_filename_ext = $target_dir.$movefile;
			if (file_exists($path_filename_ext)) {
				echo "Sorry, file already exists.";
			}else{
				move_uploaded_file($temp_name,$path_filename_ext);
				echo "Congratulations! File Uploaded Successfully.";
			}
		}
		$progres->progresSelesai($_REQUEST['id'],$movefile,$_REQUEST['record']);
		header("location:progres_selesai.php");
} elseif ($aksi == 'hapusprogres') {
	$progres->deleteProgres($_REQUEST['id']);
	header("location:progres.php");
}

?>
