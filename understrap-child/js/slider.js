(function($) {
    let imgArray = $(".entry-content img");
    console.log(imgArray);
    $.each(imgArray, function(i, img) {
        $("#carousel .carousel-inner").append(
            `<div class="carousel-item text-center">
                <img src="${$(img).attr("src")}">
             </div>`
        )
        $(img).remove();
    })
    $("#carousel").show();
}(jQuery));