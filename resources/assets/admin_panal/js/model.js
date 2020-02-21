$('#confirm-delete-subject').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

$('#editUserNisit').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var name = $(e.relatedTarget).data('name');
    var pass = $(e.relatedTarget).data('pass');
    var surname = $(e.relatedTarget).data('surname');
    var sex = $(e.relatedTarget).data('sex');
    var nickname = $(e.relatedTarget).data('nickname');
    var major = $(e.relatedTarget).data('major');
    var tel = $(e.relatedTarget).data('tel');
    var email = $(e.relatedTarget).data('email');

    $(e.currentTarget).find('input[name="id-edit"]').val(id);
    $(e.currentTarget).find('select[name="title-edit"]').val(title);
    $(e.currentTarget).find('input[name="name-edit"]').val(name);
    $(e.currentTarget).find('input[name="password-old"]').val(pass);
    $(e.currentTarget).find('input[name="surname-edit"]').val(surname);
    $(e.currentTarget).find('select[name="sex-edit"]').val(sex);
    $(e.currentTarget).find('input[name="nickname-edit"]').val(nickname);
    $(e.currentTarget).find('select[name="major-edit"]').val(major);
    $(e.currentTarget).find('input[name="tel-edit"]').val(tel);
    $(e.currentTarget).find('input[name="email-edit"]').val(email);

});

$('#confirm-delete-nisit').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});


$('#editSubject').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var idSubject = $(e.relatedTarget).data('idsubject');
    var nameThai = $(e.relatedTarget).data('namethai');
    var nameEng = $(e.relatedTarget).data('nameeng');
    var desThai = $(e.relatedTarget).data('desthai');
    var desEng = $(e.relatedTarget).data('deseng');
    var credit = $(e.relatedTarget).data('credit');

    $(e.currentTarget).find('input[name="id_edit"]').val(id);
    $(e.currentTarget).find('input[name="id_subject_edit"]').val(idSubject);
    $(e.currentTarget).find('input[name="credit_edit"]').val(credit);
    $(e.currentTarget).find('input[name="name_subject_thai_edit"]').val(nameThai);
    $(e.currentTarget).find('input[name="name_subject_eng_edit"]').val(nameEng);
    $(e.currentTarget).find('textarea[name="description_thai_edit"]').val(desThai);
    $(e.currentTarget).find('textarea[name="description_eng_edit"]').val(desEng);

});

$('#updatePost').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('idpost');
    var id_subinfo = $(e.relatedTarget).data('idsubinfo');

    var id_subject = $(e.relatedTarget).data('idsubject');
    var sec = $(e.relatedTarget).data('sec');
    var term = $(e.relatedTarget).data('term');
    var years = $(e.relatedTarget).data('years');
    var teacherID = $(e.relatedTarget).data('teacherid');
    var day_work = $(e.relatedTarget).data('daywork');
    var time_work_start = $(e.relatedTarget).data('timeworkstart');
    var time_work_end = $(e.relatedTarget).data('timeworkend');
    var work_start = $(e.relatedTarget).data('workstart');
    var work_end = $(e.relatedTarget).data('workend');
    var nisit_num = $(e.relatedTarget).data('nisitnum');
    var url = $(e.relatedTarget).data('url');
    var quali = $(e.relatedTarget).data('quali');
    var status = $(e.relatedTarget).data('status');

    $(e.currentTarget).find('input[name="id_post_update"]').val(id);
    $(e.currentTarget).find('input[name="id_subinfo_update"]').val(id_subinfo);

    $(e.currentTarget).find('#id_subject_update').val(id_subject);
    $(e.currentTarget).find('#sec_update').val(sec);
    $(e.currentTarget).find('#term_update').val(term);
    $(e.currentTarget).find('#years_update').val(years);
    $(e.currentTarget).find('#id_teacher_update').val(teacherID);
    $(e.currentTarget).find('input[name="check_list_update"]').val([day_work]);
    $(e.currentTarget).find('#time-work-start-update').val(time_work_start);
    $(e.currentTarget).find('#time-work-end-update').val(time_work_end);
    $(e.currentTarget).find('#work-start-update').val(work_start);
    $(e.currentTarget).find('#work-end-update').val(work_end);
    $(e.currentTarget).find('#num-nisit-update').val(nisit_num);
    $(e.currentTarget).find('#url-update').val(url);
    $(e.currentTarget).find('textarea[name="qualification-update"]').val(quali);
    $(e.currentTarget).find('#status-update').val(status);
});

$('#confirm-delete-post').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});




$('#time-start').datetimepicker({
    format: 'HH:mm'
});

$('#time-end').datetimepicker({
    format: 'HH:mm'
});

$('#work-st').datetimepicker({
    format: "l"
});

$('#work-en').datetimepicker({
    format: "l"
});



$('#time-start-update').datetimepicker({
    format: 'HH:mm'
});

$('#time-end-update').datetimepicker({
    format: 'HH:mm'
});

$('#work-st-update').datetimepicker({
    format: "l"
});

$('#work-en-update').datetimepicker({
    format: "l"
});

$('#tableTeacher').dataTable();