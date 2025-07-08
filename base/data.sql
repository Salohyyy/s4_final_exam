-- EMPLOYES
INSERT INTO employe (nom, prenom, email, dtn, mdp) VALUES
('Rabe', 'Jean', 'jean.rabe@email.com', '1990-01-01', 'mdp123'),
('Rakoto', 'Sophie', 'sophie.rakoto@email.com', '1985-05-05', 'pass456');

INSERT INTO employe_etat (libelle) VALUES ('embauche'), ('renvoye'), ('demission');

INSERT INTO employe_historique (id_employe, id_employe_etat, date) VALUES
(1, 1, '2023-01-01'),
(2, 1, '2023-02-15');

-- CLIENTS
INSERT INTO client (nom, prenom, email) VALUES
('Ando', 'Miala', 'miala.ando@email.com'),
('Fanja', 'Rivo', 'rivo.fanja@email.com');

-- COMPTES
INSERT INTO compte_type (description) VALUES ('client'), ('institutionnelle');

INSERT INTO compte (numero, id_compte_type) VALUES
('CL-0001', 1),
('INST-1001', 2);

INSERT INTO compte_client (id_client, id_compte, date, attribution) VALUES
(1, 1, '2024-01-01', TRUE),
(2, 1, '2024-02-01', FALSE);

-- CONTRIBUTEUR
INSERT INTO contributeur (libelle) VALUES ('client'), ('etat'), ('actionnaire'), ('investisseur'), ('EF');

-- MOUVEMENTS
INSERT INTO compte_type_mouvement (description, entree) VALUES
('encaissement', TRUE),
('decaissement', FALSE),
('investissement', TRUE);

INSERT INTO compte_mouvement (id_compte_type_mouvement, id_compte, id_contributeur, date_mouvement, montant) VALUES
(1, 1, 1, '2024-03-01', 100000),
(3, 2, 2, '2024-04-15', 500000);

-- PRETS
INSERT INTO pret_type (description, but) VALUES
('Crédit consommation', 'Achat de biens personnels'),
('Crédit immobilier', 'Acquisition de logement');

INSERT INTO pret_caracteristique (id_pret_type, montant_min, montant_max, duree_min, duree_max, taux_interet, date_modif) VALUES
(1, 50000, 1000000, 6, 36, 5.5, '2024-01-01'),
(2, 1000000, 5000000, 12, 60, 4.0, '2024-01-01');

INSERT INTO pret (id_pret_type, id_client, montant, duree, description) VALUES
(1, 1, 200000, 12, 'Achat moto'),
(2, 2, 3000000, 48, 'Maison Antananarivo');

INSERT INTO pret_statut (libelle) VALUES ('en attente'), ('valide'), ('refuse'), ('rembourse');

INSERT INTO pret_etat (id_pret, id_pret_statut, date_etat, id_employe) VALUES
(1, 1, '2024-05-01', 1),
(2, 2, '2024-05-10', 2);

-- AUTRES
INSERT INTO compte_seuil (pourcentage, date_modif) VALUES (10., '2024-01-01');
INSERT INTO tva (taux, date_modif) VALUES (20.0, '2024-01-01');
INSERT INTO penalite (pourcentage, date_modif) VALUES (1.0, '2024-01-01');
INSERT INTO assurance (pourcentage, date_modif) VALUES (1.0, '2024-01-01');
INSERT INTO delais_max (date_modif) VALUES ('2024-01-01');
