$(document).ready(() => {
    // $('.feature-block-1').mouseenter(() => {
    //     updatePositions(1);
    // });
    // $('.feature-block-1').mouseleave(() => {
    //     hide(1);
    // });
    // $('.feature-block-2').mouseenter(() => {
    //     updatePositions(2);
    // });
    // $('.feature-block-2').mouseleave(() => {
    //     hide(2);
    // });
    // $('.feature-block-3').mouseout(() => {
    //     updatePositions(3);
    // });
    // $('.feature-block-3').mouseleave(() => {
    //     hide(3);
    // });
});
window.onload = () => {
    // $('.feature-block-1 .shoot-box-left').attr("src", "data/img/shots/convert-old.png")
    // $('.feature-block-1 .shoot-box-right').attr("src", "data/img/shots/pages-actions.png")

    // $('.feature-block-2 .shoot-box-left').attr("src", "data/img/shots/edit-text.png")
    // $('.feature-block-2 .shoot-box-right').attr("src", "data/img/shots/edit-grades.png")

    // $('.feature-block-3 .shoot-box-left').attr("src", "data/img/shots/convert-old.png")
    // $('.feature-block-3 .shoot-box-right').attr("src", "data/img/shots/pages-actions.png")
}

function updatePositions(featureBlockIndex){
    
    $('.feature-block-' + featureBlockIndex + ' .shoot-box').width(getBoxWidth());
    $('.feature-block-' + featureBlockIndex + ' .shoot-box').css("top", index => {
        return getTop(featureBlockIndex);
    });
    $('.feature-block-' + featureBlockIndex + ' .shoot-box-left').css("left", -getBoxHidenWidth());
    $('.feature-block-' + featureBlockIndex + ' .shoot-box-right').css("right", -getBoxHidenWidth());

    $('.feature-block-' + featureBlockIndex + ' .shoot-box').show(300);
    
}
function hide(featureBlockIndex){
    $('.feature-block-' + featureBlockIndex + ' .shoot-box').hide(300);
    
}

function getBoxWidth(){
    return getSideSpace() + getBoxHidenWidth();
}
function getBoxHidenWidth(){
    return getSideSpace() / 100 * 0;
}
function getSideSpace(){
    return Math.min($('.feature-block .image-div').offset().left - 10, 320);
}
function getTop(featureBlockIndex){
    return $('.feature-block-' + featureBlockIndex).offset().top + $('.feature-block-' + featureBlockIndex).outerHeight()/2;
}

