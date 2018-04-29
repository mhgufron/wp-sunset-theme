jQuery(document).ready(function() {

    var mediaUploader;

    $( '#upload-button' ).on("click", function(e) {
        e.preventDefault();
        if( mediaUploader ) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Profile Picture',
            button: {
                text: 'Choose Picture',
            },
            multiple: false
        });

        mediaUploader.on('select', function(){
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#profile-picture').val(attachment.url);
            $('#profile-picture-preview').css('background-image', 'url(' + attachment.url + ')');
        });

        mediaUploader.open();

    });

    $('#first_name').keyup(function(){
        var firstName = $('#first_name').val();
        var lastName = $('#last_name').val();
        var fullName = firstName + ' ' + lastName;
        $('#full_name_preview').html(fullName);
    });

    $('#last_name').keyup(function(){
        var lastName = $('#last_name').val();
        var firstName = $('#first_name').val();
        var fullName = firstName + ' ' + lastName;
        $('#full_name_preview').html(fullName);
    });

    $('#user_desciption').keyup(function(){
        var description = $('#user_desciption').val();
        $('#description_preview').html(description);
    });
    // $('#user_desciption').keyup(function(){
    //     var description = $('#user_desciption').val();
    //     $('#description_preview').text(description);
    // })

})
