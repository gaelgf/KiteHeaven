-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Février 2017 à 22:47
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kiteheaven`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'video'),
(2, 'image');

-- --------------------------------------------------------

--
-- Structure de la table `category_item`
--

CREATE TABLE `category_item` (
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `spot_id` int(11) DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `spot_id`, `text`, `created`) VALUES
(3, 4, 4, 'Donec a nisl molestie nibh pharetra viverra. Nullam euismod ex eget ipsum maximus imperdiet. Donec sit amet magna quam. Phasellus neque sem, viverra non venenatis vel, ultrices et leo. Suspendisse nec luctus metus. Curabitur malesuada, nisi non mollis vestibulum, augue tortor elementum elit, in pharetra ipsum nisl vel orci. Vestibulum tempus nisi et justo finibus sollicitudin gravida tincidunt elit. Nam finibus lacinia neque et pretium. Phasellus id nisl finibus, rutrum enim commodo, interdum dui. Proin dignissim finibus libero, iaculis molestie enim vestibulum sed. Aliquam ullamcorper tincidunt lorem, eu aliquam nisi posuere aliquet. Praesent cursus turpis pellentesque urna placerat, ut condimentum dolor placerat. Duis et consectetur dui. Vestibulum eget odio eu lacus eleifend molestie.', '2017-02-06 20:55:39');

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateOfBirth` datetime DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipCode` int(11) DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `lastName`, `firstName`, `dateOfBirth`, `address`, `zipCode`, `city`, `job`, `avatar`) VALUES
(1, 'test', 'test', 'test@test.fr', 'test@test.fr', 1, 'qbmjelicie8gswwgwoswgosgskow4cs', '$2y$13$Q1yYiDNKdBn4lgw4kC/z7eQIXPQCg7hJQ9SjEkDEPVSW1.ppt.3sm', '2017-02-06 21:39:38', NULL, NULL, 'a:0:{}', 'test', 'test', '2014-03-03 03:01:00', 'test', 12345, 'test', 'test', ''),
(2, 'admin', 'admin', 'admin@admin.fr', 'admin@admin.fr', 1, '3g9u9b7ts1s0go00g8wog44g8csk4gg', '$2y$13$B.ApHt/gxDNfmmBkOj5EAe1m25Owx82LvqX/6sbwGEiIUaQXjV.NW', '2017-02-06 21:35:09', NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(3, 'test2', 'test2', 'test2@test.fr', 'test2@test.fr', 1, NULL, '$2y$13$rznrWPB1.kT5jwWalKN.iOKupyBjlMLVb.W5dVkZQWtCwO4LolRyi', '2017-02-06 21:38:51', NULL, NULL, 'a:2:{i:0;s:10:"ROLE_ADMIN";i:1;s:16:"ROLE_SUPER_ADMIN";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6bcccb73bedce15e3cf846d8bfa2e069.jpeg'),
(4, 'johnDoe', 'johndoe', 'john@doe.fr', 'john@doe.fr', 1, NULL, '$2y$13$uTOTixlgx7LdI867Njk9Je7o5d0Ceeruv1CneG3KC0RJPpdj5nyY2', '2017-02-06 21:49:30', NULL, NULL, 'a:0:{}', 'Doe', 'John', '2012-02-03 01:01:00', '12 rue de John', 12345, 'JohnVille', 'Dev', '5a6b784e1366cbecaa58547d9ad55a20.png'),
(5, 'test3', 'test3', 'test3@test.fr', 'test3@test.fr', 1, NULL, '$2y$13$MrPOBbHtHng96oOXVkrkCOpdZqI74GIHPO0cpGesMgPVowBIv4ytq', '2017-02-06 21:51:14', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eaa290bbbe88ce1094b03ca764fd0dd1.png');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `spot_id` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `spot_id`, `url`, `type`) VALUES
(11, 4, 'https://www.youtube.com/v/ibxrdsR9728', 'video'),
(12, 4, 'https://www.youtube.com/v/AnDY6tSk9Ng', 'video'),
(13, 4, 'https://www.youtube.com/v/DOVoWJxRMXM', 'video'),
(14, 4, 'https://www.youtube.com/v/H3FF6HBfTfI', 'video'),
(15, 4, '7458fbfce4e005f5fc3f9ce29cc3587e.jpeg', 'image'),
(16, 4, '1e0ea14c3a89000d93c991897e14dce7.jpeg', 'image'),
(17, 4, '90af76765164c64a73e2d607494f6ca9.jpeg', 'image'),
(18, 4, 'e404976725a62faa5b544f54e32ede3e.jpeg', 'image');

-- --------------------------------------------------------

--
-- Structure de la table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `spot_id` int(11) DEFAULT NULL,
  `note` smallint(6) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `notice`
--

INSERT INTO `notice` (`id`, `user_id`, `spot_id`, `note`, `comment`) VALUES
(4, 4, 4, 5, NULL),
(5, 5, 4, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `spot`
--

CREATE TABLE `spot` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `imageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `spot`
--

INSERT INTO `spot` (`id`, `user_id`, `title`, `imageTitle`, `address`, `description`) VALUES
(4, 4, 'Quiberon', '47b74dce4613065664b4dd3105a94823.jpeg', 'Quiberon (56) - France', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nulla leo, fringilla sed mi id, lacinia mattis dui. Quisque ullamcorper eget orci non porttitor. Aliquam sollicitudin posuere sem, vel semper magna porttitor vitae. Cras elementum congue tellus, id ullamcorper dolor fermentum sit amet. Aenean sapien nulla, bibendum nec nunc sit amet, finibus sodales velit. Nulla maximus suscipit felis. Pellentesque malesuada sagittis luctus.\r\n\r\nDonec a nisl molestie nibh pharetra viverra. Nullam euismod ex eget ipsum maximus imperdiet. Donec sit amet magna quam. Phasellus neque sem, viverra non venenatis vel, ultrices et leo. Suspendisse nec luctus metus. Curabitur malesuada, nisi non mollis vestibulum, augue tortor elementum elit, in pharetra ipsum nisl vel orci. Vestibulum tempus nisi et justo finibus sollicitudin gravida tincidunt elit. Nam finibus lacinia neque et pretium. Phasellus id nisl finibus, rutrum enim commodo, interdum dui. Proin dignissim finibus libero, iaculis molestie enim vestibulum sed. Aliquam ullamcorper tincidunt lorem, eu aliquam nisi posuere aliquet. Praesent cursus turpis pellentesque urna placerat, ut condimentum dolor placerat. Duis et consectetur dui. Vestibulum eget odio eu lacus eleifend molestie.\r\n\r\nMauris eu cursus libero. Cras accumsan feugiat pretium. Pellentesque in felis ipsum. Curabitur magna metus, placerat in venenatis in, lobortis at neque. Quisque arcu purus, varius in feugiat at, mattis eget ligula. In vel interdum lacus. Aenean non velit id lorem imperdiet porttitor vitae vel lectus. Proin vel nibh ac arcu pharetra fringilla. In ut sapien sit amet odio dapibus luctus. Sed euismod porta sapien. Sed neque nulla, rhoncus nec est ac, rutrum rhoncus odio. Quisque venenatis dapibus ultrices. Ut eget augue interdum, rutrum nunc nec, hendrerit ipsum. Vestibulum eleifend magna id lorem consequat, sit amet fermentum turpis semper.\r\n\r\nIn suscipit diam augue, eleifend ultrices est imperdiet ac. Nunc vulputate, enim in blandit egestas, metus quam tincidunt purus, id gravida diam nunc vel felis. Phasellus in risus pellentesque, facilisis velit vel, viverra purus. Phasellus a posuere nulla. Sed mollis suscipit odio nec maximus. Etiam ante nisl, vulputate at est a, efficitur accumsan ex. Integer auctor tempus sem, vel luctus ligula egestas sed. Curabitur feugiat urna et nisl gravida ornare. Fusce consequat neque ut arcu tincidunt sagittis. Nunc feugiat cursus quam quis luctus. Nam maximus suscipit erat, sed tristique libero vehicula gravida. Morbi metus metus, semper non velit et, vulputate accumsan libero. Nam posuere ullamcorper interdum.\r\n\r\nVestibulum nulla quam, vehicula ac libero nec, tempus egestas sem. Phasellus lacus eros, aliquet eget enim vel, finibus maximus quam. Maecenas pellentesque diam at ipsum condimentum vestibulum. Aliquam nec enim eleifend, dignissim metus a, eleifend augue. Cras ut luctus odio. Phasellus molestie libero ultrices, lobortis magna posuere, facilisis ante. Etiam vitae orci id leo viverra feugiat. Donec commodo tellus sem, eu scelerisque orci consequat a. Mauris tincidunt lacus eu arcu rhoncus, sed luctus sapien interdum. Etiam consequat eros purus, et mollis libero posuere vitae.');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_item`
--
ALTER TABLE `category_item`
  ADD PRIMARY KEY (`category_id`,`item_id`),
  ADD KEY `IDX_94805F5912469DE2` (`category_id`),
  ADD KEY `IDX_94805F59126F525E` (`item_id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`),
  ADD KEY `IDX_9474526C2DF1D37C` (`spot_id`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F1B251E2DF1D37C` (`spot_id`);

--
-- Index pour la table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_480D45C2A76ED395` (`user_id`),
  ADD KEY `IDX_480D45C22DF1D37C` (`spot_id`);

--
-- Index pour la table `spot`
--
ALTER TABLE `spot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B9327A73A76ED395` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `spot`
--
ALTER TABLE `spot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `category_item`
--
ALTER TABLE `category_item`
  ADD CONSTRAINT `FK_94805F5912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_94805F59126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C2DF1D37C` FOREIGN KEY (`spot_id`) REFERENCES `spot` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251E2DF1D37C` FOREIGN KEY (`spot_id`) REFERENCES `spot` (`id`);

--
-- Contraintes pour la table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `FK_480D45C22DF1D37C` FOREIGN KEY (`spot_id`) REFERENCES `spot` (`id`),
  ADD CONSTRAINT `FK_480D45C2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `spot`
--
ALTER TABLE `spot`
  ADD CONSTRAINT `FK_B9327A73A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
