-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 26 juil. 2023 à 13:41
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ramsa`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `activity_user` int(11) NOT NULL,
  `activity_content` varchar(255) NOT NULL,
  `activity_date` date NOT NULL DEFAULT current_timestamp(),
  `activity_time` time NOT NULL DEFAULT current_timestamp(),
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`activity_id`, `activity_user`, `activity_content`, `activity_date`, `activity_time`, `isAdmin`) VALUES
(1, 1, 'admin@gmail.com a modifié les infos du client client1 prenom', '2023-07-24', '11:39:59', 1),
(3, 1, 'admin@gmail.com a ajouté un client : mohammed ezzarktouni', '2023-07-24', '12:58:34', 1),
(6, 1, 'admin@gmail.com a ajouté un contrat (contrat_id : 8 ) au client mohammed ezzarktouni', '2023-07-24', '13:02:27', 1),
(8, 1, 'admin@gmail.com a modifié les infos du  contrat (contrat_id : 8 ) au client mohammed ezzarktouni', '2023-07-24', '13:04:33', 1),
(9, 1, 'admin@gmail.com a traité la demande Demande d\'abonnement du client client1 prenom', '2023-07-24', '13:05:33', 1),
(10, 1, 'client1 prenom a changé ses informations', '2023-07-24', '18:20:04', 0),
(11, 1, 'client1 prenom a demandé une Historique de Consommation', '2023-07-24', '18:26:04', 0),
(12, 1, 'client1 prenom a ajouté une réclamation ', '2023-07-24', '20:36:43', 0),
(13, 1, 'client1 prenom a ajouté une réclamation ', '2023-07-24', '20:36:49', 0),
(14, 1, 'client1 prenom a demandé demande de contrat', '2023-07-24', '20:37:00', 0),
(15, 1, 'admin@gmail.com a répondu à la réclamation 2', '2023-07-25', '11:46:30', 1),
(23, 1, 'admin@gmail.com a enregistrer la consommation    pour l\'adresse almassira rue 17 et pour la date 6/2023', '2023-07-25', '19:24:06', 1),
(26, 1, 'admin@gmail.com a modifié la consommation n° 13', '2023-07-25', '19:36:34', 1),
(27, 1, 'admin@gmail.com a traité la demande demande de contrat du client client1 prenom', '2023-07-25', '19:46:16', 1),
(28, 1, 'admin@gmail.com a traité la demande demande de contrat du client client1 prenom', '2023-07-25', '19:51:14', 1),
(29, 1, 'admin@gmail.com a modifié les infos du client client1 prenom', '2023-07-25', '20:11:10', 1),
(30, 1, 'admin@gmail.com a modifié les infos du client client1 prenom', '2023-07-25', '20:12:37', 1),
(31, 1, 'admin@gmail.com a payé  la facture 15', '2023-07-26', '11:48:26', 1),
(32, 2, 'TFARES Isam a demandé une Historique de Consommation pour Contrat id: 2', '2023-07-26', '12:38:09', 0);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'admin1@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_id`, `password`, `nom`, `prenom`, `adresse`, `tel`, `email`, `isVerified`, `token`, `isActive`) VALUES
(1, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'client1', 'prenom', 'Tilila Bab Al madina B.P 8094 Hay Dakhla', '0987652415', 'client1@gmail.com', 0, 'ce6eba15d017a08c184afbe03bcb79e0e322ba714d713ff05730e868d638fdbd', 1),
(2, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TFARES', 'Isam', 'Essalam résidence nassr', '0565335257', 'client2@gmail.com', 0, '2e09e55d33d89c3e82d09353e799d5a4c4da125be6c02114ecfea3966f17d9f2', 1),
(7, '9adcb29710e807607b683f62e555c22dc5659713', 'client3', 'prenom', 'adresse 3', '2093949949', 'client3@gmail.com', 0, '', 1),
(8, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mohammed', 'ezzarktouni', 'Avenue Rabat almassira', '019293884', 'mohamedezz@gmail.com', 0, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `consommations`
--

CREATE TABLE `consommations` (
  `consommation_id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `consommation_mois` varchar(20) NOT NULL DEFAULT current_timestamp(),
  `consommation_annee` varchar(20) NOT NULL,
  `consommation_index1` int(11) NOT NULL,
  `consommation_index2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `consommations`
--

INSERT INTO `consommations` (`consommation_id`, `contrat_id`, `consommation_mois`, `consommation_annee`, `consommation_index1`, `consommation_index2`) VALUES
(1, 3, '4', '2023', 0, 20),
(2, 3, '5', '2023', 20, 44),
(3, 1, '4', '2023', 0, 17),
(4, 1, '5', '2023', 17, 35),
(5, 2, '4', '2023', 0, 24),
(6, 2, '5', '2023', 24, 50),
(7, 3, '6', '2023', 44, 60),
(9, 2, '6', '2023', 50, 83),
(10, 1, '6', '2023', 35, 55),
(13, 9, '6', '2023', 0, 11);

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE `contrats` (
  `contrat_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `date_de_debut` date NOT NULL DEFAULT current_timestamp(),
  `date_de_fin` date DEFAULT NULL,
  `adresse_local` varchar(50) NOT NULL,
  `localite_id` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`contrat_id`, `client_id`, `numero`, `date_de_debut`, `date_de_fin`, `adresse_local`, `localite_id`, `etat`) VALUES
(1, 1, 1, '2023-04-01', '2025-07-17', 'les amicales', 1, 1),
(2, 2, 1, '2023-04-01', '2024-07-15', 'les amicales', 1, 1),
(3, 7, 1, '2023-04-01', '2024-07-07', 'essalam', 1, 1),
(5, 1, 2, '2023-07-01', '2023-07-19', 'Dakhla ', 1, 0),
(8, 8, 1, '2023-07-01', '2025-07-23', 'Avenue Rabat almassira N234', 1, 1),
(9, 1, 3, '2023-06-30', NULL, 'almassira rue 17', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `demande_id` int(11) NOT NULL,
  `demande_type_id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `demande_date` date NOT NULL DEFAULT current_timestamp(),
  `demande_time` time NOT NULL DEFAULT current_timestamp(),
  `etat` tinyint(1) NOT NULL DEFAULT 0,
  `file_path` varchar(50) DEFAULT NULL,
  `date_traitement` date DEFAULT NULL,
  `time_traitement` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`demande_id`, `demande_type_id`, `contrat_id`, `client_id`, `demande_date`, `demande_time`, `etat`, `file_path`, `date_traitement`, `time_traitement`) VALUES
(1, 3, 1, 1, '2023-07-19', '15:51:06', 1, 'encaissements_history_client1_prenom_3.pdf', '2023-07-21', '17:18:20'),
(2, 4, 1, 1, '2023-07-19', '16:01:49', 1, 'consommation_history_client1_prenom_3.pdf', '2023-07-21', '13:14:04'),
(5, 2, 5, 1, '2023-07-19', '18:04:16', 1, NULL, '2023-07-19', '18:07:01'),
(8, 3, 1, 1, '2023-07-21', '23:57:46', 0, NULL, NULL, NULL),
(9, 4, 9, 1, '2023-07-24', '18:26:04', 0, NULL, NULL, NULL),
(10, 5, 9, 1, '2023-07-24', '20:37:00', 1, 'contrat_9client1_prenom.pdf', '2023-07-25', '19:51:14'),
(11, 4, 2, 2, '2023-07-26', '12:38:09', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `demandes_abonnement`
--

CREATE TABLE `demandes_abonnement` (
  `demande_id` int(11) NOT NULL,
  `demande_date` date NOT NULL DEFAULT current_timestamp(),
  `demande_time` time NOT NULL DEFAULT current_timestamp(),
  `client_id` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `adresse_local` varchar(50) NOT NULL,
  `date_traitement` date DEFAULT NULL,
  `time_traitement` time DEFAULT NULL,
  `demande_type_id` int(11) NOT NULL DEFAULT 1,
  `localite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `demandes_abonnement`
--

INSERT INTO `demandes_abonnement` (`demande_id`, `demande_date`, `demande_time`, `client_id`, `etat`, `adresse_local`, `date_traitement`, `time_traitement`, `demande_type_id`, `localite_id`) VALUES
(1, '2023-07-19', '15:48:56', 1, 1, 'Dakhla ', '2023-07-19', '17:59:19', 1, 1),
(2, '2023-07-21', '23:54:28', 1, 1, 'almassira rue 17', '2023-07-24', '13:05:33', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demandes_types`
--

CREATE TABLE `demandes_types` (
  `demande_type_id` int(11) NOT NULL,
  `demande_name` varchar(50) DEFAULT NULL,
  `contrat` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `demandes_types`
--

INSERT INTO `demandes_types` (`demande_type_id`, `demande_name`, `contrat`) VALUES
(1, 'Demande d\'abonnement', 0),
(2, 'Demande de Resiliation', 1),
(3, 'Historique de L\'encaissement', 1),
(4, 'Historique de Consommation', 1),
(5, 'demande de contrat', 1);

-- --------------------------------------------------------

--
-- Structure de la table `encaissements`
--

CREATE TABLE `encaissements` (
  `encaissement_id` int(11) NOT NULL,
  `encaissement_date` date NOT NULL DEFAULT current_timestamp(),
  `encaissement_time` time NOT NULL DEFAULT current_timestamp(),
  `facture_id` int(11) NOT NULL,
  `mode_payement_id` int(11) NOT NULL,
  `Ncheque,transaction` varchar(30) NOT NULL,
  `contrat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `encaissements`
--

INSERT INTO `encaissements` (`encaissement_id`, `encaissement_date`, `encaissement_time`, `facture_id`, `mode_payement_id`, `Ncheque,transaction`, `contrat_id`) VALUES
(1, '2023-05-02', '19:47:52', 5, 1, '', 3),
(2, '2023-05-03', '10:52:43', 7, 1, '', 2),
(3, '2023-05-03', '10:52:43', 6, 2, '112829911', 1),
(4, '2023-06-02', '10:56:35', 10, 1, '', 2),
(5, '2023-06-03', '09:56:35', 8, 1, '', 3),
(6, '2023-06-03', '11:56:35', 9, 1, '', 1),
(7, '2023-07-18', '20:45:34', 11, 2, '3737819201', 3),
(68, '2023-07-26', '11:48:26', 15, 1, '', 9);

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `facture_id` int(11) NOT NULL,
  `facture_payement_date` datetime DEFAULT NULL,
  `facture_time` datetime NOT NULL DEFAULT current_timestamp(),
  `montant` decimal(8,2) NOT NULL,
  `consommation_id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`facture_id`, `facture_payement_date`, `facture_time`, `montant`, `consommation_id`, `contrat_id`, `etat`) VALUES
(5, '2023-05-02 19:47:52', '2023-05-01 10:47:52', '200.00', 1, 3, 1),
(6, '2023-05-03 10:52:43', '2023-05-01 13:52:43', '170.00', 3, 1, 1),
(7, '2023-05-03 10:52:43', '2023-05-01 11:32:43', '240.00', 5, 2, 1),
(8, '2023-06-03 09:56:35', '2023-06-01 11:42:35', '240.00', 2, 3, 1),
(9, '2023-06-03 11:56:35', '2023-06-01 10:42:35', '180.00', 4, 1, 1),
(10, '2023-06-02 10:56:35', '2023-06-01 14:22:35', '260.00', 6, 2, 1),
(11, '2023-07-18 20:45:34', '2023-07-01 15:05:15', '160.00', 7, 3, 1),
(13, NULL, '2023-07-18 21:14:06', '330.00', 9, 2, 0),
(14, NULL, '2023-07-19 12:36:41', '200.00', 10, 1, 0),
(15, '2023-07-26 11:48:26', '2023-07-25 19:24:06', '110.00', 13, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `localites`
--

CREATE TABLE `localites` (
  `localite_id` int(11) NOT NULL,
  `localite_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `localites`
--

INSERT INTO `localites` (`localite_id`, `localite_name`) VALUES
(1, 'Agadir'),
(4, 'aourir'),
(3, 'dcheira'),
(2, 'Inzegane ait melloul');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message_content` varchar(200) NOT NULL,
  `client_id` int(11) NOT NULL,
  `message_statut` int(11) NOT NULL DEFAULT 0,
  `message_date` date NOT NULL DEFAULT current_timestamp(),
  `reponse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `message_content`, `client_id`, `message_statut`, `message_date`, `reponse`) VALUES
(2, 'Bonjour, Monsieur. J\'aimerais bien vous demander de m\'envoyer un exemplaire de mon attestation d abonnement si c\'est possible.', 2, 1, '2023-07-06', 'Bonjour votre demande est traité'),
(4, 'Bonjour, Monsieur. J\'aimerais bien vous demander de m\'envoyer un exemplaire de mon attestation d abonnement si c\'est possible.', 1, 0, '2023-07-07', NULL),
(5, 'Bonjour, Monsieur. J\'aimerais bien vous demander de m\'envoyer un exemplaire de mon attestation d abonnement si c\'est possible.', 1, 0, '2023-07-15', NULL),
(6, 'Bonjour, Monsieur. J\'aimerais bien vous demander de m\'envoyer un exemplaire de mon attestation d abonnement si c\'est possible.', 1, 0, '2023-07-24', NULL),
(7, 'Bonjour, Monsieur. J\'aimerais bien vous demander de m\'envoyer un exemplaire de mon attestation d abonnement si c\'est possible.', 1, 0, '2023-07-24', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `modes_payement`
--

CREATE TABLE `modes_payement` (
  `mode_payement_id` int(11) NOT NULL,
  `mode_payement` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `modes_payement`
--

INSERT INTO `modes_payement` (`mode_payement_id`, `mode_payement`) VALUES
(2, 'cheque'),
(1, 'espece'),
(3, 'virement bancaire');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Index pour la table `consommations`
--
ALTER TABLE `consommations`
  ADD PRIMARY KEY (`consommation_id`),
  ADD KEY `h_contrat` (`contrat_id`);

--
-- Index pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`contrat_id`),
  ADD KEY `FK_ClientContrat` (`client_id`),
  ADD KEY `FK_PersonOrder` (`localite_id`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`demande_id`),
  ADD KEY `fk_demande_type` (`demande_type_id`),
  ADD KEY `fk_contrat_id` (`contrat_id`),
  ADD KEY `fk_client_id` (`client_id`);

--
-- Index pour la table `demandes_abonnement`
--
ALTER TABLE `demandes_abonnement`
  ADD PRIMARY KEY (`demande_id`),
  ADD KEY `abon_client_id` (`client_id`);

--
-- Index pour la table `demandes_types`
--
ALTER TABLE `demandes_types`
  ADD PRIMARY KEY (`demande_type_id`),
  ADD UNIQUE KEY `nom` (`demande_name`);

--
-- Index pour la table `encaissements`
--
ALTER TABLE `encaissements`
  ADD PRIMARY KEY (`encaissement_id`),
  ADD KEY `en_contrat` (`contrat_id`),
  ADD KEY `en_mode` (`mode_payement_id`),
  ADD KEY `fk_encaissement_facture` (`facture_id`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`facture_id`),
  ADD KEY `e_contrat` (`contrat_id`),
  ADD KEY `fk_consommation` (`consommation_id`);

--
-- Index pour la table `localites`
--
ALTER TABLE `localites`
  ADD PRIMARY KEY (`localite_id`),
  ADD UNIQUE KEY `loaclite_unique` (`localite_name`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `messages_client` (`client_id`);

--
-- Index pour la table `modes_payement`
--
ALTER TABLE `modes_payement`
  ADD PRIMARY KEY (`mode_payement_id`),
  ADD UNIQUE KEY `mode_payement` (`mode_payement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `consommations`
--
ALTER TABLE `consommations`
  MODIFY `consommation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `contrat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `demande_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `demandes_abonnement`
--
ALTER TABLE `demandes_abonnement`
  MODIFY `demande_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `demandes_types`
--
ALTER TABLE `demandes_types`
  MODIFY `demande_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `encaissements`
--
ALTER TABLE `encaissements`
  MODIFY `encaissement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `facture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `localites`
--
ALTER TABLE `localites`
  MODIFY `localite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `modes_payement`
--
ALTER TABLE `modes_payement`
  MODIFY `mode_payement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `consommations`
--
ALTER TABLE `consommations`
  ADD CONSTRAINT `h_contrat` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`contrat_id`);

--
-- Contraintes pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `FK_ClientContrat` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `FK_PersonOrder` FOREIGN KEY (`localite_id`) REFERENCES `localites` (`localite_id`);

--
-- Contraintes pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_contrat_id` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`contrat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_demande_type` FOREIGN KEY (`demande_type_id`) REFERENCES `demandes_types` (`demande_type_id`);

--
-- Contraintes pour la table `demandes_abonnement`
--
ALTER TABLE `demandes_abonnement`
  ADD CONSTRAINT `abon_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `encaissements`
--
ALTER TABLE `encaissements`
  ADD CONSTRAINT `e_facture` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`facture_id`),
  ADD CONSTRAINT `en_contrat` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`contrat_id`),
  ADD CONSTRAINT `en_mode` FOREIGN KEY (`mode_payement_id`) REFERENCES `modes_payement` (`mode_payement_id`),
  ADD CONSTRAINT `fk_encaissement_facture` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`facture_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `F_consommation` FOREIGN KEY (`consommation_id`) REFERENCES `consommations` (`consommation_id`),
  ADD CONSTRAINT `e_contrat` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`contrat_id`),
  ADD CONSTRAINT `f_contrat` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`contrat_id`),
  ADD CONSTRAINT `fk_consommation` FOREIGN KEY (`consommation_id`) REFERENCES `consommations` (`consommation_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
