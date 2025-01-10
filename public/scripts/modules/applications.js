$(document).ready(function () {
    if ($(".div-table-data").length) {
        _fetch("/execute/applications/list");
    }
});

function _fetch(targetUrl = "") {
    ajaxRequest(targetUrl, "", "");
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
