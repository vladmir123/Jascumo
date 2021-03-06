<?php session_start();
      include "../config/koneksi.php";
    //jika ada session, maka akan diarahkan ke halaman dashboard admin
    if(isset($_SESSION['id_user'])){
        //mengarahkan ke halaman dashboard admin
        header("Location: ./admin.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Aplikasi Jasa Cuci Mobil</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $site;?>admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $site;?>admin/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $site;?>admin/css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo $site;?>frontend/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo $site;?>frontend/favicon/favicon.ico" type="image/x-icon">
  </head>
  <body>
    <div class="container">
	<?php
    //apabila tombol login di klik akan menjalankan skript dibawah ini
	if(isset($_REQUEST['login'])){

        //mendeklarasikan data yang akan dimasukkan ke dalam database
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

        //skript query ke insert data ke dalam database
		$sql = mysqli_query($db_con, "SELECT id_user, username, nama_user, level_akses, status_pengguna
		FROM user WHERE username='$username' AND password=MD5('$password')");
		//jika skript query benar maka akan membuat session
		if($sql){
			list($id_user, $username, $nama_user, $level_akses) = mysqli_fetch_array($sql);
            //membuat session
            $_SESSION['id_user']  	  	= $id_user;
			$_SESSION['username'] 	  	= $username;
			$_SESSION['nama_user'] 		= $nama_user;
			$_SESSION['level_akses']  	= $level_akses;
			header("Location: ./admin.php");
			die();
		}else{
			$message_failed = $_SESSION['err'] = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
			header('Location: ./');
			die();
		}
	}else{
	?>
	<div class="col-lg-12 col-sm-12 main-login">
		<div class="col-lg-5 col-lg-push-3 inner-login">
	      <form class="form-signin" method="post" action="" role="form">
				<div class="col-sm-8 col-md-8 col-md-push-2">
					<img src="<?php echo $site;?>frontend/logo/crown-cars.png" class="img-responsive">
				</div>
		        <h2 class="form-signin-heading text-center">Administrator Area</h2>
				<?php
					if(isset($_SESSION['err'])){
							$err = $_SESSION['err'];
							echo '<div class="alert alert-danger alert-message">'.$err.'</div>';
			            	unset($_SESSION['err']);
					}
				?>
		        <div class="form-group">
		        	<div class="input-group">
		        		<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
		        		<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="input-group">
		        		<span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
		        		<input type="password" name="password" class="form-control" placeholder="Password" required>
			        </div>
		        </div>
		        <button class="btn btn-lg btn-danger btn-block" type="submit" name="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
		      </form>
			<?php } ?> 
			</div>
		</div>
	</div> <!-- /container -->
	<!-- Bootstrap core JavaScript, Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $site;?>admin/js/jquery.min.js"></script>
    <script src="<?php echo $site;?>admin/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".alert-message").alert().delay(3000).slideUp('slow');
		});
	</script>
  </body>
</html>