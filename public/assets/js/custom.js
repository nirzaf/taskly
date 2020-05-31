
$(document).on('click','a[data-ajax-popup="true"], button[data-ajax-popup="true"]',function () {
    var title = $(this).data('title');
    var size = ($(this).data('size') == '')?'md':$(this).data('size');
    var url = $(this).data('url');

    $("#commanModel .modal-title").html(title);
    $("#commanModel .modal-dialog").addClass('modal-'+size);
    $("#commanModel").modal('show');

    $.get(url, {}, function(data) {
        $('#commanModel .modal-body').html(data);
        animate();
        setTimeout(function(){ animate(); }, 200);
        LetterAvatar.transform();
    });

});

function toastr(title,message,type) {
    if(type == 'info') {
        iziToast.info({
            title: title,
            message: message,
            position: 'topRight'
        });
    }else if(type == 'error'){
        iziToast.error({
            title: title,
            message: message,
            position: 'topRight'
        });
    }
    else if(type == 'success'){
        iziToast.success({
            title: title,
            message: message,
            position: 'topRight'
        });
    }
}

$(document).on('click','.status-filter button',function(){
   var active_class = $(this).data('status');
   clear_animate();
   if(active_class =='All'){
       $(".filter").show();
   }
   else {
       $(".filter").hide();
       $("." + active_class).show();
   }
   animate();
});

function clear_animate() {
    $(animatedClass).removeAttr('style');
    $(animatedClass).removeAttr('data-sr-id');
}
function animate()
{
    sr.reveal(animatedClass,{afterReveal:function (el) {$(el).css('transform', 'none').css('transition', 'none')} }, 50);
}

$(document).ready(function(){
    window.sr = ScrollReveal();
    window.animatedClass = " .animated, .animated .form-group, .animated > tr, .animated tbody > tr, .animated > tr, .animated > li";
    animate();
});

/*
     * LetterAvatar
     *
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
(function(w, d){


    function LetterAvatar (name, size) {

        name  = name || '';
        size  = size || 60;

        var colours = [
                "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
                "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
            ],

            nameSplit = String(name).toUpperCase().split(' '),
            initials, charIndex, colourIndex, canvas, context, dataURI;


        if (nameSplit.length == 1) {
            initials = nameSplit[0] ? nameSplit[0].charAt(0):'?';
        } else {
            initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
        }

        if (w.devicePixelRatio) {
            size = (size * w.devicePixelRatio);
        }

        charIndex     = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
        colourIndex   = charIndex % 20;
        canvas        = d.createElement('canvas');
        canvas.width  = size;
        canvas.height = size;
        context       = canvas.getContext("2d");

        context.fillStyle = colours[colourIndex - 1];
        context.fillRect (0, 0, canvas.width, canvas.height);
        context.font = Math.round(canvas.width/2)+"px Arial";
        context.textAlign = "center";
        context.fillStyle = "#FFF";
        context.fillText(initials, size / 2, size / 1.5);

        dataURI = canvas.toDataURL();
        canvas  = null;

        return dataURI;
    }

    LetterAvatar.transform = function() {

        Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function(img, name) {
            name = img.getAttribute('avatar');
            img.src = LetterAvatar(name, img.getAttribute('width'));
            img.removeAttribute('avatar');
            img.setAttribute('alt', name);
        });
    };


    // AMD support
    if (typeof define === 'function' && define.amd) {

        define(function () { return LetterAvatar; });

        // CommonJS and Node.js module support.
    } else if (typeof exports !== 'undefined') {

        // Support Node.js specific `module.exports` (which can be a function)
        if (typeof module != 'undefined' && module.exports) {
            exports = module.exports = LetterAvatar;
        }

        // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
        exports.LetterAvatar = LetterAvatar;

    } else {

        window.LetterAvatar = LetterAvatar;

        d.addEventListener('DOMContentLoaded', function(event) {
            LetterAvatar.transform();
        });
    }

})(window, document);


$("input.date").datepicker();