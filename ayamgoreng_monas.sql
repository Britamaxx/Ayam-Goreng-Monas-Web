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
    judul VARCHAR(50) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL
);








