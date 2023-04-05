$(document).ready(function () {
    $("#usersTable").DataTable();
});

$(document).ready(function() {
    $('#rolesTable').DataTable();
});

$(".togglePassword").click(function (e) {
    e.preventDefault();
    var type = $(this).parent().parent().find(".password").attr("type");
    if (type == "password") {
        $(this).removeClass("fa-eye-slash");
        $(this).addClass("fa-eye");
        $(this).parent().parent().find(".password").attr("type", "text");
    } else if (type == "text") {
        $(this).removeClass("fa-eye");
        $(this).addClass("fa-eye-slash");
        $(this).parent().parent().find(".password").attr("type", "password");
    }
});

$(".toggleNewPassword").click(function (e) {
    e.preventDefault();
    var type = $(this).parent().parent().find(".newPassword").attr("type");
    if (type == "password") {
        $(this).removeClass("fa-eye-slash");
        $(this).addClass("fa-eye");
        $(this).parent().parent().find(".newPassword").attr("type", "text");
    } else if (type == "text") {
        $(this).removeClass("fa-eye");
        $(this).addClass("fa-eye-slash");
        $(this).parent().parent().find(".newPassword").attr("type", "password");
    }
});

$(".toggleCurrentPassword").click(function (e) {
    e.preventDefault();
    var type = $(this).parent().parent().find(".currentPassword").attr("type");
    if (type == "password") {
        $(this).removeClass("fa-eye-slash");
        $(this).addClass("fa-eye");
        $(this).parent().parent().find(".currentPassword").attr("type", "text");
    } else if (type == "text") {
        $(this).removeClass("fa-eye");
        $(this).addClass("fa-eye-slash");
        $(this)
            .parent()
            .parent()
            .find(".currentPassword")
            .attr("type", "password");
    }
});

$(".toggleConfirmNewPassword").click(function (e) {
    e.preventDefault();
    var type = $(this)
        .parent()
        .parent()
        .find(".confirmNewPassword")
        .attr("type");
    if (type == "password") {
        $(this).removeClass("fa-eye-slash");
        $(this).addClass("fa-eye");
        $(this)
            .parent()
            .parent()
            .find(".confirmNewPassword")
            .attr("type", "text");
    } else if (type == "text") {
        $(this).removeClass("fa-eye");
        $(this).addClass("fa-eye-slash");
        $(this)
            .parent()
            .parent()
            .find(".confirmNewPassword")
            .attr("type", "password");
    }
});

// nested checkbox
$(document).ready(function () {
    $("ul.menu_list input[type=checkbox]").on("change", function () {
        var checkboxValue = $(this).prop("checked");
        //call the recursive function for the first time
        decideParentsValue($(this));
        //Compulsorily apply check value Down in DOM
        $(this)
            .closest("li")
            .find(".children input[type=checkbox]")
            .prop("checked", checkboxValue);
    });

    //the recursive function
    function decideParentsValue(me) {
        var shouldTraverseUp = false;
        var checkedCount = 0;
        var myValue = me.prop("checked");

        //inspect my siblings to decide parents value
        $.each($(me).closest(".children").children("li"), function () {
            var checkbox = $(this).children("input[type=checkbox]");
            if ($(checkbox).prop("checked")) {
                checkedCount = checkedCount + 1;
            }
        });

        //if I am checked and my siblings are also checked do nothing
        //OR
        //if I am unchecked and my any sibling is checked do nothing
        if (
            (myValue == true && checkedCount == 1) ||
            (myValue == false && checkedCount == 0)
        ) {
            shouldTraverseUp = true;
        }
        if (shouldTraverseUp == true) {
            var inputCheckBox = $(me)
                .closest(".children")
                .siblings("input[type=checkbox]");
            inputCheckBox.prop("checked", me.prop("checked"));
            decideParentsValue(inputCheckBox);
        }
    }
});
// end of nested checkbox
