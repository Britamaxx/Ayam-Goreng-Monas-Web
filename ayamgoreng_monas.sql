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











