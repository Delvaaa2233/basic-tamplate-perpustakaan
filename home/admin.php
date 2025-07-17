<?php
	$sql = $koneksi->query("SELECT count(id_buku) as buku from tb_buku");
	while ($data= $sql->fetch_assoc()) {
	
		$buku=$data['buku'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_anggota) as agt from tb_anggota");
	while ($data= $sql->fetch_assoc()) {
	
		$agt=$data['agt'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_sk) as pin from tb_sirkulasi where status='PIN'");
	while ($data= $sql->fetch_assoc()) {
	
		$pin=$data['pin'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_sk) as kem from tb_sirkulasi where status='KEM'");
	while ($data= $sql->fetch_assoc()) {
	
		$kem=$data['kem'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_sk) as kem from tb_sirkulasi where status='KEM'");
	while ($data= $sql->fetch_assoc()) {
	
		$kem=$data['kem'];
	}
?>

