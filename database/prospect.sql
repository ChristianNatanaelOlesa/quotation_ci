-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2022 pada 09.34
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prospect`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `QUO_AUTONUMBER` (`nomer` INT) RETURNS VARCHAR(20) CHARSET utf8mb4  BEGIN
DECLARE kodebaru VARCHAR(20);
DECLARE urut INT;
DECLARE kodebulantahun VARCHAR(20);
 
SET kodebulantahun = CONCAT("/PEN/",toRoman(MONTH(CURDATE())),"/",YEAR(CURDATE()));

SET urut = IF(nomer IS NULL, 1, nomer + 1);
SET kodebaru = CONCAT(LPAD(urut, 4, 0),kodebulantahun );
 
RETURN kodebaru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `toRoman` (`number` INT) RETURNS TEXT CHARSET utf8mb4 DETERMINISTIC BEGIN
     
    	DECLARE basic_roman TEXT DEFAULT 'M,CM,D,CD,C,XC,L,XL,X,IX,V,IV,I';
    	DECLARE basic_value TEXT DEFAULT '1000,900,500,400,100,90,50,40,10,9,5,4,1';
    	DECLARE roman_string TEXT DEFAULT '';
    	DECLARE i INT DEFAULT 1;
    	DECLARE roman_symbol TEXT;
    	DECLARE roman_value INT;
     
    	SET roman_string = (SELECT IF(number<=0 OR number>=4000,NULL,roman_string));
     
    	WHILE number > 0 AND number < 4000 DO
     
    		SET roman_symbol = SUBSTRING_INDEX(SUBSTRING_INDEX(basic_roman,',',i),',',-1);
    		SET roman_value  = SUBSTRING_INDEX(SUBSTRING_INDEX(basic_value,',',i),',',-1);
     
    		IF number >= roman_value THEN
    			SET roman_string = CONCAT(roman_string,roman_symbol);
    			SET number = number - roman_value;
    		ELSE
    			SET i = i + 1;
    		END IF;
     
    	END WHILE;
     
    	RETURN 	roman_string;
     
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `ucfirst` (`str_value` VARCHAR(5000)) RETURNS VARCHAR(5000) CHARSET utf8mb4 DETERMINISTIC BEGIN
    RETURN CONCAT(UCASE(LEFT(str_value, 1)),SUBSTRING(str_value, 2));
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `general_setting`
--

CREATE TABLE `general_setting` (
  `id` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `loka1` text NOT NULL,
  `loka2` text NOT NULL,
  `loka3` text NOT NULL,
  `loka4` text NOT NULL,
  `loka5` text NOT NULL,
  `notes` text NOT NULL,
  `terms` text NOT NULL,
  `estimasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `general_setting`
--

INSERT INTO `general_setting` (`id`, `company_name`, `loka1`, `loka2`, `loka3`, `loka4`, `loka5`, `notes`, `terms`, `estimasi`) VALUES
(1, 'PT.TRAFINDO PRIMA  PERKASA', 'Head Office 	: #Jalan Hayam Wuruk 4 No. FX Jakarta Pusat 10120 – Indonesia Telp.: +62 21 3850703, 3517113, 3861865', 'Factory I 	: #Jalan Raya Siliwangi, RT004/RW005, Kel. Alam Jaya, Kec. Jatiuwung, Tangerang, Banten- Indonesia Telp : +62 21 5903801, 5903802', 'Factory II 	: #Jalan Raya Siliwangi, RT006/RW004, Kel. Alam Jaya, Kec. Jatiuwung, Tangerang, Banten- Indonesia Telp.: +62 21 5903801, 5903802', 'Factory III 	: #Jalan Raya Siliwangi, RT004/RW001, Kel. Pasir Jaya, Kec. Jatiuwung, Tangerang, Banten- Indonesia Telp.: +62 21 5903801, 5903802', 'Factory IV 	:#Jalan Raya Siliwangi, RT004/RW001, Kel. Gembor, Kec. Periuk, Tangerang, Banten- Indonesia Telp.: +62 21 5903801, 5903802', '- Loco pabrik PT Trafindo Tangerang\r\n- Tidak termasuk jasa pemasangan & Transportasi\r\n- Sudah termasuk sertifikat uji pabrik\r\n- Sudah termasuk commisioning u/ jabodetabek max 1 hari\r\n- Tidak termasuk tambahan copper link untuk terminasi.', '-', '2 bulan sejak PO, DP dan Approval Drawing diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `kd_user` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `bagian` varchar(50) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `Manager` varchar(50) NOT NULL,
  `Direktur` varchar(50) NOT NULL,
  `Dirut` varchar(50) NOT NULL,
  `nohp` varchar(30) NOT NULL,
  `direktorat` varchar(30) NOT NULL,
  `bagian2` char(50) NOT NULL,
  `inisial` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`kd_user`, `username`, `password`, `nama`, `bagian`, `jabatan`, `level`, `Manager`, `Direktur`, `Dirut`, `nohp`, `direktorat`, `bagian2`, `inisial`) VALUES
(55, 'Riyan', '52fa2540eb68b56074c0fccbb8e7c3b7', 'Riyan', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(56, 'Christiana', '$2y$10$hRi1qju2KOeEPcBZ0wYfhu/PN5e9Wl.ddWeDTds8Uokad764X9D1a', 'Christiana S Dewi', 'Sales Swasta', 'Manager', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(57, 'Dimas', '165f0e802498349187420f52f2c396d6', 'Dimas', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(58, 'Vishnu', 'd17088c85762d1dda22352398eb2f664', 'Vishnu', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(59, 'Sunata', 'fe4ac056acadc61e3b460f0173b50a69', 'Sunata', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(60, 'Hinca', '013bf46fbbe8731297bf4c2e15b47b10', 'Hinca', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(61, 'Lusy', '9f804188780b906eeca37e4e11c0917a', 'Lusy', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(62, 'Agung', '383829adfde3db734111743bbae6450a', 'Agung Prihandono', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(63, 'Musa', '054393a3d19a773efc77c9fda3f7830a', 'Musa', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(64, 'Iqbal', 'c8f84dc74c434db40733b09448de664c', 'M Iqbal Harish', 'Sales BUMN', 'Manager', 'sales', 'Rudi Ta an', 'Hari Bambang', 'Freddie Wibowo', '', '', '', ''),
(66, 'Rudi', '200f015011903e6055c94894174f6070', 'Rudi Ta an', 'Sales BUMN', 'Manager', 'sales', 'Rudi Ta an', 'Hari Bambang', 'Freddie Wibowo', '', '', 'Sales PLN', ''),
(67, 'Guruh', '5c7af6e40a1ec7247d2021af8c213dcf', 'Guruh Agung', 'Sales PLN', 'Manager', 'sales', 'Adrianus Sigit', 'Hari Bambang', 'Freddie Wibowo', '', '', '', ''),
(68, 'Andy', '304f6fda7e2aed907dabf42e1addf7c3', 'Andy Rahadianto', 'Sales PLN', 'Staff', 'sales', 'Adrianus Sigit', 'Hari Bambang', 'Freddie Wibowo', '', '', '', ''),
(69, 'Rizky', '0bbb746a44bd18925dbf8d206cff53e4', 'Rizky Mulya Nugroho', 'Sales PLN', 'Staff', 'sales', 'Adrianus Sigit', 'Hari Bambang', 'Freddie Wibowo', '', '', '', ''),
(70, 'Niken', '1fded17af4cc45b76e2413b8f50236fb', 'Niken Mayalina', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(71, 'Marshal', '4abcca3259e8012bfd2585cc7a73d08f', 'Marshal Nauli', 'Sales Export', 'Manager', 'sales', 'Marshal Nauli', 'David Limputra', 'Freddie Wibowo', '', '', '', ''),
(72, 'Tejo', '93aad28b04f72acd0b95614780e9eac0', 'Tejo Wahono', 'Engineer', 'Manager', 'Admin', '', '', '', '', '', '', 'TW'),
(75, 'Guruh', 'a9518d41564905f0b745e528ade434bd', 'Guruh Agung', 'Sales PLN', 'Manager', 'sales', 'Adrianus Sigit', 'Hari Bambang', 'Freddie Wibowo', '', '', '', ''),
(76, 'Faiza', '880d33b64f4cd1a322b7ce96b96703f5', 'Faiza', 'Engineer', 'Staff', 'tender_spv', '', '', '', '56', '', '', 'FZ'),
(77, 'Fano', 'a24067cadb2c1bd2fdf4c37a72a6ac07', 'Arfano', 'Engineer', 'Staff', 'tender', '', '', '', '56', '', '', 'AF'),
(78, 'Sodik', '8e4c73bd413726984711eed7bdf15b41', 'Sodik', 'Engineer', 'Staff', 'tender', '', '', '', '56', '', '', 'SD'),
(79, 'Fendi', '6c98f351ce0ff32eb96524be97a2dfa9', 'Fendi', 'Engineer', 'Staff', 'estimator', '', '', '', '', '', '', 'FN'),
(80, 'Muslim', '60a847861cfd4458fc76cb015d5ea0c0', 'Imam Muslim Amin', 'Engineer', 'Staff', 'tender', '', '', '', '', '', '', 'IM'),
(81, 'Prakas', 'a0f06b86f40473f6a0791fea9acb2093', 'Prakas', 'Engineer', 'Staff', 'estimator', '', '', '', '', '', '', 'PK'),
(82, 'Aziz', '66738e472fda76b980223c57af726be7', 'Abdul Aziz', 'Engineer', 'Staff', 'tender', '', '', '', '', '', '', 'AZ'),
(85, 'satrio', 'f16460589ca174b85b807fc6d9e4f6ee', 'Satrio', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(86, 'Rivalni', '591479344a0b244615ad280a29980440', 'Rivalni', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '', '', '', ''),
(87, 'Febdian', '0bd871e97f97efdbd00e4120bb7a3f71', 'Febdian', 'Engineer', 'Staff', 'tender', '', '', '', '12', '', '', 'FD'),
(90, 'Poniman', 'd2dc2e9ef8542fb3c94c5ef7cc527a8a', 'Poniman Bensohur', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '123', 'Y', '123', 'X'),
(92, 'Rodi', 'ad0fb55ab610f752fe79f87c5445fa58', 'Rodi Verdika', 'Engineer', 'Staff', 'tender', '', '', '', '09891', 'Y', '123', 'X'),
(93, 'Jajuli', '1fb4fd3542567fb4211f4a6527cea324', 'Jajuli', 'Engineer', 'Staff', 'tender', '', '', '', '89', 'Y', '123', 'X'),
(94, 'Arfano', 'a24067cadb2c1bd2fdf4c37a72a6ac07', 'Arfano.', 'Engineer', 'Staff', 'tender_spv', '', '', '', '234', 'Y', '123', 'AF'),
(95, 'Chandrika', '58f5031f0287afb0dd84833f6c67912b', 'Chandrika', 'Sales Swasta', 'Staff', 'sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '123', 'Y', '123', 'X'),
(96, 'Joko', '$2y$10$hRi1qju2KOeEPcBZ0wYfhu/PN5e9Wl.ddWeDTds8Uokad764X9D1a', 'Joko Erwanto', 'Sales Swasta', 'Staff', 'Sales', 'Christiana S Dewi', 'Hendra Sunarya', 'Freddie Wibowo', '08995487606', '', '', 'JK'),
(97, 'Andrianus', '$2y$10$hRi1qju2KOeEPcBZ0wYfhu/PN5e9Wl.ddWeDTds8Uokad764X9D1a', 'Andrianus Sigit', 'Sales PLN', 'Manager', 'sales', 'Andrianus Sigit', 'Hari Bambang', 'Freddie Wibowo', '', '', '', 'AS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notify`
--

CREATE TABLE `notify` (
  `id` int(11) NOT NULL,
  `type_notif` int(2) NOT NULL,
  `messages` text NOT NULL,
  `acak` varchar(10) NOT NULL,
  `read_notif` bit(1) NOT NULL,
  `kd_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notify`
--

INSERT INTO `notify` (`id`, `type_notif`, `messages`, `acak`, `read_notif`, `kd_user`) VALUES
(1, 1, 'Request Approval', '634ee3479d', b'0', 56),
(2, 3, 'Quotation Approve', '634ee3479d', b'0', 96);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pracost`
--

CREATE TABLE `pracost` (
  `id` int(11) NOT NULL,
  `noprospect` char(20) NOT NULL,
  `tipeprospect` varchar(10) DEFAULT NULL,
  `nopracost` char(20) NOT NULL DEFAULT '',
  `nm_proyek` varchar(255) DEFAULT '-',
  `nm_customer` varchar(255) DEFAULT '-',
  `kd_sales` int(11) NOT NULL,
  `sales` varchar(30) DEFAULT NULL,
  `tgl_prospect` date NOT NULL,
  `tgl_pracost` date NOT NULL,
  `tgl_formspec` date NOT NULL DEFAULT '1900-01-01',
  `tgl_rilis` date NOT NULL DEFAULT '1900-01-01',
  `qtty` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `harga_pracost` int(15) NOT NULL,
  `harga_awal` int(15) NOT NULL,
  `harga_dasar` int(15) NOT NULL,
  `status` int(2) NOT NULL,
  `reason_reject` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pracost`
--

INSERT INTO `pracost` (`id`, `noprospect`, `tipeprospect`, `nopracost`, `nm_proyek`, `nm_customer`, `kd_sales`, `sales`, `tgl_prospect`, `tgl_pracost`, `tgl_formspec`, `tgl_rilis`, `qtty`, `unit`, `harga_pracost`, `harga_awal`, `harga_dasar`, `status`, `reason_reject`) VALUES
(1, 'P22-0001', 'OIL', 'P22-0001-1', 'Data Center', 'Samudera', 96, 'Joko', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', 30000000, 35000000, 40000000, 12, NULL),
(2, 'P22-0001', 'DRY', 'P22-0001-2', 'Data Center', 'Samudera', 96, 'Joko', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', 34000000, 39000000, 42000000, 12, NULL),
(3, 'P22-0001', 'OIL', 'P22-0001-3', 'Data Center', 'Samudera', 96, 'Joko', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', 30000000, 35000000, 40000000, 12, NULL),
(4, 'P22-0001', 'OIL', 'P22-0001-4', 'Area Peti Kemas', 'Samudera', 96, 'Joko', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', 34000000, 39000000, 42000000, 12, NULL),
(5, 'P22-0002', 'DRY', 'P22-0002-1', 'Pabrik Baja', 'Baja Baja', 96, 'Joko', '2022-06-13', '2022-06-20', '2022-06-23', '2022-06-25', 1, 'UNIT', 34000000, 39000000, 42000000, 12, NULL),
(6, 'P22-0002', 'DRY', 'P22-0002-2', 'Pabrik Baja', 'Baja Baja', 96, 'Joko', '2022-06-13', '2022-06-20', '2022-06-23', '2022-06-25', 1, 'UNIT', 36000000, 39000000, 40000000, 12, NULL),
(7, 'P22-0003', 'OIL', 'P22-0003-1', '-', 'Konsultan', 96, 'Joko', '2022-06-16', '2022-06-20', '2022-06-23', '2022-06-27', 1, 'UNIT', 42000000, 45000000, 50000000, 12, NULL),
(8, 'P22-0004', 'DRY', 'P22-0004-1', 'Pabrik Ban', 'Swallow', 96, 'Joko', '2022-06-17', '2022-06-23', '2022-06-24', '2022-06-27', 1, 'UNIT', 42000000, 48000000, 53000000, 12, NULL),
(9, 'P22-0004', 'DRY', 'P22-0004-2', 'Pabrik Ban', 'Swallow', 96, 'Joko', '2022-06-17', '2022-06-23', '2022-06-24', '2022-06-27', 1, 'UNIT', 30000000, 33000000, 35000000, 12, NULL),
(10, 'P22-0005', 'DRY', 'P22-0005-1', 'Pabrik Sepatu', 'Vans', 96, 'Joko', '2022-06-17', '2022-06-23', '2022-06-24', '2022-06-27', 1, 'UNIT', 25000000, 28000000, 30000000, 12, NULL),
(11, 'P22-0006', 'DRY', 'P22-0006-1', 'Pabrik Sparepart', 'Magic', 90, 'Poniman', '2022-06-17', '2022-06-23', '2022-06-24', '2022-06-27', 1, 'UNIT', 20000000, 21000000, 24000000, 11, NULL),
(12, 'P22-0006', 'DRY', 'P22-0006-2', 'Pabrik Sparepart', 'Magic', 90, 'Poniman', '2022-06-17', '2022-06-23', '2022-06-24', '2022-06-27', 1, 'UNIT', 22000000, 23000000, 26000000, 11, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `quotation_d`
--

CREATE TABLE `quotation_d` (
  `id` int(11) NOT NULL,
  `acak` varchar(10) NOT NULL,
  `no_pracost` varchar(20) NOT NULL DEFAULT '',
  `nm_barang` varchar(250) NOT NULL,
  `kode_barang_final` varchar(20) NOT NULL,
  `nmbarang_final` varchar(255) NOT NULL,
  `isi_final` int(11) NOT NULL,
  `satuan_final` varchar(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `tipeprospect` varchar(10) NOT NULL,
  `tgl_prospect` date NOT NULL,
  `tgl_pracost` date DEFAULT NULL,
  `tgl_formspec` date DEFAULT NULL,
  `tgl_rilis` date DEFAULT NULL,
  `qtty` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `harga_pracost` decimal(18,2) NOT NULL,
  `harga_awal` decimal(18,2) NOT NULL,
  `harga_dasar` decimal(18,2) NOT NULL,
  `harga_jual` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quotation_d`
--

INSERT INTO `quotation_d` (`id`, `acak`, `no_pracost`, `nm_barang`, `kode_barang_final`, `nmbarang_final`, `isi_final`, `satuan_final`, `jenis`, `tipeprospect`, `tgl_prospect`, `tgl_pracost`, `tgl_formspec`, `tgl_rilis`, `qtty`, `unit`, `harga_pracost`, `harga_awal`, `harga_dasar`, `harga_jual`) VALUES
(1, '634ede5f63', 'P22-0002-1', '50 KVA 1Ph', '002/PRCT/14', '002/PRCT/14', 0, '', 'CTVT', 'DRY', '2022-06-13', '2022-06-20', '2022-06-23', '2022-06-25', 0, '', '34000000.00', '39000000.00', '42000000.00', '450000000.00'),
(2, '634ede5f63', 'P22-0002-2', '50 KVA 3Ph', '', '', 0, '', '', 'DRY', '2022-06-13', '2022-06-20', '2022-06-23', '2022-06-25', 0, '', '36000000.00', '39000000.00', '40000000.00', '450000000.00'),
(3, '634ee0415c', 'P22-0001-1', 'P22-0001-1', '', '0', 0, '', '', 'OIL', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', '30000000.00', '35000000.00', '40000000.00', '450000000.00'),
(4, '634ee0415c', 'P22-0001-2', 'P22-0001-2', '', '0', 0, '', '', 'DRY', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', '34000000.00', '39000000.00', '42000000.00', '450000000.00'),
(5, '634ee0415c', 'P22-0001-3', 'P22-0001-3', '', '0', 0, '', '', 'OIL', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', '30000000.00', '35000000.00', '40000000.00', '450000000.00'),
(6, '634ee0415c', 'P22-0001-4', 'P22-0001-4', '', '0', 0, '', '', 'OIL', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', '34000000.00', '39000000.00', '42000000.00', '450000000.00'),
(7, '634ee215d1', 'P22-0003-1', 'P22-0003-1', '', '0', 0, '', '', 'OIL', '2022-06-16', '2022-06-20', '2022-06-23', '2022-06-27', 1, 'UNIT', '42000000.00', '45000000.00', '50000000.00', '500000000.00'),
(8, '634ee24772', 'P22-0003-1', 'P22-0003-1', '', '0', 0, '', '', 'OIL', '2022-06-16', '2022-06-20', '2022-06-23', '2022-06-27', 1, 'UNIT', '42000000.00', '45000000.00', '50000000.00', '500000000.00'),
(9, '634ee28e7f', 'P22-0003-1', '630 KVA', '187GPRT17', '630 kVA, 3Ph, YNd-5', 0, '', 'PB TR', 'OIL', '2022-06-16', '2022-06-20', '2022-06-23', '2022-06-27', 1, 'UNIT', '42000000.00', '45000000.00', '50000000.00', '500000000.00'),
(10, '634ee3479d', 'P22-0004-1', 'P22-0004-1', '', '', 0, '', '', 'DRY', '2022-06-17', '2022-06-23', '2022-06-24', '2022-06-27', 1, 'UNIT', '42000000.00', '48000000.00', '53000000.00', '55000000.00'),
(11, '634ee3479d', 'P22-0004-2', 'P22-0004-2', '', '', 0, '', '', 'DRY', '2022-06-17', '2022-06-23', '2022-06-24', '2022-06-27', 1, 'UNIT', '30000000.00', '33000000.00', '35000000.00', '38000000.00'),
(12, '634ee5bd5f', 'P22-0001-1', '', '', '0', 0, '', '', 'OIL', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', '30000000.00', '35000000.00', '40000000.00', '456777777.00'),
(13, '634ee5bd5f', 'P22-0001-2', '', '', '0', 0, '', '', 'DRY', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', '34000000.00', '39000000.00', '42000000.00', '650000000.00'),
(14, '634ee5bd5f', 'P22-0001-3', '', '', '0', 0, '', '', 'OIL', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', '30000000.00', '35000000.00', '40000000.00', '545555555.00'),
(15, '634ee5bd5f', 'P22-0001-4', '', '', '0', 0, '', '', 'OIL', '2022-06-01', '2022-06-13', '2022-06-18', '2022-06-20', 1, 'UNIT', '34000000.00', '39000000.00', '42000000.00', '566665555.00'),
(16, '63554ff594', 'P22-0005-1', '', '', '0', 0, '', '', 'DRY', '2022-06-17', '2022-06-23', '2022-06-24', '2022-06-27', 1, 'UNIT', '25000000.00', '28000000.00', '30000000.00', '35000000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quotation_h`
--

CREATE TABLE `quotation_h` (
  `acak` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `user_create` int(11) NOT NULL,
  `no_quotation` varchar(20) NOT NULL,
  `no_prospect` varchar(20) NOT NULL,
  `nm_customer` varchar(255) DEFAULT NULL,
  `tgl_quotation` date DEFAULT current_timestamp(),
  `proyek` varchar(255) DEFAULT NULL,
  `lokasi` varchar(200) DEFAULT NULL,
  `budget_biayakirim` int(11) NOT NULL,
  `up` varchar(100) DEFAULT NULL,
  `telp` varchar(18) DEFAULT NULL,
  `emails` varchar(100) DEFAULT NULL,
  `kdcust_final` varchar(50) NOT NULL,
  `nmcust_final` varchar(200) NOT NULL,
  `alamat_final` text NOT NULL,
  `tlpcust_final` varchar(20) NOT NULL,
  `up_final` varchar(100) NOT NULL,
  `npwp_final` varchar(100) NOT NULL,
  `referensi` text DEFAULT NULL,
  `kd_sales` int(3) DEFAULT NULL,
  `no_so` varchar(20) DEFAULT NULL,
  `chstatus` int(1) DEFAULT NULL,
  `revisi_ke` int(11) DEFAULT NULL,
  `hargajual` decimal(18,2) DEFAULT NULL,
  `prs_ppn` decimal(18,2) DEFAULT NULL,
  `ppn` decimal(18,2) DEFAULT NULL,
  `total_hargajual` decimal(18,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `notes_product` text NOT NULL,
  `spec` varchar(100) DEFAULT NULL,
  `tgl_po` date DEFAULT NULL,
  `estimasi` varchar(255) DEFAULT NULL,
  `top_code` varchar(10) DEFAULT NULL,
  `komunikasi` text DEFAULT NULL,
  `masa_garansi` varchar(25) DEFAULT NULL,
  `exp_quotation` date DEFAULT NULL,
  `nama_approval` varchar(50) DEFAULT NULL,
  `tgl_approve` date DEFAULT NULL,
  `batal` int(11) DEFAULT 0,
  `tgl_batal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quotation_h`
--

INSERT INTO `quotation_h` (`acak`, `id`, `user_create`, `no_quotation`, `no_prospect`, `nm_customer`, `tgl_quotation`, `proyek`, `lokasi`, `budget_biayakirim`, `up`, `telp`, `emails`, `kdcust_final`, `nmcust_final`, `alamat_final`, `tlpcust_final`, `up_final`, `npwp_final`, `referensi`, `kd_sales`, `no_so`, `chstatus`, `revisi_ke`, `hargajual`, `prs_ppn`, `ppn`, `total_hargajual`, `notes`, `terms`, `notes_product`, `spec`, `tgl_po`, `estimasi`, `top_code`, `komunikasi`, `masa_garansi`, `exp_quotation`, `nama_approval`, `tgl_approve`, `batal`, `tgl_batal`) VALUES
('634ede5f63', 1, 96, '0001/PEN/X/2022', 'P22-0002', 'BAJA BAJA', '2022-11-19', 'PABRIK BAJA', 'PAPUA', 0, 'JOKO', '0899263727', 'joko@gmap.com', '', 'PT ABADI PLASTIK', 'JL.PLUIT RAYA NO. 4', '021-6690040', 'BAPAK IRAGUNAWAN', '013000724046000', 'CCCC', 96, NULL, 3, 0, '900000000.00', '10.00', '90000000.00', '990000000.00', '- Loco pabrik PT Trafindo Tangerang\n- Tidak termasuk jasa pemasangan & Transportasi\n- Sudah termasuk sertifikat uji pabrik\n- Sudah termasuk commisioning u/ jabodetabek max 1 hari\n- Tidak termasuk tambahan copper link untuk terminasi.', '-', '', 'XX88', NULL, '2 bulan sejak PO, DP dan Approval Drawing diterima', 'TOP5', NULL, '24', '2022-10-31', 'Christiana S Dewi', NULL, 0, NULL),
('634ee28e7f', 2, 96, '0002/PEN/X/2022', 'P22-0003', 'KONSULTAN', '2022-11-19', '-', 'BANDUNG', 0, 'ASEP', '0828391283', 'asep@hello.com', '', 'PT BORNEO MAJU JAYA', 'JL.KURIPAN NO. 2A RT 05', '0511 257427', 'BP. ROY', '016475295731000', '', 96, NULL, 3, 0, '500000000.00', '10.00', '50000000.00', '550000000.00', '- Loco pabrik PT Trafindo Tangerang\n- Tidak termasuk jasa pemasangan & Transportasi\n- Sudah termasuk sertifikat uji pabrik\n- Sudah termasuk commisioning u/ jabodetabek max 1 hari\n- Tidak termasuk tambahan copper link untuk terminasi.', '100% Cash 7 Hari sejak barang dikirim/diambil & invoice diterima', '', '', NULL, '2 bulan sejak PO, DP dan Approval Drawing diterima', 'TOP2', '<br>[Christiana S Dewi<small>24-10-2022 03:50</small>] : tolong ubah TOP menjadi TOP 8', '', '0000-00-00', 'Christiana S Dewi', NULL, 0, NULL),
('634ee3479d', 3, 96, '0003/PEN/X/2022', 'P22-0004', 'SWALLOW', '2022-10-19', 'PABRIK BAN', 'JAKARTA', 0, 'BOBI', '0213299393', 'bobi@live.com', '', 'PT ALLINSON WIJAYA CIPTA', 'TAMAN PALEM LESTARI', '021-55963454', 'BP. ZAINI', '023054554034000', 'WQQ', 96, NULL, 3, 0, '93000000.00', '10.00', '9300000.00', '102300000.00', '- Loco pabrik PT Trafindo Tangerang\n- Tidak termasuk jasa pemasangan & Transportasi\n- Sudah termasuk sertifikat uji pabrik\n- Sudah termasuk commisioning u/ jabodetabek max 1 hari\n- Tidak termasuk tambahan copper link untuk terminasi.', '100% Cash  Hari sejak barang dikirim/diambil & invoice diterima', '', '22', NULL, '2 bulan sejak PO, DP dan Approval Drawing diterima', 'TOP2', NULL, '22', '0000-00-00', 'Christiana S Dewi', NULL, 0, NULL),
('634ee5bd5f', 4, 96, '0004/PEN/X/2022', 'P22-0001', 'SAMUDERA', '2022-10-19', 'AREA PETI KEMAS', 'TANGERANG KAB', 0, 'SULAIMAN', '021322321', 'sulai@gmail.com', 'LAB_002_00', 'PT LABB KONEKTRA', 'JL.MILLENIUM 9 BLOK E2 NO.28', '021 29006947', 'BAPAK ALI', '315776000000000', '', 96, NULL, 3, 0, '2218998887.00', '11.00', '244089877.57', '2463088764.57', '- Loco pabrik PT Trafindo Tangerang\n- Tidak termasuk jasa pemasangan & Transportasi\n- Sudah termasuk sertifikat uji pabrik\n- Sudah termasuk commisioning u/ jabodetabek max 1 hari\n- Tidak termasuk tambahan copper link untuk terminasi.', '30% Uang muka paling lambat 5 Hari  sejak invoice diterima\n70% Paling lambat 6 Bulan  sejak barang dikirim/diambil & invoice diterima', '', '', NULL, '2 bulan sejak PO, DP dan Approval Drawing diterima', 'TOP6', NULL, '', '0000-00-00', 'Christiana S Dewi', NULL, 0, NULL),
('63554ff594', 5, 96, '0005/PEN/X/2022', 'P22-0005', 'VANS', '2022-11-23', 'PABRIK SEPATU', 'BOGOR', 0, 'ALI', '021231999', 'ali@gmail.com', 'ADH_020_00', 'KSO ADHI JAYA KONSTRUKSI ARKON', 'GD. ADHI KARYA, JL. RAYA PASAR', '', 'BP. JEMMY ANDRIYANA', '815508064017000', 'TIDAK ADA', 96, NULL, 3, 0, '35000000.00', '11.00', '3850000.00', '38850000.00', '- Loco pabrik PT Trafindo Tangerang\n- Tidak termasuk jasa pemasangan & Transportasi\n- Sudah termasuk sertifikat uji pabrik\n- Sudah termasuk commisioning u/ jabodetabek max 1 hari\n- Tidak termasuk tambahan copper link untuk terminasi.', '30% Uang muka paling lambat 6 Hari sejak invoice diterima\n70% Cash sebelum barang dikirim/diambil & invoice diterima', 'Deadline 3 bulan wajib selesai', 'XXX788', NULL, '2 bulan sejak PO, DP dan Approval Drawing diterima', 'TOP5', '[Christiana S Dewi] : ubah top 5 menjadi top 6<br> [Christiana S Dewi] : top 6 jadikan top 1<br>[Christiana S Dewi] : Jadikan TOP Other custom<br>[Christiana S Dewi]-<small>24-10-2022 03:42:49</small> : untuk LOKASI tolong di berikan nama lokasi project lebih detail. misal KALIMANTAN, PROYEK IKN<br>[Christiana S Dewi]<small> -24-10-2022 03:48:48</small> : untuk keterangan TOP untuk hari di berikan max 1 bulan', '24', '2022-10-31', 'Christiana S Dewi', NULL, 0, NULL);

--
-- Trigger `quotation_h`
--
DELIMITER $$
CREATE TRIGGER `IQUOT` BEFORE INSERT ON `quotation_h` FOR EACH ROW BEGIN
DECLARE s VARCHAR(20);
DECLARE i INTEGER;
 
SET i = (SELECT SUBSTRING(no_quotation,1,4) AS Nomer
FROM quotation_h ORDER BY Nomer DESC LIMIT 1);

SET s = (SELECT QUO_AUTONUMBER(i));
 
IF(NEW.no_quotation IS NULL OR NEW.no_quotation = '')
 THEN SET NEW.no_quotation =s;
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `quotation_sch`
--

CREATE TABLE `quotation_sch` (
  `id` int(11) NOT NULL,
  `acak` varchar(10) DEFAULT NULL,
  `tgl_tagihan` date DEFAULT NULL,
  `top_cd` varchar(10) DEFAULT NULL,
  `prs` int(3) DEFAULT NULL,
  `jarak` int(10) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `tagihan` decimal(20,2) DEFAULT NULL,
  `bayar` decimal(20,6) DEFAULT NULL,
  `no_so` varchar(50) DEFAULT NULL,
  `kd_cust` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='jadwal rincian pembayaran atas quotation\r\n';

-- --------------------------------------------------------

--
-- Struktur dari tabel `top_d`
--

CREATE TABLE `top_d` (
  `id` int(11) NOT NULL,
  `top_cd` varchar(10) DEFAULT NULL,
  `prs_top` int(3) DEFAULT 0,
  `deskripsi` varchar(255) DEFAULT NULL,
  `jarak` int(5) DEFAULT 0,
  `periodik` char(1) DEFAULT NULL,
  `kondisi` int(1) DEFAULT NULL COMMENT '1 : before & 2 : after',
  `tgl_trm_inv` bit(1) DEFAULT NULL,
  `tgl_np` bit(1) DEFAULT NULL,
  `tgl_bast` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='term of payment detail';

--
-- Dumping data untuk tabel `top_d`
--

INSERT INTO `top_d` (`id`, `top_cd`, `prs_top`, `deskripsi`, `jarak`, `periodik`, `kondisi`, `tgl_trm_inv`, `tgl_np`, `tgl_bast`) VALUES
(1, 'TOP1', 100, 'Cash sebelum barang dikirim/diambil', 0, 'H', 1, b'0', b'1', b'0'),
(2, 'TOP2', 100, 'Cash_sejak barang dikirim/diambil & invoice diterima', 0, 'H', 2, b'1', b'1', b'0'),
(3, 'TOP3', 100, 'Dengan giro mundur_, giro mundur diterima sebelum barang dikirim/diambil & invoice diter', 0, 'B', 1, b'1', b'1', b'0'),
(5, 'TOP4', 100, 'Dengan scf usance_sejak barang dikirim & invoice diterima', 0, 'H', 2, b'1', b'1', b'0'),
(6, 'TOP5', 30, 'Uang muka paling lambat_sejak invoice diterima', 0, 'H', 2, b'1', b'0', b'0'),
(7, 'TOP5', 70, 'Cash sebelum barang dikirim/diambil & invoice diterima', 0, 'H', 1, b'1', b'1', b'0'),
(8, 'TOP6', 30, 'Uang muka paling lambat_ sejak invoice diterima', 0, 'H', 2, b'1', b'0', b'0'),
(9, 'TOP6', 70, 'Paling lambat_ sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'0'),
(10, 'TOP9', 30, 'Uang muka paling lambat_ sejak invoice diterima', 0, 'H', 2, b'1', b'0', b'0'),
(11, 'TOP9', 70, 'Dengan giro mundur_, giro mundur diterima sebelum barang dikirim/diambil & invoice diterima', 0, 'B', 1, b'1', b'1', b'0'),
(12, 'TOP10', 20, 'Uang muka paling lambat_ sejak invoice diterima', 0, 'M', 2, b'1', b'0', b'0'),
(13, 'TOP10', 75, 'Paling lambat_ sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'0'),
(14, 'TOP10', 5, 'Retensi selam_ sejak TESTCOM atau maksimal # sejak barang dikirim/diambil', 0, 'B', 2, b'1', b'1', b'0'),
(15, 'TOP11', 10, 'Uang muka paling lambat_sejak invoice diterima dicounter bank garansi', 0, 'M', 2, b'1', b'0', b'0'),
(16, 'TOP11', 60, 'Paling lambat_ sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'0'),
(17, 'TOP11', 25, 'Maksimal_ sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'1'),
(18, 'TOP11', 5, 'Retensi selama_sejak BAST 1 atau maksimal_bulan sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'1'),
(19, 'TOP12', 10, 'Uang muka paling lambat_ sejak invoice diterima dicounter bank garansi', 0, 'M', 2, b'1', b'0', b'0'),
(20, 'TOP12', 60, 'Paling lambat_sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'0'),
(21, 'TOP12', 25, 'Maksimal_sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'1'),
(22, 'TOP12', 5, 'Retensi selama_sejak BAST 2 atau maksimal # sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'1'),
(23, 'TOP13', 10, 'Uang muka, paling lambat_ sejak drawing approved & invoice diterima', 0, 'M', 2, b'1', b'0', b'0'),
(24, 'TOP13', 75, 'Paling lambat_sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'0'),
(25, 'TOP13', 5, 'Retensi selama_sejak tescom atau maksimal # sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'0'),
(26, 'TOP14', 10, 'Uang muka paling lambat_sejak invoice diterima', 0, 'M', 2, b'1', b'0', b'0'),
(27, 'TOP14', 60, 'Dengan scf usance_sejak barang dikirim & invoice diterima', 0, 'H', 2, b'1', b'1', b'0'),
(28, 'TOP14', 20, 'Paling lambat_sejak trafo terpasang atau maksimal # bulan sejak barang dikirim/diambil & invoice diterima', 0, 'B', 2, b'1', b'1', b'0'),
(29, 'TOP14', 5, 'Setelah testcom, maksimal_ sejak barang dikirim & invoice diterima,', 0, 'B', 2, b'1', b'1', b'0'),
(30, 'TOP14', 5, '5% dicounter bank garansi selama_sebagai retensi', 0, 'B', 2, b'0', b'0', b'0'),
(31, 'TOP15', 100, 'Paling lambat 30 hari setelah berita acara', 30, 'H', 2, b'0', b'0', b'1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `top_h`
--

CREATE TABLE `top_h` (
  `id` int(11) NOT NULL,
  `top_cd` varchar(10) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `aktif` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='term of payment header ';

--
-- Dumping data untuk tabel `top_h`
--

INSERT INTO `top_h` (`id`, `top_cd`, `deskripsi`, `jenis`, `aktif`) VALUES
(1, 'TOP1', 'Term Of Payment  1', 'SLS', b'1'),
(2, 'TOP2', 'Term Of Payment 2', 'SLS', b'1'),
(3, 'TOP3', 'Term Of Payment 3', 'SLS', b'0'),
(4, 'TOP4', 'Term Of Payment 4', 'SLS', b'0'),
(5, 'TOP5', 'Term Of Payment 5', 'SLS', b'1'),
(6, 'TOP6', 'Term Of Payment 6', 'SLS', b'1'),
(7, 'TOP9', 'Term Of Payment 9', 'SLS', b'0'),
(8, 'TOP10', 'Term Of Payment 10', 'SLS', b'1'),
(9, 'TOP11', 'Term Of Payment 11', 'SLS', b'1'),
(10, 'TOP12', 'Term Of Payment 12', 'SLS', b'1'),
(11, 'TOP13', 'Term Of Payment 13', 'SLS', b'1'),
(12, 'TOP14', 'Term Of Payment 14', 'SLS', b'0'),
(13, 'TOP15', 'Term Of Payment 15', 'SRV', b'0'),
(14, 'TOPC', 'Term Of Payment Other', 'SLS', b'1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `urutan`
--

CREATE TABLE `urutan` (
  `norut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `urutan`
--

INSERT INTO `urutan` (`norut`) VALUES
('1'),
('11'),
('11'),
('/PEN/'),
('/PEN/'),
('0'),
('0001/PEN/X/2022'),
('2/PEN/X/2022'),
('0002/PEN/X/2022'),
('0035/PEN/X/2022');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`kd_user`),
  ADD KEY `kd_user` (`kd_user`);

--
-- Indeks untuk tabel `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pracost`
--
ALTER TABLE `pracost`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nopracost` (`nopracost`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `quotation_d`
--
ALTER TABLE `quotation_d`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `quotation_h`
--
ALTER TABLE `quotation_h`
  ADD PRIMARY KEY (`id`,`no_quotation`),
  ADD UNIQUE KEY `acak` (`acak`);

--
-- Indeks untuk tabel `quotation_sch`
--
ALTER TABLE `quotation_sch`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `top_d`
--
ALTER TABLE `top_d`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `top_h`
--
ALTER TABLE `top_h`
  ADD PRIMARY KEY (`id`,`top_cd`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `kd_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pracost`
--
ALTER TABLE `pracost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `quotation_d`
--
ALTER TABLE `quotation_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `quotation_h`
--
ALTER TABLE `quotation_h`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `quotation_sch`
--
ALTER TABLE `quotation_sch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `top_d`
--
ALTER TABLE `top_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `top_h`
--
ALTER TABLE `top_h`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
