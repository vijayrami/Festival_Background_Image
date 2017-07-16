jQuery.noConflict();
jQuery(document).
ready
(
        function()
        {
                        jQuery("#festivalbackground_backgroundcolor").hide();
                        jQuery("#festivalbackground_backgroundimage").show();
                        jQuery("label[for='festivalbackground_backgroundcolor']").hide();
                        jQuery("label[for='festivalbackground_backgroundimage']").show();
                		jQuery("input:radio:first").prop("checked", true);
                		jQuery("#festivalbackground_backgroundcolor").toggleClass("required-entry");
                		
                		
                jQuery("#festivalbackground_type1").click
                (
                        function()
                        {
                                jQuery("#festivalbackground_backgroundcolor").hide();
                                jQuery("label[for='festivalbackground_backgroundcolor']").hide();
                                jQuery("#festivalbackground_backgroundcolor").toggleClass("required-entry");
                                jQuery("#festivalbackground_backgroundimage").toggleClass("required-entry");
                                jQuery("#festivalbackground_backgroundimage").show();
                                jQuery("label[for='festivalbackground_backgroundimage']").show();
                                jQuery("#advice-required-entry-festivalbackground_backgroundcolor").hide();                    
                        }
                );
                
                jQuery("#festivalbackground_type2").click
                (
                        function()
                        {
                                jQuery("#festivalbackground_backgroundcolor").show();
                                jQuery("label[for='festivalbackground_backgroundcolor']").show();
                                jQuery("#festivalbackground_backgroundimage").hide();
                                jQuery("label[for='festivalbackground_backgroundimage']").hide();
                                jQuery("#festivalbackground_backgroundimage").toggleClass("required-entry");
                                jQuery("#festivalbackground_backgroundcolor").toggleClass("required-entry");
                                jQuery("#advice-required-entry-festivalbackground_backgroundimage").hide();                 
                        }
                );
        
        
        }
);
        
        
        

