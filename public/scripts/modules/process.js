$(document).ready(function () {
    $("[data-trigger=download-zip]").on("click", function () {
        let id = $(this).attr("data-id");

        ajaxRequest("/execute/administrator/download", {
            id: id,
        });
    });

    $("[data-key=doc-status]").on("change", function () {
        let status = $(this).val();

        $(".Pending, .Rejected, .Approved").hide();
        if (status != "all") $("." + status).show();
        else $(".Pending, .Rejected, .Approved").show();
    });

    $("[data-trigger=create-invite]").on("click", function () {
        $("#div-send-invitation").removeClass("d-none");
    });

    $("[data-trigger=send-bulk-email]").on("click", function (e) {
        e.preventDefault();

        let parentForm = $(this).closest("form");
        let json_data_form = JSON.parse(_collectFields(parentForm));

        ajaxRequest("/execute/administrator/batch-invite", {
            invited_ids: [$(this).attr("data-id")],
            ...json_data_form,
        });
    });
});
