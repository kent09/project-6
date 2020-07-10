(function($) {

    $('#main-menu > li').mouseenter(function() {
        if(!$(this).first().children('ul').is(':visible')) {


            // $(this).first().children('ul').slideDown('fast');

            $(this).first().children('ul').show().animate(
                { 
                    'height' : menuHeight(),
                }, 'slow');

            // menuHeight($(this).first().children('ul'));
        }
    });

    $('#main-menu > li').mouseleave(function() {
        if($(this).first().children('ul').is(':visible')) {
            // $(this).first().children('ul').slideUp('fast');
            $(this).first().children('ul').hide();
        }
    });

    $("#main-menu > li > ul > li").hover(
        function() {
            resizeAllGridItems();
            $(this).first().children('ul').height(menuHeight() - 40);
        }, function() {
            resizeAllGridItems();
            // $(this).first().children('ul').height(0);
        }
    );

    function menuHeight() {
        let menuHoverHeight = $('body').height() - (
                $('.signup-wrapper').outerHeight() + 
                $('#wrapper-footer').outerHeight() + 
                $('#wrapper-navbar').outerHeight());
        return menuHoverHeight;
    }

})( jQuery );


function resizeGridItem(item){
    grid = document.querySelectorAll("#main-menu > li > ul > li > ul")[0];
    rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
    rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
    rowSpan = Math.ceil((item.querySelector('ul').getBoundingClientRect().height+item.querySelector('a').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
    item.style.gridRowEnd = "span "+rowSpan;
}

function resizeAllGridItems(){
  allItems = document.querySelectorAll("#main-menu > li > ul > li > ul > li");
  for(x=0;x<allItems.length;x++){
    resizeGridItem(allItems[x]);
  }
}

// window.onload = resizeAllGridItems();
// window.addEventListener("resize", resizeAllGridItems);
