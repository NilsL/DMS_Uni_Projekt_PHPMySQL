/**
 * JavaScript part for the AJAX
 *
 *
 *
*/

/**
 * using jQuery to perfom an AJAX request
 *
 *
 *
 */
function showHint(str) {
    $.ajax({
        url: "show_Hint?entered=" + str,
        type: 'GET',
        success: function (msg) {
            $('#projects').html(msg);
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
function putSelected() {
    // ausgewählte option aus dem dropdown in var selected speichern
    // und dann in input field project einfügen
    var selected = document.getElementById("projects").selectedOptions;
    document.getElementById("project").value = selected[0].text;

}

/**
 * shows up a confirmation in signup view
 *
 *
 *
 */
function signupConfirm() {


}