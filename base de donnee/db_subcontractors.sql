-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 09 mai 2025 à 18:49
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

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_Role` int(5) NOT NULL,
  `libelle_Role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'admin', 'd41d8cd98f00b204e9800998ecf8427e', 'Hazzar', 'Nessrine', 'nessrine@gmail.com', 12345678, 'Djerba', 'User_1.jpeg', '1', '2025-05-07 09:34:20', '2025-05-09 15:49:59', '1');

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
  MODIFY `id_Contact` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_Demande` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `document_demande`
--
ALTER TABLE `document_demande`
  MODIFY `id_DocumentDemande` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `document_entreprise`
--
ALTER TABLE `document_entreprise`
  MODIFY `id_DocumentEntreprise` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_Entreprise` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_Facture` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facture_signe`
--
ALTER TABLE `facture_signe`
  MODIFY `id_FactureSigne` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_Messages` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id_Mission` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `nationalite`
--
ALTER TABLE `nationalite`
  MODIFY `id_Nationalite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_Notification` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `id_Reglement` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_Role` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `id_Salarie` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_Utilisateur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

