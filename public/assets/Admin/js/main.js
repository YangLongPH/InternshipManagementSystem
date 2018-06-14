$(document).ready(function(){
	setTimeout(function(){
		$('.alert.auto-hide').fadeOut();
	}, 10000);

	$('.open-delete-modal').click(function(){
		var id = $(this).attr('data-id');
		var name =  $(this).attr('data-name');
		$('#deletemodal span.name').text(name);
		$('#deletemodal button.delete').attr('data-id', id);
		$('#deletemodal').modal('show');
	});
});


function createNoty(type, content, ttl) {
    var n = noty({
        text: content,
        type: type,
        dismissQueue: true,
        layout: 'topCenter',
        theme: 'defaultTheme'
    });
    if (typeof ttl === 'number') {
        setTimeout(function() {
            $.noty.close(n.options.id);
        }, ttl);
    }
    return n;
}

function readURL(input, output) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(output).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function imgInputPrev(id) {
    var input = $(id + " input[type='file']").first();
    var output = $(id + " img.dataPreview").first();
    $(input).change(function() {
        readURL(this, output);
    });
}

function getProfile(cb) {
    var id = $(this).attr('data-id');
    $.ajax({
        url: 'employee/profile/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (typeof cb === 'function') cb(response.data, response.message);
        },
        error: function(e) {
            var message = "unable to get profile";
            createNoty('error', message, 5000);
        }
    });
}

function renderToText(id, data) {
    $(id + ' .data').each(function() {
        var uri = $(this).attr('data').split('.');
        var text = data;
        for (var i = 0; i < uri.length; i++) {
            text = text[uri[i]];
        }
        $(this).text(text);
    });
}

function createEmployeeModal(data, show) {
    renderToText("#emModal", data);
    if (data.image) {
        var img = "public/uploads/profile_img/" + data.image;
    } else {
        var img = "public/uploads/profile_img/default.png";
    }
    $("#emModal .profile-img img").first().attr('src', img);
    if (typeof show === 'undefined' || show) {
        $('#emModal').modal('show');
    }

}

function createEditEmployeeModal(data, show) {
    $('#edit_emModal .data').each(function(d, e) {
        var uri = $(this).attr('name').split('.');
        var value = data;
        for (var i = 0; i < uri.length; i++) {
            value = value[uri[i]];
        }
        $(this).val(value);
    });
    $('form#em-update').attr('data-id', data.id);
    $('#edit_emModal #Em_depart option:selected').attr('selected', null);
    $('#edit_emModal #Em_depart option').each(function() {
        if (this.value == "" + data.depar_id) {
            $(this).attr('selected', 'selected');
        }
    });
    //$('#edit_emModal input[name="sex"]:checked').attr('checked', null);
    $('#edit_emModal input[name="sex"]').each(function() {
        if (this.value == data.sex) {
            $(this).attr('checked', 'checked');
        }
    });
    if (data.image) {
        var img = "public/uploads/profile_img/" + data.image;
    } else {
        var img = "public/uploads/profile_img/default.png";
    }
    $("#edit_emModal .profile-img img").first().attr('src', img);
    if (typeof show === 'undefined' || show) {
        $('#edit_emModal').modal('show');
    }
}

function resetErrorReportForm(form) {
    $(form + ' input[title_nm]').each(function() {
        $(this).removeClass('error');
        $(this).attr('title', $(this).attr('title_nm'));
    });
}

function validate(form) {
    if ($(form)[0].checkValidity()) return true;
    createNoty('warning', "validate faile, check your input", 3000);
    var required = $(form).find('input:required').filter(function() {
        return !this.value;
    });
    required.addClass('error');
    required.each(function() {
        $(this).attr('title_nm', $(this).attr('title'));
        $(this).attr('title', 'this is a required field');
    });
    return false;
}

function errorReportForm(form, errors) {
    for (var key in errors) {
        var error = errors[key];
        if (error) {
            var input = $(form + ' input[name="?"]'.replace('?', key));
            input.attr('title_nm', input.attr('title'));
            var title = '';
            input.addClass('error');
            error.forEach(function() {
                title += error + ", ";
            });
            input.attr('title', title);
        }
    }
}

function updateProfile(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var url = "employee/update/" + id;
    resetErrorReportForm("#edit_emModal");
    if (!validate("#em-update")) return false;
    var data = new FormData($('#em-update')[0]);
    // var image = $('#em-update input[name=image]')[0].files[0];
    // data.append('image', image);
    //var data = $(this).serialize();
    $.ajax({
        type: "POST",
        url: url,
        data: data, // serializes the form's elements.
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            var message = data.message;
            if (!message || !message.length || message.length == 0) {
                message = 'profile has up to date';
            }
            createNoty('success', message, 5000);
            $('#edit_emModal').modal('hide');
            renderToText("#emrow" + data.data.id, data.data);

        },
        error: function(e) {
            var message = "unable to update profile";
            createNoty('error', message, 5000);
            var response = JSON.parse(e.responseText);
            errorReportForm("#edit_emModal", response.data);
        }
    });

    return false;
}

function createModal(data) {
    $('.room_number').html(" <b>&nbsp; " + data.Dep_number + "</b>");
    $('.name').html(" <b>&nbsp; " + data.Dep_name + "</b>");
    $('.master').html(" <b>&nbsp; " + data.master.name + "</b>");
    $('.phone').html(" <b>&nbsp;  " + "0" + data.Dep_Phone + "</b>");
    if (!$('.employee_>ul').length) {
        $('.employee_').append('<ul style="margin-left: 60px; list-style: decimal;"></ul>');
    }
    var employeeList = $('.employee_>ul');
    employeeList.empty();
    var employees = data.employees;
    for (var i = 0; i < employees.length; i++) {
        var li = $('<li></li>');
        li.text(employees[i].name);
        li.id = employees[i].id;
        var detail = $('<a title="profile" class="em-act-sm pull-right" href="javascript:void(0);"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>');
        detail.attr('data-id', employees[i].id);
        detail.on('click', function(){
            getProfile.call(this, createEmployeeModal);
        });
        li.append(detail);
        employeeList.append(li);
    }
    $('.view_employee').removeClass('border_employee_');
    $('#myModal .close_modal').html('Close');
    $('#myModal .modal-footer').html('<button type="button" class="btn btn-primary" data-dismiss="modal"> Close</button>');
}

function createEditModal(data) {
    var token = $("meta[name='csrf-token']").attr('content');
    if (data == null) return;
    var dpid = data.id;
    var removeList = [];
    $('.name').html('<input required type="text" class="trans" name="DepartmentName" value="' + data.Dep_name + '" >');
    $('.room_number').html(" <input type='text' value='" + data.Dep_number + "' > ");
    $('.master').html('');
    $('.phone').html(" <input type='text' value='0" + data.Dep_Phone + "' > ");
    if (!$('.employee_>ul').length) {
        $('.employee_').append('<ul style="margin-left: 60px; width: 250px; list-style: decimal;"></ul>');
    }
    $('.master').empty();
    if (!$('.master>select').length) {
        $('.master').append('<select></select>');
    }
    var employeeList = $('.employee_>ul');
    employeeList.empty();
    var employeeOptions = $('.master>select');
    employeeOptions.empty();
    var employees = data.employees;
    for (var i = 0; i < employees.length; i++) {
        var li = $('<li></li>');
        li.text(employees[i].name);
        var removeEmpl = $('<a title="remove from department" class="em-act-sm pull-right" href="javascript:void(0)" role="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>');
        removeEmpl.attr('data-id', employees[i].id);
        var detail = $('<a title="profile" class="em-act-sm pull-right" href="javascript:void(0);"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>');
        detail.attr('data-id', employees[i].id);
        detail.on('click', function(){
            getProfile.call(this, createEmployeeModal);
        });
        li.append(removeEmpl);
        li.append(detail);
        employeeList.append(li);
         $('.view_employee').addClass('border_employee_');
        $('#myModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>' +
                    '<button type="button" class="btn btn-primary close_modal update_department" data-dismiss="modal">Update</button>');
        $('.update_department').bind('click', function(){
            $.ajax({
                url: 'postEditDepartment',
                type: 'POST',
                dataType: 'json',
                data: {
                    'depId': dpid,
                    'depMaster': $('.master>select').val(), 
                    'DepartmentName':  $('.name>input').get(2).value,
                    'RoomNumber': $('.room_number>input').val(),
                    'DepartmentPhone': $('.phone>input').val(),
                    'removeList': removeList,
                    '_token': token
                },

                complete: function(){

                },
                success: function(response){

                    var message =  response.message;
                    if(!message){
                        message = "department was updated";
                    }
                    
                   createNoty('success', message, 5000);
                   renderDepartmentRow(response.data);
                },
                error: function(){
                    var message =  data.message;
                    if(typeof message === 'undefined'){
                        message = "department can not updated";
                    }
                    createNoty('error', message, 5000);   
                }
            });
        });
        removeEmpl.on('click', function() {
            var ico = $(this).find('span');
            var id = $(this).attr('data-id');
            if ($(this).attr('role') == 'remove') {
                removeList.push(id);
                ico.css('color', 'orange');
                ico.attr('class', 'glyphicon glyphicon-repeat');
                $(this).attr('title', 'undo');
                $(this).attr('role', 'undo');
            } else {
                removeList.splice(removeList.indexOf(id), 1);
                ico.css('color', '');
                ico.attr('class', 'glyphicon glyphicon-remove');
                $(this).attr('title', 'remove from department');
                $(this).attr('role', 'remove');
            }
        });
        var option = $('<option></option>');
        option.text(employees[i].name);
        option.val(employees[i].id);
        if (employees[i].name == data.Dep_master) {
            option.attr('selected', 'selected');
        }
        employeeOptions.append(option);
    }
}

    function renderDepartmentRow(dep) {
        var id = dep.id;
        var row = '#depart_' + id;
        if (!(row).length) return;
        $(row + ' .show_modal').text(dep.Dep_name);
        $(row + ' .dep_master a').text(dep.master.name);
        $(row + ' .dep_master a').attr('data-id', dep.master.id);
        $(row + ' .dep_phone').text(dep.Dep_Phone);
        $(row + ' .number_room').text(dep.Dep_number);
    }
 function deleteDep(){
             	var id = $(this).attr('data-id');
             	var token = $('meta[name=csrf-token]').attr('content');
             	var data = {
             		'_token': token,
             		method: 'delete',
             		id: id
             	};
             	$.ajax({
             		url: 'department/delete',
             		type: 'DELETE',
             		data: data,
             		dataType: 'json',
             		success: function(respone){
             			$('tr#depart_'+id).remove();
             			createNoty('success', respone.message, 5000);
             		},
             		error: function(err){
             			var res = $.parseJSON(err.responseText);
             			var mes = res.message;
             			if(!mes){
             				mes = 'unable to delete';
             			}
             			createNoty('error', mes, 5000);
             		}
             	});
             }

             function deleteEmp(){
                         	var id = $(this).attr('data-id');
                         	var token = $('meta[name=csrf-token]').attr('content');
                         	var data = {
                         		'_token': token,
                         		method: 'delete',
                         		id: id
                         	};
                         	$.ajax({
                         		url: 'employee/delete',
                         		type: 'DELETE',
                         		data: data,
                         		dataType: 'json',
                         		success: function(respone){
                         			$('tr#emrow'+id).remove();
                         			createNoty('success', respone.message, 5000);
                         		},
                         		error: function(err){
                         			var res = $.parseJSON(err.responseText);
                         			var mes = res.message;
			             			if(!mes){
			             				mes = 'unable to delete';
			             			}
			             			createNoty('error', mes, 5000);
                         		}
                         	});
                         }             