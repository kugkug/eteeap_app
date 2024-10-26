$(document).ready(function () {
    if ($("[data-toggle=mode]").length) {
        $("[data-toggle=mode]").on("click", function () {
            let mode = "";
            let toggle = $($(this).find("i")[0]).attr("class");

            mode = toggle.indexOf("fas") > -1 ? "dark" : "light";

            ajaxRequest("/execute/settings", { theme_mode: mode });

            // $("body").toggleClass("dark-mode", { duration: 10 });

            // if (toggle.indexOf("fas") > -1) {
            //     mode = "dark";
            //     $($(this).find("i")[0]).removeClass("fas").addClass("far");
            //     $("aside")
            //         .removeClass("sidebar-light-info")
            //         .addClass("sidebar-dark-info", { duration: 100 });
            // } else {
            //     mode = "light";
            //     $($(this).find("i")[0]).removeClass("far").addClass("fas");
            //     $("aside")
            //         .removeClass("sidebar-dark-info")
            //         .addClass("sidebar-light-info", { duration: 100 });
            // }
        });
    }
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
            // if (result.status === "error") {
            //     console.log(result.info.message);
            //     _confirm("alert", result.info.message);
            // }
        },
        error: function (e) {
            $(".div-loader").hide();
            _confirm(
                "alert",
                "Cannot continue, please call system administrator!"
            );
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
        buttons: {
            confirm: {
                text: "Okay",
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
