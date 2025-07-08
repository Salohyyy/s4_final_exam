<?php
require_once __DIR__ . '/../models/RemboursementModel.php';

class RemboursementController {

    public static function getPretsNonRembourses() {
        $d = Flight::request()->data;
        $idClient = $d['id_client'] ?? null;
        $datePrevue = $d['date_prevue'] ?? null;

        if (!$idClient || !$datePrevue) {
            Flight::halt(400, "Paramètres manquants.");
        }

        $data = RemboursementModel::getPretsNonRembourses($idClient, $datePrevue);
        Flight::json($data);
    }

    public static function getRemboursementDetails() {
        $d = Flight::request()->data;
        $idPret = $d['id_pret'] ?? null;
        $date = $d['date_prevue'] ?? null;

        if (!$idPret || !$date) {
            Flight::halt(400, "Paramètres manquants.");
        }

        $data = RemboursementModel::getRemboursementDetails($idPret, $date);
        Flight::json($data);
    }

    public static function validerRemboursement() {
        $d = Flight::request()->data;

        $idPret = $d['id_pret'] ?? null;
        $dateRem = $d['date_remboursement'] ?? null;
        $datePrevue = $d['date_prevue'] ?? null;

        if (!$idPret || !$dateRem || !$datePrevue) {
            Flight::halt(400, "Paramètres manquants.");
        }

        $success = RemboursementModel::validerRemboursement($idPret, $dateRem, $datePrevue);
        Flight::json(['success' => $success]);
    }
}
