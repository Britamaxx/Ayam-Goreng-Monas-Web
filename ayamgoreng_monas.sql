CREATE DATABASE ayamgoreng_monas;

USE ayamgoreng_monas;

CREATE TABLE review (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    komentar TEXT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

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









