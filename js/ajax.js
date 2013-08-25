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
    var selected = document.getElementById(objid).selectedOptions;
	//dropdown-id leicht zugreifen bsp: projects
	var objid = obj.id
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