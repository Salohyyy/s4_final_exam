<?php
include "Connex.php";

class Model {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function getBulletin($idEtudiant) {
        $sql = "SELECT *
                FROM note n
                JOIN matiere m ON n.idMat = m.idMat
                WHERE n.idEtudiant = ?
                ORDER BY m.Semestre ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idEtudiant]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiant($idEtudiant) {
        $sql = "SELECT * FROM etudiant WHERE idEtudiant = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idEtudiant]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAll(){
        $idEtudiant = 1;
        $etudiant = $this->getEtudiant($idEtudiant);
        $bulletin = $this->getBulletin($idEtudiant);
        $res['etudiant'] = $etudiant;
        $res['bulletin'] = $bulletin;
        return $res;
    }
    public function getResultatGeneral($idEtudiant) {
        $stmt = $this->pdo->prepare("
            SELECT SUM(m.Credits) AS total_credits, 
                   SUM(n.Note * m.Credits) / SUM(m.Credits) AS moyenne 
            FROM note n
            JOIN matiere m ON n.idMat = m.idMat
            WHERE n.idEtudiant = ?
        ");
        $stmt->execute([$idEtudiant]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $mention = $this->getMention($result['moyenne']);
        return [
            'total_credits' => $result['total_credits'],
            'moyenne' => number_format($result['moyenne'], 2),
            'mention' => $mention
        ];
    }
    private function getMention($moyenne) {
        if ($moyenne >= 14) return "Bien";
        if ($moyenne >= 12) return "Assez Bien";
        if ($moyenne >= 10) return "Passable";
        return "Ajourné";
    }
}

?>
