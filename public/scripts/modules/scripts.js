$(document).ready(function () {
    $(".div-requirements img").on("click", function () {
        let src = $(this).attr("src");
        $(".div-viewer").html(`<img src='${src}'/>`);
    });
});
