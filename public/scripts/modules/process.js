$(document).ready(function () {
    $("[data-trigger]").on("click", function () {
        let trigger = $(this).attr("data-trigger");
        let id = $(this).attr("data-id");

        ajaxRequest("/execute/administrator/process", {
            action: trigger,
            id: id,
            notes: $($($(this).closest(".card")).find("textarea")[0]).val(),
        });
    });
});
