$(document).ready(function () {
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let parentForm = $(this).closest("form");

        switch (trigger) {
            case "submit":
                if (!_checkFormFields(parentForm)) {
                    _systemAlert(
                        "warning",
                        "Please complete the required fields!"
                    );
                    return;
                }

                let json_data_form = JSON.parse(_collectFields(parentForm));
                console.log(json_data_form);
                ajaxRequest(
                    "/execute/otp/verify-email",
                    json_data_form,
                    $(this)
                );
                break;
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
                    "/execute/players/update",
                    data_form_update,
                    $(this)
                );
                break;
        }
    });
});
