<?php
if(empty( $_SESSION['id_user'])){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
}else{

	if(isset($_REQUEST['submit'])){
		//declaring variable
		$no_nota  			= $_REQUEST['no_nota'];
		// $jenis    		= $_REQUEST['jenis'];
		$nama_pemesan       = $_REQUEST['nama_pemesan'];
		$alamat_pemesan     = $_REQUEST['alamat_pemesan'];
		$notelp_pemesan     = $_REQUEST['notelp_pemesan'];
		$email_pemesan      = $_REQUEST['email_pemesan'];
		$tangal_pesan		= $_REQUEST['tangal_pesan'];
		$no_antrian  		= $_REQUEST['no_antrian'];

		$bayar    			= $_REQUEST['bayar'];
		$kembali  			= $_REQUEST['kembali'];
		$total    			= $_REQUEST['total'];
		$id_user  			= $_SESSION['id_user'];
		$tgl_pesan 			= date('Y-m-d H:i:s');

		$sql = mysqli_query($db_con, "INSERT INTO transaksi_booking(no_nota, 
								   id_layanan, 
								   id_member, 
								   id_merek_mobil, 
								   id_ongkos,
								   id_user,
								   nama_pemesan,
								   alamat_pemesan,
								   notelp_pemesan,
								   email_pemesan,
								   tanggal_pesan,
								   no_antrian,
								   checkin_noantrian,
								   status_pemesanan,
								   bayar,
								   kembali,
								   total) 
							VALUES ('$no_nota',
									'$id_layanan',
									'$id_tipe_mobil',
									'$id_merek_mobil',
									'$id_ongkos',
									'',
									'$nama_pemesan',
									'$alamat_user',
									'$notelp_pemesan',
									'$email_user',
									'$tgl_pesan',
									'$no_antrian',
									'$checking_noantrian',
									'pesan',
									'$bayar',
									'$kembali',
									'$countTrans'");
		if($sql == true){
			header('Location: ./admin.php?hlm=transaksi');
			die();
		}else{
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
	$getInformation = mysqli_fetch_array(mysqli_query($db_con,"SELECT
															   tb.no_nota, 
															   tb.id_layanan, 
														       m.nama_member, 
														       m.alamat_member, 
														       m.notelp_member,
														       m.email_member, 
														       m.status_member, 
														       tb.nama_pemesan, 
														       tb.alamat_pemesan, 
														       tb.notelp_pemesan,
														       tb.email_pemesan,
														       tb.tanggal_pesan,
														       tb.bayar,
														       tb.kembali,
														       tb.total,
														       la.jenis_layanan,
														       la.harga_layanan,
														       tm.nama_mobil,
														       mm.nama_kendaraan,
														       oj.nama_wilayah,
														       oj.biaya_jemput
														    FROM transaksi_booking tb
															LEFT JOIN layanan la ON tb.id_layanan=la.id_layanan
															LEFT JOIN ongkos_jemput oj ON oj.id_ongkos=tb.id_ongkos
															JOIN tipe_mobil tm ON tb.id_tipe_mobil=tm.id_tipe_mobil
															JOIN merek_mobil mm ON tm.id_merek_mobil=mm.id_merek_mobil 
															LEFT JOIN member m ON tb.id_member=m.id_member
							 								WHERE tb.no_nota='$_GET[id]'"));
?>
<?php if($_GET['id']!=''){ ?>	
	<h2>Cashier Crown Cars Wash</h2>
<?php }else { ?>
	<h2>Tambah Transaksi Baru </h2>
<?php } ?>

<div id="app-vue">
	<div class="clearfix form-group"></div>
	<form method="post" action="modules/backend/transaksi_online/konfirmasi_booking.php?act=lunas&id=<?php echo $_GET['id']; ?>" class="form-horizontal" role="form">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-7">
				<?php if ($_GET['id']!='') { ?>
					<div class="form-group">
						<label for="no_nota" class="col-sm-3">No. Nota</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="no_nota" readonly="" value="<?php echo $_GET['id'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3">Nama Pelanggan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama_member" readonly value="<?php echo $getInformation['nama_member'] ?>">
						</div>
					</div>
					<div class="" style="display: none;">
						<div class="form-group">
							<label for="nama" class="col-sm-3">Alamat Pelanggan</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="alamat_member" readonly value="<?php echo $getInformation['alamat_member'];?>">
							</div>
						</div>
						<div class="form-group">
							<label for="nama" class="col-sm-3">Email Pelanggan</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="email_member" readonly value="<?php echo $getInformation['email_member'];?>">
							</div>
						</div>
						<div class="form-group">
							<label for="nama" class="col-sm-3">Notelp</label>
							<div class="col-sm-4">
								<input type="number" class="form-control" name="notelp_member" readonly value="<?php echo $getInformation['notelp_member'] ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="panel panel-body">
							<h4>Information Transaction</h4>
						</div>
						<div class="col-sm-12 col-md-12">
							<div class="row">
								<div class="col-sm-12 col-md-12">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="no_nota" class="col-sm-4">Merek Mobil</label>
											<div class="col-sm-5">
												<input type="text" name="merek_mobil" class="form-control" value="<?php echo $getInformation['nama_kendaraan'];?>" readonly>
											</div>
										</div>
										<div class="form-group">
											<label for="no_nota" class="col-sm-4">Nama Kendaraan</label>
											<div class="col-sm-5">
												<input type="text" name="nama_kendaraan" class="form-control" value="<?php echo $getInformation['nama_mobil'];?>" readonly>
											</div>
										</div>
										<div class="form-group">
											<label for="no_nota" class="col-sm-4">Nama Layanan</label>
											<div class="col-sm-6">
												<input type="text" name="" class="form-control" value="<?php echo $getInformation['jenis_layanan'];?>" readonly>
											</div>
										</div>
										<div class="form-group">
											<label for="no_nota" class="col-sm-4">Harga Layanan</label>
											<div class="col-sm-4">
												<input type="text" name="" class="form-control" value="<?php echo $getInformation['harga_layanan'];?>" readonly>
											</div>
										</div>
										<?php if ($getInformation['id_ongkos']!='') { ?>

										
										<?php }else{ ?>
											<div class="form-group">
												<label for="no_nota" class="col-sm-4">Layanan Jemput</label>
												<div class="col-sm-5">
													<input type="text" name="" class="form-control" value="<?php echo $getInformation['biaya_jemput'];?>">
												</div>
											</div>
											<div class="form-group">
												<label for="no_nota" class="col-sm-4">Cash / Tarif Antar Jemput</label>
												<div class="col-sm-5">
													<input type="text" name="" class="form-control" value="<?php echo $getInformation['biaya_jemput'];?>">
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }else{ ?>

					<div class="form-group">
						<label for="no_nota" class="col-sm-4 control-label">No. Nota</label>
						<div class="col-sm-4">
						<?php

							$sql = mysqli_query($db_con, "SELECT no_nota FROM transaksi_booking");
								echo '<input type="text" class="form-control" id="no_nota" value="';

							$no_nota = "CRWN001";
							if(mysqli_num_rows($sql) == 0){
								echo $no_nota;
							}

							$result = mysqli_num_rows($sql);
							$counter = 0;
							while(list($no_nota) = mysqli_fetch_array($sql)){
								if (++$counter == $result) {
									$no_nota++;
									echo $no_nota;
								}
							}
								echo '"name="no_nota" placeholder="No. Nota" readonly>';
						?>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-4 control-label">Nama Pelanggan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nama" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-4 control-label">Alamat Pelanggan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="" name="alamat_pelanggan" placeholder="Alamat Pelanggan" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-4 control-label">Email Pelanggan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="" name="email_pelanggan" placeholder="Email Pelanggan" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-4 control-label">Notelp</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="" name="notelp_pelanggan" placeholder="Notelp Pelanggan" required>
						</div>
					</div>
					<div class="form-group">
						<label for="jenis" class="col-sm-4 control-label">Jenis Kendaraan</label>
						<div class="col-sm-5">
							<select name="jenis" class="form-control" id="jenis" required>
								<option value="" disable> Pilih Jenis Kendaraan </option>
								<?php 
									$data = mysqli_query($db_con, "SELECT * FROM tipe_mobil ORDER BY id_merek_mobil DESC");
									while ($res =mysqli_fetch_array($data)){
										echo "<option value=".$res['id_tipe_mobil'].">".$res['nama_mobil']."</option>";
									}
								 ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="jenis_layanan" class="col-lg-4 control-label">Jenis Layanan</label>
						<div class="col-lg-5">
							<select name="" class="form-control" required="">
								<option value="">Pilih Jenis Layanan</option>
								<?php 
									$data = mysqli_query($db_con, "SELECT * FROM layanan ORDER BY id_layanan DESC");
									while ($res =mysqli_fetch_array($data)){
										echo "<option value=".$res['id_layanan'].">".$res['jenis_layanan']."</option>";
									}
								 ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="biaya" class="col-sm-4 control-label">Biaya</label>
						<div class="col-sm-5">
							<input type="number" class="form-control" id="biaya" name="biaya" value="" required>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-lg-5">
					<div class="col-lg-12">
		               <div class="panel outerlines-area">
		               		<?php if ($_GET['id']!='') { ?>
		               			<div class="border__booking">
			              		  <h2 class="text-center"><strong>Nomor Transaksi Anda</strong></h2>                  
				                  <h3 class="text-center"><?php echo $_GET['id']?></h3>
				                </div>
		               		<?php }else{ ?>
				                <div class="border__booking">
			              		  <h2 class="text-center"><strong>Nomor Antrian Anda</strong></h2>                  
				                  <h4 class="text-center"><span class="days-now"></span> <?php echo tgl_indo(date('Y-m-d')); ?><span id="jam"></span></h4>
				                </div>
				                <div class="queue__list__booking">
				                  <h1 class="text-center">1</h1>
				                </div>
		               		<?php } ?>
		                </div>
			            <div class="rown form-horizontal">
							<div class="form-group">
								<label for="total" class="col-sm-4 control-label">Total Transaksi</label>
								<div class="col-sm-7">
									<input 
										v-model.number="amountTotal"
										type="number" 
										class="form-control" 
										id="total" 
										name="total_transaksi" 
										readonly 
										value="<?php echo $getInformation['total'];?>"
									>
								</div>
							</div>
							<div class="form-group">
								<label for="bayar" class="col-sm-4 control-label">Bayar</label>
								<div class="col-sm-7">
									<input 
										v-model.number="bayar"
										type="number" 
										class="form-control" 
										id="bayar" 
										name="bayar" 
										placeholder="Isi dengan angka" 
										required
									>
								</div>
							</div>
							<div class="form-group">
								<label for="kembali" class="col-sm-4 control-label">Kembalian</label>
								<div v-if="bayar">
									<div class="col-sm-7">
										<span style="font-size: 2em;font-weight: bold;">{{formatPrice(result)}}</span>
									</div>
								</div>
							</div>
			            </div>
					</div>
			        <div class="terms-condition">
			            <p>Ketentuan : Untuk Melakukan prosedur booking / reservasi pencucian pelanggan di harapkan melakukan pemesanan pada jam operasional 
			            / jam kerja. Jam operasional 8.00 Am - 17.00 Pm </p>
			        </div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<div class="col-sm-offset-2 pull-right">
						<?php if ($_GET['id']!='') { ?>
						<button type="submit" name="submit" class="btn btn-success">Proses Transaksi</button>
						<?php }else{ ?>
						<button type="submit" name="submit" class="btn btn-success">Simpan</button>
						<?php } ?>
						<a href="./admin.php?hlm=transaksi" class="btn btn-danger">Batal</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<?php } } ?>

<script type="text/javascript">
    $(document).ready(function(){ 
		const appVue = new Vue ({
			el : '#app-vue',
			data :{
				amountTotal :'<?php echo $getInformation['total'];?>',
				bayar :0
			},
			methods: {
			    formatPrice(value) {
			        let val = (value/1).toFixed(2).replace('.', ',')
			        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			    },
			},
			computed:{
				result:function(){
					return this.bayar - this.amountTotal;
				},
			}
	  	});

	    $("#jenis").change(function(){
	      const jenis = $(this).val(); /* STORE THE SELECTED LOAD NUMBER TO THIS VARIABLE */
	      $.ajax({
	        type: "POST", /* METHOD TO USE TO PASS THE DATA */
	        url: "action.php", /* THE FILE WHERE WE WILL PASS THE DATA */
	        data: {"jenis": jenis}, /* THE DATA WE WILL PASS TO action.php */
	        dataType: 'json', /* DATA TYPE THAT WILL BE RETURNED FROM action.php */
	        success: function(result){
	          /* PUT CORRESPONDING RETURNED DATA FROM action.php TO THESE TWO TEXTBOXES */
	          $("#biaya").val(result.biaya);
	        }

	      }); 
	    }); 
  });
</script>