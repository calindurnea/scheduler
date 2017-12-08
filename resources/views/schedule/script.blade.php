<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $('.hour-picker').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '00:00',
        maxTime: '23:59',
        defaultTime: '9',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    function calculate(start, end) {
        var duration = parseInt(end.split(':')[0], 10) - parseInt(start.split(':')[0], 10);
        if (duration < 0) duration = 24 + duration;

        return duration;
    }

    $(document).on('click', '#save-schedule', function (e) {
        e.preventDefault();

        schedule = [
            {
                'dow': 1,
                'start': $('#monday-start').val(),
                'duration': calculate($('#monday-start').val(), $('#monday-end').val())
            },
            {
                'dow': 2,
                'start': $('#tuesday-start').val(),
                'duration': calculate($('#tuesday-start').val(), $('#tuesday-end').val())
            }, {
                'dow': 3,
                'start': $('#wednesday-start').val(),
                'duration': calculate($('#wednesday-start').val(), $('#wednesday-end').val())
            }, {
                'dow': 4,
                'start': $('#thursday-start').val(),
                'duration': calculate($('#thursday-start').val(), $('#thursday-end').val())
            }, {
                'dow': 5,
                'start': $('#friday-start').val(),
                'duration': calculate($('#friday-start').val(), $('#friday-end').val())
            }, {
                'dow': 6,
                'start': $('#saturday-start').val(),
                'duration': calculate($('#saturday-start').val(), $('#saturday-end').val())
            }, {
                'dow': 0,
                'start': $('#sunday-start').val(),
                'duration': calculate($('#sunday-start').val(), $('#sunday-end').val())
            },
        ]

        $.ajax({
            url: '{{route('schedules.store')}}',
            method: 'POST',
            data: schedule,
            // success: function (response) {
            //     console.log(response);
            // }
        })
        console.log(schedule);
    })

</script>