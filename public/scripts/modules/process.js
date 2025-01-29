$(document).ready(function () {
    $("[data-trigger]").on("click", function () {
        let trigger = $(this).attr("data-trigger");
        let id = $(this).attr("data-id");

        switch (trigger) {
            case "download-zip":
                ajaxRequest("/execute/administrator/download", {
                    id: id,
                });
                break;

            default:
                ajaxRequest("/execute/administrator/process", {
                    action: trigger,
                    id: id,
                    notes: $(
                        $($(this).closest(".card")).find("textarea")[0]
                    ).val(),
                });
                break;
        }
    });

    $("[data-action]").on("click", function () {
        let trigger = $(this).attr("data-trigger");
        let id = $(this).attr("data-id");

        send_invite(id);
    });

    $("[data-key=doc-status]").on("change", function () {
        let status = $(this).val();

        $(".Pending, .Rejected, .Approved").hide();
        if (status != "all") $("." + status).show();
        else $(".Pending, .Rejected, .Approved").show();
    });
});

function send_invite(id) {
    ajaxRequest("/execute/administrator/invite", {
        applicant_id: id,
    });
}
