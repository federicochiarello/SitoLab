var dettagli_form = {
    "nome": ["Nome", /[a-zA-Z\ \']{2,20}$/, "Inserire il nome del personaggio"],
    "specializzazione": ["Specializzazione", /\w{2,50}$/, "Inserire la specializzazione"],
    "qi": ["Q.I. del personaggio", /\d{1,3}/, "Inserire il Q.I. del personaggio come valore numerico"],
    "descrizione": ["Descrizione del personaggio", /.{10,}/, "Inserire una descrizione"]
};

function campoDefault(input) {
    input.className = "deftext";
    input.value = dettagli_form[input.id][0];
}

function campoPerInput(input) {

    if (input.value == dettagli_form[input.id][0]) {
        input.value = "";
        input.className = "";
    }
}

function caricamento() {

    for (var key in dettagli_form) {
        var input = document.getElementById(key);
        campoDefault(input);
        input.onfocus = function() {campoPerInput(this);};
    }
}

function mostraErrore(input) {
    var elemento = document.createElement("strong");
    elemento.className = "errori";
    elemento.appendChild(document.createTextNode(dettagli_form[input.id][2]));

    var p = input.parentNode;
    p.appendChild(elemento);
}

function validazioneCampo(input) {
    
    // controllo se e' gia' presente messaggio d'errore
    var parent = input.parentNode;
    if (parent.children.length == 2) {
        parent.removeChild(parent.children[1]);
    }

    var regex = dettagli_form[input.id][1];
    var text = input.value;
    if (text.search(regex) != 0) { 
        // -1 se non trova il match, 0 se lo trova, 6 (es) se trova il match dalla posizione 6
        mostraErrore(input);
        
        return false;
    }
    else {
        return true;
    }
}

function validateForm() {

    var corretto = true;
    for (var key in dettagli_form) {
        var input = document.getElementById(key);
        var risultato = validazioneCampo(input);
        corretto = corretto && risultato;
    }

    return corretto;
}