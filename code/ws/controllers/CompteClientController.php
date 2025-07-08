<?php
require_once __DIR__ . '/../models/CompteClient.php';
require_once __DIR__ . '/../models/CompteMouvement.php';
require_once __DIR__ . '/../helpers/Utils.php';

class CompteClientController {
    public static function getByClient($idClient) {
        $comptes = CompteClient::getByClient($idClient);

        foreach ($comptes as &$compte) {
            $idCompte = $compte['id_compte'];
            $mouvements = CompteMouvement::getByCompte($idCompte);

            $solde = 0;
            foreach ($mouvements as $m) {
                if ($m['entree'] == 1) { // encaissement
                    $solde += $m['montant'];
                } else { // décaissement
                    $solde -= $m['montant'];
                }
            }

            $compte['solde'] = $solde;
        }

        Flight::json($comptes);
    }
}


