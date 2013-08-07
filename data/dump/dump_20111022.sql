INSERT INTO `type_asso` (`id`, `name`) VALUES
(1, 'Commission/Projet BDE'),
(2, 'Projet Objectifs'),
(3, 'Associations 1901'),
(4, 'Club Upsilon');

INSERT INTO `asso` (`id`, `name`, `login`, `pole_id`, `type_id`, `url_site`, `description`, `logo`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Pôle Vie du Campus', 'polevdc', NULL, 3, NULL, 'Le pôle vie du campus n''existe pas encore au SiMDE.', NULL, 1, '2011-05-14 11:29:47', '2011-05-14 11:29:49'),
(3, 'Pôle Artistique et Évènementiel', 'poleae', NULL, 3, 'http://wwwassos.utc.fr/poleae', '<p>?Le Pôle Artistique et Évènementiel, ou PAÉ pour les intimes, est là pour <span style="font-weight: bold;">soutenir, accompagner et coordonner les associations à caractère artistique et/ou évènementiel</span>&nbsp; de l''UTC. Il est composé d''un bureau d''au minimum 4 personnes (on est 15 actuellement) et d''un CA de 10 personnes, renouvelés tous les ans, et de l''ensemble des membres des asso artistiques et évènementielles de la fédération BDE-UTC.<br /><br />Le pôle est <span style="font-weight: bold;">ZE association à contacter au moindre soucis</span> : disposant de tous les contacts utiles, il saura répondre à toutes tes questions, que tu sois à la tête d''un projet associatif, un membre actif ou simple sympathisant d''une asso du pôle. De plus, le pôle <span style="font-weight: bold;">met en place plusieurs ateliers de réflexion</span> sur des thèmes tels que les passations, la communication, les partenariats, la "trousse à UTC" (réserve de bénévoles dispo pour filer un coup de main aux gros évènements), etc... et bien entendu, <span style="font-weight: bold;">on recrute des gens pour aider à la communication, assurer l''animation, la vente de billets, l''organisation de soirées au PIC</span>, bref, y a besoin de monde, pour des petits comme des grands coups de main. <b>N''hésite pas à nous rejoindre !</b></p> ', 'http://wwwassos.utc.fr/poleae/logos/poleae.png', 1, '2011-05-14 11:10:48', '2011-05-14 11:10:51'),
(4, 'Pôle Solidarite et Citoyennete', 'polesec', NULL, 3, NULL, 'Le pôle psec n''existe pas encore au SiMDE...', NULL, NULL, '2011-05-14 11:15:35', '2011-05-14 11:15:37'),
(5, 'Pôle Technologie et Entreprenariat', 'poletee', NULL, 3, NULL, 'Le pôle Technologie et Entreprenariat n''existe pas encore au SiMDE.', NULL, NULL, '2011-05-14 11:17:11', '2011-05-14 11:17:13');

INSERT INTO `pole` (`id`, `asso_id`) VALUES
(1, 1),
(3, 3),
(4, 4),
(2, 5);


INSERT INTO `asso` (`id`, `name`, `login`, `pole_id`, `type_id`, `url_site`, `description`, `logo`, `active`, `created_at`, `updated_at`) VALUES
(2, 'SiMDE', 'simde', 1, 1, 'http://wwwassos.utc.fr/simde', '<span style="font-size: large;">Service informatique de la Maison des Étudiants</span><div><span style="font-size: 18px;"><br /></span><div>chargé de la mise en place de :</div><div><ul><li>Ressource informatique au sein de la MDE</li><li>Les serveurs : Phoenix et Centaure </li><li>Le site wwwassos.utc.fr</li><li>L''intranet des assos<br /></li></ul></div></div>', 'http://wwwassos.utc.fr/simde.png', 1, '2011-05-14 11:06:17', '2011-05-14 11:06:24'),
(6, 'BDE-UTC', 'bde', 1, 3, 'http://wwwassos.utc.fr/', 'Le bureau des étudiants de l''UTC (BDE-UTC) est une association 1901 qui a pour objet l''animation et la structuration de la vie étudiante de l''UTC de manière saine, responsable et constructive.\r\n\r\nDans ce cadre le BDE-UTC administre la Maison des Étudiants (MDE), partie du bâtiment C du centre Benjamin Franklin, dans le cadre de la Convention d''Occupation de la MDE signée chaque année avec l''UTC. Depuis début septembre, le BDE et ses commissions s''attache à supprimer les nuisances sonores aux abords des bâtiments.', NULL, 1, '2011-05-14 11:32:40', '2011-05-14 11:32:42'),
(7, 'USEC', 'usec', 2, 3, 'http://wwwassos.utc.fr/usec', 'Envie de toucher du doigt le monde de l''Entreprise? \r\nRejoins l''équipe de l''USEC, Junior-Entreprise de l''UTC! \r\n\r\nProche du fonctionnement les entreprises de conseil, nous mettons à disposition de clients industriels, du secteur tertiaire et particuliers, les compétences et connaissances acquises durant notre cycle ingénieur à l''UTC. Et bien sûr, chaque étudiant qui travaille pour l''USEC est rémunéré!\r\n\r\nL''USEC sera ton lien privilégié avec les entreprises durant tes années à l''UTC!\r\n\r\nViens nous voir en FC221!!', NULL, 1, '2011-05-14 11:33:41', '2011-05-14 11:33:43'),
(8, 'Polar', 'polar', 1, 3, 'http://wwwassos.utc.fr/polar', 'LA centrale d''achat des étudiants : matériel informatique, fournitures, papier ; mais aussi tout le service : impressions de rapports, posters, location de vidéoprojecteur, de WiiPack, de manuel de langue, et bien d''autres encore !', 'http://wwwassos.utc.fr/polar/styles/0/textures/logo.png', 1, '2011-05-14 11:35:22', '2011-05-14 11:35:24'),
(9, 'Comet', 'comet', 3, 1, 'http://wwwassos.utc.fr/comet', 'Organisation des soirées Étudiantes (Estu), location de matériel de son et lumières à bas prix.', 'http://wwwassos.utc.fr/poleae/logos/comet.jpg', 1, '2011-05-14 11:37:01', '2011-05-14 11:37:03');


INSERT INTO `article` (`id`, `asso_id`, `name`, `text`, `is_weekmail`, `created_at`, `updated_at`) VALUES
(1, 2, 'Article test', 'Hey !!\r\n\r\nCeci est mon petit article test...\r\n\r\nLe SiMDE', 0, '2011-05-14 17:02:02', '2011-05-14 17:02:04'),
(2, 8, 'Test', 'Ceci est un article test.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. In varius, mauris nec sollicitudin molestie, augue velit condimentum augue, quis lobortis tellus erat sed sapien. Pellentesque nunc nisi, pulvinar interdum feugiat sed, iaculis quis magna. Sed ipsum mi, cursus ac facilisis laoreet, hendrerit ut purus. Etiam ut elit vel augue pellentesque sodales. Ut eget libero vitae libero laoreet dapibus ac vel nisl. Nulla consectetur egestas massa et porta. Morbi sit amet leo at metus consectetur blandit ac non purus. Aenean rhoncus semper est, ut aliquet nunc consectetur ac. Suspendisse vulputate euismod justo eu consectetur. Aenean eu sapien magna, et ullamcorper quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras dictum lobortis pulvinar.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi id lectus ac enim iaculis varius congue sit amet libero. Pellentesque pretium tortor at ligula suscipit commodo. Proin quis leo massa, id euismod odio. Vivamus ornare eros non libero consequat molestie. Cras condimentum nisl ac libero ornare volutpat. Nunc mattis lorem eget nulla lacinia vitae egestas orci fermentum. Mauris consequat, felis ac sagittis molestie, turpis dui vulputate diam, vitae vulputate purus nunc in orci. Duis enim libero, lobortis vitae molestie in, ultricies at nunc. Sed tincidunt, libero vel porta scelerisque, massa tortor sollicitudin eros, vitae dictum tellus libero et diam. Aliquam quis erat ligula, eu imperdiet justo. Pellentesque dignissim nibh at ligula porttitor porttitor a eget diam. Aliquam ac purus non eros malesuada rhoncus non dignissim risus. Quisque nisi massa, semper luctus placerat vel, gravida porttitor lacus. Donec ut lectus augue. Cras vitae laoreet est. Nullam eu odio quam. Sed ac metus libero.', 0, '2011-05-14 17:03:00', '2011-05-14 17:03:03'),
(3, 1, 'test', '<p>test sdgsdgf''sgssdgs''''</p>', 0, '2011-05-16 15:22:10', '2011-05-16 15:22:10');

INSERT INTO `event_type` (`id`, `name`, `color`) VALUES
(1, 'Réunion', '#0000FF'),
(2, 'Perm au pic', '#FF0000');

INSERT INTO `event` (`id`, `asso_id`, `type_id`, `name`, `description`, `start_date`, `end_date`, `is_public`, `is_weekmail`, `place`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Test', '<p>fdgfgfd</p>\r\n<p>fgdgfd</p>\r\n<p>gfdgfdgfd</p>', '2011-05-09', '2011-05-17', 0, 0, '', '2011-05-15 21:30:31', '2011-05-15 21:30:31'),
(2, 2, 2, 'Test', '<p>fdgfdg</p>\r\n<p>fg</p>\r\n<p>fdg</p>\r\n<p>fdgfdgfdgfd</p>', '2011-05-18', '2011-05-19', 0, 0, '', '2011-05-15 21:31:40', '2011-05-15 21:31:40'),
(3, 6, 2, 'Salad''way', '<p>Viens composer ta salade &agrave; 1&euro;50 !</p>', '2011-10-07', '2011-10-07', 1, 1, 'PIC', '2011-10-02 19:36:55', '2011-10-02 19:36:55'),
(4, 3, NULL, 'Vidéo parc astérix', '<p>un truc de malade !</p>', '2011-10-03', '2011-10-06', 1, 0, 'en ligne', '2011-10-02 21:08:39', '2011-10-02 21:08:39'),
(5, 7, NULL, '30 ans de l''USEC', '<p>cool</p>', '2012-05-01', '2012-05-02', 1, 0, 'Théâtre Impérial', '2011-10-02 21:10:17', '2011-10-02 21:10:17'),
(6, 8, NULL, 'Impressions', '<p>viens photocopier ton cul en toute discretion...</p>', '2011-10-05', '2011-10-05', 1, 0, '', '2011-10-02 21:11:18', '2011-10-02 21:11:52'),
(7, 6, 1, 'test 1', '<ul>\r\n<li>\r\n<h1><strong>coucou</strong></h1>\r\n</li>\r\n</ul>', '2011-10-23', '2011-10-30', 1, 0, 'quelque part', '2011-10-22 15:51:04', '2011-10-22 15:51:59'),
(8, 8, 2, 'Rome Antique', '<p>oh yeah</p>', '2011-11-15', '2011-12-21', 1, 0, '', '2011-10-22 15:52:54', '2011-10-22 15:52:54');
