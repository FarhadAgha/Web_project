-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 31, 2026 at 12:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gull_boutique`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$wH8jNgtC4a7oaw1jXMCsJuFPpSh.qsuy9e6VIWcHpuuGC4XVC7uU.', '2026-08-13 13:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `image`) VALUES
(1, 'Afghan dresses', '2026-08-13 07:57:49', 'cat_1787741029_Generated-Image-September-15-2025-4_41PM.webp'),
(2, 'Graduation', '2026-08-13 07:57:49', 'cat_1787741116_1-03_jpg.webp'),
(3, 'Eid Special', '2026-08-13 07:57:49', 'cat_1787741099_A5484SU-SML-014-3PieceSilkSuit-Embroidered_Pret_1.webp'),
(4, 'Office Wear', '2026-08-13 07:57:49', 'cat_1787741126_WTOPV0826047_999_2.webp'),
(5, 'Wedding Wear', '2026-08-13 07:57:49', 'cat_1787741205_MC-26V1-06Front_A.jpg'),
(6, 'Casual Home', '2026-08-13 07:57:49', 'cat_1787741091_Untitled_design_69_0e709795-3c28-4008-9b59-056765dc4419.webp'),
(7, 'SALE', '2026-08-14 17:36:13', 'cat_1787741195_108.webp'),
(8, 'Balochi Dresses', '2026-08-25 18:46:37', 'cat_1787741044_IMG_0006copy-Copy.webp'),
(9, 'Party Wear', '2026-08-26 09:32:55', 'cat_1787741148_Untitled_design_1_7bb7e115-ccf6-4dc7-a8c9-b6b530c8d494.webp'),
(11, 'Striped Clutch', '2026-08-30 08:53:06', 'cat_1788081021_LB93301-FRE-425-QuiltedHandbag_3.webp'),
(13, 'Textured Tote bag', '2026-08-30 09:01:43', 'cat_1788081182_LA063HB-FRE-360-SatchelHandbag_3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'farhad', 'farhad@gmail.com', 'website is running smoothely', '2026-08-13 09:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `image`, `created_at`) VALUES
(5, 6, 'LAYAAN', 'Shirt:\r\nDigital Print Shirt\r\nDigital Print Sleeves\r\nFabric : Lawn\r\n------------------------------------------------------\r\nDupatta:\r\nDigital Print Dupatta\r\nFabric : Lawn\r\n------------------------------------------------------\r\nTrouser:\r\nDigital Print Trouser\r\nFabric : Lawn', 4199.00, 12, '1787148403_Untitled_design_84.webp', '2026-08-19 14:06:43'),
(6, 3, 'ZARYA', '2 Piece Jacquard Suit- Embroidered (Pret)', 5999.00, 11, '1787151305_A5688ST-SML-464-2PieceJacquardSuit-Embroidered_Pret_5.webp', '2026-08-19 14:55:05'),
(7, 3, 'RAYA', '2 Piece Jacquard Suit- Embroidered (Pret)', 4999.86, 11, '1787151366_A0517ST-XSL-489-2PieceStoneSuit-Embroidered_Pret_1.webp', '2026-08-19 14:56:06'),
(8, 3, 'Lawn Suit', 'Paste-printed shirt with a slit round neckline, button details, geometric and floral motifs, and full sleeves\r\nFabric: Lawn Premium', 4999.00, 11, '1787151484_A3070ST-SML-199-2PieceLawnSuit_Pret_4.jpg', '2026-08-19 14:58:04'),
(9, 3, '3 Piece Silk Suit- Embroidered (Pret)', 'Shirt\r\nFloral-printed shirt with a V-neckline, embellished placket, embroidered cutwork panels, detailed full sleeves, and scalloped hems\r\nFabric: Silk', 6999.00, 13, '1787151544_A5484SU-SML-014-3PieceSilkSuit-Embroidered_Pret_1.webp', '2026-08-19 14:59:04'),
(10, 3, '3 Piece Silk Suit- Embroidered (Pret)', 'Shirt\r\nShirt with a round neckline, floral and paisley embroidery, an all-over floral print, and full sleeves\r\nFabric: Silk', 11299.00, 12, '1787151667_A1872SU-SML-425-3PieceSilkSuit-Embroidered_Pret_1.webp', '2026-08-19 15:01:07'),
(11, 3, '2 Piece Silk Suit- Embroidered (Pret)', 'Shirt\r\nEmbroidered shirt with a boat neckline, subtle tonal stripes, all-over abstract spot embroidery, and full sleeves with contrast embroidered cuffs\r\nFabric: Silk', 5999.00, 9, '1787151755_A6006ST-SML-565-2PieceSilkSuit-Embroidered_Pret_2.webp', '2026-08-19 15:02:35'),
(12, 3, '2 Piece Silk Suit- Embroidered (Pret)', 'Shirt\r\nMirror-work embroidered flowy long shirt with a V-neckline, embroidered motifs, and mirror detailing throughout. Embroidered borders on the sleeves and hem\r\nFabric: Silk', 7999.00, 7, '1787151834_A5842ST-SML-034-2PieceSilkSuit-Embroidered_Pret_4.webp', '2026-08-19 15:03:54'),
(13, 3, '2 Piece Lawn Suit- Embroidered (Pret)', 'Shirt\r\nFront-open printed shirt with all-over gold paste printing, sequin and tilla embroidered motifs, embroidered sleeve borders, and mirror tassel detailing on the neckline\r\nFabric: Premium Lawn', 699.00, 8, '1787151883_A5207ST-SML-360-2PieceLawnSuit-Embroidered_Pret_1_35f03c64-4327-4667-b005-b6d66f54d924.webp', '2026-08-19 15:04:43'),
(14, 4, 'Eyelet Collared Top', 'Eyelet-embroidered button-down top with a collared neckline, concealed front placket, lace-trim detail at the shoulders, full sleeves, and a rounded hem\r\nFabric: Grip', 4999.00, 5, '1787151982_W2308TP-SML-002-EyeletCollaredTop_1.webp', '2026-08-19 15:06:22'),
(15, 4, 'Grip Co-ord Set', 'Top\r\nPrinted top with a round neckline, pearl and metal bar detail, contrast front trim, botanical and bird motifs, full flared sleeves with bordered cuffs, and low side slits\r\nFabric: Grip', 6999.00, 10, '1787152045_A5607ST-SML-002-GripCo-ordSet_2.webp', '2026-08-19 15:07:25'),
(16, 4, 'Satin Kurti- Embroidered (Pret)', 'Embroidered kurti with a band V-neckline, short button placket, scattered geometric motifs, full sleeves with contrast embroidered cuffs, a straight hem, and low side slits', 4999.00, 12, '1787152143_A6746TP-SML-091-SatinKurti-Embroidered_Pret_2.webp', '2026-08-19 15:09:03'),
(17, 4, 'Relaxed-Fit Co-ord', 'Solid top with a collared V-slit neckline, gold-tone collar detail, three-quarter sleeves with pleated cuff detailing, and a curved high-low hem', 4999.00, 13, '1787152202_W2297ST-SML-034-Relaxed-FitCo-ord_4.webp', '2026-08-19 15:10:02'),
(18, 4, 'Silk Co-ord Set- Embellished', 'Self-striped top with a V-slit neckline, embellished floral detail at the front, full slanted flared sleeves, and low side slits', 5999.00, 11, '1787152268_A7105ST-SML-227-SilkCo-ordSet-Embellished_5_0d559fae-24b6-48b3-9304-8557dcd321fc.webp', '2026-08-19 15:11:08'),
(19, 4, 'Everyday Floral Top', 'Printed floral top with a gathered round neckline, tie-up keyhole with pearl bead detail, balloon sleeves, and buttoned cuffs', 3298.00, 4, '1787152345_W2285TP-SML-002-EverydayFloralTop_1.webp', '2026-08-19 15:12:25'),
(20, 3, '2 Piece Lawn Slub Suit (Pret)', 'Long shirt with white and green floral prints, a slit neckline with tassel details, and full sleeves with printed borders', 14999.00, 15, '1787152435_A6475SD-SML-034-2PieceLawnSlubSuit_Pret_3.webp', '2026-08-19 15:13:55'),
(21, 2, 'Brell Printed Frill Long Dress', 'The Brell Printed Frill Long Dress is designed in airy chiffon with a soft floral print that feels effortlessly elegant. Featuring delicate ruffle detailing across the front, slightly flared bell sleeves, and a fully lined finish, this flowy silhouette is perfect for daytime gatherings, dinners, and graceful everyday wear.', 8950.00, 8, '1787152617_Untitleddesign_47_6402fc59-9fba-4e1d-b413-1509ced4c289_600x.webp', '2026-08-19 15:16:57'),
(22, 2, 'Belsy Black Sequin Long Dress', 'The Belsy Black Sequin Long Dress is crafted in delicate sequin net fabric with a graceful flow that feels both elegant and timeless. Featuring sheer full sleeves and intricate shimmer detailing throughout, this dress is perfect for evening dinners, festive gatherings, and special occasions where you want to keep it classy with a subtle sparkle.', 6998.00, 5, '1787152700_Untitleddesign_45_14890044-2e5d-45c5-a338-87cfb15628cd_1200x.webp', '2026-08-19 15:18:20'),
(23, 2, 'Petaline Pink Full Sleeves Straight Dress', 'The Petaline Pink Full Sleeves Straight Dress is designed in soft georgette with a clean straight silhouette that feels timeless and graceful. Featuring full sleeves and a flowy fall, this elegant piece is perfect for everyday sophistication, intimate gatherings, and effortlessly polished looks.', 5000.00, 13, '1787152771_Untitleddesign_8_1_1200x.webp', '2026-08-19 15:19:31'),
(24, 2, 'Celestine Maroon Pleated Long Dress', 'Celestine Maroon Pleated Long Dress Elevate your wardrobe with this stunning maroon pleated long dress, crafted from lightweight chiffon fabric. The delicate pleating adds graceful movement and dimension, while the rich maroon hue works beautifully for both formal occasions and elevated everyday wear.', 12000.00, 8, '1787152929_Untitleddesign_13_9183f44a-99ef-4c20-91e7-1e44e76fd305_1200x.webp', '2026-08-19 15:22:09'),
(25, 2, 'Livia Grey Embellished Panel Dress', 'Graceful chiffon dress featuring a pleated front panel and delicate embellishment details on the sleeves. Fully lined including the sleeves, with a soft flowy fall that makes it perfect for both day and evening wear.', 15000.00, 6, '1787152972_Untitleddesign-2026-02-27T104025.969_1200x.webp', '2026-08-19 15:22:52'),
(26, 2, 'Rayhil Blue Solid Button Down Long Dress', 'The Rayhil Blue Solid Button Down Long Dress is made from smooth Barbara silk in a clean, minimal design. It features front button detailing and a dori at the back to adjust and cinch the waist for a better fit. A simple yet polished piece that works well for both everyday wear and dressed-up looks.', 5998.00, 5, '1787153057_Untitleddesign-2026-03-17T095146.115_1200x.webp', '2026-08-19 15:24:17'),
(27, 2, 'Ailsan Net Gathered Dress', 'Ailsan Net Gathered Dress is crafted in delicate net with full lining, including the sleeves, for comfortable coverage. Designed with gathered waist detailing and a softly flared skirt, it creates a graceful shape with an elegant finish.', 8900.00, 3, '1787153140_Untitled_design_67_1_1200x.webp', '2026-08-19 15:25:40'),
(28, 5, 'Bissan', '', 200000.00, 11, '1787153430_MC-26V1-05Front_A.webp', '2026-08-19 15:30:30'),
(29, 5, 'Serelia', '', 299999.00, 4, '1787153495_MC-26V1-02Front_B.jpg', '2026-08-19 15:31:35'),
(30, 5, 'Seliora', '', 200000.00, 2, '1787153548_MC-26V1-06Front_A.jpg', '2026-08-19 15:32:28'),
(31, 6, 'Aneelas - Summer 3PC Lawn Digital Print Dress - KP1159', 'Shirt:\r\nDigital Print Shirt\r\nDigital Print Sleeves\r\nFabric : Lawn\r\n------------------------------------------------------\r\nDupatta:\r\nDigital printed Chiffon Dupatta\r\nFabric : Chiffon\r\n------------------------------------------------------\r\nTrouser:\r\nDigital Print Trouser\r\nFabric : Lawn', 4499.00, 15, '1787153997_Untitled_design_48_6433d72b-f903-4ddb-8868-f0d1ac40a2c8.webp', '2026-08-19 15:39:18'),
(32, 6, 'Khaadi - Summer 3PC Lawn Digital Print Dress - KP1156', 'Shirt:\r\nDigital Print Shirt\r\nDigital Print Sleeves\r\nFabric : Lawn\r\n------------------------------------------------------\r\nDupatta:\r\nDigital Print Dupatta\r\nFabric : Lawn\r\n------------------------------------------------------\r\nTrouser:\r\nDigital Print Trouser\r\nFabric : Lawn', 4599.00, 13, '1787154065_phpSGcbFu.progressive.webp', '2026-08-19 15:41:05'),
(33, 6, 'Aneelas - Summer 3PC Lawn Digital Print Dress - KP1160', 'Shirt:\r\nDigital Print Shirt\r\nDigital Print Sleeves\r\nFabric : Lawn\r\n------------------------------------------------------\r\nDupatta:\r\nDigital printed Chiffon Dupatta\r\nFabric : Chiffon\r\n------------------------------------------------------\r\nTrouser:\r\nDigital Print Trouser\r\nFabric : Lawn', 4299.00, 6, '1787154147_Untitled_design_47_8f1e8838-bd5b-4fb1-91f6-329817367cc2.webp', '2026-08-19 15:42:27'),
(34, 6, 'Aneelas - Summer 3PC Lawn Embroidered Suit- KP1204', 'Embroidered Front Shirt\r\nEmbroidered Sleeves\r\nEmbroidered Back Shirt\r\nFabric: Lawn\r\nColor: Yellow\r\n\r\nDupatta:\r\nEmbroidered Dupatta\r\nFabric: Chiffon\r\nColor: Yellow\r\n\r\nTrouser:\r\nEmbroidered Trouser', 4799.00, 7, '1787154237_Untitled_design_91.webp', '2026-08-19 15:43:57'),
(35, 6, 'Summer 3PC Lawn Embroidered Suit - kp1123', '', 4199.00, 5, '1787154292_Untitled_design_17.webp', '2026-08-19 15:44:52'),
(36, 6, 'Summer 3PC Lawn Embroidered Suit - kp1124', '', 5999.00, 9, '1787154347_Untitled_design_18.webp', '2026-08-19 15:45:47'),
(37, 6, 'Sapphire - Summer 3PC Lawn Embroidered Suit - kp1183', 'Shirt Detail\r\nEmbroidered Front Shirt\r\nEmbroidered Sleeves\r\nPlain dyed Back\r\nFabric: Lawn\r\n\r\nDupatta Detail\r\nEmbroidered dupatta\r\nFabric: Chiffon\r\n\r\nTrouser Detail\r\nEmbroidered Trouser', 5999.00, 22, '1787154416_Untitled_design_69_0e709795-3c28-4008-9b59-056765dc4419.webp', '2026-08-19 15:46:56'),
(38, 6, 'Khaadi - Summer 3PC Lawn Digital Print Dress - KP1151', 'hirt:\r\nDigital Print Shirt\r\nDigital Print Sleeves\r\nFabric : Lawn\r\n------------------------------------------------------\r\nDupatta:\r\nChiffon Dupatta\r\nFabric : Chiffon\r\n------------------------------------------------------\r\nTrouser:\r\nDigital Print Trouser\r\nFabric : Lawn', 4199.00, 20, '1787154480_Untitled_design_40_f5b713a7-03ee-4d13-8073-038e3ddecfe9.webp', '2026-08-19 15:48:00'),
(39, 6, 'Dyot -SUMMER 3PC Lawn Embroidered Shirt With Chiffon Embroidered Dupatta -KP777', '', 4999.00, 3, '1787154583_87.webp', '2026-08-19 15:49:43'),
(40, 6, 'Aneelas - Summer 3PC Lawn Digital Print Dress - KP1197', 'Shirt:\r\nDigital Print Shirt\r\nDigital Print Sleeves\r\nFabric : Lawn\r\n------------------------------------------------------\r\nDupatta:\r\nDigital printed Chiffon Dupatta\r\nFabric : Chiffon\r\n------------------------------------------------------\r\nTrouser:\r\nDigital Print Trouser\r\nFabric : Lawn', 4599.00, 5, '1787154689_Untitled_design_84_1761d800-4b2a-44e0-9730-90e665c60e49.webp', '2026-08-19 15:51:29'),
(42, 3, 'Kashaf - 2 piece Lawn frock style Printed suit -KP1242', '', 6999.00, 13, '1787154894_Untitled_design_-_2026-07-17T211346.831.webp', '2026-08-19 15:54:54'),
(43, 7, 'Kashaf - 3 piece Lawn frock style Printed suit -KP1240', 'Printed Lawn  Frock (3.3 Meters)\r\nPrinted Lawn Sleeves  \r\nPrinted Chiffon Dupatta \r\nPrinted Lawn Trouser', 3999.00, 33, '1787598389_Untitleddesign-2026-07-12T171756.584.webp', '2026-08-24 19:06:29'),
(44, 7, 'Bunaai - Summer-3PC Lawn Embroidered Suit - kp1251', 'hirt Detail\r\nEmbroidered Front Shirt\r\nEmbroidered Sleeves\r\nPlain dyed Back\r\nFabric: Lawn\r\n\r\nDupatta Detail\r\nEmbroidered dupatta\r\nFabric: Chiffon', 3499.00, 10, '1787598462_4d3ddee4-5a64-4a39-8214-6bcc4634e51a.webp', '2026-08-24 19:07:42'),
(45, 7, 'Bunaai - Summer-3PC Lawn Embroidered Suit - kp1243', 'Shirt Detail\r\nEmbroidered Front Shirt\r\nEmbroidered Sleeves\r\nPlain dyed Back\r\nFabric: Lawn\r\n\r\nDupatta Detail\r\nEmbroidered dupatta\r\nFabric: Chiffon', 3499.00, 9, '1787598542_Untitleddesign-2026-07-18T164320.388.webp', '2026-08-24 19:09:02'),
(46, 7, '14th August - Summer-3PC Lawn Suit - kp1246', 'Shirt Detail\r\nPLain Front Shirt\r\nPLain Sleeves\r\nPlain dyed Back\r\nFabric: Lawn\r\n\r\nDupatta Detail\r\nPrinted Chiffon dupatta\r\nFabric: Chiffon\r\n\r\nTrouser Detail\r\nPrinted Trouser\r\nFabric: Lawn', 4999.00, 12, '1787598641_Untitled_design_-_2026-07-22T135853.535.webp', '2026-08-24 19:10:41'),
(47, 7, 'WINTER 3PC Dhanak Embroidered Suit with Printed Wool Shawll', 'Embroidered Dhanak Shirt\r\nEmbroided Sleeves\r\nPrinted Back\r\nDigital Printed Wool Shawl\r\nPlain Dyed Trouser', 4900.00, 11, '1787598768_81_f40941d8-5278-494b-9136-e03777724879 (1).webp', '2026-08-24 19:12:48'),
(48, 7, 'Winter Maria B unstiched 3 piece kataan silk frock style embroidered suit-KP099', 'This suit includes:\r\n1 embroidered frock front piece (60 inches)\r\n1 embroidered piece for both sleeves,\r\n1 plain dyed back (60 inches),\r\n1 embroidered lace for neck,\r\n\r\n(Cloth measurements are for frock style same as model pic)\r\n\r\n1 plain dyed Kataan silk trouser,\r\n1 full embroidered chiffon duppata', 4999.00, 5, '1787598821_108.webp', '2026-08-24 19:13:41'),
(49, 1, 'Afghan Pathan Girl Light Blue Dress For Wedding Event', 'Afghani dress is here for sales, made of good quality long lasting fabric. Traditionally such Afghanistan Persian Pashtun new design frocks are used as bridal dress. Most of girls also like and recommend such dresses for wedding, Nikkah and Mehndi night events. The dress measurements are kept average. If you need this frock in exact measurements, then please either select a size from the chart below or send us measurements which best fit on your body.', 75000.00, 5, '1787599115_JT371_2__92035.1591452692.1280.1280.webp', '2026-08-24 19:18:35'),
(50, 1, 'Afghan Clothes Wedding Event Dress In Multi Color With Mirrors Work', 'Afghani dress is here for sales, made of good quality long lasting fabric. Traditionally such Afghanistan Persian Pashtun new design frocks are used as bridal dress. Most of girls also like and recommend such dresses for wedding, Nikkah and Mehndi night events. The dress measurements are kept average. If you need this frock in exact measurements, then please either select a size from the chart below or send us measurements which best fit on your body.', 77500.00, 6, '1787599174_JT360_1__86188.1591180062.1280.1280.webp', '2026-08-24 19:19:34'),
(51, 1, 'Wedding Event Afghani Dress In Green Color Traditional Pakhtoon Clothes', 'Afghani dress is here for sales, made of good quality long lasting fabric. Traditionally such Afghanistan Persian Pashtun new design frocks are used as bridal dress. Most of girls also like and recommend such dresses for wedding, Nikkah and Mehndi night events. The dress measurements are kept average. If you need this frock in exact measurements, then please either select a size from the chart below or send us measurements which best fit on your body.', 80000.00, 8, '1787599227_JT372_1__86842.1591456051.1280.1280.webp', '2026-08-24 19:20:27'),
(52, 1, 'Buy New Afghan Clothes In Green Color', 'Afghani dress is here for sales, made of good quality long lasting fabric. Traditionally such Afghanistan Persian Pashtun new design frocks are used as bridal dress. Most of girls also like and recommend such dresses for wedding, Nikkah and Mehndi night events. The dress measurements are kept average. If you need this frock in exact measurements, then please either select a size from the chart below or send us measurements which best fit on your body. For more information, send email to us on support@saneens.com or call or message us at whatsapp, viber, wechat (please add +923339127259)', 78000.00, 3, '1787599273_JT345_1__29733.1589195130.1280.1280.webp', '2026-08-24 19:21:13'),
(53, 1, 'Afghan Fashion New Dress In Green Velvet Best Afghani Clothes Online', 'Afghan clothes in green color is here for sales in retail and wholesale. It is made of good quality long lasting fabric. Traditionally such Afghanistan Persian Pashtun new design frocks are used as bridal dress. Most of girls also like and recommend such dresses for wedding, Nikkah and Mehndi night events. The dress measurements are kept average. If you need this frock in exact measurements you need, then please either select a size from the chart below or send us measurements which best fit on your body. For more information, send email to us on support@saneens.com or call or message us on whatsapp, viber, wechat (please add +923339127259) It is supposed best to pack the dress just after each event, this way you would get the dress in good condition for the next event. Disclaimer: color and design of the embroidery and beads work would be matching not exact. It only depends on current stock level.', 90000.00, 12, '1787599328_GHT522_1__44791.1579523855.1280.1280.webp', '2026-08-24 19:22:08'),
(54, 8, 'Handmade Balochi Shoolok Dress – Magenta Running Stitch Embroidery', 'Handmade Balochi Dress – Shoolok | Running Stitch\r\n\r\nExperience the beauty of authentic Balochi craftsmanship with this beautifully handcrafted Shoolok Balochi dress, featuring traditional running stitch embroidery and intricate mirror detailing.\r\n\r\nEach piece is handmade with vibrant multicolour threadwork on a rich magenta base, making it a unique addition to your traditional wardrobe.\r\n\r\nProduct Details\r\n\r\n– Style: Shoolok | Running Stitch\r\n– Type: 3-Piece Unstitched\r\n– Colour: Magenta with multicolour embroidery\r\n– Embroidery: Traditional Balochi handwork with mirror detailing\r\n– Fabric: Crinkle Chiffon Georgette with Zari\r\n– Length: 44 inches\r\n– Craft: Handmade Balochi embroidery', 39000.00, 3, '1787683693_20260807_160004.jpg', '2026-08-25 18:48:13'),
(55, 8, 'Balochi Dress | Show caae', 'Black Balochi Traditional Dress Karachi is our specialty. We are Specialized in Hand Made Traditional Dressing. Our Units Are in Quetta and Karachi. Balochi Dressing is one of the Unique Aspect in Balochi Traditional Dressing that is still Looked up by Females in Pakistan.', 19000.00, 5, '1787683772_IMG20230921192636-scaled.jpg', '2026-08-25 18:49:32'),
(56, 8, 'Black Balochi | Hand made balochi kurta | Quetta Doch | Chawar |', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.\r\nThe Fabric we use is high quality and according to balochi tradition. All things Considered Work on suit is done with hand no machine included at any stage. During production uniqueness is kept in mind.', 23000.00, 4, '1787683828_1001036800-945x2048.jpg', '2026-08-25 18:50:28'),
(57, 8, 'Balochi Dresse', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.\r\nThe Fabric we use is high quality and according to balochi tradition. All things Considered Work on suit is done with hand no machine included at any stage. During production uniqueness is kept in mind.', 20000.00, 7, '1787683892_IMG20240213204042_copy_600x800-300x300.jpg', '2026-08-25 18:51:32'),
(58, 8, 'Balochi Dress | Show caae', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.\r\nThe Fabric we use is high quality and according to balochi tradition. All things Considered Work on suit is done with hand no machine included at any stage. During production uniqueness is kept in mind.', 27000.00, 5, '1787683923_IMG20240526211354_copy_600x800_1-300x300.jpg', '2026-08-25 18:52:03'),
(59, 8, 'Balochi Dresse', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.\r\nThe Fabric we use is high quality and according to balochi tradition. All things Considered Work on suit is done with hand no machine included at any stage. During production uniqueness is kept in mind.', 25000.00, 4, '1787683997_IMG20240303183933_copy_600x800-300x300.jpg', '2026-08-25 18:53:17'),
(60, 8, 'Balochi Dress | Show caae', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.\r\nThe Fabric we use is high quality and according to balochi tradition. All things Considered Work on suit is done with hand no machine included at any stage. During production uniqueness is kept in mind.', 30000.00, 10, '1787684025_IMG_20220921_222932_618_copy_600x750-300x300.jpg', '2026-08-25 18:53:45'),
(61, 4, 'Textured Button-Through Shirt', 'Note: Actual product color may vary slightly from the image.', 4999.00, 7, '1787684129_WTOPV0826012_999_2.webp', '2026-08-25 18:55:29'),
(62, 4, 'Loose Fit Top With Kimono Sleeves', 'Note: Actual product color may vary slightly from the image.', 4999.00, 9, '1787684194_WTOPV0826047_999_2.webp', '2026-08-25 18:56:34'),
(63, 5, 'Faiza Saqlain-3PC Embroidered Lawn Suit - Kp979', 'Embroidered Lawn Front with daman patch\r\nEmbroidered Lawn Sleeve\r\nEmbroidered Organza Dupatta\r\nDyed Lawn trouser with Patches', 8000.00, 12000, '1787684319_Untitled_design.webp', '2026-08-25 18:58:39'),
(64, 5, 'Rang Rasiya - Summer 3PC Lawn ChickenKari Embroidered Suit-KP1200', '', 9999.00, 12, '1787684396_Untitled_design_87_b49a2925-f07b-4088-b442-e088fb70f152.webp', '2026-08-25 18:59:56'),
(65, 5, 'MARIA.B -Summer 3PC Lawn ChickenKari Embroidered Suit-KP1181', 'Shirt:\r\nLawn Embroidered ChickenKari Front Shirt\r\nEmbroidered Front or Back Daman Patch\r\nLawn Embroidered Sleeves Patch \r\nLawn Plain Back\r\n------------------------------------------------------\r\nDupatta:\r\nEmbriodered Printed Dupatta\r\n4 sided Dupatta Lace\r\n------------------------------------------------------\r\nTrouser:\r\nLawn Plain Trouser', 80000.00, 5, '1787684460_Untitled_design_67_874160b5-bca9-4373-8af3-ce9e22f1a19b.webp', '2026-08-25 19:01:00'),
(66, 2, 'Kashaf - 3 piece Lawn silk frock style Printed suit -KP1221', 'Printed Lawn  Frock (3.3 Meters)\r\nPrinted Lawn Sleeves  \r\nPrinted Chiffon Dupatta \r\nPrinted Lawn Trouser', 4999.00, 12, '1787735361_1-03_jpg (1).webp', '2026-08-26 09:09:21'),
(67, 5, 'Winter Embroidered Velvet Three piece With Velvet Shawl', 'Embroidered Velvet (9000 Pound) Front\r\nEmbroidered Velvet Sleeves \r\nEmbroidered Ready to wear Velvet Micro 9000 Shawl  \r\nPlain Velvet Backside\r\nDyed Katan Silk trouser', 89999.00, 6, '1787735474_RoyalGem-5_1512x.progressive.progressive_b898d323-f7a4-4547-bf2b-c569791a01bf.jpg', '2026-08-26 09:11:14'),
(68, 7, 'Qalamkara - Summer 3PC Lawn Embroidered Suit - KP1101', 'Shirt:\r\nEmbroidered Front Shirt\r\nEmbroidered Daman Front Patch\r\nEmbroidered Sleeves \r\nEmbroidered Sleeves Patch\r\nPlain Back\r\nFabric: Lawn\r\n------------------------------------------------------\r\nDupatta:\r\nReady to Wear Embroidered Dupatta\r\nFabric: Khadi Net\r\n------------------------------------------------------\r\nTrouser:\r\nPlain Trouser\r\nEmbroidered Trouser Patch\r\nFabric: Lawn', 59999.00, 14, '1787735711_Untitled_design_a4a9ac88-fc99-48ad-9d5b-c64f50c382d9.webp', '2026-08-26 09:15:11'),
(69, 9, 'Alkaram - Summer 3PC Lawn Embroidered Suit - KP1102', 'hirt Detail\r\nEmbroidered Front Shirt\r\nEmbroidered Daman Patch\r\nEmbroidered Sleeves\r\nEmbroidered Back\r\nEmbroidered Back Patch\r\nFabric: Lawn\r\n\r\nDupatta Detail\r\nEmbroidered Shawl\r\nFabric: Chiffon\r\n\r\nTrouser Detail\r\nPlain Trouser\r\nFabric: Lawn', 7999.00, 13, '1787737641_Untitled_design_1_7bb7e115-ccf6-4dc7-a8c9-b6b530c8d494.webp', '2026-08-26 09:47:21'),
(70, 1, 'Crimson Charm Afghan Vintage Dress', 'Afghani dress is here for sales, made of good quality long lasting fabric. Traditionally such Afghanistan Persian Pashtun new design frocks are used as bridal dress. Most of girls also like and recommend such dresses for wedding, Nikkah and Mehndi night events. The dress measurements are kept average. If you need this frock in exact measurements, then please either select a size from the chart below or send us measurements which best fit on your body. For more information, send email to us on support@saneens.com or call or message us at whatsapp, viber, wechat (please add +923339127259)', 79999.00, 12, '1787738513_Generated-Image-September-15-2025-4_41PM.webp', '2026-08-26 10:01:53'),
(71, 8, 'Balochi Dress', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.\r\nThe Fabric we use is high quality and according to balochi tradition. All things Considered Work on suit is done with hand no machine included at any stage. During production uniqueness is kept in mind.', 120000.00, 9, '1787738628_IMG_0006copy-Copy.webp', '2026-08-26 10:03:48'),
(72, 1, 'Red & White Afghani Frock Dress', 'This Red & White Afghani frock features huge mirror details, that helps it showcase the Afghani heritage perfectly. The top of the frock showcases a full embroidered look, with a mirror detail in the belt, along with thread work of vibrant colors. The same Stunning colors can be seen on the edges of the sleeves and the frock itself.', 23000.00, 5, '1787747935_Dress-4.webp', '2026-08-26 12:38:55'),
(73, 1, 'Purple Embroidered Afghani Top', 'This beautifully designed Afghani top features perfect hues of purple and other matching hues. The flared frock shows off the perfect flow of the dress, that ends with heavy traditional embroidery paired with small mirror work. The same pattern, design, and colors can be seen in the top half, and the sleeve ends.', 39999.00, 4, '1787747993_Generated-Image-September-04-2025-9_10PM.webp', '2026-08-26 12:39:53'),
(74, 1, 'Magenta Green Afghani Frock Dress', 'A traditional Afghani frock, that showcases vibrant threadwork and mirror details. This dress comes with a base of blue, paired with green, and hints of other attractive colors making it the perfect match for a nikkah. This bell sleeved dress will definitely have heads turning around when you walk in. As there is nothing more stunning then highlighted Afghani heritage.', 40000.00, 3, '1787748052_Dress-3.webp', '2026-08-26 12:40:52'),
(75, 1, 'Libas E Sharbati Multi Frock Kuchi Dress', 'A traditional Afghani Multi frock Kuchi Dress that features beautiful colors, along with mirror and thread work. The entire frock is filled with small hand-woven design, that adds a great deal to the overall look of the frock. This dress is exactly what you will find Afghani women wearing to a semi-formal, or formal setting.', 49999.00, 6, '1787748118_WhatsApp-Image-2024-05-30-at-6.45.06-PM-1.webp', '2026-08-26 12:41:58'),
(76, 8, 'Balochi Dress', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.', 30000.00, 3, '1787748207_050A6744.webp', '2026-08-26 12:43:27'),
(77, 8, 'Balochi Dress | Show caae', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.', 60000.00, 4, '1787748289_0eba81cb07814db63687d88c5623673f.jpg', '2026-08-26 12:44:49'),
(78, 8, 'Balochi Dresses', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.', 70000.00, 5, '1787748316_96a5b1cdbe0d8440c450ebc076a06b02.jpg', '2026-08-26 12:45:16'),
(79, 8, 'Balochi Dresse', 'Balochi Sheesha Gari Suit This Masterpiece is 100 percent handmade. Our units in Karachi are more focusing on harvesting more of culture into Dresses we make.', 90000.00, 3, '1787748350_ab41a9f3a02af698e497b0d82a30026d.jpg', '2026-08-26 12:45:50'),
(80, 3, 'Summer 3PC Lawn Chikankri Embroidered Suit - KP1127', 'Shirt Detail\r\nChikankri Embroidered Front Shirt\r\nEmbroidered Daman Patch\r\nChikankri Embroidered Sleeves\r\nPlain Back\r\nFabric: Lawn \r\n\r\nDupatta Detail\r\nEmbroidered Dupatta\r\nFabric: Chiffon', 7499.00, 7, '1787818923_Untitled_design_22_5b8b2946-dbcb-44fd-899c-57316d724bc3.webp', '2026-08-27 08:22:03'),
(81, 11, 'Striped Clutch', 'Striped Clutch\r\nPush-lock closure\r\nSingle compartment\r\nOne mini zipped pocket', 2499.00, 6, '1788080043_LB96701-FRE-627-StripedClutch_3.webp', '2026-08-30 08:54:03'),
(82, 11, 'Quilted Handbag', 'Quilted Handbag\r\nGolden knotted accent \r\nMagnetic faster lock\r\nSingle Open compartment\r\nOne mini zipped pocket', 2399.00, 3, '1788080165_LB93301-FRE-425-QuiltedHandbag_3.webp', '2026-08-30 08:56:05'),
(83, 11, 'Boxy Handbag', 'Boxy Handbag\r\nZip closure\r\nSingle open compartment\r\nPlastic chain handle', 2299.00, 6, '1788080238_LB95301-FRE-425-BoxyHandbag_1_94070306-eb3a-4a99-96a0-95df4972a594.webp', '2026-08-30 08:57:18'),
(84, 11, 'Embellished Clutch', 'Embellished formal clutch with sequin detail, magnetic faster lock, two open compartments, golden metal shoulder chain', 3999.00, 5, '1788080296_LT13701-FRE-034-EmbellishedClutch_8e79d404-4ac7-4c13-879a-d3c95f9671c5.webp', '2026-08-30 08:58:16'),
(85, 11, 'Embellished Clutch', 'Embellished formal clutch with sequin detail, magnetic faster lock, two open compartments, golden metal shoulder chain', 3299.00, 13, '1788080342_LT13701-FRE-585-EmbellishedClutch_fbacf9b2-c6aa-4475-b819-8de23d3037da.webp', '2026-08-30 08:59:02'),
(86, 11, 'Embellished Clutch', 'Embellished Clutch', 3499.00, 4, '1788080423_LT13701-FRE-014-EmbellishedClutch.webp', '2026-08-30 09:00:23'),
(87, 13, 'Textured Tote bag', 'Textured Tote bag', 5999.00, 8, '1788080537_LA056SB-FRE-637TexturedTotebag_1.webp', '2026-08-30 09:02:17'),
(88, 13, 'Textured Tote Bag', 'Textured Tote Bag with tassel detail\r\nZip closure\r\nSingle Open compartment\r\nOne mini zipped pocket\r\nSingle shoulder strap\r\nMaterial: Rexine', 5699.00, 3, '1788080743_LT02501-FRE-091TexturedToteBag_1.webp', '2026-08-30 09:05:43'),
(89, 13, 'Textured Handbag', 'Textured Handbag', 5999.00, 7, '1788080813_I9775HB-FRE-637-TexturedHandbag_3.webp', '2026-08-30 09:06:53'),
(90, 13, 'Textured Handbag', 'Textured Handbag\r\nPush lock-closure\r\nTwo open compartments\r\nOne zipped compartment\r\nTop rexine handle\r\nAdjustable shoulder rexine strap\r\nMaterial: Rexine', 4999.00, 3, '1788080882_LA051HB-FRE-637TexturedHandbag_3.webp', '2026-08-30 09:08:02'),
(91, 13, 'Textured Tote bag', 'Textured Handbag\r\nPush lock-closure\r\nTwo open compartments\r\nOne zipped compartment\r\nTop rexine handle\r\nAdjustable shoulder rexine strap\r\nMaterial: Rexine', 4799.00, 8, '1788080952_LA056SB-FRE-360TexturedTotebag_1.webp', '2026-08-30 09:09:12'),
(92, 13, 'Satchel Handbag', 'Satchel Handbag with twist lock\r\nInside zip closure\r\nTwo open compartments\r\nOne zipped compartment\r\nOne mini zipped pocket', 4299.00, 4, '1788081168_LA063HB-FRE-360-SatchelHandbag_3.webp', '2026-08-30 09:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reviewer_name` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
