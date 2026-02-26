-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2026 at 09:06 AM
-- Server version: 11.4.10-MariaDB
-- PHP Version: 8.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saridhar_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel_kesehatan`
--

CREATE TABLE `artikel_kesehatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `dokter_terkait` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `artikel_kesehatan`
--

INSERT INTO `artikel_kesehatan` (`id`, `kategori_id`, `judul`, `konten`, `dokter_terkait`, `foto`, `created_at`, `updated_at`) VALUES
(1, 3, 'Konsentrasi Sering Buyar? Ini 8 Cara Agar Bisa Lebih Fokus Setiap Hari', '<p class=\"ql-align-justify\">Pernah merasa sulit berkonsentrasi saat sedang mengerjakan sesuatu? Rasa mudah terdistraksi atau gagal fokus tidak hanya membuat pekerjaan jadi tertunda, tapi juga bisa berisiko, apalagi jika kamu sedang melakukan aktivitas penting seperti menyetir atau mengoperasikan alat berat.</p><p class=\"ql-align-justify\">Masalah kurang fokus ini sebaiknya tidak dianggap enteng. Ada berbagai cara agar bisa lebih fokus yang terbukti ampuh membantu kamu kembali <em>on track</em> dan menyelesaikan berbagai tugas dengan lebih efisien.</p><p class=\"ql-align-justify\">Berikut beberapa <em>tips</em> agar bisa lebih fokus kerja, belajar, atau bahkan saat ingin fokus pada diri sendiri:</p><p class=\"ql-align-justify\"><br></p><h3>1. <strong>Cukup Tidur dan Perbaiki Pola Tidur</strong></h3><p class=\"ql-align-justify\">Kurang tidur bisa menurunkan kemampuan otak untuk berkonsentrasi dan mengingat informasi. Usahakan tidur 7–9 jam setiap malam dan tidur pada jam yang sama setiap hari.</p><p class=\"ql-align-justify\"><br></p><h3>2. <strong>Kurangi Multitasking</strong></h3><p class=\"ql-align-justify\">Melakukan banyak hal sekaligus terdengar produktif, namun justru membuat konsentrasi menurun. Fokuslah pada satu tugas dalam satu waktu untuk hasil yang lebih baik dan cepat.</p><p class=\"ql-align-justify\"><br></p><h3>3. <strong>Rutin Berolahraga</strong></h3><p class=\"ql-align-justify\">Aktivitas fisik meningkatkan aliran darah ke otak dan memperbaiki fungsi kognitif. Bahkan jalan kaki 20–30 menit setiap hari sudah bisa membantu meningkatkan konsentrasi.</p><p class=\"ql-align-justify\"><br></p><h3>4. <strong>Konsumsi Makanan Sehat untuk Otak</strong></h3><p class=\"ql-align-justify\">Beberapa jenis makanan seperti ikan berlemak (omega-3), kacang-kacangan, alpukat, buah beri, dan sayuran hijau dikenal dapat mendukung kesehatan otak dan fokus.</p><p class=\"ql-align-justify\"><br></p><h3>5. <strong>Atur Jadwal dan Gunakan Teknik Fokus</strong></h3><p class=\"ql-align-justify\">Teknik seperti <strong>Pomodoro</strong> (25 menit kerja, 5 menit istirahat) bisa membantu otak tetap segar dan fokus. Gunakan alat bantu seperti timer atau aplikasi fokus.</p><p class=\"ql-align-justify\"><br></p><h3>6. <strong>Minimalkan Gangguan</strong></h3><p class=\"ql-align-justify\">Matikan notifikasi HP, tutup tab browser yang tidak perlu, dan ciptakan lingkungan kerja yang tenang. Bila perlu, gunakan earphone noise-canceling atau musik instrumental.</p><p class=\"ql-align-justify\"><br></p><h3>7. <strong>Latihan Meditasi dan Mindfulness</strong></h3><p class=\"ql-align-justify\">Meditasi terbukti dapat melatih otak untuk tetap berada di \"saat ini\", meningkatkan perhatian dan menurunkan stres yang menjadi pemicu buyarnya konsentrasi.</p><p class=\"ql-align-justify\"><br></p><h3>8. <strong>Periksa Kesehatan Secara Berkala</strong></h3><p class=\"ql-align-justify\">Kondisi medis tertentu seperti anemia, hipotiroid, gangguan kecemasan, atau ADHD bisa menyebabkan penurunan konsentrasi. Jika merasa konsentrasi menurun terus-menerus, lakukan pemeriksaan ke dokter. Menjaga fokus adalah bagian penting dari menjaga kesehatan mental dan fisik secara keseluruhan. Dengan memperbaiki pola hidup dan mengenali sumber gangguan konsentrasi, Anda bisa menjadi pribadi yang lebih produktif dan seimbang.</p><p class=\"ql-align-justify\"><br></p><h3>Ingin tahu penyebab menurunnya fokus dan konsentrasi Anda?</h3><p>Lakukan pemeriksaan kesehatan menyeluruh di <strong>Klinik Utama Rawat Inap Sari Dharma</strong>.</p><p class=\"ql-align-justify\">Hubungi kami di (0361) 226866 atau Whatsapp 08113881248 untuk info dan pendaftaran!</p>', '[\"5\"]', 'uploads/artikel_kesehatan/20250530_1333.jpeg', '2025-05-01 13:46:00', '2025-08-08 07:35:30'),
(2, 3, '6 Makanan Sehat untuk Ginjal yang Wajib Ada di Menu Harianmu', '<p class=\"ql-align-justify\">Ginjal adalah organ penting yang bekerja tanpa henti untuk menyaring limbah, menjaga keseimbangan elektrolit, dan mengatur tekanan darah. Sayangnya, banyak orang baru menyadari pentingnya fungsi ginjal saat sudah muncul masalah. Padahal, dengan pola makan yang tepat, kamu bisa bantu menjaga kesehatan ginjal sejak dini.</p><p class=\"ql-align-justify\">Yuk, kenali <strong>makanan sehat untuk ginjal</strong> berikut ini yang terbukti mendukung fungsi ginjal secara alami!</p>', '[\"7\"]', 'uploads/artikel_kesehatan/20250602_1845.png', '2025-05-01 13:46:45', '2025-06-02 11:45:24'),
(3, 3, 'Manfaat Cuka Nanas untuk Kesehatan: Alternatif Alami yang Patut Dicoba', '<p class=\"ql-align-justify\">Cuka nanas mungkin belum sepopuler cuka apel, tapi jenis cuka alami ini mulai dilirik karena potensi manfaat kesehatannya. Terbuat dari fermentasi sari buah nanas, cuka ini mengandung berbagai senyawa bioaktif, termasuk asam asetat, enzim bromelain, vitamin, serta antioksidan yang bermanfaat bagi tubuh. Dalam artikel ini, kita akan membahas apa itu cuka nanas, berbagai manfaatnya untuk kesehatan, dan alasan mengapa kamu perlu mempertimbangkannya sebagai bagian dari</p><h5 class=\"ql-align-justify\"><br></h5>', '[\"6\"]', 'uploads/artikel_kesehatan/20250602_1836.jpg', '2025-05-01 13:47:30', '2025-06-02 11:36:48'),
(4, 3, 'Cegah Polio Sejak Dini: Kenali Gejala, Penyebab, dan Jadwal Imunisasi Polio', '<h5 class=\"ql-align-justify\">Apa Itu Polio?</h5><p class=\"ql-align-justify\">Polio adalah penyakit infeksi virus yang menyerang sistem saraf pusat dan bisa menyebabkan kelumpuhan permanen. Penyakit polio sangat menular dan utamanya menyerang anak-anak di bawah usia 5 tahun yang belum mendapatkan imunisasi polio. Virus polio menyebar dengan cepat melalui kontak feses dan makanan atau minuman yang terkontaminasi.</p>', '[\"29\"]', 'uploads/artikel_kesehatan/20250602_1846.png', '2025-05-01 13:48:25', '2025-06-02 11:46:36'),
(5, 3, 'Periodontitis: Berbahaya dan Bisa Menyebabkan Gigi Tanggal!', '<p>🦷 Mengenal Periodontitis: Infeksi Gusi yang Bisa Bikin Gigi Tanggal!</p><p><br></p><p>Periodontitis adalah penyakit gusi serius yang sering tidak disadari hingga kerusakan terjadi. Jika tidak ditangani, bisa menyebabkan kerusakan jaringan dan tulang penyangga gigi, bahkan kehilangan gigi permanen. 😬</p><p><br></p><p>Yuk kenali penyebab, gejala, dan cara penanganannya agar kamu bisa mencegah lebih dini!</p><p><br></p><p>Swipe ➡ untuk penjelasan lengkapnya!</p><p><br></p><p>📌 Jangan lupa periksa ke dokter gigi minimal 6 bulan sekali ya!</p><p><br></p><p>KLINIK UTAMA RAWAT INAP SARI DHARMA</p><p>Jalan Pulau Seram No 1 Denpasar Barat</p><p>Telp. (0361) 226866</p>', '[false]', 'uploads/artikel_kesehatan/20250602_1837.png', '2025-05-07 07:48:38', '2025-08-08 07:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_community`
--

CREATE TABLE `event_community` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_community`
--

INSERT INTO `event_community` (`id`, `kategori_id`, `judul`, `konten`, `foto`, `created_at`, `updated_at`) VALUES
(1, 4, 'Pelatihan Ct Scan Dan Mri Dalam Mendeteksi Kerusakan Otak', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit corrupti, repellat nam voluptate ipsam, iusto ullam dolor voluptatum natus sed esse, sit possimus facilis odio repudiandae sunt temporibus distinctio cum ad consequuntur. Dolorem, aperiam voluptatem veniam ipsa non temporibus recusandae perspiciatis, ab alias tempore reiciendis libero cum accusamus, voluptatum quaerat! Porro ducimus quos inventore quas animi. Ipsa rerum perspiciatis ipsam fugit laudantium, voluptates deleniti reiciendis explicabo sequi magni quidem? Quae aspernatur minima voluptatum distinctio corporis est maxime sed dignissimos iure laudantium sapiente voluptatem voluptas explicabo cupiditate vero, tempore sit? Magni odit, iusto ut unde quaerat quasi explicabo adipisci sint ex eveniet laborum nam ullam ipsam est maiores tenetur provident id minima autem molestiae suscipit aut nemo.</p>', 'uploads/event_community/20250505_2238.jpg', '2025-05-01 22:44:21', '2025-05-05 15:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indikator_mutu`
--

CREATE TABLE `indikator_mutu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dokter_id` bigint(20) UNSIGNED NOT NULL,
  `spesialis_id` bigint(20) UNSIGNED NOT NULL,
  `background_dokter` text DEFAULT NULL,
  `jadwal_dokter` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `edukasi_karir` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `dokter_id`, `spesialis_id`, `background_dokter`, `jadwal_dokter`, `edukasi_karir`, `foto`, `created_at`, `updated_at`) VALUES
(5, 5, 5, 'Lulusan Spesialis Jantung dan Pembuluh Darah di Universitas Udayana', '[{\"hari\":\"Senin\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"}]', '[{\"judul\":\"S1 Universitas Udayana\",\"tahun_mulai\":\"2004\",\"tahun_selesai\":\"2010\"},{\"judul\":\"Konsultan Jantung dan Pembuluh Darah\",\"tahun_mulai\":\"2015\",\"tahun_selesai\":\"2018\"}]', 'uploads/jadwal_dokter/20250507_1308.jpg', '2025-05-07 05:53:41', '2025-05-07 06:08:51'),
(8, 11, 6, '', '[{\"hari\":\"Selasa\",\"jam_mulai\":\"10:00\",\"jam_selesai\":\"13:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"10:00\",\"jam_selesai\":\"13:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"10:00\",\"jam_selesai\":\"13:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250722_1310.jpg', '2025-05-14 02:47:53', '2025-07-22 06:10:39'),
(10, 13, 6, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"19:00\",\"jam_selesai\":\"21:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"19:00\",\"jam_selesai\":\"21:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"10:00\",\"jam_selesai\":\"13:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250806_1421.png', '2025-05-14 02:47:53', '2025-08-06 07:21:42'),
(11, 14, 6, '', '[{\"hari\":\"Selasa\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"20:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250520_1359.png', '2025-05-14 02:47:53', '2025-05-20 06:59:49'),
(12, 8, 4, '', '[{\"hari\":\"Selasa\",\"jam_mulai\":\"19:00\",\"jam_selesai\":\"21:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"19:00\",\"jam_selesai\":\"21:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"17:30\",\"jam_selesai\":\"20:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20260212_1431.jpg', '2025-05-14 02:48:30', '2026-02-12 07:31:44'),
(13, 9, 4, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_0923.jpg', '2025-05-14 02:48:30', '2025-11-24 02:23:36'),
(14, 10, 4, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250520_1413.png', '2025-05-14 02:48:30', '2025-05-20 07:13:58'),
(15, 6, 5, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250805_1436.jpg', '2025-05-14 02:48:46', '2025-08-05 07:36:54'),
(16, 7, 5, '', '[{\"hari\":\"Selasa\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_0932.png', '2025-05-14 02:48:46', '2025-11-24 02:32:39'),
(17, 15, 7, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"15:30\",\"jam_selesai\":\"17:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250722_1314.jpg', '2025-05-14 02:51:17', '2025-07-22 06:14:39'),
(19, 17, 7, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_0954.jpg', '2025-05-14 02:51:17', '2025-11-24 02:54:23'),
(20, 18, 8, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"18:30\",\"jam_selesai\":\"19:30\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"18:30\",\"jam_selesai\":\"19:30\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"18:30\",\"jam_selesai\":\"19:30\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"18:30\",\"jam_selesai\":\"19:30\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250806_1420.png', '2025-05-14 03:12:16', '2025-08-06 07:20:07'),
(21, 19, 8, '', '[{\"hari\":\"Rabu\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20260212_1432.jpg', '2025-05-14 03:12:16', '2026-02-12 07:32:45'),
(22, 20, 9, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"15:00\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"15:00\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"15:00\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"15:00\",\"jam_selesai\":\"17:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250805_1446.png', '2025-05-14 03:27:32', '2025-08-05 07:46:15'),
(23, 21, 9, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"15:00\",\"jam_selesai\":\"17:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"15:00\",\"jam_selesai\":\"17:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_0955.png', '2025-05-14 03:27:32', '2025-11-24 02:55:18'),
(24, 22, 9, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"16:00\",\"jam_selesai\":\"18:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_1321.png', '2025-05-14 03:27:32', '2025-11-24 06:21:15'),
(25, 23, 9, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"16:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', NULL, '2025-05-14 03:27:32', '2025-05-14 03:27:32'),
(26, 24, 2, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250805_1450.jpg', '2025-05-14 03:28:23', '2025-08-05 07:50:27'),
(28, 25, 10, '', '[{\"hari\":\"Selasa\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_0956.jpg', '2025-05-14 03:31:19', '2025-11-24 02:56:20'),
(29, 26, 11, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"10:00\",\"jam_selesai\":\"13:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"10:00\",\"jam_selesai\":\"13:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"10:00\",\"jam_selesai\":\"13:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"10:00\",\"jam_selesai\":\"13:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_1322.jpg', '2025-05-14 03:33:05', '2025-11-24 06:22:23'),
(30, 27, 11, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_0957.png', '2025-05-14 03:33:05', '2025-11-24 02:57:51'),
(31, 28, 12, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"13:00\",\"jam_selesai\":\"15:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"13:00\",\"jam_selesai\":\"15:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"13:00\",\"jam_selesai\":\"15:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"09:00\",\"jam_selesai\":\"12:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250805_1502.jpg', '2025-05-14 03:50:10', '2025-08-05 08:02:48'),
(32, 29, 13, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"19:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_1007.png', '2025-05-14 04:16:40', '2025-11-24 03:07:41'),
(33, 30, 14, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"18:00\",\"jam_selesai\":\"20:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_1010.jpg', '2025-05-14 04:23:49', '2025-11-24 03:10:02'),
(35, 31, 1, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"20:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"17:00\",\"jam_selesai\":\"20:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250805_1506.jpg', '2025-06-30 12:42:29', '2025-11-24 03:32:06'),
(36, 32, 15, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Minggu\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_1025.png', '2025-08-06 07:41:40', '2025-11-24 03:25:57'),
(37, 33, 15, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"16:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', NULL, '2025-08-06 07:43:42', '2025-08-06 07:43:42'),
(38, 35, 15, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Selasa\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Jumat\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Sabtu\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"},{\"hari\":\"Minggu\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"08:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20250806_1451.jpg', '2025-08-06 07:43:42', '2025-11-24 03:35:33'),
(39, 34, 15, '', '[{\"hari\":\"Senin\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"16:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', NULL, '2025-08-06 07:43:42', '2025-08-06 07:43:42'),
(42, 38, 7, '', '[{\"hari\":\"Selasa\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"10:30\"},{\"hari\":\"Rabu\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"10:30\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"08:00\",\"jam_selesai\":\"10:30\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_1324.png', '2025-11-24 03:37:25', '2025-11-24 06:24:28'),
(43, 39, 17, '', '[{\"hari\":\"Selasa\",\"jam_mulai\":\"11:00\",\"jam_selesai\":\"13:00\"},{\"hari\":\"Kamis\",\"jam_mulai\":\"11:00\",\"jam_selesai\":\"13:00\"}]', '[{\"judul\":\"Pendidikan\",\"tahun_mulai\":\"2025\",\"tahun_selesai\":null}]', 'uploads/jadwal_dokter/20251124_1325.png', '2025-11-24 03:41:04', '2025-11-24 06:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karir`
--

CREATE TABLE `karir` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `link_pendaftaran` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karir`
--

INSERT INTO `karir` (`id`, `divisi`, `posisi`, `link_pendaftaran`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Dokter Umum', 'Dokter Umum', 'https://www.saridharma.com/media-informasi/karir', 'uploads/karir/20251218_1018.png', '2025-05-02 00:42:00', '2025-12-18 03:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `konten_social_media`
--

CREATE TABLE `konten_social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('youtube','instagram') NOT NULL,
  `links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `konten_social_media`
--

INSERT INTO `konten_social_media` (`id`, `type`, `links`, `created_at`, `updated_at`) VALUES
(80, 'instagram', '\"https:\\/\\/www.instagram.com\\/p\\/DKLnFpDz6tK\\/\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(81, 'instagram', '\"https:\\/\\/www.instagram.com\\/p\\/DA92UsJqxNO\\/\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(82, 'instagram', '\"https:\\/\\/www.instagram.com\\/p\\/DKOn0SJTZiu\\/\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(83, 'instagram', '\"https:\\/\\/www.instagram.com\\/p\\/DKMAmjKz_bP\\/?img_index=1\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(84, 'instagram', '\"https:\\/\\/www.instagram.com\\/reel\\/DSHWx31k4_d\\/?igsh=aTRxejU2bmUzdXVx\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(85, 'instagram', '\"https:\\/\\/www.instagram.com\\/reel\\/DSWLSTsEzXF\\/?igsh=MXA0YTBnZDRocmgwbw==\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(86, 'instagram', '\"https:\\/\\/www.instagram.com\\/reel\\/DSWMBm_E0xr\\/?igsh=MXViYjBwdWwwNzhweQ==\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(87, 'instagram', '\"https:\\/\\/www.instagram.com\\/reel\\/DSWMm12E2Ak\\/?igsh=bGVudnZqdWkzZGo3\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(88, 'instagram', '\"https:\\/\\/www.instagram.com\\/reel\\/DSWNBjeEwN1\\/?igsh=MTRzZWZ4bXZhc2pwNA==\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(89, 'instagram', '\"https:\\/\\/www.instagram.com\\/reel\\/DSWNv6vE7Sc\\/?igsh=aTZ1bHlpZmJhc3gy\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(90, 'instagram', '\"https:\\/\\/www.instagram.com\\/reel\\/DJRRBDHzGN_\\/?igsh=MTl6YTlvMG02Z3Bpbw==\"', '2025-12-18 03:09:35', '2025-12-18 03:09:35'),
(91, 'youtube', '\"https:\\/\\/www.youtube.com\\/watch?v=LZtV4lApCP0\"', '2025-12-18 03:15:45', '2025-12-18 03:15:45'),
(92, 'youtube', '\"https:\\/\\/www.youtube.com\\/watch?v=Dw1ew6xfc5g\"', '2025-12-18 03:15:45', '2025-12-18 03:15:45'),
(93, 'youtube', '\"https:\\/\\/www.youtube.com\\/watch?v=C1A_vMJCcIU&t=13s\"', '2025-12-18 03:15:45', '2025-12-18 03:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `layanan_fasilitas`
--

CREATE TABLE `layanan_fasilitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `deskripsi_overview` text DEFAULT NULL,
  `layanan_fasilitas` text DEFAULT NULL,
  `foto_header` varchar(255) DEFAULT NULL,
  `foto_lainnya` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan_fasilitas`
--

INSERT INTO `layanan_fasilitas` (`id`, `nama_fasilitas`, `deskripsi_overview`, `layanan_fasilitas`, `foto_header`, `foto_lainnya`, `created_at`, `updated_at`) VALUES
(1, 'Instalasi Gawat Darurat', 'Instalasi Gawat Darurat (IGD) rumah sakit ini memberikan pelayanan 24 jam untuk menangani hal yang berkenaan dengan kegawat daruratan pasien yang membutuhkan penanganan secara cepat. Tujuannya adalah untuk meminimalisir sekecil mungkin resiko terjadinya kecacatan dan kematian.', 'Fasilitas Layanan Instalasi Gawat darurat\r\nMemiliki ruang pemeriksaan pasien yang terdiri dari 3 bed, ruang resusitasi : 1 bed, ruang isolasi : 1 bed, ruang batuk 1 : bed, ruang persalinan dan resusitasi neonatus emergency, ruang operasi (bedah minor) Laboratorium Klinik Terpadu, Satelit Farmasi, Radiologi', 'uploads/layanan_fasilitas/20250526_0857_header.jpg', 'uploads/layanan_fasilitas/20250505_2227_lainnya.jpg', '2025-05-01 15:14:27', '2025-05-26 01:57:41'),
(2, 'Ruang Rawat Inap', 'Kamar rawat inap tersedia di RS ini. Kenyamanan menjadi salah satu faktor yang diharapkan dapat membantu mempercepat masa penyembuhan/pemulihan. Ruang rawat inap RS ini Group menawarkan ketenangan, privasi, dan kenyamanan pelayanan dari sebuah kamar perawatan.  Kami juga menghadirkan pilihan menu makanan sehat yang bervariasi, yang disesuaikan dengan kondisi kesehatan pasien dan di bawah pengawasan ahli gizi.', 'General Care Ward\r\nKamar perawatan setelah tindakan medis dan bedah, khususnya bagi pasien dewasa, dengan interior yang lengkap. Tersedia berbagai pilihan kamar rawat inap selama menjalani masa perawatan dari tipe kelas Suite, VVIP maupun VIP.\r\n\r\nRuang Isolasi\r\nKamar perawatan khusus bagi pasien dewasa maupun anak yang menderita penyakit menular.Kamar ini dilengkapi ruang tekanan negatif (sirkulasi udara terpisah/tidak pararel) untuk menghindari terjadinya penularan penyakit melalui udara. Tersedia pula ruang transfer dengan dua pintu agar tim medis atau keluarga yang akan melakukan kontak langsung dengan pasien tidak ikut terinfeksi.\r\n\r\nWomen & Maternity Ward\r\nKamar perawatan untuk ibu melahirkan yang dirancang untuk memberikan kenyamanan optimal bagi ibu, bayi, serta keluarga dan orang-orang terdekat yang mendampingi ibu setelah proses persalinan. Layanan ini dilengkapi interior yang modern serta berbagai fasilitas lengkap.', 'uploads/layanan_fasilitas/20250505_2228_header.jpg', 'uploads/layanan_fasilitas/20250505_2227_lainnya.jpg', '2025-05-01 15:17:47', '2025-05-05 15:28:08'),
(3, 'USG 4 Dimensi', 'USG 4 dimensi membuat penampakan janin menjadi lebih detail, akurat, dan nyata. Ibu bisa melihat pergerakan janin seperti sebuah video. Pemeriksaan kehamilan yang dilakukan pun menjadi lebih seru karena Ibu bisa melihat bagaimana buah hati beraksi di dalam rahim.', 'USG 4 dimensi membuat penampakan janin menjadi lebih detail, akurat, dan nyata. Ibu bisa melihat pergerakan janin seperti sebuah video. Pemeriksaan kehamilan yang dilakukan pun menjadi lebih seru karena Ibu bisa melihat bagaimana buah hati beraksi di dalam rahim.', 'uploads/layanan_fasilitas/20250505_2228_header.jpeg', 'uploads/layanan_fasilitas/20250505_2228_lainnya.jpg', '2025-05-01 15:25:47', '2025-05-05 15:28:20'),
(4, 'Layanan Audiometri', 'Audiometri adalah pemeriksaan medis yang bertujuan untuk mengukur kemampuan pendengaran seseorang terhadap berbagai frekuensi dan intensitas suara. Pemeriksaan ini penting untuk mendeteksi gangguan pendengaran secara dini, baik karena faktor usia, paparan bising, infeksi telinga, maupun kondisi medis lainnya.', 'Klinik Sari Dharma menyediakan layanan audiometri dengan dukungan ruang pemeriksaan kedap suara, alat audiometer digital modern, serta tenaga medis terlatih. Hasil pemeriksaan disajikan dalam bentuk audiogram yang akurat dan dapat dicetak langsung untuk keperluan medis maupun administratif.', 'uploads/layanan_fasilitas/20250507_1316_header.jpeg', 'uploads/layanan_fasilitas/20250526_0909_lainnya.jpg', '2025-05-07 06:16:32', '2025-05-26 02:09:31'),
(5, 'Layanan Radiologi', 'Layanan radiologi kami menyediakan pemeriksaan Rontgen (X-ray) dan USG dengan teknologi modern dan standar keamanan tinggi.\r\nDidukung oleh tenaga medis profesional, hasil pemeriksaan cepat, akurat, dan terintegrasi untuk menunjang diagnosis dan perawatan pasien rawat jalan maupun rawat inap.', 'Ruang pemeriksaan dirancang agar nyaman dan aman, dengan penerapan standar proteksi radiasi sesuai pedoman medis. Setiap pemeriksaan ditangani oleh tenaga radiografer terlatih, dan hasilnya dikaji bersama dokter untuk memastikan penanganan yang tepat bagi pasien.\r\n\r\nFasilitas radiologi ini terbuka bagi pasien rawat jalan maupun rawat inap, serta terintegrasi dengan sistem pelayanan klinik untuk mempercepat proses diagnosis dan pengobatan secara menyeluruh.', 'uploads/layanan_fasilitas/20250521_0952_header.jpg', NULL, '2025-05-21 02:52:00', '2025-05-26 02:23:27'),
(6, 'Laboratorium', 'Layanan laboratorium Klinik Sari Dharma menyediakan berbagai pemeriksaan penunjang medis, seperti tes darah, urine, dan pemeriksaan kimia klinik lainnya. Dengan dukungan alat modern dan tenaga analis berpengalaman, hasil pemeriksaan disajikan secara cepat, akurat, dan dapat diandalkan untuk menunjang diagnosis serta pengobatan pasien.', 'Laboratorium Klinik Sari Dharma didukung oleh peralatan diagnostik modern dan tenaga analis kesehatan yang terlatih, untuk menjamin hasil pemeriksaan yang cepat, akurat, dan terpercaya. Kami melayani berbagai jenis tes laboratorium seperti pemeriksaan darah rutin, urine, gula darah, kolesterol, fungsi hati dan ginjal, serta parameter lain sesuai kebutuhan klinis pasien.\r\n\r\nProses pengambilan dan pengolahan sampel dilakukan dengan standar keamanan dan kebersihan tinggi, serta terintegrasi dengan pelayanan dokter untuk mendukung diagnosis dan pengobatan secara menyeluruh.\r\nLayanan ini tersedia bagi pasien rawat jalan maupun rawat inap, dengan sistem kerja yang efisien dan responsif.', 'uploads/layanan_fasilitas/20250526_1005_header.jpg', 'uploads/layanan_fasilitas/20250526_1005_lainnya.jpg', '2025-05-26 03:05:13', '2025-05-26 03:05:13'),
(7, 'Fisioterapi', 'Layanan fisioterapi di Klinik Sari Dharma membantu pemulihan fungsi gerak dan mengurangi nyeri akibat cedera, gangguan otot, tulang, sendi, atau saraf.\r\nDidukung oleh fisioterapis berpengalaman dan peralatan terapi yang sesuai standar medis, pelayanan ini ditujukan bagi pasien rawat jalan maupun rawat inap dengan pendekatan yang aman, nyaman, dan terarah.', 'Layanan fisioterapi di Klinik Sari Dharma membantu pemulihan fungsi gerak dan mengurangi nyeri akibat cedera, gangguan otot, tulang, sendi, atau saraf.', 'uploads/layanan_fasilitas/20250526_1027_header.jpg', 'uploads/layanan_fasilitas/20250526_1027_lainnya.jpg', '2025-05-26 03:27:22', '2025-05-30 13:33:12'),
(8, 'Layanan Home Care', 'Layanan Home Care Klinik Sari Dharma hadir untuk memberikan perawatan medis di rumah bagi pasien yang membutuhkan kenyamanan dan kemudahan tanpa harus datang ke fasilitas klinik. Tim medis kami terdiri dari dokter, perawat, dan tenaga kesehatan profesional yang siap memberikan layanan seperti perawatan luka, kontrol rutin, pemasangan infus, injeksi, hingga pemantauan kondisi pasien kronis.', 'Layanan Home Care Klinik Sari Dharma hadir untuk memberikan perawatan medis di rumah bagi pasien yang membutuhkan kenyamanan dan kemudahan tanpa harus datang ke fasilitas klinik. Tim medis kami terdiri dari dokter, perawat, dan tenaga kesehatan profesional yang siap memberikan layanan seperti perawatan luka, kontrol rutin, pemasangan infus, injeksi, hingga pemantauan kondisi pasien kronis.\r\n\r\nLayanan ini dirancang untuk menjaga kualitas perawatan tetap optimal dengan pendekatan yang personal, aman, dan profesional, khususnya bagi lansia, pasien pasca-rawat inap, atau mereka yang memiliki keterbatasan mobilitas.', 'uploads/layanan_fasilitas/20250526_1035_header.png', NULL, '2025-05-26 03:35:06', '2025-05-30 13:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `layanan_spesialis`
--

CREATE TABLE `layanan_spesialis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan_spesialis`
--

INSERT INTO `layanan_spesialis` (`id`, `nama_layanan`, `deskripsi`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Spesialis Anak', '<p>Menangani berbagai aspek kesehatan anak sejak usia bayi hingga remaja, termasuk imunisasi, pemantauan tumbuh kembang, serta penanganan penyakit akut maupun kronis. Pelayanan dilakukan dengan pendekatan holistik yang ramah anak dan komunikatif untuk mendukung tumbuh kembang optimal.</p>', 'mdiAccountChild', '2025-05-01 12:59:34', '2025-05-14 03:29:00'),
(2, 'Spesialis Bedah', '<p>Memberikan layanan tindakan bedah umum dan bedah khusus seperti bedah saluran cerna, hernia, kista, dan lainnya. Prosedur dilakukan oleh tim dokter bedah berpengalaman dengan standar keselamatan dan sterilisasi yang tinggi.</p>', 'mdiKnife', '2025-05-01 13:00:18', '2025-05-14 03:28:23'),
(4, 'Spesialis Penyakit Dalam', '<p>Layanan Spesialis Penyakit Dalam merupakan layanan unggulan di Klinik kami. Layanan ini dikhususkan untuk menangani berbagai keluhan dan penyakit yang berkaitan dengan organ-organ dalam, seperti gangguan pencernaan, ginjal, hati, diabetes, dan penyakit autoimun. Konsultasi dengan dokter spesialis penyakit dalam sangat penting untuk deteksi dini dan pengelolaan penyakit secara menyeluruh dan berkelanjutan.</p>', 'mdiDoctor', '2025-05-01 13:18:31', '2025-05-14 02:06:16'),
(5, 'Spesialis Jantung dan Pembuluh Darah', '<p>Spesialis Jantung dan Pembuluh Darah merupakan layanan unggulan di Klinik kami. Layanan ini menangani berbagai gangguan pada jantung dan sistem pembuluh darah, termasuk penyakit jantung koroner, hipertensi, aritmia, hingga gagal jantung. Dengan dukungan tenaga medis berpengalaman dan peralatan diagnostik canggih, kami berkomitmen memberikan penanganan terbaik untuk menjaga kesehatan jantung Anda.</p>', 'mdiCardsHeart', '2025-05-07 05:53:41', '2025-05-14 02:00:36'),
(6, 'Spesialis Kejiwaan', '<p>Layanan psikiatri kami membantu pasien dalam mengatasi gangguan kesehatan mental seperti depresi, gangguan kecemasan, stres berat, bipolar, hingga skizofrenia. Dengan pendekatan yang empatik dan rahasia, kami berupaya menciptakan ruang aman bagi Anda untuk pulih dan mendapatkan kualitas hidup yang lebih baik.</p>', 'mdiHeadCog', '2025-05-14 02:16:22', '2025-05-14 02:47:53'),
(7, 'Spesialis Mata', '<p>Menyediakan pemeriksaan dan penanganan untuk berbagai gangguan mata, mulai dari rabun jauh/dekat, katarak, glaukoma, hingga infeksi mata. Pemeriksaan dilakukan secara menyeluruh oleh dokter spesialis mata yang kompeten dengan alat diagnostik yang mutakhir.</p>', 'mdiEye', '2025-05-14 02:51:17', '2025-11-24 03:37:25'),
(8, 'Spesialis THT-KL', 'Melayani penanganan berbagai keluhan dan penyakit pada telinga, hidung, tenggorokan, kepala, dan leher seperti sinusitis, radang tenggorokan, infeksi telinga, serta gangguan pendengaran. Pemeriksaan dilakukan secara profesional untuk memastikan penanganan yang tepat dan tuntas.', 'mdiEarHearing', '2025-05-14 03:12:16', '2025-05-14 03:12:16'),
(9, 'Spesialis Saraf', '<p>Spesialis Saraf di klinik kami mengatasi gangguan sistem saraf pusat dan perifer seperti stroke, migrain, epilepsi, gangguan tidur, hingga penyakit neurodegeneratif. Layanan ini dilengkapi dengan evaluasi neurologis menyeluruh dan dukungan penunjang medis yang akurat.</p>', 'mdiHubOutline', '2025-05-14 03:27:32', '2025-06-30 12:43:11'),
(10, 'Spesialis Orthopedi dan Traumatologi', 'Menangani cedera dan kelainan pada sistem muskuloskeletal termasuk tulang, sendi, dan otot. Layanan ini meliputi penanganan patah tulang, osteoarthritis, skoliosis, serta rehabilitasi pasca-operasi ortopedi untuk memulihkan fungsi gerak secara maksimal.', 'mdiBone', '2025-05-14 03:31:19', '2025-05-14 03:31:19'),
(11, 'Poliklinik Gigi', 'Menyediakan layanan kesehatan gigi dan mulut secara lengkap mulai dari perawatan karies, pembersihan karang gigi, tambal gigi. Kami menjamin pelayanan dengan standar kenyamanan dan higienitas tinggi.', 'mdiTooth', '2025-05-14 03:33:05', '2025-05-14 03:33:05'),
(12, 'Spesialis Radiologi', 'Menyediakan layanan pemeriksaan radiologi seperti rontgen, USG, CT scan, dan pemeriksaan pencitraan lainnya untuk menunjang proses diagnosis dan perawatan secara tepat. Layanan dilakukan oleh tenaga profesional dengan hasil cepat, akurat, dan terpercaya.', 'mdiRadioactiveCircle', '2025-05-14 03:50:10', '2025-05-14 03:50:10'),
(13, 'Laboratorium', 'Menawarkan berbagai jenis pemeriksaan laboratorium seperti darah lengkap, urine, fungsi hati dan ginjal, hingga tes hormonal. Hasil analisis laboratorium kami sangat membantu dalam menentukan diagnosis yang akurat dan pemantauan kondisi kesehatan pasien.', 'mdiNeedle', '2025-05-14 04:16:40', '2025-05-14 04:16:40'),
(14, 'Fisioterapi', 'Memberikan layanan rehabilitasi fisik yang bertujuan mengembalikan fungsi gerak tubuh akibat cedera, penyakit, atau pasca-operasi. Dengan pendekatan terapi manual, latihan fisik, dan alat bantu modern, fisioterapis kami siap membantu pemulihan Anda secara bertahap dan optimal.', 'mdiHumanMaleBoardPoll', '2025-05-14 04:23:49', '2025-05-14 04:23:49'),
(15, 'Poliklinik Umum', '<p>Layanan Dokter Umum di Klinik Sari Dharma menyediakan pemeriksaan kesehatan dasar, diagnosa awal, serta penanganan berbagai keluhan medis sehari-hari. Dokter umum kami memberikan konsultasi, pemeriksaan fisik, tindakan medis ringan, serta rujukan ke spesialis bila diperlukan.</p><p>Dengan pendekatan ramah, profesional, dan menyeluruh, kami memastikan setiap pasien mendapatkan perawatan yang tepat, cepat, dan nyaman.</p>', 'mdiAccountMultiple', '2025-08-06 07:41:40', '2025-11-24 03:42:46'),
(17, 'Spesialis Dermatologi, Venereologi, dan Estetika', 'Layanan ini menangani berbagai masalah kulit, rambut, dan kuku, termasuk infeksi, alergi, peradangan, hingga keluhan estetika. Dokter spesialis kami juga memberikan penanganan untuk infeksi menular seksual (IMS) dengan pendekatan profesional dan menjaga kerahasiaan pasien.\n\nSelain pengobatan kulit, kami menyediakan perawatan estetika medis seperti facial, chemical peeling, perawatan jerawat, pencerahan kulit, serta terapi anti-aging yang aman dan sesuai standar.\nDengan pemeriksaan menyeluruh dan peralatan modern, kami berkomitmen memberikan solusi terbaik untuk kesehatan dan kecantikan kulit Anda.', 'mdiAccountHeart', '2025-11-24 03:41:04', '2025-11-24 03:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `layanan_unggulan`
--

CREATE TABLE `layanan_unggulan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan_unggulan`
--

INSERT INTO `layanan_unggulan` (`id`, `nama_layanan`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'Layanan Vaksinasi', '<p>Saatnya membangun perlindungan kesehatan sejak dini! Klinik Utama Rawat Inap Sari Dharma menyediakan <strong>Layanan Vaksinasi Lengkap</strong> untuk anak hingga dewasa dengan standar keamanan tinggi. Setiap vaksin diberikan oleh perawat terlatih dan dipantau dokter, memastikan pengalaman yang aman dan nyaman.</p><p><strong>Cegah lebih awal, sehat lebih lama.</strong></p>', 'uploads/layanan_unggulan/20250505_2226.jpeg', '2025-04-30 13:25:19', '2025-12-08 02:32:21'),
(5, 'Layanan Medical Checkup', '<p>Sehat dimulai dari mengetahui kondisi tubuh Anda.</p><p>Dengan <strong>Medical Check Up (MCU) Komprehensif</strong> di Klinik Sari Dharma, Anda mendapatkan pemeriksaan lengkap mulai dari laboratorium, rontgen, hingga konsultasi dokter. Hasil cepat, proses nyaman, dan paket MCU tersedia untuk semua kebutuhan.</p><p>Deteksi dini menyelamatkan lebih banyak hidup. Mulai hari ini.</p>', 'uploads/layanan_unggulan/20250505_2226.png', '2025-04-30 13:58:31', '2025-12-08 02:36:20'),
(8, 'Layanan Holter Jantung', '<p><strong>Holter Jantung</strong> adalah alat pemantau jantung portabel yang merekam aktivitas listrik jantung secara terus-menerus selama 24 jam atau lebih. Pemeriksaan ini sangat bermanfaat untuk mendeteksi gangguan irama jantung (aritmia) yang tidak selalu muncul saat pemeriksaan EKG biasa.</p><p>Di Klinik Utama Rawat Inap Sari Dharma, kami menyediakan <strong>layanan Holter Jantung sebagai salah satu layanan unggulan</strong> yang belum tentu tersedia di semua fasilitas kesehatan. Alat ini memungkinkan dokter menganalisis irama jantung pasien dalam kondisi aktivitas sehari-hari, sehingga memberikan hasil yang lebih akurat dan komprehensif.</p><p><br></p><p><strong>Manfaat Holter Jantung:</strong></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Mendeteksi aritmia yang terjadi secara sporadis</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Mengevaluasi keluhan jantung seperti jantung berdebar, pusing, atau pingsan</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Menilai efektivitas terapi atau obat jantung</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Pemantauan setelah tindakan medis tertentu</li></ol><p><br></p><p>Layanan ini didukung oleh <strong>tenaga medis profesional</strong> dan proses pembacaan hasil yang cepat serta akurat.</p><p><strong>Jadwalkan pemeriksaan Holter Jantung Anda hari ini</strong> dan dapatkan penanganan jantung lebih tepat sejak dini.</p>', 'uploads/layanan_unggulan/20250520_143420.jpeg', '2025-05-20 07:34:20', '2025-05-20 07:34:20'),
(11, 'Layanan Endoskopi THT', '<p>Endoskopi THT dilakukan untuk mendeteksi penyakit yang terjadi pada organ yang terkait dengan telinga, hidung, dan tenggorokan.Ini termasuk dengan bronkus, esofagus, dan laring. Melalui alat khusus, dokter dapat melihat permasalahan yang terjadi pada organ-organ inti dan semua organ pendukung yang mungkin turut mempengaruhi.</p><p><br></p><p>Endoskopi THT digunakan untuk melakukan pemeriksaan menyeluruh pada sinus dan polip</p>', 'uploads/layanan_unggulan/20250521_092904.jpg', '2025-05-21 02:29:04', '2025-05-21 02:38:30'),
(12, 'Layanan Audiometri', '<p>Audiometri adalah pemeriksaan yang bertujuan untuk memeriksa fungsi pendengaran. Pemeriksaan audiometri penting dilakkan karena seiring bertambahnya usia, seseorang dapat mengalami ganguuan kesehatan.</p><p><br></p><p>Pemeriksaan Audiometri diperlukan terutama jika mengalami gejala, antara lain:</p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Sulit mendengar ucapan orang lain</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Telinga berdenging terus-menerus (tinnitus)</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Sering meminta orang lain mengulang pembicaraan</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Menonton televisi atau menyetel musik dengan keras</li></ol>', 'uploads/layanan_unggulan/20251208_1000.jpg', '2025-05-21 02:38:12', '2025-12-08 03:00:54'),
(16, 'Layanan Foto Rontgen (X-Ray)', '<p>Layanan <strong>Foto Rontgen</strong> kami menyediakan pemeriksaan pencitraan menggunakan sinar-X untuk membantu mendeteksi masalah pada tulang, paru-paru, dan organ tertentu. Dengan teknologi yang tepat dan tenaga profesional berpengalaman, proses pemeriksaan berlangsung cepat, aman, serta menghasilkan gambar yang akurat sebagai dasar penegakan diagnosis.</p>', 'uploads/layanan_unggulan/20251208_101159.jpg', '2025-12-08 03:11:59', '2025-12-08 03:11:59'),
(17, 'Laboratorium', '<p>Klinik Sari Dharma menghadirkan layanan laboratorium dengan teknologi terkini yang memungkinkan deteksi dini berbagai kondisi kesehatan. Hasil lebih cepat, konsultasi mudah, dan pelayanan ramah menjadikan pengalaman pemeriksaan lebih nyaman untuk pasien.</p>', 'uploads/layanan_unggulan/20260203_2347.jpg', '2025-12-08 03:27:17', '2026-02-03 16:47:31'),
(19, 'Layanan Ekokardiografi - USG Jantung', '<p><strong>Ekokardiografi</strong> bermanfaat bagi penderita penyakit jantung atau ketika ada gejala yang berkaitan dengan penyakit jantung. Gambar atau ekokardiogram akan diteliti dokter untuk mengetahui kondisi struktur dan fungsi jantung. Informasi yang muncul dari ekokardiogram antara lain:</p><ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Gumpalan darah di balik jantung</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Cairan di kantung sekitar jantung</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Masalah pada aorta atau pembuluh darah yang terhubung ke jantung</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>masalah pada fungsi pompa jantung</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Masalah pada fungsi katup jantung</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Tekanan pada jantung</li></ol><p>Ekokardiogradi juga menjadi kunci untuk menentukan kondisi otot jantung, terutama setelah seseorang terkena serangan jantung.</p>', 'uploads/layanan_unggulan/20260203_234202.jpg', '2026-02-03 16:42:02', '2026-02-03 16:42:02'),
(20, 'Layanan Treadmil', '<p>Pemeriksaan Treadmill biasanya digunakan untuk mendeteksi adanya penyakit yang berkaitan dengan jantung, seperti :</p><p><br></p><p>Diagnosis Penyakit Arteri Koroner</p><p>Arteri koroner adalah pembuluh darah utama yang memasok darah, oksigen, dan nutrisi ke jantung. Penyakit arteri koroner berkembang ketika arteri ini menjadi rusak atau sakit, biasanya karena penumpukan deposit yang mengandung kolestrol dan zat lain (plak).</p><p><br></p><p>Mendiagnosis Masalah Irama Jantung</p><p>Masalah Irama Jantung (Aritmia) terjadi ketika impuls listrik yang mengkoordinasikan irama jantung tidak berfungsi dengan benar. Ini menyebabkan jantung berdetak terlalu cepat, terlalu lambat atau tidak teratur.</p><p><br></p><p>Panduan Pengobatan Gangguan Jantung</p><p>Pemeriksaan treadmill dapat membantu dokter untuk mengetahui seberapa baik pengobatan bekerja. Ini juga dapat digunakan untuk membantu menetapkan rencana perawatan, dengan menunjukkan beberapa banyak latihan yang dapat ditangani Jantung.</p>', 'uploads/layanan_unggulan/20260203_234453.jpg', '2026-02-03 16:44:53', '2026-02-03 16:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `master_dokter`
--

CREATE TABLE `master_dokter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_dokter`
--

INSERT INTO `master_dokter` (`id`, `nama_dokter`, `foto`, `created_at`, `updated_at`) VALUES
(5, 'Dr. dr Bagus Ari Pradnyana Dwi S., Sp.JP(K)', 'uploads/master_dokter/20250507_1245.jpg', '2025-05-07 05:45:08', '2025-05-14 02:18:03'),
(6, 'dr. I G.A.A Mirah Sanjiwani, Sp.JP', 'uploads/master_dokter/20250722_1257.jpg', '2025-05-14 02:17:22', '2025-07-22 05:57:21'),
(7, 'dr I Made Bagus Endra Permana, Sp.JP', NULL, '2025-05-14 02:18:53', '2025-05-14 02:18:53'),
(8, 'dr I.B Aditya Nugraha, Sp.PD', 'uploads/master_dokter/20260205_1433.jpg', '2025-05-14 02:19:12', '2026-02-05 07:33:58'),
(9, 'dr. Wayan Giri Putra Semaradana, Sp.PD', 'uploads/master_dokter/20250731_2010.png', '2025-05-14 02:19:55', '2025-07-31 13:10:06'),
(10, 'dr. Luh Komang Widnyani Wulan Laksmi, Sp.PD', 'uploads/master_dokter/20250514_0946.png', '2025-05-14 02:20:34', '2025-05-14 02:46:13'),
(11, 'dr. Putu Dewi Pradnyawati, Sp.KJ', NULL, '2025-05-14 02:24:10', '2025-05-14 02:24:10'),
(12, 'dr. Friska Natalia Yuwono, Sp.KJ', NULL, '2025-05-14 02:24:58', '2025-05-14 02:24:58'),
(13, 'dr. Ni Putu Ayu Werdhiatmi, Sp.KJ', NULL, '2025-05-14 02:25:24', '2025-05-14 02:25:24'),
(14, 'dr. Amita Rouli Purnama Sitanggang, Sp. KJ', 'uploads/master_dokter/20250514_0947.png', '2025-05-14 02:26:21', '2025-05-14 02:47:17'),
(15, 'dr. A.A.N Putra Asryana, Sp.M', NULL, '2025-05-14 02:26:52', '2025-05-14 02:26:52'),
(17, 'dr. I Made Dwi Surya Wibawa, Sp.M', NULL, '2025-05-14 02:27:52', '2025-05-14 02:27:52'),
(18, 'DR. dr. Sari Wulan Dwi Sutanegara, Sp.THT-KL(K)', NULL, '2025-05-14 02:28:34', '2025-05-14 02:28:34'),
(19, 'dr. I Putu Yupindra Pradiptha, Sp.THT-KL', NULL, '2025-05-14 02:29:01', '2025-05-14 02:29:01'),
(20, 'dr. Cokorda Istri Gangga Dewi, Sp.N', 'uploads/master_dokter/20250701_1428.png', '2025-05-14 02:29:30', '2025-07-01 18:28:01'),
(21, 'dr. Indira Chadijah Triatmoko, Sp.N', NULL, '2025-05-14 02:29:51', '2025-05-14 02:29:51'),
(22, 'dr. Luh Putu Widhyapsari Jayanti, Sp.N', NULL, '2025-05-14 02:30:13', '2025-05-14 02:30:13'),
(23, 'dr. Ni Nyoman Tri Premani, Sp.N', NULL, '2025-05-14 02:30:29', '2025-05-14 02:30:29'),
(24, 'dr. I Gusti Bagus Dwi Rangkuty Agung, Sp.B', NULL, '2025-05-14 02:31:04', '2025-05-14 02:31:04'),
(25, 'dr. Made Asmara Yoga, Sp.OT', 'uploads/master_dokter/20250701_1431.jpg', '2025-05-14 02:31:44', '2025-07-01 18:31:40'),
(26, 'drg. Ni Made Mirah Maharani', NULL, '2025-05-14 02:32:13', '2025-05-14 02:32:13'),
(27, 'drg. Pniella Myddiyant', NULL, '2025-05-14 02:32:26', '2025-05-14 02:32:26'),
(28, 'dr. I Putu Aditha Satya Putra, Sp.Rad', NULL, '2025-05-14 02:33:00', '2025-05-14 02:33:00'),
(29, 'dr. Pande Putu Ayu Patria Dewi, Sp.PK', NULL, '2025-05-14 02:33:28', '2025-05-14 02:33:28'),
(30, 'Ida Ayu Astiti Suadnyana, S.Ft., M.Fis., Ftr', NULL, '2025-05-14 02:33:58', '2025-05-14 02:33:58'),
(31, 'dr. Ni Wayan Ayu Yuliantari, Sp.A', NULL, '2025-06-30 12:42:03', '2025-06-30 12:42:03'),
(32, 'dr. Sagung Novita Widya Ningrat', NULL, '2025-08-06 07:38:45', '2025-08-06 07:38:45'),
(33, 'dr. I Made Hendita Krisnabayu', NULL, '2025-08-06 07:42:15', '2025-08-06 07:42:15'),
(34, 'dr. Luh Anggreni Yulia', NULL, '2025-08-06 07:42:32', '2025-08-06 07:42:32'),
(35, 'dr. Ni Made Desy Suryantini', NULL, '2025-08-06 07:42:42', '2025-08-06 07:42:42'),
(36, 'dr. Gede Giofany Achaldy Indra Pradnya Rudi Suryantara', NULL, '2025-08-06 07:42:59', '2025-08-06 07:42:59'),
(38, 'dr. Ratna Sari Dewi, Sp.M', 'uploads/master_dokter/20251124_0945.png', '2025-11-24 02:45:52', '2025-11-24 02:45:52'),
(39, 'dr. Luh Putu Rani Sarasmita, Sp.DVE', 'uploads/master_dokter/20251124_0946.png', '2025-11-24 02:46:44', '2025-11-24 02:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori`
--

CREATE TABLE `master_kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_kategori`
--

INSERT INTO `master_kategori` (`id`, `name`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'Kategori 3', 'PaketKesehatan', '2025-05-01 13:28:39', '2025-08-06 07:22:22'),
(2, 'Kategori 2', 'PaketKesehatan', '2025-05-01 13:28:52', '2025-05-01 13:28:52'),
(3, 'Edukasi Kesehatan', 'ArtikelKesehatan', '2025-05-01 13:44:06', '2025-05-01 13:44:06'),
(4, 'Pelatihan', 'EventCommunity', '2025-05-01 22:42:32', '2025-05-01 22:42:32'),
(5, 'Divisi Finance', 'KarirKlinik', '2025-05-02 00:40:21', '2025-05-02 00:40:21'),
(6, 'Edukasi Kesehatan 2', 'ArtikelKesehatan', '2025-05-07 07:46:24', '2025-05-07 07:46:24'),
(7, 'Divisi SDM', 'KarirKlinik', '2025-05-07 07:46:57', '2025-05-07 07:46:57'),
(8, 'Kategori 1', 'PaketKesehatan', '2025-08-05 08:10:44', '2025-08-05 08:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2023_09_30_000000_create_master_kategori_table', 1),
(5, '2023_10_01_000000_create_layanan_unggulan_table', 1),
(6, '2023_10_01_000001_create_layanan_spesialis_table', 1),
(7, '2023_10_01_000002_create_layanan_fasilitas_table', 1),
(8, '2023_10_01_000002_create_master_dokter_table', 1),
(9, '2023_10_01_000003_create_jadwal_dokter_table', 1),
(10, '2023_10_01_000004_create_paket_kesehatan_table', 1),
(11, '2023_10_01_000005_create_artikel_kesehatan_table', 1),
(12, '2023_10_01_000006_create_event_community_table', 1),
(13, '2023_10_01_000007_create_indikator_mutu_table', 1),
(14, '2023_10_01_000008_create_karir_table', 1),
(15, '2023_10_01_000009_create_konten_social_media_table', 1),
(16, '2023_10_01_000010_create_sertifikasi_penghargaan_table', 1),
(17, '2023_11_15_000000_add_foto_to_indikator_mutu_table', 1),
(18, '2023_11_15_000001_add_foto_to_sertifikasi_penghargaan_table', 1),
(19, '2025_04_04_155317_create_oauth_auth_codes_table', 1),
(20, '2025_04_04_155318_create_oauth_access_tokens_table', 1),
(21, '2025_04_04_155319_create_oauth_refresh_tokens_table', 1),
(22, '2025_04_04_155320_create_oauth_clients_table', 1),
(23, '2025_04_04_155321_create_oauth_personal_access_clients_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('02545a6c34a17a648eaa4ac0f27d488cd3fe8a34da52643cce184ea589da34fb3b14b4436702d9bd', 2, 1, 'passportToken', '[]', 0, '2025-04-30 11:29:07', '2025-04-30 11:29:07', '2026-04-30 18:29:07'),
('027d301b986218dfc64fcb066cc223f341c65c411b3daf69593c8f669ea81f3492ab68496c464512', 1, 1, 'passportToken', '[]', 0, '2025-05-20 06:51:01', '2025-05-20 06:51:01', '2026-05-20 13:51:01'),
('0321f5f932ac01a83374212dc5517d7ae1bdb5928fc7ca9b05f1d5bdd0b5af61f5fd7050a25fae1e', 10, 1, 'passportToken', '[]', 0, '2025-12-18 02:09:58', '2025-12-18 02:09:58', '2026-12-18 09:09:58'),
('05a0bca5fccce6a280c20d7dbcc3964b2b4c0023fad057386348cd5bcd900dc336e82d962772f3bc', 1, 1, 'passportToken', '[]', 0, '2025-06-02 11:35:10', '2025-06-02 11:35:10', '2026-06-02 18:35:10'),
('0bc35df654f6e2d3555e397aaa6edcac8070c43cf9fafc3bd06fdec6404d476486d055f063740b3f', 11, 1, 'passportToken', '[]', 0, '2025-11-01 07:53:39', '2025-11-01 07:53:39', '2026-11-01 14:53:39'),
('0efb9fad06f8487189ef5bb7fa2c75d3e2d4663b8f7c4c5c5e96207b498ed403bde5e3a49ef73285', 10, 1, 'passportToken', '[]', 0, '2025-12-02 16:41:34', '2025-12-02 16:41:34', '2026-12-02 23:41:34'),
('11cb6b35a17ede9e7e2c6e23ae33feb716bf3867ac635eac91af542de04610c9f5b91cd895a1b098', 5, 1, 'passportToken', '[]', 0, '2025-07-05 10:26:59', '2025-07-05 10:26:59', '2026-07-05 17:26:59'),
('11d34abac55d7eff15e58e7a6748cbcc5f79bf1ecdc47f28f4b04fa5d3e8716a966a512183e379d0', 10, 1, 'passportToken', '[]', 0, '2025-12-22 07:55:55', '2025-12-22 07:55:55', '2026-12-22 14:55:55'),
('122791b19acfeff8ca69b4e6128659a03805045db0317f34e43346aa36fdd94f28ec5b67356c6c4b', 1, 1, 'passportToken', '[]', 0, '2025-05-07 05:32:13', '2025-05-07 05:32:13', '2026-05-07 12:32:13'),
('125c3432d7660c690fb04e7c20b11fbfd0eb6ddd18c4c2e2f0fc1e7bc886cd8d31b3fd31252a5d50', 10, 1, 'passportToken', '[]', 0, '2026-02-09 07:09:34', '2026-02-09 07:09:34', '2027-02-09 14:09:34'),
('1334c6111a46256c970ed62b98b4d86c68a047e3f51d901a5fe4e9d18b2d6523f01710835b110d10', 10, 1, 'passportToken', '[]', 0, '2025-12-08 02:23:06', '2025-12-08 02:23:06', '2026-12-08 09:23:06'),
('146fa49ddcd96e723d5b8eb042f31a15268ca62498df03587c0d9c3926dafef9266cfc35c9c161cb', 10, 1, 'passportToken', '[]', 0, '2026-02-23 09:01:39', '2026-02-23 09:01:42', '2027-02-23 16:01:39'),
('14a4079e7f58bc704aef331e37a447a8985360567f36656f65351a8a78f79079c04480bf45948dac', 4, 1, 'passportToken', '[]', 0, '2025-05-28 23:19:07', '2025-05-28 23:19:07', '2026-05-29 06:19:07'),
('14b0c19df7a6ca3cc11aeb5cba012e0a8b8c62fc3ea23d580bb399e797f6ebf35f11290080ec77b4', 9, 1, 'passportToken', '[]', 0, '2025-06-24 16:55:11', '2025-06-24 16:55:11', '2026-06-24 12:55:11'),
('18545fe259c0d4eb75a09d1ac3f1a7fe1b2aa92e51216b505e2b2b83bd6c023c1658ee4380066419', 11, 1, 'passportToken', '[]', 0, '2025-08-03 07:51:33', '2025-08-03 07:51:33', '2026-08-03 14:51:33'),
('1ac83f672b580e3a3e619d387273f0174bbc80b43435ca04577805d076d8763257b9277b506d4b34', 10, 1, 'passportToken', '[]', 0, '2025-07-05 11:37:42', '2025-07-05 11:37:42', '2026-07-05 18:37:42'),
('1c50d2ae6c1d8de153c9d853896f019c6e5181c916d96986e3c04dc221fcd6ad3fee5e42f5a4a775', 10, 1, 'passportToken', '[]', 0, '2025-12-04 01:28:04', '2025-12-04 01:28:04', '2026-12-04 08:28:04'),
('1ce7093ee7a0f8625c30d091b4e41a0351ae15c0bd9845bf5894c77991176e09efbb7103d2b3bcf4', 11, 1, 'passportToken', '[]', 0, '2025-12-23 14:37:18', '2025-12-23 14:37:20', '2026-12-23 21:37:18'),
('232039f4029f7e0b3251de43674e1bbcbabff7e323eb0e9167665a670004baa69f89a4e8a9b31b48', 4, 1, 'passportToken', '[]', 0, '2025-05-30 13:31:13', '2025-05-30 13:31:13', '2026-05-30 20:31:13'),
('29e3a194b8fa840895a6cd30da7247b0b3515b6abca7c930ed07c2bbe48276b996df021fbf362a62', 10, 1, 'passportToken', '[]', 0, '2025-06-27 15:32:40', '2025-06-27 15:32:40', '2026-06-27 11:32:40'),
('30902fc306f5939568da7b52594b96a9bfed43af3932284e4ef72e473d882feb9c1869baa674d0f4', 9, 1, 'passportToken', '[]', 0, '2025-06-24 06:04:52', '2025-06-24 06:04:52', '2026-06-24 02:04:52'),
('3323652ecaa3971976f81bbc903df7de22d978cc04b6cc1e4afac2f0ff3df5f9210802e228525fab', 10, 1, 'passportToken', '[]', 0, '2026-02-24 02:01:13', '2026-02-24 02:01:15', '2027-02-24 09:01:13'),
('35ed9e302bfb18f614c01e9d2485ea32615b63ba82e20b533906673c7188233b854429c10097b372', 4, 1, 'passportToken', '[]', 0, '2025-05-29 15:45:50', '2025-05-29 15:45:50', '2026-05-29 22:45:50'),
('3686d9789505c9e93204a591a45d62e20fa4bdae95615b7f4a79724c23a1fee532ab3be0c296e67a', 9, 1, 'passportToken', '[]', 0, '2025-06-24 07:38:47', '2025-06-24 07:38:47', '2026-06-24 03:38:47'),
('36d96c123cfeaa51c9b9e1b0b8dae4dccd0cad883a2b26afaeb0cab76f6e8e6a2804830b8350d4d6', 11, 1, 'passportToken', '[]', 0, '2025-09-05 03:00:21', '2025-09-05 03:00:21', '2026-09-05 10:00:21'),
('3887edf99bd47a7c3107652799acadbd0389a3e283acbe863e4bf1460cfe5908e4a24ffef9d9bbed', 10, 1, 'passportToken', '[]', 0, '2025-07-01 18:13:39', '2025-07-01 18:13:39', '2026-07-01 14:13:39'),
('3a68e77750ce8d53a7f5bef2bd8591a0e15ca7309742fa488c40c15166e42dd691d479f225486f16', 10, 1, 'passportToken', '[]', 0, '2025-07-08 16:38:39', '2025-07-08 16:38:39', '2026-07-08 23:38:39'),
('3c3bfe23e38a78e3916e65d1c278c6844aabb555d793f1109bbeea7cf7e0fac2a1ddf72d2f94a713', 5, 1, 'passportToken', '[]', 0, '2025-06-25 02:30:05', '2025-06-25 02:30:05', '2026-06-24 22:30:05'),
('3e92405a0bccacb0032d1f9e2e4d18d2ae1310a04353882c1bce021a72d60df2be111a5667d58605', 11, 1, 'passportToken', '[]', 0, '2025-08-06 01:08:35', '2025-08-06 01:08:35', '2026-08-06 08:08:35'),
('4088a1531fa6f15443608ef1863decc91a53a18979773c49c188fbc21e4c04ad397c7fb69e199b6e', 10, 1, 'passportToken', '[]', 0, '2025-11-12 12:36:44', '2025-11-12 12:36:44', '2026-11-12 19:36:44'),
('41ebb72b61f27b576b2397e11e280cac750172bef88c62df6046d1df4ea4ec8f535b8b9f48d837d2', 11, 1, 'passportToken', '[]', 0, '2025-08-08 07:07:50', '2025-08-08 07:07:50', '2026-08-08 14:07:50'),
('47293bd9ebb73e85b8112ee9d2485ab08b5b13c6641bbaa38fcede58838540d6ce6fcbf563bbc9e6', 10, 1, 'passportToken', '[]', 0, '2025-07-22 05:54:52', '2025-07-22 05:54:52', '2026-07-22 12:54:52'),
('478cf65bab20a6c4e5acde5bbc0b2e0769530ddcc55a0b7900fd360c81f7d0725bfc3e8bbde50222', 11, 1, 'passportToken', '[]', 0, '2025-11-28 13:22:12', '2025-11-28 13:22:12', '2026-11-28 20:22:12'),
('4a22fcb12a94cda23ebe289d6404ec53e79cecc0b35d2f182c8f57f7ef0f769efd80957a3c8b18bb', 10, 1, 'passportToken', '[]', 0, '2026-02-23 09:02:03', '2026-02-23 09:02:03', '2027-02-23 16:02:03'),
('4b80e58206e959d5e8f151dabaaf3281f04443b98e08c915ee58e5c68449e557d7fa11cc96145c15', 10, 1, 'passportToken', '[]', 0, '2025-12-08 02:22:59', '2025-12-08 02:22:59', '2026-12-08 09:22:59'),
('4d14be0d68be4895a932466eb63a2774f9a455c4da45b7790c98a2934755ca273c08acd474ff431e', 9, 1, 'passportToken', '[]', 0, '2025-06-24 06:54:53', '2025-06-24 06:54:53', '2026-06-24 02:54:53'),
('4f2273dab9589fbf40a2b7ecbaee8c856e723d41c9c49dd3475566c3c3982f5eb439c53a90314d6b', 10, 1, 'passportToken', '[]', 0, '2026-01-05 01:45:32', '2026-01-05 01:45:32', '2027-01-05 08:45:32'),
('53c4115bacee19e11d44c7d267c61d754c82d902b6611d4d6e09521f246a78b38257607b81cb977e', 1, 1, 'passportToken', '[]', 0, '2025-05-28 23:49:51', '2025-05-28 23:49:51', '2026-05-29 06:49:51'),
('56fe191e1e433c9d9683e0f5d622677d6648799eab761c686b5e15e9f21c8302ae77548329387260', 1, 1, 'passportToken', '[]', 0, '2025-05-29 00:54:23', '2025-05-29 00:54:23', '2026-05-29 07:54:23'),
('5a143d707856eb14ffa3c304fad8d94763242a9099d37391548f2299a926f0e88a042c70d42c0d2a', 2, 1, 'passportToken', '[]', 0, '2025-05-01 12:45:47', '2025-05-01 12:45:47', '2026-05-01 19:45:47'),
('5de3e29ccd58c98624b735a4b23776b2e4b1f567548d41149faaf61b28a654914b28e03aeb7b43cd', 10, 1, 'passportToken', '[]', 0, '2025-12-18 02:10:30', '2025-12-18 02:10:30', '2026-12-18 09:10:30'),
('5fc300af66122b433bab4230c3a7091eeebeb370db6580ea80b40a76301a21494fd046e71ffcf8a6', 1, 1, 'passportToken', '[]', 0, '2025-05-24 01:21:40', '2025-05-24 01:21:40', '2026-05-24 08:21:40'),
('6403ac047144133cfb21db7fcedaf2dcfa302d70b7d943df845eb981712957a8b9b63303d301210f', 1, 1, 'passportToken', '[]', 0, '2025-05-21 01:25:28', '2025-05-21 01:25:28', '2026-05-21 08:25:28'),
('64c4ab16fe84dafd753536d064a4e6c52865027beabde21266bbac831d2c0f17b4fcc5e76bbeb9b4', 1, 1, 'passportToken', '[]', 0, '2025-05-24 05:05:53', '2025-05-24 05:05:53', '2026-05-24 12:05:53'),
('6903cb7bc4d6eeb486280a677f2f52d6a05acd30cf84c90d9cc9fadd2a7f9d74caf9d467396a7606', 10, 1, 'passportToken', '[]', 0, '2025-12-18 02:10:15', '2025-12-18 02:10:15', '2026-12-18 09:10:15'),
('6ab237897e44e0884b9cfc36cbe1caf4e916677e344ec3bfb835520ff650f8092dd7b152481373de', 5, 1, 'passportToken', '[]', 0, '2025-06-25 02:30:59', '2025-06-25 02:30:59', '2026-06-24 22:30:59'),
('6c8e48f02cf0574710fe22a1ca6f6e736553269157cf8de701615f1c5cbe8d8254918ed85cefb474', 1, 1, 'passportToken', '[]', 0, '2025-05-30 02:56:08', '2025-05-30 02:56:08', '2026-05-30 09:56:08'),
('6d82ec90afff60fff6f2ce48bd19cd54b808408965bb774671f4ad9f85e35a121044b8682b58ac14', 5, 1, 'passportToken', '[]', 0, '2025-06-25 03:22:50', '2025-06-25 03:22:50', '2026-06-24 23:22:50'),
('6eaa6ea8c461550a7003136dd1684205393535f97c30b8d58cf9d6829e62297e62ca8e091ebe770f', 11, 1, 'passportToken', '[]', 0, '2025-07-31 16:45:14', '2025-07-31 16:45:14', '2026-07-31 23:45:14'),
('710dc6a85ae2adc78eb3e603b430083edf3a6bf1cabd98af26b2fed06138be326e20bd99b2267c1b', 11, 1, 'passportToken', '[]', 0, '2025-08-04 07:51:31', '2025-08-04 07:51:31', '2026-08-04 14:51:31'),
('7143cfb2e0373d76a65e0f7257b7b75c76d6c2dffa0f183f67f6c2a6aeb23c2e722a09dbbfb7ef6e', 11, 1, 'passportToken', '[]', 0, '2025-08-04 08:05:10', '2025-08-04 08:05:10', '2026-08-04 15:05:10'),
('75290f3c781ae6317886965b0ab508444b0738d097fc89185eb44fefa3285ebfdcc54c1bf2d27310', 11, 1, 'passportToken', '[]', 0, '2025-08-08 07:34:51', '2025-08-08 07:34:51', '2026-08-08 14:34:51'),
('76594c5900bc2820630480776fe76f0bb141e40b12455b6abf4c525f136626f503f4e335fd1a931f', 11, 1, 'passportToken', '[]', 0, '2025-08-06 13:07:13', '2025-08-06 13:07:13', '2026-08-06 20:07:13'),
('76b14c6c208c463424c14004a690081ae5951151bfc6c1c536d69ce8c377cb93e9907dc6a369ff8e', 10, 1, 'passportToken', '[]', 0, '2025-11-26 02:31:20', '2025-11-26 02:31:20', '2026-11-26 09:31:20'),
('7a9be831a5d8d44398e75fb510cd0cd0effc49501c06eb202d2e79e9a0d8a0a4d08afe5201ad6289', 10, 1, 'passportToken', '[]', 0, '2025-11-24 06:02:14', '2025-11-24 06:02:14', '2026-11-24 13:02:14'),
('7e755be0ba82cb15998b82a1df36c392a1ef58f05dedb976fb670a8e21ec5ff188f505f5bf3afb70', 1, 1, 'passportToken', '[]', 0, '2025-05-24 05:06:00', '2025-05-24 05:06:00', '2026-05-24 12:06:00'),
('81062cc8f366b88619e480631513bf932d1757de27aa69bc6bc17c86c5ec43ec30699e37fa6302e5', 11, 1, 'passportToken', '[]', 0, '2025-08-05 07:29:07', '2025-08-05 07:29:07', '2026-08-05 14:29:07'),
('82507a2f53f63b36a27023b49f8b16de8a84ff8cb4d7cd1f5f380730acd5342578426d5b0c23691b', 5, 1, 'passportToken', '[]', 0, '2025-06-25 03:25:21', '2025-06-25 03:25:21', '2026-06-24 23:25:21'),
('843c56e43123439c92f0900dd0eefa8d60215801f1dc374583795a1731293a325c6bf50f1cdd4f82', 10, 1, 'passportToken', '[]', 0, '2026-02-05 07:29:28', '2026-02-05 07:29:29', '2027-02-05 14:29:28'),
('87efd362b4844ce0d508d44fb143748122bf86eeec64b2a28732dc6ff056e1d507ad622b730c7cd2', 11, 1, 'passportToken', '[]', 0, '2025-08-04 08:17:53', '2025-08-04 08:17:53', '2026-08-04 15:17:53'),
('8a0ce86d72a47fb05ee43f98b792b9821d523e4ee16d02a9f5d90f9dcb2b86aa41a88126003ee6bc', 10, 1, 'passportToken', '[]', 0, '2025-06-27 15:33:21', '2025-06-27 15:33:21', '2026-06-27 11:33:21'),
('8cf5a8a4bde1e843b1603b74ccaeacf78d4fd7e8e6a4df11a783e2d201566ea46a9e0d5144556481', 1, 1, 'passportToken', '[]', 0, '2025-05-07 03:54:44', '2025-05-07 03:54:44', '2026-05-07 10:54:44'),
('8d333a6bf8f84bd6b0dde02b791a71736d97ff4af3bdd70023322964258f59ef892492321e48c3b1', 10, 1, 'passportToken', '[]', 0, '2025-07-01 19:04:50', '2025-07-01 19:04:50', '2026-07-01 15:04:50'),
('8eb7774c806f5f2695204e8f8ae29b0fded2f6d74e2cdf4d3c7d902484908773f1a56a7bd5749286', 10, 1, 'passportToken', '[]', 0, '2025-06-30 12:38:28', '2025-06-30 12:38:28', '2026-06-30 08:38:28'),
('91b09323f736c6cf47ea285444034572cb3f5ff5eeafe08afe9746acd17d2efd2c45a3b66d9ee203', 2, 1, 'passportToken', '[]', 0, '2025-05-24 02:32:02', '2025-05-24 02:32:02', '2026-05-24 09:32:02'),
('9da3f2e5c31f967b978a169f229913de82d0f48835450286ca4979d86d384486b4b6ff4204ed8dfe', 10, 1, 'passportToken', '[]', 0, '2025-11-14 01:59:31', '2025-11-14 01:59:31', '2026-11-14 08:59:31'),
('9e9440a75e3464b1fd4b72a1f575ed171932ab7cf8c0f0834476b4206219a72c16e6df5af55a3748', 2, 1, 'passportToken', '[]', 0, '2025-05-01 21:03:32', '2025-05-01 21:03:32', '2026-05-02 04:03:32'),
('ab4c352c2dbc69a8023bb92928bde9cad1bfe02e7d05bd47daf769573a10fe72f0bdd317a7b7db88', 11, 1, 'passportToken', '[]', 0, '2025-07-31 13:09:33', '2025-07-31 13:09:33', '2026-07-31 20:09:33'),
('ae15e3ff7e41ebb3b603c3619e58373d4be9e33c25247e84ef3dcc44cee18107c469fe5ff6b4e7de', 2, 1, 'passportToken', '[]', 0, '2025-04-30 11:37:11', '2025-04-30 11:37:11', '2026-04-30 18:37:11'),
('af02b5ba56bea6dd5e477030b8a82ca541975f2e2a00cb06f43a5e96437e9ae4db2216e20c205123', 10, 1, 'passportToken', '[]', 0, '2026-02-12 07:29:01', '2026-02-12 07:29:01', '2027-02-12 14:29:01'),
('afd0ee0ac47e7c4aa9cdde7aa3fdeb0b3ce35f8216230dffe610c5a3f134d6b833ead42bae603c39', 10, 1, 'passportToken', '[]', 0, '2025-11-24 02:15:27', '2025-11-24 02:15:27', '2026-11-24 09:15:27'),
('b110152b27dfcbb0f9497ddd397af6a6f58a8df2755e2c32c1927189bb032b479ab226bb3aea7071', 1, 1, 'passportToken', '[]', 0, '2025-05-24 03:31:51', '2025-05-24 03:31:51', '2026-05-24 10:31:51'),
('b24f1fe280f363af48a2f040ad2b7c9ebb04f57bc055a54361579532302453307467486a1784bbe4', 10, 1, 'passportToken', '[]', 0, '2025-12-18 02:10:12', '2025-12-18 02:10:12', '2026-12-18 09:10:12'),
('b33072fba4f799934627f6573a42c9f32b3cc2ae3d3a06d71a2199400ecbfb09183b0427ee286000', 1, 1, 'passportToken', '[]', 0, '2025-05-26 01:27:25', '2025-05-26 01:27:25', '2026-05-26 08:27:25'),
('b3dd6bd83d528d5ba88f15a6c634e29fee307e38e4a3d295726de95bd35d18535613333adc02fda0', 9, 1, 'passportToken', '[]', 0, '2025-06-24 06:04:38', '2025-06-24 06:04:38', '2026-06-24 02:04:38'),
('b8ecb77d58beeb2fb917c6775ec94aa7fc57897a8c18803aecd165c40bace8b70faafbad3c3d2710', 3, 1, 'passportToken', '[]', 0, '2025-04-30 11:30:37', '2025-04-30 11:30:37', '2026-04-30 18:30:37'),
('bad1f1bff0bccfb9972910f074425dde9ec2531e6bb2835de19e3ad1f6e20318ac4bf04b84ec8062', 1, 1, 'passportToken', '[]', 0, '2025-05-07 04:30:10', '2025-05-07 04:30:10', '2026-05-07 11:30:10'),
('bd1202e710e5612d1eae79684b4005312770156866c17c2ca6e3ba77551cc010b95153d1b799e066', 11, 1, 'passportToken', '[]', 0, '2026-02-03 15:49:19', '2026-02-03 15:49:19', '2027-02-03 22:49:19'),
('c11c5b596172ae59d007b0108da0ca74d153973743f55ec82a5a0e0b20c7f53de3adf894698fd383', 10, 1, 'passportToken', '[]', 0, '2025-12-24 06:21:40', '2025-12-24 06:21:40', '2026-12-24 13:21:40'),
('ccf0c7e552e9c56dc237e3e9bef96252d866682c67048d559e866571aae5677af419f93f9c1b1489', 11, 1, 'passportToken', '[]', 0, '2025-08-08 07:14:40', '2025-08-08 07:14:40', '2026-08-08 14:14:40'),
('ce62a732abceb4d298f3f973799d5dd90db90d6928dd985b7a4a096496d178af7391ba25cbdd0d1d', 1, 1, 'passportToken', '[]', 0, '2025-05-13 08:42:42', '2025-05-13 08:42:42', '2026-05-13 15:42:42'),
('d076d1a4afe4b0d3244e0530d3f410d8ff4f22a7ed7670a63e5bd2ddbe95f28edfcdbb37ed6cdee3', 4, 1, 'passportToken', '[]', 0, '2025-05-28 23:19:25', '2025-05-28 23:19:25', '2026-05-29 06:19:25'),
('d7a2198597612f77eea43f33a6953beb420c22e99ea4fb982262533ebd6f289124dff2f625228cce', 11, 1, 'passportToken', '[]', 0, '2025-08-06 07:16:56', '2025-08-06 07:16:56', '2026-08-06 14:16:56'),
('db9389547ad12d37143b56df583eef9dd069383b67534b992cadde27e1db4be505d0224dd556e98c', 11, 1, 'passportToken', '[]', 0, '2025-08-04 08:18:15', '2025-08-04 08:18:15', '2026-08-04 15:18:15'),
('e307da7cf2c2c4aa00ade65baec916661de4b8a3927b5b1913fcae37770a94fa7aecace93adb323a', 1, 1, 'passportToken', '[]', 0, '2025-05-07 03:56:09', '2025-05-07 03:56:09', '2026-05-07 10:56:09'),
('e3e9dd815c81a9cd3bdb52889b67e41606a3649c661b4ae7e953ebc6f7255c112f51a15ff032d2a6', 11, 1, 'passportToken', '[]', 0, '2025-07-30 13:58:53', '2025-07-30 13:58:53', '2026-07-30 20:58:53'),
('e5d682a43b0d805272c259840c2ce4e44dd2301667a0b9bb4e0ec42bfe0c8cd476028ebd6a15ed88', 11, 1, 'passportToken', '[]', 0, '2025-11-28 14:54:37', '2025-11-28 14:54:37', '2026-11-28 21:54:37'),
('e5e2c26201a41a0df4a5c80cdda5f9de29d73e3e6e6f8a94962d161317d6128ef738d9c39a2a8b2e', 2, 1, 'passportToken', '[]', 0, '2025-05-05 15:25:46', '2025-05-05 15:25:46', '2026-05-05 22:25:46'),
('e697d3dea7a7e554289b2c4c202c43e9c23850f84ed117ac66c302de911e2b4a13d211f4957f7075', 10, 1, 'passportToken', '[]', 0, '2025-06-30 19:33:45', '2025-06-30 19:33:45', '2026-06-30 15:33:45'),
('e6f1e81a5336da777f88f6bf505df8463fa4c3166f38758270c88d13965a51bf5a57af21659f2347', 11, 1, 'passportToken', '[]', 0, '2026-02-03 15:57:56', '2026-02-03 15:57:56', '2027-02-03 22:57:56'),
('e93a79f41d143302301168a4bf0fa5171f4a1ec4b15066452086ebd50fc6fb5bbc77ebe2202638c8', 11, 1, 'passportToken', '[]', 0, '2025-07-30 13:59:35', '2025-07-30 13:59:35', '2026-07-30 20:59:35'),
('eef0e95cc944bc7f3238ccbe734dde6e1f0643e9538844efec94beef5e9d83356fd7baf2e0f7117f', 10, 1, 'passportToken', '[]', 0, '2025-12-18 02:09:54', '2025-12-18 02:09:54', '2026-12-18 09:09:54'),
('f36c439c9d210e2ce7b3eecac56539062d022a9a844bab24eee4916938f1dd5658e09940253a291c', 10, 1, 'passportToken', '[]', 0, '2025-11-28 14:48:04', '2025-11-28 14:48:04', '2026-11-28 21:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'API Klinik Sari Dharma Personal Access Client', 'vhCXKSaovdXEkPL7hiDQodpU3uOWRXrs0qAhKUf0', NULL, 'http://localhost', 1, 0, 0, '2025-04-30 11:28:53', '2025-04-30 11:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-30 11:28:53', '2025-04-30 11:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket_kesehatan`
--

CREATE TABLE `paket_kesehatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `promo` tinyint(1) NOT NULL DEFAULT 0,
  `berlaku_sampai` date DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_kesehatan`
--

INSERT INTO `paket_kesehatan` (`id`, `kategori_id`, `nama_paket`, `promo`, `berlaku_sampai`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(2, 2, 'Paket Medical Check Up Sadhar Sehat', 1, '2025-12-31', 'Paket MCU Sadhar Sehat merupakan layanan pemeriksaan kesehatan menyeluruh yang dirancang khusus untuk membantu Anda mengetahui kondisi kesehatan secara dini dan menyeluruh. Dengan harga terjangkau, Anda mendapatkan pelayanan profesional dari tim medis berpengalaman serta hasil pemeriksaan yang cepat dan akurat.\r\n\r\n1. Proses cepat, nyaman, dan terlayani\r\n2. Didampingi oleh tenaga medis profesional\r\n3. Hasil dapat digunakan untuk keperluan kerja, keperluan pribadi, maupun rujukan lanjutan', 'uploads/paket_kesehatan/20250806_1428.png', '2025-05-01 13:30:01', '2025-08-06 07:28:45'),
(3, 1, 'Paket Layanan Konsultasi Online', 1, '2025-05-13', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/paket_kesehatan/20250505_2233.jpg', '2025-05-01 13:40:23', '2025-05-05 15:33:15'),
(4, 1, 'Promo Pemeriksaan Gigi', 1, '2025-08-25', 'Promo Back To Scholl - Pemeriksaan Gigi dan Rongga Mulut', 'uploads/paket_kesehatan/20250806_1425.png', '2025-08-06 07:25:13', '2025-08-06 07:25:13'),
(5, 8, 'Promo Immune Booster', 1, '2025-12-31', NULL, 'uploads/paket_kesehatan/20251218_1019.png', '2025-12-18 03:19:50', '2025-12-18 03:19:50'),
(6, 8, 'Promo USG Mamae Spesial Hari Ibu', 1, '2025-12-31', NULL, 'uploads/paket_kesehatan/20251218_1020.png', '2025-12-18 03:20:38', '2025-12-18 03:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikasi_penghargaan`
--

CREATE TABLE `sertifikasi_penghargaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sertifikasi_penghargaan`
--

INSERT INTO `sertifikasi_penghargaan` (`id`, `judul`, `file_pdf`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Sertifikat Akreditasi Paripurna', 'uploads/sertifikasi_penghargaan/20250505_2239.pdf', 'uploads/sertifikasi_penghargaan/foto/20251218_0914.png', '2025-05-01 14:43:58', '2025-12-18 02:14:15'),
(2, 'Serifikat Faskes Berkomitmen', 'uploads/sertifikasi_penghargaan/20250505_2240.pdf', 'uploads/sertifikasi_penghargaan/foto/20251218_0915.png', '2025-05-01 14:46:45', '2025-12-18 02:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('c6RXxHwjLgEC1hPG9v3RJfhZDAeJzhx1p83IcsPg', NULL, '146.70.185.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieXhLbjlSS3RRaXRGRFg0bmNYZDF1ZURBSGI2VUF6anlKNG9pVnJTRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771671412),
('DXZWCuAoxgBXpP6zjnH3KLiTuXi5rip3FYXXc7fG', NULL, '64.225.102.174', 'Mozilla/5.0 (X11; Linux x86_64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEVOYzdHRFpTZVFnekYzVFVBVEdDQkhFR2xlOVl0ODVBTjBJY2JLMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vd3d3LmJhY2stb2ZmaWNlLnNhcmlkaGFybWEuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1771916265),
('eGCwQJ9mB4cL7GoeaKfXid58WIr6yMOt1iVnpS0T', NULL, '142.93.208.117', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVo2eG1MWThjVXQwcDJHS1pXMU9IWWxYZmFFdUNrTDZDeHdreWd1QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vd3d3LmJhY2stb2ZmaWNlLnNhcmlkaGFybWEuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1771751439),
('jH1C97QOXAMzjSOQPd2bJlXoLwGX4spJk7MXyiqP', NULL, '159.89.12.166', 'Mozilla/5.0 (l9scan/2.0.0393e2131323e28383e2539313; +https://leakix.net)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGJ2NzVGcm9VYWRiTzd2b0pENzVWTHdKNGtzcHNqRjE4ckFERGs3RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzE6Imh0dHBzOi8vd3d3LmJhY2stb2ZmaWNlLnNhcmlkaGFybWEuaWQvP3Jlc3Rfcm91dGU9JTJGd3AlMkZ2MiUyRnVzZXJzJTJGIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771671180),
('MJmyYxIrijjU2DsWB7SSXtGikNBSaUJWYRob0Wlb', NULL, '34.116.215.171', 'Mozilla/5.0 (iPhone13,2; U; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUFyMEY3THRhWWN2b0phTW13QXRQa1Nad0U2UkpzdUlLaEUwVW9pZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly93d3cuYmFjay1vZmZpY2Uuc2FyaWRoYXJtYS5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1771671257),
('P5qaUU4TFaQb3JQoMJ3QpuKu22a7YR9WcfAxvy3v', NULL, '205.169.39.19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.5938.132 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWhQVTRzbG92S3lVekV4alBOZ0RlbXM5VU9EY0FQTUFaMEhQSzhIayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly93d3cuYmFjay1vZmZpY2Uuc2FyaWRoYXJtYS5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1771671191),
('X9sxgUZ3dFYLTvrPrNPKkRahy2nNmez8eE8sNzm6', NULL, '104.168.98.195', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 15_7_3) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2VsRVV3ZVIwTUFyeVZTVU1oQkRaYnc2ZkpoZEQybVB4Rkp0OVlCSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly93d3cuYmFjay1vZmZpY2Uuc2FyaWRoYXJtYS5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1771622876);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, 'Admin Sari Dharma', 'admin@saridharma.id', NULL, '$2y$12$FGvB/x65HVPcvFn1yrt8GemJqSiLYfEc14GQMDWbAngL95zGIWSsq', NULL, '2025-06-27 15:32:40', '2025-06-27 15:32:40'),
(11, 'helmy', 'helmyyy@gmail.com', NULL, '$2y$12$ayfV6iEiKU2BBTpBGW/jPuVZf7MuGsTwMOmucRGLovWKrIHYFQ9HO', NULL, '2025-07-30 13:58:53', '2025-07-30 13:58:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel_kesehatan`
--
ALTER TABLE `artikel_kesehatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_kesehatan_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `event_community`
--
ALTER TABLE `event_community`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_community_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `indikator_mutu`
--
ALTER TABLE `indikator_mutu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jadwal_dokter_dokter_id_spesialis_id_unique` (`dokter_id`,`spesialis_id`),
  ADD KEY `jadwal_dokter_spesialis_id_foreign` (`spesialis_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karir`
--
ALTER TABLE `karir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_social_media`
--
ALTER TABLE `konten_social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_fasilitas`
--
ALTER TABLE `layanan_fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_spesialis`
--
ALTER TABLE `layanan_spesialis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_unggulan`
--
ALTER TABLE `layanan_unggulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_dokter`
--
ALTER TABLE `master_dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_kategori`
--
ALTER TABLE `master_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `paket_kesehatan`
--
ALTER TABLE `paket_kesehatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_kesehatan_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sertifikasi_penghargaan`
--
ALTER TABLE `sertifikasi_penghargaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel_kesehatan`
--
ALTER TABLE `artikel_kesehatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_community`
--
ALTER TABLE `event_community`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indikator_mutu`
--
ALTER TABLE `indikator_mutu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karir`
--
ALTER TABLE `karir`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konten_social_media`
--
ALTER TABLE `konten_social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layanan_fasilitas`
--
ALTER TABLE `layanan_fasilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `layanan_spesialis`
--
ALTER TABLE `layanan_spesialis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `layanan_unggulan`
--
ALTER TABLE `layanan_unggulan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `master_dokter`
--
ALTER TABLE `master_dokter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `master_kategori`
--
ALTER TABLE `master_kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paket_kesehatan`
--
ALTER TABLE `paket_kesehatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sertifikasi_penghargaan`
--
ALTER TABLE `sertifikasi_penghargaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel_kesehatan`
--
ALTER TABLE `artikel_kesehatan`
  ADD CONSTRAINT `artikel_kesehatan_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `master_kategori` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_community`
--
ALTER TABLE `event_community`
  ADD CONSTRAINT `event_community_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `master_kategori` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `master_dokter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_dokter_spesialis_id_foreign` FOREIGN KEY (`spesialis_id`) REFERENCES `layanan_spesialis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paket_kesehatan`
--
ALTER TABLE `paket_kesehatan`
  ADD CONSTRAINT `paket_kesehatan_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `master_kategori` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
