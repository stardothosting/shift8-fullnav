jQuery(document).ready(function() {
console.log('test');
	// Opacity range sliders
	jQuery('#barTra').on('input', function() {
		jQuery('#barTraFilter').css('opacity', jQuery(this).val());
	});
	jQuery('#barTraFilter').css('opacity', jQuery('#barTra').val());
        jQuery('#ovrTra').on('input', function() {
                jQuery('#ovrTraFilter').css('opacity', jQuery(this).val());
        });
        jQuery('#ovrTraFilter').css('opacity', jQuery('#ovrTra').val());

        // media uploader
        // Instantiates the variable that holds the media library frame.
        var meta_image_frame;

        // Runs when the image button is clicked.
        jQuery('#shift8_fullnav_image_button').click(function(e){

                // Prevents the default action from occuring.
                e.preventDefault();

                // If the frame already exists, re-open it.
                if ( meta_image_frame ) {
                        meta_image_frame.open();
                        return;
                }

                // Sets up the media library frame
                meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                        title: shift8_fullnav_logo.title,
                        button: { text:  shift8_fullnav_logo.button },
                        library: { type: 'image' }
                });

                // Runs when an image is selected.
                meta_image_frame.on('select', function(){

                        // Grabs the attachment selection and creates a JSON representation of the model.
                        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

                        // Sends the attachment URL to our custom image input field.
                        jQuery('#shift8_fullnav_logo').val(media_attachment.url);
                });

                // Opens the media library frame.
                meta_image_frame.open();
        });
});

