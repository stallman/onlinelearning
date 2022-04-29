$('.user-menu .dropdown-item').each(function(idx, el){
    const route = document.location.protocol + '//' + document.location.host + document.location.pathname;
    if($(this).attr('href') === route){
        $(this).addClass('active')
    }
});
$('.courses-menu-btn').each(function(idx, el){
    const route = document.location.protocol + '//' + document.location.host + document.location.pathname;
    if($(this).attr('href') === route){
        $(this).addClass('current')
    }
});
$('.course-submenu-btn').each(function(idx, el){
    const route = document.location.protocol + '//' + document.location.host + document.location.pathname;
    if($(this).attr('href') === route){
        $(this).addClass('active')
    }
});
$('#mainMenu .nav-item .nav-link').each(function(idx, el){
    const route = document.location.protocol + '//' + document.location.host + document.location.pathname;
    if($(this).attr('href') === route){
        $(this).parent().addClass('active')
    }
});
//tests page
// $('.answer-choice label').click(function(){
//    const value = $(this).attr('data-value');
//    $('#selected_answer').val(value);
// });

$( "#click_clr_img_input" ).click(function() {
    $('#old_image').val('');
    $("#img_input").addClass('d-none');
});

$( ".click_re_img_input" ).click(function() {
    let defaultvalue = $('#old_image').attr('defaultvalue');
    $('#old_image').val(defaultvalue);
    $("#img_input").removeClass('d-none');
});

$(document).ready(function(){
    $(".phone").mask("+7(999)999-9999");
});

/**
 * Скрыть/показать "другая специальность" в профиле
 */
$('#checkOtherSpeciality').click(function(){
    if ($(this).is(':checked')){
        $("#select_speciality").selectpicker().val("");
        $("#select_speciality").attr('disabled',true);
        $("#select_speciality").selectpicker('refresh');
        $("#other_speciality").removeClass('d-none');
    } else {
        $("#select_speciality").attr('disabled',false);
        $("#select_speciality").selectpicker('refresh');
        $("#input_other_speciality").val("");
        $("#other_speciality").addClass('d-none');
    }
});

$('#signup-course-btn').click(function (){
    var url = $('#route-to-signup-to-course').val();
    var fd = new FormData();
    fd.append('surname', $('#signupCourse #surname').val());
    fd.append('name', $('#signupCourse #name').val());
    fd.append('patronymic', $('#signupCourse #patronymic').val());
    fd.append('email', $('#signupCourse #email').val());
    fd.append('course_id', $('#signupCourse #course_id').val());
    fd.append('request_file', $('#signupCourse #request_file')[0].files[0]);
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        data: fd,
        dataType : 'json',
        success: function(msg){
            console.log(msg);
            $('#signupCourse').modal('hide');

            $('.toast-success').toast('show');
            setTimeout(() => { $('.toast-success').toast('hide');}, 5000);
        },
        error: function(error){
            $('.toast-danger .message').empty().html('Замечены пустые поля, или что-то пошло не так');
            $('.toast-danger').toast('show');
            console.log(error);
        }
    });
})

var page = 1;

$('#click_load_news').click(function(){
    page++;
    $.ajax({
        type : 'get',
        url : '/news/loadmore',
        data : {
            page:page
        },
        success : function(data) {
            console.log(data);
            console.log(data.length);
            if(data.length < 10) $('#click_load_news').hide();
            $('#news-data').append(data);
        }
    });
});


$('#click_load_courses').click(function(){
    //console.log(data);
    var spec = $('#spec-select').val();
    var url = '/courses/loadmore';
    if (spec != '') url += '?speciality='+spec;

    page++;
    $.ajax({
        type : 'get',
        url : url,
        data : {
            page: page,
        },
        success : function(data) {

            if(data.length < 10) $('#click_load_courses').hide();
            $('#course-specialities').append(data);
        }
    });
});


$("#spec-select").change(function(){
    page = 1;
    var value = $(this).val();
    $('#more-courses').attr("href", "/courses?speciality="+value);
    $.ajax({
            type : 'get',
            url : '/api/courses',
            data : {
                speciality:value
            },
            success : function(data){
                //console.log(data);
                $('#course-specialities').html(data);

                if(data.length > 10) $('#click_load_courses').show();
            }
    });
});


$(function () {
    $('.js-example-basic-single').selectpicker();

});

/**
 * фильтрация списка специальностей по уровню образования
 */
$('#select_education_lvl').off('change', function() {
    let url = $('#url_specialty_get_data').val();
    let value = this.value;
    let projectsNameSelect = $('select[name="speciality_id"]');
    $.ajax({
        type: "GET",
        url: url,
        data: {
            value: value,
        },
        dataType : 'json',
        success: function(data){
            console.log(data);

            projectsNameSelect.html(''); //очищаем список
            projectsNameSelect.append('<option selected disabled>выберите специальность</option>');
            //заполняем
            $.each(data, function( key, value ) {
                projectsNameSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
            });

        },
        error: function(error){
            alert("error");
        }
    });
});

/**
 * Сортировка активных курсов по новым и старым записям
 */
$('#select_sort_active_courses').on('change', function() {

    let url = $('#url_sort_active_courses').val();
    // alert(url);
    // let userID = $('#user_id').val();
    let value = this.value;

    $.ajax({

        type: "GET",
        url: url,
        data: {
            tipSort: value,
        },
        statusCode: {
            401: function() {
                alert( "Not authenticated" );
            }
        },
        dataType : 'json',
        success: function(data){
            console.log(data);
            $('#table_data_active_curses').html(data.html);
        },
        error: function(error){
            console.log(error);
            console.log("Не удалось произвести сортировку");
        }
    });
});

/**
 * Сортировка завершенных курсов по новым и старым записям
 */
$('#select_sort_completed_courses').on('change', function() {

    let url = $('#url_sort_completed_courses').val();
    // alert(url);
    // let userID = $('#user_id').val();
    let value = this.value;

    $.ajax({

        type: "GET",
        url: url,
        data: {
            tipSort: value,
        },
        statusCode: {
            401: function() {
                alert( "Not authenticated" );
            }
        },
        dataType : 'json',
        success: function(data){
            console.log(data);
            $('#table_data_completed_curses').html(data.html);
        },
        error: function(error){
            console.log(error);
            console.log("Не удалось произвести сортировку");
        }
    });
});


/**
* Поиск в таблице admin.courses по ID и Name
* */
// function searchAdminCourses(_this){
//     $.each($("#table_admin_courses tbody tr "), function() {
//         let valueID = $(this.cells[0]).text();
//         let valueName = $(this.cells[1]).text();
//
//         let iResCmpID = valueID.toLowerCase().indexOf($(_this).val().toLowerCase());
//         let iResCmpName = valueName.toLowerCase().indexOf($(_this).val().toLowerCase());
//
//         if (iResCmpID === -1 && iResCmpName === -1){
//             $(this).hide();
//         }
//         else{
//             $(this).show();
//         }
//     });
// }

/**
 * Поиск в таблицах admin
 * передаём значение ввода поиска, id или class таблицы и колонки таблиц
 * */
function searchAdminTableInEntities(_this, sTable, arColumn){
    $.each($(sTable + " tbody tr "), function() {
        let obRow = this;

        $.each(arColumn, function (index, columnName) {
            let value = $(obRow.cells[name=columnName]).text();
            let iResCmp = value.toLowerCase().indexOf($(_this).val().toLowerCase());

            if (iResCmp === -1 ){
                $(obRow).hide();
            }
            else{
                $(obRow).show();
                return false; //если нашли, то выходим из цикла
            }
        });
    });
}

function searchAdminTableInEntitiesAJAX(_this, sTable, arColumn){
    $.each($(sTable + " tbody tr "), function() {
        let obRow = this;

        $.each(arColumn, function (index, columnName) {
            let value = $(obRow.cells[name=columnName]).text();
            let iResCmp = value.toLowerCase().indexOf($(_this).val().toLowerCase());

            if (iResCmp === -1 ){
                $(obRow).hide();
            }
            else{
                $(obRow).show();
                return false; //если нашли, то выходим из цикла
            }
        });
    });
}

$("#search_admin_in_entities").on("keyup", function() {
    searchAdminTableInEntities(this, ".table-admin-in-entities", ["id", "name"]);
});

$('#search_admin_in_entities').on('search', function () {
    searchAdminTableInEntities(this, ".table-admin-in-entities", ["id", "name"]);
});
