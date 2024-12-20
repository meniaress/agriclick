<?php


require_once('controllers/elyes/tc-lib-pdf-main\resources\autoload.php');
require_once('controllers/elyes/tc-lib-pdf-main\src\Tcpdf.php');






try {
    $con = new PDO('mysql:host=localhost;dbname=reclamation', 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données des partenariats
    $stmt = $con->query("SELECT * FROM partenariats");
    $partenariats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Créer un nouvel objet TCPDF
    $pdf = new Tcpdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('AgriCLICK');
    $pdf->SetTitle('Liste des Partenariats');
    $pdf->SetHeaderData('', 0, 'Liste des Partenariats', '');
    $pdf->setHeaderFont(['helvetica', '', 12]);
    $pdf->setFooterFont(['helvetica', '', 10]);
    $pdf->SetMargins(15, 27, 15);
    $pdf->SetAutoPageBreak(TRUE, 25);
    $pdf->AddPage();

    // Titre du tableau
    $html = '<h3 style="text-align:center;">Liste des Partenariats</h3>';
    $html .= '<table border="1" cellpadding="4" cellspacing="0" style="width:100%;">';
    $html .= '<thead>
        <tr>
            <th>Nom de l\'organisation</th>
            <th>Nom du responsable</th>
            <th>Numéro de téléphone</th>
            <th>Adresse e-mail</th>
            <th>Type de partenariat</th>
            <th>Description</th>
            <th>Image</th>
            <th>Status</th>
            <th>ID</th>
        </tr>
    </thead>';

    // Remplir les lignes du tableau
    $html .= '<tbody>';
    foreach ($partenariats as $partenariat) {
        $html .= '<tr>';
        foreach ($partenariat as $key => $value) {
            $html .= '<td>' . htmlspecialchars($value) . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</tbody>';
    $html .= '</table>';

    // Ajouter le tableau au PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Télécharger le PDF
    $pdf->Output('Liste_Partenariats.pdf', 'D'); // Le fichier sera téléchargé
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

