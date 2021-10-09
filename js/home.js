$(document).ready(() => {

    const previewImages = ["data/small-img/shots/text-elements.png", "data/small-img/shots/grading.png", "data/small-img/shots/vector-elements.png"]

    // Switch preview feature
    const interval = 10;
    let status = 0;
    setInterval(() => {
        const img = $('.preview-block img');
        img.addClass("hidden");

        setTimeout(() => {
            img.attr("src", previewImages[status])
            img.removeClass("hidden");

            status++;
            if(status >= previewImages.length){
                status = 0;
            }
        }, 300);

    }, 1000 * interval);

});

