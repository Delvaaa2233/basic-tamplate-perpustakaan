<?php
include "inc/koneksi.php";

// Ambil data statistik
$sql = $koneksi->query("SELECT count(id_buku) as buku from tb_buku");
$buku = $sql->fetch_assoc()['buku'];

$sql = $koneksi->query("SELECT count(id_anggota) as agt from tb_anggota");
$agt = $sql->fetch_assoc()['agt'];

$sql = $koneksi->query("SELECT count(id_sk) as pin from tb_sirkulasi where status='PIN'");
$pin = $sql->fetch_assoc()['pin'];

$sql = $koneksi->query("SELECT count(id_sk) as kem from tb_sirkulasi where status='KEM'");
$kem = $sql->fetch_assoc()['kem'];
?>

<!-- Tampilan Dashboard Petugas -->
<section class="content-header">
  <h1><i class="fa fa-dashboard"></i> Dashboard Petugas</h1>
  <small>Selamat datang di sistem informasi perpustakaan SMPN 2 Ampek Angkek. Yuk, cek data buku dan bantu siswa lebih cepat! 📘</small>
</section>

<section class="content">
  <div class="row">
    <!-- Total Buku -->
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= $buku; ?></h3>
          <p>Total Buku</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
      </div>
    </div>
    <!-- Total Anggota -->
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $agt; ?></h3>
          <p>Total Anggota</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
    <!-- Dipinjam -->
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $pin; ?></h3>
          <p>Buku Dipinjam</p>
        </div>
        <div class="icon">
          <i class="fa fa-arrow-circle-right"></i>
        </div>
      </div>
    </div>
    <!-- Dikembalikan -->
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $kem; ?></h3>
          <p>Buku Dikembalikan</p>
        </div>
        <div class="icon">
          <i class="fa fa-undo"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Akses ke Chatbot Internal -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-comments"></i> Chatbot Internal Petugas</h3>
    </div>
    <div class="box-body">
      <p>Ingin tahu siapa siswa paling aktif, jumlah koleksi buku, atau data pinjam terkini?</p>
      <a href="?page=chatbot" class="btn btn-primary">
        🔍 Buka Chatbot Sekarang
      </a>
    </div>
  </div>
</section>