-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25 Jul 2017 pada 08.38
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sman8bandung`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_grafik_bulan_tahun`(IN `bulan` int,IN `tahun` int)
BEGIN
SELECT p.nama_pelanggaran,(SELECT COUNT(hp.id_pelanggaran) 
														FROM history_pelanggaran hp 
														WHERE hp.id_pelanggaran = p.id_pelanggaran AND 
																	MONTH(hp.tgl_pelanggaran)= bulan and 
																	YEAR(hp.tgl_pelanggaran)= tahun ) as JumlahPelanggaran 
FROM pelanggaran p
ORDER BY JumlahPelanggaran DESC ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_grafik_kelas`(IN `id_kelas` int)
BEGIN
	SELECT p.nama_pelanggaran,(SELECT COUNT(hp.id_pelanggaran) 
														FROM history_pelanggaran hp 
															WHERE hp.id_pelanggaran = p.id_pelanggaran AND hp.id_kelas =  id_kelas ) as JumlahPelanggaran 
FROM pelanggaran p
ORDER BY JumlahPelanggaran DESC ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_grafik_kelas_bulan_tahun`(IN `id_kelas` int,IN `bulan` int,IN `tahun` int)
BEGIN
SELECT p.nama_pelanggaran,(SELECT COUNT(hp.id_pelanggaran) 
														FROM history_pelanggaran hp 
														WHERE hp.id_pelanggaran = p.id_pelanggaran AND 
																	hp.id_kelas =  id_kelas and 
																	MONTH(hp.tgl_pelanggaran)= bulan and 
																	YEAR(hp.tgl_pelanggaran)= tahun ) as JumlahPelanggaran 
FROM pelanggaran p
ORDER BY JumlahPelanggaran DESC ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagian_kedisiplinan`
--

CREATE TABLE IF NOT EXISTS `bagian_kedisiplinan` (
  `nip` varchar(20) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `alamat_guru` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bagian_kedisiplinan`
--

INSERT INTO `bagian_kedisiplinan` (`nip`, `nama_guru`, `alamat_guru`, `no_hp`, `email`, `foto`) VALUES
('31200001', 'Agi k', 'Bandung 1', '0987876565459', 'aV@gmail.com', ''),
('admin', 'Admin', 'Bandung', '085659648698', 'admin@gmail.com', 'ps2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_kelas`
--

CREATE TABLE IF NOT EXISTS `histori_kelas` (
  `nis` varchar(20) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tahun_ajaran_masuk` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histori_kelas`
--

INSERT INTO `histori_kelas` (`nis`, `id_kelas`, `tahun_ajaran_masuk`) VALUES
('0616123007', 1, 2015),
('1234', 1, 1994),
('2345', 3, 2000),
('3456', 5, 2001);

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_pelanggaran`
--

CREATE TABLE IF NOT EXISTS `history_pelanggaran` (
`id_history` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `id_kelas` int(10) DEFAULT NULL,
  `id_pelanggaran` int(11) NOT NULL,
  `tgl_pelanggaran` date NOT NULL,
  `status_pelanggaran` varchar(25) NOT NULL,
  `tahun_pelanggaran` int(5) DEFAULT NULL,
  `sanksi_pelanggaran` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `history_pelanggaran`
--

INSERT INTO `history_pelanggaran` (`id_history`, `nis`, `id_kelas`, `id_pelanggaran`, `tgl_pelanggaran`, `status_pelanggaran`, `tahun_pelanggaran`, `sanksi_pelanggaran`) VALUES
(1, '0616123007', 2, 2, '2017-05-22', 'Belum Validasi', 2017, 'Terkena Sanksi 1'),
(3, '0616123007', 2, 4, '2017-07-06', 'Belum Validasi', 2017, 'Terkena Sanksi 2'),
(4, '0616123007', 2, 2, '2017-07-06', 'Belum Validasi', 2017, 'Terkena Sanksi 3'),
(5, '1234', 1, 4, '2017-07-05', 'Belum Validasi', 2017, 'Terkena Sanksi 4'),
(6, '2345', 3, 3, '2017-07-03', 'Belum Validasi', 2017, 'Terkena Sanksi 5'),
(7, '3456', 5, 1, '2017-07-02', 'Belum Validasi', 2017, 'Terkena Sanksi 6'),
(13, '0616123007', 2, 1, '2017-07-13', 'Belum Validasi', 2017, 'Terkena Sanksi 7'),
(14, '0616123007', 2, 1, '2016-02-01', 'Belum Validasi', 2016, 'Terkena Sanksi 8'),
(15, '0616123007', 2, 4, '2017-07-13', 'Belum Validasi', 2017, 'Terkena Sanksi 9'),
(16, '1234', 1, 5, '2017-07-17', 'Belum Validasi', 2017, 'Cium Tanah Sekolah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
`id_kelas` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `no_kelas` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`, `jurusan`, `no_kelas`) VALUES
(1, 'X', 'MIPA', 1),
(2, 'XI', 'MIPA', 1),
(3, 'XII', 'MIPA', 1),
(5, 'XII', 'MIPA', 3),
(6, 'X', 'MIPA', 3),
(7, 'X', 'Bahasa', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggaran`
--

CREATE TABLE IF NOT EXISTS `pelanggaran` (
`id_pelanggaran` int(11) NOT NULL,
  `nama_pelanggaran` text NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `pelanggaran`
--

INSERT INTO `pelanggaran` (`id_pelanggaran`, `nama_pelanggaran`, `point`) VALUES
(1, 'Sepatu tidak sesuai ketentuan (warna warni)', 5),
(2, 'Mewarnai Rambut', 4),
(3, 'Pacaran dilingkungan sekolah', 5),
(4, 'Merokok di sekolah', 10),
(5, 'Tidak memakai kaos kaki putih', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(20) NOT NULL,
  `id_wali_murid` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat_siswa` text NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status_surat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `id_wali_murid`, `nama_siswa`, `id_kelas`, `alamat_siswa`, `tempat_lahir`, `tgl_lahir`, `foto`, `status_surat`) VALUES
('0616123007', 'WM-1', 'Ahmad', 2, 'Bandung ', 'Bandung', '1999-02-28', 'nugraha.jpg', 'sudah-dicetak'),
('1234', 'WM-2', 'Alan', 1, 'Jambangan', 'Malang', '2001-06-21', '', 'sudah-dicetak'),
('2345', 'WM-3', 'Arga', 3, 'Sawoajajar', 'Malang', '1994-09-09', '', 'belum-dicetak'),
('3456', 'WM-4', 'Andre', 5, 'Plaosan', 'Surabaya', '2001-01-01', '', 'belum-dicetak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `role`) VALUES
('0616123007', '0616123007', 'Siswa'),
('1234', '1234', 'Siswa'),
('2345', '2345', 'Siswa'),
('31200001', '31200001', 'Bagian Kedisiplinan'),
('3456', '3456', 'Siswa'),
('4', '4', 'Siswa'),
('admin', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pelanggaran`
--
CREATE TABLE IF NOT EXISTS `v_pelanggaran` (
`nama_siswa` varchar(50)
,`alamat_siswa` text
,`tempat_lahir` varchar(50)
,`tgl_lahir` date
,`foto` varchar(100)
,`id_history` int(11)
,`tgl_pelanggaran` date
,`status_pelanggaran` varchar(25)
,`nama_pelanggaran` text
,`point` int(11)
,`kelas` varchar(20)
,`jurusan` varchar(50)
,`no_kelas` int(11)
,`nis` varchar(20)
,`id_pelanggaran` int(11)
,`id_kelas` int(11)
,`sanksi_pelanggaran` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pelanggaran_sum`
--
CREATE TABLE IF NOT EXISTS `v_pelanggaran_sum` (
`nama_siswa` varchar(50)
,`alamat_siswa` text
,`tempat_lahir` varchar(50)
,`tgl_lahir` date
,`foto` varchar(100)
,`id_history` int(11)
,`tgl_pelanggaran` date
,`status_pelanggaran` varchar(25)
,`nama_pelanggaran` text
,`point` decimal(32,0)
,`kelas` varchar(20)
,`jurusan` varchar(50)
,`no_kelas` int(11)
,`nis` varchar(20)
,`nama_wali` varchar(50)
,`email_wali` varchar(25)
,`no_hp_wali` varchar(13)
,`alamat_wali` text
,`id_wali_murid` varchar(20)
,`status_surat` varchar(50)
,`sanksi_pelanggaran` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_siswa`
--
CREATE TABLE IF NOT EXISTS `v_siswa` (
`nis` varchar(20)
,`nama_siswa` varchar(50)
,`alamat_siswa` text
,`tempat_lahir` varchar(50)
,`tgl_lahir` date
,`foto` varchar(100)
,`nama_wali` varchar(50)
,`alamat_wali` text
,`email_wali` varchar(25)
,`kelas` varchar(20)
,`jurusan` varchar(50)
,`no_kelas` int(11)
);
-- --------------------------------------------------------

--
-- Struktur dari tabel `wali_murid`
--

CREATE TABLE IF NOT EXISTS `wali_murid` (
  `id_wali_murid` varchar(20) NOT NULL,
  `nama_wali` varchar(50) NOT NULL,
  `alamat_wali` text NOT NULL,
  `no_hp_wali` varchar(13) NOT NULL,
  `email_wali` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wali_murid`
--

INSERT INTO `wali_murid` (`id_wali_murid`, `nama_wali`, `alamat_wali`, `no_hp_wali`, `email_wali`) VALUES
('WM-1', 'Gana D', 'bandung 1', '085659648698', 'na@gmail.com'),
('WM-2', 'Santo', 'Jambangan', '089', 'alan@gmail.com'),
('WM-3', 'Sigit', 'Sawojajar', '089', 'arga@gmial.com'),
('WM-4', 'Purnomo', 'Plaosan', '089', 'plaosan@gmail.om'),
('WM-5', 'f', 'f', '34', 'alan@gmail.com');

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pelanggaran`
--
DROP TABLE IF EXISTS `v_pelanggaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pelanggaran` AS select `siswa`.`nama_siswa` AS `nama_siswa`,`siswa`.`alamat_siswa` AS `alamat_siswa`,`siswa`.`tempat_lahir` AS `tempat_lahir`,`siswa`.`tgl_lahir` AS `tgl_lahir`,`siswa`.`foto` AS `foto`,`history_pelanggaran`.`id_history` AS `id_history`,`history_pelanggaran`.`tgl_pelanggaran` AS `tgl_pelanggaran`,`history_pelanggaran`.`status_pelanggaran` AS `status_pelanggaran`,`pelanggaran`.`nama_pelanggaran` AS `nama_pelanggaran`,`pelanggaran`.`point` AS `point`,`kelas`.`kelas` AS `kelas`,`kelas`.`jurusan` AS `jurusan`,`kelas`.`no_kelas` AS `no_kelas`,`siswa`.`nis` AS `nis`,`pelanggaran`.`id_pelanggaran` AS `id_pelanggaran`,`kelas`.`id_kelas` AS `id_kelas`,`history_pelanggaran`.`sanksi_pelanggaran` AS `sanksi_pelanggaran` from (((`siswa` join `history_pelanggaran` on(((`siswa`.`nis` = `history_pelanggaran`.`nis`) and (`siswa`.`nis` = `history_pelanggaran`.`nis`) and (`history_pelanggaran`.`nis` = `siswa`.`nis`) and (`history_pelanggaran`.`nis` = `siswa`.`nis`)))) join `pelanggaran` on((`pelanggaran`.`id_pelanggaran` = `history_pelanggaran`.`id_pelanggaran`))) join `kelas` on((`siswa`.`id_kelas` = `kelas`.`id_kelas`)));

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pelanggaran_sum`
--
DROP TABLE IF EXISTS `v_pelanggaran_sum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pelanggaran_sum` AS select `siswa`.`nama_siswa` AS `nama_siswa`,`siswa`.`alamat_siswa` AS `alamat_siswa`,`siswa`.`tempat_lahir` AS `tempat_lahir`,`siswa`.`tgl_lahir` AS `tgl_lahir`,`siswa`.`foto` AS `foto`,`history_pelanggaran`.`id_history` AS `id_history`,`history_pelanggaran`.`tgl_pelanggaran` AS `tgl_pelanggaran`,`history_pelanggaran`.`status_pelanggaran` AS `status_pelanggaran`,`pelanggaran`.`nama_pelanggaran` AS `nama_pelanggaran`,sum(`pelanggaran`.`point`) AS `point`,`kelas`.`kelas` AS `kelas`,`kelas`.`jurusan` AS `jurusan`,`kelas`.`no_kelas` AS `no_kelas`,`siswa`.`nis` AS `nis`,`wali_murid`.`nama_wali` AS `nama_wali`,`wali_murid`.`email_wali` AS `email_wali`,`wali_murid`.`no_hp_wali` AS `no_hp_wali`,`wali_murid`.`alamat_wali` AS `alamat_wali`,`wali_murid`.`id_wali_murid` AS `id_wali_murid`,`siswa`.`status_surat` AS `status_surat`,`history_pelanggaran`.`sanksi_pelanggaran` AS `sanksi_pelanggaran` from ((((`siswa` join `history_pelanggaran` on(((`siswa`.`nis` = `history_pelanggaran`.`nis`) and (`siswa`.`nis` = `history_pelanggaran`.`nis`) and (`history_pelanggaran`.`nis` = `siswa`.`nis`) and (`history_pelanggaran`.`nis` = `siswa`.`nis`)))) join `pelanggaran` on((`pelanggaran`.`id_pelanggaran` = `history_pelanggaran`.`id_pelanggaran`))) join `kelas` on((`siswa`.`id_kelas` = `kelas`.`id_kelas`))) join `wali_murid` on((`siswa`.`id_wali_murid` = `wali_murid`.`id_wali_murid`))) group by `history_pelanggaran`.`nis`;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_siswa`
--
DROP TABLE IF EXISTS `v_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_siswa` AS select `siswa`.`nis` AS `nis`,`siswa`.`nama_siswa` AS `nama_siswa`,`siswa`.`alamat_siswa` AS `alamat_siswa`,`siswa`.`tempat_lahir` AS `tempat_lahir`,`siswa`.`tgl_lahir` AS `tgl_lahir`,`siswa`.`foto` AS `foto`,`wali_murid`.`nama_wali` AS `nama_wali`,`wali_murid`.`alamat_wali` AS `alamat_wali`,`wali_murid`.`email_wali` AS `email_wali`,`kelas`.`kelas` AS `kelas`,`kelas`.`jurusan` AS `jurusan`,`kelas`.`no_kelas` AS `no_kelas` from ((`siswa` join `wali_murid` on((`siswa`.`id_wali_murid` = `wali_murid`.`id_wali_murid`))) join `kelas` on((`siswa`.`id_kelas` = `kelas`.`id_kelas`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian_kedisiplinan`
--
ALTER TABLE `bagian_kedisiplinan`
 ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `histori_kelas`
--
ALTER TABLE `histori_kelas`
 ADD PRIMARY KEY (`nis`,`id_kelas`), ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `history_pelanggaran`
--
ALTER TABLE `history_pelanggaran`
 ADD PRIMARY KEY (`id_history`,`id_pelanggaran`), ADD KEY `id_pelanggaran` (`id_pelanggaran`), ADD KEY `nis` (`nis`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
 ADD PRIMARY KEY (`id_pelanggaran`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`nis`,`id_wali_murid`), ADD KEY `id_wali_murid` (`id_wali_murid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `wali_murid`
--
ALTER TABLE `wali_murid`
 ADD PRIMARY KEY (`id_wali_murid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_pelanggaran`
--
ALTER TABLE `history_pelanggaran`
MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bagian_kedisiplinan`
--
ALTER TABLE `bagian_kedisiplinan`
ADD CONSTRAINT `bagian_kedisiplinan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `histori_kelas`
--
ALTER TABLE `histori_kelas`
ADD CONSTRAINT `histori_kelas_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `histori_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `history_pelanggaran`
--
ALTER TABLE `history_pelanggaran`
ADD CONSTRAINT `history_pelanggaran_ibfk_1` FOREIGN KEY (`id_pelanggaran`) REFERENCES `pelanggaran` (`id_pelanggaran`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `history_pelanggaran_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_wali_murid`) REFERENCES `wali_murid` (`id_wali_murid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
