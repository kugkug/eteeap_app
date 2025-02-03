$(document).ready(function () {
    let file = $("[type=file]");

    $("[data-trigger]").on("click", function () {
        let trigger = $(this).attr("data-trigger");
        let id = $(this).attr("data-id");

        ajaxRequest("/execute/document/remove", {
            action: trigger,
            id: id,
        });
    });

    if (file.length) {
        $(file).off();
        $(file).click();
        $(file).on("change", function (e) {
            let fileLength = $(this).get(0).files.length;
            let files = $(this).get(0).files;
            let invalidCnt = 0;
            let iframes = "";
            let idCnt = 0;

            for (const file of files) {
                let nSize = file.size;
                var sFileName = file.name;
                let sFullPath = URL.createObjectURL(file);

                let aFileName = sFileName.split(".");
                let sFileType = aFileName[aFileName.length - 1].toLowerCase();

                var fSExt = new Array("Bytes", "KB", "MB", "GB"),
                    h = 0;
                while (nSize > 900) {
                    nSize /= 1024;
                    h++;
                }

                var nExactSize = Math.ceil(Math.ceil(nSize * 100) / 100);
                var vSizeCat = fSExt[h];
                var sSize = nExactSize + "" + vSizeCat;

                if (sFileType != "pdf") {
                    invalidCnt++;
                } else {
                    if (h < 3) {
                        if (h == 2 && nExactSize > 25) {
                            invalidCnt++;
                        }
                    } else {
                        invalidCnt++;
                    }
                }

                let selId = "sel-req-type-" + idCnt;
                iframes += `
                                <div class="card card-outline card-primary" id="div-document-${idCnt}">
                                    <div class="card-header">
                                        ${dropReqTypes(selId)}
                                    </div>
                                    <div class="card-body">
                                        <iframe src="${sFullPath}" frameborder="0" height="650" style="width: 100%;" class='mt-2'></iframe>
                                    </div>
                                </div>
                                `;
                idCnt++;
            }

            if (invalidCnt > 0) {
                _systemAlert(
                    "alert",
                    "Please be advised, this system can only accept PDF formatted file with up to 25MB max size."
                );

                $(".card-footer").removeClass("d-none").addClass("d-none");
                $("#file-to-upload")
                    .closest("div.row")
                    .removeClass("d-none")
                    .addClass("d-none");
                $(".file-drop-area").closest("div.row").removeClass("d-none");
            } else {
                $("#file-to-upload").html(iframes);

                $(".card-footer").removeClass("d-none");
                $("#file-to-upload").closest("div.row").removeClass("d-none");
                $(".file-drop-area").closest("div.row").addClass("d-none");
            }
        });
    }

    $("#btn-upload").off();
    $("#btn-upload").on("click", function (e) {
        e.preventDefault();
        let parentForm = $(this).closest("form");
        let chosen_files = $($(".file-input"))[0].files;

        let form_data = new FormData();

        for (let x = 0; x < chosen_files.length; x++) {
            let chosen_file = chosen_files[x];
            let req_type = $("#sel-req-type-" + x).val();

            console.log(req_type);
            form_data.append("Types[]", req_type);
            form_data.append("Documents[]", chosen_file);
        }

        ajaxSubmit("/execute/document/upload", form_data, $(this));
    });

    $("#btn-reset").off();
    $("#btn-reset").on("click", function () {
        location.reload();
    });

    $("[data-link]").off();
    $("[data-link]").on("click", function () {
        let link = $(this).attr("data-link");

        $("#file-to-view").attr("src", link);
    });

    $("[data-key=doc-status]").on("change", function () {
        let status = $(this).val();

        $(".Pending, .Rejected, .Approved").hide();
        if (status != "all") $("." + status).show();
        else $(".Pending, .Rejected, .Approved").show();
    });
});

function dropReqTypes(elem_id) {
    let req_types = $("#txtReqTypes").val().split("||");
    let dropdown = `
        <select class="form-control" id="${elem_id}">
            <option value="">Select Requirement Type</option>
    `;

    for (const req_type of req_types) {
        let types = req_type.split("|");

        dropdown += `<option value="${types[0]}">${types[1]}</option>`;
    }
    dropdown += `</select>`;

    return dropdown;
}
