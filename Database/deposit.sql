-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Mar 2022 pada 10.14
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deposit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `pkey` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`pkey`, `username`, `name`, `password`, `role`, `img`) VALUES
(1, 'admin', 'yayan', '0192023a7bbd73250516f069df18b500', 1, ''),
(5, 'yayan1', 'Guru', '0192023a7bbd73250516f069df18b500', 2, ''),
(8, 'adminn2', 'test', 'd41d8cd98f00b204e9800998ecf8427e', 2, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner`
--

CREATE TABLE `banner` (
  `pkey` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `banner`
--

INSERT INTO `banner` (`pkey`, `name`, `img`, `createon`, `time`, `status`) VALUES
(1, 'Laskar Point Reward', '1648440151.jpg', 1, '1648440151', 1),
(4, 'aaaaaaaa', '1648449418.jpg', 1, '1648449418', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `pkey` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`pkey`, `name`) VALUES
(2, '2.a'),
(3, '3.a'),
(4, '1.a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `content`
--

CREATE TABLE `content` (
  `pkey` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `createon` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `content` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `content`
--

INSERT INTO `content` (`pkey`, `name`, `status`, `createon`, `time`, `content`) VALUES
(3, 'bodynya', 1, 1, '1648456979', '<h2 style=\"text-align: center;\"><span style=\"color: #ff0000;\"><strong>LASKAR138 Point Reward</strong></span></h2>\r\n<p style=\"text-align: center;\"><strong>Seluruh member LASKAR138 akan mendapatkan Point Reward sebagai Loyalty apresiasi dari LASKAR138</strong> <strong>Dengan Minimal Deposit 100rb Rupiah Pemain akan mendapatkan Point Reward yang dapat ditukar dengan Hadiah</strong></p>\r\n<div class=\"elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-3c53e48 animated-fast animated fadeInUp\" data-id=\"3c53e48\" data-element_type=\"column\" data-settings=\"{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:1000}\">\r\n<div class=\"elementor-widget-wrap elementor-element-populated\">\r\n<div class=\"elementor-element elementor-element-689e4fe elementor-widget elementor-widget-image\" data-id=\"689e4fe\" data-element_type=\"widget\" data-widget_type=\"image.default\">\r\n<div class=\"elementor-widget-container\"><strong><img class=\" lazyloaded\" title=\"\" src=\"https://bookingmarketplace.getdokan.com/wp-content/uploads/2019/08/icon3.png\" alt=\"\" data-src=\"https://bookingmarketplace.getdokan.com/wp-content/uploads/2019/08/icon3.png\" /></strong></div>\r\n</div>\r\n<div class=\"elementor-element elementor-element-0ed1b4b elementor-widget elementor-widget-heading\" data-id=\"0ed1b4b\" data-element_type=\"widget\" data-widget_type=\"heading.default\">\r\n<div class=\"elementor-widget-container\">\r\n<div class=\"elementor-heading-title elementor-size-default\" style=\"text-align: center;\"><strong>Pemain juga mendapatkan akses Deposit dan Withdraw yang khusus dengan VIP Laskar138</strong></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p><strong>LASKAR POINT REWARD</strong>&nbsp;adalah Point Royalti yang diberikan untuk para pemain&nbsp;<strong>LASKAR138</strong>&nbsp;yang setia. Yang selalu mendapatkan Point Reward Dari setiap deposit Minimal 100.000,- Rupiah.&nbsp;<strong>LASKAR POINT REWARD</strong>&nbsp;dapat ditukarkan dengan Hadiah hadiah yang menarik yang ditawarkan oleh&nbsp;<strong>LASKAR138</strong>. Oleh sebab itu seluruh pemain di&nbsp;<strong>LASKAR138</strong>&nbsp;dapat menukarkan Point Tersebut dengan Hadiah hadiah yang ditawarkan TANPA HARUS DIUNDI</p>\r\n<p>Dengan melakukan deposit minimal 100.000 Pemain akan dilayani secara VIP oleh Costumer Service&nbsp;<strong>LASKAR138</strong>&nbsp;yang memiliki keuntungan Prioritas dalam Deposit, Withdraw maupun gangguan dalam permaianan. Nikmatilah Prioritas dalam bermain di situs&nbsp;<strong>LASKAR138</strong></p>\r\n<ul>\r\n<li>Deposit Rp 100.000,-&nbsp; mendapatkan Point&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<span style=\"color: #ff0000;\"><strong>25 POINT&nbsp;</strong></span></li>\r\n<li>Deposit Rp 500.000,- mendapatkan Point&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<span style=\"color: #ff0000;\"><strong>150 POINT</strong></span></li>\r\n<li>Deposit Rp 1.000.000,- mendapatkan Point &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"color: #ff0000;\"><strong>350 POINT</strong></span></li>\r\n</ul>\r\n<div>\r\n<p><em>Syarat Dan Ketentuan sebagai berikut :</em></p>\r\n<ol>\r\n<li>Deposit untuk mendapatkan point</li>\r\n<li>Hanya cukup melakukan deposit dengan nominal yang sesuai dan VIP chat akan membantu anda dalam mendapatkan Point LASKAR138 Reward</li>\r\n<li>Deposit Via Pulsa tidak bisa klaim Point Reward</li>\r\n<li>Untuk penukaran POINT REWARD harap Klaim melalui Livechat VIP kami</li>\r\n<li>Untuk pengiriman hadiah paling lamban 3 x 24 jam ( Hari Kerja )</li>\r\n<li>Untuk pengklaiman Wajib mengisi Formulir Data diri</li>\r\n<li>Promo ini dapat berubah kapan saja tanpa pemberitahuan terlebih dahulu</li>\r\n<li>Semua keputusan LASKAR138 bersifat mutlak dan tidak bisa diganggu gugat</li>\r\n</ol>\r\n</div>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `pkey` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `createtimestamp` varchar(255) DEFAULT NULL,
  `modifby` int(11) DEFAULT NULL,
  `modiftimestamp` varchar(255) DEFAULT NULL,
  `temppoint` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `levelkey` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`pkey`, `name`, `createon`, `createtimestamp`, `modifby`, `modiftimestamp`, `temppoint`, `point`, `levelkey`) VALUES
(23, 'yayan', 1, '1648358889', NULL, NULL, 2500, 2500, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit`
--

CREATE TABLE `deposit` (
  `pkey` int(11) NOT NULL,
  `createon` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `deposit`
--

INSERT INTO `deposit` (`pkey`, `createon`, `name`, `point`) VALUES
(2, 1, '100k', 25),
(3, 1, '500k', 150),
(4, 1, '1m', 350);

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit_transaction`
--

CREATE TABLE `deposit_transaction` (
  `pkey` int(11) NOT NULL,
  `customerkey` int(11) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `depositkey` int(11) DEFAULT NULL,
  `calculate` int(11) DEFAULT NULL,
  `totalpoint` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `deposit_transaction`
--

INSERT INTO `deposit_transaction` (`pkey`, `customerkey`, `createon`, `depositkey`, `calculate`, `totalpoint`, `time`, `note`) VALUES
(42, 23, 1, 2, 100, 2500, '1648358993', 'ascasc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `head`
--

CREATE TABLE `head` (
  `pkey` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `html` longtext,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `head`
--

INSERT INTO `head` (`pkey`, `name`, `time`, `createon`, `html`, `status`) VALUES
(1, 'nama head', '1648457125', 1, '<style>\r\n        body {\r\n            background-color: #FFA20B;\r\n        }\r\n    </style>\r\n\r\n<!-- Start of LiveChat (www.livechatinc.com) code -->\r\n<script>\r\n    window.__lc = window.__lc || {};\r\n    window.__lc.license = 13477266;\r\n    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:\"2.0\",on:function(){i([\"on\",c.call(arguments)])},once:function(){i([\"once\",c.call(arguments)])},off:function(){i([\"off\",c.call(arguments)])},get:function(){if(!e._h)throw new Error(\"[LiveChatWidget] You can\'t use getters before load.\");return i([\"get\",c.call(arguments)])},call:function(){i([\"call\",c.call(arguments)])},init:function(){var n=t.createElement(\"script\");n.async=!0,n.type=\"text/javascript\",n.src=\"https://cdn.livechatinc.com/tracking.js\",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))\r\n</script>\r\n<noscript><a href=\"https://www.livechatinc.com/chat-with/13477266/\" rel=\"nofollow\">Chat with us</a>, powered by <a href=\"https://www.livechatinc.com/?welcome\" rel=\"noopener nofollow\" target=\"_blank\">LiveChat</a></noscript>\r\n<!-- End of LiveChat code -->', 1),
(2, 'scasc', '1648199521', 1, 'ascascasc', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `pkey` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rankpoint` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`pkey`, `name`, `rankpoint`, `img`) VALUES
(2, 'Bronze', 10, '1648451619.png'),
(1, 'silver', 100, '1648451684.png'),
(3, 'Gold', 500, '1648451700.png'),
(4, 'Platinum', 1000, '1648451711.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `link`
--

CREATE TABLE `link` (
  `pkey` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `createon` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `wa` varchar(255) DEFAULT NULL,
  `in` varchar(255) DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `claim` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `link`
--

INSERT INTO `link` (`pkey`, `name`, `status`, `createon`, `time`, `wa`, `in`, `register`, `claim`) VALUES
(1, 'testing', 0, 1, '1648352850', '2555454541', 'https://www.youtube.com/watch?v=-kNdjdxQ-pc', 'https://www.youtube.com/watch?v=-kNdjdxQ-pc', 'https://www.facebook.com/'),
(2, 'yang benar', 1, 1, '1648353155', 'https://wa.me/6281532380661', 'https://94.237.75.152/account/register', 'https://94.237.75.152/account/register', 'https://www.youtube.com/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `memori`
--

CREATE TABLE `memori` (
  `pkey` int(11) NOT NULL,
  `classkey` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `memori`
--

INSERT INTO `memori` (`pkey`, `classkey`, `name`) VALUES
(1, 2, 'Tahfidz Juz 30'),
(3, 2, 'Bab shalat'),
(4, NULL, '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `memori_detail`
--

CREATE TABLE `memori_detail` (
  `pkey` int(11) NOT NULL,
  `memorikey` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `memori_detail`
--

INSERT INTO `memori_detail` (`pkey`, `memorikey`, `name`) VALUES
(1, 1, 'S.Al-Fatihah'),
(2, 1, 'S.Al-Ikhlas'),
(8, 2, 'asdsasd'),
(9, 2, '3456'),
(10, 2, 'fghfgh'),
(11, 3, 'Niat shalat'),
(12, 3, 'Doa iftitah'),
(13, 3, 'Doa qunut'),
(14, 3, 'Tahiyat awal'),
(15, 3, 'Tahiyat akhir'),
(16, 1, 'S.Al-Falaq'),
(17, 4, 'cobasaja'),
(18, 4, 'coba123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile_company`
--

CREATE TABLE `profile_company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `titlelogin` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profile_company`
--

INSERT INTO `profile_company` (`id`, `name`, `alamat`, `telepon`, `phone`, `titlelogin`, `logo`, `title`) VALUES
(1, 'LASKAR 138', 'testing', '2345423', '234532', 'Deposit', 'logo.png', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reward`
--

CREATE TABLE `reward` (
  `pkey` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `point` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reward`
--

INSERT INTO `reward` (`pkey`, `title`, `name`, `img`, `createon`, `time`, `point`) VALUES
(2, 'NEW PAJERO GR-SPORT', 'KENDARAAN', '1648466070.png', 1, '1648466070', '111'),
(3, 'NEW AGYA GR-SPORT', 'KENDARAAN', '1648466099.png', 1, '1648466099', '56000'),
(4, 'CBR 250-RR', 'KENDARAAN', '1648466123.png', 1, '1648466123', '12300'),
(5, 'EMAS BATANGAN 50GRAM', 'PERHIASAN', '1648466187.png', 1, '1648466187', '308000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `pkey` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`pkey`, `name`) VALUES
(1, 'Super Admin'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`pkey`);

--
-- Indeks untuk tabel `banner`
--
ALTER TABLE `banner`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `class`
--
ALTER TABLE `class`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `content`
--
ALTER TABLE `content`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `deposit`
--
ALTER TABLE `deposit`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `deposit_transaction`
--
ALTER TABLE `deposit_transaction`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `head`
--
ALTER TABLE `head`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `link`
--
ALTER TABLE `link`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `memori`
--
ALTER TABLE `memori`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `memori_detail`
--
ALTER TABLE `memori_detail`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `profile_company`
--
ALTER TABLE `profile_company`
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `reward`
--
ALTER TABLE `reward`
  ADD KEY `pkey` (`pkey`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD KEY `pkey` (`pkey`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `account`
--
ALTER TABLE `account`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `banner`
--
ALTER TABLE `banner`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `class`
--
ALTER TABLE `class`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `content`
--
ALTER TABLE `content`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `deposit`
--
ALTER TABLE `deposit`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `deposit_transaction`
--
ALTER TABLE `deposit_transaction`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `head`
--
ALTER TABLE `head`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `link`
--
ALTER TABLE `link`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `memori`
--
ALTER TABLE `memori`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `memori_detail`
--
ALTER TABLE `memori_detail`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `profile_company`
--
ALTER TABLE `profile_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `reward`
--
ALTER TABLE `reward`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
