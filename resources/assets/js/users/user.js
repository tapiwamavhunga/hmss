Livewire.hook("element.init", ({ component }) => {
    if (component.name == "user-table") {
        $("#userStatusArr,#userRoleArr").select2({
            width: "100%",
        });
    }
});
listen("change", "#userStatusArr", function () {
    Livewire.dispatch("changeFilter", { statusFilter: $(this).val() });
});

listen("change", "#userRoleArr", function () {
    Livewire.dispatch("changeRoleFilter", { roleFilter: $(this).val() });
});

listenClick(".delete-user-btn", function (event) {
    let userId = $(event.currentTarget).attr("data-id");
    deleteItem(
        $("#indexUserUrl").val() + "/" + userId,
        "#usersTable",
        $("#userLang").val()
    );
});

listenClick("#resetUserFilter", function () {
    $("#userRoleArr").val(0).trigger("change");
    $("#userStatusArr").val(0).trigger("change");
    hideDropdownManually($("#userFilterButton"), $(".dropdown-menu"));
});

listenClick(".show-user-btn", function (event) {
    let userId = $(event.currentTarget).attr("data-id");
    renderUsersData(userId);
});

window.renderUsersData = function (id) {
    $.ajax({
        url: route("users.show.modal", id),
        type: "GET",
        success: function (result) {
            if (result.success) {
                $("#userFirstName").text(result.data.first_name);
                $("#userLastName").text(result.data.last_name);
                $("#userEmail").text(result.data.email);
                $("#userShowRole").text(result.data.department.name);
                $("#userPhone").text(result.data.phone ?? "N/A");
                $("#userGender").text(result.data.gender_string);
                $("#userDob").text("");
                if (result.data.dob != null)
                    $("#userDob").text(
                        moment(result.data.dob).format("Mo MMM, YYYY")
                    );
                $("#userStatus").empty();
                if (result.data.status == 1) {
                    $("#userStatus").append(
                        '<span class="badge bg-light-success">' +
                            Lang.get("js.active") +
                            "</span>"
                    );
                } else {
                    $("#userStatus").append(
                        '<span class="badge bg-light-danger">' +
                            Lang.get("js.deactive") +
                            "</span>"
                    );
                }
                $("#UserCreatedOn").text(
                    moment(result.data.created_at).fromNow()
                );
                $("#userUpdatedOn").text(
                    moment(result.data.updated_at).fromNow()
                );
                $("#userProfilePicture").attr("src", result.data.image_url);

                setValueOfEmptySpan();
                $("#showUser").appendTo("body").modal("show");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

listen("change", ".is-verified-user", function (event) {
    let userId = $(event.currentTarget).attr("data-id");
    $.ajax({
        url: $("#indexUserUrl").val() + "/" + userId + "/is-verified",
        method: "post",
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.dispatch("refresh");
            }
        },
    });
});

listen("change", ".user-status", function (event) {
    let userId = $(event.currentTarget).attr("data-id");
    updateUserStatus(userId);
});

window.updateUserStatus = function (id) {
    $.ajax({
        url: $("#indexUserUrl").val() + "/" + id + "/active-deactive",
        method: "post",
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.dispatch("refresh");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
