// Créer une table HTML
function Insert()
{
	var nbLignes = document.getElementById("val_max").value;
	var table = document.createElement("table");
	table.style.width = "100%";

	// Créer une ligne de titre
	var titre = table.insertRow();
	var titreCell1 = titre.insertCell();
	titreCell1.innerHTML = "Mot";
	var titreCell2 = titre.insertCell();
	titreCell2.innerHTML = "Traduction";
	var titreCell3 = titre.insertCell();
	titreCell3.innerHTML = "Détails";

	// Ajouter n lignes à la table
	for (var i = 0; i < nbLignes; i++) {
	    var ligne = table.insertRow();

	    // Ajouter une cellule d'input pour chaque colonne, sauf la première qui affiche le numéro de la ligne
	    var cell1 = ligne.insertCell();
	    var input1 = document.createElement("input");
	    input1.type = "text";
	    input1.name = "input1_" + i;
	    cell1.appendChild(input1);
	    var cell2 = ligne.insertCell();
	    var input2 = document.createElement("input");
	    input2.type = "text";
	    input2.name = "input2_" + i;
	    cell2.appendChild(input2);
	    var cell3 = ligne.insertCell();
	    var input3 = document.createElement("input");
	    input3.type = "text";
	    input3.name = "input3_" + i;
	    cell3.appendChild(input3);
	}

	// Ajouter la table à un élément HTML existant
	var divTable = document.getElementById("divTable");
	divTable.appendChild(table);
}

function afficheA() {
    var div = document.getElementById("vocA");
    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
}

function afficheR() {
    var div = document.getElementById("vocR");
    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
}

