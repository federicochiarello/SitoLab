<?php
{

    public function closeDBConnection() {
        
    }

    public function getListaPersonaggi() {

    }

    public function inserisciProtagonista($nome, $specializzazione, $qi, $descrizione, $prima, $seconda, $terza, $quarta) {
        $queryInserimento = "INSERT INTO protagonisti(Nome Specializzazione, QI, Descrizione, PrimaStagione, SecondaStagione, TerzaStagione, QuartaStagione, NomeImmagine, AltImmagine) 
        VALUES (\"$nome\", \"$specializzazione\", \"$qi\", \"$descrizione\", $prima, $seconda, $terza, $quarta, \"\", \"\")";

        $queryResult = mysqli_query($this->connection, $queryInserimento);

        if (mysqli_affected_rows($this->connection) > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>