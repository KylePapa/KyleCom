

$(window).scroll(function () {
    
    var wScroll = $(this).scrollTop();



//Scrolls Down
$('.postpl').css({
    'transform' : 'translate(0px, '+wScroll /4 +'%)'
});

//Scrolls Up
$('.confusedguypl').css({
'transform' : 'translate(0px, -'+wScroll /40 +'%)'
});
}
