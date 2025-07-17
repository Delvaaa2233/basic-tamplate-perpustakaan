<?php
include $_SERVER['DOCUMENT_ROOT'] . "/perpustakaan-main/inc/koneksi.php";

// Validasi input
if (!isset($_POST['pesan']) || empty($_POST['pesan'])) {
  echo "⚠️ Ups! Tidak ada pertanyaan yang dikirim.";
  exit;
}

$pesan = strtolower(trim($_POST['pesan']));
$response = "";

// =============================
// Logika Pertanyaan Chatbot
// =============================

// 1. Siswa paling aktif
if (strpos($pesan, "siswa aktif") !== false || strpos($pesan, "terbanyak") !== false) {
  $query = $koneksi->query("
    SELECT a.nama, COUNT(*) as total
    FROM log_pinjam l
    JOIN tb_anggota a ON l.id_anggota = a.id_anggota
    GROUP BY a.id_anggota
    ORDER BY total DESC
    LIMIT 1
  ");
  if ($query && $query->num_rows > 0) {
    $data = $query->fetch_assoc();
    $response = "👑 Siswa paling aktif adalah <b>{$data['nama']}</b> dengan total <b>{$data['total']}</b> peminjaman.";
  } else {
    $response = "Belum ada data peminjaman siswa saat ini.";
  }
}

// 2. Siswa yang belum mengembalikan buku
elseif (strpos($pesan, "belum balikin") !== false || strpos($pesan, "telat") !== false || strpos($pesan, "belum kembali") !== false) {
  $query = $koneksi->query("
    SELECT a.nama, COUNT(*) as total
    FROM tb_sirkulasi s
    JOIN tb_anggota a ON s.id_anggota = a.id_anggota
    WHERE s.status = 'Belum Kembali'
    GROUP BY s.id_anggota
    ORDER BY total DESC
    LIMIT 5
  ");
  if ($query && $query->num_rows > 0) {
    $response = "📚 Siswa yang belum mengembalikan buku:<br>";
    while ($data = $query->fetch_assoc()) {
      $response .= "- <b>{$data['nama']}</b> ({$data['total']} buku)<br>";
    }
  } else {
    $response = "🎉 Semua buku sudah dikembalikan oleh siswa.";
  }
}

// 3. Jumlah buku kategori referensi
elseif (strpos($pesan, "jumlah referensi") !== false || strpos($pesan, "buku referensi") !== false) {
  $query = $koneksi->query("
    SELECT COUNT(*) AS total FROM tb_buku WHERE kategori LIKE '%Referensi%'
  ");
  if ($query && $data = $query->fetch_assoc()) {
    $response = "📘 Jumlah buku kategori referensi: <b>{$data['total']}</b>.";
  } else {
    $response = "Data kategori referensi belum ditemukan.";
  }
}

// 4. Total buku keseluruhan
elseif (strpos($pesan, "jumlah buku") !== false || strpos($pesan, "total buku") !== false) {
  $query = $koneksi->query("SELECT COUNT(*) AS total FROM tb_buku");
  if ($query && $data = $query->fetch_assoc()) {
    $response = "📚 Total buku di perpustakaan: <b>{$data['total']}</b>.";
  } else {
    $response = "Belum bisa mengambil data buku.";
  }
}

// 5. Jumlah total anggota
elseif (strpos($pesan, "jumlah anggota") !== false || strpos($pesan, "berapa banyak anggota") !== false) {
  $query = $koneksi->query("SELECT COUNT(*) AS total FROM tb_anggota");
  if ($query && $data = $query->fetch_assoc()) {
    $response = "👥 Jumlah total anggota perpustakaan adalah <b>{$data['total']}</b>.";
  } else {
    $response = "Belum bisa mengambil data jumlah anggota.";
  }
}

// 6. Buku yang paling sering dipinjam
elseif (strpos($pesan, "buku sering dipinjam") !== false || strpos($pesan, "buku terfavorit") !== false) {
  $query = $koneksi->query("
    SELECT b.judul_buku, COUNT(*) AS total
    FROM log_pinjam lp
    JOIN tb_buku b ON lp.id_buku = b.id_buku
    GROUP BY b.id_buku
    ORDER BY total DESC
    LIMIT 1
  ");
  if ($query && $query->num_rows > 0) {
    $data = $query->fetch_assoc();
    $response = "📖 Buku yang paling sering dipinjam adalah <b>{$data['judul_buku']}</b> sebanyak <b>{$data['total']}</b> kali.";
  } else {
    $response = "Belum ada data peminjaman buku.";
  }
}

// 🔄 Pertanyaan belum dikenali
else {
  $response = "🤔 Maaf, saya belum paham pertanyaannya.<br>
  Coba gunakan kata kunci:<br>
  - <i>'Siswa aktif'</i><br>
  - <i>'Belum balikin'</i><br>
  - <i>'Jumlah referensi'</i><br>
  - <i>'Total buku'</i><br><br>
  - <i>'Jumlah anggota'</i><br>
  - <i>'Buku sering dipinjam'</i><br>
  Saya akan terus belajar untuk bantu lebih banyak pertanyaan 😊";
}

echo $response;
?>