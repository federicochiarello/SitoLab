<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "dbConnection.php";
use DB\DbAccess;

$paginaHTML = file_get_contents('base_php'. DIRECTORY_SEPARATOR .'nuovoProtagonistaForm.html');

$messaggioPerForm = '';
$nome = ''; $specializzazion = ''; $qi = ''; $descrizione = ''; $stagioni = array();

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];
    $specializzazione = $_POST['specializzazione'];
    $qi = $_POST['qi'];
    $descrizione = $_POST['descrizione'];

    $stagioni = array();
    if (!empty($_POST['stagioni'])) {
        $stagioni = $_POST['stagioni'];
    }

    if (strlen($nome) != 0 && strlen($specializzazione) !=0 && strlen($qi) != 0 && strlen($descrizione) > 5 && is_numeric($qi) ) {
        // INSERIRE INFORMAZIONI NEL DB
        $dbAccess = new DBAccess->openDBConnection();
        $openDBConnection = $dbAccess->openDBConnection();

        if ($openDBConnection == true) {
            $inPrimaStagione = 0;
            $inSecondaStagione = 0;
            $inTerzaStagione = 0;
            $inQuartaStagione = 0;

            if (in_array("primaStagione", $stagioni)) {
                $inPrimaStagione = 1;
            }

            if (in_array("secondaStagione", $stagioni)) {
                $inSecondaStagione = 1;
            }

            if (in_array("terzaStagione", $stagioni)) {
                $inTerzaStagione = 1;
            }

            if (in_array("quartaStagione", $stagioni)) {
                $inQuartaStagione = 1;
            }

            $risultatoInserimento = $dbAccess->inserisciProtagonista($nome, $specializzazione, $qi, $descrizione, $inPrimaStagione, $inSecondaStagione, $inTerzaStagione, $inQuartaStagione);

            if ($risultatoInserimento == true) {
                $messaggioPerForm = '<div id="conferma"><p>Personaggio inserito correttamente</p></div>';
            }
            else {
                $messaggioPerForm = '<div id="errori"><p>Errore nell\'inserimento del personaggio. Riprovare</p></div>';
            }

        }
    }
    else{
        // MOSTRARE ALL UTENTE GLI ERRORI COMMESSI

        $messaggioPerForm = '<div id="errori"><ul>';
        if (strlen($nome) == 0) {
            $messaggioPerForm .= '<li>Nome troppo corto</li>';
        }
        if (strlen($specializzazione) == 0) {
            $messaggioPerForm .= '<li>Specializzazione troppo corta</li>';
        }
        if (strlen($descrizione) == 0) {
            $messaggioPerForm .= '<li>Descrizione deve essere almeno 5 caratteri</li>';
        }
        $messaggioPerForm .= '</ul></div>';
    }
}    

$paginaHTML = str_replace('<messaggiForm />' ,$messaggioPerForm, $paginaHTML);
$paginaHTML = str_replace('<valoreNome />' ,$nome, $paginaHTML);
$paginaHTML = str_replace('<valoreSpecializzazione />' ,$specializzazione, $paginaHTML);
$paginaHTML = str_replace('<valoreQi />' ,$qi, $paginaHTML);
$paginaHTML = str_replace('<valoreDescrizione />' ,$descrizione, $paginaHTML);

echo $paginaHTML;

?>