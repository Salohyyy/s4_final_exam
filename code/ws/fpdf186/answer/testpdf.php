<?php
include('..\fpdf.php');
include "Connex.php";
include "Model.php";

class PDF extends FPDF {
    private $model;

    public function __construct() {
        parent::__construct('P', 'mm', 'A4');
        $this->model = new Model();
    }

    public function generateBulletin($idEtudiant = 1) {
        $data = $this->model->getAll();
        $etudiant = $data['etudiant'];
        $bulletin = $data['bulletin'];
        $resultatGeneral = $this->model->getResultatGeneral($idEtudiant);
        $this->AddPage();
        $this->infoEtuDiant($etudiant);
        $this->generateGrades($bulletin);
        $this->resultatGeneral($resultatGeneral);
    }

    function Header(){
        $this->Image('image.png', 10, 6, 50);
        // $this->SetTextColor(212, 175, 55);
        $this->SetTextColor(189, 171, 145);
        $this->SetFont('Arial','B',8);
        $this->Cell(185,10,'Annee universitaire 2015-2016',0,10,'R');
        $this->SetTextColor(0, 0, 139);
        $this->SetFont('Arial','B',12);
        $this->Cell(200,20,'RELEVE DE NOTES ET RESULTATS',0,10,'C');
    }
    function infoEtuDiant($etudiant) {
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial','B',10);
        $this->Cell(40, 8, 'Nom: ', 0, 0);
        $this->SetFont('Arial','',10);
        $this->Cell(100, 8, $etudiant['Nom'], 0, 0);
        $this->Ln(7);
        $this->SetFont('Arial','B',10);
        $this->Cell(40, 8, 'Prenom(s): ', 0, 0);
        $this->SetFont('Arial','',10);
        $this->Cell(100, 8, $etudiant['Prenoms'], 0, 0);
        $this->Ln(7);
        $this->SetFont('Arial','B',10);
        $this->Cell(40, 8, 'Ne le: ', 0, 0);
        $this->SetFont('Arial','',10);
        $this->Cell(40, 8, $etudiant['dateNaissacnce']. ' a ' . $etudiant['lieu'], 0, 0);
        $this->Ln(7);
        $this->SetFont('Arial','B',10);
        $this->Cell(40, 8, 'N d\'inscription: ', 0, 0);
        $this->SetFont('Arial','',10);
        $this->Cell(100, 8, $etudiant['N_inscription'], 0, 0);
        $this->Ln(7);
        $this->SetFont('Arial','B',10);
        $this->Cell(40, 8, 'Inscrit en:  ', 0, 0);
        $this->SetFont('Arial','',10);
        $this->Cell(100, 8, $etudiant['Inscrit'], 0, 0);
        $this->Ln(10);
        $this->Cell(100, 8, 'a obtenu les notes suivantes:', 0, 0);
    }
     function generateGrades($bulletin) {
        // Group notes by semester
        $notesBySemester = [];
        foreach ($bulletin as $note) {
            $notesBySemester[$note['Semestre']][] = $note;
        }
        
        // Display notes for each semester
        $this->Ln(5);
        foreach ($notesBySemester as $semestre => $notes) {
            $this->semestre($semestre, $notes);
        }
    }
    function semestre($semestre, $notes) {
        $this->Ln(10);
        $this->SetTextColor(0, 0, 0);

        $this->SetFont('Arial','B',10);
        $this->Cell(20, 7, 'UE', 0, 0, 'C');
        $this->Cell(80, 7, 'Intitule', 0, 0, 'C');
        $this->Cell(30, 7, 'Credits', 0, 0, 'C');
        $this->Cell(30, 7, 'Note/20', 0, 0, 'C');
        $this->Cell(30, 7, 'Resultat', 0, 0, 'C');

        $this->Ln();
        $this->SetFont('Arial','',10);
        $totalCredits = 0;
        $totalWeightedNotes = 0;
        
        foreach ($notes as $note) {
            $this->Cell(20,  6, $note['UE'], 0, 0, 'C');
            $this->Cell(80, 6, $note['Intitule'], 0, 0, 'R');
            $this->Cell(30, 6, $note['Credits'], 0, 0, 'C');
            $this->Cell(30, 6, number_format($note['Note']), 0, 0, 'C');
            $this->Cell(30, 6, $note['Resultat'], 0, 0, 'C');
            $this->Ln();
            $totalCredits += $note['Credits'];
            $totalWeightedNotes += $note['Note'] * $note['Credits'];
        }
        $semesterAverage = $totalWeightedNotes / $totalCredits;
        $this->SetFont('Arial','B',10);
        $this->Cell( 100, 6, 'SEMESTRE ' . $semestre, 0, 0, 'C');
        $this->Cell(30, 6, $totalCredits, 0, 0, 'C');
        $this->Cell(30, 6, number_format($semesterAverage, 2), 0, 0, 'C');
        $this->Cell(30, 6, $semesterAverage >= 10 ? 'P' : 'AJ', 0, 0, 'C');
        
    }
    function resultatGeneral($resultatGeneral){
        $this->Ln(20);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial','B',10);
        $this->Cell(35, 7, 'Resultat general: ', 0, 0);
        $this->SetFont('Arial','',10);
        $this->Cell(35, 7, 'Credits:', 0, 0);
        $this->Cell(50, 7, $resultatGeneral['total_credits'], 0, 0);
        $this->Ln(7);
        $this->Cell(35, 7, '', 0, 0);
        $this->Cell(35, 7, 'Moyenne generale:', 0, 0);
        $this->Cell(50, 7, $resultatGeneral['moyenne'], 0, 0);
        $this->Ln(7);
        $this->Cell(35, 7, '', 0, 0);
        $this->Cell(35, 7, 'Mention:', 0, 0);
        $this->Cell(50, 7, $resultatGeneral['mention'], 0, 0);
        $this->Ln(7);
        $this->Cell(35, 7, '', 0, 0);
        $this->SetFont('Arial','B',10);
        $this->Cell(35, 7, 'ADMIS', 0, 0);
        $this->Cell(50, 7, '', 0, 0);
        $this->SetFont('Arial','',10);
        $this->Ln(7);
        $this->Cell(35, 7, '', 0, 0);
        $this->Cell(35, 7, 'Session:', 0, 0);
        $this->Cell(50, 7, '08/20216', 0, 0);
    }
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-20);
        // Police Arial italique 8
        $this->SetFont('Arial','',10);
        // Numéro de page
        $this->Cell(300,10,'Fait a Antananarivo',0,0,'C');
        $this->Ln(5);
        $this->Cell(300,10,'Le recteur de l\'IT University',0,0,'C');
    }
}   

$pdf = new PDF();
$pdf->generateBulletin();
$pdf->Output('I', 'first.pdf');

?>