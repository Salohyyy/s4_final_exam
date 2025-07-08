/*CREATE VIEW fond AS
SELECT 
    -- Somme des encaissements des clients
    (SELECT IFNULL(SUM(cm.montant), 0) 
    FROM compte_mouvement cm
    JOIN compte c ON cm.id_compte = c.id
    JOIN compte_type ct ON c.id_compte_type = ct.id
    WHERE cm.id_compte_type_mouvement = 1 -- encaissement
    AND ct.description = 'client') AS somme_encaissements_clients,
    
    -- Montant prêtable (90% des encaissements clients)
    (SELECT IFNULL(SUM(cm.montant * 0.9), 0)
    FROM compte_mouvement cm
    JOIN compte c ON cm.id_compte = c.id
    JOIN compte_type ct ON c.id_compte_type = ct.id
    WHERE cm.id_compte_type_mouvement = 1 -- encaissement
    AND ct.description = 'client') AS montant_pretable,
    
    -- Somme des autres fonds (montant prêtable + investissements)
    (
        (SELECT IFNULL(SUM(cm.montant * 0.9), 0)
         FROM compte_mouvement cm
         JOIN compte c ON cm.id_compte = c.id
         JOIN compte_type ct ON c.id_compte_type = ct.id
         WHERE cm.id_compte_type_mouvement = 1 -- encaissement
         AND ct.description = 'client')
        +
        (SELECT IFNULL(SUM(cm.montant), 0)
         FROM compte_mouvement cm
         WHERE cm.id_compte_type_mouvement = 3) -- investissement
    ) AS somme_autres_fonds;

    SELECT 
    YEAR(r.date_remboursement) AS annee,
    MONTH(r.date_remboursement) AS mois,
    SUM(r.annuite - r.assurance) AS somme_interets
FROM 
    remboursement_pret r
WHERE 
    r.date_remboursement BETWEEN '2025-01-01' AND '2025-12-31'
    AND MONTH(r.date_remboursement) = 6  -- Filtre pour le mois de juin
GROUP BY 
    YEAR(r.date_remboursement),
    MONTH(r.date_remboursement)
ORDER BY 
    annee, mois;
*/




INSERT INTO remboursement_pret (id_pret, assurance, annuite, date_prevue, date_remboursement, montant_penalite)
VALUES
-- Remboursements pour id_pret=1 (avec des données réalistes)
(1, 50.00, 1050.00, '2023-01-05', '2023-01-05', 0.00),   -- Janvier
(1, 50.00, 1050.00, '2023-02-05', '2023-02-05', 0.00),   -- Février
(1, 50.00, 1050.00, '2023-03-05', '2023-03-07', 10.00),  -- Mars (avec retard)
(1, 50.00, 1050.00, '2023-04-05', '2023-04-05', 0.00),   -- Avril
(1, 50.00, 1050.00, '2023-05-05', '2023-05-05', 0.00),   -- Mai
(1, 50.00, 1050.00, '2023-06-05', '2023-06-05', 0.00),   -- Juin
(1, 50.00, 1050.00, '2023-07-05', '2023-07-10', 15.00), -- Juillet (avec retard)
(1, 50.00, 1050.00, '2023-08-05', '2023-08-05', 0.00),   -- Août
(1, 50.00, 1050.00, '2023-09-05', '2023-09-05', 0.00),   -- Septembre
(1, 50.00, 1050.00, '2023-10-05', '2023-10-05', 0.00);   -- Octobre


UPDATE remboursement_pret SET interet = 990 WHERE id = 1;
UPDATE remboursement_pret SET interet = 1000 WHERE id = 2;
UPDATE remboursement_pret SET interet = 970 WHERE id = 3;
UPDATE remboursement_pret SET interet = 1010 WHERE id = 4;
UPDATE remboursement_pret SET interet = 995 WHERE id = 5;
UPDATE remboursement_pret SET interet = 960 WHERE id = 6;
UPDATE remboursement_pret SET interet = 1005 WHERE id = 7;
UPDATE remboursement_pret SET interet = 980 WHERE id = 8;
UPDATE remboursement_pret SET interet = 970 WHERE id = 9;
UPDATE remboursement_pret SET interet = 1000 WHERE id = 10;
