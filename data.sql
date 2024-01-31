
--
-- Structure de la table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` smallint NOT NULL,
  `energy` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kilometers` int NOT NULL,
  `price` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `brand`, `model`, `year`, `energy`, `kilometers`, `price`, `created_at`, `updated_at`) VALUES
(12, 'BMW', 'Série 5 G30', 2020, 'diesel', 87889, 56680, '2023-12-22 14:01:31', '2023-12-22 14:01:31'),
(13, 'Ford', 'Focus III Phase 2', 2018, 'essence', 45963, 20000, '2023-12-22 14:01:31', '2023-12-22 14:01:31'),
(14, 'BMW', 'X3 F25 phase 2', 2017, 'diesel', 85536, 40000, '2023-12-22 14:01:31', '2023-12-22 14:01:31'),
(15, 'Ford', 'Mustang VI COUPE', 2018, 'essence', 25412, 80000, '2023-12-22 14:01:31', '2023-12-22 14:01:31'),
(16, 'Ford', 'Mustang VI COUPE', 2021, 'essence', 81750, 90000, '2023-12-22 14:01:31', '2023-12-22 14:01:31'),
(17, 'Porsche', 'PANAMERA II SPORT TURISMO', 2018, 'essence', 70456, 95000, '2023-12-22 14:14:42', '2023-12-22 14:14:42');

-- --------------------------------------------------------

--
-- Structure de la table `car_equipement`
--

DROP TABLE IF EXISTS `car_equipement`;
CREATE TABLE IF NOT EXISTS `car_equipement` (
  `car_id` int NOT NULL,
  `equipement_id` int NOT NULL,
  PRIMARY KEY (`car_id`,`equipement_id`),
  KEY `IDX_8A6B48E2C3C6F69F` (`car_id`),
  KEY `IDX_8A6B48E2806F0F5C` (`equipement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `car_equipement`
--

INSERT INTO `car_equipement` (`car_id`, `equipement_id`) VALUES
(12, 11),
(12, 12),
(12, 13),
(12, 14),
(12, 15),
(12, 16),
(13, 11),
(13, 12),
(13, 13),
(13, 15),
(13, 16),
(14, 11),
(14, 12),
(14, 13),
(14, 15),
(14, 16),
(15, 10),
(15, 11),
(15, 12),
(15, 13),
(15, 14),
(15, 15),
(15, 16),
(15, 17),
(15, 18),
(16, 10),
(16, 11),
(16, 12),
(16, 13),
(16, 14),
(16, 15),
(16, 16),
(16, 17),
(16, 18),
(17, 10),
(17, 11),
(17, 12),
(17, 13),
(17, 14),
(17, 15),
(17, 16),
(17, 17),
(17, 18);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638C3C6F69F` (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `car_id`, `subject`, `name`, `firstname`, `email`, `phone`, `message`, `created_at`) VALUES
(6, NULL, 'Cum ut mollitia quia soluta. Quibusdam officia tenetur ut in atque. Nam tenetur dicta et et.', 'Sabine-Gabrielle Labbe', 'Louis Girard', 'costa.antoine@gonzalez.net', '0507210857', 'Nihil labore quia non quo fuga aut. Eligendi ratione omnis ipsa porro possimus odit aut. Ad molestiae cupiditate fugit neque.', '2023-12-22 14:01:35'),
(7, NULL, 'Vel autem quo temporibus. Quia quam ipsa ex velit autem qui.', 'Jacqueline Michaud', 'Vincent Deschamps', 'yves.humbert@laposte.net', '0187482479', 'Vitae vero quam quis excepturi error. Ut debitis eius molestiae eligendi possimus. Dolor voluptatem expedita unde nihil culpa.', '2023-12-22 14:01:35'),
(8, NULL, 'Dolorem dolorem error voluptatum sequi quo eum. Ratione velit quia ut nihil eligendi quae aut.', 'Éléonore Barbier', 'Philippine Charpentier', 'capucine73@briand.org', '0414017214', 'Sit non ut aut itaque voluptates distinctio sunt. Praesentium voluptatum eveniet enim. Qui voluptas mollitia perferendis velit repellendus.', '2023-12-22 14:01:35'),
(9, NULL, 'Excepturi nihil eum dicta ut. Rerum sed in neque ut dolorem.', 'Renée Martineau', 'Martine Rey', 'aime.gregoire@gmail.com', '0340792841', 'Provident repellat et ea cumque earum. Cupiditate et eos dolorem ut ab ut officiis deleniti. Optio iusto qui laudantium.', '2023-12-22 14:01:35'),
(10, NULL, 'Enim quam velit et in eum et. Est quia commodi nemo qui nesciunt. Perferendis eos eum ad et nisi.', 'Christine-Valentine Bourgeois', 'Denise Guyot-Devaux', 'edevaux@leger.com', '0220159289', 'Qui omnis quidem nesciunt occaecati molestias odio vel ipsam. Eaque rerum enim itaque et doloribus. Doloribus culpa debitis saepe ducimus. Dicta dolore repellendus dolore id.', '2023-12-22 14:01:35');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
CREATE TABLE IF NOT EXISTS `equipement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `name`) VALUES
(10, 'Caméra de recul'),
(11, 'Radar de recul'),
(12, 'Rétroviseurs électriques et dégivrants'),
(13, 'Régulateur limiteur de vitesse'),
(14, 'Sièges électriques'),
(15, 'GPS'),
(16, 'Bluetooth'),
(17, 'Alerte franchissement ligne'),
(18, 'Sièges chauffants');

-- --------------------------------------------------------

--
-- Structure de la table `hour`
--

DROP TABLE IF EXISTS `hour`;
CREATE TABLE IF NOT EXISTS `hour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `day` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_time1` time NOT NULL,
  `closing_time1` time NOT NULL,
  `opening_time2` time NOT NULL,
  `closing_time2` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hour`
--

INSERT INTO `hour` (`id`, `day`, `opening_time1`, `closing_time1`, `opening_time2`, `closing_time2`) VALUES
(7, 'Lundi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
(8, 'Mardi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
(9, 'Mercredi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
(10, 'Jeudi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
(11, 'Vendredi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
(12, 'Samedi', '09:00:00', '12:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045FC3C6F69F` (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `car_id`, `name`) VALUES
(19, 12, 'a47c93ec8184da25b7f96c271ec40116.jpg'),
(20, 12, 'a571425adf852398ae739d7c92d57686.jpg'),
(21, 13, '811952d003c5e293f39c5834492e3685.jpg'),
(22, 13, '06df1706e75d802a2c2952279e00dffb.jpg'),
(23, 14, 'a1ef40e7c1590b1b570dcc8dd3d2afcb.jpg'),
(24, 14, '97883e26bb0c7e15df7b9c20fd198da0.jpg'),
(25, 15, 'b79c5c934c2d0a7d419199eb844977d9.jpg'),
(26, 16, 'e40d2043d9384885f4dbc11cc99e2073.jpg'),
(27, 17, 'f988a5eb0dc2ca95b7c5cb5348f6be35.jpg'),
(28, 17, 'f5820fd25afa1af4faf7b2b3b8bfa147.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `opinion`
--

DROP TABLE IF EXISTS `opinion`;
CREATE TABLE IF NOT EXISTS `opinion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark` smallint NOT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `opinion`
--

INSERT INTO `opinion` (`id`, `name`, `message`, `mark`, `is_approved`, `created_at`) VALUES
(22, 'Suzanne Langlois', 'Et deleniti veritatis consequatur. Laborum vero et nemo. Repellendus quo voluptas tempora.', 1, 0, '2023-12-22 14:01:35'),
(24, 'Hélène Pottier-Ribeiro', 'Voluptate assumenda est quaerat voluptas ipsum dolorem. Aut quo sit iure nam occaecati alias.', 2, 0, '2023-12-22 14:01:35'),
(25, 'Lucie Leclercq', 'Nam sit laudantium sunt. Odit asperiores similique unde.', 3, 1, '2023-12-22 14:01:35'),
(26, 'Honoré Roy', 'Eius ipsam id et reiciendis consequuntur unde corrupti. Hic sit neque commodi maxime sunt nihil.', 4, 1, '2023-12-22 14:01:35'),
(27, 'Noël Normand', 'Esse qui fuga fugiat sunt. Nulla nihil est blanditiis veritatis. Saepe deleniti omnis ab enim.', 2, 0, '2023-12-22 14:01:35'),
(29, 'Victoire Rodrigues', 'Modi quia eos et quo. Corporis dolore voluptatum laborum doloribus impedit omnis.', 4, 0, '2023-12-22 14:01:35'),
(30, 'Édith Michel', 'Laudantium eos esse nostrum consequuntur voluptatem. Suscipit commodi sed enim ea ad illum omnis.', 5, 1, '2023-12-22 14:01:35'),
(32, 'Marthe Toussaint', 'Doloremque dolore voluptas sequi iusto inventore dignissimos ut qui. Et non id provident qui et.', 5, 0, '2023-12-22 14:01:35'),
(33, 'Emmanuel Georges', 'Alias maiores voluptatem labore quasi enim. Nihil qui occaecati sed necessitatibus et est ut.', 3, 1, '2023-12-22 14:01:35'),
(34, 'Julien de la Joseph', 'Soluta eum provident voluptatum cupiditate. A esse ab sit iste.', 3, 0, '2023-12-22 14:01:35'),
(36, 'Gilles Maillot', 'Necessitatibus est illo autem. Molestiae ab eligendi velit nobis. Et alias numquam ullam.', 2, 0, '2023-12-22 14:01:35'),
(39, 'Cécile Boucher', 'Sunt rem non cupiditate. Molestiae est dicta animi possimus qui veritatis inventore.', 4, 1, '2023-12-22 14:01:35');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `created_at`) VALUES
(12, 'admin@garageparrot.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$uUk0sWoeJlU/4iGYSltLjuae3V.TEVHb8USQ6UOLUA4ocPOVtBYmq', '2023-12-22 14:01:31'),
(13, 'roux.catherine@tele2.fr', '[\"ROLE_USER\"]', '$2y$13$NfaN2j0gfVDZOPVk9Rwq6eLgOjU7RXOQjsrsK5XnNSMLE/DXbgh3u', '2023-12-22 14:01:31'),
(14, 'jrousset@jacob.fr', '[\"ROLE_USER\"]', '$2y$13$6TkO7j3ijtCX5Yzuiql2dOzYYYT.5z58KvN8lCdNXBYWGftdjXlqW', '2023-12-22 14:01:32'),
(15, 'marcel06@barthelemy.net', '[\"ROLE_USER\"]', '$2y$13$FO40Nxzq2crCPzd3JnDBVOkF2ZPNqqBMkKKNI7/A9Q2zsUm21.ByC', '2023-12-22 14:01:32'),
(16, 'ferrand.paul@charles.com', '[\"ROLE_USER\"]', '$2y$13$mdq93Cq5tNx3wBjusPiWH.7Nr1ykHot/Yblvux8C8GTGyBVTVJWRu', '2023-12-22 14:01:32'),
(17, 'roger.hebert@dias.fr', '[\"ROLE_USER\"]', '$2y$13$zoTpaNV.pmyoZU01uGXwauBreHkQfS2Vra9fymHy/eYx6vkZuzWp.', '2023-12-22 14:01:33'),
(18, 'ileblanc@richard.org', '[\"ROLE_USER\"]', '$2y$13$eLnKFMG.Lepo1BclD8cmx.4iJtnfbkgwVdwKgQdGH3aeHekM5wcYS', '2023-12-22 14:01:33'),
(19, 'dbonnin@chauvet.com', '[\"ROLE_USER\"]', '$2y$13$1zsFiNHaIIBWBheEQwB6F.bOn2ss6cNiJD1ayQIifdGx74yCWBb7S', '2023-12-22 14:01:33'),
(20, 'lefevre.martin@noos.fr', '[\"ROLE_USER\"]', '$2y$13$0fsaat/PQBSs.eJInWw6xe0SNb533T/.eGJFUpyMs8V9TPEoj5gBO', '2023-12-22 14:01:34'),
(21, 'gilles29@coste.fr', '[\"ROLE_USER\"]', '$2y$13$uRcsq3hHpo0ByV/gMfDcPuFOY8uG6Zr4wZPxnbAWdLJur11HSEzq6', '2023-12-22 14:01:34'),
(22, 'christine.ferrand@godard.com', '[\"ROLE_USER\"]', '$2y$13$TOeF21xOAftvRF3dJ0KOOO2QCfcB9JfQFeWtaMTaPpOfqnXgxoQMe', '2023-12-22 14:01:35');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `car_equipement`
--
ALTER TABLE `car_equipement`
  ADD CONSTRAINT `FK_8A6B48E2806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8A6B48E2C3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E638C3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FC3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);
