CREATE DATABASE ayamgoreng_monas;

USE ayamgoreng_monas;

CREATE TABLE review (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    komentar TEXT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE review ADD foto VARCHAR(255) DEFAULT NULL;

INSERT INTO review (nama, komentar, rating) VALUES
('Britama Putra', 'Pelayanannya cepat dan ramah.', 4),
('Dimas Islamay', 'Tempatnya nyaman, recommended.', 5),
('Richo Anan', 'Harga terjangkau, rasa enak.', 4);


CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    gambar VARCHAR(100) NOT NULL,
    status VARCHAR(20) DEFAULT NULL
);

ALTER TABLE menu ADD deskripsi TEXT DEFAULT NULL;
ALTER TABLE menu ADD kalori INT DEFAULT NULL;
ALTER TABLE menu ADD karbohidrat INT DEFAULT NULL;
ALTER TABLE menu ADD protein INT DEFAULT NULL;

INSERT INTO menu (nama, gambar, status) VALUES
('Paket Ayam Monas', 'Paket Monas.png', 'FAVORITE'),
('Bakwan', 'Bakwan.png', NULL),
('Chicken Strip', 'Chicken Strip.png', 'FAVORITE'),
('French Fries', 'French fries.png', NULL),
('Es Blewah', 'Es Blewah.png', 'FAVORITE'),
('Siomay', 'Siomay.png', 'FAVORITE');

CREATE TABLE berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL
);

INSERT INTO berita (judul, gambar, deskripsi) VALUES
('Ayam Goreng Monas Buka Cabang Baru di Samarinda!', 'berita1.jpg', 'Ayam Goreng Monas resmi membuka cabang baru di Samarinda pada awal bulan ini. Cabang terbaru ini hadir dengan konsep modern dan area makan lebih luas untuk memberikan pengalaman terbaik kepada pelanggan. Dengan menu andalan seperti Paket Ayam Monas dan Chicken Strip yang menjadi favorit, cabang baru ini diharapkan dapat memenuhi permintaan pelanggan yang terus meningkat. Banyak warga sekitar yang antusias dan sudah memadati lokasi sejak hari pertama pembukaan.'),
('Menu Favorit Ayam Goreng Monas Kini Tersedia Dalam Paket Hemat!', 'berita2.jpg', 'Untuk memenuhi kebutuhan pelanggan, Ayam Goreng Monas merilis Paket Hemat terbaru yang berisi ayam goreng krispi, nasi, minuman segar, dan pilihan tambahan lauk. Paket ini dirancang khusus untuk pelanggan yang ingin menikmati menu lezat dengan harga lebih terjangkau. Selain itu, promo Paket Hemat ini akan tersedia sepanjang bulan, sehingga pelanggan bisa menikmatinya kapan saja tanpa khawatir kehabisan.');

CREATE TABLE lokasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL,
    jam VARCHAR(50) NOT NULL,
    gambar VARCHAR(255) NOT NULL
);

INSERT INTO lokasi (nama, alamat, jam, gambar) VALUES
('AGM Mall SCP', 'Samarinda Central Plaza lantai 3 Jl. P. Irian No.1, Karang Mumus, Kec. Samarinda Kota, Kota Samarinda', 
'10.00 - 22.00 WIB', 'scp2.webp'),
('AGM Mall Lembuswana', 'Lembuswana lantai dasar jl. Mayor Jendral S. Parman No.28, Gunung kelua, Samarinda Kota, Kota Samarinda',
 '10.00 - 22.00 WIB', 'Back1.jpg'),
('AGM Mall Samarinda Square', 'Samarinda Square lantai 1 Jl. M. Yamin Gunung kelua, Samarinda Ulu, Kota Samarinda',
'10.00 - 22.00 WIB', 'Back3.jpg');

CREATE TABLE story_timeline (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tahun VARCHAR(10) NOT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    posisi ENUM('left', 'right') NOT NULL DEFAULT 'left'
);

INSERT INTO story_timeline (tahun, judul, deskripsi, gambar, posisi) VALUES
('2010', 'Awal Berdiri',
'Ayam Goreng Monas lahir dari sebuah dapur kecil di rumah keluarga sederhana. Berawal dari resep ayam goreng warisan orang tua, yang dulu hanya disajikan saat kumpul keluarga, banyak teman dan tetangga memuji bumbu gurihnya yang meresap hingga ke tulang.',
'scp3.webp', 'left');

INSERT INTO story_timeline (tahun, judul, deskripsi, gambar, posisi) VALUES
('2012', 'Cabang Pertama',
'Pada tahun 2012, cabang pertama Ayam Goreng Monas resmi dibuka di pusat kota. Cabang pertama ini tidak besar, tetapi memiliki suasana hangat dengan meja kayu dan dapur terbuka.',
'Back1.jpg', 'right');

INSERT INTO story_timeline (tahun, judul, deskripsi, gambar, posisi) VALUES
('2025', 'Cabang Kedua',
'Pada tahun 2025, Ayam Goreng Monas membuka cabang kedua di mall Samarinda Square. Kehadiran cabang ini memperkuat posisi brand sebagai ayam goreng lokal yang serius menjaga kualitas.',
'Back3.jpg', 'left');

CREATE TABLE header (
  id INT PRIMARY KEY,
  logo VARCHAR(255),
  nama_bisnis VARCHAR(255),
  location_url VARCHAR(255)
);

INSERT INTO header VALUES (
  1, 'Logo.png', 'Ayam Goreng Monas', 'index.php'
);

CREATE TABLE footer (
  id INT PRIMARY KEY,
  logo VARCHAR(255),
  slogan VARCHAR(255),
  link_story VARCHAR(255),
  link_menu VARCHAR(255),
  link_news VARCHAR(255),
  whatsapp VARCHAR(255),
  email VARCHAR(255),
  alamat TEXT,
  maps_embed TEXT,
  instagram VARCHAR(255),
  tiktok VARCHAR(255),
  x VARCHAR(255),
  facebook VARCHAR(255)
);

INSERT INTO footer (
  id,
  logo,
  slogan,
  link_story,
  link_menu,
  link_news,
  whatsapp,
  email,
  alamat,
  maps_embed,
  instagram,
  tiktok,
  x,
  facebook
)
VALUES (
  1,
  'Logo.png',
  'Enak Tiada Tanding',
  'story.php',
  'menu.php',
  'news.php',
  'https://wa.me/6281234567890',
  'ayamgorengmonas@gmail.com',
  'Samarinda Central Plaza lantai 3 Jl. P. Irian No.1, Karang Mumus, Kec. Samarinda Kota, Kota Samarinda',
  '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d498.7080246178035!2d117.154641543488!3d-0.5036127999999974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f9e7cce7495%3A0x61022452c2cacfea!2sSamarinda%20Central%20Plaza!5e0!3m2!1sid!2sid!4v1764164547398!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
  '#',
  '#',
  '#',
  '#'
);


CREATE TABLE pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_pesanan VARCHAR(50) NOT NULL,
    nama_pelanggan VARCHAR(100) NOT NULL,
    total_harga INT NOT NULL,
    cabang_id INT NULL,
    status ENUM('pending','proses','selesai','batal') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cabang_id) REFERENCES lokasi(id)
);

INSERT INTO pesanan (kode_pesanan, nama_pelanggan, total_harga, cabang_id, status, created_at) VALUES
('AGM-2025-0001', 'Rizky Pratama', 52000, 1, 'selesai', NOW()),
('AGM-2025-0002', 'Dewi Lestari', 78000, 2, 'proses', NOW()),
('AGM-2025-0003', 'Fajar Nugroho', 43000, 3, 'pending', NOW()),
('AGM-2025-0004', 'Imam Bahri', 91000, 1, 'selesai', NOW() - INTERVAL 1 DAY);


CREATE TABLE pekerja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    posisi VARCHAR(50) NOT NULL,
    cabang_id INT NOT NULL,
    shift VARCHAR(100) NOT NULL,
    status ENUM('aktif','cuti','resign') DEFAULT 'aktif',
    FOREIGN KEY (cabang_id) REFERENCES lokasi(id)
);

INSERT INTO pekerja (nama, posisi, cabang_id, shift, status) VALUES
('Andi Saputra', 'Kasir', 1, 'Pagi (10.00 - 16.00)', 'aktif'),
('Siti Rahma', 'Koki', 2, 'Full (10.00 - 22.00)', 'aktif'),
('Budi Hartono', 'Pramusaji', 3, 'Sore (16.00 - 22.00)', 'aktif'),
('Lina Oktaviani', 'Supervisor', 1, 'Full (10.00 - 22.00)', 'aktif');










