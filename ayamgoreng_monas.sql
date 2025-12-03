-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2025 at 09:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ayamgoreng_monas`
--

-- --------------------------------------------------------
create database if not exists ayamgoreng_monas;
use ayamgoreng_monas;
--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `gambar`, `deskripsi`) VALUES
(1, 'Ayam Goreng Monas Buka Cabang Baru di Samarinda!', 'berita1.jpg', 'Ayam Goreng Monas resmi membuka cabang baru di Samarinda pada awal bulan ini. Cabang terbaru ini hadir dengan konsep modern dan area makan lebih luas untuk memberikan pengalaman terbaik kepada pelanggan. Dengan menu andalan seperti Paket Ayam Monas dan Chicken Strip yang menjadi favorit, cabang baru ini diharapkan dapat memenuhi permintaan pelanggan yang terus meningkat. Banyak warga sekitar yang antusias dan sudah memadati lokasi sejak hari pertama pembukaan.'),
(2, 'Menu Favorit Ayam Goreng Monas Kini Tersedia Dalam Paket Hemat!', 'berita2.jpg', 'Untuk memenuhi kebutuhan pelanggan, Ayam Goreng Monas merilis Paket Hemat terbaru yang berisi ayam goreng krispi, nasi, minuman segar, dan pilihan tambahan lauk. Paket ini dirancang khusus untuk pelanggan yang ingin menikmati menu lezat dengan harga lebih terjangkau. Selain itu, promo Paket Hemat ini akan tersedia sepanjang bulan, sehingga pelanggan bisa menikmatinya kapan saja tanpa khawatir kehabisan.');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `id` int NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `link_story` varchar(255) DEFAULT NULL,
  `link_menu` varchar(255) DEFAULT NULL,
  `link_news` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text,
  `maps_embed` text,
  `instagram` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `x` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `logo`, `slogan`, `link_story`, `link_menu`, `link_news`, `whatsapp`, `email`, `alamat`, `maps_embed`, `instagram`, `tiktok`, `x`, `facebook`) VALUES
(1, 'Logo.png', 'Enak Tiada Tanding', 'story.php', 'menu.php', 'news.php', 'https://wa.me/6281234567890', 'ayamgorengmonas@gmail.com', 'Samarinda Central Plaza lantai 3 Jl. P. Irian No.1, Karang Mumus, Kec. Samarinda Kota, Kota Samarinda', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d498.7080246178035!2d117.154641543488!3d-0.5036127999999974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f9e7cce7495%3A0x61022452c2cacfea!2sSamarinda%20Central%20Plaza!5e0!3m2!1sid!2sid!4v1764164547398!5m2!1sid!2sid\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '#', '#', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `id` int NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `nama_bisnis` varchar(255) DEFAULT NULL,
  `location_url` varchar(255) DEFAULT NULL,
  `nav_home` varchar(255) DEFAULT 'Beranda',
  `nav_story` varchar(255) DEFAULT 'Cerita Kami',
  `nav_menu` varchar(255) DEFAULT 'Menu',
  `nav_news` varchar(255) DEFAULT 'Berita',
  `nav_review` varchar(255) DEFAULT 'Ulasan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id`, `logo`, `nama_bisnis`, `location_url`, `nav_home`, `nav_story`, `nav_menu`, `nav_news`, `nav_review`) VALUES
(1, 'Logo.png', 'Ayam Goreng Monas', 'index.php', 'Beranda', 'Cerita Kami', 'Menu', 'Berita', 'Ulasan');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `jam` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama`, `alamat`, `jam`, `gambar`) VALUES
(1, 'AGM Mall SCP', 'Samarinda Central Plaza lantai 3 Jl. P. Irian No.1, Karang Mumus, Kec. Samarinda Kota, Kota Samarinda', '10.00 - 22.00 WIB', 'scp2.webp'),
(2, 'AGM Mall Lembuswana', 'Lembuswana lantai dasar jl. Mayor Jendral S. Parman No.28, Gunung kelua, Samarinda Kota, Kota Samarinda', '10.00 - 22.00 WIB', 'Back1.jpg'),
(3, 'AGM Mall Samarinda Square', 'Samarinda Square lantai 1 Jl. M. Yamin Gunung kelua, Samarinda Ulu, Kota Samarinda', '10.00 - 22.00 WIB', 'Back3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `deskripsi` text,
  `karbohidrat` int DEFAULT NULL,
  `kalori` int DEFAULT NULL,
  `protein` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `gambar`, `status`, `deskripsi`, `karbohidrat`, `kalori`, `protein`) VALUES
(1, 'Paket Ayam Monas', 'Paket Monas.png', 'FAVORITE', 'Satu porsi lengkap dengan ayam goreng renyah, nasi putih, sambal pedas, dan lalapan segar. Disajikan dengan minuman dingin untuk melengkapi hidangan.', 30, 230, 10),
(2, 'Bakwan', 'Bakwan.png', NULL, 'Sup bakso berisi bakso daging kenyal yang disajikan dalam kuah kaldu gurih dengan taburan bawang goreng dan daun bawang. Dilengkapi sambal untuk menambah cita rasa.', 20, 100, 5),
(3, 'Chicken Strip', 'Chicken Strip.png', 'FAVORITE', 'Potongan ayam fillet yang dilapisi tepung roti crispy, disajikan dengan nasi, saus sambal pedas, dan kecap manis. Cocok untuk pecinta ayam goreng tepung.', 14, 150, 6),
(4, 'French Fries', 'French fries.png', NULL, 'Kentang goreng renyah dipotong memanjang, disajikan dengan saus sambal dan kecap. Camilan favorit yang cocok dinikmati kapan saja.', 14, 140, 2),
(5, 'Es Blewah', 'Es Blewah.png', 'FAVORITE', 'Minuman segar dari jus melon dengan es batu, disajikan dalam gelas plastik. Sempurna untuk menghilangkan dahaga di cuaca panas.', 10, 100, 5),
(6, 'Siomay', 'Siomay.png', 'FAVORITE', 'Hidangan siomay kukus dengan saus kacang, disertai pare isi dan sosis goreng. Perpaduan rasa gurih dan sedikit pedas yang menggugah selera.', 14, 120, 5);

-- --------------------------------------------------------


-- --------------------------------------------------------


--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `komentar` text NOT NULL,
  `rating` int DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` varchar(255) DEFAULT NULL
) ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `nama`, `komentar`, `rating`, `tanggal`, `foto`) VALUES
(1, 'Dunia Kuliner Samarinda', 'Dari dulu rasanya ga berubah, ayamnya empuk berbumbu dengan daging yang juicy.', 5, '2025-09-01 07:52:30', 'DuniaKulinerSamarinda'),
(2, 'Eri Fahmi', 'Rasa sama dan tidak berubah.', 5, '2025-11-01 07:52:30', 'EriFahmi.png'),
(3, 'Zulaihaa 22', 'Rasanya udah beda sama yang dulu, dari segi rasa masih lumayan enak tapi sambal nya dikit. Apalagi harga agak pricy 40.000 paket ayam nasi+teh botol sosro. sangat di sayangkan belum ada metode pembayaran cashless, jadi mesti siapin uang tunai.', 3, '2024-12-01 07:52:30', 'Zulhaiha22.png');

-- --------------------------------------------------------

--
-- Table structure for table `story_timeline`
--

CREATE TABLE `story_timeline` (
  `id` int NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `posisi` enum('left','right') NOT NULL DEFAULT 'left'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `story_timeline`
--

INSERT INTO `story_timeline` (`id`, `tahun`, `judul`, `deskripsi`, `gambar`, `posisi`) VALUES
(1, '2010', 'Awal Berdiri', 'Ayam Goreng Monas lahir dari sebuah dapur kecil di rumah keluarga sederhana. Berawal dari resep ayam goreng warisan orang tua, yang dulu hanya disajikan saat kumpul keluarga, banyak teman dan tetangga memuji bumbu gurihnya yang meresap hingga ke tulang.', 'scp3.webp', 'left'),
(2, '2012', 'Cabang Pertama', 'Pada tahun 2012, cabang pertama Ayam Goreng Monas resmi dibuka di pusat kota. Cabang pertama ini tidak besar, tetapi memiliki suasana hangat dengan meja kayu dan dapur terbuka.', 'Back1.jpg', 'right'),
(3, '2025', 'Cabang Kedua', 'Pada tahun 2025, Ayam Goreng Monas membuka cabang kedua di mall Samarinda Square. Kehadiran cabang ini memperkuat posisi brand sebagai ayam goreng lokal yang serius menjaga kualitas.', 'Back3.jpg', 'left');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_timeline`
--
ALTER TABLE `story_timeline`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
--
ALTER TABLE `pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `story_timeline`
--
ALTER TABLE `story_timeline`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD CONSTRAINT `pekerja_ibfk_1` FOREIGN KEY (`cabang_id`) REFERENCES `lokasi` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`cabang_id`) REFERENCES `lokasi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
