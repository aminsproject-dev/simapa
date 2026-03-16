-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Mar 2026 pada 14.39
-- Versi server: 10.11.10-MariaDB-log
-- Versi PHP: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aminsdev_silat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_negara`
--

CREATE TABLE `tbl_negara` (
  `id_negara` int(11) NOT NULL,
  `nama_negara` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tbl_negara`
--

INSERT INTO `tbl_negara` (`id_negara`, `nama_negara`) VALUES
(1, 'Afganistan'),
(2, 'Afrika Selatan'),
(3, 'Albania'),
(4, 'Aljazair'),
(5, 'Amerika Serikat'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Antigua dan Barbuda'),
(9, 'Arab Saudi'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Australia'),
(13, 'Austria'),
(14, 'Azerbaijan'),
(15, 'Bahama'),
(16, 'Bahrain'),
(17, 'Bangladesh'),
(18, 'Barbados'),
(19, 'Belanda'),
(20, 'Belarus'),
(21, 'Belgia'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bhutan'),
(25, 'Bolivia'),
(26, 'Bosnia Herzegovina'),
(27, 'Botswana'),
(28, 'Brasil'),
(29, 'Britania Raya'),
(30, 'Brunei'),
(31, 'Bulgaria'),
(32, 'Burkina Faso'),
(33, 'Burundi'),
(34, 'Ceko'),
(35, 'Chad'),
(36, 'Chili'),
(37, 'Denmark'),
(38, 'Djibouti'),
(39, 'Dominika'),
(40, 'Ekuador'),
(41, 'El Salvador'),
(42, 'Eritrea'),
(43, 'Estonia'),
(44, 'Ethiopia'),
(45, 'Fiji'),
(46, 'Filipina'),
(47, 'Finlandia'),
(48, 'Gabon'),
(49, 'Gambia'),
(50, 'Georgia'),
(51, 'Ghana'),
(52, 'Grenada'),
(53, 'Guatemala'),
(54, 'Guinea'),
(55, 'Guinea Bissau'),
(56, 'Guinea Khatulistiwa'),
(57, 'Guyana'),
(58, 'Haiti'),
(59, 'Honduras'),
(60, 'Hongaria'),
(61, 'India'),
(62, 'Indonesia'),
(63, 'Irak'),
(64, 'Iran'),
(65, 'Irlandia'),
(66, 'Islandia'),
(67, 'Israel'),
(68, 'Italia'),
(69, 'Jamaika'),
(70, 'Jepang'),
(71, 'Jerman'),
(72, 'Kamboja'),
(73, 'Kamerun'),
(74, 'Kanada'),
(75, 'Kazakhstan'),
(76, 'Kenya'),
(77, 'Kepulauan Marshall'),
(78, 'Kirgizia'),
(79, 'Kiribati'),
(80, 'Kolombia'),
(81, 'Komoro'),
(82, 'Korea Selatan'),
(83, 'Korea Utara'),
(84, 'Kosta Rika'),
(85, 'Kroasia'),
(86, 'Kuba'),
(87, 'Kuwait'),
(88, 'Laos'),
(89, 'Latvia'),
(90, 'Lebanon'),
(91, 'Lesotho'),
(92, 'Liberia'),
(93, 'Libya'),
(94, 'Liechtenstein'),
(95, 'Lithuania'),
(96, 'Luxembourg'),
(97, 'Madagaskar'),
(98, 'Makedonia'),
(99, 'Maladewa'),
(100, 'Malawi'),
(101, 'Malaysia'),
(102, 'Mali'),
(103, 'Malta'),
(104, 'Maroko'),
(105, 'Mauritania'),
(106, 'Mauritius'),
(107, 'Meksiko'),
(108, 'Mesir'),
(109, 'Mikronesia'),
(110, 'Moldavia'),
(111, 'Monako'),
(112, 'Mongolia'),
(113, 'Mozambik'),
(114, 'Myanmar'),
(115, 'Namibia'),
(116, 'Nauru'),
(117, 'Nepal'),
(118, 'Niger'),
(119, 'Nigeria'),
(120, 'Nikaragua'),
(121, 'Norwegia'),
(122, 'Oman'),
(123, 'Pakistan'),
(124, 'Palau'),
(125, 'Panama'),
(126, 'Pantai Gading'),
(127, 'Papua Nugini'),
(128, 'Paraguay'),
(129, 'Perancis (Metropolitan)'),
(130, 'Peru'),
(131, 'Polandia'),
(132, 'Portugal'),
(133, 'Qatar'),
(134, 'Rep Afrika Tengah'),
(135, 'Republik Cina (Hong Kong)'),
(136, 'Republik Cina (Makau)'),
(137, 'Republik Cina (Taiwan)'),
(138, 'Republik Demokratik Kongo'),
(139, 'Republik Dominika'),
(140, 'Republik Kongo'),
(141, 'Republik Rakyat Cina'),
(142, 'Romania'),
(143, 'Rusia'),
(144, 'Rwanda'),
(145, 'Sahara Barat'),
(146, 'Saint Kitts dan Nevis'),
(147, 'Saint Lucia'),
(148, 'Saint Vincent dan Grenadines'),
(149, 'Samoa'),
(150, 'San Marino'),
(151, 'Sao Tome dan Principe'),
(152, 'Selandia Baru'),
(153, 'Senegal'),
(154, 'Serbia dan Montenegro'),
(155, 'Seychelles'),
(156, 'Sierra Leone'),
(157, 'Singapura'),
(158, 'Siprus'),
(159, 'Slovenia'),
(160, 'Slowakia'),
(161, 'Solomon'),
(162, 'Somalia'),
(163, 'Spanyol'),
(164, 'Sri Lanka'),
(165, 'Sudan'),
(166, 'Suriah'),
(167, 'Suriname'),
(168, 'Swaziland'),
(169, 'Swedia'),
(170, 'Swiss'),
(171, 'Tajikistan'),
(172, 'Tanjung Verde'),
(173, 'Tanzania'),
(174, 'Thailand'),
(175, 'Timor Leste'),
(176, 'Togo'),
(177, 'Tonga'),
(178, 'Trinidad dan Tobago'),
(179, 'Tunisia'),
(180, 'Turki'),
(181, 'Turkmenistan'),
(182, 'Tuvalu'),
(183, 'Uganda'),
(184, 'Ukraina'),
(185, 'Uni Emirat Arab'),
(186, 'Uruguay'),
(187, 'Uzbekistan'),
(188, 'Vanuatu'),
(189, 'Vatikan'),
(190, 'Venezuela'),
(191, 'Vietnam'),
(192, 'Yaman'),
(193, 'Yordania'),
(194, 'Yunani'),
(195, 'Zambia'),
(196, 'Zimbabwe');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_negara`
--
ALTER TABLE `tbl_negara`
  ADD PRIMARY KEY (`id_negara`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_negara`
--
ALTER TABLE `tbl_negara`
  MODIFY `id_negara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
