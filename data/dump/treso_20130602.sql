UPDATE `role` SET `droits`=(`droits`+256) WHERE `id` IN (1,2);
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