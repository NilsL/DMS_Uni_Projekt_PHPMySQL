/**
 * Created by ikarus on 16.02.14.
 * jQuery Function to clear bootstrap modal after close
 */

$('#modal').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});
