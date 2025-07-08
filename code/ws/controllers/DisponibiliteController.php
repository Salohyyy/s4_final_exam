<?php
require_once __DIR__ . '/../models/DisponibiliteModel.php';

class DisponibiliteController {
    public static function calculerDisponibilite() {
        $req = Flight::request()->query;
        $moisDebut = $req['mois_debut'];
        $anneeDebut = $req['annee_debut'];
        $moisFin = $req['mois_fin'];
        $anneeFin = $req['annee_fin'];

        if (!$moisDebut || !$anneeDebut || !$moisFin || !$anneeFin) {
            Flight::halt(400, "Paramètres manquants");
        }

        $result = DisponibiliteModel::getDisponibiliteParMois($moisDebut, $anneeDebut, $moisFin, $anneeFin);
        Flight::json($result);
    }
}
