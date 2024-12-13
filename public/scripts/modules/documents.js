$(document).ready(function () {
    let file = $("[type=file]");

    if (file.length) {
        $(file).off();
        $(file).click();
        $(file).on("change", function (e) {
            var nSize = $(this).get(0).files[0].size;
            var sFileName = $(this).get(0).files[0].name;
            var sFullPath = URL.createObjectURL(e.target.files[0]);

            var aFileName = sFileName.split(".");
            var sFileType = aFileName[aFileName.length - 1].toLowerCase();

            var fSExt = new Array("Bytes", "KB", "MB", "GB"),
                h = 0;
            while (nSize > 900) {
                nSize /= 1024;
                h++;
            }

            var vFileName = "";
            var sInvalid = "";
            var sTooLarge = "";
            var sWrongCamp = "";

            var nExactSize = Math.ceil(Math.ceil(nSize * 100) / 100);
            var vSizeCat = fSExt[h];
            var sSize = nExactSize + "" + vSizeCat;

            if (sFileType != "pdf") {
                sInvalid += sFileName + " - " + sFileType + ".<br />";
            } else {
                if (h < 3) {
                    if (h == 2 && nExactSize > 25) {
                        sTooLarge += sFileName + " - " + sSize + ".<br />";
                    } else {
                        vFileName += sFileName + "\n\n";
                    }
                } else {
                    sTooLarge += sFileName + " - " + sSize + ".<br />";
                }
            }

            var sMessage = "";

            if (sInvalid != "") {
                sMessage +=
                    "<b>File/s Invalid Format:</b> <br />" +
                    sInvalid +
                    "<br /><br />";
            }

            if (sTooLarge != "") {
                sMessage +=
                    "<b>File/s Too Large:</b> <br />" +
                    sTooLarge +
                    "<br /><br />";
            }

            sMessage +=
                "Please be advised, this system can only accept PDF formatted file with up to 25MB max size.";

            if (sTooLarge != "" || sInvalid != "" || sWrongCamp != "") {
                $(this).val("");
                _systemAlert("alert", sMessage);
            } else {
                $("#file-to-upload").attr("src", sFullPath);

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
        let chosen_file = $($(".file-input"))[0].files[0];

        let form_data = new FormData();
        form_data.append("Document", chosen_file);

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
});
