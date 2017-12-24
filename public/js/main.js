function openTab(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
//

// ----------------- SetTimeOut test time to do exam ----------------

// function countdown(){
//
//     console.log(num_question);
// var distance =
// var closeSeconds = $("#AniPopup").attr("data-close");
// var openSeconds = $("#AniPopup").attr("data-open");
//
// setTimeout(function(e) {
//
//     popup.modal('show');
//     time.html(closeSeconds);
//
//     var interval = setInterval(function(){
//         time.html(closeSeconds);
//         closeSeconds--;
//
//         if(closeSeconds < 0){
//             popup.modal('hide');
//             clearInterval(interval);
//         }
//
//     }, 1000)
//
// }, openSeconds * 1000);
// }
// -------------------- Ajax load test question with level ---------------

$('#form-start').on('submit', function (e) {
    e.preventDefault(e);
    var level = $('#form-start input[type=radio]:checked').val();
    console.log(level);
    var id = $('#lesson').val();
    console.log(id);
    $.ajax({
        method: "GET",
        url: $('#form-start').attr('action'),
        data: {
            level: level
        },
        dataType: 'text',
        success: function (data) {
            $('#list-question').html(data);
            var num_question = $('#num_question').val();
            var distance = num_question * 1000 * 60;
            var timer;

            function countdown() {
                if (distance >= 0) {
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    minutes = (minutes < 10) ? "0" + minutes : minutes;
                    seconds = (seconds < 10) ? "0" + seconds : seconds;
                    $('#count-down').html('Thời gian còn lại:' + ' ' + '<b>' + minutes + ' : ' + seconds + '</b>' + ' giây');
                    distance -= 1000;
                    timer = setTimeout(countdown, 1000);
                } else {
                    clearTimeout(timer);
                    $('#form-answer').submit();
                }
            }

            countdown();
        },
        error: function (data) {
            console.log("request failed");
        }
    })
});

// ----------------------Ajax button favourite lesson --------------------

$('#user-favourite').click(function (event) {
    event.preventDefault();
    var icon_current = $('#user-favourite i');
    var myUrl = $(this).data('href');
    var lesson_id = $(this).data('lesson');
    $.ajax({
        method: 'GET',
        url: myUrl,
        dataType: 'text',
        success: function (data) {
            if (icon_current.hasClass('fa-heart')) {
                $('#user-favourite i').removeClass('fa-heart').addClass('fa-heart-o');
                $('#user-favourite').attr('data-original-title', 'Lưu bài học vào mục yêu thích');
                $('#user-favourite').prop('href', 'user/lesson_favourite_add/' + lesson_id)
            } else {
                $('#user-favourite i').removeClass('fa-heart-o').addClass('fa-heart');
                $('#user-favourite').attr('data-original-title', 'Bỏ thích');
                $('#user-favourite').prop('href', 'user/lesson_favourite_delete/' + lesson_id)
            }
        },
        error: function (data) {
            console.log('request failed');
        }
    })
});

$('#user-pin').click(function (event) {
    event.preventDefault();
    var icon_current = $('#user-pin i');
    var myUrl = $(this).data('href');
    var lesson_id = $(this).data('lesson');
    $.ajax({
        method: 'GET',
        url: myUrl,
        dataType: 'text',
        success: function (data) {
            if (icon_current.hasClass('fa-bookmark')) {
                $('#user-pin i').removeClass('fa-bookmark').addClass('fa-bookmark-o');
                $('#user-pin').attr('data-original-title', 'Lưu bài học để xem tiếp');
                $('#user-pin').prop('href', 'user/lesson_followed_add/' + lesson_id)
            } else {
                $('#user-pin i').removeClass('fa-bookmark-o').addClass('fa-bookmark');
                $('#user-pin').attr('data-original-title', 'Bỏ theo dõi');
                $('#user-pin').prop('href', 'user/lesson_followed_delete/' + lesson_id)
            }
        },
        error: function (data) {
            console.log('request failed');
        }
    })
});
$('.delete-comment').click(function (){
    var myUrl = $(this).data('href');
    console.log(myUrl);
    $.ajax({
        method: 'GET',
        url: myUrl,
        dataType: 'text',
        success: function(data){
            console.log('Xóa thành công');
        },
        error: function (data) {
            console.log('request failed');
        }
    })
})
$('.lesson-detail-content table').addClass('table-bordered');
$('.reply').click(function (e) {
    e.currentTarget;
    id = e.currentTarget.id;
    id_form = id.slice('6');
    form = $('#form_' + id_form).toggle();
});
$('.edit-comment').click(function () {
    $(this).next().toggle();
})