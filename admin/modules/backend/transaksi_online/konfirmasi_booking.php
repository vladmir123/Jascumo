<?php include '../../../../config/koneksi.php';
	$act = $_GET['act'];

	if ($act =='konfirmasi') {

        $id_transaksi = $_GET['id'];
        $queue        = $_GET['queue'];
        $sql          = "UPDATE transaksi_booking SET status_pemesanan='konfrimasi', checkin_noantrian='$queue' WHERE no_nota='$id_transaksi'";
        $processDb = mysqli_query($db_con,$sql);

        if($processDb){
            echo "<script>alert('Transaksi booking berhasil di konfirmasi !!')</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=transaksi_online>";
        }else{
            echo "<script>alert('Transaksi booking gagal di konfirmasi !!')</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=transaksi_online>";
        }


    }else if($act=='progress_cuci'){
		$id_transaksi = $_GET['id'];

        $sql       = "UPDATE transaksi_booking SET status_pemesanan='progress' WHERE no_nota='$id_transaksi'";
        $processDb = mysqli_query($db_con,$sql);

        if($processDb){
            echo "<script>alert('Transaksi berhasil di update ke status pengerjaan / pencucian !!')</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=daftarantri>";
        }else{
            echo "<script>alert('Transaksi booking gagal di update ke status pengerjaan / pencucian !!')</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=daftarantri>";
        }


    }else if ($act=='selesai_cuci'){
        $id_transaksi = $_GET['id'];
        //validasi
        $getStatusPrevius = mysqli_fetch_array(mysqli_query($db_con,"SELECT status_pemesanan FROM transaksi_booking WHERE no_nota='$id_transaksi'"));
        $status = $getStatusPrevius['status_pemesanan'];
        if ($status == 'konfrimasi') {
            echo "<script>alert('Maaf mobil anda belum melalui prosess pencucian !!')</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=daftarantri>";
        }else{
            $sql       = "UPDATE transaksi_booking SET status_pemesanan='selesai' WHERE no_nota='$id_transaksi'";
            $processDb = mysqli_query($db_con,$sql);

            if($processDb){
                echo "<script>alert('Transaksi berhasil di update ke status pengerjaan / pencucian !!')</script>";
                echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=daftarantri>";
            }else{
                echo "<script>alert('Transaksi booking gagal di konfirmasi !!')</script>";
                echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=daftarantri>";
            }

        }

    }else if ($act=='lunas'){
        
        $id_transaksi = $_GET['id'];

        $sql       = "UPDATE transaksi_booking SET status_pemesanan='lunas' WHERE no_nota='$id_transaksi'";
        $processDb = mysqli_query($db_con,$sql);

        if($processDb){
            echo "<script>alert('Transaksi berhasil di update ke status lunas !!')</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=transaksi_online>";
        }else{
            echo "<script>alert('Transaksi booking gagal di update ke status lunas !!')</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."admin/admin.php?hlm=transaksi_online>";
        }

    }


?>