-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: iun. 23, 2019 la 04:45 PM
-- Versiune server: 10.1.37-MariaDB
-- Versiune PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `online_shop`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `link` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `evaluation_date` date NOT NULL,
  `price` int(10) NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `ordered` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `bookmark`
--

INSERT INTO `bookmark` (`id`, `id_user`, `link`, `date`, `evaluation_date`, `price`, `checked`, `ordered`) VALUES
(10, 1, 'bookmark/2019-6-18.23-27-12.png', '2019-05-14', '2019-06-20', 35, 1, 0),
(11, 1, 'bookmark/2019-6-18.20-10-4.png', '2019-06-01', '2019-06-20', 40, 1, 1),
(12, 1, 'bookmark/2019-6-18.23-1-58.png', '2019-06-18', '0000-00-00', 0, 0, 0),
(13, 1, 'bookmark/2019-6-12.13-4-18.png', '2019-06-20', '0000-00-00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `bookmark_order`
--

CREATE TABLE `bookmark_order` (
  `id` int(11) NOT NULL,
  `id_bookmark` int(10) NOT NULL,
  `id_deliveries` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `bookmark_order`
--

INSERT INTO `bookmark_order` (`id`, `id_bookmark`, `id_deliveries`) VALUES
(12, 11, 33);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `sum` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `delivered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `deliveries`
--

INSERT INTO `deliveries` (`id`, `id_user`, `first_name`, `last_name`, `email`, `city`, `address`, `phone`, `sum`, `date`, `delivered`) VALUES
(31, 1, 'Ileana', 'Vlad', 'ileanaavlad@gmail.com', 'Cluj-Napoca', 'Str. Pastorului, nr. 45', '0756315719', '62', '2019-06-19', 1),
(32, 1, 'Ileana', 'Vlad', 'ileanaavlad@gmail.com', 'Baia Mare', 'Str. Progresului, nr. 45', '0756315719', '45', '2019-06-20', 0),
(33, 1, 'Ileana', 'Vlad', 'ileanaavlad@gmail.com', 'Cluj-Napoca', 'Str. Pastorului, nr. 45', '0756315719', '40', '2019-06-20', 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `order_deliveries`
--

CREATE TABLE `order_deliveries` (
  `id` int(11) NOT NULL,
  `id_order` int(10) NOT NULL,
  `id_deliveries` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `order_deliveries`
--

INSERT INTO `order_deliveries` (`id`, `id_order`, `id_deliveries`) VALUES
(19, 54, 31),
(20, 55, 31),
(21, 56, 32);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `price` int(10) NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `product`
--

INSERT INTO `product` (`id`, `name`, `link`, `price`, `color`, `quantity`, `description`) VALUES
(1, 'image1', 'images/image1.jpg', 20, 'Portocaliu', 7, 'Semn de carte cu panselute portocalii, tiv cu matase alba, snur din matase'),
(2, 'image2', 'images/image2.jpg', 20, 'Portocaliu', 40, 'Semn de carte cu trandafiri portocalii, tiv cu bumbac galben, snur din matase'),
(3, 'image3', 'images/image3.jpg', 15, 'Violet', 0, 'Semn de carte cu clopotei violet, tiv cu matase alba, snur din matase'),
(4, 'image4', 'images/image4.jpg', 22, 'Rosu', 13, 'Semn de carte cu trandafiri, tiv cu bumbac alb, snur din matase'),
(5, 'image5', 'images/image5.jpg', 12, 'Rosu', 5, 'Semn de carte cu maci si fluturi, tiv cu matase alba, snur din matase'),
(6, 'image6', 'images/image6.jpg', 40, 'Violet', 10, 'Semn de carte cu flori, tiv cu bumbac alb, snur din matase'),
(7, 'image7', 'images/image7.jpg', 45, 'Albastru', 4, 'Semn de carte cu flori, tiv cu bumbac alb, snur din matase'),
(8, 'image8', 'images/image8.jpg', 20, 'Rosu', 20, 'Semn de carte cu fragute, tiv cu bumbac alb, snur din matase'),
(9, 'image8', 'images/image9.jpg', 15, 'Violet', 10, 'Semn de carte cu umbrele, tiv cu bumbac alb, snur din matase'),
(10, 'image10', 'images/image10.jpg', 15, 'Rosu', 4, 'Semn de carte cu trandafiri, tic cu bumbac roz, snur din matase'),
(11, 'image11', 'images/image11.jpg', 12, 'Rosu', 0, 'Semn de carte cu frunze, tiv cu bumbac alb, snur din matase'),
(12, 'image12', 'images/image12.jpg', 22, 'Rosu', 5, 'Semn de carte cu lalea, tiv cu matase alba, snur din matase');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `id_product` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(10) NOT NULL,
  `ordered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `product_order`
--

INSERT INTO `product_order` (`id`, `id_product`, `id_user`, `date`, `quantity`, `ordered`) VALUES
(54, 1, 1, '2019-06-15', 2, 1),
(55, 4, 1, '2019-06-16', 1, 1),
(56, 7, 1, '2019-06-20', 1, 1),
(57, 4, 1, '2019-06-23', 1, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name_image` varchar(50) NOT NULL,
  `link_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `city`, `address`, `phone`, `user_type`, `password`, `name_image`, `link_image`) VALUES
(1, 'Ileana', 'Vlad', 'ileana', 'ileanaavlad@gmail.com', 'Cluj-Napoca', 'Str. Pastorului, nr. 45', '0756315719', 'user', 'dc9c8b4b8e6cc01462f8fd0e4dbdfdae', '', ''),
(2, '', '', 'admin', 'admin@gmail.com', '', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_product` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `wish_list`
--

INSERT INTO `wish_list` (`id`, `id_user`, `id_product`) VALUES
(18, 1, 2);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexuri pentru tabele `bookmark_order`
--
ALTER TABLE `bookmark_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bookmark` (`id_bookmark`),
  ADD KEY `bookmark_order_ibfk_2` (`id_deliveries`);

--
-- Indexuri pentru tabele `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexuri pentru tabele `order_deliveries`
--
ALTER TABLE `order_deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_deliveries` (`id_deliveries`);

--
-- Indexuri pentru tabele `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pentru tabele `bookmark_order`
--
ALTER TABLE `bookmark_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pentru tabele `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pentru tabele `order_deliveries`
--
ALTER TABLE `order_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pentru tabele `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pentru tabele `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `bookmark_order`
--
ALTER TABLE `bookmark_order`
  ADD CONSTRAINT `bookmark_order_ibfk_1` FOREIGN KEY (`id_bookmark`) REFERENCES `bookmark` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmark_order_ibfk_2` FOREIGN KEY (`id_deliveries`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `order_deliveries`
--
ALTER TABLE `order_deliveries`
  ADD CONSTRAINT `order_deliveries_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `product_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_deliveries_ibfk_2` FOREIGN KEY (`id_deliveries`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `id_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wish_list_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
