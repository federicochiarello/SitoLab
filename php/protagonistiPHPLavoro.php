 <?php
require_once __DIR__  . DIRECTORY_SEPARATOR . "dbConnectionLavoro.php";
use DB\DBAccess;

$paginaHTML = file_get_contents('protagonisti.html');

$dbAccess = new DBAccess();
$connessioneRiuscita = $dbAccess->openDBConnection();


if ($connessioneRiuscita == false) {
    die ("Errore nell'apertura del DB");
    // Bisogna dire qualcosa all'utente, pagina web dove si segnala l'errore in qualche modo.
}
else {

    $listaProtagonisti = $dbAccess->getListaPersonaggi();

    $dbAccess->closeDBConnection();

    $definitionListProtagonisti = "";

    if ($listaProtagonisti != null) {

        //creo parte di pagina HTML con elenco dei protagonisti
        $definitionListProtagonisti ='<dl id="charactersStory">';

        foreach ($listaProtagonisti as $protagonista) {
            $definitionListProtagonisti .= '<dt>' . $protagonista['Nome'] . '</dt>';
            $definitionListProtagonisti .= '<dd>';
            $definitionListProtagonisti .= '<img src="images'. DIRECTORY_SEPARATOR . $protagonista['Immagine'] . '" alt="' . $protagonista['AltImmagine'] . '" />';
            $definitionListProtagonisti .= '<p>' . $protagonista['Descrizione'] . '</p>';
            $definitionListProtagonisti .= '<p class="aiutoTornaSu"><a href="#contentPagina">Torna Su</a></p>';
            $definitionListProtagonisti .= '</dd>';
        }

        $definitionListProtagonisti = $definitionListProtagonisti . "</dl>";
    }
    else {
        //messaggio che dice che non ci sono protagonisti nel DB
        $definitionListProtagonisti = "<p>Nessun personaggio presente</p>";
    }

    echo str_replace("<listaPersonaggi />", $definitionListProtagonisti, $paginaHTML);
}

?>