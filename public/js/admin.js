
//  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });
    $('#question_type').on('change', function() {
        if ( this.value == 'reading')
        {
            $("#question_reading").addClass('visible');
            $("#question_listening").addClass('hidden');
        }
        else
        {
            $("#question_reading").addClass('hidden');
            $("#question_listening").addClass('visible');
        }
    });


    $('#changPass').change(function () {
        if ($(this).is(":checked")){
            $('.password').removeAttr("disabled");
        }else {
            $('.password').attr('disabled','');
        }
    });
