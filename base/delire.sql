CREATE VIEW fond AS
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