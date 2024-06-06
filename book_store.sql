-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 03:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `batal_penjualan` (IN `kd_trx` INT, IN `jumlah` INT)   BEGIN
    -- Lakukan logika pembatalan penjualan
    INSERT INTO batal_jual (kd_trx, jumlah, waktu) VALUES (kd_trx, jumlah, NOW());
    -- Tambahkan logika lain jika diperlukan
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(15) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `kategori_buku` varchar(30) NOT NULL,
  `penulis` varchar(15) NOT NULL,
  `sinopsis` text NOT NULL,
  `id_suplier` varchar(15) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_buku`, `kategori_buku`, `penulis`, `sinopsis`, `id_suplier`, `harga`, `jumlah`) VALUES
('121212', 'Bumi', 'Novel', 'Tere Liye', 'Bumi ini merupakan series pertama dari series\"BUMI\" karya Tere Liye. Pada novel ini merupakan awal pengenalan tokoh-tokoh utama yang berperan. Novel ini mengisahkan tentang petualangan 3 remaja yang berusia 15 tahun bernama Raib, Ali dan Seli. Namun mereka bukanlah remaja biasa, melainkan remaja yang memiliki kekuatan khusus seperti Raib yang bisa menghilang, Seli yang bisa mengeluarkan petir dan Ali seorang pelajar yang sangat jenius. Petualangan menjelajah dunia paralel mereka dimulai dari sini, dunia paralel yang pertama mereka jelajahi adalah Klan Bulan. ', 'SP-01', 95000, 5),
('121231', 'Harry Potter', 'Novel', 'J.K. Rowling', 'Harry Potter, seorang anak yatim piatu, menemukan bahwa dia adalah seorang penyihir pada ulang tahunnya yang ke-11. Dia kemudian bersekolah di Hogwarts, sekolah sihir, dan menghadapi berbagai petualangan menegangkan.', 'SP-03', 120000, 5),
('121233', 'The Catcher in the Rye', 'Novel', 'J.D. Salinger', 'Holden Caulfield, seorang remaja yang memberontak, menceritakan pengalamannya melarikan diri dari sekolah asrama dan menjelajahi New York. Buku ini mengeksplorasi tema pencarian identitas dan alienasi.', 'SP-02', 100000, 5),
('121237', 'To Kill a Mockingbird', 'Novel', 'Harper Lee', 'Cerita ini berlatar di Alabama pada masa Depresi dan diceritakan dari sudut pandang Scout Finch, seorang gadis muda. Ayahnya, Atticus Finch, seorang pengacara, membela seorang pria kulit hitam yang dituduh memperkosa seorang wanita kulit putih.', 'SP-03', 110000, 5),
('121238', 'Sapiens A Brief History of Humankind', 'Non-fiksi', 'Yuval Noah Hara', 'Buku ini menawarkan pandangan mendalam tentang sejarah umat manusia dari zaman prasejarah hingga era modern, mengeksplorasi perkembangan budaya, agama, dan ekonomi.', 'SP-02', 150000, 3),
('121240', 'Pride and Prejudice', 'Novel', 'Jane Austen', 'Elizabeth Bennet, salah satu dari lima saudara perempuan, berhadapan dengan tekanan sosial untuk menikah. Buku ini mengeksplorasi tema cinta, kebanggaan, dan prasangka di masyarakat Inggris pada abad ke-19.', 'SP-02', 100000, 6),
('121243', 'The Great Gatsby', 'Novel', 'F. Scott Fitzge', 'Buku ini bercerita tentang Jay Gatsby, seorang pria kaya misterius yang mengadakan pesta besar untuk menarik perhatian Daisy Buchanan, wanita yang dicintainya. Cerita ini mengeksplorasi tema kemewahan, cinta, dan kehampaan.', 'SP-05', 90000, 3),
('121244', 'Think and Grow Rich', 'Non-fiksi', 'Napoleon Hill', 'Buku ini mengungkapkan prinsip-prinsip dan strategi untuk mencapai kesuksesan dan kekayaan berdasarkan wawancara dengan berbagai orang sukses di Amerika.', 'SP-02', 130000, 9),
('121246', 'The Alchemist', 'Novel', 'Paulo Coelho', 'Santiago, seorang gembala muda dari Spanyol, melakukan perjalanan mencari harta karun di Mesir setelah bermimpi tentang hal itu. Perjalanannya mengajarkannya tentang pentingnya mengikuti mimpi dan memahami makna kehidupan.', 'SP-02', 100000, 4),
('121249', 'George Orwell', 'Novel', 'George Orwell', 'Cerita ini berlatar di negara totaliter di masa depan di mana pemerintah mengendalikan setiap aspek kehidupan warganya. Winston Smith, sang protagonis, berusaha memberontak melawan sistem yang menindas ini.', 'SP-02', 100000, 8),
('123123', 'Laskar Pelangi', 'Novel', 'Andrea Hirata', 'Buku ini menceritakan tentang kehidupan sekelompok anak dari keluarga miskin di Belitung yang berjuang untuk mendapatkan pendidikan. Cerita ini penuh dengan inspirasi, persahabatan, dan semangat juang.', 'SP-02', 85000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `no_trx` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batal_jual`
--

CREATE TABLE `batal_jual` (
  `kd_trx` varchar(10) NOT NULL,
  `id_barang` varchar(15) NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `hrg_total` int(10) NOT NULL,
  `tgl_trx` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `batal_jual`
--

INSERT INTO `batal_jual` (`kd_trx`, `id_barang`, `kasir`, `nama_buku`, `jumlah`, `harga`, `hrg_total`, `tgl_trx`) VALUES
('TR00000013', 'BR-001', 'admin', 'celana Jeans', 2, 150000, 300000, '2017-04-07'),
('TR00000023', 'BR-003', 'admin', 'Celana Black Hawk', 1, 180000, 180000, '2017-04-07'),
('TR00000025', 'BR-005', 'admin', 'Tas Ransel', 1, 120000, 120000, '2017-04-07'),
('TR00000027', 'BR-005', 'admin', 'Tas Ransel', 1, 120000, 120000, '2017-04-07'),
('TR00000109', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000042', '1517500026007', 'vecky', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000013', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000014', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000014', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000018', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000021', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000021', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000023', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000023', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000039', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000039', 'BR-005', 'admin', 'Tas Ransel', 2, 100000, 200000, '2017-04-07'),
('TR00000058', 'BR-001', 'admin', 'celana Jeans', 1, 150000, 150000, '2017-04-07'),
('TR00000112', 'BR-001', 'admin', 'celana Jeans', 2, 150000, 300000, '2017-04-07'),
('TR00000003', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000013', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000013', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000013', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000013', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000014', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000014', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000014', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000014', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000014', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000014', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000015', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000016', '1517500026007', 'admin', 'Sandal GrayScale', 5, 100000, 500000, '2017-04-09'),
('TR00000016', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000017', '1517500026007', 'admin', 'Sandal GrayScale', 1, 150000, 150000, '2017-04-09'),
('TR00000020', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000038', '1517500026007', 'vecky', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000046', '1517500026007', 'vecky', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000053', '1517500026007', 'admin', 'Sandal GrayScale', 1, 100000, 100000, '2017-04-09'),
('TR00000001', '170400001', 'admin', 'Adidas', 1, 300000, 300000, '2011-11-24'),
('TR00000002', '170400001', 'admin', 'Adidas', 1, 300000, 300000, '2017-04-17'),
('TR00000002', '170400059', 'admin', 'ShaNge', 1, 100000, 100000, '2017-04-17'),
('TR00000003', '170400001', 'admin', 'Adidas', 1, 300000, 300000, '2017-04-17'),
('TR00000005', '170400001', 'admin', 'Adidas', 1, 300000, 300000, '2017-04-17'),
('TR00000005', '170400001', 'admin', 'Adidas', 1, 300000, 300000, '2017-04-17'),
('TR00000006', '170400001', 'admin', 'Adidas', 1, 300000, 300000, '2017-04-17'),
('TR00000006', '170400046', 'admin', 'Neverdead', 1, 125000, 125000, '2017-04-17'),
('TR00000008', '170400046', 'diah', 'Neverdead', 1, 125000, 125000, '2017-04-17'),
('TR00000008', '170400001', 'diah', 'Adidas', 1, 300000, 300000, '2017-04-17'),
('TR00000080', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-04'),
('TR00000090', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-05'),
('TR00000093', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-05'),
('TR00000093', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-05'),
('TR00000093', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-05'),
('TR00000093', '121212', 'admin', 'Bumi', 2, 95000, 190000, '2024-06-05'),
('TR00000098', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-05'),
('TR00000100', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-05'),
('TR00000106', '121212', 'rian', 'Bumi', 1, 95000, 95000, '2024-06-05'),
('TR00000133', '121212', 'rian', 'Bumi', 1, 95000, 95000, '2024-06-06'),
('TR00000135', '121212', 'rian', 'Bumi', 1, 95000, 95000, '2024-06-06'),
('TR00000138', '121212', 'rian', 'Bumi', 1, 95000, 95000, '2024-06-06'),
('TR00000262', '121212', 'rian', 'Bumi', 1, 95000, 95000, '2024-06-06');

--
-- Triggers `batal_jual`
--
DELIMITER $$
CREATE TRIGGER `batal_jual` AFTER DELETE ON `batal_jual` FOR EACH ROW BEGIN
  INSERT INTO batal_jual
        (       kd_trx,
                id_barang,
                kasir,
                nama_buku,
                jumlah,
                harga,
                hrg_total,
                tgl_trx
        )
  VALUES
        (      OLD.kd_trx,
               OLD.id_barang,
               OLD.kasir,
               OLD.nama_buku,
               OLD.jumlah,
               OLD.harga,
               OLD.hrg_total,
               OLD.tgl_trx
        );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `batal_jual_kembali_stok` AFTER INSERT ON `batal_jual` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah=jumlah+NEW.jumlah
	WHERE id_barang=NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `no_trx`
--

CREATE TABLE `no_trx` (
  `id` int(1) NOT NULL,
  `no_trx` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `no_trx`
--

INSERT INTO `no_trx` (`id`, `no_trx`) VALUES
(1, 264);

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id_sp` varchar(7) NOT NULL,
  `nm_sp` varchar(50) NOT NULL,
  `alamat_sp` text NOT NULL,
  `tlp_sp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_sp`, `nm_sp`, `alamat_sp`, `tlp_sp`) VALUES
('SP-01', 'CV.Busana Anugerah', 'Bandung', '(022) 3453453'),
('SP-02', 'Gramedia', 'Jakarta Timur', '(021) 8583941'),
('SP-03', 'Periplus', 'Jakarta Selatan', '(021) 75920931'),
('SP-04', 'Bukalapak', 'Jakarta Selatan', '(021) 50813333'),
('SP-05', 'Tokopedia', 'Jakarta Selatan', '(021) 80647333'),
('SP-06', 'Books & Beyond', 'Jakarta Pusat', '(021) 5725525');

-- --------------------------------------------------------

--
-- Table structure for table `temp_batal_jual`
--

CREATE TABLE `temp_batal_jual` (
  `id` int(11) NOT NULL,
  `kd_trx` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_out`
--

CREATE TABLE `trx_out` (
  `kd_trx` varchar(10) NOT NULL,
  `id_barang` varchar(15) NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `hrg_total` int(10) NOT NULL,
  `tgl_trx` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `trx_out`
--

INSERT INTO `trx_out` (`kd_trx`, `id_barang`, `kasir`, `nama_buku`, `jumlah`, `harga`, `hrg_total`, `tgl_trx`) VALUES
('TR00000039', '121212', 'admin', 'Bumi', 2, 95000, 190000, '2024-06-04'),
('TR00000039', '13131313', 'admin', 'Nebula', 1, 95000, 95000, '2024-06-04'),
('TR00000044', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-04'),
('TR00000044', '13131313', 'admin', 'Nebula', 1, 95000, 95000, '2024-06-04'),
('TR00000047', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-04'),
('TR00000047', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-04'),
('TR00000047', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-04'),
('TR00000055', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-04'),
('TR00000055', '121231', 'admin', 'Harry Potter', 1, 120000, 120000, '2024-06-04'),
('TR00000057', '121231', 'admin', 'Harry Potter', 1, 120000, 120000, '2024-06-04'),
('TR00000058', '121212', 'admin', 'Bumi', 1, 95000, 95000, '2024-06-04'),
('TR00000244', '121212', 'rian', 'Bumi', 1, 95000, 95000, '2024-06-06'),
('TR00000262', '121212', 'rian', 'Bumi', 1, 95000, 95000, '2024-06-06');

--
-- Triggers `trx_out`
--
DELIMITER $$
CREATE TRIGGER `after_delete_trx_out` AFTER DELETE ON `trx_out` FOR EACH ROW BEGIN
    -- Masukkan data ke tabel sementara
    INSERT INTO temp_batal_jual (kd_trx, jumlah) VALUES (OLD.kd_trx, OLD.jumlah);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `barang_terjual` AFTER INSERT ON `trx_out` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah=jumlah-NEW.jumlah
	WHERE id_barang=NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `batal_tr_penjualan` AFTER DELETE ON `trx_out` FOR EACH ROW BEGIN


INSERT INTO batal_jual

(kd_trx, id_barang, kasir, nama_buku, jumlah, harga, hrg_total, tgl_trx) VALUES 


(              OLD.kd_trx,
               OLD.id_barang,
               OLD.kasir,
               OLD.nama_buku,
               OLD.jumlah,
               OLD.harga,
               OLD.hrg_total,
               OLD.tgl_trx
);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trx_sementara`
--

CREATE TABLE `trx_sementara` (
  `kd_trx` varchar(15) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(7) NOT NULL,
  `hrg_total` int(10) NOT NULL,
  `tgl_trx` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(7) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `no_tlp`, `level`) VALUES
('2343110', 'rian', '1234', 'Rian Cahyo Anggoro ', 'Ngawi', '08123456789', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`no_trx`);

--
-- Indexes for table `no_trx`
--
ALTER TABLE `no_trx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id_sp`);

--
-- Indexes for table `temp_batal_jual`
--
ALTER TABLE `temp_batal_jual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `temp_batal_jual`
--
ALTER TABLE `temp_batal_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `process_batal_jual` ON SCHEDULE EVERY 1 MINUTE STARTS '2024-06-04 20:25:35' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    INSERT INTO batal_jual (kd_trx, jumlah, waktu)
    SELECT kd_trx, jumlah, waktu FROM temp_batal_jual;

    DELETE FROM temp_batal_jual;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
