-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2023 at 01:04 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `followed_user_id` int(10) UNSIGNED NOT NULL,
  `following_user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `followed_user_id`, `following_user_id`) VALUES
(1, 5, 3),
(2, 5, 6),
(4, 1, 5),
(5, 2, 5),
(6, 4, 5),
(7, 1, 2),
(8, 1, 3),
(9, 1, 7),
(10, 1, 6),
(11, 1, 4),
(12, 1, 8),
(14, 3, 7),
(15, 5, 7),
(16, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 1, 9),
(12, 2, 9),
(13, 4, 9),
(14, 5, 9),
(75, 8, 99),
(76, 8, 99),
(77, 8, 93),
(78, 8, 93),
(79, 8, 93),
(80, 8, 93),
(81, 8, 93),
(82, 10, 285),
(83, 8, 290),
(84, 10, 290);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created`, `parent_id`) VALUES
(1, 5, 'Je peux parfaitement comprendre les propriétaires : s\'il y a un accident, ils sont responsables. Oui, ce que l\'on fait est illégal', '2020-02-05 18:19:12', NULL),
(2, 5, ' Il n\'y a pas de code de bonne conduite dans l\'urbex, mais à mon sens, on doit respecter le lieu. On ne casse pas pour entrer, si c\'est clos, on reste dehors.', '2020-04-06 18:19:12', NULL),
(3, 5, 'Où qu\'on aille, n\'importe quel endroit abandonné appartient à quelqu\'un. Si on s\'en tient à \'\'Ne pas casser, ne pas voler, avoir le respect des lieux\'\', on n\'aura pas de problème. Mais certains ne s\'arrêtent pas à entrer et prendre des photos.', '2020-07-12 18:21:49', NULL),
(4, 5, 'Cela peut être dangereux, il peut y avoir un effondrement par exemple. Avant, je partais seule, je ne donnais même pas ma position à quelqu\'un. Mais au niveau du danger, il faut savoir se dire non, renoncer, même si cela fait partie du jeu.', '2020-08-04 18:21:49', NULL),
(5, 5, 'Les ruines sont usées, patinées par les gens et les pillages, les luttes. Ici, il n\'y a que le temps.', '2020-09-25 18:24:30', NULL),
(6, 5, 'J\'ai porté cette guerre en moi depuis longtemps. C\'est pourquoi elle ne me concerne pas intérieurement. Pour me dégager de mes ruines, il me fallait avoir des ailes. Et je volai. Dans ce monde effondré je ne m\'attarde plus guère autrement qu\'en souvenir, à la manière dont on pense parfois au passé. Ainsi je suis abstrait avec des souvenirs .', '2020-10-15 00:35:42', NULL),
(7, 5, ' Quel dommage de trouver des bâtiments tomber en ruines comme ça. Il y a des ouvriers derrière, des vies. Ça m\'est arrivé dans certains endroits, je pense à une usine, d\'avoir la chair de poule en pensant à ces mecs qui ont bossé là. Et si deux, trois photos peuvent les faire vivre encore un peu, alors allons-y.', '2020-10-25 00:35:39', NULL),
(8, 5, 'Je reviens, pour voir comment ça a évolué. Voir la nature qui reprend possession des lieux. On fait aussi plus attention aux détails, à des inscriptions sur les murs, lorsque l\'on vient pour la deuxième ou troisième fois. ', '2020-11-10 18:26:12', NULL),
(9, 1, 'Je suis devenue amie avec deux Manceaux avec qui je n\'aurais même pas échangé un mot. L\'urbex nous rapproche, parce qu\'on vit des choses qui n\'arrivent pas dans le quotidien. ', '2020-11-20 18:26:50', NULL),
(10, 7, 'Pour devenir un explorateur urbain, il suffit d\'oser...', '2020-11-30 18:31:16', NULL),
(33, 5, 'Escalader un mur, emprunter un souterrain, pousser une simple palissade et tout bascule. Des mondes oubliés et secrets en plein coeur de la ville deviennent des terrains d\'aventure, à deux pas de chez soi.', '2023-02-16 11:01:58', NULL),
(78, 8, 'J’ai toujours été attiré aussi loin que je me souvienne par les lieux oubliés, ces sites délaissés par l’homme et recouverts de la poussière du temps.', '2023-02-20 11:52:33', NULL),
(79, 8, 'la poésie des univers postapocalyptiques', '2023-02-20 11:56:07', NULL),
(80, 8, 'j\'adore essayer de reconstituer l’histoire des lieux que je visite.', '2023-02-20 12:11:03', NULL),
(93, 7, 'Top 3 conseils pour faire de l\'urbex, 1 : sortir de chez soi.', '2023-02-20 16:43:11', NULL),
(99, 7, 'Comment ne pas tomber sur du caca', '2023-02-20 16:53:34', NULL),
(285, 10, 'On vi vrément dan 1 sosiété #laVi', '2023-02-23 10:39:12', NULL),
(286, 11, 'grav', '2023-02-23 10:39:56', 285),
(287, 8, 'Vous êtes vraimen movais en orthograph', '2023-02-23 10:40:34', 285),
(288, 8, 'helo', '2023-02-23 11:52:46', NULL),
(289, 8, 'helo #j\'adorelasociete', '2023-02-23 11:53:02', NULL),
(290, 8, 'heloi #urbex', '2023-02-23 11:53:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`id`, `post_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 6),
(6, 6, 7),
(7, 7, 8),
(8, 8, 8),
(9, 9, 9),
(10, 10, 5),
(11, 9, 1),
(12, 33, 10),
(13, 33, 11),
(14, 33, 12),
(15, 78, 22),
(16, 78, 23),
(17, 80, 7),
(18, 80, 23),
(19, 93, 22),
(20, 93, 23),
(21, 99, 22),
(22, 99, 23),
(23, 285, 24),
(24, 289, 25),
(25, 290, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `label`) VALUES
(21, ' old'),
(7, 'abandoned'),
(10, 'architecture'),
(19, 'dangereux'),
(4, 'decay'),
(20, 'eglise'),
(22, 'etikurbex'),
(3, 'explore'),
(5, 'forgottenplaces'),
(25, 'j'),
(24, 'laVi'),
(2, 'manoir'),
(8, 'paysage'),
(6, 'urbex'),
(9, 'urbexFrance'),
(23, 'urbexPeople'),
(12, 'usine'),
(11, 'ville'),
(1, 'voyage');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `alias`) VALUES
(1, 'ada@test.org', '098f6bcd4621d373cade4e832627b4f6', 'ada'),
(2, 'alex@test.org', '098f6bcd4621d373cade4e832627b4f6', 'Alexandra'),
(3, 'bea@test.org', '098f6bcd4621d373cade4e832627b4f6', 'Béatrice'),
(4, 'zoe@test.org', '098f6bcd4621d373cade4e832627b4f6', 'Zoé'),
(5, 'felicie@test.org', '098f6bcd4621d373cade4e832627b4f6', 'Félicie'),
(6, 'cecile@test.com', '098f6bcd4621d373cade4e832627b4f6', 'Cécile'),
(7, 'chacha@test.net', '098f6bcd4621d373cade4e832627b4f6', 'Charlotte'),
(8, 'kats.ink@hotmail.fr', 'b4b8daf4b8ea9d39568719e1e320076f', 'klervy'),
(9, 'jeanmi@mail.com', 'ab4f63f9ac65152575886860dde480a1', 'jeanmi'),
(10, 'c.monvillers@live.fr', 'b4b8daf4b8ea9d39568719e1e320076f', 'Corentin'),
(11, 'nadhell@live.com', 'b4b8daf4b8ea9d39568719e1e320076f', 'Nadège'),
(12, 'henri@henri.henri', 'b4b8daf4b8ea9d39568719e1e320076f', 'henri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_users_users2_idx` (`following_user_id`),
  ADD KEY `fk_users_has_users_users1_idx` (`followed_user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_posts_posts1_idx` (`post_id`),
  ADD KEY `fk_users_has_posts_users1_idx` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_users_idx` (`user_id`),
  ADD KEY `fk_posts_posts1_idx` (`parent_id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_has_tags_tags1_idx` (`tag_id`),
  ADD KEY `fk_posts_has_tags_posts1_idx` (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_UNIQUE` (`label`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `alias_UNIQUE` (`alias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `posts_tags`
--
ALTER TABLE `posts_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `fk_users_has_users_users1` FOREIGN KEY (`followed_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_users_has_users_users2` FOREIGN KEY (`following_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_users_has_posts_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_users_has_posts_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_posts1` FOREIGN KEY (`parent_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD CONSTRAINT `fk_posts_has_tags_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_posts_has_tags_tags1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
