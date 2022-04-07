(function($) {
    $(document).on('click', 'a#vxdownload_info', function(event) {

        event.preventDefault();
    	var postid=jQuery(this).attr("data-id");
    	var successurl=jQuery(this).attr("href");
    	
        jQuery.ajax({
            url: vxdownload_monitor_data.ajaxurl,
            data: {
                action: 'vxdownload_increment_counter',
                postid: postid
            },
            type: 'POST',
            success: function(response) {
            window.open(successurl,'_blank');
            }
        })
        
    });
})(jQuery);