/**
 * JavaScript part for the AJAX
 *
 * Author: Nils Lutz
 * Version: 0.1
 */

/**
 * using jQuery to perfom an AJAX request
 * @param element HTML element
 *
 *
 */
function showHint(element) {
  //die entsprechende dropdown id basteln. bsp: project -> #projects
  var element_id = "#" + element.id + "s";
  //das zusammenhaengende model basteln
  var model = element.id + "_model";

  $.ajax({
    type: 'GET',
    url: "show_Hint?entered=" + element.value + "&model=" + model,
    success: function (msg) {
      $(element_id).html(msg);
    }
  });

  return false;
}

/**
 * puts selected option into the textinput field
 * @param input_element
 * @param output_element
 *
 */
function putSelected (input_element) {
  var input_element_id = input_element.id;
  //es scheint dieser haessliche ausdruck doch unentbeherlich zu sein :)
  var output_element_id = input_element_id.substr(0, input_element_id.length-1); 
  var selected = document.getElementById(input_element_id).selectedOptions;
  document.getElementById(output_element_id).value = selected[0].text;

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
  if (y == null || y == "") {
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
  if (y == null || y == "") {
    alert("Last Name must be filled out");
    return false;
  }
  var y = document.forms['signup']['email'].value;
  if (y == null || y == "") {
    alert("EMail must be filled out");
    return false;
  }
  var z = document.forms['signup']['username'].value;
  if (z == null || z == "") {
    alert("Username must be filled out");
    return false;
  }
  var a = document.forms['signup']['password'].value;
  if (a == null || a == "") {
    alert("Password must be filled out");
    return false;
  }
  var b = document.forms['signup']['password_confirm'].value;
  if (b == null || b == "") {
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
//anderem benutzer geloescht werden koennen, ajax schafft nicht das mitzubekommen weil ajax letztlich durch action
//von dem selben user aktiviert ist wie onclick oder so. ein loeschvorgang von anderem user zaehlt offenbar nicht dazu
function showRow(obj) {
  if (obj.value != 0) {
    //isChoosed helperfunktion, verhindert mehrfachauswahl von einem eintrag
    if (isChoosed(obj)) {
      // table ergreifen
      var tab = document.getElementById('tab');
      // row inserten
      var row = tab.insertRow(tab.rows.length);
      // vier spalten schaffen
      var idCell = row.insertCell(row.cells.length);
      var nameCell = row.insertCell(row.cells.length);
      var buttonCell = row.insertCell(row.cells.length);
      var hiddenCell = row.insertCell(row.cells.length);
      // Inhalten einfuegen, einmal id und einmal name
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
  for (i = 0; i < document.getElementById('tab').rows.length; i++) {
    if (document.getElementById('tab').rows[i].cells[0].innerHTML == obj.value) {
      return false;
    }
  }
  return true;
}

/**
 * email und username beim signup validieren
 * @param element
 * @returns {boolean}
 */
function validating(element) {
    //die entsprechende span id basteln. bsp: email -> #check_email
    var check_element_id = "#check_" + element.id;

    //wenn es hier um email geht dann muss zuerst die format ueberpruefen
    if(element.id == 'email') {
        //regular expression
        var myreg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
        if(!myreg.test(element.value)) {
            //sollte die email ungueltig sein, dem user mitteilen und raus aus der function
            $(check_element_id).text('Please type a right email adress!');
            return false;
        }
    }

    if(element.value=="") {
        $(check_element_id).text('');
    }
    else {
        $.ajax({
            type: 'GET',
            url: "check_input?inputed=" + element.value + "&id=" + element.id,
            success: function (msg) {
                $(check_element_id).text(msg);
            }
        });
    }
}

