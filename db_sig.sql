-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2024 pada 06.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sig`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `markers`
--

INSERT INTO `markers` (`id`, `user_id`, `lat`, `lng`, `name`, `description`) VALUES
(21, 4, -3.9999837752211485, 122.52823770046236, 'Toko Kopi Sinar', 'Kambu, Kec. Kambu, Kota Kendari, Sulawesi Tenggara 93231'),
(22, 4, -4.001827722648095, 122.51809090375902, 'Epps Coffee', 'Kambu, Kec. Kambu, Kota Kendari, Sulawesi Tenggara 93231'),
(23, 4, -4.006854848324995, 122.53433704376222, 'Brunos Coffee & Eatery', ' Jl. Martandu No.266, Kambu, Kec. Kambu, Kota Kendari, Sulawesi Tenggara 93231'),
(24, 4, -4.011328428258178, 122.52886265516283, 'Madecca 2.0', 'Perdos UHO, Blok L.17, Kambu, Kec. Kambu, Kota Kendari, Sulawesi Tenggara'),
(25, 4, -4.012169965011568, 122.53051221370698, 'Onz Coffee', 'Perumahan Dosen, Blok O No.5, Kota Kendari, Sulawesi Tenggara 93231'),
(26, 4, -4.0175233084812545, 122.53611803054811, 'Discuss Coffee', 'Anduonohu, Kec. Poasia, Kota Kendari, Sulawesi Tenggara 93231'),
(27, 4, -4.007223628740959, 122.53448456525804, 'Ar\'s', 'Jl. Martandu, Kambu, Kec. Kambu, Kota Kendari, Sulawesi Tenggara 93231'),
(28, 4, -4.007637340104956, 122.53439068794252, 'Coffee Broth', 'Jl. Martandu No.50, Kambu, Kec. Kambu, Kota Kendari, Sulawesi Tenggara 93231'),
(29, 4, -4.007872181219011, 122.53388106822969, 'Cafe Langit', 'Kambu, Kec. Kambu, Kota Kendari, Sulawesi Tenggara'),
(30, 4, -3.9956945047031285, 122.53333926200868, 'NOSMOKE.COFFEE', 'Jl. Malaka No.3, Anduonohu, Kec. Kambu, Kota Kendari, Sulawesi Tenggara 93231'),
(31, 4, -3.9904537658033115, 122.51470327377321, 'Coffee Tiga Tiga', 'Lorong Puao, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93117'),
(32, 4, -4.021436701676082, 122.5129517912865, 'Sementara Coffee', 'Jl. H. Lamuse No.24, Lepo-Lepo, Kec. Baruga, Kota Kendari, Sulawesi Tenggara 93116'),
(33, 4, -3.979688742930127, 122.51980483531953, 'Dua Sinar', 'Jl. H. Supu Yusuf No.20S, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara'),
(34, 4, -3.9811272913227254, 122.51276135444643, 'Early 10.2 Pattisirie & Cafe', 'Jl. Antero Hamra, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93111'),
(35, 4, -3.981025135151337, 122.51246094703676, 'Rupa Coffee & Working space', 'Kompleks Ruko River View A3, Jl. Antero Hamra, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93111'),
(36, 4, -3.9836052206136534, 122.51427143812182, 'Disemeja Coffee & Chill', 'Jl. Sao Sao, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara'),
(37, 4, -3.9686515160327627, 122.52431631088258, 'SEMPATKAN COFFEE', 'Jl. H. Supu Yusuf, Korumba, Kec. Mandonga, Kota Kendari, Sulawesi Tenggara 93111'),
(38, 4, -3.9661648891397907, 122.54505783319475, 'EHL CAFE', 'Bay Pass, Jl. Ir. H. Alala No.108, Watu-Watu, Kec. Kendari Bar., Kota Kendari, Sulawesi Tenggara 93121'),
(39, 4, -3.9741761821566954, 122.51971364021303, 'GOOLLA DE NARANG', 'Jl. Made Sabara, Korumba, Kec. Mandonga, Kota Kendari, Sulawesi Tenggara 93461'),
(40, 4, -3.971007782747631, 122.51882314682008, 'Mondae Coffee', 'Jl. Malik Raya No.28-22, Korumba, Kec. Mandonga, Kota Kendari, Sulawesi Tenggara 93111'),
(41, 4, -3.978730123474525, 122.52014279365541, 'Mujur Coffee & Roster', 'Jl. H. Supu Yusuf No.4, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93461'),
(42, 4, -3.974813214938278, 122.50586271286012, 'DK House', 'Jl. Balai Kota IV No.112, Pondambea, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93115'),
(43, 4, -3.9608254849234483, 122.51771807670595, 'FOR NEW COFFEE & KITCHEN', 'Jl. Suprapto No.28, Anggilowu, Kec. Mandonga, Kota Kendari, Sulawesi Tenggara 93112'),
(44, 4, -3.980912230039775, 122.51176357269289, 'Seko.pi', 'Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93111'),
(45, 4, -3.980057307033857, 122.51950442790987, 'Spotcoffe.id', 'Jl. Pasaeno, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara'),
(46, 4, -3.98177040890652, 122.51261115074159, 'Cafe One Way', 'Jl. Kol. H. Abd. Hamid, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara'),
(47, 4, -4.002233581381395, 122.54106402397157, 'KEDAI BENTAR MALAM', 'Jl. Kelapa, Anduonohu, Kec. Poasia, Kota Kendari, Sulawesi Tenggara 93231'),
(48, 4, -4.000392768775349, 122.54119277000427, 'Koffienote', 'Jl. Bunggasi, Rahandouna, Kec. Poasia, Kota Kendari, Sulawesi Tenggara'),
(49, 4, -3.978414552608496, 122.52135783433916, 'OurssCaffe', 'Jl. Abunawas No.35, Korumba, Kec. Mandonga, Kota Kendari, Sulawesi Tenggara 93461'),
(50, 4, -4.013926358518518, 122.5456801056862, 'Arion Coffee & Space', 'Jl. P. Antasari, Anduonohu, Kec. Poasia, Kota Kendari, Sulawesi Tenggara'),
(51, 4, -3.978595963815366, 122.51738011837007, 'TUANTANA KENDARI', 'Jl. Pasaeno No.1, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93117'),
(52, 4, -3.971738894366859, 122.52000331878664, 'looka Coffee space', 'Jl. By Pass, Korumba, Kec. Mandonga, Kota Kendari, Sulawesi Tenggara 93461'),
(53, 4, -4.001463008560108, 122.5332346558571, 'Ruma.Hagia', 'Jalan Jenderal Besar A.H. Nasution, Pangkalan Masyhur, Kambu, Kota Medan, Sumatera Utara'),
(54, 4, -3.9730660769210977, 122.52374768257141, 'INDISCHE COFFEE', 'Jl. Malik Raya No.51, Korumba, Kec. Mandonga, Kota Kendari, Sulawesi Tenggara 93461'),
(55, 4, -3.977505330417344, 122.52704948186876, 'Manual Coffee Kendari', 'Depan RS. Aliyah 2, Jl. Buburanda, Korumba, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93561'),
(56, 4, -3.9887218003090945, 122.51857638359071, 'Lapak Tikungan', 'Jl. Brigjen M. Yoenoes, Bonggoeya, Kec. Wua-Wua, Kota Kendari, Sulawesi Tenggara 93561'),
(57, 4, -3.975811464906469, 122.51523166894916, 'ARA ARA COFFEE EXPERIENCE', 'Jl. Abunawas, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara'),
(58, 4, -3.994527766922856, 122.51243680715562, 'GOFFEE KENDARI', 'Jl. Laode Hadi No.22, Wowawanggu, Kec. Kadia, Kota Kendari, Sulawesi Tenggara 93117');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'nisa', '$2y$10$F3Gzk6XL6mU1Qe7VqvnYVu98nflFnA4AaZrnUKprj6I3IEtcLyl.K'),
(2, 'abc', '$2y$10$bXbyyWy39s30yKIqZxpmMew0EyQUpbk4icqqNKsxAvoZBvmZKf6Pm'),
(3, 'annisaazzahra', '$2y$10$2FjYyVe5kp234fSk9H3/2u6Eqdiwd8ivHaaanATVpS6N4w6OieUmy'),
(4, 'nisca', '$2y$10$frcjctj0uBX7pafSQDwqWOzVwYhTtZCvkrmaCelMF4ayPEFsffSSe');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `markers`
--
ALTER TABLE `markers`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
