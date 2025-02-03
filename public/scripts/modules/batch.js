$(document).ready(function () {
    if ($(".div-table-data").length) {
        _fetch("/execute/applications/batch-list", { course: "" });
    }

    $("[data-key=Courses]").on("change", function () {
        _fetch("/execute/applications/batch-list", { course: $(this).val() });
    });
});

function _fetch(targetUrl = "", data) {
    ajaxRequest(targetUrl, data, "");
}

function _execWidget() {
    $("[data-trigger=batch-add]").off();
    $("[data-trigger=batch-add]").on("click", function () {
        let account_id = $(this).attr("data-id");
        let parentTr = $(this).closest("tr")[0];
        let tds = $(parentTr).find("td");
        let fullname = $(tds[0]).text();
        let course = $(tds[1]).text();

        $(parentTr).fadeOut();

        let add_elem = `<tr>
                        <td>
                            <button class="btn btn-danger btn-sm" data-id="${account_id}" data-trigger="batch-min"> 
                                <i class="fas fa-angle-double-left"></i> Remove
                            </button>
                        </td>
                        <td>${fullname}</td>
                        <td>${course}</td>
                    </tr>`;

        $(".div-table-batch").append(add_elem);
        _execWidget();
    });

    $("[data-trigger=batch-min]").off();
    $("[data-trigger=batch-min]").on("click", function () {
        let account_id = $(this).attr("data-id");
        let parentTr = $(this).closest("tr")[0];
        $(parentTr).fadeOut(500, function () {
            $(parentTr).remove();
        });

        $($(`[data-id=${account_id}]`).closest("tr")).fadeIn();
        // $(".div-table-data").append(add_elem);
        _execWidget();
    });
}
