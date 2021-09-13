


function modal_edit_empty() { //Validacion del modal en edicion de un usuario.

    var name_edit = document.getElementById("name-modal-edit").value;
    var user_edit = document.getElementById("user-modal-edit").value;
    var password_edit = document.getElementById("password-modal-edit").value;
    var email_edit = document.getElementById("email-modal-edit").value;

    if (name_edit == "" || user_edit == "" || password_edit == "" || email_edit == "") {

        return false;

    }
    return true;
}



