<?php 
if(empty($_SESSION['id_user'])){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
}else{
	if(isset($_REQUEST['aksi'])){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
				include 'transaksi_baru.php';
				break;
			case 'edit':
				include 'transaksi_edit.php';
				break;
			case 'hapus':
				include 'transaksi_hapus.php';
				break;
			case 'cetak':
				include 'cetak_nota.php';
				break;
		}
	}else{ ?>
			<div class="container">
				<h3>Daftar Antrian Crown Cars Wash</h3>
				<div class="clearfix form-group"></div>
				<table class="table table-bordered table-hover" id="table-daftarantri">
				 <thead>
				   <tr class="info">
					 <th>No</th>
					 <th>No. Nota</th>
					 <th>Nama Pelanggan</th>
					 <th>Nama Kendaraan	</th>
					 <th>Jenis+ Harga</th>
					 <th>Antar Jemput</th>
					 <th>Total Bayar</th>
					 <th>Tanggal Pesan</th>
					 <th>Antrian Pengerjaan</th>
					 <th>Tindakan</th>
				   </tr>
				 </thead>
				 <tbody>
		 	<?php 
			//skrip untuk menampilkan data dari database
		 	$sql = mysqli_query($db_con, "SELECT * FROM transaksi_booking tb
		 								  JOIN layanan la ON tb.id_layanan=la.id_layanan
		 								  JOIN tipe_mobil tm ON tb.id_tipe_mobil=tm.id_tipe_mobil
		 								  JOIN merek_mobil mm ON tm.id_merek_mobil=mm.id_merek_mobil 
		 								  LEFT JOIN member m ON tb.id_member=m.id_member
		 								  WHERE tb.status_pemesanan='konfrimasi'
		 								  ORDER BY tb.checkin_noantrian ASC");
		 	$getMmeber = mysqli_fetch_array(mysqli_query($db_con,"SELECT * FROM member WHERE id_member='$_GET[id_member]'"));
		 	if(mysqli_num_rows($sql) > 0){
		 		$no = 0;

				 while($row = mysqli_fetch_array($sql)){
	 				$no++;
	 			echo '

				   <tr>
					 <td>'.$no.'</td>
					 <td>'.$row['no_nota'].'</td>
					 <td>'.$row['nama_member'].'</td>
					 <td>'.$row['nama_kendaraan'].' '.$row['nama_mobil'].'</td>
					 <td>'.$row['jenis_layanan'].' Rp.'.formatuang($row['harga_layanan']).'</td>
					 <td></td>
					 <td>Rp. '.formatuang($row['total']).'</td>
					 <td>'.date("d M Y", strtotime($row['tanggal_pesan'])).'</td>
					 <td style="background-color:#ff0a0a;color:#fff;font-size:1.6em;" class="text-center">'.$row['checkin_noantrian'].'</td>
					 <td>
					 	<div class="dropdown">
						  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Aksi
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
						    <li><a href="?hlm=transaksi&='.$row['no_nota'].'">Proses Pembayaran</a></li>
						</div>
					</td>';
				}
					 	// <a href="#" class="btn btn-info btn-s">Konfirmasi</a>
					 	// <a href="?hlm=transaksi&aksi=hapus&submit=yes&id_transaksi='.$row['id_transaksi'].'" onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
			}else{
				 echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
			}
			echo '
			 	</tbody>
			</table>
		</div>';
	}
}
?>
<style type="text/css">
	.dataTables_filter {
		margin-left: 25em;
	}
	#table-daftarantri_paginate{
		margin-left: 36em;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#table-daftarantri').DataTable();
	});
	function konfirmasi(){
		tanya = confirm("Anda yakin akan menghapus data ini?");
		if (tanya == true) return true;
		else return false;
	}
</script>