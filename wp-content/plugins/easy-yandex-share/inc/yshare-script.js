jQuery(document).ready(function($) {
    $('.tcode').textillate({
        loop: true,
        minDisplayTime: 5000,
        initialDelay: 800,
        autoStart: true,
        inEffects: [],
        outEffects: [],
        in: {
            effect: 'rollIn',
            delayScale: 1.5,
            delay: 50,
            sync: false,
            shuffle: true,
            reverse: false,
            callback: function() {}
        },
        out: {
            effect: 'fadeOut',
            delayScale: 1.5,
            delay: 50,
            sync: false,
            shuffle: true,
            reverse: false,
            callback: function() {}
        },
        callback: function() {}
    });
})

jQuery(document).ready(function($) {

    var lookselect = jQuery('#look');
    if (jQuery('#look option:selected').val() == "iconsmenu" || jQuery('#look option:selected').val() == "countersmenu") {
        jQuery('.iconsmenutr').fadeIn();
    } else {
        jQuery('.iconsmenutr').hide();
    }
    lookselect.change(function() {
        if (jQuery('#look option:selected').val() == "iconsmenu" || jQuery('#look option:selected').val() == "countersmenu") {
            jQuery('.iconsmenutr').fadeIn();
        } else {
            jQuery('.iconsmenutr').hide();
        }
    });

})

String.prototype.replaceAll = function(search, replace){
  return this.split(search).join(replace);
}

jQuery(document).ready(function($) {
    var temp = jQuery('#nets').val();
    if (temp!==undefined) {
    if (temp.indexOf("collections") !== -1) {jQuery('#collections').attr("checked", "checked");}
    if (temp.indexOf("vkontakte") !== -1) {jQuery('#vkontakte').attr("checked", "checked");}
    if (temp.indexOf("facebook") !== -1) {jQuery('#facebook').attr("checked", "checked");}
    if (temp.indexOf("odnoklassniki") !== -1) {jQuery('#odnoklassniki').attr("checked", "checked");}
    if (temp.indexOf("moimir") !== -1) {jQuery('#moimir').attr("checked", "checked");}
    if (temp.indexOf("gplus") !== -1) {jQuery('#gplus').attr("checked", "checked");}
    if (temp.indexOf("pinterest") !== -1) {jQuery('#pinterest').attr("checked", "checked");}
    if (temp.indexOf("twitter") !== -1) {jQuery('#twitter').attr("checked", "checked");}
    if (temp.indexOf("blogger") !== -1) {jQuery('#blogger').attr("checked", "checked");}
    if (temp.indexOf("delicious") !== -1) {jQuery('#delicious').attr("checked", "checked");}
    if (temp.indexOf("digg") !== -1) {jQuery('#digg').attr("checked", "checked");}
    if (temp.indexOf("reddit") !== -1) {jQuery('#reddit').attr("checked", "checked");}
    if (temp.indexOf("evernote") !== -1) {jQuery('#evernote').attr("checked", "checked");}
    if (temp.indexOf("linkedin") !== -1) {jQuery('#linkedin').attr("checked", "checked");}
    if (temp.indexOf("lj") !== -1) {jQuery('#lj').attr("checked", "checked");}
    if (temp.indexOf("pocket") !== -1) {jQuery('#pocket').attr("checked", "checked");}
    if (temp.indexOf("qzone") !== -1) {jQuery('#qzone').attr("checked", "checked");}
    if (temp.indexOf("renren") !== -1) {jQuery('#renren').attr("checked", "checked");}
    if (temp.indexOf("sinaWeibo") !== -1) {jQuery('#sinaWeibo').attr("checked", "checked");}
    if (temp.indexOf("surfingbird") !== -1) {jQuery('#surfingbird').attr("checked", "checked");}
    if (temp.indexOf("tencentWeibo") !== -1) {jQuery('#tencentWeibo').attr("checked", "checked");}
    if (temp.indexOf("tumblr") !== -1) {jQuery('#tumblr').attr("checked", "checked");}
    if (temp.indexOf("viber") !== -1) {jQuery('#viber').attr("checked", "checked");}
    if (temp.indexOf("whatsapp") !== -1) {jQuery('#whatsapp').attr("checked", "checked");}
    if (temp.indexOf("skype") !== -1) {jQuery('#skype').attr("checked", "checked");}
    if (temp.indexOf("telegram") !== -1) {jQuery('#telegram').attr("checked", "checked");}
    }
});

jQuery(function() {
    jQuery('#collections').click(function(){
        if (jQuery('#nets').val().indexOf("collections") == -1) {
            temp = jQuery('#nets').val()  + "collections" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('collections,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});
jQuery(function() {
    jQuery('#vkontakte').click(function(){
        if (jQuery('#nets').val().indexOf("vkontakte") == -1) {
            temp = jQuery('#nets').val()  + "vkontakte" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('vkontakte,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});
jQuery(function() {
    jQuery('#facebook').click(function(){
        if (jQuery('#nets').val().indexOf("facebook") == -1) {
            temp = jQuery('#nets').val()  + "facebook" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('facebook,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});
jQuery(function() {
    jQuery('#odnoklassniki').click(function(){
        if (jQuery('#nets').val().indexOf("odnoklassniki") == -1) {
            temp = jQuery('#nets').val()  + "odnoklassniki" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('odnoklassniki,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
}); 

jQuery(function() {
    jQuery('#moimir').click(function(){
        if (jQuery('#nets').val().indexOf("moimir") == -1) {
            temp = jQuery('#nets').val()  + "moimir" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('moimir,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
}); 

jQuery(function() {
    jQuery('#gplus').click(function(){
        if (jQuery('#nets').val().indexOf("gplus") == -1) {
            temp = jQuery('#nets').val()  + "gplus" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('gplus,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#pinterest').click(function(){
        if (jQuery('#nets').val().indexOf("pinterest") == -1) {
            temp = jQuery('#nets').val()  + "pinterest" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('pinterest,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#twitter').click(function(){
        if (jQuery('#nets').val().indexOf("twitter") == -1) {
            temp = jQuery('#nets').val()  + "twitter" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('twitter,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#blogger').click(function(){
        if (jQuery('#nets').val().indexOf("blogger") == -1) {
            temp = jQuery('#nets').val()  + "blogger" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('blogger,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#delicious').click(function(){
        if (jQuery('#nets').val().indexOf("delicious") == -1) {
            temp = jQuery('#nets').val()  + "delicious" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('delicious,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#digg').click(function(){
        if (jQuery('#nets').val().indexOf("digg") == -1) {
            temp = jQuery('#nets').val()  + "digg" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('digg,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#reddit').click(function(){
        if (jQuery('#nets').val().indexOf("reddit") == -1) {
            temp = jQuery('#nets').val()  + "reddit" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('reddit,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#evernote').click(function(){
        if (jQuery('#nets').val().indexOf("evernote") == -1) {
            temp = jQuery('#nets').val()  + "evernote" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('evernote,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#linkedin').click(function(){
        if (jQuery('#nets').val().indexOf("linkedin") == -1) {
            temp = jQuery('#nets').val()  + "linkedin" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('linkedin,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#lj').click(function(){
        if (jQuery('#nets').val().indexOf("lj") == -1) {
            temp = jQuery('#nets').val()  + "lj" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('lj,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#pocket').click(function(){
        if (jQuery('#nets').val().indexOf("pocket") == -1) {
            temp = jQuery('#nets').val()  + "pocket" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('pocket,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#qzone').click(function(){
        if (jQuery('#nets').val().indexOf("qzone") == -1) {
            temp = jQuery('#nets').val()  + "qzone" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('qzone,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#renren').click(function(){
        if (jQuery('#nets').val().indexOf("renren") == -1) {
            temp = jQuery('#nets').val()  + "renren" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('renren,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#sinaWeibo').click(function(){
        if (jQuery('#nets').val().indexOf("sinaWeibo") == -1) {
            temp = jQuery('#nets').val()  + "sinaWeibo" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('sinaWeibo,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#surfingbird').click(function(){
        if (jQuery('#nets').val().indexOf("surfingbird") == -1) {
            temp = jQuery('#nets').val()  + "surfingbird" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('surfingbird,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#tencentWeibo').click(function(){
        if (jQuery('#nets').val().indexOf("tencentWeibo") == -1) {
            temp = jQuery('#nets').val()  + "tencentWeibo" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('tencentWeibo,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#tumblr').click(function(){
        if (jQuery('#nets').val().indexOf("tumblr") == -1) {
            temp = jQuery('#nets').val()  + "tumblr" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('tumblr,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#viber').click(function(){
        if (jQuery('#nets').val().indexOf("viber") == -1) {
            temp = jQuery('#nets').val()  + "viber" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('viber,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#whatsapp').click(function(){
        if (jQuery('#nets').val().indexOf("whatsapp") == -1) {
            temp = jQuery('#nets').val()  + "whatsapp" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('whatsapp,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#skype').click(function(){
        if (jQuery('#nets').val().indexOf("skype") == -1) {
            temp = jQuery('#nets').val()  + "skype" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('skype,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});

jQuery(function() {
    jQuery('#telegram').click(function(){
        if (jQuery('#nets').val().indexOf("telegram") == -1) {
            temp = jQuery('#nets').val()  + "telegram" + ",";
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
        } else {
            temp = jQuery('#nets').val();
            temp = temp.replaceAll('telegram,', '');
            jQuery('#nets').val(temp);
            jQuery('#netsspan').val(temp);
            
        }
    })
});