/**
 * Created by astromelon on 2016-12-10.
 */
// owl-carousel
$(document).ready(function () {

    $("#owl-demo").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds

        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3]

    });

});

// countdown
CountDownTimer('04/22/2017 12:00 PM', 'countdown');

function CountDownTimer(dt, id) {
    var end = new Date(dt);

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById(id).innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById(id).innerHTML = days + '일 ';
        document.getElementById(id).innerHTML += hours + '시간 ';
        document.getElementById(id).innerHTML += minutes + '분 ';
        document.getElementById(id).innerHTML += seconds + '초';
    }

    timer = setInterval(showRemaining, 1000);
}

// toggle menu close
$(document).on('click', function (e) {
    if ($('#navCollapse').hasClass('in')) {
        $('.collapse').collapse('hide');
    }
});

/**
 * Ajax 메세지 센더
 * @param url
 * @param postData
 * @param feedBackFunction
 * @param errorFunction
 */
var ajaxMessage = function (url, postData, feedBackFunction, errorFunction) {

    jQuery.ajax({
        type: "POST",
        mimeType: "multipart/form-data",
        url: url,
        data: postData,
        contentType: false,
        processData: false,
        success: function (msg) {
            feedBackFunction(msg);

        }, error: function (xhr, status, error) {
            errorFunction(xhr, status, error);

        }
    });
};

