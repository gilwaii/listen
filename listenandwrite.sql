-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 24, 2018 lúc 08:07 PM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `listenandwrite`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'General'),
(2, 'Music'),
(3, 'Movies'),
(4, 'Kids'),
(5, 'Science');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chart`
--

CREATE TABLE `chart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chart`
--

INSERT INTO `chart` (`id`, `user_id`, `level`, `point`, `number`) VALUES
(1, 1, 1, 1001, 1),
(2, 1, 1, 1001, 2),
(3, 1, 1, 1001, 3),
(4, 1, 1, 1001, 4),
(5, 1, 1, 1001, 5),
(6, 1, 1, 1001, 6),
(21, 1, 1, 1001, 7),
(22, 1, 1, 1001, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `file`
--

INSERT INTO `file` (`id`, `name`) VALUES
(1, 'audios'),
(2, 'video');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `level_audio`
--

CREATE TABLE `level_audio` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `level_audio`
--

INSERT INTO `level_audio` (`id`, `level`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `level_video`
--

CREATE TABLE `level_video` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `level_video`
--

INSERT INTO `level_video` (`id`, `level`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `listen`
--

CREATE TABLE `listen` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(200) NOT NULL,
  `duration` int(11) NOT NULL,
  `image` text NOT NULL,
  `level_audio` int(11) DEFAULT NULL,
  `file_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `level_video` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `listen`
--

INSERT INTO `listen` (`id`, `name`, `path`, `duration`, `image`, `level_audio`, `file_id`, `category_id`, `create_at`, `update_at`, `level_video`) VALUES
(1, 'T\'iens Alexandre', '/listen/src/mp3/1..mp3', 119, '', 1, 1, 1, '2018-11-20 00:00:00', NULL, NULL),
(2, 'Vous faites souvent ', '/listen/src/mp3/2..mp3', 80, '', 2, 1, 1, '2018-11-20 00:00:00', NULL, NULL),
(3, 'Tiens!Frédéric!Tu prends le bus?', '/listen/src/mp3/3..mp3', 55, '', 3, 1, 1, '2018-11-20 00:00:00', NULL, NULL),
(4, 'Emilie! Salut! Ça va?Oui', '/listen/src/mp3/4..mp3', 72, '', 4, 1, 1, '2018-11-20 00:00:00', NULL, NULL),
(5, 'Mais ludo, pourquoi tu as accepté ce travail...', 'src/video/video1.mp4', 119, 'src/image/video1.jpg\r\n', NULL, 2, 1, '2018-11-24 00:00:00', NULL, 100),
(6, 'Bon, j’attendrai 6 heures et demie si tu veux', 'src/video/video2.mp4', 80, 'src/image/video2.png', NULL, 2, 1, '2018-11-24 00:00:00', NULL, 500),
(7, 'Ah ça, c’est une bonne nouvelle !', 'src/video/video3.mp4', 22, 'src/image/video3.jpg\r\n', NULL, 2, 1, '2018-11-25 00:00:00', NULL, 15),
(8, 'Oui, j’aime mon travail', '/listen/src/mp3/16.mp3', 3, '', 5, 1, 1, '2018-11-25 00:00:00', NULL, NULL),
(9, 'Vous travaillez beaucoup?', '/listen/src/mp3/17.mp3', 4, '', 2, 1, 1, '2018-11-25 00:00:00', NULL, NULL),
(10, 'Oh, oui, je travaille énormément', '/listen/src/mp3/18.mp3', 3, '', 4, 1, 1, '2018-11-25 00:00:00', NULL, NULL),
(11, 'Et vous travaillez loin d\'ici?', '/listen/src/mp3/19.mp3', 6, '', 3, 1, 1, '2018-11-25 00:00:00', NULL, NULL),
(12, 'Non, je ne travaille pas loin d\'ici', '/listen/src/mp3/20.mp3', 6, '', 4, 1, 1, '2018-11-25 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `track`
--

CREATE TABLE `track` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lyrics` text NOT NULL,
  `duration` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `listen_id` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `track`
--

INSERT INTO `track` (`id`, `name`, `lyrics`, `duration`, `start`, `end`, `listen_id`, `sequence`, `point`) VALUES
(1, 'track-1', 'J\'e T\'iens Alexandre!Bonjour,comment allez-vous.Bien,merci,et vous?Bien, merci!Alors, quoi de neuf?Et bien, je travaille, maintenant!Je travaille comme technicienne dans une société internationale.C\'est vrai?ça,c\'est une bonne nouvelle! Et vous êtes contente de votre travail?Oui, j’aime mon travail,c\'est intéressant.Vous travaillez beaucoup?Oh, oui, je travaille énormément', 40, 0, 39, 1, 1, 100),
(2, 'track-2', 'Et vous travaillez loin d\'ici? Vous commencez tôt le matin?Non,je ne travaille pas loin d\'ici.Je commence comme tout le monde.Vous ne déjeunez pas chez vous, je suppose?Non,je déjeune à la cantine, avec mes collègues.Qu\'est-ce que vous mangez là-bas?C\'est bon?Oh..je mange simplement un steak, un poisson. Oui, c\'est assez bon.Est-ce que vous jouez au basket?Oui,je joue au basket le samedi. Et je continue à faire du jogging..Et vous,vous habitez dans le quartier', 50, 40, 89, 1, 2, 150),
(3, 'track-3', 'Non,je n’habite plus ici.Maintenant, j’habite dans le nouveau quartier de la Colline.Mais je travaille ici.Bon, et bien, au revoir,à la prochaine fois!Au revoir,Alexandre,bonne continuation', 29, 90, 119, 1, 3, 300),
(4, 'track-1', 'Mais ludo, pourquoi tu as accepté ce travail de nuit, c’est stupide!Je n’ai pas le choix, ma puce. Leroux a repris le travail après son congé Maladie, c’est ça où le chômage.On ne passera plus beaucoup de temps ensemble.Mais si ! Je ne travaillerai pas le week-end. Et puis, quand je rentrerai à 6 heures du matin, je te réveillerai…Je t’apporterai le café au lit… avec des croissants.À 6 heures, c’est un peu tôt', 50, 0, 49, 5, 1, 400),
(5, 'track-1', 'Vous faites souvent du jogging?Oui,je fais du jogging tous les matins....Et vous?Moi,je ne fais pas souvent de jogging. Mais je fais beaucoup de sport ! Je fais du tennis, du foot, du basket,Vous ne faites pas de tennis,par hasard?Si,je fais du tennis,du squash,du volley,j\'adore ça!Et où est-ce que vous faites du tennis?Il y a un club, dans le quartier?Je ne connais pas,je suis nouveau, ici.Oui,il y a un club,juste après le parc.Vous prenez la route,là,en face,et après il y a une base de loisirs, avec un lac.Il y a beaucoup d\'activités.Avec qui est-ce que vous faites du tennis?Avec un voisin.Il habite dans la même rue,c\'est facile à organiser.Mais si vous voulez venir,c\'est avec plaisir!On joue tous les samedis,sauf quand il ne fait vraiment pas beau.\r\nMerci,c\'est gentil!Mais le samedi,c\'est difficile.Mes enfants font beaucoup de sport aussi,et ils prennent des cours ce jour-là...Ma fille fait de la natation et mon fils fait du judo.Dites donc,vous êtes une famille sportive\r\n', 80, 0, 79, 2, 1, 150),
(6, 'track-1', 'Tiens!Frédéric!Tu prends le bus? Pourquoi est-ce que tu ne prends pas le métro?Aujourd\'hui, je prends le bus, parce que je fais des courses avec Émilie.Et toi,qu\'est-ce que tu fais,ce week-end?Tu as des projets ?Oui,nous faisons des travaux dans la maison.Nous refaisons la salle de bains.Tu imagines le travail!Quel courage!Et toi?Tu fais quelque chose de spécial,ce week-end?Rien d\'intéressant!Je fais le ménage et les courses!Ah si, demain soir,je prends un café avec mes cousins.Ils sont très sympas.Tiens,voilà les bus.Moi,je prends le 8.Moi,je prends le 17.Allez,au revoir!Bon week-end!Bon week-end à toi aussi!\r\n', 55, 0, 54, 3, 1, 300),
(7, 'track-1', 'Emilie! Salut! Ça va?Oui, ça va bien, et toi?Ça va très bien! Nous partons en vacances.Quelle chance! Où est-ce que vous allez?Nous allons en Italie, en Toscane.Ah, c\'est super! Comment est-ce que vous partez? En voiture, en train, en avion?On part en voiture, c\'est plus agréable.On a plus de liberté pour visiter.Où est-ce que vous allez, exactement?allons à côté de Sienne, dans un petit village. C\'est une région magnifique.Vous allez à l\'hôtel?Non, pas exactement, nous allons dans une petite pension en pleine campagne: une vieille maison, un jardin et une piscine... Le rêve!Quelle chance! Gaspard et Margot ne viennent pas avec vous?Si, ils viennent avec nous, mais ils vont d\'abord deux jours en Provence, pour voir la mère de Gaspard. Ils viennent en Italie juste après.Alors, quand est-ce que vous partez?On part samedi matin, le plus tôt possible.Et quand est-ce que vous revenez?On revient dans deux semaines. Alors, tu viens avec nous?Je voudrais bien, mais je travaille\r\n', 72, 0, 71, 4, 1, 500),
(8, 'track-1', 'Bon, j’attendrai 6 heures et demie si tu veux.Merci, tu es trop gentil! Et on ne sortira plus le soir?Cécile, on ne sort jamais le soir!Et les enfants, tu ne joueras plus avec eux, tu ne leur liras plus d’histoires?', 15, 0, 14, 6, 1, 100),
(9, 'track-1', 'Au contraire, je m’occuperai d’eux toute la soirée. Je partirai au travail à 9\r\nheures et demie, quand ils s’endormiront.\r\nEt moi?\r\nToi tu regarderas la télé, comme d’habitude. Et puis ty sais, je gagnerai plus\r\nd’argent.\r\nTu vas avoir une augmentation?\r\nBien sû ! Et comme ça, toi, tu travailleras à mi-temps.\r\nAh ça, c’est une bonne nouvelle !', 22, 0, 21, 7, 1, 100),
(10, 'track-1', 'Oui, j’aime mon travail, c\'est intéressant', 3, 0, 3, 8, 1, 10),
(11, 'track-1', 'Vous travaillez beaucoup?', 4, 0, 4, 9, 1, 10),
(12, 'track-1', 'Oh, oui, je travaille énormément', 3, 0, 3, 10, 1, 10),
(13, 'track-1', 'Et vous travaillez loin d\'ici? Vous commencez tôt le matin?', 6, 0, 6, 11, 1, 10),
(14, 'track-1', 'Non, je ne travaille pas loin d\'ici. Je commence comme tout le monde.', 6, 0, 6, 12, 1, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `point`) VALUES
(1, 'quynh', 'quynh', 1001),
(5, 'abc', 'def', 0),
(6, 'vanquynh', '3', 0),
(7, 'sigup', '1', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `level_audio`
--
ALTER TABLE `level_audio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level` (`level`);

--
-- Chỉ mục cho bảng `level_video`
--
ALTER TABLE `level_video`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level` (`level`);

--
-- Chỉ mục cho bảng `listen`
--
ALTER TABLE `listen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `path` (`path`);

--
-- Chỉ mục cho bảng `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `chart`
--
ALTER TABLE `chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `listen`
--
ALTER TABLE `listen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
