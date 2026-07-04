SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
 /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 /*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_perpus`
--

CREATE DATABASE IF NOT EXISTS `data_perpus`;
USE `data_perpus`;

-- --------------------------------------------------------
-- Struktur dari tabel `log_pinjam`
-- --------------------------------------------------------
CREATE TABLE `log_pinjam` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_buku` (`id_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `log_pinjam` (`id_log`, `id_buku`, `id_anggota`, `tgl_pinjam`) VALUES
(1, 'B001', 'A001', '2020-06-23'),
(2, 'B002', 'A001', '2020-06-25'),
(3, 'B003', 'A002', '2020-06-01'),
(4, 'B002', 'A005', '2020-06-23');

-- --------------------------------------------------------
-- Struktur dari tabel `tb_anggota`
-- --------------------------------------------------------
CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jekel` enum('Laki-laki','Perempuan') NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_anggota` VALUES
('A001', 'Ana', 'Perempuan', 'juwana', '089987789000'),
('A002', 'Bagus', 'Laki-laki', 'demak', '089987789098'),
('A003', 'Citra', 'Perempuan', 'demak', '085878526048'),
('A004', 'Didik', 'Laki-laki', 'pati', '087789987654'),
('A005', 'Edi', 'Laki-laki', 'demak', '089987789098');

-- --------------------------------------------------------
-- Struktur dari tabel `tb_buku`
-- --------------------------------------------------------
CREATE TABLE `tb_buku` (
  `id_buku` varchar(10) NOT NULL,
  `judul_buku` varchar(30) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `penerbit` varchar(30) NOT NULL,
  `th_terbit` year(4) NOT NULL,
  `jumlah_buku` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_buku` VALUES
('B001', 'Matematika', 'Pelajaran', 'Anastasya', 'Armi Print', 2010, 10),
('B002', 'RPL 2', 'Teknik', 'Eko', 'UMK', 2020, 5),
('B003', 'C++', 'Pemrograman', 'Anton', 'Toni Perc', 2010, 7),
('B004', 'CI 4', 'Framework', 'Anastasya', 'Armi Print', 2009, 3),
('B005', 'Data Mining', 'Komputer', 'Anton', 'Toni Perc', 2020, 4);

-- --------------------------------------------------------
-- Struktur dari tabel `tb_pengguna`
-- --------------------------------------------------------
CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `level` enum('Administrator','Petugas') NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_pengguna` VALUES
(1, 'Fadhel Muhammad', 'admin', md5('123'), 'Administrator');

-- --------------------------------------------------------
-- Struktur dari tabel `tb_sirkulasi`
-- --------------------------------------------------------
CREATE TABLE `tb_sirkulasi` (
  `id_sk` varchar(20) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` enum('PIN','KEM') NOT NULL,
  PRIMARY KEY (`id_sk`),
  KEY `id_buku` (`id_buku`),
  KEY `id_anggota` (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_sirkulasi` VALUES
('S001', 'B001', 'A001', '2020-06-23', '2020-06-30', 'KEM'),
('S002', 'B002', 'A001', '2020-06-13', '2020-06-20', 'PIN'),
('S003', 'B003', 'A002', '2020-06-22', '2020-06-29', 'PIN'),
('S004', 'B002', 'A005', '2020-06-23', '2020-06-30', 'PIN');

-- --------------------------------------------------------
-- Foreign Key Constraints
-- --------------------------------------------------------
ALTER TABLE `log_pinjam`
  ADD CONSTRAINT `log_pinjam_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_pinjam_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tb_sirkulasi`
  ADD CONSTRAINT `tb_sirkulasi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_sirkulasi_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
