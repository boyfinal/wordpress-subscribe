"use strict";
jQuery(function ($) {
    $('.frm_subscribe.frm_mailchimp').on('submit', function(event) {
        event.preventDefault();
        /* Act on the event */
        var data    = $(this).serialize(),
            url     = $(this).attr('data-url'),
            self    = $(this);

        data += '&action=farost_subscribe_ajax';
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (results) {
                var output = $('.farost_subscribe_status', self);
                output.html(results.message);
                if (results.error == 1) {
                    output.addClass('error');
                } else {
                    output.removeClass('error');
                    self.get(0).reset();
                }
            }
        });
    });
});