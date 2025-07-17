<section class="content-header">
<h1 style="text-align:center; color:green;">Selamat datang di Dashboard Statistik 📊</h1>  
<h2 style="text-align:center;">DASHBOARD STATISTIK</h2>
</section>

<section class="content">
  <div class="row">
    <!-- Jumlah Peminjaman per Siswa -->
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Jumlah Peminjaman per Siswa</h3>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead><tr><th>No</th><th>Nama</th><th>Total Pinjam</th></tr></thead>
            <tbody>
              <?php
                $no = 1;
                $sql = $koneksi->query("SELECT a.nama, COUNT(*) as total_pinjam
                  FROM log_pinjam l
                  JOIN tb_anggota a ON l.id_anggota = a.id_anggota
                  GROUP BY a.id_anggota
                  ORDER BY total_pinjam DESC");
                while ($data = $sql->fetch_assoc()) {
              ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['total_pinjam']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Buku Paling Banyak Dipinjam -->
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Top 5 Buku Terfavorit</h3>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead><tr><th>No</th><th>Judul Buku</th><th>Dipinjam</th></tr></thead>
            <tbody>
              <?php
                $no = 1;
                $sql2 = $koneksi->query("SELECT b.judul_buku, COUNT(*) as jumlah_dipinjam
                  FROM log_pinjam l
                  JOIN tb_buku b ON l.id_buku = b.id_buku
                  GROUP BY b.id_buku
                  ORDER BY jumlah_dipinjam DESC
                  LIMIT 5");
                while ($buku = $sql2->fetch_assoc()) {
              ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $buku['judul_buku']; ?></td>
                <td><?= $buku['jumlah_dipinjam']; ?>x</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>