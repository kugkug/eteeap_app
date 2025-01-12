$(document).ready(function () {
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let parentForm = $(this).closest("form");

        switch (trigger) {
            case "update":
                if (!_checkFormFields(parentForm)) {
                    _systemAlert(
                        "warning",
                        "Please complete the required fields!"
                    );
                    return;
                }
                let data_form_update = JSON.parse(_collectFields(parentForm));
                data_form_update = {
                    ...data_form_update,
                    Id: $(this).attr("data-id"),
                };
                ajaxRequest(
                    "/execute/applicants/profile_update",
                    data_form_update,
                    $(this)
                );
                break;
        }
    });
});
