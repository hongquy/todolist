$(document).ready(function () {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultDate: moment(),
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: typeof list_todo !== "undefined" ? list_todo : [],
        eventClick: function (event) {
            var decision = confirm("Do you really want to do that?");
            var id = event.id;
            if (decision) {
                $.ajax({
                    type: "GET",
                    url: "/index.php",
                    dataType: 'json',
                    data: "op=delete&id=" + event.id
                });
                $('#calendar').fullCalendar('removeEvents', id);
            }
        },
        eventRender: function (event, element) {
            $(element).tooltip({title: 'Click this todo to delete it!'});
        },
        eventMouseover: function(calEvent, jsEvent) {
            var tooltip = '<div class="tooltipevent" style="width:200px;background:#ccc;position:absolute;z-index:10001; padding: 5px;">' +
                '<p> Title: ' + calEvent.title + '</p>' +
                '<p> Status:'+calEvent.status+'</p>' +
                '</div>';
            var $tooltip = $(tooltip).appendTo('body');

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                //$(this).css('background-color','red');
                $tooltip.fadeIn('500');
                $tooltip.fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $tooltip.css('top', e.pageY + 10);
                $tooltip.css('left', e.pageX + 20);
            });
        },

        eventMouseout: function(calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.tooltipevent').remove();
        },
    });

    $("#startdate").datepicker({
        autoclose: true,
        startDate: new Date(),
        format: 'yyyy-mm-dd',
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#enddate').datepicker('setStartDate', minDate);
    });

    $("#enddate").datepicker({
        autoclose: true,
        startDate: new Date(),
        format: 'yyyy-mm-dd',
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#startdate').datepicker('setEndDate', minDate);
    });
});
