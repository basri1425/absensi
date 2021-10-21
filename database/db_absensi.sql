-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Sep 2021 pada 15.41
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `level`) VALUES
(4, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `analisis_kehadiran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `analisis_kehadiran` (
`tanggal` int(2)
,`bulan` int(2)
,`tahun` int(4)
,`kelas` varchar(100)
,`pertemuan` int(11)
,`siswa` char(20)
,`status_kehadiran` int(11)
,`keterangan` int(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nip` char(20) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `jk` char(1) NOT NULL,
  `wali_kelas` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama_guru`, `jk`, `wali_kelas`, `password`) VALUES
(18, '2101017', 'DR.WIDYAASTUTI S.PD', 'P', 'VII1', '827ccb0eea8a706c4c34a16891f84e7b'),
(19, '2101020', 'ADI SUMARYONO P.S.SI, M.SI.', 'L', 'VII2', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `pertemuan` int(11) NOT NULL,
  `siswa` char(20) NOT NULL,
  `status_kehadiran` int(11) NOT NULL,
  `keterangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kehadiran`
--

INSERT INTO `kehadiran` (`id_kehadiran`, `pertemuan`, `siswa`, `status_kehadiran`, `keterangan`) VALUES
(512, 70, '0053750353', 1, 0),
(513, 70, '0051232207', 0, 3),
(514, 70, '0020913912', 1, 0),
(515, 70, '0034211369', 1, 0),
(516, 70, '0030518350', 1, 0),
(517, 70, '0045833596', 0, 1),
(518, 70, '0067966768', 1, 0),
(519, 70, '5330346945', 1, 0),
(520, 70, '6893110214', 0, 3),
(521, 70, '1344466626', 1, 0),
(522, 70, '5495990210', 1, 0),
(523, 71, '0053750353', 1, 0),
(524, 71, '0051232207', 0, 2),
(525, 71, '0020913912', 1, 0),
(526, 71, '0034211369', 1, 0),
(527, 71, '0030518350', 1, 0),
(528, 71, '0045833596', 1, 0),
(529, 71, '0067966768', 0, 3),
(530, 71, '5330346945', 1, 0),
(531, 71, '6893110214', 1, 0),
(532, 71, '1344466626', 1, 0),
(533, 71, '5495990210', 1, 0),
(578, 76, '6893110214', 1, 0),
(579, 76, '5495990210', 1, 0),
(580, 76, '9723440214', 0, 2),
(581, 76, '9764429161', 1, 0),
(582, 76, '1174569964', 1, 0),
(583, 76, '86187869', 1, 0),
(584, 76, '1185724598', 0, 1),
(585, 76, '1155045947', 0, 3),
(586, 76, '634509872', 0, 2),
(587, 76, '76654386', 1, 0),
(588, 77, '442356577', 1, 0),
(589, 77, '641782623', 0, 2),
(590, 77, '678091801', 1, 0),
(591, 77, '692103443', 1, 0),
(592, 77, '957342505', 1, 0),
(593, 77, '892281147', 1, 0),
(594, 77, '562424321', 1, 0),
(595, 77, '612049596', 0, 3),
(596, 77, '994320399', 1, 0),
(597, 77, '996318045', 1, 0),
(598, 78, '6893110214', 1, 0),
(599, 78, '5495990210', 0, 3),
(600, 78, '9723440214', 1, 0),
(601, 78, '9764429161', 1, 0),
(602, 78, '1174569964', 1, 0),
(603, 78, '86187869', 0, 3),
(604, 78, '1185724598', 1, 0),
(605, 78, '1155045947', 1, 0),
(606, 78, '634509872', 0, 2),
(607, 78, '76654386', 1, 0),
(608, 79, '6893110214', 0, 3),
(609, 79, '5495990210', 1, 0),
(610, 79, '9723440214', 1, 0),
(611, 79, '9764429161', 1, 0),
(612, 79, '1174569964', 1, 0),
(613, 79, '86187869', 1, 0),
(614, 79, '1185724598', 0, 1),
(615, 79, '1155045947', 1, 0),
(616, 79, '634509872', 0, 3),
(617, 79, '76654386', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kode_kelas` varchar(100) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kode_kelas`, `nama_kelas`) VALUES
(5, 'VII3', 'VII 3'),
(6, 'VII1', 'VII 1'),
(7, 'VII2', 'VII 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `kode_mapel` char(10) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `kode_mapel`, `nama_mapel`) VALUES
(4, 'MTK', 'MATEMATIKA'),
(5, 'IND', 'BAHASA INDONESIA'),
(6, 'ING', 'BAHASA INGGRIS'),
(7, 'FSK', 'FISIKA'),
(8, 'KMA', 'KIMIA'),
(9, 'BLG', 'BIOLOGI'),
(10, 'EKM', 'EKONOMI'),
(11, 'GFI', 'GEOGRAFI'),
(12, 'SLG', 'SOSIOLOGI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertemuan`
--

CREATE TABLE `pertemuan` (
  `id_pertemuan` int(11) NOT NULL,
  `guru` char(10) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `mapel` char(10) NOT NULL,
  `pertemuan_ke` int(11) NOT NULL,
  `topik` text NOT NULL,
  `tanggal` date NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pertemuan`
--

INSERT INTO `pertemuan` (`id_pertemuan`, `guru`, `kelas`, `mapel`, `pertemuan_ke`, `topik`, `tanggal`, `mulai`, `selesai`) VALUES
(76, '2101017', 'VII1', 'MTK', 1, 'Himpunan', '2021-09-01', '08:00:00', '10:00:00'),
(77, '2101017', 'VII2', 'MTK', 1, 'Himpunan', '2021-09-02', '13:00:00', '15:00:00'),
(78, '2101017', 'VII1', 'MTK', 2, 'Bilangan', '2021-09-03', '10:00:00', '12:00:00'),
(79, '2101017', 'VII1', 'MTK', 3, 'Barisan dan Deret', '2021-09-04', '08:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `jk` char(1) NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nama_siswa`, `jk`, `kelas`) VALUES
(11, '0053750353', 'NUR OKTA RAMANDANI', 'P', 'VII3'),
(12, '0051232207', 'ADELLIVIA VIETTRIX ANANDA', 'P', 'VII3'),
(13, '0020913912', 'SATRIA TEGAR PAMUNGKAS', 'L', 'VII3'),
(14, '0034211369', 'PUTRI OKTAVIA NENDISSA', 'P', 'VII3'),
(15, '0030518350', 'TRI HANGGORO ISA SAPUTERA', 'L', 'VII3'),
(16, '0045833596', 'BAGUS RIO DWI KUSSUMA', 'L', 'VII3'),
(17, '0067966768', 'ELISA NUR FASANA', 'P', 'VII3'),
(20, '5330346945', 'ALEXANDER BRYAN NURHASTO', 'L', 'VII3'),
(21, '6893110214', 'AJENG TRI MULIA MAULIDA', 'P', 'VII1'),
(22, '1344466626', 'ALIF FATIH FIRAAS PRAYOGA', 'L', 'VII3'),
(23, '5495990210', 'ARDHYA NARESWARI CANDRAKIRANA', 'L', 'VII1'),
(43, '9723440214', 'AGUSTINA NINA NATANIA', 'P', 'VII1'),
(44, '9764429161', 'DHANIEL RADYA MAHARDIKA', 'L', 'VII1'),
(45, '1174569964', 'HANDEKA AKBAR KURNIA', 'L', 'VII1'),
(46, '86187869', 'MOHAMAD DANI SAPUTRA', 'L', 'VII1'),
(47, '1185724598', 'GALIH FAJAR PRABOWO', 'L', 'VII1'),
(48, '1155045947', 'KANIA SEVILLA PUTRI', 'P', 'VII1'),
(49, '634509872', 'RIDHA PRASETYO', 'L', 'VII1'),
(50, '76654386', 'ZAHRA AMELIA', 'P', 'VII1'),
(51, '818570733', 'OLIVIA HUMAIRA BUDIYANTO', 'P', 'VII3'),
(52, '442356577', 'AHMAD FAUZAN', 'L', 'VII2'),
(53, '641782623', 'ANANDA OKTAVIA', 'P', 'VII2'),
(54, '678091801', 'CHRISTIAN SINAGA', 'L', 'VII2'),
(55, '692103443', 'DEVINA AYU AZIZAH', 'P', 'VII2'),
(56, '957342505', 'AMANDA MEDINA', 'P', 'VII2'),
(57, '892281147', 'ANNISA FEBRIANTI', 'P', 'VII2'),
(58, '562424321', 'AZKA AZIZAH', 'L', 'VII2'),
(59, '612049596', 'DZAKI NUR FALAH', 'L', 'VII2'),
(60, '994320399', 'FEBRI PURNAMA AJI', 'P', 'VII2'),
(61, '996318045', 'IRFAN AZIZ PRATAMA', 'L', 'VII2');

-- --------------------------------------------------------

--
-- Struktur untuk view `analisis_kehadiran`
--
DROP TABLE IF EXISTS `analisis_kehadiran`;

CREATE VIEW `analisis_kehadiran`  AS SELECT dayofmonth(`p`.`tanggal`) AS `tanggal`, month(`p`.`tanggal`) AS `bulan`, year(`p`.`tanggal`) AS `tahun`, `p`.`kelas` AS `kelas`, `p`.`id_pertemuan` AS `pertemuan`, `k`.`siswa` AS `siswa`, `k`.`status_kehadiran` AS `status_kehadiran`, `k`.`keterangan` AS `keterangan` FROM (`pertemuan` `p` join `kehadiran` `k` on(`k`.`pertemuan` = `p`.`id_pertemuan`)) GROUP BY `p`.`tanggal`, month(`p`.`tanggal`), year(`p`.`tanggal`), `p`.`kelas`, `p`.`id_pertemuan`, `k`.`siswa`, `k`.`status_kehadiran`, `k`.`keterangan` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indeks untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=618;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
