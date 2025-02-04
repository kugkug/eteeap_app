$(document).ready(function () {
    if ($(".div-table-data").length) {
        _fetch("/execute/applications/batch-list", { course: "" });
    }

    $("[data-key=Courses]").on("change", function () {
        _fetch("/execute/applications/batch-list", { course: $(this).val() });
    });

    $("[data-trigger=create-invite]").on("click", function () {
        let invited = _getInvited();
        if (invited.length > 0) {
            $("#div-send-invitation").removeClass("d-none");
        } else {
            _systemAlert("alert", "No Application Selected!");
        }
    });

    $("[data-trigger=send-bulk-email]").on("click", function (e) {
        e.preventDefault();
        let invited = _getInvited();
        let parentForm = $(this).closest("form");

        let json_data_form = JSON.parse(_collectFields(parentForm));
        if (invited.length > 0) {
            ajaxRequest("/execute/administrator/batch-invite", {
                invited_ids: invited,
                ...json_data_form,
            });
        } else {
            _systemAlert("alert", "No Application Selected!");
        }
    });
});

function _fetch(targetUrl = "", data) {
    ajaxRequest(targetUrl, data, "");
}

function _getInvited() {
    let parentTrs = $(".div-table-batch").find("tr");
    let account_ids = [];

    for (const parentTr of parentTrs) {
        let tds = $(parentTr).find("td");
        let btn = $(tds[0]).find("button")[0];

        account_ids.push($(btn).attr("data-id"));
    }

    return account_ids;
}

function _execWidget() {
    $("[data-trigger=batch-add]").off();
    $("[data-trigger=batch-add]").on("click", function () {
        let account_id = $(this).attr("data-id");
        let parentTr = $(this).closest("tr")[0];
        let tds = $(parentTr).find("td");
        let fullname = $(tds[0]).text();
        let course = $(tds[1]).text();

        $(parentTr).hide();

        let add_elem = `<tr>
                        <td>
                            <button class="btn btn-danger" data-id="${account_id}" data-trigger="batch-min"> 
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
        $(parentTr).remove();
        $($(`[data-id=${account_id}]`).closest("tr")).show();

        if (_getInvited().length <= 0) {
            $("#div-send-invitation").removeClass("d-none").addClass("d-none");
        }
        _execWidget();
    });
}
