$(document).ready(function() {
    $('.date input').datepicker({
        format: "mm/dd/yyyy",
        autoclose: true,
        todayHighlight: true
    });
    
    $('select[name=organisation_type]').LocationControl().on('change', function() {
        $('select[name=sfera_type]').attr('param', $(this).val()).LocationControl();
    });
    
    var SelectionPosition;
    
    $('input[type="file"]').on('change', function(evt) {
        console.log('hui');
        evt.stopPropagation();
        evt.preventDefault();
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                     
                     $('#editModalImage').attr('src', e.target.result);//.attr({'width': '700px', 'height': ((700 / $('#editModalImage').width()) * $('#editModalImage').height()) + 'px'});
                     $('#myModal').modal('hide');
                     $('#editModal').modal();
                     $('#editModalImage').load(function(){
                         var h = $('<img />').attr('src',  e.target.result);
                         h.load(function(){
                            $('#editModalImage').attr({'width': '700px', 'height': ((700 / h[0].width) * h[0].height) + 'px'});
                            //debugger;
                            $('#editModalImage').Jcrop({
                                aspectRatio: 1,
                                minSize: [400, 400],
                                maxSize: [400, 400],

                                setSelect:   [ $('#editModalImage').width() / 2 - 200, $('#editModalImage').height() / 2 - 200, $('#editModalImage').width() / 2 + 200, $('#editModalImage').height() / 2 + 200 ],
                                onSelect: function(e) {
                                    SelectionPosition = e;
                                },
                                onChange: function() {
                                    SelectionPosition = e;
                                }
                            });
                        });
                     });
                     
                };
            })(f);
            reader.readAsDataURL(f);
        }
        
    });
    
    $('#apply').on('click', function(e) {
        $('[control-type="overlay"]').removeClass('none');
        e.preventDefault();
        CropImage($('#editModalImage')[0], SelectionPosition.x * (-1), SelectionPosition.y * (-1), SelectionPosition.w, SelectionPosition.h, $('#editModalImage').width(), $('#editModalImage').height(), function(canvas){
            canvas.toBlob(function(file){
                var data = new FormData();
                data.append('file', file);
                $.ajax('/user/profile/uploadavatar', {
                   type: 'POST',
                   data: data,
                   processData: false,
                   contentType: false,
                   error: function(e) {
                       window.location.reload();
                   },
                   
                   success: function(e) {
                       window.location.reload();
                   }
                });
                $('#editModal').modal('hide');
            }, 'image/jpeg');
        });
    });
    
    $('#save').on('click', function(e) {
        e.preventDefault();
        var self = this;
        CropImage($('#editModalImage')[0], SelectionPosition.x * (-1), SelectionPosition.y * (-1), SelectionPosition.w, SelectionPosition.h, $('#editModalImage').width(), $('#editModalImage').height(), function(canvas){
            canvas.toBlob(function(file){
                var data = new FormData();
                data.append('file', file);
                
                $.ajax($(self).attr('action'), {
                   type: 'POST',
                   data: data,
                   processData: false,
                   contentType: false,
                   error: function(e) {
                       window.location.reload();
                   },
                   
                   success: function(e) {
                       window.location.reload();
                   }
                });
                $('#editModal').modal('hide');
            }, 'image/jpeg');
        });
    });
});

CropImage = function(image, posX, posY, canvasWidth, canwasHeight,  width, height, cullback) {
    var canvas = $('<canvas></canvas>')[0];
	canvas.width = canvasWidth;
    canvas.height = canwasHeight;
    canvas.getContext('2d').drawImage(image, posX, posY, width, height);
    if(cullback) {
        cullback(canvas);
    }
    var data = canvas.toDataURL('image/png');
    return data;
}
