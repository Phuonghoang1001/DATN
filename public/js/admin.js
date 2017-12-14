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
$('#question_type').on('change', function () {
    if (this.value == 'reading') {
        $("#question_reading").addClass('visible');
        $("#question_listening").addClass('hidden');
    }
    else {
        $("#question_reading").addClass('hidden');
        $("#question_listening").addClass('visible');
    }
});


$('#changPass').change(function () {
    if ($(this).is(":checked")) {
        $('.password').removeAttr("disabled");
    } else {
        $('.password').attr('disabled', '');
    }
});
function confirm_delete($msg) {
    if (window.confirm($msg)) {
        return true;
    }
    return false;
}
$('a[data-confirm]').click(function(ev) {
    var href = $(this).attr('href');
    if (!$('#dataConfirmModal').length) {
        $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>');
    }
    $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
    $('#dataConfirmOK').attr('href', href);
    $('#dataConfirmModal').modal({show:true});
    return false;
});

$('div.alert').delay(3000).slideUp();