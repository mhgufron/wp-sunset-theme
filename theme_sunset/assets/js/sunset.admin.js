jQuery(document).ready(function() {
    // Media Uploader
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

    // Function Live preview
    function livePreview(input, output, link = false) {
        $('#' + input).keyup(function(){
            if (link != false) {
                var data = link + $('#' + input).val();
                $('#' + output).attr('href', data);
            } else {
                var data = $('#' + input).val();
                $('#' + output).html(data);
            }
        });
    }

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

    livePreview('user_desciption', 'description_preview');
    livePreview('twitter_handler', 'twitter_preview', 'http://twitter.com/');
    livePreview('facebook_handler', 'facebook_preview', 'http://facebook.com/');
    livePreview('github_handler', 'github_preview', 'http://github.com/');

    $( '#remove-picture' ).on('click', function(e){
        e.preventDefault();
        var answer = confirm("Are you sure you want to remove your Profile Picture?");
        if ( answer == true ) {
            $('#profile-picture').val('');
            $('.sunset-general-form').submit();
        }
    });

})
