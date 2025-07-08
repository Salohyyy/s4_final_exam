DROP DATABASE IF EXISTS ef;
CREATE DATABASE ef;
use ef;

-- EMPLOYES
CREATE TABLE employe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    dtn DATE,
    mdp VARCHAR(255)
);

CREATE TABLE employe_etat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50)
);

CREATE TABLE employe_historique (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_employe INT,
    id_employe_etat INT,
    date DATE,
    FOREIGN KEY (id_employe) REFERENCES employe(id),
    FOREIGN KEY (id_employe_etat) REFERENCES employe_etat(id)
);

-- CLIENTS
CREATE TABLE client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE
);

-- COMPTE
CREATE TABLE compte_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(100)
);

CREATE TABLE compte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(50) UNIQUE,
    id_compte_type INT,
    FOREIGN KEY (id_compte_type) REFERENCES compte_type(id)
);

CREATE TABLE compte_client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    id_compte INT,
    date DATE,
    attribution BOOLEAN,
    FOREIGN KEY (id_client) REFERENCES client(id),
    FOREIGN KEY (id_compte) REFERENCES compte(id)
);

-- CONTRIBUTEUR
CREATE TABLE contributeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100)
);

-- MOUVEMENTS
CREATE TABLE compte_type_mouvement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(100),
    entree BOOLEAN
);

CREATE TABLE compte_mouvement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_compte_type_mouvement INT,
    id_compte INT,
    id_contributeur INT,
    date_mouvement DATE,
    montant DECIMAL(15,2),
    FOREIGN KEY (id_compte_type_mouvement) REFERENCES compte_type_mouvement(id),
    FOREIGN KEY (id_compte) REFERENCES compte(id),
    FOREIGN KEY (id_contributeur) REFERENCES contributeur(id)
);

-- PRET
CREATE TABLE pret_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255),
    but TEXT
);

CREATE TABLE pret_caracteristique (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pret_type INT,
    montant_min DECIMAL(15,2),
    montant_max DECIMAL(15,2),
    duree_min INT,
    duree_max INT,
    taux_interet DECIMAL(5,2),
    date_modif DATE,
    FOREIGN KEY (id_pret_type) REFERENCES pret_type(id)
);

CREATE TABLE pret (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pret_type INT,
    id_client INT,
    montant DECIMAL(15,2),
    duree INT,
    description TEXT,
    FOREIGN KEY (id_pret_type) REFERENCES pret_type(id),
    FOREIGN KEY (id_client) REFERENCES client(id)
);

CREATE TABLE pret_statut (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100)
);

CREATE TABLE pret_etat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pret INT,
    id_pret_statut INT,
    date_etat DATE,
    id_employe INT,
    FOREIGN KEY (id_pret) REFERENCES pret(id),
    FOREIGN KEY (id_pret_statut) REFERENCES pret_statut(id),
    FOREIGN KEY (id_employe) REFERENCES employe(id)
);

CREATE TABLE remboursement_pret (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pret INT,
    assurance DECIMAL(15,2),
    amortissement DECIMAL(15,2),
    date_prevue DATE,
    interet DECIMAL(10,2),
    date_remboursement DATE,
    montant_penalite DECIMAL(10,2),
    FOREIGN KEY (id_pret) REFERENCES pret(id)
);

-- SEUIL, TVA, PENALITE
CREATE TABLE compte_seuil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pourcentage DECIMAL(5,2),
    date_modif DATE
);

CREATE TABLE assurance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pourcentage DECIMAL(5,2),
    date_modif DATE
);

CREATE TABLE tva (
    id INT AUTO_INCREMENT PRIMARY KEY,
    taux DECIMAL(5,2),
    date_modif DATE
);

CREATE TABLE penalite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pourcentage DECIMAL(5,2),
    date_modif DATE
);
