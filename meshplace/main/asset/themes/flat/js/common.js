function redirect(url) {
    window.location = url;
}

/*
 * BEGIN : WS Function
 * Fungsi untuk mengambil data grid
 * Oleh : Warman Suganda
 * Dibuat pada : 27 Oktober 2013
 */
function round_up(n) {
    var str = String(n);
    var split = str.split('.');
    var x = parseInt(split[0]);
    var y = parseInt(split[1]);

    if (y > 0)
        x += 1;
    return x;
}

function get_data_grid(id, p) {
    var link = $('#' + id).attr('data-source');
    var thead = $('#' + id + ' thead tr th');

    var data = {page: p};
    $.get(link, data, function(out) {
        var table = xhr_result();
        var cp = 4; // Count Perpage
        var page = parseInt(table.page);
        var limit = parseInt(table.limit);
        var total = parseInt(table.total);
        var rows = table.rows;
        var tbody = '';
        $.each(rows, function(idx, row) {
            // Generate Baris
            tbody += '<tr>';
            $.each(thead, function() {
                var field = $(this).attr('field');
                var col;
                eval('( col = row.' + field + ')');
                // Generate Kolom
                tbody += '  <td>' + col + '</td>';
            });
            tbody += '</tr>';
        });
        $('#' + id + ' tbody').html(tbody);

        var showing_start = page * limit - limit + 1;
        var showing_end = showing_start + rows.length - 1;
        var paging = round_up(total / limit);

        var bp = round_up(page / cp);

        var footer = '';
        footer += '<div class="dataTables_info">Showing <span>' + showing_start + '</span> to <span>' + showing_end + '</span> of <span>' + total + '</span> entries</div>';
        footer += '<div class="dataTables_paginate paging_full_numbers">';

        var sector_left = '';
        var onclick_first = 'onclick="get_data_grid(\'' + id + '\', 1)"';
        var prev_pos = parseInt(page) - 1;
        var onclick_previous = 'onclick="get_data_grid(\'' + id + '\', ' + prev_pos + ')"';
        if (page === 1) {
            sector_left = '_disabled';
            onclick_first = '';
            onclick_previous = '';
        }
        footer += '<a href="javascript:void(0);" ' + onclick_first + ' class="first paginate_button paginate_button' + sector_left + '">First</a>';
        footer += '<a  href="javascript:void(0);" ' + onclick_previous + '  class="previous paginate_button paginate_button' + sector_left + '">Previous</a>';
        footer += '<span>';

        var c = 0;
        var i = bp * cp - 3;
        for (i; i <= paging; i++) {
            c++;
            if (page === i) {
                footer += '<a href="javascript:void(0);" class="paginate_active">' + i + '</a>';
            } else {
                footer += '<a href="javascript:void(0);" class="paginate_button" onclick="get_data_grid(\'' + id + '\', ' + i + ')">' + i + '</a>';
            }
            if (c === 4) {
                break;
            }
        }

        footer += '</span>';

        var sector_right = '';
        var onclick_last = 'onclick="get_data_grid(\'' + id + '\', ' + paging + ')"';
        var next_pos = parseInt(page) + 1;
        var onclick_next = 'onclick="get_data_grid(\'' + id + '\', ' + next_pos + ')"';
        if (page === paging) {
            sector_right = '_disabled';
            onclick_last = '';
            onclick_next = '';
        }
        footer += '<a href="javascript:void(0);" ' + onclick_next + '  class="next paginate_button' + sector_right + '">Next</a>';
        footer += '<a href="javascript:void(0);" ' + onclick_last + '  class="last paginate_button' + sector_right + '">Last</a>';
        footer += '</div>';

        $('#' + id + '-footer').html(footer);

    }, 'script');
}

/*
 * END : WS Function 
 */

$(function() {

    // By: Warman Suganda
    if ($('.ws-grid').length > 0) {
        var idx_grid = 0;

        $('.ws-grid').each(function() {

            var grid = $(this).html();
            var id = $(this).attr('id');//'ws-grid-' + idx_grid;
            var header = $(this).attr('header');
            var grid_class = $(this).attr('class');
            var data_source = $(this).attr('data-source');
            var table;

            table = '<div role="grid" class="dataTables_wrapper">';

            if (typeof header !== 'undefined')
                table += '  <div style="border-bottom:1px solid #ccc;">' + $(header).html() + '</div>';

            table += '  <div id style="overflow: auto;clear:both;">';
            table += '      <table id="' + id + '" class="' + grid_class + '" data-source="' + data_source + '">';
            table += grid;
            table += '      </table>';
            table += '  </div>';
            table += '  <div id="' + id + '-footer">';
            table += '  </div>';
            table += '</div>';

            $(this).before(table);
            $(header).remove();
            $(this).remove();

            get_data_grid(id, 1);

            idx_grid++;
        });
    }

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
                    
                    $('input[type=submit]').attr('disabled','disabled').val('Saving...');
                    $('input[type=reset]').attr('disabled','disabled');
                    
                    if (method === 'get') {
                        $.get(action, data, function(o) {
                            $('input[type=submit]').removeAttr("disabled").val('Save');
                            $('input[type=reset]').removeAttr("disabled");
                            eval('(' + handler + '(xhr_result())' + ')');
                        }, 'script');
                    } else {
                        $.post(action, data, function(o) {
                            $('input[type=submit]').removeAttr("disabled").val('Save');;
                            $('input[type=reset]').removeAttr("disabled");
                            eval('(' + handler + '(xhr_result())' + ')');
                        }, 'script');
                    }
                }
                return false;
            });
        });
    }

    $.fn.ajaxSubmit.debug = false;

    // Ajax Upload
    if ($('form.ajax-awesome').length > 0)
    {
        $('form.ajax-awesome').each(function() {
            var id = $(this).attr('id');
            $("#" + id).submit(function() {
                if ($(this).valid()) {
                    var handler = $(this).attr('data-action-handler');
                    $(this).attr('enctype', 'multipart/form-data');
                    $(this).ajaxSubmit({
                        beforeSubmit: function(a, f, o) {
                            o.dataType = 'script';
                        },
                        success: function(o) {
                            eval('(' + handler + '(xhr_result())' + ')');
                        }
                    });

                }
                return false;
            });
        });
    }
});

