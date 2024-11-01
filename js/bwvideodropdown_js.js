jQuery(document).ready(function(){
    jQuery("#VD_dropdown").change(function() {
        var videoVals = jQuery(this).val();
        var videoValsSplit = videoVals.split("-_-_-");
        jQuery("#VD_video").attr('src', 'https://www.youtube.com/embed/'+videoValsSplit[0]+
                                    '?autoplay='+videoValsSplit[1]+
                                    '&color='+videoValsSplit[2]+
                                    '&controls='+videoValsSplit[3]+
                                    '&disablekb='+videoValsSplit[4]+
                                    '&fs='+videoValsSplit[5]+
                                    '&iv_load_policy='+videoValsSplit[6]+
                                    '&modestbranding='+videoValsSplit[7]+
                                    '&rel='+videoValsSplit[8]+
                                    '&showinfo='+videoValsSplit[9]
                                );
        jQuery("#VD_video").attr('width', videoValsSplit[10]+'px');
        jQuery("#VD_video").attr('height', videoValsSplit[11]+'px');
    });
    
    jQuery('.bwvd_content').first().slideDown('fast');
      
	jQuery('.bwvd_button').on('click',function() {
		jQuery('.bwvd_content').slideUp('fast');
        var sectionID = jQuery(this).attr("id");
        if (sectionID == 'section_last') {
            jQuery('#section_last').removeClass("section_last");
        } else {
            jQuery('#section_last').addClass("section_last");
        }
		jQuery(this).next('.bwvd_content').slideDown('fast');
	});
});