$(document).ready(function () {
    if ($(".div-table-data").length) {
        _fetch("/execute/applications/list", { course: "" });
    }

    $("[data-key=Courses]").on("change", function () {
        _fetch("/execute/applications/list", { course: $(this).val() });
    });

    $("[data-trigger=download-pdf]").on("click", function () {
        _fetch("/execute/administrator/download-pdf", {
            course: $("[data-key=Courses]").val(),
        });
    });
});

function _fetch(targetUrl = "", data) {
    ajaxRequest(targetUrl, data, "");
}

function _execWidget() {
    if ($(".page-link").length > 0) {
        $(".page-link").off();
        $(".page-link").on("click", function (e) {
            e.preventDefault();
            let pageno = $(this).attr("data-page");
            _fetch("/execute/applications/list?" + pageno);
        });
    }

    if ($("[data-delete]").length) {
        $("[data-delete]").off();
        $("[data-delete]").on("click", function (e) {
            e.preventDefault();
            let employee_id = $(this).attr("data-delete");

            _confirm(
                "alert",
                "Are you sure you want to deactivate this account?"
            );
        });
    }

    if ($("[data-reset]").length) {
        $("[data-reset]").off();
        $("[data-reset]").on("click", function (e) {
            e.preventDefault();
            let employee_id = $(this).attr("data-reset");

            ajaxRequest(
                "/execute/players/reset-password",
                { Id: employee_id },
                $(this)
            );
        });
    }
}
