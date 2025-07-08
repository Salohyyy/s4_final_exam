<?php
require_once __DIR__ . '/../models/Pret.php';
require_once __DIR__ . '/../models/PretEtat.php';

class PretController {
    public static function create() {
        $data = Flight::request()->data;

        // Vérification basique
        if (!isset($data['id_pret_type'], $data['id_client'], $data['montant'], $data['duree'])) {
            Flight::halt(400, 'Champs obligatoires manquants.');
        }

        $db = getDB();

        try {
            $db->beginTransaction();

            // Insérer dans pret
            $idPret = Pret::create($data);

            // Insérer dans pret_etat avec statut "en attente"
            PretEtat::insertEtatInitial($idPret, 1); // employé ID 1

            $db->commit();
            Flight::json(['message' => 'Prêt inséré avec succès', 'id' => $idPret]);

        } catch (Exception $e) {
            $db->rollBack();
            Flight::halt(500, 'Erreur : ' . $e->getMessage());
        }
    }
}
