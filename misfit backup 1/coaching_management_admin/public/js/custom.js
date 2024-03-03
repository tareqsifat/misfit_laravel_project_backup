function get_class_schedules(id) {
    $.ajax({
        url: "/api/get_schedule/"+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // console.log(data);
            $('#total_routine').html(data.html);
            $('.filterNav').find('*').removeClass('active');
            let filter_btn_id = 'filter_nav'+id;
            console.log(filter_btn_id);
            $('#'+filter_btn_id).addClass('active');
        }
    });
}

$(document).ready(function(){
    get_class_schedules(2);
});
