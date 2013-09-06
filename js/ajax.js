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
  var a = document.forms['signup']['first_name'].value;
  if (a == null || a == "") {
    alert("First Name must be filled out (Username or Email)");
    return false;
  }
  var b = document.forms['signup']['last_name'].value;
  if (b == null || b == "") {
    alert("Last Name must be filled out");
    return false;
  }
  var c = document.forms['signup']['email'].value;
  if (c == null || c == "") {
    alert("EMail must be filled out");
    return false;
  }
  var d = document.forms['signup']['username'].value;
  if (d == null || d == "") {
    alert("Username must be filled out");
    return false;
  }
  var e = document.getElementById('check_email').innerHTML;
  if (e != null && e != "" && e!="The email can be used!") {
       alert(e);
       return false;
  }
  var f = document.getElementById('check_username').innerHTML;
  if (f != null && f != "" && f!="The username can be used!") {
      alert(f);
      return false;
  }
  var g = document.forms['signup']['password'].value;
  if (g == null || g == "") {
    alert("Password must be filled out");
    return false;
  }
  var h = document.forms['signup']['password_confirm'].value;
  if (h == null || h == "") {
    alert("Password confirmation must be filled out");
    return false;
  }
  var f = document.getElementById('check_password_confirm').innerHTML;
  if (f != null && f != "" && f!="passwords match!") {
    alert(f);
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
    if(element.id == 'email' || element.id == 'author_mail') {
        //regular expression
        var myreg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
        if(!myreg.test(element.value) && element.value.length > 0) {
            //sollte die email ungueltig sein, dem user mitteilen und raus aus der function
            $(check_element_id).text('Please type a right email adress!');
            return false;
        }
    }

    //wenn es hier hingegen um username handelt dann muss es mind. 6 character enthalten
    if(element.id == 'username') {
        if(element.value.length < 6 && element.value.length > 0) {
            $(check_element_id).text('Username must have at least 6 characters!');
            return false;
        }
    }

    //wenn es hier um project number geht, regular expression aufbauen um es numerisch zu sichern
    if(element.id == 'project_number') {
        //regular expression
        var myreg = /^[0-9,]*$/;
        if(!myreg.test(element.value) && element.value.length > 0) {
            //sollte die email ungueltig sein, dem user mitteilen und raus aus der function
            $(check_element_id).text('The number must be numeric!');
            return false;
        }
    }

    if(element.value.length == 0) {
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

/**
 * js technik, um die uebereinstimmigkeit von den passwords zu ueberpruefen
 * @param element
 */
function matching() {
    var confirm = document.getElementById('password_confirm').value;
    var password = document.getElementById('password').value;

    //wenn eines von den beiden password-eingabefeldern nicht belegt ist dann nichts anzeigen
    if(password.length > 0 && password.length < 6) {
        $("#check_password_confirm").text('password must have at least 6 characters!');
    }
    else if(password.length == 0) {
        $("#check_password_confirm").text('');
    }
    else {
        //ueberpruefen ob beide inputs uebereinstimmt
        if(confirm == password) {
            $("#check_password_confirm").text('passwords match!');
        }
        else if(confirm.length > 0) {
            $("#check_password_confirm").text('passwords not match!');
        }
        else {
            $("#check_password_confirm").text('');
        }
    }
}

