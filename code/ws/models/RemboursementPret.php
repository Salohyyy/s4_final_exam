<?php
require_once __DIR__ . '/../db.php';

class RemboursementPret {
    public static function insererEcheancier($idPret, $montant, $duree, $delais, $taux, $assuranceTaux) {
        $db = getDB();
        $montantAvecTVA = $montant * (1 + self::getTauxTVA());
        $tauxMensuel = $taux / 12 / 100;

        // Calcul de l’annuité constante
        $annuite = $montantAvecTVA * $tauxMensuel / (1 - pow(1 + $tauxMensuel, -$duree));

        $dateDebut = new DateTime();
        $dateDebut->modify("+{$delais} months");

        for ($i = 0; $i < $duree; $i++) {
            $assurance = ($i === 0) ? $montant * $assuranceTaux : 0;
            $datePrevue = clone $dateDebut;
            $datePrevue->modify("+$i months");

            $stmt = $db->prepare("INSERT INTO remboursement_pret (id_pret, assurance, annuite, date_prevue, montant_penalite, date_remboursement)
                                  VALUES (:id_pret, :assurance, :annuite, :date_prevue, NULL, NULL)");
            $stmt->execute([
                ':id_pret' => $idPret,
                ':assurance' => $assurance,
                ':annuite' => $annuite,
                ':date_prevue' => $datePrevue->format("Y-m-d")
            ]);
        }
    }

    private static function getTauxTVA() {
        $db = getDB();
        $stmt = $db->query("SELECT taux FROM tva ORDER BY date_modif DESC LIMIT 1");
        $row = $stmt->fetch();
        return $row ? $row['taux'] / 100 : 0;
    }

    public static function getTauxInteretPret($idPretType) {
        $db = getDB();
        $stmt = $db->prepare("SELECT taux_interet FROM pret_caracteristique WHERE id_pret_type = ? ORDER BY date_modif DESC LIMIT 1");
        $stmt->execute([$idPretType]);
        $row = $stmt->fetch();
        return $row ? $row['taux_interet'] : 0;
    }

    public static function getAssuranceTaux() {
        $db = getDB();
        $stmt = $db->query("SELECT pourcentage FROM assurance ORDER BY date_modif DESC LIMIT 1");
        $row = $stmt->fetch();
        return $row ? $row['pourcentage'] / 100 : 0;
    }
}
