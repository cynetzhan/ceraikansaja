-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Jan 2018 pada 15.26
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sicerai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_cerai`
--

CREATE TABLE IF NOT EXISTS `data_cerai` (
  `id` int(11) NOT NULL,
  `np` varchar(100) NOT NULL,
  `kec` text NOT NULL,
  `kel` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_cerai`
--

INSERT INTO `data_cerai` (`id`, `np`, `kec`, `kel`, `alamat`, `lat`, `lng`) VALUES
(2, '2011/PD01', 'Senapelan', 'Kuras', 'Jl. Kuras', 0.536927, 101.429),
(3, '2016', 'Tampan', 'Tampan', 'Jalan Taman Karya Pekanbaru', 0.123, 0.321),
(4, '2017', 'Tampan', 'Tampan', 'Jelan Taman Karya Pekanbaru', 0.323232, 0.324432),
(5, '2017001345', 'Rumbai', 'Sri Meranti', 'Jalan Kumpul Kebo', 0, 0),
(6, '524 HUB', 'Tampan', 'Tampan', 'Jalan Pandau Pekanbaru', 0.445201, 101.452),
(7, '657', 'Tampan', 'Tampan', 'Jalan Jenderal Sudirman Pekanbaru', 0.505122, 101.452),
(8, '739/Pdt-G/2015/PA-PKU', 'Pekanbaru Kota', 'Simpang Empat', 'Jl. Sambu No.11', 0.516003, 101.45),
(9, '20/10/1002', 'Tenayan Raya', 'Rejosari', 'Jl. Utama', 0.520069, 101.477),
(13, '20/10/1003', 'Tenayan Raya', 'Rejosari', 'Jl. Hangtuan', 0.513516, 101.489),
(14, '20/10/1004', 'Tampan', 'Panam', 'Jl. Merak Sakti', 0.468532, 101.389);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `type` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `nama`, `pass`, `type`) VALUES
(3, 'Hendrieka', '21232f297a57a5a743894a0e4a801fc3', 0),
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(5, 'kitaaja', 'd8a809bcff99ee627324319502896c87', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id_artikel` int(11) NOT NULL,
  `judul_artikel` varchar(70) NOT NULL,
  `tgl_terbit_artikel` datetime NOT NULL,
  `isi_artikel` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_artikel`, `judul_artikel`, `tgl_terbit_artikel`, `isi_artikel`) VALUES
(1, 'Visi dan Misi', '2018-01-20 11:42:19', '&lt;h4 style=&quot;margin: 10px 0px; font-family: &#039;Droid Sans&#039;, sans-serif; line-height: 20px; text-rendering: optimizeLegibility; font-size: 17.5px; text-align: justify;&quot;&gt;VISI, MISI DAN TUJUAN&lt;/h4&gt;\r\n&lt;p style=&quot;margin: 0px 0px 10px; font-family: &#039;Droid Sans&#039;, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Berdasarkan analisa terhadap pernyataan politik Bupati dan Wakil Bupati semasa kampanye Pilkada, kemudian kondisi umum dan masalah pembangunan serta isu-isu strategis Kabupaten Pelalawan saat ini yang menjadi tantangan lima tahunan kedepan, dengan memperhitungkan sumber daya sebagai modal dasar yang dimiliki. Maka Visi pembangunan RPJMD Kabupaten Tahun 2011 &amp;ndash; 2016 :&lt;/p&gt;\r\n&lt;div style=&quot;margin: 10px 0px; font-family: &#039;Droid Sans&#039;, sans-serif; font-size: 16px; text-align: center; font-weight: bold;&quot;&gt;VISI KABUPATEN PELALAWAN&lt;/div&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;div style=&quot;margin: 10px 0px; font-family: &#039;Droid Sans&#039;, sans-serif; font-size: 12px; text-align: center; font-weight: bold;&quot;&gt;&quot; TERWUJUDNYA KABUPATEN PELALAWAN MAJU DAN SEJAHTERA, MELALUI PEMBERDAYAAN EKONOMI KERAKYATAN YANG DIDUKUNG OLEH PERTANIAN YANG UNGGUL DAN INDUSTRI YANG TANGGUH DALAM MASYARAKAT YANG BERADAT, BERIMAN, BERTAQWA DAN BEBUDAYA MELAYU TAHUN 2030 &quot;&lt;/div&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 10px; font-family: &#039;Droid Sans&#039;, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Rumusan Visi tersebut diatas mengandung makna sebagai berikut :&lt;/p&gt;\r\n&lt;ul style=&quot;padding: 0px; margin: 0px 0px 10px 25px; font-family: &#039;Droid Sans&#039;, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;\r\n&lt;li style=&quot;line-height: 20px;&quot;&gt;Kabupaten Pelalawan yang maju dan sejahtera&lt;/li&gt;\r\n&lt;li style=&quot;line-height: 20px;&quot;&gt;Pemberdayaan Ekonomi Kerakyatan&lt;/li&gt;\r\n&lt;li style=&quot;line-height: 20px;&quot;&gt;Pertanian yang unggul&lt;/li&gt;\r\n&lt;li style=&quot;line-height: 20px;&quot;&gt;Masyarakat beriman dan bertaqwa serta bebudaya melayu&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p style=&quot;margin: 0px 0px 10px; font-family: &#039;Droid Sans&#039;, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;div style=&quot;margin: 10px 0px; font-family: &#039;Droid Sans&#039;, sans-serif; font-size: 16px; text-align: center; font-weight: bold;&quot;&gt;MISI KABUPATEN PELALAWAN&lt;/div&gt;\r\n&lt;p style=&quot;margin: 0px 0px 10px; font-family: &#039;Droid Sans&#039;, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Meningkatkan kualitas kehidupan dengan terpenuhinya kebutuhan dasar, sandang pangan, papan, pendidikan, kesehatan, bermartabat dan berbudaya. Menciptakan lapangan kerja yang meningkatkan pendapatan masyarakat masyarakat melalui pembangunan usaha ekonomi kerakyatan. Meningkatkan hasil dan mutu pertanian melalui pemanfaatkan teknologi berbasis agrobisnis serta pengelolaan hutan-hutan yang lestari. Menciptakan dan membina industri yang mampu menghasilkan produk yang berdaya saing dan berwawasan lingkungan. Peningkatan pengamalan ajaran agama dalam kehidupan sehari-hari melalui pendidikan agama dan memfungsikan lembaga-lembaga keagamaan sebagai wadah pembinaan umat.&lt;/p&gt;'),
(3, 'Struktur Organisasi', '2017-10-01 09:54:57', ''),
(4, 'Kontak Kami', '2018-01-24 10:03:26', '&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: large;&quot;&gt;Kontak Kami Ya&lt;/span&gt;&lt;/p&gt;');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_cerai`
--
ALTER TABLE `data_cerai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_artikel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_cerai`
--
ALTER TABLE `data_cerai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
