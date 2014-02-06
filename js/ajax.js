/**
 * JavaScript part for the AJAX
 *
 * Author: Nils Lutz
 * Version: 0.1
 */

/**
 * using jQuery to perfom an AJAX request
 * @param element HTML element
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
 */
function putSelected(input_element) {
  var input_element_id = input_element.id;
  var output_element_id = input_element_id.substr(0, input_element_id.length - 1);
  var sel = document.getElementById(input_element_id).options[input_element.selectedIndex];
  document.getElementById(output_element_id).value = sel.text;

}

/**
 * shows up a form validation
 * for login view
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
 */
function validateSignUp() {
  var a = document.forms['signup']['first_name'].value;
  if (a == null || a == "") {
    alert("First Name must be filled out");
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
  if (e != null && e != "" && e != "The email can be used!") {
    alert(e);
    return false;
  }
  var f = document.getElementById('check_username').innerHTML;
  if (f != null && f != "" && f != "The username can be used!") {
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
  if (f != null && f != "" && f != "passwords match!") {
    alert(f);
    return false;
  }
}

/**
 * shows up a form validation
 * for Insert view
 * @returns {boolean}
 */
function validateInsert() {
    //Falls Bemerkungen generiert wurde
    var a = document.getElementsByTagName('span');
    for(var i=0; i< a.length; i++) {
        if(a[i].innerHTML!="") {
            alert(a[i].innerHTML);
            return false;
        }
    }
}

/**
 * email und username beim signup validieren
 * @param element
 * @returns {boolean}
 */
function validateSignInWithDb(element) {
    var check_element_id = "#check_" + element.id;
    if (element.id == 'username') {
        if (element.value.length < 6 && element.value.length > 0) {
            $(check_element_id).text('Username must have at least 6 characters!');
            return false;
        }
    }
    if (element.id == 'email') {
        var myreg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
        if (!myreg.test(element.value) && element.value.length > 0) {
            $(check_element_id).text('Please type a right email adress!');
            return false;
        }
    }

        $.ajax({
            type: 'GET',
            url: 'check_input?inputed=' + element.value + '&id=' + element.id,
            success: function (msg) {
                $(check_element_id).text(msg);
            }
        });

    if (element.value.length == 0) {
        $(check_element_id).text('');
    }

}

/**
 * insert werte validieren
 * @param element
 * @returns {boolean}
 */
function validateInsertsWithDb(element) {
    var check_element_id = "#check_" + element.id;
    if (element.id == 'author_mail') {
        var myreg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
        if (!myreg.test(element.value) && element.value.length > 0) {
            $(check_element_id).text('Please type a right email adress!');
            return false;
        }
    }
    if (element.id == 'project_number') {
        var myreg = /^[0-9,]*$/;
        if (!myreg.test(element.value) && element.value.length > 0) {
            $(check_element_id).text('The number must be numeric!');
            return false;
        }
    }

        $.ajax({
            type: 'GET',
            url: 'insert/check_input?inputed=' + element.value + '&id=' + element.id,
            success: function (msg) {
                $(check_element_id).text(msg);
            }
        });

    if (element.value.length == 0) {
        $(check_element_id).text('');
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
  if (password.length > 0 && password.length < 6) {
    $("#check_password_confirm").text('password must have at least 6 characters!');
  }
  else if (password.length == 0) {
    $("#check_password_confirm").text('');
  }
  else if (password.length > 32) {
      $("#check_password_confirm").text('The password should have maximal 32 characters!');
  }
  else {
    //ueberpruefen ob beide inputs uebereinstimmt
    if (confirm == password) {
      $("#check_password_confirm").text('passwords match!');
    }
    else if (confirm.length > 0) {
      $("#check_password_confirm").text('passwords not match!');
    }
    else {
      $("#check_password_confirm").text('');
    }
  }
}

