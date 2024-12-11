$(document).ready(function () {
    $(".div-requirements img").on("click", function () {
        let src = $(this).attr("src");
        $(".div-viewer").html(`<img src='${src}'/>`);
    });
});

function ajaxRequest(sUrl = "", sData = "", sLoadParent = "") {
    $.ajax({
        url: sUrl,
        type: "POST",
        headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") },
        data: sData,
        beforeSend: function () {
            $(".div-loader").show();
        },
        success: function (result) {
            $(".div-loader").hide();
            console.log(result);
            eval(result.js);
        },
        error: function (e) {
            console.log(e);
            $(".div-loader").hide();
            _confirm(
                "alert",
                "Cannot continue, please call system administrator!"
            );
        },
    });
}

function ajaxSubmit(sUrl = "", sFormData = "", sLoadParent = "") {
    $.ajax({
        url: sUrl,
        type: "POST",
        headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") },
        data: sFormData,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(".div-loader").show();
        },
        success: function (result) {
            $(".div-loader").hide();
            console.log(result);
            eval(result.js);
        },
        error: function (e) {
            console.log(e);
            $(".div-loader").hide();
            _confirm(
                "alert",
                "Cannot continue, please call system administrator!"
            );
        },
    });
}

function _checkFormFields(parentForm) {
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $(parentForm).find("input, textarea, select");

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];
        var sValue = $(sElement).val();
        var sData = $(sElement).attr("data");

        if ($(sElement).is(":visible")) {
            if (sData != "exclude") {
                if (sData == "req") {
                    if (sValue == "") {
                        $(sElement).addClass(" is-invalid ");
                        nEmpty++;
                    } else {
                        $(sElement).removeClass(" is-invalid ");
                    }
                }
            }
        }
    }

    if (nEmpty > 0) return false;
    else return true;
}

function _collectFields(parentForm) {
    var sJsonFields = {};
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $(parentForm).find(
        "input:not(:checkbox):not(:radio), textarea, select"
    );

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];

        var sDataKey = $(sElement).attr("data-key");
        var sValue = $(sElement).val();

        if ($(sElement).is(":visible") === true) {
            if (sDataKey) {
                sJsonFields[sDataKey] = sValue;
            }
        }
    }

    return JSON.stringify(sJsonFields);
}

function _systemAlert(type, message) {
    let color = "";
    let icon = "";
    let title = "";

    switch (type) {
        case "alert":
            color = "red";
            icon = "fa fa-exclamation";
            title = "System Alert";
            break;

        case "warning":
            color = "orange";
            icon = "fa fa-exclamation";
            title = "System Alert";
            break;

        case "info":
            color = "green";
            icon = "fas fa-info-circle";
            title = "System Notification";
            break;
    }

    $.alert({
        title: title,
        icon: icon,
        type: color,
        theme: "light",
        content: message,
        buttons: {
            confirm: {
                text: "Okay",
                btnClass: "btn btn-primary",
            },
        },
    });
}

function _confirmAdd(content, url) {
    $.confirm({
        title: "System Notification",
        content: content,
        icon: "fas fa-info-circle",
        type: "green",
        animation: "scale",
        closeAnimation: "scale",
        opacity: 0.5,
        theme: "light",
        buttons: {
            confirm: {
                text: "Add More",
                btnClass: "btn btn-primary",
                action: function () {
                    location.reload();
                },
            },
            moreButtons: {
                text: "Back to List",
                btnClass: "btn-red",
                action: function () {
                    location = url;
                },
            },
        },
    });
}

function _confirmUpdate(content, url) {
    $.confirm({
        title: "System Notification",
        content: content,
        icon: "fas fa-info-circle",
        type: "green",
        animation: "scale",
        closeAnimation: "scale",
        opacity: 0.5,
        theme: "light",
        buttons: {
            confirm: {
                text: "Ok",
                btnClass: "btn btn-primary",
                action: function () {
                    location = url;
                },
            },
        },
    });
}

function _confirm(type, content) {
    let color = "";

    switch (type) {
        case "alert":
            color = "red";
            break;

        case "info":
            color = "green";
            break;

        case "confirm":
            color = "warning";
            break;
    }

    $.confirm({
        title: "System Notification",
        content: content,
        icon: "fa fa-exclamation",
        type: color,
        animation: "scale",
        closeAnimation: "scale",
        opacity: 0.5,
        theme: "light",
        buttons: {
            confirm: {
                text: "Ok",
                btnClass: "btn btn-primary",
                // action: function () {
                //     _conTinue(sAction, sJsonData);
                // },
            },
            // moreButtons: {
            //     text: "No",
            //     btnClass: "btn-red",
            //     // action: function () {},
            // },
        },
    });
}
