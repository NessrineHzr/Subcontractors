-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 09 mai 2025 à 18:56
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_subcontractors`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_Contact` int(5) NOT NULL,
  `nom_Contact` varchar(250) NOT NULL,
  `telephone_Contact` varchar(250) NOT NULL,
  `email_Contact` varchar(250) NOT NULL,
  `objet_Contact` varchar(250) NOT NULL,
  `message_Contact` varchar(250) NOT NULL,
  `date_created_Contact` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Contact` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_Contact` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_Contact`, `nom_Contact`, `telephone_Contact`, `email_Contact`, `objet_Contact`, `message_Contact`, `date_created_Contact`, `date_updated_Contact`, `etat_Contact`) VALUES
(12, 'Hazzar', '25854125', 'nessrinehazzar000@gmail.com', 'Demande de travaille', 'kjuhg', '2025-05-09 16:02:13', '2025-05-09 15:02:13', '1'),
(13, 'Hazzar Nessrine', '25854125', 'nessrinehazzar000@gmail.com', 'Demande de travaille', '......', '2025-05-09 16:06:21', '2025-05-09 15:06:21', '1'),
(14, 'Hazzar Nessrine', '25854125', 'nessrinehazzar@gmail.com', 'Demande de travaille', '.....', '2025-05-09 16:08:26', '2025-05-09 15:08:26', '1');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_Demande` int(5) NOT NULL,
  `idEntreprise_Demande` int(5) NOT NULL,
  `nomGerantEntreprise_Demande` varchar(250) NOT NULL,
  `societe_Demande` varchar(250) NOT NULL,
  `date_Demande` date NOT NULL,
  `heure_Demande` time NOT NULL,
  `status_Demande` varchar(250) NOT NULL,
  `date_created_Demande` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Demande` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_Demande` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_Demande`, `idEntreprise_Demande`, `nomGerantEntreprise_Demande`, `societe_Demande`, `date_Demande`, `heure_Demande`, `status_Demande`, `date_created_Demande`, `date_updated_Demande`, `etat_Demande`) VALUES
(1, 1, 'Haddad Amine', 'SITEM', '2025-05-07', '11:31:36', 'Acceptée', '2025-05-07 11:31:36', '2025-05-07 16:12:21', '1'),
(2, 1, 'Haddad Amine', 'SITEM', '2025-05-07', '15:58:14', 'Refusée', '2025-05-07 15:58:14', '2025-05-07 16:12:10', '1'),
(3, 2, 'Haddad  Maram', 'IMG', '2025-05-07', '15:59:48', 'Refusée', '2025-05-07 15:59:48', '2025-05-09 09:29:09', '1'),
(4, 2, 'Haddad  Maram', 'IMG', '2025-05-07', '16:01:12', 'En Attente', '2025-05-07 16:01:12', '2025-05-07 16:01:12', '1');

-- --------------------------------------------------------

--
-- Structure de la table `document_demande`
--

CREATE TABLE `document_demande` (
  `id_DocumentDemande` int(5) NOT NULL,
  `idDemande_DocumentDemande` int(5) NOT NULL,
  `kbis_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeKbis_DocumentDemande` date NOT NULL,
  `pieceIdentitieGerant_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditePIGerant_DocumentDemande` date NOT NULL,
  `attestationRegulariteFiscale_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeAttestRegulariteFiscale_DocumentDemande` date NOT NULL,
  `attestationURSSAF_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeAttestURSSAF_DocumentDemande` date NOT NULL,
  `assuranceRcPro_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeAssuranceRcPro_DocumentDemande` date NOT NULL,
  `siret_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeSiret_DocumentDemande` date NOT NULL,
  `caisseBTP_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeCaisseBTP_DocumentDemande` date NOT NULL,
  `numeroFiscal_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeNumFiscal_DocumentDemande` date NOT NULL,
  `numeroTVA_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeNumTVA_DocumentDemande` date NOT NULL,
  `assurenceDecennale_DocumentDemande` varchar(250) NOT NULL,
  `dateValiditeAssurenceDecennale_DocumentDemande` date NOT NULL,
  `date_created_DocumentDemande` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_DocumentDemande` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_DocumentDemande` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `document_demande`
--

INSERT INTO `document_demande` (`id_DocumentDemande`, `idDemande_DocumentDemande`, `kbis_DocumentDemande`, `dateValiditeKbis_DocumentDemande`, `pieceIdentitieGerant_DocumentDemande`, `dateValiditePIGerant_DocumentDemande`, `attestationRegulariteFiscale_DocumentDemande`, `dateValiditeAttestRegulariteFiscale_DocumentDemande`, `attestationURSSAF_DocumentDemande`, `dateValiditeAttestURSSAF_DocumentDemande`, `assuranceRcPro_DocumentDemande`, `dateValiditeAssuranceRcPro_DocumentDemande`, `siret_DocumentDemande`, `dateValiditeSiret_DocumentDemande`, `caisseBTP_DocumentDemande`, `dateValiditeCaisseBTP_DocumentDemande`, `numeroFiscal_DocumentDemande`, `dateValiditeNumFiscal_DocumentDemande`, `numeroTVA_DocumentDemande`, `dateValiditeNumTVA_DocumentDemande`, `assurenceDecennale_DocumentDemande`, `dateValiditeAssurenceDecennale_DocumentDemande`, `date_created_DocumentDemande`, `date_updated_DocumentDemande`, `etat_DocumentDemande`) VALUES
(1, 1, 'kbis_DocumentDemande_SITEM.pdf', '2025-05-05', 'pieceIdentitieGerant_DocumentDemande_SITEM.pdf', '2025-05-28', 'attestationRegulariteFiscale_DocumentDemande_SITEM.pdf', '2025-06-11', 'attestationURSSAF_DocumentDemande_SITEM.pdf', '2025-05-21', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '2025-05-07 11:31:36', '2025-05-07 11:31:36', '0'),
(2, 2, 'kbis_DocumentDemande_SITEM.pdf', '2025-05-28', 'pieceIdentitieGerant_DocumentDemande_SITEM.pdf', '2025-05-16', 'attestationRegulariteFiscale_DocumentDemande_SITEM.pdf', '2025-07-09', 'attestationURSSAF_DocumentDemande_SITEM.pdf', '2025-06-18', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '2025-05-07 15:58:14', '2025-05-07 15:58:14', '0'),
(3, 3, 'kbis_DocumentDemande_IMG.pdf', '2025-05-20', 'pieceIdentitieGerant_DocumentDemande_IMG.pdf', '2025-05-16', 'attestationRegulariteFiscale_DocumentDemande_IMG.pdf', '2025-07-23', 'attestationURSSAF_DocumentDemande_IMG.pdf', '2025-06-04', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '2025-05-07 15:59:48', '2025-05-07 15:59:48', '0'),
(4, 4, 'kbis_DocumentDemande_IMG.pdf', '2025-05-13', '', '0000-00-00', '', '0000-00-00', 'attestationURSSAF_DocumentDemande_IMG.pdf', '2025-05-12', 'assuranceRcPro_DocumentDemande_IMG.pdf', '2025-05-09', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '2025-05-07 16:01:12', '2025-05-07 16:01:12', '0');

-- --------------------------------------------------------

--
-- Structure de la table `document_entreprise`
--

CREATE TABLE `document_entreprise` (
  `id_DocumentEntreprise` int(5) NOT NULL,
  `idEntreprise_DocumentEntreprise` int(5) NOT NULL,
  `kbis_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeKbis_DocumentEntreprise` date NOT NULL,
  `notifKbis_DocumentEntreprise` enum('0','1') NOT NULL,
  `pieceIdentitieGerant_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditePIGerant_DocumentEntreprise` date NOT NULL,
  `notifPIGerant_DocumentEntreprise` enum('0','1') NOT NULL,
  `attestationRegulariteFiscale_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeAttestRegulariteFiscale_DocumentEntreprise` date NOT NULL,
  `notifAttestRegulariteFiscale_DocumentEntreprise` enum('0','1') NOT NULL,
  `attestationURSSAF_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeAttestURSSAF_DocumentEntreprise` date NOT NULL,
  `notifAttestURSSAF_DocumentEntreprise` enum('0','1') NOT NULL,
  `assuranceRcPro_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeAssuranceRcPro_DocumentEntreprise` date NOT NULL,
  `notifAssuranceRcPro_DocumentEntreprise` enum('0','1') NOT NULL,
  `siret_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeSiret_DocumentEntreprise` date NOT NULL,
  `notifSiret_DocumentEntreprise` enum('0','1') NOT NULL,
  `caisseBTP_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeCaisseBTP_DocumentEntreprise` date NOT NULL,
  `notifCaisseBTP_DocumentEntreprise` enum('0','1') NOT NULL,
  `numeroFiscal_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeNumFiscal_DocumentEntreprise` date NOT NULL,
  `notifNumFiscal_DocumentEntreprise` enum('0','1') NOT NULL,
  `numeroTVA_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeNumTVA_DocumentEntreprise` date NOT NULL,
  `notifNumTVA_DocumentEntreprise` enum('0','1') NOT NULL,
  `assurenceDecennale_DocumentEntreprise` varchar(250) NOT NULL,
  `dateValiditeAssurenceDecennale_DocumentEntreprise` date NOT NULL,
  `notifAssurenceDecennale_DocumentEntreprise` enum('0','1') NOT NULL,
  `date_created_DocumentEntreprise` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_DocumentEntreprise` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_DocumentEntreprise` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `document_entreprise`
--

INSERT INTO `document_entreprise` (`id_DocumentEntreprise`, `idEntreprise_DocumentEntreprise`, `kbis_DocumentEntreprise`, `dateValiditeKbis_DocumentEntreprise`, `notifKbis_DocumentEntreprise`, `pieceIdentitieGerant_DocumentEntreprise`, `dateValiditePIGerant_DocumentEntreprise`, `notifPIGerant_DocumentEntreprise`, `attestationRegulariteFiscale_DocumentEntreprise`, `dateValiditeAttestRegulariteFiscale_DocumentEntreprise`, `notifAttestRegulariteFiscale_DocumentEntreprise`, `attestationURSSAF_DocumentEntreprise`, `dateValiditeAttestURSSAF_DocumentEntreprise`, `notifAttestURSSAF_DocumentEntreprise`, `assuranceRcPro_DocumentEntreprise`, `dateValiditeAssuranceRcPro_DocumentEntreprise`, `notifAssuranceRcPro_DocumentEntreprise`, `siret_DocumentEntreprise`, `dateValiditeSiret_DocumentEntreprise`, `notifSiret_DocumentEntreprise`, `caisseBTP_DocumentEntreprise`, `dateValiditeCaisseBTP_DocumentEntreprise`, `notifCaisseBTP_DocumentEntreprise`, `numeroFiscal_DocumentEntreprise`, `dateValiditeNumFiscal_DocumentEntreprise`, `notifNumFiscal_DocumentEntreprise`, `numeroTVA_DocumentEntreprise`, `dateValiditeNumTVA_DocumentEntreprise`, `notifNumTVA_DocumentEntreprise`, `assurenceDecennale_DocumentEntreprise`, `dateValiditeAssurenceDecennale_DocumentEntreprise`, `notifAssurenceDecennale_DocumentEntreprise`, `date_created_DocumentEntreprise`, `date_updated_DocumentEntreprise`, `etat_DocumentEntreprise`) VALUES
(1, 1, 'kbis_DocumentEntreprise_SITEM.pdf', '2025-05-08', '1', 'pieceIdentitieGerant_DocumentEntreprise_SITEM.pdf', '2025-05-28', '1', 'attestationRegulariteFiscale_DocumentEntreprise_SITEM.pdf', '2025-05-11', '0', 'attestationURSSAF_DocumentEntreprise_SITEM.pdf', '2025-05-27', '0', 'assuranceRcPro_DocumentEntreprise_SITEM.pdf', '2025-06-18', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '2025-05-07 10:59:25', '2025-05-07 16:05:49', '1'),
(2, 2, 'kbis_DocumentEntreprise_IMG.pdf', '2025-05-03', '1', 'pieceIdentitieGerant_DocumentEntreprise_IMG.pdf', '2025-05-08', '1', 'attestationRegulariteFiscale_DocumentEntreprise_IMG.pdf', '2025-07-23', '0', 'attestationURSSAF_DocumentEntreprise_IMG.pdf', '2025-05-16', '1', 'assuranceRcPro_DocumentEntreprise_IMG.pdf', '2025-05-28', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '2025-05-07 15:49:43', '2025-05-09 16:12:52', '1'),
(3, 2, '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', 'assuranceRcPro_DocumentEntreprise_IMG.pdf', '2025-06-06', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '', '0000-00-00', '0', '2025-05-09 15:59:33', '2025-05-09 15:59:33', '1');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_Entreprise` int(5) NOT NULL,
  `nom_Entreprise` varchar(250) NOT NULL,
  `nomGerant_Entreprise` varchar(250) NOT NULL,
  `prenomGerant_Entreprise` varchar(250) NOT NULL,
  `adresse_Entreprise` varchar(250) NOT NULL,
  `pays_Entreprise` varchar(250) NOT NULL,
  `siret_Entreprise` varchar(250) NOT NULL,
  `email_Entreprise` varchar(250) NOT NULL,
  `telephone_Entreprise` varchar(250) NOT NULL,
  `iban_Entreprise` varchar(250) NOT NULL,
  `typesMission_Entreprise` varchar(250) NOT NULL,
  `chefProjet_Entreprise` int(5) NOT NULL,
  `date_created_Entreprise` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Entreprise` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_Entreprise` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_Entreprise`, `nom_Entreprise`, `nomGerant_Entreprise`, `prenomGerant_Entreprise`, `adresse_Entreprise`, `pays_Entreprise`, `siret_Entreprise`, `email_Entreprise`, `telephone_Entreprise`, `iban_Entreprise`, `typesMission_Entreprise`, `chefProjet_Entreprise`, `date_created_Entreprise`, `date_updated_Entreprise`, `etat_Entreprise`) VALUES
(1, 'SITEM', 'Haddad', 'Amine', 'Djerba', 'Tunisien', '0000', 'amine@gmail.com', '12345678', '0000', 'Française', 0, '2025-05-07 10:56:26', '2025-05-07 15:47:48', '1'),
(2, 'IMG', 'Haddad ', 'Maram', 'Djerba', 'Tunisien', '0000', 'maram@gmail.com', '12345678', '0000', 'Européenne', 0, '2025-05-07 15:47:37', '2025-05-09 09:23:41', '1');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_Facture` int(5) NOT NULL,
  `idEntreprise_Facture` int(5) NOT NULL,
  `date_Facture` date NOT NULL,
  `montant_Facture` float NOT NULL,
  `status_Facture` varchar(250) NOT NULL DEFAULT 'En attente de paiement',
  `date_created_Facture` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Facture` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_Facture` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_Facture`, `idEntreprise_Facture`, `date_Facture`, `montant_Facture`, `status_Facture`, `date_created_Facture`, `date_updated_Facture`, `etat_Facture`) VALUES
(1, 1, '2025-05-07', 500, 'Reglée', '2025-05-07 10:39:58', '2025-05-09 15:56:16', '1'),
(2, 1, '2025-05-01', 800, 'En attente de paiement', '2025-05-07 10:45:58', '2025-05-07 10:45:58', '1');

-- --------------------------------------------------------

--
-- Structure de la table `facture_signe`
--

CREATE TABLE `facture_signe` (
  `id_FactureSigne` int(5) NOT NULL,
  `idFacture_FactureSigne` int(5) NOT NULL,
  `clePrive_FactureSigne` varchar(250) NOT NULL,
  `clePublic_FactureSigne` varchar(250) NOT NULL,
  `date_created_FactureSigne` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_FactureSigne` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_FactureSigne` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `facture_signe`
--

INSERT INTO `facture_signe` (`id_FactureSigne`, `idFacture_FactureSigne`, `clePrive_FactureSigne`, `clePublic_FactureSigne`, `date_created_FactureSigne`, `date_updated_FactureSigne`, `etat_FactureSigne`) VALUES
(1, 1, 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDERq8nRjzPFUzMrCJATi1DOSU1pdU3t8rFn1x5+kbCs6H0H9ebS4Z7FS+7zSVmke4LXvGIhTPqp0xtKTdb+PS6qa13xbdTcTdbJLo58YAOJHpxVujoxWX4KxHyeH4TGTl6rtM+gD6bLySEHf+rZHIVqazxyTHjj0jwZlJMaKSbdxtMDBUcl3wrglkzhmJH1mQ7J4tkRT', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxEavJ0Y8zxVMzKwiQE4tQzklNaXVN7fKxZ9cefpGwrOh9B/Xm0uGexUvu80lZpHuC17xiIUz6qdMbSk3W/j0uqmtd8W3U3E3WyS6OfGADiR6cVbo6MVl+CsR8nh+Exk5eq7TPoA+my8khB3/q2RyFams8ckx449I8GZSTGikm3cbTAwVHJd8K4JZM4ZiR9ZkOyeLZEU+QjoJCH', '2025-05-07 10:40:10', '2025-05-07 10:40:10', '1'),
(2, 2, 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCmpHNBy2rnNnyJqLwzbmExQJMKIkPy6BJwyLUT2ldGyJtprkDWQuJaQO+CJQ9EYBvcuVqugE2+xBWV0o6JG+/DKnz1U48g6sIphKWvy6Xy0LmiYGgxduvJMKT3edUPPuTjRBJTwC9koBAlFbMBoQvQIXq2hXDNsVZYDWSDARkMXSwpsWv4i4MC83ryS1NQMZDCXaxcP/', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApqRzQctq5zZ8iai8M25hMUCTCiJD8ugScMi1E9pXRsibaa5A1kLiWkDvgiUPRGAb3LlaroBNvsQVldKOiRvvwyp89VOPIOrCKYSlr8ul8tC5omBoMXbryTCk93nVDz7k40QSU8AvZKAQJRWzAaEL0CF6toVwzbFWWA1kgwEZDF0sKbFr+IuDAvN68ktTUDGQwl2sXD//5dNQzK', '2025-05-09 08:30:44', '2025-05-09 08:30:44', '1');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_Messages` int(5) UNSIGNED NOT NULL,
  `login_emetteur_Messages` varchar(250) NOT NULL,
  `login_recepteur_Messages` varchar(250) NOT NULL,
  `messages_Messages` varchar(1000) NOT NULL,
  `vu_emetteur_Messages` enum('0','1') NOT NULL DEFAULT '1',
  `vu_recepteur_Messages` enum('0','1') NOT NULL DEFAULT '0',
  `date_created_Messages` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Messages` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `etat_Messages` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_Messages`, `login_emetteur_Messages`, `login_recepteur_Messages`, `messages_Messages`, `vu_emetteur_Messages`, `vu_recepteur_Messages`, `date_created_Messages`, `date_updated_Messages`, `etat_Messages`) VALUES
(1, 'amine@gmail.com', 'admin', 'Bonjour !', '1', '1', '2025-05-07 10:54:32', '2025-05-08 09:43:28', '1'),
(2, 'admin', 'amine@gmail.com', 'Salut !', '1', '1', '2025-05-07 10:56:59', '2025-05-08 09:46:45', '1'),
(3, 'amine@gmail.com', 'admin', 'Vous-avez des documents qui arrive en fin de validité .', '1', '1', '2025-05-07 15:19:15', '2025-05-08 09:43:28', '1'),
(4, 'admin', 'amine@gmail.com', 'Ok', '1', '1', '2025-05-08 16:27:32', '2025-05-09 14:40:07', '1'),
(5, 'admin', 'amine@gmail.com', '??', '1', '1', '2025-05-09 08:35:32', '2025-05-09 14:40:07', '1'),
(6, 'admin', 'maram@gmail.com', 'Bonjour !', '1', '1', '2025-05-09 10:09:52', '2025-05-09 14:38:01', '1');

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `id_Mission` int(5) NOT NULL,
  `libelle_Mission` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nationalite`
--

CREATE TABLE `nationalite` (
  `id_Nationalite` int(11) NOT NULL,
  `libelle_Nationalite` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nationalite`
--

INSERT INTO `nationalite` (`id_Nationalite`, `libelle_Nationalite`) VALUES
(1, 'Afghan'),
(2, 'Albanais'),
(3, 'Algérien'),
(4, 'Américain'),
(5, 'Andorran'),
(6, 'Angolais'),
(7, 'Antiguans'),
(8, 'Argentin'),
(9, 'Arménien'),
(10, 'Australien'),
(11, 'Autrichien'),
(12, 'Azerbaïdjanais'),
(13, 'Bahaméen'),
(14, 'Bahreïnien'),
(15, 'Bangladais'),
(16, 'Barbadien'),
(17, 'Biélorusse'),
(18, 'Belge'),
(19, 'Bélizéen'),
(20, 'Béninois'),
(21, 'Bhoutanais'),
(22, 'Bolivien'),
(23, 'Bosnien'),
(24, 'Brésilien'),
(25, 'Britannique'),
(26, 'Brunéien'),
(27, 'Bulgare'),
(28, 'Burkinabé'),
(29, 'Birmane'),
(30, 'Burundais'),
(31, 'Cambodgien'),
(32, 'Camerounais'),
(33, 'Canadien'),
(34, 'Cap-verdien'),
(35, 'Centrafricain'),
(36, 'Tchadien'),
(37, 'Chilien'),
(38, 'Chinois'),
(39, 'Colombien'),
(40, 'Comorien'),
(41, 'Congolais'),
(42, 'Costaricain'),
(43, 'Croate'),
(44, 'Cuban'),
(45, 'Chypriote'),
(46, 'Tchèque'),
(47, 'Danois'),
(48, 'Djiboutien'),
(49, 'Dominicain'),
(50, 'République dominicaine'),
(51, 'Néerlandais'),
(52, 'Timorais'),
(53, 'Équatorien'),
(54, 'Égyptien'),
(55, 'Émirati'),
(56, 'Guinéen Équatorial'),
(57, 'Érythréen'),
(58, 'Estonien'),
(59, 'Éthiopien'),
(60, 'Fidjien'),
(61, 'Philippin'),
(62, 'Finlandais'),
(63, 'Français'),
(64, 'Gabonais'),
(65, 'Gambien'),
(66, 'Géorgien'),
(67, 'Allemand'),
(68, 'Ghanéen'),
(69, 'Grec'),
(70, 'Grenadien'),
(71, 'Guatémaltèque'),
(72, 'Guinéen'),
(73, 'Guinéen-Bissau'),
(74, 'Guyanais'),
(75, 'Haïtien'),
(76, 'Hondurien'),
(77, 'Hongrois'),
(78, 'Islandais'),
(79, 'Indien'),
(80, 'Indonésien'),
(81, 'Iranien'),
(82, 'Irakien'),
(83, 'Irlandais'),
(84, 'Israélien'),
(85, 'Italien'),
(86, 'Ivoirien'),
(87, 'Jamaïcain'),
(88, 'Japonais'),
(89, 'Jordanien'),
(90, 'Kazakhstanais'),
(91, 'Kényan'),
(92, 'Kittitien et Névisien'),
(93, 'Kosovar'),
(94, 'Koweïtien'),
(95, 'Kyrgyzstanais'),
(96, 'Laotien'),
(97, 'Letton'),
(98, 'Libanais'),
(99, 'Libérien'),
(100, 'Libyen'),
(101, 'Liechtensteinois'),
(102, 'Lituanien'),
(103, 'Luxembourgeois'),
(104, 'Macédonien'),
(105, 'Malgache'),
(106, 'Malawien'),
(107, 'Malaisien'),
(108, 'Maldivien'),
(109, 'Malien'),
(110, 'Maltais'),
(111, 'Marshallais'),
(112, 'Mauritanien'),
(113, 'Mauricien'),
(114, 'Mexicain'),
(115, 'Micronésien'),
(116, 'Moldave'),
(117, 'Monégasque'),
(118, 'Mongol'),
(119, 'Marocain'),
(120, 'Mozambicain'),
(121, 'Namibien'),
(122, 'Nauruans'),
(123, 'Népalais'),
(124, 'Néo-Zélandais'),
(125, 'Nicaraguayen'),
(126, 'Nigérian'),
(127, 'Nigerien'),
(128, 'Coréen du Nord'),
(129, 'Iles Mariannes du Nord'),
(130, 'Norvégien'),
(131, 'Omanais'),
(132, 'Pakistanais'),
(133, 'Paluan'),
(134, 'Panaméen'),
(135, 'Papouan-néo-guinéen'),
(136, 'Paraguayen'),
(137, 'Péruvien'),
(138, 'Philippin'),
(139, 'Polonais'),
(140, 'Portugais'),
(141, 'Qatarien'),
(142, 'Roumain'),
(143, 'Russe'),
(144, 'Rwandais'),
(145, 'Saint-Kitts et Nevis'),
(146, 'Saint-Lucien'),
(147, 'Saint-Vincentais et Grenadins'),
(148, 'Samoan'),
(149, 'Saint-Marinais'),
(150, 'Sao Tomeen'),
(151, 'Saoudien'),
(152, 'Écossais'),
(153, 'Sénégalais'),
(154, 'Serbe'),
(155, 'Seychellois'),
(156, 'Sierra-Léonais'),
(157, 'Singapourien'),
(158, 'Slovaque'),
(159, 'Slovène'),
(160, 'Solomon Islander'),
(161, 'Somalien'),
(162, 'Sud-Africain'),
(163, 'Coréen du Sud'),
(164, 'Espagnol'),
(165, 'Sri-Lankais'),
(166, 'Soudanais'),
(167, 'Surinamien'),
(168, 'Swazi'),
(169, 'Suédois'),
(170, 'Suisse'),
(171, 'Syrien'),
(172, 'Taïwanais'),
(173, 'Tadjikistanien'),
(174, 'Tanzanien'),
(175, 'Thaïlandais'),
(176, 'Togolais'),
(177, 'Tongan'),
(178, 'Trinidadien'),
(179, 'Tunisien'),
(180, 'Turc'),
(181, 'Turkmène'),
(182, 'Tuvaluan'),
(183, 'Ougandais'),
(184, 'Ukrainien'),
(185, 'Uruguayen'),
(186, 'Ouzbek'),
(187, 'Vanuatuan'),
(188, 'Vatican'),
(189, 'Vénézuélien'),
(190, 'Vietnamien'),
(191, 'Yéménite'),
(192, 'Zambien'),
(193, 'Zimbabwéen');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_Notification` int(5) NOT NULL,
  `idEntreprise_Notification` int(5) NOT NULL,
  `type_Notification` varchar(250) NOT NULL,
  `message_Notification` varchar(250) NOT NULL,
  `date_created_Notification` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Notification` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_Notification` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id_Notification`, `idEntreprise_Notification`, `type_Notification`, `message_Notification`, `date_created_Notification`, `date_updated_Notification`, `etat_Notification`) VALUES
(1, 0, 'Ajout salarie', 'SITEM a ajouter un nouveau salarie : Haddad Ahmed .', '2025-05-07 11:30:25', '2025-05-07 10:30:25', '0'),
(2, 0, 'Neveaulle Demande', 'Vous avez une nouvelle demande de SITEM .', '2025-05-07 11:31:36', '2025-05-07 10:31:36', '0'),
(3, 1, 'Etat Demande', 'Votre demande a été accepter .', '2025-05-07 11:37:49', '2025-05-07 10:37:49', '0'),
(4, 0, 'Neveaulle Demande', 'Vous avez une nouvelle demande de SITEM .', '2025-05-07 15:58:14', '2025-05-07 14:58:14', '0'),
(5, 0, 'Neveaulle Demande', 'Vous avez une nouvelle demande de IMG .', '2025-05-07 15:59:48', '2025-05-09 11:08:24', '1'),
(6, 0, 'Neveaulle Demande', 'Vous avez une nouvelle demande de IMG .', '2025-05-07 16:01:12', '2025-05-09 09:34:50', '1'),
(7, 1, 'Etat Demande', 'Votre demande a été refuser .', '2025-05-07 16:12:10', '2025-05-07 15:12:10', '0'),
(8, 1, 'Etat Demande', 'Votre demande a été accepter .', '2025-05-07 16:12:21', '2025-05-07 15:12:21', '0'),
(9, 2, 'Etat Demande', 'Votre demande a été refuser .', '2025-05-09 09:29:09', '2025-05-09 08:29:09', '0'),
(10, 0, 'Modification information salarie', 'SITEM a modifier les informations du Haddad Ahmed .', '2025-05-09 15:43:00', '2025-05-09 14:43:00', '0');

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `id_Reglement` int(5) NOT NULL,
  `idFacture_Reglement` int(5) NOT NULL,
  `pieceJointe_Reglement` varchar(250) NOT NULL,
  `montant_Reglement` float NOT NULL,
  `date_created_Reglement` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Reglement` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_Reglement` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reglement`
--

INSERT INTO `reglement` (`id_Reglement`, `idFacture_Reglement`, `pieceJointe_Reglement`, `montant_Reglement`, `date_created_Reglement`, `date_updated_Reglement`, `etat_Reglement`) VALUES
(1, 1, 'PieceJointe_Reglement_1.pdf', 500, '2025-05-07 10:45:37', '2025-05-07 10:45:37', '1');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_Role` int(5) NOT NULL,
  `libelle_Role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_Role`, `libelle_Role`) VALUES
(1, 'administrateur'),
(2, 'sous-traitant');

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

CREATE TABLE `salarie` (
  `id_Salarie` int(5) NOT NULL,
  `idEntreprise_Salarie` int(5) NOT NULL,
  `nom_Salarie` varchar(250) NOT NULL,
  `prenom_Salarie` varchar(250) NOT NULL,
  `dateNaissance_Salarie` varchar(250) NOT NULL,
  `nationalite_Salarie` varchar(250) NOT NULL,
  `poste_Salarie` varchar(250) NOT NULL,
  `typeMission_Salarie` varchar(250) NOT NULL,
  `pieceIdentite_Salarie` varchar(250) NOT NULL,
  `dpae_Salarie` varchar(250) NOT NULL,
  `permit_Salarie` varchar(250) NOT NULL,
  `certificatA1_Salarie` varchar(250) NOT NULL,
  `certificatZoll_Salarie` varchar(250) NOT NULL,
  `photo_Salarie` varchar(250) NOT NULL,
  `date_created_Salarie` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Salarie` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_Salarie` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salarie`
--

INSERT INTO `salarie` (`id_Salarie`, `idEntreprise_Salarie`, `nom_Salarie`, `prenom_Salarie`, `dateNaissance_Salarie`, `nationalite_Salarie`, `poste_Salarie`, `typeMission_Salarie`, `pieceIdentite_Salarie`, `dpae_Salarie`, `permit_Salarie`, `certificatA1_Salarie`, `certificatZoll_Salarie`, `photo_Salarie`, `date_created_Salarie`, `date_updated_Salarie`, `etat_Salarie`) VALUES
(1, 0, 'Hazzar', 'Nawres', '2000-06-20', 'Tunisien', 'Chef', 'Française', 'pieceIdentite_Hazzar_Nawres.pdf', 'DPAE_Hazzar_Nawres.pdf', 'Permis_Hazzar_Nawres.pdf', 'CertificatA1_Hazzar_Nawres.pdf', 'CertificatZoll_Hazzar_Nawres.pdf', 'photo_Hazzar_Nawres.png', '2025-05-07 10:40:26', '2025-05-07 17:10:00', '1'),
(2, 0, 'Hazzar', 'Nermine', '2000-01-21', 'Tunisien', 'Chef', 'Française', 'pieceIdentite_Hazzar_Nermine.pdf', 'DPAE_Hazzar_Nermine.pdf', 'Permis_Hazzar_Nermine.pdf', 'CertificatA1_Hazzar_Nermine.pdf', 'CertificatZoll_Hazzar_Nermine.pdf', 'photo_Hazzar_Nermine.png', '2025-05-07 10:44:47', '2025-05-07 17:10:00', '1'),
(3, 1, 'Haddad', 'Ahmed', '2000-10-20', 'Tunisien', 'Chef', 'Européenne', 'pieceIdentite_Haddad_Ahmed.pdf', 'DPAE_Haddad_Ahmed.pdf', 'Permis_Haddad_Ahmed.pdf', 'CertificatA1_Haddad_Ahmed.pdf', 'CertificatZoll_Haddad_Ahmed.pdf', 'Photo_Haddad_Ahmed.png', '2025-05-07 11:30:25', '2025-05-09 15:43:00', '1'),
(4, 0, 'Haddad', 'Amine', '2000-04-05', 'Tunisien', 'Chef', 'Européenne', 'pieceIdentite_Haddad_Amine.pdf', 'DPAE_Haddad_Amine.pdf', 'Permis_Haddad_Amine.pdf', 'CertificatA1_Haddad_Amine.pdf', 'CertificatZoll_Haddad_Amine.pdf', 'Photo_Haddad_Amine.png', '2025-05-07 15:52:23', '2025-05-09 15:55:59', '1');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_Utilisateur` int(5) NOT NULL,
  `login_Utilisateur` varchar(250) NOT NULL,
  `mdp_Utilisateur` varchar(250) NOT NULL,
  `nom_Utilisateur` varchar(250) NOT NULL,
  `prenom_Utilisateur` varchar(250) NOT NULL,
  `email_Utilisateur` varchar(250) NOT NULL,
  `telephone_Utilisateur` int(8) NOT NULL,
  `adresse_Utilisateur` varchar(250) NOT NULL,
  `image_Utilisateur` varchar(250) NOT NULL DEFAULT 'default.jpg',
  `role_Utilisateur` varchar(250) NOT NULL,
  `date_created_Utilisateur` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_Utilisateur` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat_Utilisateur` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_Utilisateur`, `login_Utilisateur`, `mdp_Utilisateur`, `nom_Utilisateur`, `prenom_Utilisateur`, `email_Utilisateur`, `telephone_Utilisateur`, `adresse_Utilisateur`, `image_Utilisateur`, `role_Utilisateur`, `date_created_Utilisateur`, `date_updated_Utilisateur`, `etat_Utilisateur`) VALUES
(1, 'admin', 'd41d8cd98f00b204e9800998ecf8427e', 'Hazzar', 'Nessrine', 'nessrine@gmail.com', 12345678, 'Djerba', 'User_1.jpeg', '1', '2025-05-07 09:34:20', '2025-05-09 15:49:59', '1'),
(2, 'amine@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', 'Haddad', 'Amine', 'amine@gmail.com', 12345678, 'Djerba', 'User_1.png', '2', '2025-05-07 10:56:26', '2025-05-07 09:56:26', '1'),
(3, 'maram@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', 'Haddad ', 'Maram', 'maram@gmail.com', 12345678, 'Djerba', 'default.jpg', '2', '2025-05-07 15:47:37', '2025-05-07 14:47:37', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_Contact`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_Demande`);

--
-- Index pour la table `document_demande`
--
ALTER TABLE `document_demande`
  ADD PRIMARY KEY (`id_DocumentDemande`);

--
-- Index pour la table `document_entreprise`
--
ALTER TABLE `document_entreprise`
  ADD PRIMARY KEY (`id_DocumentEntreprise`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_Entreprise`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_Facture`);

--
-- Index pour la table `facture_signe`
--
ALTER TABLE `facture_signe`
  ADD PRIMARY KEY (`id_FactureSigne`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_Messages`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id_Mission`);

--
-- Index pour la table `nationalite`
--
ALTER TABLE `nationalite`
  ADD PRIMARY KEY (`id_Nationalite`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_Notification`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`id_Reglement`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_Role`);

--
-- Index pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD PRIMARY KEY (`id_Salarie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_Utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_Contact` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_Demande` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `document_demande`
--
ALTER TABLE `document_demande`
  MODIFY `id_DocumentDemande` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `document_entreprise`
--
ALTER TABLE `document_entreprise`
  MODIFY `id_DocumentEntreprise` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_Entreprise` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_Facture` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `facture_signe`
--
ALTER TABLE `facture_signe`
  MODIFY `id_FactureSigne` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_Messages` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id_Mission` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `nationalite`
--
ALTER TABLE `nationalite`
  MODIFY `id_Nationalite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_Notification` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `id_Reglement` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_Role` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `id_Salarie` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_Utilisateur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
