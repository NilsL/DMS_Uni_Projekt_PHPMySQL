/**
 * JavaScript part for the AJAX
 *
 * Author: Nils Lutz
 * Version: 0.1
 */

/**
 * using jQuery to perfom an AJAX request
 *
 *
 *
 */
//str ist jetzt der inputfeld-element
function showHint(str) {
	//die entsprechende dropdown id basteln. bsp: project -> #projects
	var auswahl = "#" + str.id + "s";
	//das zusammenhängende model basteln
	var model = str.id + "_model";
	
    $.ajax({
    	type: 'GET',
    	//zwei paras: eingabevalue und model
        url: "show_Hint?entered=" + str.value + "&model=" + model,
        success: function (msg) {
        	//var auswahl wird hier eingesetzt
          $(auswahl).html(msg);
        }
    });
    return false;
}

/**
 * puts selected option into the textinput field
 *
 *
 *
 */
//dropdown-element als para eingeleitet
function putSelected(obj) {
    // ausgew盲hlte option aus dem dropdown in var selected speichern
    // und dann in input field project einf眉gen
	//dropdown-id leicht zugreifen bsp: projects
	var objid = obj.id
    var selected = document.getElementById(objid).selectedOptions;
	//inputfeld-id durch string-manipulation kriegen. sieht zwar dumm aus aber was solls :) bsp: projects->project
	var inputid = objid.substr(0, objid.length-1);
    document.getElementById(inputid).value = selected[0].text;
    
}

/**
 * shows up a form validation
 * for login view
 *
 *
 */
function validateLogin() {
    var x = document.forms['login']['login'].value;
    if (x == null || x == "") {
        alert("Login must be filled out (Username or Email)");
        return false;
    }
    var y = document.forms['login']['password'].value;
    if (y== null || y == "") {
        alert("Password must be filled out");
        return false;
    }
}

/**
 * shows up a form validation
 * for signup view
 *
 *
 */
function validateSignUp() {
    var x = document.forms['signup']['first_name'].value;
    if (x == null || x == "") {
        alert("First Name must be filled out (Username or Email)");
        return false;
    }
    var y = document.forms['signup']['last_name'].value;
    if (y== null || y == "") {
        alert("Last Name must be filled out");
        return false;
    }
    var y = document.forms['signup']['email'].value;
    if (y== null || y == "") {
        alert("EMail must be filled out");
        return false;
    }
    var z = document.forms['signup']['username'].value;
    if (z== null || z == "") {
        alert("Username must be filled out");
        return false;
    }
    var a = document.forms['signup']['password'].value;
    if (a== null || a == "") {
        alert("Password must be filled out");
        return false;
    }
    var b = document.forms['signup']['password_confirm'].value;
    if (b== null || b == "") {
        alert("Password confirmation must be filled out");
        return false;
    }
}

/**
 * multiplechoice
 * for e.g. authos
 * pur javascript-tech
 *
 */
//warum hier findet ajax kein einsatz: weil die zwischengespeicherte auswahl sowieso jederzeit nach dem einfuegen von
//anderem benutzer geloescht werden, ajax schafft nicht das mitzubekommen weil ajax letztlich durch instant-action
//aktiviert ist wie onclick oder so. ein loeschvorgang von anderem user zaehlt offenbar nicht dazu
function showRow(obj) {
	if(obj.value !=0) {
		//isChoosed helperfunktion, verhindert mehrfachauswahl von einem eintrag
		if(isChoosed(obj)) {
			// table ergreifen
			var tab = document.getElementById('tab');
			// row inserten
			var row = tab.insertRow(tab.rows.length);
			// vier spalten schaffen
			var idCell = row.insertCell(row.cells.length);
			var nameCell = row.insertCell(row.cells.length);
			var buttonCell = row.insertCell(row.cells.length);
			var hiddenCell = row.insertCell(row.cells.length);
			// Inhalten einfügen, einmal id und einmal name
			idCell.innerHTML = obj.value;
			nameCell.innerHTML = obj.options[obj.selectedIndex].text;
			//loeschbutton
			buttonCell.innerHTML = '<input value="Delete" type="button" onclick="deleteRow(this)"/>';
			//ganz wichtig, dies hidden inputfeld speichert die Userauswahl
			hiddenCell.innerHTML = '<input type="hidden" name="hiddenid[]" value="' + obj.value + '" />';
		}
	}
}
//loeschfunktion
function deleteRow(obj) {
	var row = obj.parentNode.parentNode;
	var tab = row.parentNode;
	tab.deleteRow(row.rowIndex);
}
//diese funktion unterbindet dass die bereits ausgewaehlte record noch mal auszuwaehlen ist
function isChoosed(obj) {
	//ganze tabelle durchsuchen
    for (i=0; i < document.getElementById('tab').rows.length; i++) {              
    	if(document.getElementById('tab').rows[i].cells[0].innerHTML == obj.value) { 
            return false;
        }
    }
	return true;
}
