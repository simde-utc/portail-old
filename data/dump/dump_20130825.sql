SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET foreign_key_checks = 0;

INSERT INTO `asso` (`id`, `name`, `login`, `pole_id`, `type_id`, `description`, `logo`, `active`, `passation`, `salle`, `phone`, `facebook`, `summary`, `created_at`, `updated_at`, `joignable`) VALUES
(1, 'BDE-UTC', 'bde', NULL, 3, 'Le bureau des étudiants de l''UTC (BDE-UTC) est une association 1901 qui a pour objet l''animation et la structuration de la vie étudiante de l''UTC de manière saine, responsable et constructive.\r\n\r\nDans ce cadre le BDE-UTC administre la Maison des Étudiants (MDE), partie du bâtiment C du centre Benjamin Franklin, dans le cadre de la Convention d''Occupation de la MDE signée chaque année avec l''UTC. Depuis début septembre, le BDE et ses commissions s''attache à supprimer les nuisances sonores aux abords des bâtiments.', '', 1, 0, 'C118', '03 44 23 43 71', 'https://www.facebook.com/pages/BDE-UTC/190043221063147', 'Bureau Des Etudiants de l''UTC', '2011-05-14 11:32:40', '2012-05-14 00:37:24', 1),
(2, 'SiMDE', 'simde', 1, 1, 'Le SiMDE est chargé de la mise en place :\r\n<ul>\r\n<li>des ressource informatiques au sein de la MDE</li>\r\n<li>du serveur des associations Phoenix, hébergeant mails, sites web, fichiers...</li>\r\n<li>de la gestion du site assos.utc.fr</li>', '', 1, 0, '', '', '', 'Le Service informatique de la Maison des Étudiants', '2011-05-14 11:06:17', '2012-05-14 02:11:03', 1),
(3, 'Pôle Artistique et Évènementiel', 'poleae', NULL, 3, 'Tout savoir sur l''art et la culture à l''UTC, c''est ici que ca se passe !\r\nLe PAE est fier d''être impliqué dans l''UTCéenne, les Estus, le Festival Numéo, les concerts de Strava, Larsen, Ocata... Ils sont trop pour un simple paragraphe ! \r\nTrésorerie, administratif, communication, le PAE aide les assos dans leur gestion pour voir leur projet aboutir.', '', 1, 0, '', '', 'Pôle Artistique Evènementiel', '', '2011-05-14 11:10:48', '2012-10-03 20:19:05', 1),
(4, 'Pôle Solidarité et Citoyenneté', 'polesec', NULL, 3, 'Le Pôle Solidarité et Citoyenneté est là pour soutenir, accompagner et coordonner les associations à caractère solidaire ou citoyenne de l''UTC. Il est composé des membres des assos solidaires et citoyennes de la fédération BDE-UTC.\r\n\r\nLe pôle est la personne à contacter si tu as envie de t''investir dans la solidarité internationale, le développement durable, la défense des droits de l''homme, le combat contre les discriminations de toutes sortes, mais que tu ne sais pas quelle asso rejoindre. De même, si tu apportes ton propre projet associatif, n''hésite pas à nous contacter pour le lancer dans de bonnes conditions.', '', 0, 0, '', '0344234376', '', '', '2011-05-14 11:15:35', '2012-10-03 16:38:01', 1),
(5, 'Pôle Technologie et Entreprenariat', 'polete', NULL, 3, '\r\nLe PTE est l''un des quatre pôles associatifs de l''utc dont leur but de rassembler les associations par thématique, promouvoir la coopération inter-assos et aider chaque asso dans leurs projets. Cela passe notamment par la communication entre elles et le Bureau Des Elèves (BDE).\r\nNotre objectif est bien-sûr de soutenir, maintenir et surtout de développer la vie associative, en rapport avec le thème des technologies et de l''entreprenariat. Pour se faire, nous avons la charge de la répartition des subventations accodées par le BDE, l''écoute des attentes des assos, la communication de leurs activités, le support logistique... Et cela passe par exemple, par l''organisation d''une semaine des pôles, la proposition d''un local atelier, la représentation des associations lors de grands évenement utcéens.\r\nHormis cette activité de soutien, le PTE organisera des conférences conviviales, autour des thèmes soutenus par le pôle (la technologie, le monde professonnel, l''innovation), qui seront proposées directement à destination des élèves-ingénieurs de l''UTC, toutes branches confondues.\r\nSi vous êtes désireux d''apporter votre aide, des idées, au pôle ou à ses associations, ou encore si vous êtes porteur d''un projet associatif s''inscrivant dans notre thématique, n''hésitez pas à nous contacter.', '', 0, 0, '', '', 'http://www.facebook.com/pages/P%C3%B4le-Technologie-et-Entreprenariat/155716334569673?ref=ts&fref=ts', 'Le Pôle Technologie et Entrepreneuriat est chargé de la fédération d''une partie des associations de l''UTC.', '2011-05-14 11:17:11', '2012-11-18 16:11:56', 1),
(6, 'Pôle Vie du Campus', 'polevdc', NULL, 3, 'Le PVDC c''est de la diversité, c''est des assos de service en folie, et un bureau uni pour que tout ça fonctionne bien !!\r\nChaque membre du bureau est référent de plusieurs assos pour les aider, les soutenir et communiquer tout ce qu''il faut.\r\nLe pôle regroupe différents types d''asso: jeux, divertissements, activités culturelles, services en folie, promotion de la vie étudiante ...\r\nEn début de semestre, les référents aident les assos à se lancer et les suivent tout au long du semestre.\r\nBien sûr; si tu veux créer une nouvelle asso qui rejoint l''un de ces thèmes, contacte ton pôle qui répondra à toutes tes questions !\r\nPetit à petit, le pôle va lancer des projets inter-asso.', '', 1, 0, '', '', '', 'Le pôle des assos qui rendent plein de services à ta vie étudiante !', '2011-05-14 11:29:47', '2012-10-22 21:14:19', 1),
(7, 'USEC', 'usec', 4, 3, 'Envie de toucher du doigt le monde de l''Entreprise? \r\nRejoins l''équipe de l''USEC, Junior-Entreprise de l''UTC! \r\n\r\nProche du fonctionnement les entreprises de conseil, nous mettons à disposition de clients industriels, du secteur tertiaire et particuliers, les compétences et connaissances acquises durant notre cycle ingénieur à l''UTC. Et bien sûr, chaque étudiant qui travaille pour l''USEC est rémunéré!\r\n\r\nL''USEC sera ton lien privilégié avec les entreprises durant tes années à l''UTC!\r\n\r\nViens nous voir en FE300!!', '', 1, 0, '', '', 'https://www.facebook.com/usec.utc.1', '', '2011-05-14 11:33:41', '2012-10-17 13:50:56', 1),
(8, 'Polar', 'polar', 5, 3, 'Besoin d''imprimer un rapport, un poster de soutenance ?\r\nLe Polar est là pour toi : géré par des étudiants, pour les étudiants, nous vendons au meilleur prix des impressions, du matériel informatique, des fournitures de bureau...\r\nMais Le Polar c''est aussi la location des manuels de langue au semestre, la vente d''annales pour les UVs, la location de vidéo-projecteur.\r\nEt de nombreux services pour les assos : tarifs réduits sur les impressions, location gratuite de vidéoprojecteur, facturation au semestre, gestion de billetterie et plus si besoin.\r\n\r\nParticiper au Polar c''est assurer deux heures de permanence par semaine, pendant lesquelles tu aidera les étudiants pour leurs impressions et gérera la caisse. Et surtout tu rencontrera de nombreux étudiants.', '', 1, 0, 'E008', '0344234373', '', 'Tout (ou presque) est au Polar !', '2011-05-14 11:35:22', '2012-11-06 11:50:35', 1),
(9, 'Comet', 'comet', 2, 1, 'Organisation des soirées Étudiantes (Estu), location de matériel de son et lumières à bas prix.', '', 1, 0, '', '', '', '', '2011-05-14 11:37:01', '2012-05-13 22:50:08', 1),
(10, 'UVweb', 'uvweb', NULL, 3, 'Hit-Parade des UV UTCéennes', NULL, 0, 0, '', '', '', '', '2012-04-03 01:21:26', '2012-05-14 02:14:40', 1),
(11, 'SkiUTC', 'skiutc', 5, 2, 'Créé en 1989 par des étudiants passionnés de montagne, SkiUTC a pour but de \r\nrassembler, lors d’une semaine au mois de Janvier, le plus grand nombre d’étudiants de l’UTC pour un voyage hors du commun au ski.\r\nIl s’agit d’un évènement qui promeut la cohésion et l’esprit d’équipe au sein des \r\nétudiants, qui propose des animations sportives et festives tout cela à des tarifs accessibles.\r\n\r\nSkiUTC permet égallement à des étudiants qui n''en aurait pas l''occasion faute de moyen financier (ou habitant dans des pays sans neige) de pouvoir partir au ski. Pour certain SkiUTC est l''occasion de découvrir le ski.', '', 0, 0, '', '', 'https://www.facebook.com/pages/SkiUTC/265089426858018', 'Vive le ski !', '2012-04-03 01:21:26', '2012-10-19 09:55:38', 1),
(12, 'UTCoupe', 'utcoupe', 4, 2, 'Tu jouais aux Lego Minstorms, Mécanos ou autre quand tu étais petit ? \r\nTu es fan de I-Robot ou de Terminator ? \r\nUTCoupe est l''association étudiante de l''Université de Technologie de Compiègne qui participe à la Coupe de France de Robotique. Chaque année, nous devons concevoir de A à Z un robot autonome capable de nous propulser toujours plus haut dans le classement de la Coupe !\r\n\r\nSi tu es passionné par la robotique, cette association est faite pour toi ! Informatique, électronique ou mécanique, toute connaissance est bonne à prendre, et à apprendre... ', '', 0, 0, 'TN04', '', '', 'UTCoupe est l''association étudiante de l''Université de Technologie de Compiègne qui participe à la Coupe de France de Robotique.', '2012-04-03 01:21:26', '2012-10-20 12:33:24', 1);

INSERT INTO `branche` (`id`, `name`) VALUES
(1, 'TC'),
(2, 'GI'),
(3, 'GB'),
(4, 'GP'),
(5, 'GM'),
(6, 'GSM'),
(7, 'GSU');

INSERT INTO `event_type` (`id`, `name`) VALUES
(1, 'Réunion'),
(2, 'Perm au pic');

INSERT INTO `filiere` (`id`, `name`) VALUES
(1, 'TC05'),
(2, 'Zotres');

INSERT INTO `pole` (`id`, `asso_id`, `couleur`) VALUES
(1, 1, '#77787b'),
(2, 3, '#f47937'),
(3, 4, '#8dc63f'),
(4, 5, '#00aeef'),
(5, 6, '#ffd520');

INSERT INTO `role` (`id`, `name`, `sort`, `bureau`, `droits`) VALUES
(1, 'Président', 1, 1, 319),
(2, 'Bureau', 2, 1, 271),
(3, 'Membre', 3, 0, 0),
(4, 'Info', 4, 0, 0);

INSERT INTO `semestre` (`id`, `name`) VALUES
(1, 'A11'),
(2, 'P12'),
(3, 'A12'),
(4, 'P13'),
(5, 'A13');

INSERT INTO `type_asso` (`id`, `name`) VALUES
(1, 'Commission/Projet BDE'),
(2, 'Projet'),
(3, 'Associations 1901'),
(4, 'Club');

INSERT INTO `sf_guard_user` (`id`, `first_name`, `last_name`, `email_address`, `username`, `algorithm`, `salt`, `password`, `is_active`, `is_super_admin`, `last_login`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'kenlerem@etu.utc.fr', 'kenlerem', 'sha1', NULL, NULL, 1, 0, NULL, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(2, NULL, NULL, 'puyouart@etu.utc.fr', 'puyouart', 'sha1', NULL, NULL, 1, 0, NULL, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(3, NULL, NULL, 'mguffroy@etu.utc.fr', 'mguffroy', 'sha1', NULL, NULL, 1, 0, NULL, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(4, NULL, NULL, 'ytournad@etu.utc.fr', 'ytournad', 'sha1', NULL, NULL, 1, 1, NULL, '2012-04-21 12:00:00', '2012-04-21 12:00:00');
UPDATE `sf_guard_user` SET `is_active`= 0;

INSERT INTO `asso_member` (`id`, `user_id`, `asso_id`, `role_id`, `semestre_id`, `created_at`, `updated_at`) VALUES
(1, 3, 11, 1, 2, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(2, 2, 8, 1, 2, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(3, 2, 12, 1, 2, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(4, 1, 2, 2, 2, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(5, 2, 2, 2, 2, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(6, 3, 2, 1, 2, '2012-04-21 12:00:00', '2012-04-21 12:00:00');

INSERT INTO `profile` (`id`, `user_id`, `domain`, `nickname`, `birthday`, `sexe`, `mobile`, `home_place`, `family_place`, `branche_id`, `filiere_id`, `semestre`, `other_email`, `photo`, `weekmail`, `autorisation_photo`, `created_at`, `updated_at`) VALUES
(NULL, 1, 'utc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(NULL, 2, 'utc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-04-21 12:00:00', '2012-04-21 12:00:00'),
(NULL, 3, 'utc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-04-21 12:00:00', '2012-04-21 12:00:00');

INSERT INTO `sf_guard_permission` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'chartes_valider', 'Validation des chartes informatique.', '2012-10-25 11:29:43', '2012-10-25 11:39:33'),
(2, 'cotisants_tout', 'Accès en lecture/écriture à l''outil cotisant', '2012-10-25 11:30:00', '2012-10-25 11:39:41'),
(3, 'chartes_voir', 'Voir la liste des chartes informatiques.', '2012-10-25 11:38:22', '2012-10-25 11:38:22');

INSERT INTO `sf_guard_group` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'BDE', 'Accès à l''appli BDE (gestion des cotisants et liste des chartes) et validation des chartes dans le site.', '2012-10-25 11:27:53', '2012-10-25 11:27:53'),
(2, 'SiMDE', 'Validation des chartes', '2012-11-01 11:06:52', '2012-11-01 11:06:52');

INSERT INTO `sf_guard_group_permission` (`group_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2012-10-25 11:29:43', '2012-10-25 11:29:43'),
(1, 2, '2012-10-25 11:30:00', '2012-10-25 11:30:00'),
(1, 3, '2012-10-25 11:41:21', '2012-10-25 11:41:21'),
(2, 1, '2012-11-01 11:06:52', '2012-11-01 11:06:52');

INSERT INTO `document_type` (`id`, `nom`, `slug`, `detail`) VALUES
(1, 'Facture', 'factures', 'Il faut toujours avoir la facture !'),
(2, 'Note de frais', 'note_de_frais', 'Justificatif à signer par les deux parties'),
(3, 'Budget', 'budgets', 'Export du budget prévisionnel'),
(4, 'Transactions', 'transactions', 'Export du journal des transactions'),
(5, 'Devis', 'devis', 'Avant la facture');
INSERT INTO `transaction_moyen` (`id`, `nom`, `detail`) VALUES
(1, 'Chèque', 'Préciser le numéro de chèque'),
(2, 'CB', ''),
(3, 'Virement', ''),
(4, 'Espèces', 'À éviter autant que possible'),
(5, 'Payutc', 'Uniquement possible sur les comptes payutc.'),
(6, 'Membre', 'À utiliser si un membre a payé, afin de pouvoir faire une note de frais plus tard');

INSERT INTO `info_job_abonnement_categorie` (`id`, `categorie_id`, `user_id`) VALUES
(1, 2, 4),
(2, 4, 4);

INSERT INTO `info_job_abonnement_disponibilite` (`id`, `disponibilite_id`, `user_id`) VALUES
(1, 1, 4),
(2, 2, 4);

INSERT INTO `info_job_categorie` (`id`, `name`) VALUES
(1, 'Soutien scolaire'),
(2, 'Aide à domicile'),
(3, 'Restauration'),
(4, 'Manutention'),
(5, 'Divers'),
(6, 'Standardiste');

INSERT INTO `info_job_disponibilite` (`id`, `name`) VALUES
(1, 'Semaine'),
(2, 'Week-end'),
(3, 'Soirs'),
(4, 'Vacances');

INSERT INTO `info_job_offre` (`id`, `categorie_id`, `user_id`, `titre`, `texte`, `lieu`, `remuneration`, `email`, `telephone`, `expiration_date`, `archivage_date`, `created_at`, `updated_at`, `emailkey`, `validationkey`, `validation_date`) VALUES
(1, 1, NULL, 'Soutien scolaire chez Acadomia', 'Acadomia dispose d’un réseau de 120 agences, suit plus de 100 000 élèves avec l’aide de 25 000 « enseignants » encadrés par plus de 500 conseillers pédagogiques3. Toute personne titulaire d''un bac + 3 (licence) peut être employée comme enseignant.\r\nComme toutes les entreprises de services à la personne, la prestation offerte par la société - comme celle offerte individuellement par un étudiant déclaré - ouvre droit à un crédit d''impôt et/ou réduction d''impôt pour l''emploi à domicile de 50 % ce qui a favorisé son développement et celui de tout le secteur', 'Compiègne et alentours', '~10 € / h NET', 'compiegne@acadomia.fr', '0344538291', '2013-08-01 00:00:00', NULL, '2013-05-25 00:00:00', '2013-05-25 00:00:00', 'd1146c37a47de5b860e7770a0dd461da', 'd1146c37a47de5b860e7770a0dd341da', '2015-05-25 00:00:00'),
(2, 3, 2, 'Subway Rue Saint-Corneille', '', 'Rue Saint-Corneille, 60200 Compiègne', '9 € / h', 'compiegne-corneille@subway.com', '057492391', NULL, NULL, '2013-05-25 00:00:00', '2013-05-25 00:00:00', 'c5c469380bfe6f347c291c80271ddeeb', 'c5c469380bfe6f347c291c80271bbeeb', '2015-05-25 00:00:00'),
(3, 2, NULL, 'Tonte pelouse', 'Tondre la pelouse chez moi. Je suis une personne âgée qui ne peut plus assurer l''entretien de mes espaces verts.', '11 Rue Jean-Baptiste Vaquette de Gribeauval, Lacroix Saint-Ouen', '12 € / h cash', 'meme60@pelouse.fr', '0376129845', NULL, '2013-05-24 00:00:00', '2013-05-23 00:00:00', '2013-05-23 00:00:00', 'ac1371c2ed132933430e868cbb1da2f7', 'ac1371c2ed132933430e868cbb1da2aa', '2015-05-25 00:00:00'),
(4, 5, NULL, 'Détaillant / vendeur de rue', 'Revente de produits stupéfiants les soirs au Pic''.', 'Pic'' asso, Compiègne', '30 % sur la marchandise revendue', 'haschich@thcforall.org', NULL, '2013-08-29 00:00:00', NULL, '2013-05-25 00:00:00', '2013-05-25 00:00:00', '629b68e2aab5c45cb25f5f8537929e74', '629b68e2aab5c45cb25f5f8537929evv', '2013-05-25 00:00:00');

INSERT INTO `info_job_offre_disponibilite` (`offre_id`, `disponibilite_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 1),
(2, 2),
(2, 4),
(3, 2),
(3, 4);

INSERT INTO `info_job_signalement` (`id`, `offre_id`, `type_id`, `commentaire`, `archivage_date`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 'Vente de produits stupéfiants', NULL, '2013-05-25 19:45:08', '2013-05-25 19:45:08');

INSERT INTO `info_job_signalement_type` (`id`, `name`) VALUES
(1, 'Propos injurieux, calomnieux, déplacés, etc.'),
(2, 'Offre illégale, travail non-déclaré, etc.');

SET foreign_key_checks = 1;
