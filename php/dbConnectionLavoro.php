<?php
namespace DB;

class DBAccess {

    private const HOST_DB = "localhost";
    private const USERNAME = "";
    private const PASSWORD = "";                    //password php MyAdmin
    private const DATABASE_NAME = "";

    private $connection;

    public function openDBConnection() {

        $this->connection = mysqli_connect(DBAccess::HOST_DB, DBAccess::USERNAME, DBAccess::PASSWORD, DBAccess::DATABASE_NAME);
        
        // mysqli_connect_errno($this->connection)
        if (!$this->connection) {
            return false;
        }
        else {
            return true;
        }
    }

    public function closeDBConnection() {

    }

    public function getListaPersonaggi() {

        $querySelect = "SELECT * FROM protagonisti ORDER BY ID ASC";
        $queryResult = mysqli_query($this->connection, $querySelect);

        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        }
        else {

            $listaPersonaggi = array();
            // while ($riga 0 mysqli_fetch_array($queryResult))
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                
                $singoloPersonaggio = array(
                    "Nome" => $riga['Nome'],
                    "Immagine" => $riga['NomeImmagine'],
                    "AltImmagine" => $riga['AltImmagine'],
                    "Descrizione" => $riga['Descrizione']
                );

                array_push($listaPersonaggi, $singoloPersonaggio);
            }

            return $listaPersonaggi;
        }
    }
}

?>