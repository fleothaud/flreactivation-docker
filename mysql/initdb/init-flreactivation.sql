USE flreactivation;

CREATE TABLE `flr_cartes` (
  `id` int(11) NOT NULL,
  `id_data` int(11) NOT NULL,
  `mise_en_ligne` int(11) DEFAULT NULL,
  `afficher_reponse` int(11) NOT NULL DEFAULT 0,
  `nom_classe` varchar(30) NOT NULL,
  `date_reac` int(11) DEFAULT NULL,
  `nb_reac` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `flr_classes`
--

CREATE TABLE `flr_classes` (
  `id` int(11) NOT NULL,
  `nom_classe` varchar(30) NOT NULL,
  `nom_niveau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `flr_data`
--

CREATE TABLE `flr_data` (
  `id` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `reponse` longtext NOT NULL,
  `nom_discipline` varchar(30) NOT NULL,
  `nom_niveau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `flr_disciplines`
--

CREATE TABLE `flr_disciplines` (
  `id` int(11) NOT NULL,
  `nom_discipline` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `flr_niveaux`
--

CREATE TABLE `flr_niveaux` (
  `id` int(11) NOT NULL,
  `nom_niveau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `flr_parametres_reactivations`
--

CREATE TABLE `flr_parametres_reactivations` (
  `id` int(11) NOT NULL,
  `num_reac` int(11) NOT NULL,
  `duree_reac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `flr_parametres_reactivations`
--

INSERT INTO `flr_parametres_reactivations` (`id`, `num_reac`, `duree_reac`) VALUES
(1, 1, 1),
(2, 2, 7),
(3, 3, 21),
(4, 4, 60);

-- --------------------------------------------------------

--
-- Structure de la table `flr_reactivations`
--

CREATE TABLE `flr_reactivations` (
  `id` int(11) NOT NULL,
  `id_carte` int(11) NOT NULL,
  `nb_reac` int(11) NOT NULL,
  `date_reac` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `flr_users`
--

CREATE TABLE `flr_users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `statut` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `flr_users`
--

INSERT INTO `flr_users` (`id`, `login`, `password`, `statut`) VALUES
(1, 'admin', 'admin', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `flr_cartes`
--
ALTER TABLE `flr_cartes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flr_classes`
--
ALTER TABLE `flr_classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flr_data`
--
ALTER TABLE `flr_data`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flr_disciplines`
--
ALTER TABLE `flr_disciplines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flr_niveaux`
--
ALTER TABLE `flr_niveaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flr_parametres_reactivations`
--
ALTER TABLE `flr_parametres_reactivations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flr_reactivations`
--
ALTER TABLE `flr_reactivations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flr_users`
--
ALTER TABLE `flr_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `flr_cartes`
--
ALTER TABLE `flr_cartes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flr_classes`
--
ALTER TABLE `flr_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flr_data`
--
ALTER TABLE `flr_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flr_disciplines`
--
ALTER TABLE `flr_disciplines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flr_niveaux`
--
ALTER TABLE `flr_niveaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flr_parametres_reactivations`
--
ALTER TABLE `flr_parametres_reactivations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `flr_reactivations`
--
ALTER TABLE `flr_reactivations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flr_users`
--
ALTER TABLE `flr_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
