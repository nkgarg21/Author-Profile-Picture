jQuery(document).ready(function($) {
    var mediaUploader;
    
    // Upload button click
    $('#upload_profile_picture_button').click(function(e) {
        e.preventDefault();
        
        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        
        // Create the media uploader
        mediaUploader = wp.media({
            title: 'Choose Profile Picture',
            button: {
                text: 'Choose Picture'
            },
            multiple: false,
            library: {
                type: 'image'
            }
        });
        
        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#profile_picture_id').val(attachment.id);
            
            // Update the preview
            var imageHtml = '<img src="' + attachment.url + '" style="max-width: 150px; height: auto; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);" />';
            $('#profile-picture-container').html(imageHtml);
            
            // Update button text and show remove button
            $('#upload_profile_picture_button').text('Change Picture');
            if ($('#remove_profile_picture_button').length === 0) {
                $('#upload_profile_picture_button').after('<button type="button" class="button" id="remove_profile_picture_button">Remove Picture</button>');
            }
        });
        
        // Open the uploader dialog
        mediaUploader.open();
    });
    
    // Remove button click (using event delegation for dynamically added button)
    $(document).on('click', '#remove_profile_picture_button', function(e) {
        e.preventDefault();
        
        // Clear the hidden field
        $('#profile_picture_id').val('');
        
        // Clear the preview
        $('#profile-picture-container').html('');
        
        // Update button text and hide remove button
        $('#upload_profile_picture_button').text('Upload Picture');
        $(this).remove();
    });
});