/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/* Location DropDowns */

var SearchOrganisationObject = {
    fields: {
        organisation_type: '',
        sfera_type: '',
        country_id: '',
        region_id: '',
        sity_id: '',
    },
    
    Set: function(key, value) {
        if(this.fields[key] !== value) {
            this.fields[key] = value;
            this.SendToOrganisation();
        }
        
        
    },
    
    SendToOrganisation: function() {
        var self = this;
        $.ajax('/user/organisation/search.json', {
            type: 'POST',
            data: self.fields,
            error: function(e) {
                console.log(e);
            },
            
            success: function(e) {
                //console.log(e);
                var oldValue = $('select[name="organisation_id"]').val();
                $('select[name="organisation_id"]').html('');
                for(var i in e) {
                    $('select[name="organisation_id"]').append('<option value="' + e[i].id + '">' + e[i].title + '</option>');
                }
                var hasOldValue = $('select[name="organisation_id"]').find('option[value="' + oldValue + '"]').length > 0;
                if (!hasOldValue) {
                    $('select[name="organisation_id"]').val(null).trigger('change');
                } else {
                    $('select[name="organisation_id"]').val(oldValue);
                }
            }
        })
    }
};

var SearchFilialObject = {
    fields: {
        organisation_id: '',
        country_id: '',
        region_id: '',
        sity_id: '',
    },
    
    Set: function(key, value) {
        if(this.fields[key] !== value) {
            this.fields[key] = value;
            this.SendToFilial();
        }
    },
    
    SendToFilial: function() {
        var self = this;
        $.ajax('/user/filial/search.json', {
            type: 'POST',
            data: self.fields,
            error: function(e) {
                console.log(e);
            },
            
            success: function(e) {
                //console.log(e);
                
                $('select[name="filial_id"]').html('');
                for(var i in e) {
                    $('select[name="filial_id"]').append('<option value="' + e[i].id + '">' + e[i].title + '</option>');
                }
                $('select[name="filial_id"]').val(null).trigger('change');
            }
        })
    }
};

$.prototype.LocationControl = function() {
    var self = this;
    /*self.on('change', function() {
        SearchOrganisationObject.Set($(this).attr('name'), $(this).val());
        console.log(SearchOrganisationObject);
    });*/
    //debugger;
    
    if(!$(this).attr('action')) return this;
    if($(this).attr('param') === undefined) {
        $(self).val(null);
        $(self).attr('val', '');
        $(self).html('');
        return this;
    }
    $.ajax($(this).attr('action') + $(this).attr('param') + '.json', {
        type: 'get',
        error: function(e) {
            //console.log(e);
        },
        success: function(e) {
            //debugger;
            $(self).html('');
            for(var i in e) {
                var opt = e[i];
                $(self).append('<option value="' + opt.id + '">' + opt.title + '</option>');
            }
            if($(self).attr('val') === '') {
                $(self).val(null);
                $(self).val($(self).attr('val')).trigger('change');
            } else {
                $(self).val($(self).attr('val')).trigger('change');
            }
        }
    });
    
    return this;
};

/* end */

$(document).ready(function(){
    $('#registr-button').on('click', function(){
       $('.loader').removeClass('none');
       $.ajax({
            type: 'post',
            url: $('#registr-form').attr('action'),
            data: $('#registr-form').serialize(),
            success: function (data) {
                $('.loader').addClass('none');
                var responce_object = JSON.parse(data);
                $('.form-group').removeClass('has-error');
                if(responce_object.status === 'failed') {
                    $('#registr-form .label-danger').html('');
                    if(responce_object['error-string'] ==="Validation Error") {
                        for(var i in responce_object.validation_errors) {
                            $('input[name="' + i + '"]').parent().addClass('has-error');
                            $('#registr-form .label-danger').append('<p>' + responce_object.validation_errors[i] + '</p>');
                        }
                    } else {
                       $('#registr-form .label-danger').html(responce_object['error-string']); 
                    }
                } else {
                    $('#registr').modal('hide');
                    $('#login .alert-danger').html(responce_object['error-string']);
                    $('#login').modal('show');
                }
            }
        });

        return false; 
    });
    
    $('#login-button').on('click', function(){
        $('#login-form .alert-danger').html('');
        $('#login-form .form-group').removeClass('has-error');
       $.ajax({
            type: 'post',
            url: $('#login-form').attr('action'),
            data: $('#login-form').serialize(),
            success: function (data) {
                var obj = JSON.parse(data);
                if(obj.status === 'success') {
                    window.location.reload();
                } else {
                    if(obj.message !== '') {
                        $('#login-form .alert-danger').html('Неверный логин или пароль');
                        $('#login-form .form-group').addClass('has-error');
                    }
                }
            }
        });

        return false; 
    });
    
    $('#createevent-button').on('click', function(){
        
       $.ajax({
            type: 'post',
            url: $('#createevent-form').attr('action'),
            data: $('#createevent-form').serialize(),
            success: function (data) {
                var responce_object = JSON.parse(data);
                $('.form-group').removeClass('has-error');
                if(responce_object.status === 'failed') {
                    if(responce_object['error-string'] ==="Validation Error") {
                        for(var i in responce_object.validation_errors) {
                            $('#createevent-form [name="' + i + '"]').parent().addClass('has-error');
                        }
                    } else {
                       $('#createevent-form .label-danger').html(responce_object['error-string']); 
                    }
                } else {
                    window.location.reload();
                }
            }
        });

        return false; 
    });
    
    $('#editevent-button').on('click', function(){
        
       $.ajax({
            type: 'post',
            url: $('#editevent-form').attr('action'),
            data: $('#editevent-form').serialize(),
            success: function (data) {
                var responce_object = JSON.parse(data);
                $('.form-group').removeClass('has-error');
                if(responce_object.status === 'failed') {
                    if(responce_object['error-string'] ==="Validation Error") {
                        for(var i in responce_object.validation_errors) {
                            $('#editevent-form [name="' + i + '"]').parent().addClass('has-error');
                        }
                    } else {
                       $('#editevent-form .label-danger').html(responce_object['error-string']); 
                    }
                } else {
                    window.location.reload();
                }
            }
        });

        return false; 
    });
    
    $('#sedmail-button').on('click', function(){
       $('.loader').removeClass('none');
       $('.alert.invite').html('').removeClass('alert-success').removeClass('alert-danger');
       $('#sedmail-form .has-error').removeClass('has-error');
       $.ajax({
            type: 'post',
            url: $('#sedmail-form').attr('action'),
            data: $('#sedmail-form').serialize(),
            success: function (data) {
                $('.loader').addClass('none');
                var responce_object = JSON.parse(data);
                $('.form-group').removeClass('has-error');
                if(responce_object.status === 'failed') {
                    if(responce_object['error-string'] ==="Validation Error") {
                        for(var i in responce_object.validation_errors) {
                            $('#sedmail-form [name="' + i + '"]').parent().addClass('has-error');
                            $('.alert.invite').html(responce_object['error-string']).removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger');
                        }
                    } else {
                       $('.alert.invite').html(responce_object['error-string']).removeClass('alert-success').addClass('alert-danger'); 
                    }
                } else {
                    $('.alert.invite').html('Emails Sended').removeClass('alert-danger').addClass('alert-success');
                    $('.invite #sedmail-form #inputEmail1').val('');
                }
            }
        });

        return false; 
    });

    /*$(".form_datetime").datetimepicker({
       autoclose: true,
       todayBtn: true,
       place:'right',
    });
    $('#date-picker [type="text"]').val($('#date-picker').attr('data-date'));
    $('#date-picker').on('keydown', '[type="text"]', function(){ 
       return false;
    });*/


    
    
    $('input, textarea').placeholder();
    
    $('.forgot-password a').on('click', function () {
        $("#login").modal('hide');
    });
    
    $('#forgot-password-button').on('click', function(){
        
       $.ajax({
            type: 'post',
            url: $('#forgot-password-form').attr('action'),
            data: $('#forgot-password-form').serialize(),
            success: function (data) {
                var obj = JSON.parse(data);
                if(obj.status === 'success') {
                    $('#forgot-password-form .label').removeClass('label-danger').addClass('label-success').html("Check your email for further instructions");
                } else {
                    if(obj['error-string'] !== '') {
                        $('#forgot-password-form .label').removeClass('label-success').addClass('label-danger').html(obj['error-string']);
                    }
                }
            }
        });

        return false; 
    });
    
    $('.modal').css('display', function(state){
        if(state == 'none') alert ('none'); 
    });
    
    $('#exampleInputEmail1').keypress( function(event){
        if(event.keyCode == 13) $('#exampleInputPassword1').focus();
    });
    $('#exampleInputPassword1').keypress( function(event){
        if(event.keyCode == 13){ 
            $('#login-button').focus();
            $('#login-button').click();
        }
    });
    
    $('.mobile-menu').on('click',function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open');
            $('.navbar-right').css({
                'margin-top': '-9999px',
                'opacity': '0'
            });
        } else{
            $('.navbar-right').css({
                'margin-top': '0',
                'opacity': '1'
            });
            $(this).addClass('open');
        }
    });
    
    
    /*$('select.location[name="country_id"]').LocationControl().on('change', function() {
        SearchOrganisationObject.Set('country_id', $(this).val());
        $('#organisationModal select.location[name="country_id"]').attr('val', $(this).val()).val($(this).val());
        $('select.location[name="region_id"]').attr('param', $(this).val()).LocationControl().on('change', function() {
            SearchOrganisationObject.Set('region_id', $(this).val());
            $('#organisationModal select.location[name="region_id"]').attr('val', $(this).val()).val($(this).val());
            $('select.location[name="sity_id"]').attr('param', $(this).val()).LocationControl().on('change', function() {
               SearchOrganisationObject.Set('sity_id', $(this).val()); 
               $('#organisationModal select.location[name="sity_id"]').attr('val', $(this).val()).val($(this).val());
            });
            
        });
    });
    
    
    var countrySelect = $('select.location[name="country_id"]').LocationControl();
    var regionSelect = $('select.location[name="region_id"]').LocationControl();
    var citySelect = $('select.location[name="sity_id"]').LocationControl();*/
    
    
    
    var locationOrder = new Array();
    locationOrder[0] = 'country_id';
    locationOrder[1] = 'region_id';
    locationOrder[2] = 'sity_id';
    
    var onLocationControlChange = function () {
        //debugger;
        var currentName = $(this).attr('name');
        var selector = 'select.location[name="' + currentName + '"]';
        var currentValue = $(this).val();
        SearchOrganisationObject.Set(currentName, currentValue);
        SearchFilialObject.Set(currentName, currentValue);
        $(selector).attr('val', currentValue).val(currentValue);
        if (locationOrder.indexOf(currentName) < locationOrder.length) {
            var relatedName = locationOrder[locationOrder.indexOf(currentName) + 1];
            var relatedSelector = 'select.location[name="' + relatedName + '"]';
            $(relatedSelector).attr('param', currentValue);
            $(relatedSelector).LocationControl();
        }
    }
    
    var currentName = locationOrder[0];
    var currentSelector = 'select.location[name="' + currentName + '"]';     
    $('select.location[name]').on('change', onLocationControlChange);
    $(currentSelector).LocationControl();//.on('change', onLocationControlChange);
    
    
    
    $('select[name="postResipientType"]').LocationControl().on('change', function() {
        SearchOrganisationObject.Set('organisation_type', $(this).val());
        $('select[name="organisation_type"]').attr('val', $(this).val()).LocationControl().on('change', function() {
            $('select[name="sfera_type"]').attr('param', $(this).val()).LocationControl();
        });
        
        $('select[name="sferaType"]').attr('param', $(this).val()).LocationControl().on('change', function() {
            SearchOrganisationObject.Set('sfera_type', $(this).val());
            $('select[name="sfera_type"]').attr('val', $(this).val()).LocationControl();
        });
    });
    
    $('select[name="organisation_id"]').LocationControl().on('change', function () {
        SearchFilialObject.Set('organisation_id', $(this).val());
        if ($(this).val() !== '' && $(this).val() !== null && $(this).val() !== undefined) {
            $('.filial-wrapper').removeClass('hidden');
        } else {
            $('.filial-wrapper').addClass('hidden');
        }
    });
    
    
    $('#addOrganisation').on('click', function() {
        $('form.addOrganisationForm').submit();
    });
    
    $('form.addOrganisationForm').on('submit', function(e) {
       e.preventDefault();
       var self = this;
       $.ajax('/user/organisation/create.json', {
           type: 'post',
           data: $(self).serialize(),
           error: function(e) {
               console.log(e);
           },
           success: function(e) {
               if(e.status === 'success') {
                  $('form.addOrganisationForm .has-error').removeClass('has-error'); 
               } else {
                   for(var i in e.errors) {
                       $('form.addOrganisationForm [name="' + i + '"]').parent().addClass('has-error');
                   }
               }
               SearchOrganisationObject.SendToOrganisation();
               $('#organisationModal').modal('hide');
           }
       });
       
       return false;
       
    });
    
    $('#addFilial').on('click', function() {
        $('form.addFilialForm').submit();
    });
    
    
    $('form.addFilialForm').on('submit', function(e) {
       e.preventDefault();
       var self = this;
       $.ajax('/user/filial/create.json', {
           type: 'post',
           data: $(self).serialize() + '&organisation_id=' + $('[name="organisation_id"]').val(),
           error: function(e) {
               console.log(e);
           },
           success: function(e) {
               if(e.status === 'success') {
                  $('form.addOrganisationForm .has-error').removeClass('has-error'); 
               } else {
                   for(var i in e.errors) {
                       $('form.addOrganisationForm [name="' + i + '"]').parent().addClass('has-error');
                   }
               }
           }
       });
       
       return false;
       
    });
});


