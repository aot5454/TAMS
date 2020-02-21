$(document).ready(function() {
    $("#repassword").keyup(validate);
    $("#password").keyup(chackCharLen);

    $("#repass").keyup(validate2);
    $("#pass").keyup(chackCharLen2);

    $('body').tooltip({
        selector: "[data-tooltip=tooltip]",
        container: "body"
    });
});

// Chack len password
function chackCharLen() {
    var password1 = $("#password").val();
    var password2 = $("#repassword").val();
    var lenPass = password1.length;

    if (lenPass < 8 || lenPass > 20) {
        // INVALID
        $("#password").addClass('is-invalid');

        $("#passwordHelpBlock")
            .removeClass()
            .addClass('invalid-feedback d-block');

        $("#btnSubmitAdd").attr("disabled", true);
    } else {
        // VALID
        $("#password")
            .removeClass('is-invalid')
            .addClass('is-valid');

        $("#passwordHelpBlock")
            .removeClass('invalid-feedback d-block');

        if (password1 === password2) {
            $("#btnSubmitAdd").attr("disabled", false);
        }
    }
}

// Chack len password for model edit
function chackCharLen2() {
    var password1 = $("#pass").val();
    var password2 = $("#repass").val();
    var lenPass = password1.length;

    if (lenPass < 8 || lenPass > 20) {
        // INVALID
        $("#pass").addClass('is-invalid');

        $("#passwordHelpBlock2")
            .removeClass()
            .addClass('invalid-feedback d-block');

        $("#btnSubmitEdit").attr("disabled", true);
    } else {
        // VALID
        $("#pass")
            .removeClass('is-invalid')
            .addClass('is-valid');

        $("#passwordHelpBlock2")
            .removeClass('invalid-feedback d-block');

        if (password1 === password2) {
            $("#btnSubmitEdit").attr("disabled", false);
        }
    }
}

// Chack password
function validate() {
    var password1 = $("#password").val();
    var password2 = $("#repassword").val();

    if (password2 == "" || password2 == null) {
        // INVALID and NULL
        $("#validate-status")
            .removeClass('invalid-feedback d-block')
            .text("");
        $("#repassword")
            .removeClass('is-invalid')
            .removeClass('is-valid');
        $("#btnSubmitAdd").attr("disabled", true);
    } else {

        if (password1 == password2) {
            // VALID
            $("#validate-status")
                .text('Password match.')
                .removeClass()
                .addClass('valid-feedback d-block');

            $("#repassword")
                .removeClass('is-invalid')
                .addClass('is-valid');

            $("#btnSubmitAdd").attr("disabled", false);
        } else {
            // INVALID
            $("#validate-status")
                .text('Password not match.')
                .removeClass()
                .addClass('invalid-feedback d-block');

            $("#repassword").addClass('is-invalid');

            $("#btnSubmitAdd").attr("disabled", true);
        }
    }

}

// Chack password EditUser
function validate2() {
    var password1 = $("#pass").val();
    var password2 = $("#repass").val();

    if (password2 == "" || password2 == null) {
        // INVALID and NULL
        $("#validate-status2")
            .removeClass('invalid-feedback d-block')
            .text("");
        $("#repass")
            .removeClass('is-invalid')
            .removeClass('is-valid');
        $("#btnSubmitEdit").attr("disabled", true);
    } else {

        if (password1 == password2) {
            // VALID
            $("#validate-status2")
                .text('Password match.')
                .removeClass()
                .addClass('valid-feedback d-block');

            $("#repass")
                .removeClass('is-invalid')
                .addClass('is-valid');

            $("#btnSubmitEdit").attr("disabled", false);
        } else {
            // INVALID
            $("#validate-status2")
                .text('Password not match.')
                .removeClass()
                .addClass('invalid-feedback d-block');

            $("#repass").addClass('is-invalid');

            $("#btnSubmitEdit").attr("disabled", true);
        }
    }

}

// Model DEL User
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

$('#editUser').on('show.bs.modal', function(e) {
    var userid = $(e.relatedTarget).data('userid');
    var username = $(e.relatedTarget).data('username');
    var password = $(e.relatedTarget).data('password');
    var status = $(e.relatedTarget).data('status');



    $(e.currentTarget).find('input[name="user_id"]').val(userid);
    $(e.currentTarget).find('input[name="pass_old"]').val(password);
    $(e.currentTarget).find('input[name="uname"]').val(username);
    $(e.currentTarget).find('select[name="statusEdit"]').val(status)
});


// Model change on off post
$('#confirmOnOff').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});


$('#confirmStatusNisitAllow').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

$('#confirmStatusNisitDeny').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

// Chack Btn submit reg
$('#btnSubmitReg').attr("disabled", true);
$('#submitReg').on('click', function() {
    if ($(this).is(":checked")) {
        //alert("Checkbox is checked.");
        $('#btnSubmitReg').attr("disabled", false);
    } else if ($(this).is(":not(:checked)")) {
        //alert("Checkbox is unchecked.");
        $('#btnSubmitReg').attr("disabled", true);
    }
});