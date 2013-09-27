$(function() {
    // Ajax Submit
    if ($('form.ajax-submit').length > 0)
    {
        $('form.ajax-submit').each(function() {
            var id = $(this).attr('id');
            $("#" + id).submit(function() {
                if ($(this).valid()) {
                    var data = $(this).serialize();
                    var method = $(this).attr('method');
                    var action = $(this).attr('action');
                    var handler = $(this).attr('data-action-handler');
                    if (method === 'get') {
                        $.get(action, data, function(out) {
                            eval('(' + handler + '(out)' + ')');
                        }, 'json');
                    } else {
                        $.post(action, data, function(out) {
                            eval('(' + handler + '(out)' + ')');
                        }, 'json');
                    }
                }
                return false;
            });
        });
    }

    $.fn.ajaxSubmit.debug = true;

    // Ajax Upload
    if ($('form.ajax-upload').length > 0)
    {
        $('form.ajax-upload').each(function() {
            var id = $(this).attr('id');
            $("#" + id).submit(function() {
                if ($(this).valid()) {
                    var handler = $(this).attr('data-action-handler');
                    $(this).attr('enctype', 'multipart/form-data');
//                    $(this).ajaxSubmit({
//                        success: function(o) {
//                            var parOut = o.replace('<div id="LCS_336D0C35_8A85_403a_B9D2_65C292C39087_communicationDiv"></div>', '');
//                            if (parOut) {
//                                var out = eval('(' + parOut + ')');
//                                eval('(' + handler + '(out)' + ')');
//                            }
//                        }
//                    });

                    $(this).ajaxSubmit({
                        beforeSubmit: function(a, f, o) {
                            o.dataType = 'json';
                        },
                        success: function(data) {
                            alert(data);
//                            var $out = $('#uploadOutput');
//                            $out.html('Form success handler received: <strong>' + typeof data + '</strong>');
//                            if (typeof data == 'object' && data.nodeType)
//                                data = elementToString(data.documentElement, true);
//                            else if (typeof data == 'object')
//                                data = objToString(data);
//                            $out.append('<div><pre>' + data + '</pre></div>');
                        }
                    });

                }
                return false;
            });
        });
    }
});

