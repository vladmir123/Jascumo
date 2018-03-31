<?php
if(empty( $_SESSION['id_user'])){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if(isset($_REQUEST['submit'])){

		$id_layanan    = $_REQUEST['id_layanan'];
		$jenis_layanan = $_REQUEST['jenis_layanan'];
		$biaya 	   	   = $_REQUEST['biaya'];

		$sql = mysqli_query($db_con, "UPDATE tipe_mobil SET jenis_layanan='$jenis_layanan', biaya='$biaya' WHERE id_layanan='$id_layanan'");

		if($sql == true){
			header('Location: ./admin.php?hlm=biaya');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_tipe_mobil = $_REQUEST['id_tipe_mobil'];

		$sql = mysqli_query($db_con, "SELECT * FROM tipe_mobil WHERE id_tipe_mobil='$id_tipe_mobil'");
		while($row = mysqli_fetch_array($sql)){

?>
<h2>Edit Master Mobil</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Kode Mobil</label>
		<div class="col-sm-4">
			<input type="hidden" name="id_total" value="<?php echo $row['id_tipe_mobil']; ?>">
			<input type="text" name="jenis_layanan" class="form-control" id="jenis_layanan" value="<?php echo $row['jenis_layanan']; ?>" placeholder="Jenis Kendaraan" required>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Nama Mobil</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="biaya" value="<?php echo $row['nama_mobil']; ?>" name="biaya" placeholder="total Jasa" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=biaya" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php } } } ?>
