<?php
require_once __DIR__ . '/../models/PretEtat.php';
require_once __DIR__ . '/../models/RemboursementPret.php';
require_once __DIR__ . '/../db.php';

class PretEtatController {
    public static function valider() {
        $d = Flight::request()->data;
        $db = getDB();

        try {
            $db->beginTransaction();

            $idPret = $d['id_pret'];
            $idEmploye = $d['id_employe'];
            $date = $d['date_etat'];

            // 1. Changer le statut en "validé" (id = 2)
            PretEtat::changerStatut($idPret, 2, $idEmploye, $date);

            // 2. Récupérer info prêt
            $pret = PretEtat::getPretInfo($idPret);

            // 3. Récupérer taux intérêt & assurance
            $taux = RemboursementPret::getTauxInteretPret($pret['id_pret_type']);
            $assuranceTaux = RemboursementPret::getAssuranceTaux();

            // 4. Générer l’échéancier
            RemboursementPret::insererEcheancier($idPret, $pret['montant'], $pret['duree'], $pret['delais'], $taux, $assuranceTaux);

            $db->commit();
            Flight::json(["message" => "Prêt validé avec échéancier généré."]);
        } catch (Exception $e) {
            $db->rollBack();
            Flight::halt(500, "Erreur : " . $e->getMessage());
        }
    }

    public static function refuser() {
        $d = Flight::request()->data;

        try {
            // Statut "refusé" (id = 3)
            PretEtat::changerStatut($d['id_pret'], 4, $d['id_employe'], $d['date_etat']);
            Flight::json(["message" => "Prêt refusé."]);
        } catch (Exception $e) {
            Flight::halt(500, "Erreur : " . $e->getMessage());
        }
    }
}
