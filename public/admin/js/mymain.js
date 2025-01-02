
let fourthColor = '#FFF';

$(document).ready(function () {

    /*** Start Nav ***/

    $(window).scroll(function() {
        if ($(this).scrollTop() > 10) {
            $('.header.header-sticky').css({'background-color' : fourthColor, 'box-shadow' : '0px 0px 10px #CCC'});
        } else {
            $('.header.header-sticky').css({'background-color' : 'transparent', 'box-shadow' : 'none'});
        }
    });

    /*** ENd Nav ***/

    /*** Start Datatable ***/

        let table = $('.datatable');
        table.DataTable({
            'pageLength' : 25,
            'order' : false
        });

    /*** End Datatable ***/

});
