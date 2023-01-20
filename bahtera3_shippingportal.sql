-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2023 pada 06.46
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bahtera3_shippingportal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agent`
--

CREATE TABLE `agent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_agent` varchar(10)  NOT NULL,
  `name_agent` varchar(50)  NOT NULL,
  `address` longtext  NOT NULL,
  `id_city` int(11) NOT NULL,
  `postal` varchar(11)  NOT NULL,
  `telp` varchar(20)  NOT NULL,
  `fax` varchar(20)  NOT NULL,
  `npwp` varchar(50)  NOT NULL,
  `pkp_no` varchar(50)  NOT NULL,
  `desc_agent` longtext  NOT NULL,
  `payment_term` int(11) NOT NULL,
  `name_person` varchar(50)  NOT NULL,
  `phone_person` varchar(50)  NOT NULL,
  `email_person` varchar(30)  NOT NULL,
  `fax_person` varchar(30)  NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `agent`
--

INSERT INTO `agent` (`id`, `code_agent`, `name_agent`, `address`, `id_city`, `postal`, `telp`, `fax`, `npwp`, `pkp_no`, `desc_agent`, `payment_term`, `name_person`, `phone_person`, `email_person`, `fax_person`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A0001', 'Cahaya Esa', 'Jalan Mawar Indah no 12 Tangerang Banten', 2, '', '0213141333', '0213141333', '', '', '', 12, 'Maria Subrantyo', '087221222334', 'marias@gmail.com', '', 0, '2020-08-01 11:11:29', NULL, NULL),
(3, 'A0002', 'PELANGI JAYA', 'Jalan Raya Puputan No 108 Renon', 3, '80234', '0212221111', '0213333333', '71.2112.1121.1.111', '980', 'Agent Desc disini', 14, 'Bastian', 'bbaztanzi@gmail.com', '08123456123', '0361654433', 0, '2020-08-20 06:18:48', '2020-08-20 06:18:48', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_account`
--

CREATE TABLE `bank_account` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` int(11) NOT NULL,
  `bank_name` varchar(50)  NOT NULL,
  `bank_account` varchar(50)  NOT NULL,
  `branch` varchar(50)  NOT NULL,
  `account_name` varchar(100)  NOT NULL,
  `bank_address` longtext  NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `bank_account`
--

INSERT INTO `bank_account` (`id`, `agent_id`, `bank_name`, `bank_account`, `branch`, `account_name`, `bank_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'BCA', '6112223334', 'Jakarta', 'Maria Subrantyo', 'Jalan Raya Pusatnya Jakarta', '2020-08-01 11:12:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `consignee`
--

CREATE TABLE `consignee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_consignee` varchar(10)  NOT NULL,
  `name_consignee` varchar(50)  NOT NULL,
  `address_invoice` longtext  NOT NULL,
  `address` longtext  NOT NULL,
  `id_city` int(11) NOT NULL,
  `postal` varchar(11)  NOT NULL,
  `telp` varchar(20)  NOT NULL,
  `fax` varchar(20)  NOT NULL,
  `npwp` varchar(50)  NOT NULL,
  `pkp_no` varchar(50)  NOT NULL,
  `desc_consignee` longtext  NOT NULL,
  `payment_term` int(11) NOT NULL,
  `name_person` varchar(50)  NOT NULL,
  `phone_person` varchar(50)  NOT NULL,
  `email_person` varchar(30)  NOT NULL,
  `fax_person` varchar(30)  NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `consignee`
--

INSERT INTO `consignee` (`id`, `code_consignee`, `name_consignee`, `address_invoice`, `address`, `id_city`, `postal`, `telp`, `fax`, `npwp`, `pkp_no`, `desc_consignee`, `payment_term`, `name_person`, `phone_person`, `email_person`, `fax_person`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'C0186', 'Aloysius Purnomo', 'Jalan Raya Puputan No 108 Renon', 'Jalan Raya Puputan No 108 Renon Denpasar', 1, '80234', '0216667778', '0213333333', '71.2112.1121.1.111', '222', 'Desc consignee', 14, 'Bastian', '081524635271', '081524635271', '0361654433', '2020-08-21 23:48:33', '2020-08-21 23:48:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `title_id` varchar(150) NOT NULL,
  `description_id` text NOT NULL,
  `title_en` varchar(150) NOT NULL,
  `description_en` text NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `content`
--

INSERT INTO `content` (`id`, `title_id`, `description_id`, `title_en`, `description_en`, `image`, `type`) VALUES
(1, 'Mengapa BAHTERA SETIA adalah pilihan yang TEPAT bagi Anda?', 'Kepuasan anda adalah tanggungjawab kami.', 'Why is BAHTERA SETIA the RIGHT choice for you?', 'Your satisfaction is our responsibility.', NULL, 'slogan'),
(2, 'HARGA YANG KOMPETITIF', 'BAHTERA SETIA menawarkan harga yang kompetitif dengan layanan jasa yang beragam.', 'COMPETITIVE PRICES', 'BAHTERA SETIA offers competitive prices with a variety of services.', '8-512x600.jpg', 'service_detail'),
(3, 'REAL TIME TRACKING', 'BAHTERA SETIA memberikan kemudahan dalam melakukan monitoring pengiriman cargo setiap saat kapanpun dan dimanapun.', 'REAL TIME TRACKING', 'BAHTERA SETIA provides convenience in monitoring cargo shipments at any time, anytime and anywhere.', '7-900x1055.jpg', 'service_detail'),
(4, 'SERVICE EXELENT', 'BAHTERA SETIA selalu ingin melayani anda kapanpun anda butuhkan.', 'SERVICE EXELENT', 'BAHTERA SETIA always wants to serve you whenever you need.', '3-900x1055.jpg', 'service_detail'),
(5, 'KEPASTIAN JADWAL & JARINGAN LUAS', 'BAHTERA SETIA memiliki banyak cabang dan pilihan rute yang bervariasi.', 'ASSURANCE SCHEDULE & WIDE NETWORK', 'BAHTERA SETIA has many branches and various route options.', '4-900x1055.jpg', 'service_detail'),
(6, 'Klien Kami', 'Kami memiliki lebih dari 20 klien perusahaan', 'Our Client', 'We have more than 20 corporate clients', NULL, 'our_client'),
(7, 'LAYANAN KAMI', 'Sebagai perusahaan shipping logistic (shiplog), BAHTERA SETIA memberika solusi layanan pengiriman logistik yang tersedia sesuai dengan kebutuhan', 'OUR SERVICE', 'As a shipping logistic company (shiplog), BAHTERA SETIA provides logistics delivery service solutions that are available according to your needs', NULL, 'service'),
(8, 'Siapa Kami', '<p>PT. Bahtera Setia merupakan perusahaan yang bergerak di bidang jasa muat dan bongkar di pelabuhan Gresik untuk menunjang kegiatan perusahaan Pelayaran Nasional</p>', 'Who Us', '<p>PT. Bahtera Setia is a company engaged in loading and unloading services at the Gresik port to support the activities of National Shipping companies</p>', NULL, 'about');

-- --------------------------------------------------------

--
-- Struktur dari tabel `content_footer`
--

CREATE TABLE `content_footer` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `content_footer`
--

INSERT INTO `content_footer` (`id`, `title`, `description`, `position`) VALUES
(1, 'Address', '<p>Jl. Yos Sudarso II/10 Gresik 61114 - Jawa Timur - Indonesia</p>', 'left'),
(2, 'Contacts', '<p>Email:<br />\r\nbahtera.setiaa@yahoo.co.id<br />\r\nptbahteta.setia@gmail.com</p>\r\n\r\n<p><br />\r\nPhone:<br />\r\n031 - 3985449, 3984451, 397041</p>\r\n\r\n<p>Website:<br />\r\nwww.bahterasetiagroup.com</p>', 'left'),
(3, 'Branch Office', '<p>Surabaya : Jalan. Ikan Mujaer No. 60 - Telephone : 031 - 99018168<br />\r\nJakarta : Komplek kantor Selmis Blok C No. 52 D Jl. Asem Baris Raya Kebun baru Tebet - Jakarta selatan, Telephone : 021 - 8296598 - 8296599<br />\r\nSemarang : Ruko Semarang Indah Blok B1 / No. 8E Maduporo Telephone :024 7609224<br />\r\nMakassar : Jalan. Yos Sudarso No. 28 Kota Makassar<br />\r\nLamongan : Jalan. Raya Daendles KM 64<br />\r\nKumai : Jalan. Bendahara No. 214 Telephone : 053126165<br />\r\nPulang Pisau : Jalan. Tingan Menteng No.10<br />\r\nKaimana : Jalan. diponogoro Papua Barat<br />\r\nSampit : Jalan. H. Juanda Iskandar 29 No. 09</p>', 'right'),
(4, 'Feedback', '<p>Please send us your ideas, bug reports, suggestions! Any feedback would be appreciated.</p>', 'right'),
(5, 'Maps', '', 'bottom'),
(6, 'Whatsapp', '081231436666', 'top');

-- --------------------------------------------------------

--
-- Struktur dari tabel `content_image`
--

CREATE TABLE `content_image` (
  `id` int(10) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `content_image`
--

INSERT INTO `content_image` (`id`, `image`) VALUES
(3, 'pp-1600x989.png'),
(4, 'logo-wika-1929x1563.png'),
(5, 'jaya-beton-ok-1772x591.png'),
(6, 'adhimix-logo-0c600d7c5e0d84881b2d1ebed01de2a83e7742bf6a6c1e9078d806264c9c1e5c-1501x777.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_customer` varchar(10)  NOT NULL,
  `name_customer` varchar(50)  NOT NULL,
  `address_invoice` longtext  DEFAULT NULL,
  `address` longtext  NOT NULL,
  `id_city` int(11) DEFAULT NULL,
  `city` varchar(250)  NOT NULL,
  `province` varchar(250)  NOT NULL,
  `entity_id` int(11) NOT NULL,
  `postal` varchar(11)  DEFAULT NULL,
  `telp` varchar(20)  DEFAULT NULL,
  `fax` varchar(20)  DEFAULT NULL,
  `npwp` varchar(50)  DEFAULT NULL,
  `pkp_no` varchar(50)  NOT NULL,
  `desc_customer` longtext  DEFAULT NULL,
  `payment_term` int(11) NOT NULL,
  `name_person` varchar(50)  NOT NULL,
  `phone_person` varchar(50)  NOT NULL,
  `email` varchar(30)  NOT NULL,
  `fax_person` varchar(30)  DEFAULT NULL,
  `username` varchar(50)  NOT NULL,
  `password` varchar(50)  NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code` varchar(255)  DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `code_customer`, `name_customer`, `address_invoice`, `address`, `id_city`, `city`, `province`, `entity_id`, `postal`, `telp`, `fax`, `npwp`, `pkp_no`, `desc_customer`, `payment_term`, `name_person`, `phone_person`, `email`, `fax_person`, `username`, `password`, `status`, `email_verified_at`, `verification_code`, `is_verified`, `created_at`, `updated_at`, `deleted_at`) VALUES
(43, 'R0001', 'mulia', NULL, 'jl.mawar no 32', 1, 'surabaya', 'east java', 1, '60121', '0317545444', '0317545444', NULL, '0', '', 0, 'mulia', '087767676767', 'istiadahimaro12@gmail.com', '0317545444', 'irham', 'f23c9a5dca7aef19a3db264c5c21a2f8', 0, '2020-12-21 00:05:56', '8485eb0f81fa151e98e3c621dad40bb5df380c61', 1, '2020-12-21 00:04:22', '2020-12-21 00:05:56', NULL),
(44, 'R0002', 'Bastian', NULL, 'Bali', 1, 'Denpasar', 'Bali', 9, '80361', '0361111111', '0361111111', NULL, '0', '', 0, 'Bastian', '081234567890', 'bbaztanzi@gmail.com', '0361111111', 'bastian', 'ab4019712e96f8042c20531c879c7b50', 0, '2021-01-09 04:19:03', 'bc818b88f6e76904c378e7624212fbf73b0279fb', 1, '2021-01-09 04:18:06', '2021-01-09 04:19:03', NULL),
(45, 'R0003', 'test', NULL, 'test', 1, 'surabaya', 'east java', 1, '60111', '081332459328', '-', NULL, '0', '', 0, 'test', '08123324444', 'irhamp12@gmail.com', '-', 'irhamp12@gmail.com', '8adae46061417cdb612cb4d892d412e2', 0, '2021-10-16 14:46:15', '62987546f99d162d4e1df21f5eda64868ee334cf', 1, '2021-10-16 14:36:19', '2021-10-16 14:46:15', NULL),
(46, 'R0004', 'Rozma Abadi', NULL, 'Jl kh syafii no 95', 1, 'Gresik', 'Jawa timur', 2, '61151', NULL, NULL, NULL, '0', '', 0, 'Rozma Abadi', '082218997949', 'cvrozmaabadi@gmail.com', NULL, 'Edwin yulianto', 'ef4443767b0d98ab07355efb429b0b24', 0, '2022-05-28 04:56:37', '03c6f1ecf2c6ad76e07e0f0f48c3ac3e06604321', 1, '2022-05-28 04:19:24', '2022-05-28 04:56:37', NULL),
(47, 'R0005', 'PT RLK Development Indonesia', NULL, '*PT RLK DEVELOPMENT INDONESIA*  Jl. A. Yani Km. 8 Komplek Citraland, Escapade Blok A2, No. 18 Banjarmasin, Kalimantan Selatan', 1, 'Banjarmasin', 'Kalimantan Selatan', 1, NULL, NULL, NULL, NULL, '0', '', 0, 'PT RLK Development Indonesia', '082234758389', 'alfinsetiantoro@rlkcorp.com', NULL, 'Alfinsetiantoro', '9ec716892dc6cf6dea5ebf89a5965dc1', 0, '2022-10-03 02:04:16', 'f30531013a7928e14b7dc531e79967afe710ed78', 1, '2022-10-02 15:20:43', '2022-10-03 02:04:16', NULL),
(48, 'R0006', 'PT RLK Development Indonesia', NULL, '*PT RLK DEVELOPMENT INDONESIA*  Jl. A. Yani Km. 8 Komplek Citraland, Escapade Blok A2, No. 18 Banjarmasin, Kalimantan Selatan', 1, 'Banjarmasin', 'Kalimantan Selatan', 1, NULL, NULL, NULL, NULL, '0', '', 0, 'PT RLK Development Indonesia', '082234758389', 'alfinsetiantoro@rlkcorp.com', NULL, 'Alfinsetiantoro', '9ec716892dc6cf6dea5ebf89a5965dc1', 0, NULL, '075200c664abc78db46b9f8ec149f5470400012f', 0, '2022-10-02 15:20:45', '2022-10-02 15:20:45', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `entity`
--

CREATE TABLE `entity` (
  `id` int(11) NOT NULL,
  `entity_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `entity`
--

INSERT INTO `entity` (`id`, `entity_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PT', '0000-00-00 00:00:00', NULL, NULL),
(2, 'CV', '0000-00-00 00:00:00', NULL, NULL),
(3, 'UD', '0000-00-00 00:00:00', NULL, NULL),
(4, 'TOKO', '0000-00-00 00:00:00', NULL, NULL),
(5, 'FA', '0000-00-00 00:00:00', NULL, NULL),
(6, 'YAYASAN', '0000-00-00 00:00:00', NULL, NULL),
(7, 'PD', '0000-00-00 00:00:00', NULL, NULL),
(8, 'LTD', '0000-00-00 00:00:00', NULL, NULL),
(9, 'PERORANGAN', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text  NOT NULL,
  `queue` text  NOT NULL,
  `payload` longtext  NOT NULL,
  `exception` longtext  NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB  ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `location`
--

CREATE TABLE `location` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_city` varchar(10)  NOT NULL,
  `name_city` varchar(50)  NOT NULL,
  `province_city` varchar(20)  NOT NULL,
  `status_loading` tinyint(1) NOT NULL DEFAULT 0,
  `status_pelayaran` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `location`
--

INSERT INTO `location` (`id`, `code_city`, `name_city`, `province_city`, `status_loading`, `status_pelayaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '001', 'Ambon', 'Maluku', 0, 0, '2020-08-01 10:10:49', NULL, NULL),
(2, '006', 'Tangerang', 'Banten', 0, 0, '2020-08-01 10:12:38', NULL, NULL),
(3, '002', 'Jakarta Selatan', 'Jakarta', 0, 0, '2020-08-01 11:45:43', NULL, NULL),
(4, '003', 'Denpasar', 'Bali', 0, 0, '2020-08-22 00:57:06', '2020-08-22 00:57:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `logo_name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `logo`
--

INSERT INTO `logo` (`id`, `logo_name`) VALUES
(1, '1604728040.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255)  NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_25_134933_create_news_table', 1),
(5, '2020_07_25_134922_create_news_category_table', 1),
(6, '2020_07_25_135853_create_news_image_table', 1),
(7, '2020_08_01_165605_create_pelayaran_table', 1),
(8, '2020_08_01_171709_create_customer_table', 1),
(9, '2020_08_01_172147_create_agent_table', 1),
(10, '2020_08_01_172308_create_bank_account_table', 1),
(11, '2020_08_01_172558_create_tarif_table', 1),
(12, '2020_08_01_172907_create_consignee_table', 1),
(13, '2020_08_01_173155_create_vendor_truck_table', 1),
(14, '2020_08_01_173531_create_trucking_type_table', 1),
(15, '2020_08_01_173642_create_location_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext  NOT NULL,
  `text` longtext  NOT NULL,
  `img_title` varchar(250)  NOT NULL,
  `news_category_id` bigint(11) UNSIGNED NOT NULL,
  `location` varchar(2)  NOT NULL DEFAULT 'id',
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `img_title`, `news_category_id`, `location`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<p>Luhut Mau Tawarkan <strong>Harta Karun</strong> RI ke AS</p>', '<p><strong>Jakarta</strong> - Menteri Koordinator Bidang Kemaritiman dan Investasi Luhut Binsar Pandjaitan mengaku akan menawarkan &#39;harta karun&#39; kepada negara-negara yang siap menjadi investor. Salah satunya yang akan ditawari adalah Amerika Serikat (AS).</p>\r\n\r\n<p>Dia mengaku investor yang sudah siap mengembangkan &#39;harta karun&#39; di Indonesia adalah China. Namun dirinya tidak ingin menyerahkan ke negeri Tirai Bambu ini demi menjaga iklim investasi nasional.</p>\r\n\r\n<p>&quot;Ini kita juga memang dilematis, karena rare earth kan paling banyak diproduksi di Tiongkok, Amerika sendiri begitu di banned oleh Tiongkok itu kelabakan juga. Nah investor yang paling cepat sekarang itu Tiongkok, nah kalau kita semua kasih Tiongkok nanti semua mental,&quot; kata Luhut dalam acara Investasi di tengah Pandemi secara virtual, Sabtu (25/7/2020).</p>', '084bd603-0b34-4f4c-bd5c-4999fd9d23dc_1691.jpg', 1, 'id', 1, '2020-08-05 21:16:38', '2020-08-05 21:16:38', NULL),
(2, 'Kabar Gembira! Penukaran Uang Khusus Rp 75 Ribu Dibuka Lagi', '<p><b>Jakarta</b> - Bank Indonesia (BI) akan kembali membuka penukaran uang rupiah khusus pecahan Rp 75 ribu. Kepala Departemen Pengelolaan Uang Marlison Hakim menjelaskan bank sentral melihat animo masyarakat dan antusiasme yang tinggi dengan penerbitan uang ini.</p>\r\n\r\n<p>\"Kami harap masyarakat luas makin cepat makin banyak dapat UPK (Uang Pecahan Khusus) ini, kami harap masyarakat luas makin cepat makin banyak dapat UPK ini,\" kata dia dalam konferensi pers, Senin (24/8/2020).</p>\r\n\r\n<p>Dia mengungkapkan, BI telah melakukan evaluasi dan memandang perlu percepatan untuk pengedaran uang ini. Namun tetap dilakukan secara aman dengan seluruh protokol COVID-19 yang ketat.</p>\r\n\r\n<p>Karena itu BI membuka kembali permohonan penukaran melalui aplikasi PINTAR untuk masyarakat. Selain itu BI juga membuka layanan penukaran secara kolektif kepada masyarakat seperti pegawai di Kementerian Lembaga, instansi, korporasi, asosiasi dan perkumpulan.</p>\r\n\r\n<p>\"Masyarakat juga bisa melakukan kolektif jika ingin mendapatkan uang kemerdekaan ini. Minimal 17 orang untuk 17 fotokopi KTP,\" jelas dia.</p>', 'uang-khusus-hut-ri-ke-75-2_169.png', 2, 'id', 1, NULL, NULL, NULL),
(3, 'Negosiasi Dagang Inggris-Uni Eropa Masih Buntu', '<p><b>Jakarta</b> - Negosiasi kesepakatan dagang antara Inggris dan Uni Eropa usai Brexit atau keluarnya Inggris dari Uni Eropa pada pekan lalu berujung buntu. Kedua belah pihak, sepakat diskusi akan diperpanjang 2 bulan lagi hingga pertengahan Oktober. Diskusi selanjutnya berlangsung pada 7 September mendatang.</p>\r\n\r\n<p>Negosiator UE, Michle Barnier mengatakan negosiasi perdagangan pekan lalu tidak mendapatkan terobosan baru karena mengarah ke permasalahan di luar agenda, seperti hak penangkapan ikan komersial. Hal ini dianggap Barnier hanya membuang-buang waktu dan sulit mencapai kesepakatan baru.</p>\r\n\r\n<p>\"Pada tahap ini, kesepakatan antara Inggris dan Uni Eropa tampaknya tidak mungkin. Saya benar-benar tidak mengerti mengapa kita membuang-buang waktu yang berharga,\" ujar Barnier, dikutip dari CNN, Senin (24/8/2020).\r\nSedangkan menurut negosiator Inggris David Frost kebijakan perikanan masih masuk dalam poin-poin penting. Frost menganggap kesepakatan dagang masih mungkin dilakukan, meski sulit.</p>\r\n\r\n<p>\"Ada bidang penting lainnya yang masih harus diselesaikan dan, bahkan ada pemahaman luas antara negosiator yang harus diselesaikan. Namun, waktu yang kita meiliki terlalu singkat,\" katanya.</p>\r\n\r\n<p>Perlu diketahui Inggris meninggalkan Uni Eropa pada bulan Januari tahun lalu. Tetapi ketentuan perdagangan dengan UE tidak berubah selama periode transisi yang akan berakhir pada akhir tahun 2020. Jika negosiator gagal untuk membuat kesepakatan baru, perusahaan Inggris akan menghadapi biaya perdagangan yang lebih tinggi.</p>\r\n\r\n<p>Pejabat UE dan Inggris mengatakan kesepakatan dagang ini diharapkan dapat memperbaiki ekonomi Inggris yang telah terpuruk sejak Brexit. Output ekonomi Inggris menyusut dengan rekor 20,4% pada kuartal-II 2020. Mendorong negara itu terperosok ke jurang resesi. Selain itu. sekitar 730 ribu pekerjaan telah dicabut, sejak pandemi virus Corona memaksa bisnis tutup pada Maret lalu.</p>', 'fcb0b271-6dae-42f0-bb63-d0ba54c321de_169.jpeg', 1, 'id', 1, NULL, NULL, NULL),
(4, 'Kemenhub Sebut 40% Perdagangan Dunia Lewat Laut RI, Dapat Untung?', '<p><b>Jakarta</b> - Kementerian Perhubungan (Kemenhub) menyatakan perairan di wilayah Indonesia punya peran penting dalam perdagangan internasional. Banyak kapal yang pengangkut barang sering melintasi perairan Indonesia.</p>\r\n\r\n<p>Dirjen Perhubungan Laut Kemenhub Agus H. Purnomo mengatakan lalu lintas kargo pengiriman barang di dunia barang 90%-nya dilakukan lewat jalur laut. Kemudian, hampir 50% pelayaran tersebut di melalui laut Indonesia.</p>\r\n\r\n<p>\"Hampir 50% atau sekitar 40% perdagangan di dunia itu melalui laut yang bersinggungan dengan Indonesia. Pengiriman kargo, 90% diangkut melalui laut, 40%-nya akan lewat di perairan Indonesia,\" papar Agus dalam webinar yang diadakan Kemenhub, Senin (24/8/2020).</p>\r\n\r\n<p>\"Ini luar biasa bagaimana kita bisa menangkap peluang ini sebaik-baiknya,\" lanjutnya.</p>\r\n\r\n<p>Menanggapi hal itu, Kemenhub sudah mengambil kebijakan untuk mengadopsi bagan pemisah lalu lintas atau Traffic Separation Scheme (TSS), yang ditetapkan di Selat Sunda dan Selat Lombok.</p>\r\n\r\n<p>TSS Selat Sunda dan Selat Lombok resmi diberlakukan sejak 1 Juli 2020. Hal ini akan meningkatkan profil dan citra Indonesia di lingkungan Internasional sebagai salah satu negara maritim.</p>\r\n\r\n<p>\"Di jalur perdagangan dunia, Indonesia ini sangat besar pengaruhnya. Ini saya sedikit sampaikan, TTS Selat Sunda dan Selat Lombok kita mulai berlakukan secara internasional per 1 Juli 2020. Ini salah satu di antara jalur pelayaran internasional yang melalui Indonesia,\" jelas Agus.</p>\r\n\r\n<p>Agus meneruskan pemerintah sedang fokus untuk menyiapkan sarana dan prasarana untuk mendukung konektivitas transportasi laut. Salah satunya dengan melakukan pembangunan pelabuhan di berbagai daerah.</p>\r\n\r\n<p>Selama ini menurutnya banyak pelabuhan yang belum mampu jadi sandaran kapal besar dengan kargo. Pihaknya sedang mengupayakan agar hal itu bisa terwujud, setidaknya ada 1.321 pelabuhan yang akan dibangun.</p>\r\n\r\n<p>\"Kalau kita lihat sebaran pelabuhan di seluruh Indonesia ada 28 pelabuhan utama dari Sabang ke Merauke. Dengan 4 main port dan kemudian masih ada 164 pelabuhan pengumpul, dan lokal juga banyak,\" ungkap Agus.</p>\r\n', '084bd603-0b34-4f4c-bd5c-4999fd9d23dc_169.jpg', 3, 'id', 1, NULL, NULL, NULL),
(5, 'Tambah 1.877, Kasus Positif Corona di RI Per 24 Agustus Jadi 155.412', '<p><b>Jakarta</b> - Kasus positif virus Corona (COVID-19) di Indonesia kembali bertambah. Hari ini kasus positif Corona di RI bertambah sebanyak 1.877.</p>\r\n\r\n<p>Pertambahan kasus Corona ini dikutip dari data yang diterima dari Humas BNPB, Senin (24/8/2020). Cut off time pengambilan data adalah pukul 12.00 WIB.</p>\r\n\r\n<p>Dengan penambahan 1.877, total kasus positif Corona di Indonesia menjadi 155.412. Selain kasus positif, jumlah pasien yang sembuh dari Corona bertambah.</p>\r\n\r\n<p>Terdapat penambahan jumlah pasien yang sembuh dari Corona sebanyak 3.560, sehingga total pasien yang telah sembuh dari Corona berjumlah 111.060.</p>\r\n\r\n<p>Untuk kasus pasien Corona yang meninggal juga bertambah. Terdapat penambahan jumlah pasien Corona yang meninggal sebanyak 79, sehingga totalnya menjadi 6.759.</p>\r\n\r\n<p>Pada Minggu (23/8), total kasus positif Corona di RI sebanyak 153.535. Total pasien yang sembuh berjumlah 107.500, sedangkan total pasien yang meninggal sebanyak 6.680.</p>', '5d30bbd1-6889-47a1-9f6f-9ea34721a977_169.jpeg', 5, 'id', 1, NULL, NULL, NULL),
(7, 'Bongkar Muat Pelabuhan Gresik Turun', '<p><b>KOTA</b> - Arus bongkar muat di Pelabuhan Gresik mengalami penurunan selama Semester I/2018. Akibatnya kinerja PT Pelabuhan Indonesia III Cabang Gresik ikut terkoreksi. Mereka menuding beroperasinya Terminal Untuk Kepentingan Sendiri (TUKS) menjadi penyebab turunnya kinerja itu.</p>\r\n\r\n<p>General Manager PT Pelindo III Cabang Gresik, Yanto mengungkapkan, sejak beroprasinya TUKS milik salah satu perusahaan di kawasan Manyar, pihaknya kehilangan potensi pendapatan. Terutama dari sektor bongkar muat Crude Palm Oil (CPO) yang mencapai 45.000 ton perbulan.</p>\r\n\r\n<p>Kondisi ini, kata dia, secara otomatis membuat bongkar muat di Pelabuhan Gresik untuk curah cair turun. Semester I/2017 tercatat 538,682 ton. Kemudian semester yang sama tahun ini turun menjadi 435,187 ton.</p>\r\n\r\n<p>Hasil yang sama juga terlihat dari bongkar muat curah kering. Pada semester I/2018 sektor ini mencatat penurunan menjadi 1.150 ton. Padahal periode yang sama tahun lalu membukukan angka 1.341 ton. “Secara total jumlah bongkar muat curah kering juga turun,\" ujar GM Pelabuhan Gresik.</p>\r\n\r\n<p>Namun untuk kargo umum ada kenaikan. Itu dikarenakan ada bongkar muat barang kontruksi dan tiang pancang milik PT Bahtera Setia. Sedangkan untuk batu bara dan log penurunan diakibatkan cuaca buruk.</p>\r\n\r\n<p>Dijelaskan, kinerja bongkar muat di pelabuhan Gresik juga banyak dipengaruhi atas diberikannya izin TUKS Maspion untuk melayani kegiatan bongkar muat umum. Ini berdampak pada menurunnya jumlah kunjungan kapal dari industri yang berada di wilayah Gresik Utara.</p>\r\n\r\n<p>Ketua Asosiasi Pengusaha Indonesia (Apindo) Gresik, Tri Andhi Suprihartono menilai, persaingan industri kepelabuhanan di Gresik semakin ketat. Ini menyusul semakin banyaknya pelabuhan baru di Gresik.</p>\r\n\r\n<p>“Agar tidak kalah bersaing, pelabuhan rakyat harus terus memperbaiki pelayanan dan menambah fasilitas bongkar muatnya,\" pungkas Andi.</p>\r\n\r\n<p>(sb/fir/ris/JPR)</p>', 'bongkar-muat-pelabuhan-gresik-turun-m-85744-300x200.jpg', 2, 'id', 1, '2020-09-07 06:34:34', NULL, NULL),
(8, 'Mulai 26 April, Pelabuhan Gresik Tutup Pelayanan Angkutan Orang', '<p>SuaraJatim.id - Kantor Kesyahbandaran dan Otoritas Pelabuhan (KSOP) Kelas II Gresik akhirnya menutup semua pelayanan angkutan orang di Pelabuhan Gresik, Minggu (26/4/2020).</p>\r\n\r\n<p>Penutupan pelabuhan merujuk surat Kementerian Perhubungan (Kemenhub) terkait larangan mudik.</p>\r\n\r\n<p>Pantauan di lapangan, kantor pelayanan yang menjadi tempat transit para penumpang kapal, mulai tampak lenggang.</p>\r\n\r\n<p>Tidak seperti satu hari sebelumnya, para penumpang terlihat berjubel mengantre tiket tujuan kapal ke Bawean. Namun hari ini, pemandangannya berbeda jauh.</p>\r\n\r\n<p>Kantor pelayanan yang biasa ramai orang kini sepi. Semua pintu pelabuhan ditutup.</p>\r\n\r\n<p>Di setiap kaca ada pengumuman. Isinya pemberitahuan terkait keputusan Menteri Perhubungan Nomor 25 Tahun 2020, yakni pengendalian transportasi selama musim mudik Idul Fitri dan pencegahan penyebaran virus Corona.</p>\r\n\r\n<p>Kasi Keselamatan Berlayar KSOP Gresik, Capt Masri T Randa Bunga mengatakan, penutupan pelayanan angkutan orang ini berlaku mulai 26 April 2020 hari ini sampai 31 Mei 2020.</p>\r\n\r\n<p>enutupan berkaitan larang pulang kampung dalam upaya pencegahan penyebaran virus Corona.</p>\r\n\r\n<p>\"Iya betul, semua kapal angkutan orang tidak melayani penumpang. Tapi kapal angkutan barang masih beroperasi,\" kata Masri saat ditemui di wilayah kerjanya Pelabuhan Gresik.</p>\r\n\r\n<p>Kendati demikian, pihaknya tetap mempersilahan Kapal Gili Iyang tetap beroperasi dengan rute Bawean-Gresik hanya boleh membawa sembako dan barang kebutuhan lainnya. Tidak boleh membawa penumpang orang.</p>\r\n\r\n<p>Penutupan pelabuhan juga berkaitan mencegah orang-orang yang nekat pulang kampung.</p>\r\n\r\n<p>Hal itu seperti terjadi pada, Jumat (24/4/2020) kemarin, ratusan orang dari perantauan memaksa berlayar ke Bawean untuk pulang kampung.</p>\r\n\r\n<p>\"Mestinya kemarin tidak boleh, karena aturan pusat sudah keluar terkait larangan mudik. Nah harapannya, dengan penutupan ini supaya mereka tidak lagi nekat pulang,\" jelasnya.</p>\r\n\r\n<p>\"Saya kira ini tepat sekali, apalagi kalau di kapal penyebaran virus tidak akan membutuhkan waktu lama. Orang di kapal, kalau satu kena, semua tertular, seperti Kapal Pelni ternyata ada 29 yang positif,\" ungkapnya.</p>\r\n\r\n<p>Kontributor : Amin Alamsyah</p>', '41429-pelabuhan-gresik-jawa-timur-1-653x366.jpg', 5, 'id', 1, '2020-09-07 06:34:34', NULL, NULL),
(9, 'Polisi Amankan 3 Pencuri Truk Trailer, 2 Pelaku Ditembak\r\n', '<p>GRESIK, KOMPAS.com – Sindikat pencuri kendaraan panjang atau biasa dikenal dengan sebutan truk trailer di wilayah Gresik dan sekitarnya, diungkap jajaran Kepolisian Resort (Polres) Gresik. Ada tiga pelaku yang berhasil diamankan petugas yakni, Zainal Mustofa (25) warga Waturoyo, Margoyoso, Pati. Kemudian Hahuk Arif Mujiono (37) warga Plumbon, Selopampang, Temanggung, dan Bangkit Setiawan (24) warga Bandarrejo, Benowo, Surabaya. “Untuk ZM (Zainal Mustofa) dan HAM (Hahuk Arif Mujiono) kami berikan tembakan di bagian kaki, karena melawan petugas saat hendak diamankan. Mereka berdua bertindak sebagai eksekutor alias yang mengambil truk pada kejadian 9 November 2017 dinihari lalu,” ujar Kasatreskrim Polres Gresik AKP Adam Purbantoro, Senin (18/12/2017). Adam mengatakan, Zainal dan Hahuk saat itu mencuri truk trailer Nissan Euro bernopol W 9545 UG milik PT Bahtera Setia, yang sedang tidak bermuatan dan terparkir di Pelabuhan Gresik.</p>\r\n\r\n<p>Mereka berdua memanfaatkan kelengahan sopir, yang saat itu tidak mengunci kabin truk dan ditinggal beristirahat. Sementara Bangkit Setiawan mengawasi area sekitar saat pencurian berlangsung. “Kebetulan juga kunci truk tertancap, sehingga begitu diketahui kabin tidak terkunci mereka dengan mudah membawa kabur truk keluar dari area pelabuhan. Mereka membawa truk menuju ruas tol Manyar, selanjutnya dibawa menuju arah Lamongan dan Tuban,” jelasnya. Namun tindakan para pelaku akhirnya diketahui petugas kepolisian, setelah melihat dan mengembangkan petunjuk dari rekaman CCTV yang terpasang di pintu keluar Pelabuhan Gresik dan juga Tol Manyar. “Sebenarnya mereka itu satu kelompok berjumlah tujuh orang, masih ada empat orang lagi yang masih dalam proses pengejaran. Mohon maaf tidak bisa kami ungkap inisialnya, karena khawatir mereka akan kabur jauh,” tutur Adam.</p>\r\n\r\n<p>Tidak hanya menyisakan sisa komplotan pencurian yang belum tertangkap, Kepolisian Gresik juga belum menemukan badan dari truk trailer yang dicuri. Karena barang bukti yang ditemukan, baru kepala truk beserta sepeda motor Yamaha Vixion dengan nopol S 4642 LZ. “Itu juga yang akan terus kami upayakan untuk diungkap, karena kemarin yang baru ditemukan petugas kepala truk, sementara badan truk belum. Dari pengakuan korban, memang tidak sedang mengangkut muatan apa-apa, tapi mudah-mudahan itu juga berhasil kami ungkap saat pelaku lain ditangkap,” ucapnya. Sementara itu, ada indikasi sindikat berencana menjual hasil truk curian tersebut, dengan cara menjual per bagian dari sparepart-nya di pasar gelap yang ada di Jawa Timur. “Saya sendiri kurang tahu mau diapakan barang itu (truk trailer) nantinya, karena terus terang baru pertama kali ikut. Ini saja sebelum ketangkap baru dibayar Rp1 juta, dan masih kurang dari yang dijanjikan mereka,” kata salah satu tersangka, Bangkit Setiawan. Akibat perbuatannya, para pelaku terancam Pasal 363 KUHP tentang Tindak Pidana Pencurian dengan Pemberatan, dengan ancaman hukuman lima tahun penjara.</p>', '1642194903-736x491.jpg', 3, 'id', 1, '2020-09-07 06:38:41', NULL, NULL),
(10, 'Premium Bonds issuer slashes chance of winning', '<p>National Savings and Investments (NS&I), which issues Premium Bonds, has slashed the interest rates it pays.\r\n\r\nThe dramatic cut will hit the savings of 25 million people who have invested with NS&I, which allows people to lend money to the government.\r\n\r\nIt will also reduce the chances of those who own Premium Bonds from winning any of the monthly prizes on offer, which include a £1m jackpot.\r\n\r\nSavers will soon have a one-in-34,500 chance, against one-in-24,500 now.\r\n\r\nIt is also slashing the number of £100,000 prizes from seven to four and £50,000 prizes from 14 to nine.\r\n\r\nFunding the crisis\r\nAs government spending increased to fund the response to the coronavirus crisis, so did the amount that NS&I was asked to raise for the government.\r\n\r\nIn July, its target was increased from £6bn to £35bn. In the first three months of its financial year to June, NS&I raised £14.5bn and it said demand had been \"similarly high\" in the second quarter, which finishes at the end of this month.\r\n\r\nThe savings scheme said some of its interest rates were above those offered by High Street banks, which caused a surge in demand.\r\n\r\n\"Reducing interest rates is always a difficult decision,\" said NS&I chief executive, Ian Ackerley.\r\n\r\n\"Given successive reductions in the Bank of England base rate in March, and subsequent reductions in interest rates by other providers, several of our products have become \'best buy\' and we have experienced extremely high demand as a consequence,\" he said.\r\n\r\n\"It is important that we strike a balance between the interests of savers, taxpayers and the broader financial services sector; and it is time for NS&I to return to a more normal competitive position for our products.\"\r\n\r\n\r\nMedia captionPremium Bonds numbers generator Ernie through the years\r\nThe changes to Premium Bonds will come in for the December prize draw.\r\n\r\nMeanwhile, interest rates on other products will be lower from 24 November - and they include some steep drops.\r\n\r\nNS&I\'s direct saver will offer just 0.15% interest, down from 1% before. Meanwhile, the rate on its income bonds will fall to 0.01%. It was previously 1.15%.\r\n\r\nThe rate on its investment account will also be 0.01% when the rates change, that\'s down from 0.8%. And the direct ISA will offer 0.1%, compared with the 0.9% savers get at the moment.\r\n\r\nKids will do a bit better, getting 1.5% interest from the junior ISA, although that is still well below the 3.25% they can get now.</p>', '_92168249_gettyimages-81631583.jpg', 2, 'en', 1, '2020-09-07 06:38:41', NULL, NULL),
(11, '<p>Brexit: Hauliers&#39; meeting with Michael Gove &#39;a washout&#39;</p>', '<p>The Road Haulage Association has described its meeting with Michael Gove about post-Brexit arrangements as &quot;a washout&quot;.</p>\r\n\r\n<p>The body said there had been &quot;no clarity&quot; from the senior minister on how border checks will operate when the transition period ends after December.</p>\r\n\r\n<p>Although the UK has left the EU, it has continued following some EU rules during the transition period.</p>\r\n\r\n<p>A Cabinet Office spokesperson said the meeting had been &quot;constructive&quot;.</p>\r\n\r\n<p>After the transition period traders will need to fill in customs declaration forms, with detailed information on what is being imported and exported.</p>\r\n\r\n<p>The haulage industry has expressed concern this could lead to long tailbacks at ports and disruption to supply chains.</p>\r\n\r\n<p>In Kent&nbsp;<a href=\"https://www.bbc.co.uk/news/uk-england-kent-54158100\">a coronavirus testing centre has been closed</a>&nbsp;to make way for a lorry park to accommodate post-Brexit customs checks.</p>\r\n\r\n<p><a href=\"https://www.bbc.co.uk/news/business-54172222\">And earlier this week Logistics UK</a>&nbsp;warned that a new freight management system - designed to reduce delays at ports - will not be ready when the transition period ends.</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.bbc.com/news/uk-england-kent-54158100\">Coronavirus test centre shut to become lorry park</a></li>\r\n	<li><a href=\"https://www.bbc.com/news/uk-54021421\">UK &#39;sleepwalking into disaster&#39; over border plans</a></li>\r\n	<li><a href=\"https://www.bbc.com/news/business-54116606\">UK and Japan in first major post-Brexit trade deal</a></li>\r\n</ul>\r\n\r\n<p>A meeting between the government and stakeholders was arranged to discuss industry concerns but Road Haulage Association chief executive Richard Burnett said that it &quot;fell far short of our expectations&quot;.</p>\r\n\r\n<p>&quot;The mutually effective co-operation we wanted to ensure seamless border crossings just didn&#39;t happen and there is still no clarity over the questions that we have raised,&quot; he said.</p>\r\n\r\n<p>&quot;Although I don&#39;t think we&#39;re quite back at square one, we&#39;re certainly not much further ahead.&quot;</p>\r\n\r\n<p>Chief executive of the Cold Chain Federation Shane Brennan who also attended the meeting said: &quot;There is no point pretending it&#39;s going to be smooth - we are heading for major delays and disruption - systems are not ready, processes are unclear, awareness of what will be required is low across industry</p>\r\n\r\n<p>&quot;We will need calm heads and a willingness from customs, food and security officials (on the U.K. and EU side) to make sensible, pragmatic, decisions, probably throughout 2021 as systems bed down and new ways of working emerge.&quot;</p>\r\n\r\n<p>A Cabinet Office spokesperson described the meeting as &quot;constructive&quot; and said government would &quot;continue to intensify engagement with industry in the weeks ahead so we can hit the ground running on 1 January 2021 and seize new opportunities&quot;.</p>\r\n\r\n<p>&quot;To help businesses prepare, we have launched a major communications campaign in the UK and EU, committed to investing &pound;705m in jobs, infrastructure and technology at the border and provided a &pound;84m support package to boost the capacity of the customs intermediary sector.&quot;</p>\r\n\r\n<p>Meanwhile informal talks aimed at agreeing a UK-EU trade deal are continuing in Brussels this week, ahead of another full-scale negotiation round later this month.</p>\r\n\r\n<p>A UK government spokesperson described the talks as &quot;useful&quot; and said &quot;some limited progress was made&quot; but added that &quot;significant gaps remain in key areas, including fisheries and subsidies&quot;.</p>\r\n\r\n<p>However the EU has warned that trade talks could be suspended unless the UK removes measures from its Internal Market Bill which could override parts of the original divorce deal.</p>', '1600738594.jpg', 5, 'en', 1, '2020-09-21 17:38:42', '2020-09-21 17:38:42', NULL),
(12, '<p>&#39;Nearly two-thirds&#39; of workers commuting again, says ONS</p>', '<p>Nearly two in three workers are now commuting again, as some employers ask their staff to return to offices during the pandemic.</p>\r\n\r\n<p>The Office for National Statistics (ONS) said that 62% of adult workers reported travelling to work last week.</p>\r\n\r\n<p>That compares with 36% in late May, soon after the ONS began compiling the figures during lockdown.</p>\r\n\r\n<p>The government has been encouraging workers to return to offices to help revive city centres.</p>\r\n\r\n<p>While the proportion of people travelling to work has increased, the ONS said 10% of the workforce remained on furlough leave.</p>\r\n\r\n<p>It added that 20% of workers continued to do so exclusively from home.</p>\r\n\r\n<p>The commuter data includes people who may be travelling to work exclusively, or they may be doing a mixture of commuting and working from home, the ONS said.</p>', '1600738805.jpg', 5, 'en', 1, '2020-09-21 17:44:44', '2020-09-21 17:44:44', NULL),
(14, '<p>PEMUATAN CCSP</p>', '<p>27 Oktober 2020</p>\r\n\r\n<p>PT. BAHTERA SETIA&nbsp; GROUP selaku perusahan yang bergeraak di bidang Jasa&nbsp; Bongkar Muat PBM sedang melaksanakan tugas yaitu pemuatan CORRUGATE CONCRETE SHEET PILE (CCSP)&nbsp; , yang di muat di pelabuhan GRESIK, Jumlah muatan CCSP kali ini mencapai 880 batang.&nbsp;</p>\r\n\r\n<p>PT. BAHTERA SETIA GROUP menyediakan armada TONGKANG &quot; BUR 6 &quot; dan Armada &quot; TUG BOAD &quot; untuk pengiriman CCSP dengan Tujuan BONTANG - KALIMANTAN TIMUR.</p>', '1603766961.jpeg', 5, 'id', 48, '2020-10-26 19:49:21', '2020-10-26 19:49:21', NULL),
(15, '<h3>Utang Indonesia Naik Terus tapi Disebut Tak Efektif, Kenapa?</h3>', '<p><strong>Jakarta</strong>&nbsp;-&nbsp;</p>\r\n\r\n<p>Ekonom senior Institute for Development of Economics and Finance (Indef) Didik Rachbini menilai meningkatnya&nbsp;<a href=\"https://www.detik.com/tag/utang-pemerintah\">utang pemerintah</a>&nbsp;kurang efektif untuk mendorong aktivitas ekonomi.</p>\r\n\r\n<p>Didik menjelaskan selama beberapa tahun terakhir pemerintah mengklaim meningkatnya jumlah utang untuk membangun infrastruktur. Namun yang tercermin justru belanja modal mengalami penurunan.</p>\r\n\r\n<p>&quot;Beberapa tahun terakhir peningkatan utang diklaim dalam rangka pembangunan infrastruktur. Namun belanja modal relatif menurun proporsinya,&quot; kata dia dikutip Jumat (6/11/2020).</p>\r\n\r\n<p>Berdasarkan bahan paparan Didik, belanja modal sebesar Rp 169,474 triliun di 2016, naik jadi Rp 208,656 triliun di 2017, dan turun jadi Rp 184,127 triliun di 2018, kemudian turun jadi Rp 177,841 triliun di 2019 dan turun lagi jadi Rp 137,383 triliun dalam&nbsp;<em>outlook</em>&nbsp;2020.</p>\r\n\r\n<p>&quot;Di samping itu, belanja bantuan sosial juga ikut meningkat,&quot; sebutnya.</p>\r\n\r\n<p>Berdasarkan paparan data dari Didik, tren belanja bansos memang terus meningkat, dari Rp 49,613 triliun di 2016 menjadi Rp 112,480 triliun di 2019, dan Rp 174,517 pada&nbsp;<em>outlook</em>&nbsp;2020.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Trio Hamdani - detikFinance</p>\r\n\r\n<p>Jumat, 06 Nov 2020 09:41 WIB</p>', '1604631849.jpg', 1, 'id', 1, '2020-12-21 19:40:39', '2020-12-21 19:40:39', NULL),
(16, '<h3>Jelang Habib Rizieq Landing, Petinggi FPI Berdatangan ke Bandara Soetta</h3>', '<p>Para petinggi FPI merapat ke Bandara Soetta menjelang Habib Rizieq landing. (Luqman Nurhadi dan Adhyasta Dirgantara/detikcom)</p>\r\n\r\n<p><strong>Jakarta</strong>&nbsp;-&nbsp;</p>\r\n\r\n<p>Menjelang kepulangan&nbsp;<a href=\"https://www.detik.com/tag/habib-rizieq\">Habib Rizieq Syihab</a>, para petinggi Front Pembela Islam atau FPI berdatangan ke Bandara Soekarno-Hatta. Kedatangan petinggi FPI disambut meriah massa penjemput Habib Rizieq.</p>\r\n\r\n<p>Pantauan di Terminal 3 Bandara Soetta, Cengkareng, Selasa (10/11/2020), sejumlah petinggi FPI tiba di lokasi pukul 07.42 WIB. Mereka adalah Ketum FPI Sabri Lubis dan Sekum FPI Munarman.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Jakarta</strong>&nbsp;-&nbsp;</p>\r\n\r\n<p>Massa memadati&nbsp;<a href=\"https://www.detik.com/tag/null\">Gang Petamburan 3</a>, Jakarta, demi menyambut kepulangan pemimpin Front Pembela Islam (FPI),&nbsp;<a href=\"https://www.detik.com/tag/habib-rizieq\">Habib Rizieq Syihab (HRS)</a>. Dari anak kecil hingga orang dewasa memenuhi gang tersebut.</p>\r\n\r\n<p>Pantauan&nbsp;<strong>detikcom</strong>&nbsp;di Gang Petamburan, Jakarta, pukul 07.30 WIB, terlihat massa mengenakan pakaian serba putih. Beberapa orang ada yang duduk-duduk di salah satu masjid di Jalan Petamburan III.</p>\r\n\r\n<p>Tampak pedagang poster Habib Rizieq juga memenuhi jalan. Sejumlah laskar FPI juga terlihat berjaga di sekitar lokasi.Karangan bunga, poster, hingga baliho yang berisi pesan menyambut kedatangan Habib Rizieq bertebaran di mana-mana. Beberapa poster ada yang ditempel di gang, ada pula yang dipasang di warung kelontong.</p>', '1604975118.jpeg', 3, 'id', 1, '2020-12-21 19:40:31', '2020-12-21 19:40:31', NULL),
(17, '<h3>Kabar Baik! Vaksin COVID-19 Sinovac Picu Respons Imun 4 Pekan Usai Suntik</h3>', '<p><strong>Jakarta</strong>&nbsp;-&nbsp;</p>\r\n\r\n<p>Perkembangan&nbsp;<a href=\"https://www.detik.com/tag/vaksin-covid_19\">vaksin COVID-19</a>&nbsp;kembali menyampaikan kabar baik. Kali ini, hasil awal uji klinis vaksin COVID-19&nbsp;<a href=\"https://www.detik.com/tag/sinovac\">Sinovac&nbsp;</a>asal China, CoronaVac, berhasil memicu respons imun yang cepat.</p>\r\n\r\n<p>Namun, catatannya tingkat antibodi yang dihasilkan lebih rendah daripada antibodi dimiliki seseorang pasca pulih dari COVID-19. Dikutip dari Reuters, hasil awal uji coba vaksin COVID-19 ini disampaikan pada Rabu.</p>\r\n\r\n<p>Para peneliti menyebut hasil awal uji klinis vaksin COVID-19 tersebut dapat menunjukkan perlindungan yang cukup. Sementara itu, CoronaVac dan empat vaksin eksperimental lainnya yang dikembangkan di China saat ini sedang menjalani uji coba tahap akhir untuk menentukan apakah benar efektif mencegah COVID-19.</p>\r\n\r\n<p>Temuan Sinovac dimuat dalam makalah peer reviewed di jurnal medis The Lancet Infectious Diseases, berdasarkan hasil uji klinis Fase I dan Fase II vaksin COVID-19 di China yang melibatkan lebih dari 700 peserta.</p>\r\n\r\n<p>&quot;Temuan kami menunjukkan bahwa CoronaVac mampu memicu respons antibodi yang cepat dalam empat minggu setelah imunisasi dengan memberikan dua dosis vaksin pada interval 14 hari,&quot; Zhu Fengcai, salah satu penulis makalah tersebut, mengatakan.</p>\r\n\r\n<p>&quot;Kami yakin ini membuat vaksin cocok untuk penggunaan darurat selama pandemi,&quot; kata Zhu dalam sebuah pernyataan.</p>', '1605667773.jpeg', 7, 'id', 1, '2020-12-21 19:40:16', '2020-12-21 19:40:16', NULL),
(18, '<h1><strong>BPBD Jatim soal Korban-Kerusakan Banjir Bandang di Kota Batu</strong><br />\r\n<br />\r\n&nbsp;</h1>', '<p>Surabaya - Banjir bandang di Kota Batu pada Kamis (4/11) menyebabkan 7 warga meninggal dunia. Selain korban jiwa, 35 rumah dinyatakan rusak berat akibat banjir bandang.<br />\r\n&quot;Data hingga Minggu (7/11) pukul 14.00 WIB, korban meninggal ada 7 orang, tim Basarnas juga telah menghentikan proses pencarian,&quot; ujar Kalaksa BPBD Jatim Budi Santosa dalam keterangannya, Minggu (7/11/2021).<br />\r\n<br />\r\nSelain korban meninggal dunia, tim relawan juga berhasil menemukan 6 warga yang sempat hanyut. Ke-6 warga itu dinyatakan selamat. &quot;Seluruh warga yang hanyut telah ditemukan,&quot; imbuhnya.</p>\r\n\r\n<p>Data dari BPBD Jatim, ada 89 kartu keluarga (KK) yang terdampak banjir bandang Batu. Kemudian 35 unit rumah rusak parah, 33 unit rumah terendam lumpur.<br />\r\n<br />\r\nKemudian, ada 7 unit mobil yang rusak, 73 unit sepeda motor rusak, 30 unit sepeda rusak. Lalu 10 kandang ternak rusak, serta 107 hewan ternak mati. Juga masih ada sejumlah lahan pertanian yang rusak akibat hanyut terkena banjir bandang. Saat ini, tim tengah melakukan pendataan.<br />\r\n<br />\r\n&quot;Untuk update kerugian, akan kita update terus. Tim BPBD Jatim bersama kabupaten/kota masih terus memantau, siaga di Posko Batu, dan menghitung dampak banjir bandang ini,&quot; tandasnya.<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\nBaca artikel detiknews, &quot;Data Lengkap BPBD Jatim soal Korban-Kerusakan Banjir Bandang di Kota Batu&quot; selengkapnya&nbsp;<a href=\"https://news.detik.com/berita-jawa-timur/d-5801217/data-lengkap-bpbd-jatim-soal-korban-kerusakan-banjir-bandang-di-kota-batu\">https://news.detik.com/berita-jawa-timur/d-5801217/data-lengkap-bpbd-jatim-soal-korban-kerusakan-banjir-bandang-di-kota-batu</a>.<br />\r\n<br />\r\nDownload Apps Detikcom Sekarang https://apps.detik.com/detik/</p>', '1636339222.jpeg', 1, 'id', 48, '2021-11-07 19:40:22', '2021-11-07 19:40:22', NULL),
(19, '<h1><strong>Inflasi China Gila-gilaan, Indonesia Bisa Kena Getahnya?</strong><br />\r\n<br />\r\n&nbsp;</h1>', '<p>Inflasi China lagi gila-gilaan, tertinggi sejak 26 tahun lalu. Inflasi tersebut terus mengikat selama empat bulan terakhir. Badan Statistik Nasional China mengungkapkan, data terbaru inflasi di Oktober 2021 terlihat dari Indeks Harga Produsen atau Producer Price Index (PPI) melonjak 13,5% pada Oktober.<br />\r\n&quot;Pada bulan Oktober, kenaikan PPI meluas karena kombinasi faktor global yang diimpor dan ketatnya pasokan energi dan bahan baku domestik utama,&quot; kata ahli statistik senior NBS Dong Lijuan dalam sebuah pernyataan, dikutip dari AFP, Jumat (12/11/2021).<br />\r\nDong menambahkan, 36 dari 40 sektor industri yang disurvei mengalami kenaikan harga termasuk lonjakan harga pertambangan batubara dan ekstraksi minyak serta gas alam.</p>\r\n\r\n<p>Selain itu, Indeks Harga Konsumen atau Consumer Price Index (CPI), ukuran utama inflasi ritel, meningkat 1,5% pada Oktober atau naik 0,7% pada September. &quot;Ini karena efek gabungan dari cuaca yang tidak biasa, ketidaksesuaian permintaan dan pasokan produk tertentu, serta kenaikan biaya modal,&quot; kata Dong.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Apa Dampaknya bagi Indonesia?<br />\r\nDirektur Center of Economic and Law Studeis Bhima Yudhistira menyatakan, inflasi di China dapat berpengaruh pada ekonomi Indonesia dalam jangka pendek. Apalagi, tak jarang jual beli barang di Indonesia merupakan hasil impor asal China.<br />\r\n<br />\r\n&quot;Inflasi di China bisa memiliki transmisi ke ekonomi di Indonesia dalam jangka pendek. Mahalnya harga kebutuhan pokok, bahan baku dan harga energi akan mempengaruhi harga jual barang-barang impor asal China,&quot; kata Bhima kepada detikcom.<br />\r\n<br />\r\nDia mengatakan, sedikit saja perubahan harga di tingkat produsen China maka harga yang akan sampai di tingkat konsumen Indonesia otomatis akan lebih mahal.<br />\r\n<br />\r\n&quot;Barang barang elektronik, pakaian jadi dan makanan jadi salah satu yang sensitif terhadap gangguan biaya produksi di China. Itu baru dari sisi barang impor ya,&quot; ujarnya.<br />\r\n<br />\r\nBhima juga mengatakan, dampak yang lebih buruk bisa terjadi jika inflasi China mempengaruhi harga komoditas di Indonesia. Dia menyebut beberapa komoditas seperti Gandum dan Jagung.<br />\r\n<br />\r\n&quot;Misalnya harga gandum dilansir dari Tradingeconomics terpantau naik 9,5% dibanding bulan lalu. Disusul jagung yang naik 8,5% pada periode yang sama bisa mempengaruhi harga pakan ternak. Masalah bertambah kompleks karena ada ancaman La Nina yang membuat produksi pangan dalam negeri menurun,&quot; jelasnya.<br />\r\n<br />\r\nAtas penjelasan tersebut, Bhima meminta agar pemerintah memastikan stok pangan dalam negeri tercukupi. Sedangkan di sisi pengusaha, ia menyarankan untuk mulai mengamankan bahan baku atau mencari alternatif lain.<br />\r\n<br />\r\n&quot;Jadi pemerintah harus siap sedia ya amankan stok pangan. Untuk pengusaha diminta amankan bahan baku atau cari alternatif yang lebih murah,&quot; pungkasnya.<br />\r\n<br />\r\n<strong>DETIK.COM</strong></p>', '1636696536.jpg', 1, 'id', 48, '2021-11-11 22:55:36', '2021-11-11 22:55:36', NULL),
(20, '<h1><strong>Saat Batu Bara Drop, Emiten Tambang RMK Energy IPO Rp 201 M</strong></h1>', '<p><strong>Jakarta, CNBC Indonesia -</strong>&nbsp;Perusahaan yang bergerak di bisnis pertambangan batu bara, PT RMK Energy, berencana melantai di Bursa Efek Indonesia (BEI) dengan mekanisme penawaran umum saham perdana (initial public offering/IPO).</p>\r\n\r\n<p>Perseroan akan menawarkan sebanyak-banyaknya 875 juta saham baru atau setara 20% dari modal yang ditempatkan dan disetor dengan nilai nominal Rp 100 per saham.</p>\r\n\r\n<p>Adapun, kisaran harga penawaran umum di rentang Rp 160 per saham sampai dengan Rp 230 per saham.</p>\r\n\r\n<p>&quot;Jumlah penawaran umum perdana saham ini adalah sebanyak-banyaknya Rp 201,25 miliar,&quot; ungkap manajemen RMK, dalam prospektus</p>\r\n\r\n<p>Rencananya, dana yang diperoleh dari IPO ini akan digunakan sebesar Rp 67,87 miliar untuk melunasi sebagian pembayaran upgrade conveyor line 2 dari single line menjadi double line, termasuk pembelian dan perakitan stacker conveyor kepada PT Rantaimulia Kencana dalam rangka mendukung kegiatan usaha utama perseroan.</p>\r\n\r\n<p>Lalu, senilai Rp 50 miliar akan digunakan untuk pelunasan pokok utang kepada PT Bintang Timur Kapital.</p>\r\n\r\n<p>Sisanya, akan digunakan untuk modal kerja perseroan terutama untuk pembelian bahan bakar, pelumas, suku cadang, dan pemeliharaan.</p>\r\n\r\n<p>Dalam IPO ini, perseroan menunjuk PT Indo Capital Sekuritas sebagai penjamin emisi efek.</p>\r\n\r\n<p>Masa penawaran awal akan berlangsung pada 10-15 November 2021. Kemudian, perkiraan tanggal efektif pada 26 November 2021.</p>\r\n\r\n<p>Lalu, masa penawaran umum akan berlangsung pada 30 November sampai dengan 3 Desember 2021. Tanggal penjatahan saham diperkirakan pada 3 Desember 2021 dan pencatatan saham di BEI pada 7 Desember 2021 mendatang.</p>', '1636697396.jpg', 2, 'id', 48, '2021-11-11 23:09:56', '2021-11-11 23:09:56', NULL),
(21, '<h1><strong>HYPOKALEMIA</strong></h1>', '<p>KOMPAS.com - Hipokalemia berarti kadar kalium dalam darah lebih rendah dari yang seharusnya. Kalium berperan dalam membantu saraf mengirim sinyal, membuat otot bergerak, dan memberi sel nutrisi. Selain itu, kalium juga penting dalam sel-sel di hati dan menjaga tekanan darah agar tetap stabil.Tingkat normal kalium adalah 3,6 hingga 5,2 milimol per liter (mmol/L). Hipokalemia ringan umumnya tidak menunjukkan gejala. Gejala biasanya muncul jika kadar kalium memang sangat rendah.Jika mengalami gejala berikut, bisa jadi seseorang mengalami hipokalemia: kelemahan kelelahan sembelit kram otot jantung berdebar (palpitasi). Kadar kalium dianggap rendah jika berada di bawah 3,6. Jika mencapai di bawah 2,5 mmol/L, kondisi ini bisa dibilang mengancam jiwa. Gejala yang dapat timbul, yaitu:kelumpuhan gagal napas kerusakan jaringan otot ileus (usus malas).<br />\r\nDalam kasus yang lebih parah, ritme jantung abnormal dapat terjadi. Khususnya bagi penderita yang mengkonsumsi obat digitalis atau memiliki kondisi irama jantung tidak teratur, seperti: fibriliasi atrium atau ventrikel takikardia (detak jantung terlalu cepat) atau bradikardia (detak jantung terlalu lambat) detak jantung prematur. Gejala lain dapat termasuk: kehilangan napsu makan<br />\r\n<br />\r\nArtikel ini telah tayang di&nbsp;<a href=\"https://www.kompas.com/\">Kompas.com</a>&nbsp;dengan judul &quot;Hipokalemia&quot;, Klik untuk baca:&nbsp;<a href=\"https://health.kompas.com/penyakit/read/2021/11/14/170000968/hipokalemia\">https://health.kompas.com/penyakit/read/2021/11/14/170000968/hipokalemia</a>.<br />\r\nPenulis : Xena Olivia<br />\r\nEditor : Resa Eka Ayu Sartika<br />\r\n<br />\r\nDownload aplikasi&nbsp;<a href=\"https://www.kompas.com/\">Kompas.com</a>&nbsp;untuk akses berita lebih mudah dan cepat:<br />\r\nAndroid:&nbsp;<a href=\"https://bit.ly/3g85pkA\">https://bit.ly/3g85pkA</a><br />\r\niOS:&nbsp;<a href=\"https://apple.co/3hXWJ0L\">https://apple.co/3hXWJ0L</a></p>', '1636941984.jpg', 7, 'id', 48, '2021-11-14 19:06:24', '2021-11-14 19:06:24', NULL),
(22, '<p>IHSG Diprediksi Lanjutkan Pelemahan</p>', '<p>Jakarta - IHSG ditutup melemah. IHSG ditutup di level 6,616.02 (-0.52%). IHSG ditutup melemah meskipun neraca perdagangan mencatatkan rekor baru surplus US$ 5.74 B. Pergerakan dibayangi oleh kekhawatiran akan dampak dari data inflasi dan Tapering Amerika Serikat.<br />\r\nBursa Amerika Serikat ditutup Melemah. Dow Jones ditutup 36,087.45 (-0.04%), NASDAQ ditutup 15,853.80 (-0.05%), S&amp;P 500 ditutup 4,682.81 (-0.00%). Wall Street ditutup turun tipis pada awal pekan ini karena kenaikan imbal hasil Treasury mengurangi selera untuk saham teknologi. Sedangkan harga saham Boeing menguat karena tanda-tanda permintaan untuk pesawat kargonya.</p>\r\n\r\n<p>Saham bank yang diuntungkan dari kenaikan imbal hasil, meningkat karena investor memposisikan diri untuk efek potensial dari pengurangan pembelian aset besar-besaran oleh Federal Reserve. Selain itu ada efek menjelang jadwal penjualan obligasi baru 20 tahun di akhir minggu ini. Data penjualan ritel untuk Oktober juga akan dirilis pada hari Selasa. Data ritel ini akan mengungkapkan tanda-tanda dampak inflasi terhadap belanja konsumen. IHSG diprediksi melemah</p>\r\n\r\n<p>Resistance 2 : 6,698</p>\r\n\r\n<p>Resistance 1 : 6,657</p>\r\n\r\n<p>Support 1 : 6,592</p>\r\n\r\n<p>Support 2 : 6,568</p>\r\n\r\n<p>IHSG diprediksi melemah. Secara teknikal candlestick membentuk long black body dengan volume yang cukup tinggi dan stochastic yang membentuk deadcross diperkirakan pergerakan akan cenderung melemah. Investor akan terus mencermati inflasi Amerika Serikat serta rencana tapering. Investor juga akan cenderung lebih konservatif jelang penetapan suku bunga oleh Bank Indonesia.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;https://apps.detik.com/detik/</p>', '1637116943.jpeg', 2, 'id', 50, '2021-11-16 19:42:23', '2021-11-16 19:42:23', NULL),
(23, '<h1><strong>Update Covid-19: Kasus Baru Bertambah, Keterisian RS di Sejumlah Daerah Meningkat</strong></h1>', '<p><br />\r\nJAKARTA, KOMPAS.com - Kasus Covid-19 di Indonesia dalam dua hari terakhir dilaporkan mengalami peningkatan. Pada Selasa (16/11/2021), Satuan Tugas (Satgas) Penanganan Covid-19 melaporkan penambahan kasus positif sebanyak 347 pasien. Sehingga, secara kumulatif total kasus Covid-19 di Indonesia sejak 2 Maret 2020 menjadi 4.251.423 kasus. Sehari sebelumnya yaitu pada Senin (15/11/2021), kasus positif harian bertambah sebesar 221. Dengan demikian, ada penambahan sebesar 126 orang positif Covid-19 dari Senin hingga Selasa.<br />\r\n<br />\r\nSementara itu, Satgas Covid-19 melaporkan kasus sembuh Covid-19 pada Selasa bertambah 515 kasus. Sehingga, jumlah kumulatif kini menjadi 4.099.399 kasus. Namun, Satgas Covid-19 juga mengungkapkan adanya pertambahan kasus kematian mencapai 15 orang di hari yang sama. Maka, total kasus kematian yaitu 143.658 jiwa.<br />\r\n<br />\r\nJumlah kasus aktif tercatat mengalami penurunan sebesar 183, sehingga kini hanya ada 8.339 kasus aktif. Vaksinasi Berdasarkan situs Kementerian Kesehatan (Kemenkes), hingga Selasa pukul 18.00 WIB, ada 85.370.684 atau 40,99 persen masyarakat telah menerima vaksinasi Covid-19 dosis kedua. Diketahui, pemerintah menargetkan 208.265.720 orang yang menjadi sasaran vaksinasi Covid-19.<br />\r\n<br />\r\nKemudian, masyarakat yang mendapatkan suntikan vaksin dosis pertama sebanyak 131.292.871 orang atau 63,04 persen.<br />\r\n<br />\r\n&nbsp;</p>', '1637118167.jpg', 7, 'id', 48, '2021-11-16 20:02:47', '2021-11-16 20:02:47', NULL),
(24, '<h1><strong>Polisi Segera Panggil 2 Notaris di Kasus Mafia Tanah Rp 17 M Nirina Zubir</strong><br />\r\n<br />\r\n&nbsp;</h1>', '<p>Jakarta - Tiga orang notaris terlibat dalam kasus mafia tanah Rp 17 miliar dengan korban artis Nirina Zubir. Dalam waktu dekat, polisi akan memanggil dua orang di antaranya.<br />\r\nKasat Harda Ditreskrimum Polda Metro Jaya AKBP Petrus Silalahi menjelaskan alasan dua notaris tersebut tidak ditahan. Petrus mengatakan bahwa sebelumnya dua notaris itu sudah dipanggil, akan tetapi tidak datang menghadiri panggilan polisi.<br />\r\n<br />\r\n&quot;Kami sudah melakukan pemanggilan terhadap kedua notaris tersebut, akan tetapi saat ini yang bersangkutan tidak dapat hadir dengan alasan yang dapat kami terima,&quot; kata Petrus saat dihubungi detikcom, Kamis (18/11/2021).<br />\r\n<br />\r\nPetrus tidak menjelaskan lebih lanjut alasan apa sehingga kedua notaris tersebut absen panggilan polisi. Namun, Petrus mengatakan bahwa keduanya meminta pemeriksaan dijadwal ulang.<br />\r\n<br />\r\n&quot;Tentu sudah kita jadwalkan (pemeriksaan). Kemarin seharusnya bersama-sama, namun saat itu mereka ajukan pengunduran pemanggilan, kemudian kita jadwalkan kembali, secepatnya,&quot; jelas Petrus.<br />\r\nKetiga notaris tersebut berstatus sebagai tersangka. Namun, dari tiga notaris itu baru satu orang yang ditahan.<br />\r\n<br />\r\nKetiga notaris itu adalah Faridah, Ina Rosiana, dan Erwin Riduan. Dua notaris bernama Ina Rosiana dan Erwin Riduan telah ditetapkan sebagai tersangka, tetapi tidak ditahan.<br />\r\n<br />\r\nTotal ada 5 orang yang sudah ditetapkan sebagai tersangka di kasus mafia tanah tersebut. Mantan asisten rumah tangga (ART) Nirina Zubir bernama Riri Khasmita dan suaminya, Edrianto telah ditetapkan sebagai tersangka dan ditahan polisi.<br />\r\n<br />\r\n&quot;Jadi sudah ada lima orang ditetapkan sebagai tersangka yang dilaporkan di mana korbannya Nirina Zubir,&quot; kata Petrus saat dihubungi detikcom, Rabu (17/11).<br />\r\n<br />\r\nPara tersangka ini dijerat atas dugaan tindak pidana pemalsuan surat dan atau pemalsuan akta otentik, dan atau menyuruh menempatkan keterangan palsu ke dalam akta oentik dan atau penggelapan dan atau pencucian uang sebagaimana dimaksud dalam Pasal 263 KUHP dan atau Pasal 264 KUHP dan atau Pasal 266 KUHP dan atau Pasal 372 KUHP dan atau Pasal 3,4,5 UU RI No.8 tahun 2010 tentang pencegahan dan Pembrantasan Tindak Pidana Pencucian Uang.</p>\r\n\r\n<p><br />\r\n<strong>Tim detikcom - detikNews</strong><br />\r\n<em>Kamis, 18 Nov 2021 08:43 WIB</em><br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '1637200586.jpeg', 1, 'id', 48, '2021-11-17 18:56:26', '2021-11-17 18:56:26', NULL),
(25, '<h1><strong>Indonesia Masters: Lawan Yuta/Arisa, Hafiz/Gloria Siap Capek!</strong><br />\r\n<br />\r\n&nbsp;</h1>', '<p>Hafiz Faizal/Gloria Emanuelle Widjaja yakin kesempatan mereka terbuka di perempatfinal Indonesia Masters 2021. Mereka siap habis-habisan lawan ungggulan ketiga.<br />\r\nHafiz Faizal/Gloria Emanuelle Widjaja akan menghadapi ganda campuran Jepang Yuta Watanabe/Arisa Higashino pada perempatfinal Indonesia Masters 2021, Jumat (19/11/2021) di Bali International Convention Center. Hafiz/Gloria merupakan satu-satunya pasangan Indonesia tersisa di ganda campuran.<br />\r\n<br />\r\nMelawan Yuta/Arisa jelas tak akan mudah buat Hafiz/Gloria. Mereka masih kalah head to head dengan perbandingan 1:4 melawan pasangan Jepang tersebut. Hafiz/Gloria sadar apa yang harus mereka lakukan demi peluang ke semifinal.<br />\r\n<br />\r\n&quot;Kalau ketemu lawan yang di atas kita, kita anggap Yuta itu di atas kita, jadi kita enggak boleh lengah sedikitpun, enggak boleh melakukan kesalahan sedikitpun karena itu bisa fatal. Otomatis kita harus jaga fokus kita di lapangan,&quot; kata Hafiz.<br />\r\n<br />\r\n&quot;Pokoknya mau lawan siapapun, mau di bawah kita, mau junior, mau di atas kita, enggak boleh lengah. Harus siap terus dalam kondisi apapun,&quot; timpal Gloria.<br />\r\n<br />\r\nBaca artikel detiksport, &quot;Indonesia Masters: Lawan Yuta/Arisa, Hafiz/Gloria Siap Capek!&quot; selengkapnya&nbsp;<a href=\"https://sport.detik.com/raket/d-5817798/indonesia-masters-lawan-yutaarisa-hafizgloria-siap-capek\">https://sport.detik.com/raket/d-5817798/indonesia-masters-lawan-yutaarisa-hafizgloria-siap-capek</a>. Hafiz percaya kesempatan terbuka, terlebih dengan situasi dan kondisi lapangan. Para pemain di Indonesia Masters 2021 menyebut shuttlecock di turnamen kali ini berjalan cukup pelan, sehingga tak bisa buru-buru mematikan lawan.<br />\r\n<br />\r\nItu artinya, para pemain juga mesti siap beradu rally yang menguras tenaga.<br />\r\n<br />\r\n&quot;Dengan lapangan dan bola seperti ini, siapapun punya kesempatan buat menang. Yang penting di lapangan, siapa yang lebih siap, mau capek, saya yakin bisa menang kalau bisa gitu, kemauannya harus tinggi. Enggak mungkin kalau kita enggak ada kemauan tapi mau menang, enggak mungkin,&quot; sambung Hafiz.<br />\r\n<br />\r\n&quot;Kemauan harus tinggi, masih ada kesempatan, kesempatannya besar. Kurang lebih mereka juga pasti capek lawan kita, karena kita enggak bisa matiin bola, mereka juga enggak bisa matiin bola, udah kuat-kuatan aja,&quot; tandasnya.<br />\r\n<br />\r\nIndonesia hanya punya empat wakil tersisa di perempatfinal Indonesia Masters 2021. Selain Hafiz/Gloria, ada Marcus Fernaldi Gideon/Kevin Sanjaya Sukamuljo yang akan bertemu juniornya, Pramudya Kusumawardana/Yeremia Erich Rambitan, dan ganda putri Greysia Polii/Apriyani Rahayu.</p>\r\n\r\n<p><br />\r\n<strong>Rifqi Ardita Widianto - Sport</strong><br />\r\n<strong>Jumat, 19 Nov 2021 08:54 WIB</strong><br />\r\n&nbsp;</p>', '1637287565.jpeg', 6, 'id', 48, '2021-11-18 19:06:05', '2021-11-18 19:06:05', NULL);
INSERT INTO `news` (`id`, `title`, `text`, `img_title`, `news_category_id`, `location`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(26, '<h1><strong>Rupiah Loyo ke Rp14.264 per Dolar AS di Awal Pekan</strong></h1>', '<p>Jakarta, CNN Indonesia -- Nilai tukar rupiah berada di level Rp14.264 per dolar AS&nbsp;pada perdagangan pasar spot Senin (22/11) pagi. Posisi ini melemah 30,5 poin atau 0,21 persen dari Rp14.232 per dolar AS pada perdagangan sebelumnya.<br />\r\nDi Asia, mayoritas mata uang asia melemah di hadapan dolar AS. Tercatat, peso Filipina melemah 0,56 persen, ringgit Malaysia melemah 0,1 persen, dan baht Thailand melemah 0,1 persen.<br />\r\n<br />\r\nKemudian, won Korea Selatan melemah 0,18 persen dari dolar AS, dolar Singapura melemah 0,03 persen, dolar Hong Kong bergerak stagnan, yen Jepang melemah 0,16 persen, dan yuan China melemah 0,02 persen.</p>\r\n\r\n<p>Begitu juga dengan mayoritas mata uang di negara maju yang terpantau melemah terhadap dolar AS. Rinciannya, euro Eropa melemah 0,11 persen, dolar Australia bergerak stagnan, dan poundsterling Inggris melemah 0,12 persen.<br />\r\n<br />\r\nLalu, franc Swiss melemah 0,18 persen dan dolar Kanada melemah 0,07 persen.<br />\r\n<br />\r\nPengamat Pasar Uang Ariston Tjendra memprediksi nilai tukar rupiah melemah di hadapan dolar AS hari ini. Pasalnya, The Fed akan mempercepat kebijakan tapering.<br />\r\n<br />\r\nTapering biasanya akan mendorong penguatan dolar AS. Dengan demikian, mayoritas mata uang akan melemah terhadap dolar AS.</p>\r\n\r\n<p>&quot;Mempercepat proses tapering akan mempercepat kenaikan suku bunga acuan AS. Hal ini mendukung penguatan dollar AS,&quot; papar Ariston kepada CNNIndonesia.com.<br />\r\n<br />\r\nSelain itu, kenaikan kasus covid-19 di Eropa yang memicu lockdown penuh di Austria juga memicu pelaku pasar mengalihkan investasinya ke instrumen berisiko rendah.<br />\r\n<br />\r\n&quot;Hari ini potensi pelemahan (rupiah) ke arah Rp14.300 per dolar AS dengan support di kisaran Rp14.200 per dolar AS,&quot; pungkas Ariston.<br />\r\n<br />\r\n<em><strong>CNN Indonesia<br />\r\nSenin, 22 Nov 2021 09:14 WIB</strong></em><br />\r\n&nbsp;</p>', '1637548060.jpg', 1, 'id', 48, '2021-11-21 19:27:40', '2021-11-21 19:27:40', NULL),
(27, '<h1><strong>&#39;Kapok&#39; dengan Varian Delta, Pakar Beberkan Cara Mencegah Mutasi Varian Corona</strong></h1>', '<p>Jakarta - Pakar menyebut vaksinasi COVID-19 anak-anak berperan mencegah pembentukan mutasi atau varian baru Corona. Bagaimana penjelasannya?<br />\r\nPakar menyebut vaksinasi COVID-19 pada anak-anak salah satunya berfungsi mencegah pembentukan mutasi atau varian baru Corona. Mengingat, varian virus Corona yang berkembang, misalnya varian Delta, disebut-sebut lebih berbahaya. Bagaimana penjelasannya?<br />\r\n<br />\r\nVaksinasi COVID-19 pada anak-anak berfungsi mengurangi penyebaran yang sifatnya &#39;diam-diam&#39; lantaran sebagian besar kasus tidak bergejala, atau setidaknya hanya bergejala ringan. Ketika virus menyebar tanpa terlihat, ilmuwan meyakini, virus tersebut tak akan mereda. Semakin banyak orang terkena, semakin besar kemungkinan varian baru meningkat. Ahli virologi di University of Wisconsin-Madiso, David O&#39;Connor, mengibaratkan setiap kasus infeksi COVID-19 dengan &#39;lotere&#39;. Di mana ada kasus infeksi, di sana ada peluang untuk virus berkembang menjadi lebih berbahaya.<br />\r\n<br />\r\n&quot;Semakin sedikit orang yang terinfeksi, semakin sedikit tiket lotre yang dimilikinya dan semakin baik kita semua dalam hal menghasilkan varian,&quot; katanya, dikutip dari AP News, Selasa (23/11/2021). Ia juga menyinggung, varian lebih berpotensi berkembang pada orang dengan kekebalan yang lemah. Di lain sisi, ada juga sejumlah peneliti tidak setuju perihal anak-anak telah memengaruhi jalannya pandemi. Penelitian awal menyebut, anak-anak tidak berkontribusi besar terhadap penyebaran virus. Namun beberapa ahli menyebut, anak-anak memainkan peran penting tahun ini dalam penyebaran varian Corona paling menular, seperti varian Delta. Hingga kini, varian Delta masih mendominasi kasus COVID-19 Amerika Serikat (AS) dengan jumlah lebih dari 99 persen dari spesimen virus Corona yang dianalisis.<br />\r\n<br />\r\nAhli penyakit menular di Universitas Johns Hopkins, Dr Stuart Campbell Ray, menyebut varian Delta mungkin secara intrinsik lebih menular. Kemungkinan lain, virus menghindar dari sebagian perlindungan vaksin atau kekebalan dari infeksi sebelumnya.<br />\r\n<br />\r\n&quot;Mungkin kombinasi dari hal-hal itu,&quot; katanya.<br />\r\n<br />\r\n&quot;Tetapi ada juga bukti yang sangat bagus dan berkembang bahwa delta lebih cocok, artinya dapat tumbuh ke tingkat yang lebih tinggi lebih cepat daripada varian lain yang dipelajari. Jadi ketika orang terkena delta, mereka menjadi menular lebih cepat,&quot; imbuh dr Ray.<br />\r\n<br />\r\nRay mengatakan, varian Delta adalah &#39;keluarga besar&#39; virus, dan dunia sekarang berenang dalam semacam &#39;sup Delta&#39;. Meski begitu menurutnya, sulit untuk mengetahui fitur genetik yang mungkin memiliki keunggulan, atau varian non-Delta mana yang berpotensi melengserkan Delta.<br />\r\n<br />\r\nBaca artikel detikHealth, &quot;&#39;Kapok&#39; dengan Varian Delta, Pakar Beberkan Cara Mencegah Mutasi Varian Corona&quot;&nbsp;</p>\r\n\r\n<p><strong>Selasa, 23 Nov 2021 08:42 WIB<br />\r\ndetikHealth<br />\r\n<!--[if !supportLineBreakNewLine]--><br />\r\n<!--[endif]--></strong></p>', '1637634627.jpg', 7, 'id', 48, '2021-11-22 19:30:27', '2021-11-22 19:30:27', NULL),
(28, '<h1><strong>15.345 Orang Masuk Daftar Tunggu Umrah se-Jawa Timur</strong></h1>', '<p><strong>JawaPos.com</strong>&nbsp;&ndash; Kepastian keberangkatan umrah ke Tanah Suci sangat dinanti ribuan calon jamaah. Sejauh ini total ada 15.345 orang yang masuk daftar tunggu umrah se-Jawa Timur. Sepertiga dari itu, persisnya 5.148 orang, adalah warga Surabaya. Keberangkatan mereka tertunda akibat pandemi Covid-19.</p>\r\n\r\n<p>Kasi Pelaksana Haji dan Umrah Kemenag Kota Surabaya Gatarman menyampaikan, mereka sudah masuk data nomor pendaftar umrah (NPU) di Ditjen Penyelenggaraan Haji dan Umrah (PHU) Kemenag RI. Jumlah itu adalah akumulasi sejak 3 Februari lalu.</p>\r\n\r\n<p>Mulai saat itu pemerintah Arab Saudi memang menutup pintu penerbangan jamaah umrah maupun haji. Bahkan, ada juga yang tertunda keberangkatannya sejak 2020. &rsquo;&rsquo;Jadi, saat ini kita menunggu Kemenag pusat,&rsquo;&rsquo; jelas Gatarman Selasa (23/11). Dia menyampaikan, 5.148 calon jamaah umrah Surabaya terdaftar di berbagai penyelenggara perjalanan ibadah umrah (PPIU). Mereka tersebar di 48 PPIU se-Surabaya. Sejak Arab Saudi menutup penerbangan umrah untuk mencegah lonjakan Covid-19, mereka tidak bisa berbuat banyak. Pada Januari‒Februari lalu, sejumlah PPIU sudah menyiapkan rencana keberangkatan calon jamaah.</p>\r\n\r\n<p>&rsquo;&rsquo;Tapi, tidak bisa sampai ke Tanah Suci karena ada penutupan penerbangan,&rsquo;&rsquo; papar Gatarman.</p>\r\n\r\n<p>Nah, saat ini Kemenag Surabaya menunggu terbitnya standard operating procedures (SOP) pelaksanaan umrah. Itu dikeluarkan Ditjen PHU Kemenag RI sebagai acuan dalam pelaksanaan umrah pada masa pandemi Covid-19. Dokumen tersebut berisi petunjuk pelaksanaan dan petunjuk teknis. SOP juga mengatur biaya umrah. Baik batas atas maupun batas bawah biaya perjalanan umrah.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>SOP juga mengatur teknis pelaksanaan umrah pada masa pandemi. Misalnya, sebelum berangkat, jamaah menjalani skrining berupa pemeriksaan kesehatan. Juga pemeriksaan sertifikat vaksinasi dan tes RT-PCR untuk memastikan jamaah yang berangkat negatif Covid-19. Sebelum masuk Tanah Suci, para jamaah juga diwajibkan untuk menjalani karantina selama tiga hari.</p>\r\n\r\n<p>Menurut Gatarman, berbagai prosedur itu bakal memengaruhi biaya umrah. Sebelum pandemi, biaya batas bawah minimal Rp 20 juta. Nah, ke depan biaya tersebut diprediksi meningkat. &rsquo;&rsquo;Pasti ada kenaikan karena kan ada tambahan biaya selama pandemi. Termasuk, tes PCR ditanggung jamaah,&rsquo;&rsquo; jelasnya.</p>\r\n\r\n<p>Sejauh ini, berdasar kajian, Ditjen PHU akan menerapkan kebijakan umrah one gate policy. Untuk pemberangkatan tahap awal Desember nanti, semua jamaah diberangkatkan melalui Bandara Soekarno-Hatta. Skrining kesehatan pun dilakukan di Asrama Haji Jakarta.</p>\r\n\r\n<p>Nah, terkait hal itu, Gatarman menyebut telah menyiapkan persiapan umrah bagi jamaah dari Surabaya. Karena jumlah jamaah umrah Surabaya dan Jatim cukup banyak, pihaknya meminta tambahan kuota untuk penerbangan Surabaya. Permintaan itu sudah disampaikan ke Ditjen PHU Kemenag RI. Sejauh ini, Kemenag Surabaya masih menunggu jawaban.</p>\r\n\r\n<p>&rsquo;&rsquo;Kami usul agar Surabaya menjadi embarkasi pemberangkatan sendiri. Karena ini kan memengaruhi cost jamaah,&rsquo;&rsquo; paparnya.</p>\r\n\r\n<p>&nbsp;</p>', '1637722322.jpg', 5, 'id', 48, '2021-11-23 19:52:02', '2021-11-23 19:52:02', NULL),
(29, '<h1><strong>Tragedi di Gresik: Usai Habisi Istri, Suami Bunuh Diri Tabrak Kereta Api</strong></h1>', '<p>Gresik - Seorang istri ditemukan tewas bersimbah darah di rumahnya di Desa Bambe, Driyorejo, Gresik. Di dekatnya tergeletak juga anaknya yang masih hidup dan segera diselamatkan warga.<br />\r\nKorban tewas adalah Trianah (64). Sementara anaknya yang masih selamat adalah Thalita (23). Pelaku pembunuhan terhadap istri dan penganiayaan terhadap istri dan anak tersebut adalah si kepala keluarga, Joko Sumarsono (63).<br />\r\n<br />\r\nNamun suami dan bapak tersebut juga ikut tewas. Joko bunuh diri dengan menabrakkan diri ke kereta api yang melintas di Jombang. &quot;Itu betul pria yang pelaku di Driyorejo, yang pembunuhan tadi pagi,&quot; ujar Kasat Reskrim Polres Gresik Iptu Wahyu Rizky kepada detikcom, Rabu (25/1/2021). Sementara itu, Kapolsek Driyorejo Kompol Zunaedi mengatakan ada fakta yang ditemukan polisi yakni baik korban dan suaminya mempunyai riwayat orang dengan gangguan jiwa (ODGJ). Keduanya sama-sama pernah mempunya riwayat dirawat di Rumah Sakit Jiwa (RSJ) Menur Surabaya.<br />\r\n<br />\r\n&quot;Kedua suami istri itu pernah menjadi penghuni Menur,&quot; tandas Zunaedi.<br />\r\n<br />\r\nZunaedi mengatakan dari hasil olah TKP awal, di tubuh si ibu ditemukan luka memar di bagian dahi. Dugaan awal korban dipukul dengan benda keras.<br />\r\n<br />\r\n&quot;Tidak ada luka apapun di tubuh korban, jadi hanya luka memar di dahi dan ada mengeluarkan darah telinga. Dugaan dipukul dengan benda keras,&quot; ungkap Zunaedi. Sedangkan si anak saat ini sedang dirawat di RSUD Ibnu Sina. Sang putri mengalami luka di bagian kepala dan lengan.<br />\r\n<br />\r\n&quot;Mudah-mudahan segera pulih dan sehat kembali. Ada di kepala (luka) dan tangan. Semacam ada sayatan, cuman belum diketahui dengan apa &quot; ungkap Zunaedi.<br />\r\n<br />\r\nDari kasus pembunuhan ini, polisi mengamankan tabung elpiji berukuran 3 kg yang ada bekas darah.<br />\r\n<br />\r\n&quot;Yang kita amankan elpiji melon yang ada bercak darahnya,&quot; tandas Zunaedi.<br />\r\n<br />\r\n<strong>Tim detikcom - detikNews<br />\r\nKamis, 25 Nov 2021 09:19 WIB</strong><br />\r\n&nbsp;</p>', '1637808183.jpeg', 5, 'id', 48, '2021-11-24 19:43:03', '2021-11-24 19:43:03', NULL),
(30, '<h1><strong>Mourinho dan Zaniolo Baik-baik Saja</strong></h1>', '<p>Roma - Nicolo Zainolo tampil apik saat AS Roma menang 4-0 atas Zorya. Ini menepis anggapan bahwa Zaniolo tak cocok dengan taktik yang dikembangkan Jose Mourinho.<br />\r\nAS Roma berhasil meraih kemenangan 4-0 saat menjamu Zorya Luhansk di Olimpico Roma pada laga Grup C Europa Conference League, Jumat (26/11/2021) dini hari WIB. Empat gol Serigala Ibu Kota di laga ini lahir dari Carlo Perez, Nicolo Zaniolo, brace Tammy Abraham.<br />\r\n<br />\r\nZaniolo menjadi salah satu pemain yang tampil menonjol di laga ini. Selain bikin satu gol, ia juga bikin satu assist untuk gol Tammy Abraham. Zaniolo bermain apik di laga ini kala bermain di bekalang penyerang (trequartista). Hal ini sekaligus menepis gosip yang berhembus pemain 22 tahun ini bakal terpinggirkan karena tak cocok dengan sistem Mourinho. Pada skema 4-2-3-1 yang dikembangkan The Special One di Roma, Zaniolo biasanya ditempatkan di sisi kanan. Isu ini muncul setelah Zaniolo tak tampil sebagai starter di dua laga Serie A terakhir kala menghadapi Venezia dan Genoa. Di laga kontra Venezia, ia hanya bermain 13 menit, sedangkan kala jumpa Genoa, Zaniolo hanya menjadi penghangat bangku cadangan. Zaniolo yang baru sembuh dari cedera juga belum sepenuhnya nyetel dengan taktik Mourinho. Ia baru bikin dua gol dan tiga assist dalam 16 laga bersama Roma musim ini.<br />\r\n<br />\r\nPelatih AS Roma, Jose Mourinho, juga membantah anggapan tersebut. Ia mengatakan tak memainkan Zaniolo sebagai starter di dua laga tersebut karena masalah kebugaran. Pria asal Portugal ini sepenuhnya percaya dengan potensi Zaniolo.<br />\r\n<br />\r\n&quot;Dia berada di bangku cadangan melawan Venezia karena dia memiliki masalah kebugaran dan tidak berlatih minggu itu. Pada laga setelah, saya berpikir dia tidak pernah bermain dengan saya dalam sistem seperti ini, jadi saya pikir Eldor Shomurodov lebih terbiasa dengan bermain di posisi itu dan kemudian Felix melakukannya dengan sangat baik,&quot;ujar Mourinho dikutip dari Football Italia.<br />\r\n<br />\r\n&quot;Seperti yang saya katakan sebelum pertandingan, saya tidak berharap Zaniolo melakukan sesuatu sendiri, saya berharap dia menjadi bagian dari tim dan memberikan yang terbaik. Saya menyukai cara dia bermain dan juga sikapnya.&quot;<br />\r\n<br />\r\n&quot;Zaniolo memiliki potensi besar, tetapi juga banyak belajar dalam hal taktik dan stabilitas sikapnya di lapangan. Dia mengalami pasang surut dalam hal kepercayaan diri. Saya merasa para pemain terbaik terus maju bahkan ketika segala sesuatunya tidak berjalan dengan baik, harus menjaga kepercayaan itu pada bakatnya,&quot; jelasnya.<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Putra Rusdi K - Sepakbola</strong><br />\r\n<strong>Jumat, 26 Nov 2021 09:00 WIB</strong></p>', '1637893484.jpeg', 6, 'id', 48, '2021-11-25 19:24:44', '2021-11-25 19:24:44', NULL),
(31, '<h1><strong>Dosen Cabul Divonis 6 Tahun Penjara, Rektor Universitas Jember Percaya Hakim Obyektif</strong></h1>', '<p><strong>Jember (<a href=\"https://beritajatim.com/\" target=\"_blank\">beritajatim.com</a>)</strong>&nbsp;&ndash; Rahmat Hidayat, dosen Universitas Jember divonis enam tahun penjara oleh majelis hakim Pengadilan Negeri Jember, Jawa Timur, karena kasus pencabulan anak bawah umur. Rektor Universitas Jember Iwan Taruna percaya keputusan majelis hakim obyektif.</p>\r\n\r\n<p>&ldquo;Kami menghormati keputusan Pengadilan Negeri Jember atas kasus yang menimpa Pak RH. Karena kita harus meyakini bahwa hakim memutuskan kasus tentu berdasarkan fakta-fakta obyektif. Oleh karena itu kita harus mempercayakan hal tersebut kepada hakim. Siapapun pada dasarnya tidak boleh mengintervensi hakim,&rdquo; kata Iwan, Jumat (26/11/2021).</p>\r\n\r\n<p>Setelah menjadi terdakwa, Rahmat diberhentikan sementara. Iwan mengatakan, pihaknya menunggu putusan tetap dari lembaga peradilan.</p>\r\n\r\n<p>&ldquo;Karena putusan tetap sangat tergantung dari proses berikutnya. Setelah putusan pengadilan negeri ini, apakah ada banding atau tidak. Baru akan ada tindakan-tindakan lain yang kita kaitkan dengan peraturan kepegawaiannya. Jadi peraturan kepegawaian menunggu putusan hukum yang bersifat tetap,&rdquo; kata Iwan.</p>\r\n\r\n<p>Rahmat Hidayat, dosen Universitas Jember, divonis enam tahun penjara dan denda Rp 50 juta subsider empat bulan kurungan oleh majelis hakim yang diketuai Totok Yanuarto, di Pengadilan Negeri Jember, Rabu (24/11/2021) petang. Vonis ini lebih ringan daripada tuntutan delapan tahun penjara dari jaksa.</p>\r\n\r\n<p>Rahmat dinyatakan terbukti bersalah melakukan tindak pidana melakukan kekerasan atau ancaman kekerasan, serta perbuatan cabul terhadap anak bawah umur. Terdakwa mengikuti persidangan secara daring di Lembaga Pemasyarakatan Kelas II-A Jember.</p>\r\n\r\n<p>Pencabulan terjadi akhir tahun di rumah terdakwa, tapi baru dilaporkan pada Februari 2021 oleh orang tua korban. Korban masih berusia 16 tahun. Terdakwa berpura-pura menunjukkan teknik pemyembuhan penyakit sebagai modus pencabulan.</p>\r\n\r\n<p>Pencabulan terjadi dua kali. Saat pencabulan kedua, korban merekam kejadian dengan meletakkan HP di bawah bantal, sehingga apa yang dibicarakan tersangka pada korban dapat direkam.&nbsp;</p>\r\n\r\n<p>Sabtu, 27 November 2021, 06:50 WIB</p>\r\n\r\n<p>Reporter : Oryza A. Wirawan</p>\r\n\r\n<p>&nbsp;</p>', '1637980576.jpg', 3, 'id', 48, '2021-11-26 19:36:16', '2021-11-26 19:36:16', NULL),
(32, '<h1><strong>Gagal Bayar Utang China, Uganda Kehilangan Bandara Internasional</strong><br />\r\n&nbsp;</h1>', '<p>Jakarta - China diduga telah mengambil alih Bandara Internasional Entebbe Uganda di Afrika Timur. Hal itu dilakukan karena pemerintah Uganda dikabarkan gagal bayar utang ke China.<br />\r\nDikutip dari Economic Times, Senin (29/11/2021), Pemerintah Uganda telah mendapatkan pinjaman dari Bank Exim China sebanyak US$ 207 juta untuk memperluas Bandara Internasional Entebbe.<br />\r\n<br />\r\nPinjaman tersebut memiliki jangka waktu 20 tahun termasuk masa tenggang tujuh tahun. Pembayaran utang itu tersendat karena kabarnya pihak bandara tengah krisis. Meski demikian, Presiden Uganda, Yoweri Museveni kabarnya telah mengirim delegasi ke China untuk negosiasi ulang utang. Namun, ini bukan pertama kalinya Uganda menegosiasikan utang. Pada Maret 2021, Uganda juga pernah melakukan hal serupa.<br />\r\n<br />\r\nBandara Internasional Entebbe adalah satu-satunya bandara internasional Uganda yang bisa menampung lebih dari 1,9 juta penumpang per tahun.<br />\r\n<br />\r\nDengan adanya pengambilalihan aset bandara ini oleh China, banyak spekulasi dan pertanyaan dari publik apakah pemerintah Uganda tidak mempertimbangkan atau melakukan pengawasan saat menerima perjanjian dari negara lain. Publik pun menilai Pemerintah Uganda terlalu terburu-buru menerima pinjaman dari China.<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Aulia Damayanti - detikFinance</strong><br />\r\n<strong>Senin, 29 Nov 2021 09:02 WIB</strong></p>', '1638151593.jpg', 2, 'id', 48, '2021-11-28 19:06:33', '2021-11-28 19:06:33', NULL),
(33, '<h1><strong>MK Minta Letkol Euis Perkuat Alasan Usia Pensiun TNI Disamakan dengan Polri</strong><br />\r\n&nbsp;</h1>', '<p>Jakarta - Letkol (Purn) Euis Kurniasih meminta perwira tinggi (Pati) TNI dengan keahlian khusus pensiun di usia 60 tahun seperti di pati Polri. Oleh sebab itu, Euis mengajukan judicial review UU Nomor 34 Tahun 2004 tentang TNI ke Mahkamah Konstitusi (MK).<br />\r\n&quot;Ada beberapa kalimat yang bisa kita interpretasikan, kita mengartikan diskriminasi, &#39;Kalau di TNI kok begini, kok di Polri begini?&#39; Anda akan membandingkan itu? Nah, itu harus hati‐hati betul. Karena kalau diskriminasi itu, rumus yang dipakai di Mahkamah untuk hal yang sama tidak boleh dibedakan, untuk yang berbeda tidak boleh disamakan. Itu ada asas itu, sehingga Saudara harus hati‐hati,&quot; kata hakim konstitusi Arief Hidayat.<br />\r\n<br />\r\nHal itu tertuang dalam risalah sidang MK yang dikutip detikcom, Rabu (1/12/2021). Dalam sidang itu, Letkol (Purn) Euis Kurniasih memberikan kuasa kepada Iqbal Tawakkal Pasaribu dkk.</p>\r\n\r\n<p>Arief menasihati pemohon agar mencermati soal batas usia pensiun yang sudah diputus MK. Termasuk juga soal usia pernikahan dalam UU Perkawinan yang pernah diputus MK.<br />\r\n<br />\r\n&quot;Coba dibaca dalam putusan Mahkamah, pertimbangannya apa sih, kok Mahkamah bisa sampai mengubah usia? Padahal, Mahkamah itu sangat berhati‐hati betul untuk mengubah usia. Ada prinsip yang digunakan Mahkamah. Kalau dalam hal mengubah dalam hal usia, menentukan usia, itu merupakan kebijakan dari pembentuk undang‐undang, Mahkamah tidak bisa mengubah,&quot; ujar Arief.<br />\r\n<br />\r\n&quot;Pada waktu Mahkamah memutus, mengubah usia kawin perempuan dari 16 menjadi 19, cari itu putusannya. Pertimbangan Mahkamah apa sih, kok bisa sampai menaikkan, mengubah usia itu? Itu coba dicari, ya, supaya itu bisa menjadi pembanding. Itu narasinya, pertimbangannya apa? Kok Mahkamah sampai memutus pengubahan itu, ya? Itu menjadi sangat baik sekali untuk dijadikan bahan pertimbangan Saudara pada waktu membuat Permohonan ini,&quot; sambung Arief.<br />\r\n<br />\r\nHakim konstitusi Manahan Sitompul juga memberi masukan dan nasihat kepada pemohon. Terutama soal batu uji Pasal 27 ayat (1) dan ayat (2) serta pasal 28D ayat (1) UUD 1945.<br />\r\n<br />\r\n&quot;Nah, tapi ini harus lebih dielaborasi lagi lebih lanjut di mana pertentangan itu sebenarnya? Karena kemudian saya lihat Anda membuat suatu dalil diskriminasi. Bagaimana menurut Anda diskriminasi itu? Antara ketentuan ataupun ketentuan yang mengatur umur pensiun daripada kepolisian dengan umur pensiun daripada TNI,&quot; kata Manahan<br />\r\n<br />\r\nManahan meminta mempertajam dalil diskriminasi dalam permohonan itu.<br />\r\n<br />\r\n&quot;Nah, itu apakah benar‐benar Anda bisa membuktikan benar itu suatu diskriminasi? Atau memang betul‐betul harus dibedakan? Beda, ya? Kalau memang betul‐betul hal yang berbeda, dibedakan, itu konstitusional. Tetapi kalau yang benar‐benar harus dipersamakan, namun dibedakan, nah, itu inkonstitusional, ya. Nanti di mana Anda mengatakan itu ada diskriminasi kalau Anda tidak membuat suatu alur ataupun ketentuan bahwa itu memang sama, begitu, ya? Apakah memang ada unsur itu yang mengatakan ada kesamaan itu? Karena keputusan undang-undangnya berbeda dengan Undang‐Undang TNI. Nah, di mana Anda bisa mengatakan itu ada diskriminasi? Itu perlu diuraikan lebih lanjut,&quot; papar Manahan.<br />\r\n<br />\r\n<strong>Andi Saputra - detikNews<br />\r\nRabu, 01 Des 2021 09:03 WIB</strong></p>\r\n\r\n<p>&nbsp;</p>', '1638324860.jpg', 3, 'id', 48, '2021-11-30 19:14:20', '2021-11-30 19:14:20', NULL),
(34, '<h1>&nbsp;</h1>\r\n\r\n<h1><strong>detik&#39;s Advocate: 5 Tips Agar Tidak Jadi Korban Mafia Tanah<br />\r\n<!--[if !supportLineBreakNewLine]--><br />\r\n<!--[endif]--></strong></h1>', '<p>Jakarta - Aksi mafia tanah belakangan mencuat ke publik. Salah satu yang mengaku menjadi korban adalah artis Nirina Zubir. Lalu bagaimana tips agar terhindar dari aksi mafia tanah itu?<br />\r\nHal itu menjadi pertanyaan pembaca detik&#39;s Advocate. Berikut pertanyaannya:<br />\r\nBerhubung lagi panasnya kasus Mba Nirina Zubir di mana sertifikat hilang dan diganti nama oleh ART secara ilegal.<br />\r\n<br />\r\nMungkin bisa diinfokan tips dan info apa yang harus kita lakukan sebagai orang awam apabila ada sertifikat tanah atau sertifikat berharga lain yang hilang guna menghindari kejadian adanya balik nama yang tanpa kita setujui.<br />\r\n<br />\r\nEmail tersebut lebih ke edukasi terhadap semua orang karena kita sering dengar kejadian tersebut di lapangan dan kadang kita tidak mengerti apa yang harus kita lakukan dulu tanpa menunggu terjadinya kasus.<br />\r\n<br />\r\nBaca artikel detiknews, &quot;detik&#39;s Advocate: 5 Tips Agar Tidak Jadi Korban Mafia Tanah&quot; selengkapnya&nbsp;<a href=\"https://news.detik.com/berita/d-5836776/detiks-advocate-5-tips-agar-tidak-jadi-korban-mafia-tanah\">https://news.detik.com/berita/d-5836776/detiks-advocate-5-tips-agar-tidak-jadi-korban-mafia-tanah</a>. Merujuk pada cerita yang saudara contohkan dalam pertanyaan saudara, maka kami asumsikan bahwa sertifikat yang saudara maksud adalah Sertifikat Hak Milik.<br />\r\n<br />\r\nSebagaimana kita ketahui, Sertifikat Hak Milik (SHM) adalah bukti kepemilikan tertinggi atau terkuat atas suatu lahan atau tanah, tanpa batasan waktu tertentu. SHM merupakan dokumen otentik yang paling penting dan kuat berdasarkan hukum.<br />\r\n<br />\r\nBerdasarkan UU Pokok Agraria, Sertifikat Hak Milik atau SHM adalah bukti kepemilikan tanah yang menempati kasta tertinggi di mata hukum dan memiliki manfaat paling besar bagi pemiliknya.<br />\r\n<br />\r\nDilihat dari keleluasaan dalam penggunaannya, semua hak atas tanah yang ada, hak milik yang dibuktikan dengan Sertifikat Hak Milik atau SHM menempati kasta tertinggi dan memiliki manfaat paling besar bagi pemiliknya.<br />\r\n<br />\r\nMengapa demikian? Seperti tercantum dalam Pasal 20 UUPA, hak milik atas tanah adalah hak turun-temurun, terkuat dan terpenuh yang dapat dipunyai orang atas tanah. Berikut ini adalah sejumlah keunggulan Sertifikat Hak Milik atau SHM yang harus Anda ketahui:<br />\r\n<br />\r\n1. Jangka waktu tidak terbatas, berlangsung terus selama pemiliknya masih hidup.<br />\r\n<br />\r\n2. Dapat diwariskan dari generasi ke generasi sesuai hukum yang berlaku.<br />\r\n<br />\r\n3. Hak penggunaannya berlaku seumur hidup, tidak seperti Hak Guna Bangunan atau Usaha yang maksimal 60 tahun.<br />\r\n<br />\r\n4. Sebagai aset. Dapat dijual, digadaikan, menjadi jaminan bank, disewakan, hingga diwakafkan.</p>\r\n\r\n<p>Pembaca boleh bertanya semua hal tentang hukum, baik masalah pidana, perdata, keluarga, hubungan dengan kekasih, UU Informasi dan Teknologi Elektronik (ITE), hukum merekam hubungan badan (UU Pornografi), hukum waris, perlindungan konsumen dan lain-lain.<br />\r\n<br />\r\nIdentitas penanya bisa ditulis terang atau disamarkan, disesuaikan dengan keinginan pembaca. Seluruh identitas penanya kami jamin akan dirahasiakan.<br />\r\n<br />\r\nPertanyaan dan masalah hukum/pertanyaan seputar hukum di atas, bisa dikirim ke kami di email: redaksi@detik.com dan di-cc ke-email: andi.saputra@detik.com<br />\r\n<br />\r\nSemua jawaban di rubrik ini bersifat informatif belaka dan bukan bagian dari legal opinion yang bisa dijadikan alat bukti di pengadilan serta tidak bisa digugat.<br />\r\n<br />\r\nBaca artikel detiknews, &quot;detik&#39;s Advocate: 5 Tips Agar Tidak Jadi Korban Mafia Tanah&quot; selengkapnya&nbsp;<a href=\"https://news.detik.com/berita/d-5836776/detiks-advocate-5-tips-agar-tidak-jadi-korban-mafia-tanah\">https://news.detik.com/berita/d-5836776/detiks-advocate-5-tips-agar-tidak-jadi-korban-mafia-tanah</a>.<br />\r\n<br />\r\nAndi Saputra - detikNews<br />\r\nKamis, 02 Des 2021 09:02 WIB<br />\r\n<br />\r\n&nbsp;</p>', '1638410883.jpeg', 3, 'id', 48, '2021-12-01 19:08:03', '2021-12-01 19:08:03', NULL),
(35, '<h1><strong>BERITA TERBARU Erupsi Gunung Semeru Lumajang, 13 Orang Tewas, Puluhan Terluka, dan Ratusan Warga Mengungsi</strong></h1>', '<p><strong>DESKJABAR</strong>&nbsp;- Akibat&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/erupsi\">erupsi</a>&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Gunung%20Semeru\">Gunung Semeru</a>&nbsp;di Kabupaten&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Lumajang\">Lumajang</a>,&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Jawa%20Timur\">Jawa Timur</a>&nbsp;pada Sabtu 4 Desember 2021 sore, hingga saat ini menewaskan&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/13%20orang\">13 orang</a>&nbsp;dan puluhan&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/warga\">warga</a>&nbsp;lainnya terluka.</p>\r\n\r\n<p>Data tersebut disampaikan Badan Nasional Penanggulangan Bencana (<a href=\"https://deskjabar.pikiran-rakyat.com/tag/BNPB\">BNPB</a>) yang mencatat sebanyak 13&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/warga\">warga</a>&nbsp;meninggal dunia dan puluhan lainnya terluka akibat&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/erupsi\">erupsi</a>&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Gunung%20Semeru\">Gunung Semeru</a>&nbsp;di Kabupaten&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Lumajang\">Lumajang</a>,&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Jawa%20Timur\">Jawa Timur</a>.<br />\r\n<br />\r\n&quot;Sebanyak 41 orang yang mengalami luka-luka, khususnya luka bakar, telah mendapatkan penanganan awal di Puskesmas Penanggal. Selanjutnya mereka dirujuk menuju RSUD Haryoto dan RS Bhayangkara,&quot; ungkap Abdul Muhari Pelaksana Tugas (Plt) Kepala Pusat Data, Informasi, dan Komunikasi Kebencanaan&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/BNPB\">BNPB</a>, dalam keterangannya, Minggu 5 Desember 2021.</p>\r\n\r\n<p>Puluhan orang lainnya yang terluka akibat&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/erupsi\">erupsi</a>&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Gunung%20Semeru\">Gunung Semeru</a>&nbsp;juga telah dievakuasi di sejumlah fasilitas kesehatan. Di antaranya 40 orang dirawat di Puskesmas Pasirian, 7 orang di Puskesmas Candipuro&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Lumajang\">Lumajang</a>, serta 10 orang lain di Puskesmas Penanggal di antaranya terdapat dua orang ibu hamil.</p>\r\n\r\n<p>Sementara itu Relawan Baret Rescue Gerakan Pemuda Nasdem Jember menemukan jenazah seorang ibu yang sedang menggendong bayinya tertimbun lahar&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Gunung%20Semeru\">Gunung Semeru</a>&nbsp;di Dusun Curah Kobokan, Desa Supiturang, Kabupaten&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Lumajang\">Lumajang</a>,&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Jawa%20Timur\">Jawa Timur</a>, Minggu 5 Desember 2021.</p>\r\n\r\n<p>&quot;Saat melakukan penyisiran, relawan menemukan jenazah ibu dan anak yang tertimbun lahar Semeru,&quot; kata Ketua Baret Gerakan Pemuda Nasdem Jember David Handoko Seto di&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Lumajang\">Lumajang</a>.</p>\r\n\r\n<p>Ia mengatakan ada 15 orang tim Baret Rescue yang terjun ke lokasi letusan&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Gunung%20Semeru\">Gunung Semeru</a>&nbsp;untuk membantu tim BPBD&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Lumajang\">Lumajang</a>&nbsp;melakukan evakuasi korban.</p>\r\n\r\n<p>&quot;Kami juga menemukan tiga jenazah yang masih terjebak di dalam truk pengangkut pasir yang tertimbun lahar Semeru,&quot; katanya.</p>\r\n\r\n<p>Ia menjelaskan pihaknya langsung berkoordinasi dengan Basarnas dan BPBD&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Lumajang\">Lumajang</a>&nbsp;untuk mengevakuasi jenazah tersebut.</p>\r\n\r\n<p>&quot;Tim relawan menemukan sekitar tujuh jenazah yang tertimbun lahar&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Gunung%20Semeru\">Gunung Semeru</a>&nbsp;dan langsung berkoordinasi dengan Basarnas,&quot; ujarnya.</p>\r\n\r\n<p>David mengatakan seluruh rumah&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/warga\">warga</a>&nbsp;rata dengan tanah tertimbun material lahar&nbsp;<a href=\"https://deskjabar.pikiran-rakyat.com/tag/Gunung%20Semeru\">Gunung Semeru</a>, bahkan relawan sempat kesulitan ke lokasi karena ketebalan abu vulkanik Semeru.</p>', '1638756974.jpg', 7, 'id', 48, '2021-12-05 19:16:14', '2021-12-05 19:16:14', NULL),
(36, '<h1><strong>Prabowo Rilis Kapal Cepat Rudal Buatan Surabaya, Ini Kecanggihannya</strong><br />\r\n<br />\r\n&nbsp;</h1>', '<p>Jakarta - PT PAL Indonesia (Persero) secara resmi meluncurkan Kapal Cepat Rudal (KCR) 60 meter ke-5. Acara peluncuran dibuka oleh CEO PT PAL Indonesia (Persero) Kaharuddin Djenod, dan dipimpin langsung oleh Menteri Pertahanan Prabowo Subianto. Acara diselenggarakan di transfer area Divisi Kapal Perang tersebut. Peluncuran KCR ini secara khusus dihadiri oleh Panglima TNI Jenderal Andika Perkasa, Laksamana TNI Yudo Margono selaku Kepala Staf Angkatan Laut (KASAL) serta para pemangku kepentingan lainnya.<br />\r\n<br />\r\n&quot;Kami dengan bangga menyampaikan terima kasih atas kepercayaan yang diberikan Kementerian Pertahanan RI kepada PAL dalam proyek pembangunan dua unit kapal KCR 60 Meter,&quot; kata Kaharuddin dalam keterangannya, Senin (6/12/2021). Kapal KCR memiliki kemampuan manuver yang lincah, mampu bergerak secara cepat, serta sesuai fungsinya, pengamanan wilayah maritim dan melakukan pengejaran terhadap kapal asing yang melanggar wilayah teritorial laut RI. Peluncuran kapal KCR kelima ini kembali menjadi bukti atas kemampuan dan kompetensi yang dimiliki PAL sebagai industri pertahanan dalam negeri. &quot;Tanpa kekuatan maritim yang kuat, tidak mungkin negara kita kuat. Serta ditopang dengan industri pertahanan yang kuat agar kita tidak bergantung dengan industri pertahanan luar negeri&quot;, ucap Prabowo. Proses pembangunan KCR 60M ke-5 menja di sejarah baru bagi PT PAL Indonesia (Persero), pasalnya untuk pertama kali pengadaan dua unit kapal yakni KCR 60M ke-5 dan KCR 60M ke-6 dibangun lengkap antara platform dengan sistem persenjataannya. Kapal Cepat Rudal ini memiliki panjang keseluruhan 60 meter dengan lebar 8,10 meter dan tinggi 4,85 meter serta mampu membawa muatan penuh 450 s/d 500 ton. KCR ke-5 telah dilengkapi dengan sistem persenjataan yang mampu mendeteksi sasaran/target baik di udara, permukaan dan bawah laut.<br />\r\n<br />\r\n<br />\r\n<strong>Ardan Adhi Chandra - detikFinance<br />\r\nSenin, 06 Des 2021 09:04 WIB</strong><br />\r\n<br />\r\n&nbsp;</p>', '1638757206.jpeg', 2, 'id', 48, '2021-12-05 19:20:06', '2021-12-05 19:20:06', NULL),
(37, '<h1><strong>Anggota DPR Minta Warga Tak Lengah-Euforia Meski PPKM Level 3 Nataru Batal</strong><br />\r\n<br />\r\n&nbsp;</h1>', '<p>Matius Alfons - detikNews<br />\r\nRabu, 08 Des 2021 08:54 WIB<br />\r\n&nbsp;</p>\r\n\r\n<p>Jakarta - Pemerintah memutuskan untuk membatalkan penerapan PPKM level 3 di semua wilayah Indonesia saat periode Natal dan Tahun Baru. Anggota Komisi IX DPR Fraksi PDIP, Rahmad Handoyo meminta tak ada yang pihak yang lengah dan euforia.<br />\r\n&quot;Meskipun Pemerintah telah memutuskan pembatalan level 3 dalam liburan Nataru secara nasional, kita imbau untuk tidak lengah dan terus meningkatkan kewaspadaan secara nasional terhadap ancaman gelombang 3,&quot; kata Rahmad saat dihubungi, Selasa (7/12/2021). Rahmad meminta agar pemerintah tetap memasifkan dan mengetatkan protokol kesehatan meski PPKM level 3 batal diterapkan secara nasional. Dia mengingatkan gelombang COVID-19 masih mengintai Indonesia. &quot;Terus melakukan secara masif dan ketat penggunaan protokol kesehatan, mengingat negara lain dengan tingkat program vaksinasi tinggi, seperti Eropa gelombang Covid masih tinggi. Meskipun Saat ini tingkat vaksinasi komplit sudah sampai 56 persen dan sudah lebih dari 70 persen secara nasional yang sudah divaksin tahap 1, namun jangan menjustifikasi bahwa kekebalan kita sudah kuat dan tahan terhadap COVID, untuk itu tingkatkan vaksinasi serta protokol kesehatan wajib dan tidak boleh kendor,&quot; jelasnya.<br />\r\n<br />\r\nLebih lanjut, Rahmad meminta agar keputusan pemerintah mengikuti situasi dan kondisi pandemi COVID-19 di Indonesia. Dia meminta pemerintah tidak ragu meningkatkan level secara nasional jika kondisi semakin memburuk.<br />\r\n<br />\r\n&quot;Terhadap keputusan pembatalan PPKM level 3 nasional untuk bersifat dinamis dan situasional, artinya melihat situasi global terutama kasus Omikron dan situasi nasional secara keseluruhan, bila dipandang perlu dan kondisi mengharuskan, peningkatan level secara nasional kita dorong pemerintah dinamis untuk segera membuat aturan perubahan dengan peningkatan level secara nasional,&quot; tegasnya.<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '1638929076.jpeg', 3, 'id', 48, '2021-12-07 19:04:36', '2021-12-07 19:04:36', NULL),
(38, '<h1><strong>Pelukan Terakhir Rumini ke Suami Sebelum Ditemukan Tiada Dekap Sang Ibu</strong><br />\r\n<br />\r\n&nbsp;</h1>', '<p>Tim Detikcom - detikNews<br />\r\nKamis, 09 Des 2021 08:48 WIB</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Surabaya - Imam Syafii (30) tak menyangka pelukan sang istri, Rumini (28) malam itu merupakan terakhir kalinya. Diketahui, Rumini dan ibunya Salamah (70) ditemukan meninggal berpelukan saat erupsi Gunung Semeru.<br />\r\nImam tak bisa menyalahkan takdir sang Khalik, pun juga gejolak alam semesta. Kini, ia hanya bisa mengenang saat-saat terakhir bersama istri yang telah melahirkan seorang buah hati.<br />\r\n<br />\r\nSehari sebelum erupsi, Imam mengaku ada yang berbeda dari istrinya. Malam itu, sikap Rumini begitu hangat, romantis, dan sedikit manja. Rumini juga minta agar Imam terus memeluknya. Ia pun senang melihat perlakuan istrinya.<br />\r\n<br />\r\nDi rumah, Imam mengaku kerap tidur bertiga dengan Rumini dan anaknya. Posisi anaknya selalu berada di tengah Rumini dan Imam. Namun pada Jumat (3/12) malam, Rumini memindahkan anaknya di samping dan tidur di pundak sembari memeluk Imam.<br />\r\n<br />\r\n&quot;Sebelum kejadian ini biasanya tidur di atas ranjang di tengah. Ini kok tumben, anaknya ditaruh pinggir, ibunya (istri) meluk aku terus, kepalanya di pundak saya,&quot; kenang Imam, Rabu (8/12/2021).<br />\r\n<br />\r\nPaginya, Sabtu (4/12) sebelum berangkat kerja, Imam masih dipeluk Rumini. Bahkan, Rumini meminta kecupan di kening pada suaminya.<br />\r\n<br />\r\n&quot;Aku mau berangkat kerja itu rangkulan pancet (pelukan terus). Setelah itu minta dicium keningnya, tak cium,&quot; ujarnya.<br />\r\n<br />\r\nSetelah kening dicium, Rumini mengambilkan dan memasangkan tas ke pundak Imam. Rumini pun kembali memeluk suaminya. Imam pun tak menyangka, pelukan itu merupakan yang terakhir bagi mereka. Imam hanya bisa mengenang sikap manis yang tak biasa dari istrinya.<br />\r\n&quot;Terus ambil tas dipakaikan ke aku, peluk aku lagi terus dada. Dungarene kok ngunu, biasane gatau ngunu (kok tumben seperti itu, biasanya tidak pernah seperti itu),&quot; ungkap Imam.<br />\r\n<br />\r\nKeanehan lain, tambah Imam, yakni saat Rumini meminta Imam melihat anaknya yang sedang tidur. Rumini meminta Imam selalu welas asih dan menyayangi buah cinta mereka. &quot;Pas mau tidur suruh lihat anaknya, &#39;deloken anake Mas, mosok ndak mesakaken&#39; (Lihat anak kita Mas, masa tidak kasihan). Mosok ya ndak mesakaken Dik, wong jenenge ambek anak (ya kasian Dik, orang sama anak),&quot; tutur Imam.<br />\r\n<br />\r\nImam mengaku perlakuan Rumini ini mencipta secuil firasat padanya. Saat bekerja, dia merasa ada sesuatu yang aneh.<br />\r\n&nbsp;</p>', '1639014970.jpeg', 7, 'id', 48, '2021-12-08 18:56:10', '2021-12-08 18:56:10', NULL),
(39, '<h1><strong>Waspada! Gelombang Laut Selatan Yogya Bisa Mencapai 4 Meter</strong></h1>', '<p><strong>Jauh Hari Wawan S - detikNews</strong><br />\r\n<strong>Jumat, 10 Des 2021 08:32 WIB</strong><br />\r\n<br />\r\nBaca artikel detiknews, &quot;Waspada! Gelombang Laut Selatan Yogya Bisa Mencapai 4 Meter&quot; selengkapnya&nbsp;<a href=\"https://news.detik.com/berita-jawa-tengah/d-5848635/waspada-gelombang-laut-selatan-yogya-bisa-mencapai-4-meter\">https://news.detik.com/berita-jawa-tengah/d-5848635/waspada-gelombang-laut-selatan-yogya-bisa-mencapai-4-meter</a>.<br />\r\n<br />\r\nDownload Apps Detikcom Sekarang https://apps.detik.com/detik/<br />\r\n<br />\r\nYogyakarta - BMKG memprakirakan sebagian wilayah di Daerah Istimewa Yogyakarta (DIY) akan diguyur hujan. Selain itu, warga pesisir juga diminta waspada dengan potensi gelombang tinggi.<br />\r\n&quot;Waspada gelombang tinggi di perairan selatan Yogyakarta yang dapat mencapai 4 meter,&quot; kata BMKG dalam keterangan tertulisnya, Jumat (10/12/2021).<br />\r\n<br />\r\nBMKG memaparkan pada pagi hari, cuaca wilayah DIY berpotensi hujan ringan di wilayah Kulon Progo bagian selatan, Bantul bagian selatan dan Gunung Kidul bagian selatan. Kemudian siang hingga sore berpotensi hujan ringan hingga sedang di wilayah Sleman bagian utara dan Kulon Progo bagian utara.<br />\r\n<br />\r\nSementara saat malam hingga dini hari diprakirakan berawan.<br />\r\n<br />\r\nLebih lanjut, suhu udara wilayah Yogyakarta berkisar antara 21 hingga 32 derajat celsius dengan kelembapan udara 65 hingga 95 persen.<br />\r\n<br />\r\nAngin dari arah barat daya hingga barat laut dengan kecepatan maksimum 20 kilometer per jam.<br />\r\n<br />\r\nPrakiraan tinggi gelombang di perairan Yogyakarta berkisar antara 2,5 hingga 4,0 meter, termasuk kategori tinggi.<br />\r\n<br />\r\n&nbsp;</p>', '1639100391.jpeg', 6, 'id', 48, '2021-12-09 18:39:51', '2021-12-09 18:39:51', NULL),
(40, '<h1><strong>Horor Lift Anjlok di Senayan Bikin Legislator Gerindra Sempat Terjebak</strong><br />\r\n<br />\r\n&nbsp;</h1>', '<p><strong>Tim detikcom - detikNews<br />\r\nSabtu, 11 Des 2021 08:01 WIB</strong><br />\r\n<br />\r\nJakarta - Lift di DPR anjlok. Wakil rakyat dari Partai Gerindra sempat terjebak di dalamya. Kondisi horor terjadi beberapa saat.<br />\r\nLift bernomor P3 itu ada di Gedung Nusantara I DPR, Kompleks Parlemen, Senayan, Jakarta, Jumat (10/12/2021). Insiden lift anjlok terjadi pada pukul 13.00 WIB. Gedung Nusantara I DPR berada di sisi yang paling jauh ari Jl Jenderal Gatot Subroto. Di gedung tinggi ini, terdapat pelbagai ruangan termasuk ruangan fraksi-fraksi. Ternyata, lift yang ditumpangi Darori berhenti di Lantai 13. Anggota DPR yang terjebak itu adalah Darori Wonodipuro. Tak hanya Darori yang ada di dalam lift horor itu, tapi juga ada orang-orang lainnya, yakni staf Darori serta seorang Pamdal.<br />\r\n<br />\r\n&quot;Anggota naik dari lantai 21 lift berjalan normal namun di lantai 13 terjadi trip inverter, sehingga lift berhenti dan tidak level (naik),&quot; kata Sekjen DPR RI, Indra Iskandar, kepada wartawan, Jumat (10/12) kemarin. Penyelamatan<br />\r\nLift tertahan sekitar 3 menit di lantai 13. Sekjen DPR Indra Iskandar menyatakan petugas berusaha menyelamatkan orang-orang di dalam lift.<br />\r\n<br />\r\nPersonel Pengamanan Dalam (Pamdal) DPR terlihat membuka paksa lift tersebut agar Darori bisa keluar. Akhirnya, pintu lift berhasil dibuka meski permukaan lift sedang tidak sejajar dengan lantai. Darori dan dua orang di dalamnya berada dalam kondisi baik-baik saja.<br />\r\n<br />\r\n&quot;Itu sahabat saya Pak Darori Komisi IV Gerindra, terjebak di lift Nusantara. Alhamdulillah beliau selamat dan sehat,&quot; kata Wakil Ketua Umum Partai Gerindra, Habiburokhman.<br />\r\n<br />\r\n<!--[if !supportLineBreakNewLine]--><br />\r\n<!--[endif]--></p>\r\n\r\n<p>&nbsp;</p>', '1639188015.jpeg', 5, 'id', 48, '2021-12-10 19:00:15', '2021-12-10 19:00:15', NULL),
(41, '<h1><strong>Korupsi Rp 1,6 Triliun, Hukuman Pengusaha Ini Dilipatgandakan MA</strong><br />\r\n<br />\r\n<br />\r\n&nbsp;</h1>', '<p>Andi Saputra - detikNews<br />\r\nJumat, 17 Des 2021 08:42 WIB<br />\r\n<br />\r\nJakarta - Mahkamah Agung (MA) melipatgandakan hukuman pengusaha Irianto dari 3 tahun penjara menjadi 10 tahun penjara. Irianto selaku Direktur Peter Garmindo Prima menyuap petugas bea cukai sehingga impor tekstil membanjiri Indonesia dengan kerugian mencapai Ro 1,6 triliun.<br />\r\nKasus itu terjadi pada 2018-2020. Irianto menyuap Kepala Bidang Pelayanan Fasilitas Kepabeanan dan Cukai (PFPC) Batam, Mokhammad Mukhlas dkk. Sehingga petugas membiarkan tekstil melebihi jumlah yang ditentukan dalam Persetujuan Impor Tekstil dan Produk Tekstil (PI-TPT). Sebelum tekstil impor memasuki Kawasan Bebas Batam (Free Trade Zone), komplotan ini mengubah dan memperkecil data angka (kuantitas) yang tertera dalam dokumen packing list dengan besaran 25-30 persen. PN Jakpus akhirnya menjatuhkan hukuman 3 tahun penjara kepada Irianto. Hukuman itu dikuatkan di tingkat banding. Jaksa yang menuntut 8 tahun penjara tidak terima dan mengajukan kasasi. Apa kata MA?<br />\r\n<br />\r\n&quot;Menjatuhkan pidana terhadap Terdakwa dengan pidana penjara selama 10 (sepuluh) Tahun dan denda sebesar Rp200.000.000 jika denda tidak dibayar maka diganti dengan pidana kurungan selama 4 (empat) bulan,&quot; kata juru bicara MA, hakim agung Andi Samsan Nganro kepada detikcom, Jumat (17/12/2021). Duduk sebagai ketua majelis Sofyan Sitompul dengan anggota Gazalba Saleh dan Sinintha Yuliansih Sibarani. Majelis dengan bulat menyatakan Terdakwa telah terbukti secara sah dan meyakinkan bersalah melakukan tindak pidana &#39;korupsi secara bersama-sama; sebagaimana didakwakan dalam dakwaan Kesatu Primair Pasal 2 ayat (1) Jo. Pasal 18 UU RI No 31 Tahun 1999 Tentang Pemberantasan Tindak Pidana Korupsi sebagaimana telah diubah dengan UU RI No 20 Tahun 2001 Tentang Perubahan atas UU RI No 31 Tahun 1999 Tentang Pemberantasan Tindak Pidana Korupsi Jo Pasal 55 ayat (1) ke 1 KUHPidana dan dakwaan Kedua Pasal 5 ayat (1) huruf a Undang-Undang No 31 Tahun 1999 tentang Pemberantasan Tindak Pidana Korupsi sebagaimana telah diubah dengan Undang-Undang No 20 Tahun 2001 tentang Perubahan atas Undang- Undang No 31 Tahun 1999 Tentang Pemberantasan Tindak Pidana Korupsi.<br />\r\n<br />\r\n&quot;Pertimbangannya, Terdakwa telah pula memberikan sejumlah uang kepada MOkhamad Mukhlas, Hariyonadi Wibowo, Dedi Aldrian dan Kamar Siregar, yang bertugas sebagai Pejabat Bea dan Cukai pada Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam yang memiliki kewenangan melaksanakan kebijakan pemerintah dalam mengawasi lalu lintas barang impor (dalam hal ini tekstil), dengan memberi uang sebesar Rp 5.000.000 per/kontainer tekstil impor kepada Pejabat Bea Cukai Batam tersebut, dengan total sejumlah Rp 1.950.000.000 dari 390 kontainer tekstil impor dengan maksud Terdakwa Drs. Irianto selaku importir mendapat keuntungan berupa mengimpor tekstil dari negara China melalui kawasan Bebas Batam ke Pelabuhan Tanjung Priok di Jakarta,&quot; kata Andi membacakan pertimbangan majelis.<br />\r\nAkibat perbuatan di atas, maka tekstil China membanjiri Indonesia.<br />\r\n<br />\r\n<!--[if !supportLineBreakNewLine]--><br />\r\n<!--[endif]--></p>\r\n\r\n<p>&nbsp;</p>', '1639706797.jpeg', 1, 'id', 48, '2021-12-16 19:06:37', '2021-12-16 19:06:37', NULL),
(42, '<h1>&#39;Angin Segar&#39; dari Luhut, Belum Ada Peningkatan Kasus COVID-19 RI Akibat Omicron<br />\r\n<br />\r\n&nbsp;</h1>', '<p>Jakarta - Pemerintah kembali melaporkan kasus baru sebanyak 27 kasus, yang dirawat di Wisma Atlet dan RSPI Sulianti Saroso. Sehingga kini total varian Omicron di Indonesia sudah mencapai 46 kasus.<br />\r\nMeski jumlahnya bertambah, koordinator PPKM Jawa Bali Luhut Binsar Pandjaitan menegaskan sampai saat ini kasus COVID-19 di RI masih relatif rendah. Belum terlihat adanya peningkatan akibat varian Omicron.<br />\r\n<br />\r\n&quot;Kasus masih rendah, belum terlihat adanya indikasi peningkatan kasus akibat gelombang Omicron,&quot; tegas Luhut dalam konferensi pers virtual, Senin (27/12/2021).<br />\r\nSelain itu, ia juga menegaskan tingkat perawatan di rumah sakit masih terkendali dengan baik. Hal ini juga terjadi pada angka kematian pasien COVID-19.<br />\r\n<br />\r\nAgar kasus tetap terkendali, Luhut meminta testing dan tracing terus diperkuat. Ia juga mengatakan lockdown di level mikro yang dilakukan di Wisma Atlet saat ini juga membantu untuk mengendalikan penularan tidak meluas.<br />\r\n<br />\r\nLuhut mengungkapkan saat ini mayoritas pasien varian Omicron masih ditempatkan di Wisma Atlet. Ia pun menegaskan belum melihat adanya tanda-tanda perkembangan kasus akibat kehadiran varian Omicron.<br />\r\n<br />\r\n&quot;Melalui testing dan tracing yang kuat, lalu lockdown di level mikro seperti yang dilakukan di Wisma Atlet, dapat kita implementasikan seandainya terjadi transmisi lokal varian Omicron yang sudah terdeteksi,&quot; jelas Luhut.<br />\r\n<br />\r\n&quot;Jadi, kita melihat sekarang begitu kita tempatkan semua di lockdown di Wisma Atlet kelihatan tidak berkembang. Tapi masih kita tidak tahu apa dari daerah lain ada yg masuk atau yang lolos dari sini,&quot; pungkasnya.<br />\r\n<br />\r\n&nbsp;</p>', '1640570012.jpeg', 7, 'id', 48, '2021-12-26 18:53:32', '2021-12-26 18:53:32', NULL),
(43, '<h1><strong>Tak Bayar Pajak Kendaraan Karena Samsat Tutup, Apa Tetap Ditilang?</strong><br />\r\n<br />\r\n<br />\r\n<br />\r\n&nbsp;</h1>', '<p>Jakarta - Tertib administrasi, termasuk membayar pajak harus diperhitungkan jauh-jauh hari. Tapi bilamana ternyata kantor pelayanan pajak tutup pada saat jatuh tempo, apakah pengendara tetap ditilang?<br />\r\nHal itu menjadi pertanyaan pembaca detik&#39;s Advocate yang dikirim ke email: redaksi@detik.com dan di-cc ke andi.saputra@detik.com.<br />\r\n<br />\r\nPenanya mengaku kantor Samsat tutup karena ada libur. Padahal di waktu bersamaan, sepeda motornya jatuh tempo pajak. Dia lantas bingung apakah dirinya akan kena tilang, meskipun merasa kesalahan bukan ada pada dirinya.<br />\r\n<br />\r\nSebelumnya kami sampaikan di dalam STNK terdapat 2 Jenis pajak yaitu pajak tahunan kendaraan serta pajak stnk yang dibayarkan setiap 5 tahun sekali (Pajak STNK). Merujuk kepada kronologis yang Saudara(i) sampaikan, Kami asumsikan pajak yang telah jatuh tempo yaitu pajak tahunan yang dibayarkan setiap setahun sekali.<br />\r\n<br />\r\nMelihat ketentuan pasal 68 ayat (1) Undang-Undang No. 22 Tahun 2009 Tentang Lalu Lintas dan Angkutan Jalan (LLAJ) menyatakan :<br />\r\n<br />\r\n&quot;Setiap kendaraan bermotor yang dioperasikan dijalan wajib dilengkapi dengan STNK dan Tanda Nomor Kendaraan bermotor&quot;<br />\r\n<br />\r\nHal ini menjelaskan kewajiban pengendara kendaraan bermotor apabila berpergian menggunakan kendaraan wajib untuk membawa STNK. STNK yang dimaksud adalah STNK yang sah secara hukum (Masih berlaku).<br />\r\n<br />\r\nPengesahan terhadap STNK dilakukan setiap sekali setahun dengan membayar pajak atas kendaraan bermotor yang saudara(i) miliki, hal ini telah dijelaskan didalam pasal 70 ayat (2) Undang-Undang No. 22 Tahun 2009 Tentang Lalu Lintas dan Angkutan Jalan (LLAJ) menyatakan :<br />\r\n<br />\r\n&quot;STNK dan Tanda Nomor Kendaraan bermotor berlaku selama 5 (lima) tahun, yang harus dimintakan pengesahan setiap tahun.&quot;<br />\r\n<br />\r\n<br />\r\n&nbsp;</p>', '1640657926.jpg', 1, 'id', 48, '2021-12-27 19:18:46', '2021-12-27 19:18:46', NULL);
INSERT INTO `news` (`id`, `title`, `text`, `img_title`, `news_category_id`, `location`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(44, '<h1>Menteri ESDM Positif Covid, Bahlil Lahadalia Jadi Ad Interim<br />\r\nCNN Indonesia<br />\r\n<!--[if !supportLineBreakNewLine]--><br />\r\n<!--[endif]--></h1>', '<p>Sabtu, 05 Feb 2022 07:48 WIB<br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Jakarta, CNN Indonesia -- Menteri ESDM&nbsp;Arifin Tasrif positif terinfeksi Covid-19. Presiden Joko Widodo pun menunjuk Menteri Investasi Bahlil Lahadalia&nbsp;menjadi menteri ad interim hingga Arifin pulih.<br />\r\nPenunjukan Bahlil sebagai Menteri ESDM ad interim didasarkan surat Kementerian Sekretariat Negara pada 3 Februari 2022.<br />\r\n<br />\r\nBaca artikel CNN Indonesia &quot;Menteri ESDM Positif Covid, Bahlil Lahadalia Jadi Ad Interim&quot; selengkapnya di sini:&nbsp;<a href=\"https://www.cnnindonesia.com/ekonomi/20220205073839-85-755345/menteri-esdm-positif-covid-bahlil-lahadalia-jadi-ad-interim\">https://www.cnnindonesia.com/ekonomi/20220205073839-85-755345/menteri-esdm-positif-covid-bahlil-lahadalia-jadi-ad-interim</a>.<br />\r\n&nbsp;</p>', '1644033920.jpeg', 1, 'id', 50, '2022-02-04 21:05:20', '2022-02-04 21:05:20', NULL),
(45, '<h1>Ketua Komisi VI DPR Minta Satgas Pangan Tertibkan Harga Minyak Goreng</h1>', '<p>Jakarta - Ketua Komisi VI DPR Faisol Riza meminta Satgas Pangan turun tangan untuk menertibkan harga minyak goreng yang masih beragam di pasar. Faisol menilai pengawasan ketat perlu dilakukan agar tak ada celah bagi oknum yang ingin berbuat curang.<br />\r\n&quot;Kita tunggu sampai minggu depan dan saya kira perlu Satgas Pangan turun ke lapangan supaya bisa menertibkan harga minyak goreng yang berbeda-beda ini. Jadi kalau mereka turun saya kira masyarakat akan lebih tenang dan para penjual juga bisa diminta untuk menyeragamkan harga,&quot; kata Faisol kepada wartawan, Minggu (6/2/2022).<br />\r\n<br />\r\n&nbsp;</p>', '1644200598.jpeg', 1, 'id', 50, '2022-02-06 19:23:18', '2022-02-06 19:23:18', NULL),
(46, '<h1><strong>PPKM Level 3 Jabodetabek: Stasiun Ramai, Kursi KRL Penuh</strong><br />\r\nCNN Indonesia<br />\r\nSelasa, 08 Feb 2022 08:34 WIB<br />\r\n<!--[if !supportLineBreakNewLine]--><br />\r\n<!--[endif]--></h1>', '<p>Jakarta, CNN Indonesia -- Sejumlah stasiun dan Kereta Rel Listrik (KRL) commuterline ramai penumpang di hari pertama penerapan Pemberlakuan Pembatasan Kegiatan Masyarakat (PPKM) level 3 Jabodetabek, Selasa (8/2).<br />\r\nPantauan CNNIndonesia.com di Stasiun Bogor, Jawa Barat, sejak pukul 06.45 WIB, keramaian penumpang sudah tampak dari gerbang masuk stasiun, penumpang terus berdatangan. Sebelum memasuki kereta, penumpang diminta mengantre, mereka baru boleh masuk ke peron saat kereta telah tersedia.<br />\r\n<br />\r\nDi dalam KRL tujuan Jakarta Kota, kepadatan penumpang pun terlihat, kursi panjang yang maksimal terisi empat orang, terisi semua. Kursi prioritas yang maksimal diisi dua orang, juga terlihat diisi penuh.</p>\r\n\r\n<p>Kepadatan juga tampak di kereta tujuan Jatinegara. Banyak penumpang yang harus berdiri karena tidak kebagian tempat duduk.<br />\r\n<br />\r\nSalah seorang penumpang kereta, Tri Putri (29) mengaku belum diminta kantornya untuk work from home (WFH) di penerapan PPKM Level 3, karena itu, ia pun masih berangkat kerja pada hari ini.<br />\r\n<br />\r\n&quot;Ini ramai (KRL) kayak biasa. Belum ada WFH, ini masih masuk,&quot; katanya.<br />\r\n<br />\r\nMengutip akun twitter resmi KAI Commuter, pada Selasa (7/2) pagi, sejumlah stasiun juga dilaporkan ramai, salah satunya adalah Stasiun Citayam.<br />\r\n<br />\r\n&quot;RekanCommuters Pantauan saat ini di St. Citayam pkl. 07.00 WIB flow penumpang terpantau ramai,&quot; tulis akun @commuterline.<br />\r\n<br />\r\nSementara itu, VP Corporate Secretary KAI Commuter Anne Purba mengatakan pihaknya konsisten menerapkan protokol kesehatan bagi pengguna dengan wajib menunjukkan sertifikat vaksin sebelum naik KRL, hingga penggunaan masker ganda atau masker yang sesuai ketentuan.<br />\r\n<br />\r\n&quot;Sejumlah larangan lainnya, seperti anak balita dilarang naik KRL kecuali untuk keperluan medis, pembatasan waktu bagi lansia untuk naik KRL hanya diperbolehkan pukul 10.00-14.00 WIB masih diberlakukan,&quot; kata Anne.<br />\r\n<br />\r\n<br />\r\nBaca artikel CNN Indonesia &quot;PPKM Level 3 Jabodetabek: Stasiun Ramai, Kursi KRL Penuh&quot; selengkapnya di sini:&nbsp;<a href=\"https://www.cnnindonesia.com/nasional/20220208082719-20-756294/ppkm-level-3-jabodetabek-stasiun-ramai-kursi-krl-penuh\">https://www.cnnindonesia.com/nasional/20220208082719-20-756294/ppkm-level-3-jabodetabek-stasiun-ramai-kursi-krl-penuh</a>.<br />\r\n<br />\r\nDownload Apps CNN Indonesia sekarang https://app.cnnindonesia.com/</p>\r\n\r\n<p>&nbsp;</p>', '1644284551.jpeg', 3, 'id', 50, '2022-02-07 18:42:31', '2022-02-07 18:42:31', NULL),
(47, '<h1>KPK Telisik Aliran Uang dari ASN ke Eks Bupati Buru Selatan Tagop<br />\r\n<br />\r\n&nbsp;</h1>', '<p>Jakarta - KPK telah memeriksa sembilan saksi terkait kasus dugaan suap mantan Bupati Buru Selatan, Tagop Sudarsono Soulisa. KPK mengkonfirmasi para saksi soal aliran uang Tagop yang berasal dari pengerjaan proyek serta dari para ASN di Pemkab Buru Selatan.<br />\r\n&quot;Para saksi hadir dan dikonfirmasi antara lain mengenai dugaan aliran uang yang diterima oleh tersangka TSS (Tagop) dari berbagai proyek maupun adanya permintaan tersangka TSS dari para ASN di Pemkab Buru Selatan,&quot; kata Plt Juru Bicara KPK Ali Fikri kepada wartawan, Senin (14/3/2022).<br />\r\n<br />\r\n<br />\r\n<br />\r\nPara saksi diperiksa pada Jumat (11/3) di Kantor Mako Sat Brimobda Polda Maluku. Saksi itu di antaranya:<br />\r\n<br />\r\n1. Dominggus Junydi Seleky (Kabid Anggaran BPKAD Kab Buru Selatan)<br />\r\n2. Merill Leiwakabessy (Pensiunan Direktur PT Mutu Utama Konstruksi 2006 -2018)<br />\r\n3. Semuel R Teslatu (Kabag Umum Sekretariat Daerah Kab Buru Selatan)<br />\r\n4. S. Husein Alaydrus (PNS UKPBJ Kabupaten Buru Selatan)<br />\r\n5. Roy Agustinus Lesnussa (Bendahara Bagian Perekonomian dan SDA Kabupaten Buru Selatan)<br />\r\n6. Slamet Pujianto (PNS UKPBJ Kabupaten Buru Selatan)<br />\r\n7. Ir. Syahroel A. E. Pawa (Mantan Kepala Bappeda dan Mantan Kadis PU)<br />\r\n8. La Amin (Karyawan PLN Namrole)<br />\r\n9. Aji Titawael (Kasubag Perencanaan Dinas Pendidikan Kabupaten Buru Selatan).<br />\r\n<br />\r\nBaca artikel detiknews, &quot;KPK Telisik Aliran Uang dari ASN ke Eks Bupati Buru Selatan Tagop&quot; selengkapnya&nbsp;<a href=\"https://news.detik.com/berita/d-5981676/kpk-telisik-aliran-uang-dari-asn-ke-eks-bupati-buru-selatan-tagop\">https://news.detik.com/berita/d-5981676/kpk-telisik-aliran-uang-dari-asn-ke-eks-bupati-buru-selatan-tagop</a>.<br />\r\n<br />\r\nDownload Apps Detikcom Sekarang https://apps.detik.com/detik/</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '1647223470.jpeg', 1, 'id', 50, '2022-03-13 19:04:30', '2022-03-13 19:04:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news_category`
--

CREATE TABLE `news_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150)  NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `news_category`
--

INSERT INTO `news_category` (`id`, `name`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Finance', 1, NULL, NULL, NULL),
(2, 'Bisnis', 1, NULL, NULL, NULL),
(3, 'Politic', 1, '2020-08-05 12:52:22', '2020-08-05 12:52:22', NULL),
(5, 'Transportation', 1, '2020-10-23 23:47:22', '2020-10-23 23:47:22', NULL),
(6, 'Sport', 1, '2020-10-23 23:53:20', '2020-10-23 23:53:20', NULL),
(7, 'healt', 48, '2020-11-17 19:48:22', '2020-11-17 19:48:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news_image`
--

CREATE TABLE `news_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(250)  NOT NULL,
  `news_id` bigint(11) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255)  NOT NULL,
  `token` varchar(255)  NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayaran`
--

CREATE TABLE `pelayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_pelayaran` varchar(10)  NOT NULL,
  `name_pelayaran` varchar(50)  NOT NULL,
  `alias` varchar(50)  NOT NULL,
  `address` longtext  NOT NULL,
  `id_city` int(11) DEFAULT NULL,
  `city` varchar(250)  NOT NULL,
  `province` varchar(250)  NOT NULL,
  `postal` varchar(11)  NOT NULL,
  `telp` varchar(20)  NOT NULL,
  `fax` varchar(20)  NOT NULL,
  `npwp` varchar(50)  NOT NULL,
  `pkp_no` varchar(50)  NOT NULL,
  `desc_pelayaran` longtext  DEFAULT NULL,
  `payment_term` int(11) NOT NULL,
  `name_person` varchar(50)  NOT NULL,
  `phone_person` varchar(50)  NOT NULL,
  `email_person` varchar(30)  NOT NULL,
  `fax_person` varchar(30)  NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `pelayaran`
--

INSERT INTO `pelayaran` (`id`, `code_pelayaran`, `name_pelayaran`, `alias`, `address`, `id_city`, `city`, `province`, `postal`, `telp`, `fax`, `npwp`, `pkp_no`, `desc_pelayaran`, `payment_term`, `name_person`, `phone_person`, `email_person`, `fax_person`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'P0001', 'Indo Countainer Line, PT', 'ICON', 'Jalan Kesana Kemari no 098 Jakarta Selatan', 3, '', '', '80234', '0214356764', '0214356764', '71.2112.1121.1.111', '980', 'Pelayaran Desc', 14, 'Aji', '08767676744', '08767676744', '0361654433', '2020-08-01 11:44:11', '2020-08-20 23:06:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `detail_id` text NOT NULL,
  `detail_en` text DEFAULT NULL,
  `img_title` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`id`, `title`, `detail_id`, `detail_en`, `img_title`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Port to Port', '<p>Port to Port dapat diartikan dimana shipper atau pengirim barang mengantarkan barang kirimannya ke perusahaan pengiriman yang telah ditunjuk ditempat asal shipper, dan dikirim ke port penerima barang. Serta penerima barang atau consignee tersebut juga mengambil sendiri di port yang telah ditentukan oleh consignee sendiri.</p>', '<p>Port to Port can be defined as where the shipper or sender of goods delivers their shipment to the delivery company that has been appointed at the place of origin of the shipper, and sent to the port of the consignee. And the consignee or consignee also picks up himself at the port that has been determined by the consignee himself.</p>', '1605234377.jpg', 2, '2021-11-11 04:45:28', '2021-11-11 04:45:28', NULL),
(2, 'Door to Door', '<p>Door to Door service dalam dunia cargo merupakan sebuah layanan dengan metode pengiriman sebuah barang akan dijemput atau di-pickup pada lokasi pengirim dan diantar menuju lokasi penerima barang atau consignee.</p>', '<p>Door to Door service in the world of cargo is a service in which an item will be picked up or picked up at the sender&#39;s location and delivered to the consignee&#39;s location.</p>', '1605148003.jpg', 48, '2020-11-12 02:26:43', '2020-11-12 02:26:43', NULL),
(3, 'Less Container Loaded (LCL)', '<p>Less Container Loaded merupakan jenis pengiriman barang tanpa menggunakan container dengan kata lain parsial. Jika kita menggunakan jenis pengiriman Less Container Loaded, maka barang yang kita kirim itu ditujukan ke Gudang penumpukan dari shipping agent. Lalu dari pihak Gudang tersebut akan mengumpulkan barang-barang kiriman Less Container Loaded lain hingga memenuhi quota untuk di-loading / di-muat ke dalam container.</p>', '<p>Less Container Loaded is a type of delivery without using a container, in other words, partial. If we use the Less Container Loaded shipping type, then the goods we send are addressed to the storage warehouse from the shipping agent. Then the warehouse will collect other Less Container Loaded shipments to meet the quota to be loaded / loaded into the container.</p>', '1605668365.JPG', 48, '2020-11-18 02:59:25', '2020-11-18 02:59:25', NULL),
(4, 'International Shipment', '<p>International Shipment adalah istilah yang digunakan untuk menggambarkan pengiriman paket atau kelompok pengiriman paket dimana paket tersebut diambil dari satu negara dan dikirim ke alamat di negara lain.</p>', '<p>International Shipment is a term used to describe package delivery or group delivery of parcels where packages are picked up from one country and sent to an address in another country.</p>', '1605668420.jpg', 48, '2020-11-18 03:00:20', '2020-11-18 03:00:20', NULL),
(5, 'Perusahaan Bongkar Muat ( PBM )', '<p>Pendistribusian barang semakin besar peminatnya seiring pertumbuhan ekonomi di Indonesia yang sudah sangat maju. Ekosistem logistik membutuhkan jasa untuk angkutan truk sebagai alat transportasi untuk pengiriman barang.<a href=\"https://kargo.tech/shipper/\">&nbsp;Pengiriman barang&nbsp;</a><em><a href=\"https://kargo.tech/shipper/\">trucking</a>&nbsp;</em>dipilih karena metode ini cukup fleksibel, efisien, dan, mudah untuk di tracking serta harganya yang sesuai.</p>', '<p>The distribution of goods is getting bigger and bigger in line with the economic growth in Indonesia, which is already very advanced. The logistics ecosystem requires services for trucking as a means of transportation for the delivery of goods. Trucking goods delivery was chosen because this method is quite flexible, efficient, and easy to track and the price is appropriate.</p>', '1636601965.jpg', 48, '2021-11-11 03:39:25', '2021-11-11 03:39:25', NULL),
(6, 'Perusahaan Bongkar Muat ( PBM )', '<p>Truk trailer memiliki bobot muatan bisa lebih berat dan juga semakin besar. Dalam sekali pengiriman barang, truk trailer bisa membawa muatan 20 sampai 60 ton.</p>', '<p>The trailer truck has a payload weight that can be heavier or larger. In one delivery, the trailer truck can carry a load of 20 to 60 tons.</p>', '1636602508.jpg', 48, '2021-11-11 03:48:28', '2021-11-11 03:48:28', NULL),
(7, 'Perusahaan Bongkar Muat ( PBM )', '<p>Forklift adalah mobil berjalan atau kendaraan yang memiliki 2 garpu yang bisa digunakan untuk mengangakat pallet. Garpu forklift pada umumnya kompatibel dengan pallet yang beredar di pasaran, untuk menunjang kegiatan bongkar muat PT. BAHTERA SETIA&nbsp; menyediakan persewaan beberapa unit forklif yang siap di Oprasionalkan dengan kondisi Unit yang selalu siap dan prima saat di gunakan untuk menunjang proses loading barang muatan.</p>', '<p>Forklift is a moving car or vehicle that has 2 forks that can be used to lift pallets. Forklift forks are generally compatible with pallets on the market, to support loading and unloading activities of PT. BAHTERA SETIA provides rental of several forklift units that are ready to be operational with the condition of the unit being always ready and primed when used to support the process of loading goods.</p>', '1636603042.jpg', 48, '2021-11-11 03:57:22', '2021-11-11 03:57:22', NULL),
(8, 'Perusahaan Bongkar Muat ( PBM )', '<p>Mobile Crane adalah alat pengangkat yang pada umumnya dilengkapi dengan drum tali baja, tali baja dan rantai yang dapat digunakan untuk mengangkat dan menurunkan material secara vertikal dan memindahkannya secara horizontal.</p>', '<p>Mobile Crane is a lifting device which is generally equipped with a steel rope drum, steel rope and chain that can be used to lift and lower material vertically and move it horizontally.</p>', '1636603485.jpg', 48, '2021-11-11 04:04:45', '2021-11-11 04:04:45', NULL),
(10, 'Perusahaan Bongkar Muat ( PBM )', '<p>Kapal tunda adalah kapal yang dapat digunakan untuk melakukan manuver / pergerakan, utamanya menarik atau mendorong kapal lainnya di pelabuhan, laut lepas atau melalui sungai atau terusan. Kapal tunda digunakan pula untuk menarik tongkang, kapal rusak, dan peralatan lainnya. PT BAHTERA SETIA menyediakan kapal tunda untuk menarik muatan dengan bebagai jenis barang muatan dengan sistem<strong> PORT TO PORT</strong> maupun<strong> DOOR TO DOOR</strong></p>', '<p>A tugboat is a ship that can be used to maneuver / move, mainly towing or pushing other ships in ports, high seas or through rivers or canals. Tugboats are also used to tow barges, damaged ships, and other equipment</p>', '1636615627.jpg', 48, '2021-11-11 07:27:07', '2021-11-11 07:27:07', NULL),
(11, 'Perusahaan Bongkar Muat ( PBM )', '<p>kapal yang dengan lambung datar atau suatu kotak besar yang mengapung, digunakan untuk mengangkut barang dan ditarik dengan kapal tunda atau dengan mesin pendorong digunakan untuk mengangkut dan membawa muatan.</p>', '<p>a ship with a flat hull or a large floating box, used to transport goods and towed by tugboats or by propulsion engines used to transport and carry cargo.</p>', '1636615886.jpg', 48, '2021-11-11 07:31:26', '2021-11-11 07:31:26', NULL),
(12, 'KEAGENAN PENGURUSAN DOKUMEN KAPAL', '<p>Keagenan kapal merupakan pelayanan jasa yang dilakukan untuk mewakili Perusahaan Angkutan Laut Nasional dan/atau Perusahaan Angkutan Laut Asing dalam rangka mengurus kepentingan kapal Perusahaan Angkutan Laut Nasional dan/atau kapal Perusahaan Angkutan Laut Asing selama berada di Indonesia.</p>', '<p>Ship agency is a service that is carried out to represent the National Sea Transportation Company and/or Foreign Sea Transportation Company in order to manage the interests of the National Sea Transportation Company vessels and/or foreign Sea Transportation Company vessels while in Indonesia.</p>', '1636944971.jpg', 48, '2021-11-15 02:57:48', '2021-11-15 02:57:48', NULL),
(13, 'Perusahaan Pelayaran ( PELRA )', '<p>Pelayaran rakyat adalah pelayaran atau usaha angkutan laut yang melayani perangkutan antar pelabuhan dan menggunakan perahu layar Motor (PLM), Kapal Layar Motor (KLM) dan Kapal Motor (KM). Pelayaran rakyat adalah salah satu bentuk pelayaran antar pulau dan pantai. Ciri pelayaran rakyat menggunakan kapal &ndash; kapal atau perahu yang terbuat dari kayu dan menggunakan layar.</p>', '<p>Public shipping is a shipping or sea transportation business that serves transportation between ports and uses motorized sailing boats (PLM), Motorized Sailing Boats (KLM) and Motorized Ships (KM). People&#39;s shipping is one form of shipping between islands and the coast. Characteristics of people&#39;s shipping using ships or boats made of wood and using sails.</p>', '1636945038.jpg', 48, '2021-11-15 02:57:18', '2021-11-15 02:57:18', NULL),
(14, 'GALANGAN KAPAL', '<p>PERSEROAN TERBATAS BAHTERA SETIA GROUP</p>\r\n\r\n<p>MERUPAKAN perusahaan nasional yang bergerak di bidang jasa pembangunan dan perbaikan kapal laut, Dalam operasinya perusahaan ini membuat berbagai jenis kapal seperti kapal Coaster Cargo Ships, Passenger Vessel Ferries, Tugs dan Barges, Tankers, Patrol Boats, Dredgers dan Special Purpose Vessel.</p>', NULL, '1644033150.jpg', 50, '2022-02-05 03:52:30', '2022-02-05 03:52:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider_home`
--

CREATE TABLE `slider_home` (
  `id` int(11) NOT NULL,
  `img_title` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
);

--
-- Dumping data untuk tabel `slider_home`
--

INSERT INTO `slider_home` (`id`, `img_title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, '1605333151.jpg', '2020-11-14 05:52:31', '2020-11-14 05:52:31', NULL),
(17, '1605494880.jpg', '2020-11-16 02:48:00', '2020-11-16 02:48:00', NULL),
(18, '1605508037.jpg', '2020-11-16 06:27:17', '2020-11-16 06:27:17', NULL),
(19, '1605499270.jpg', '2020-11-16 04:01:10', '2020-11-16 04:01:10', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelayaran_id` int(11) NOT NULL,
  `id_city` int(11) DEFAULT NULL,
  `city` varchar(250)  NOT NULL,
  `province` varchar(250)  NOT NULL,
  `price` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `pic_pelayaran` varchar(100)  NOT NULL,
  `last_price1` bigint(20) NOT NULL DEFAULT 0,
  `last_price2` bigint(20) NOT NULL DEFAULT 0,
  `last_price3` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id`, `pelayaran_id`, `id_city`, `city`, `province`, `price`, `date`, `pic_pelayaran`, `last_price1`, `last_price2`, `last_price3`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '', '', 6900000, '2020-08-02 00:00:00', 'Bastian', 7000000, 6800000, 7100000, '2020-08-21 04:49:10', '2020-08-21 04:49:10', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(150) NOT NULL,
  `testimoni` text NOT NULL,
  `img_testimoni` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
);

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id`, `name`, `position`, `testimoni`, `img_testimoni`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Marina', 'Direktur Utama Andalus', '<p>Kami telah bekerjasama dengan PT. BAHTERA SETIA selama kurang lebih 24 tahun, dan saya salut dengan pelayanan yang diberikan oleh PT. BAHTERA SETIA karena kesigapannya merespon. juga memiliki banyak rute dan yang terpenting saya bisa memonitor pengiriman saya kapanpun dan dimanapun jadi lebih tenang. Semoga kedepan PT. BAHTERA SETIA semakin maju</p>', '1603521416.jpg', 48, '2020-10-24 06:36:56', '2020-10-24 06:36:56', NULL),
(2, 'Fahmi Akbar Pasetya', 'Direktur Utama PNM', 'Kami telah bekerjasama dengan PT. BAHTERA SETIA selama kurang lebih 24 tahun, dan saya salut dengan pelayanan yang diberikan oleh PT. BAHTERA SETIA karena kesigapannya merespon. juga memiliki banyak rute dan yang terpenting saya bisa memonitor pengiriman saya kapanpun dan dimanapun jadi lebih tenang. Semoga kedepan PT. BAHTERA SETIA semakin maju', 'bp5ae2s20181119-81050-400x300.jpeg', 1, '2020-09-07 14:23:20', NULL, NULL),
(3, 'Fahmi Akbar Pasetya', 'Direktur Utama PNM', 'Kami telah bekerjasama dengan PT. BAHTERA SETIA selama kurang lebih 24 tahun, dan saya salut dengan pelayanan yang diberikan oleh PT. BAHTERA SETIA karena kesigapannya merespon. juga memiliki banyak rute dan yang terpenting saya bisa memonitor pengiriman saya kapanpun dan dimanapun jadi lebih tenang. Semoga kedepan PT. BAHTERA SETIA semakin maju', 'bp5ae2s20181119-81050-400x300.jpeg', 1, '2020-09-07 14:23:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tracking`
--

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `longitude` varchar(25) NOT NULL,
  `latitude` varchar(25) NOT NULL,
  `description` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `tracking`
--

INSERT INTO `tracking` (`id`, `transaction_id`, `longitude`, `latitude`, `description`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, '112.734736', '-7.198816', 'Masih dalam pelayaran dari Pelabuhan Tanjung Perak Surabaya Jawa Timur', '2020-09-20 09:44:23', '2020-09-20 21:02:36', '2020-09-30 11:41:16'),
(2, 1, '115.210980', '-8.746139', 'Telah sampai di Pelabuhan Benoa Bali', '2020-09-22 09:44:23', '2020-09-22 21:02:36', '2020-09-30 11:41:16'),
(3, 1, '118.979291', '-5.962502', 'Posisi di Laut Makassar akan bersandar di Pelabuhan Makassar', '2020-09-26 09:44:23', '2020-09-26 21:04:43', '2020-09-30 11:41:16'),
(4, 8, '115.2091981', '-8.7451341', 'Bersandar Pelabuhan Benoa Bali', '2020-09-29 09:40:22', '2020-09-30 03:41:26', '2020-09-30 03:56:15'),
(5, 11, '115.2091981', '-8.7451341', 'Posisi di Laut Makassar akan bersandar di Pelabuhan Makassar', '2020-10-24 01:51:22', '2020-10-24 05:58:47', '2020-10-24 06:02:21'),
(6, 21, '112.239088', '-7.535891', 'di dermaga', '2020-12-21 12:03:02', '2020-12-21 05:05:44', '2020-12-21 05:05:44'),
(7, 23, '112.239088', '-7.535891', 'muat pupuk', '2021-01-09 11:28:06', '2021-01-09 04:29:21', '2021-01-09 04:40:37'),
(8, 23, '112.6242163', '-7.2351176', 'laut maluku', '2021-01-10 11:41:20', '2021-01-09 04:44:14', '2021-01-09 04:44:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_no` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_no` varchar(20) DEFAULT NULL,
  `loading_date` datetime DEFAULT NULL,
  `location_from` varchar(250) NOT NULL,
  `location_to` varchar(250) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `vendor_truck_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `pelayaran_id` int(11) DEFAULT NULL,
  `resi_no` bigint(12) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `trans_no`, `customer_id`, `shipping_no`, `loading_date`, `location_from`, `location_to`, `agent_id`, `vendor_truck_id`, `location_id`, `pelayaran_id`, `resi_no`, `status`) VALUES
(1, 'TR2020090001', 5, '1', '2020-09-29 20:56:51', '', '', 1, 1, 2, 1, 123456789012, 0),
(8, 'TR2020090002', 5, '12345', '2020-09-28 00:00:00', '', '', 1, 3, 3, 1, 181292669100, 0),
(9, 'TR2020090003', 5, NULL, '2020-09-30 00:00:00', '', '', NULL, NULL, 1, NULL, 166386482400, 0),
(10, 'TR2020090004', 5, NULL, '2020-09-29 00:00:00', '', '', NULL, NULL, 3, NULL, 19969298400, 0),
(11, 'TR2020100005', 31, NULL, '2020-10-24 00:00:00', '', '', NULL, NULL, 1, NULL, 158489259800, 0),
(12, 'TR2020100006', 31, NULL, '2020-10-24 00:00:00', '', '', NULL, NULL, 1, NULL, 155858176900, 0),
(13, 'TR2020100007', 31, NULL, '2020-10-31 00:00:00', 'Surabaya', 'Balikpapan', NULL, NULL, NULL, NULL, 201024044385, 0),
(14, 'TR2020100008', 5, NULL, '2020-11-01 00:00:00', 'Denpasar Bali', 'Surabaya Jawa timur', NULL, NULL, NULL, NULL, 201059395981, 0),
(15, 'TR2020110009', 35, NULL, NULL, 'Surabaya', 'Tokyo', NULL, NULL, NULL, NULL, 201131926530, 0),
(17, 'TR2020110010', 5, NULL, NULL, 'Denpasar Bali', 'Surabaya Jawa timur', NULL, NULL, NULL, NULL, 201161966131, 0),
(18, 'TR2020110011', 35, NULL, NULL, 'Surabaya', 'Balikpapan', NULL, NULL, NULL, NULL, 201151581018, 0),
(19, 'TR2020110012', 41, NULL, NULL, 'Surabaya', 'Balikpapan', NULL, NULL, NULL, NULL, 201183797993, 0),
(20, 'TR2020110013', 42, NULL, NULL, 'Surabaya', 'Tokyo', NULL, NULL, NULL, NULL, 201144152538, 0),
(21, 'TR2020120014', 43, NULL, NULL, 'surabaya', 'samarinda', NULL, NULL, NULL, NULL, 201299176201, 0),
(23, 'TR2021010002', 43, NULL, NULL, 'gresik', 'samarinda', NULL, NULL, NULL, NULL, 210187521742, 0),
(24, 'TR2021010003', 44, NULL, NULL, 'Surabaya', 'Makassar', NULL, NULL, NULL, NULL, 210168930892, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `consignee_id` int(11) DEFAULT NULL,
  `comodity` varchar(100) NOT NULL,
  `weight` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `package_unit` varchar(150) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `consignee` varchar(250) NOT NULL,
  `unit_weight` varchar(50) NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_id`, `consignee_id`, `comodity`, `weight`, `quantity`, `package_unit`, `length`, `width`, `height`, `volume`, `consignee`, `unit_weight`) VALUES
(1, 1, 1, 'Kayu Gelondongan', 500, 100, NULL, 10, 8, 5, 400, '', ''),
(2, 1, 2, 'Furniture', 20, 500, NULL, 2, 4, 3, 24, '', ''),
(7, 8, 1, 'Kayu Balok', 100, 100, 'Kayu', 15, 2, 1, 30, '', ''),
(8, 8, 1, 'Furniture Meja', 50, 200, 'Meja', 3, 2, 1, 6, '', ''),
(9, 9, 1, 'Kayu Balok 1', 50, 100, 'Kayu', 15, 1, 1, 15, '', ''),
(10, 9, 1, 'Kayu Balok 2', 100, 100, 'Kayu', 13, 2, 2, 52, '', ''),
(11, 9, 1, 'Kayu Balok 3', 54, 41, 'Kayu', 2, 4, 1, 8, '', ''),
(12, 10, 1, 'Kayu Balok 1', 50, 100, 'Kayu', 15, 1, 1, 15, '', ''),
(13, 10, 1, 'Kayu Balok 2', 10, 200, 'Kayu', 4, 3, 2, 24, '', ''),
(14, 11, 1, 'beras', 1000, 12, 'tonas', 1, 1, 1, 1, '', ''),
(15, 12, 1, 'beras', 1000, 12, 'tonas', 1, 1, 1, 1, '', ''),
(16, 13, NULL, 'beras', 1000, NULL, NULL, NULL, NULL, NULL, NULL, 'Bastian', 'ton'),
(17, 14, NULL, 'Beras', 150, NULL, NULL, NULL, NULL, NULL, NULL, 'Bapak Margono', 'kg'),
(18, 14, NULL, 'Meja', 100, NULL, NULL, NULL, NULL, NULL, NULL, 'Ibu Kamala', 'kubik'),
(19, 15, NULL, 'beras', 1000, NULL, NULL, NULL, NULL, NULL, NULL, 'Bastian', 'ton'),
(21, 17, NULL, 'Beras', 50, NULL, NULL, NULL, NULL, NULL, NULL, 'Bapak Margono Raharjo', 'kg'),
(22, 18, NULL, 'beras', 1000, NULL, NULL, NULL, NULL, NULL, NULL, 'Bastian', 'ton'),
(23, 19, NULL, 'beras', 1000, NULL, NULL, NULL, NULL, NULL, NULL, 'Bastian', 'kg'),
(24, 20, NULL, 'beras', 1000, NULL, NULL, NULL, NULL, NULL, NULL, 'Mitsubishi', 'ton'),
(25, 21, NULL, 'beras', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'budi kurniawan', 'ton'),
(26, 23, NULL, 'pupuk', 200, NULL, NULL, NULL, NULL, NULL, NULL, 'irham', 'ton'),
(27, 24, NULL, 'Pupuk', 10, NULL, NULL, NULL, NULL, NULL, NULL, 'Irham', 'ton');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trucking_type`
--

CREATE TABLE `trucking_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_trucking` varchar(50)  NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `trucking_type`
--

INSERT INTO `trucking_type` (`id`, `name_trucking`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '20 feets', '2020-08-01 17:46:07', NULL, '0000-00-00 00:00:00'),
(2, '40 feets', '2020-08-01 17:46:07', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255)  NOT NULL,
  `email` varchar(255)  NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255)  NOT NULL,
  `verification_code` varchar(255)  DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `role` varchar(25)  DEFAULT NULL,
  `remember_token` varchar(100)  DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `verification_code`, `is_verified`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bastian', 'bbaztanzi@gmail.com', '2020-07-23 05:09:52', '$2y$10$FQikHO2fLUeGkN3JS4zCyeuuuni6vcWCHYKDnPBeLTQ3ClKq159om', NULL, 0, NULL, NULL, '2020-07-23 05:07:52', '2020-07-23 05:07:52'),
(2, 'Andy Bastian', 'andybastian90@gmail.com', '2020-09-05 15:12:34', '$2y$10$x0tIfGVY.gGYkquTKgM.sOJ2msPApRNV/iIgHax06d5pk/rzXEzMS', NULL, 0, NULL, NULL, '2020-09-05 07:46:17', '2020-09-05 15:12:34'),
(48, 'bahtera', 'bahterasetia423@gmail.com', NULL, '$2y$10$QTNpsfzeTmxIozi9BbE90u5xlDuVrAG8MS5r920Ww39Au1Gfv8RIO', 'e8149b9f914c3e4638737702febbaef049cca0a6', 1, NULL, 'QxuDRBSRvb7JeijL5KAv7BzqLcOY33LLcExIVZubhFxbgOzyvKVbG7tVvSBM', '2020-10-23 19:09:00', '2021-11-03 23:25:51'),
(51, 'irham syah', 'irhamp12@gmail.com', NULL, '$2y$10$6S5wa9eBe2IOA2QrKXWl5uCTRQsGBNqxBQQhbVZySLUgVi2nA/9..', 'd9b053e7411c57f27b35c9d70083897b8dc6fbd8', 0, NULL, NULL, '2023-01-13 03:45:00', '2023-01-13 03:45:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor_truck`
--

CREATE TABLE `vendor_truck` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_vendor` varchar(10)  NOT NULL,
  `name_vendor` varchar(50)  NOT NULL,
  `address` longtext  NOT NULL,
  `telp` varchar(20)  NOT NULL,
  `payment_term` int(11) NOT NULL,
  `trucking_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB  ;

--
-- Dumping data untuk tabel `vendor_truck`
--

INSERT INTO `vendor_truck` (`id`, `code_vendor`, `name_vendor`, `address`, `telp`, `payment_term`, `trucking_type_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'V00043', 'Bumi Satria Persada, PT', 'Jakarta', '0219876789', 14, 1, '2020-08-01 17:50:34', NULL, NULL),
(2, 'V00043', 'Bumi Satria Persada, PT', 'Jakarta', '0219876789', 14, 2, '2020-08-01 17:50:34', NULL, NULL),
(3, 'V0022', 'Abadi Kokoh Insani, PT', 'Surabaya', '0319874452', 14, 1, '2020-08-01 17:51:32', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `consignee`
--
ALTER TABLE `consignee`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `content_footer`
--
ALTER TABLE `content_footer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `content_image`
--
ALTER TABLE `content_image`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NewsCate` (`news_category_id`);

--
-- Indeks untuk tabel `news_category`
--
ALTER TABLE `news_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news_image`
--
ALTER TABLE `news_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `News` (`news_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indeks untuk tabel `pelayaran`
--
ALTER TABLE `pelayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider_home`
--
ALTER TABLE `slider_home`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trucking_type`
--
ALTER TABLE `trucking_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_trucking` (`name_trucking`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vendor_truck`
--
ALTER TABLE `vendor_truck`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agent`
--
ALTER TABLE `agent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `content_footer`
--
ALTER TABLE `content_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `content_image`
--
ALTER TABLE `content_image`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `entity`
--
ALTER TABLE `entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `location`
--
ALTER TABLE `location`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `news_category`
--
ALTER TABLE `news_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `news_image`
--
ALTER TABLE `news_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelayaran`
--
ALTER TABLE `pelayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `slider_home`
--
ALTER TABLE `slider_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `trucking_type`
--
ALTER TABLE `trucking_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `vendor_truck`
--
ALTER TABLE `vendor_truck`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `NewsCate` FOREIGN KEY (`news_category_id`) REFERENCES `news_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
