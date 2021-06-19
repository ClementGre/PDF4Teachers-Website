$(document).ready(() => {

    // Switch preview feature
    const interval = 10;
    let status = 1;
    setInterval(() => {
        const img = $('.preview-block img');
        img.addClass("hidden");

        setTimeout(() => {
            if(status === 1){
                img.attr("src", "data/small-img/shots/grading.png")
            }else{
                img.attr("src", "data/small-img/shots/text-elements.png")
                status = 0;
            }
            status++;
            img.removeClass("hidden");
        }, 300);


    }, 1000 * interval);

});

