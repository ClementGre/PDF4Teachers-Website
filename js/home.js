$(document).ready(() => {

    const previewImages = ["data/small-img/shots/text-elements.png", "data/small-img/shots/grading.png", "data/small-img/shots/vector-elements.png"]

    // Switch preview feature
    const interval = 10;
    let status = 0;
    setInterval(() => {
        status++;
        if(status >= previewImages.length){
            status = 0;
        }

        const img = $('.preview-block img');
        img.addClass("hidden");
        img.attr("src", previewImages[status])

        setTimeout(() => {
            img.removeClass("hidden");
        }, 300);

    }, 1000 * interval);

});

