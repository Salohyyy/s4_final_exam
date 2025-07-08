<?php
require_once __DIR__ . '/../db.php';

class Pret {
    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO pret (id_pret_type, id_client, delais, montant, duree, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data->id_pret_type, $data->id_client, $data->montant, $data->delais, $data->duree, $data->description]);
        return $db->lastInsertId();
    }
    public function updatePretEtat($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO pret_etat (id_pret, id_pret_statut, date_etat, id_employe) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data->id_pret, $data->id_pret_statut, $data->date_etat, $data->id_employe]);
        return $db->lastInsertId();
    }
    public static function getPretsNonValides() {
        $db = getDB();
        $sql = "
            SELECT p.id, p.montant, p.duree, p.delais, p.description,
                   c.nom AS client_nom, c.prenom AS client_prenom,
                   pt.description AS type_description
            FROM pret p
            JOIN client c ON p.id_client = c.id
            JOIN pret_type pt ON p.id_pret_type = pt.id
            JOIN (
                SELECT id_pret, MAX(date_etat) AS last_date
                FROM pret_etat
                GROUP BY id_pret
            ) pe_max ON pe_max.id_pret = p.id
            JOIN pret_etat pe ON pe.id_pret = p.id AND pe.date_etat = pe_max.last_date
            WHERE pe.id_pret_statut = 1 or pe.id_pret_statut = 4
        ";
        return $db->query($sql)->fetchAll();
    }
}