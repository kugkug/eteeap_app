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
});

function send_invite(id) {
    ajaxRequest("/execute/administrator/invite", {
        applicant_id: id,
    });
}
