{{--moment--}}
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
{{--fullcalendar--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"
        integrity="sha256-MDHWvW/uBfL2FEZwh9gqePZTrrxfCgNlQelyThMV8/c=" crossorigin="anonymous"></script>
<script>
    calendarContainer = $('#calendar');

    $(document).ready(function () {

        users = {!!json_encode($users)!!};

        var inputOptions = {};

        for (var i = 0; i < users.length; i++) {
            if (!users[i].last_name) {
                users[i].last_name = "";
            }
            inputOptions[users[i].email] = users[i].first_name + " " + users[i].last_name;
        }

        $.ajax({
            url: "{{route('schedule_get')}}",
            method: 'get',
            success: function (response) {
                response[0].map(function (item) {
                    return item.dow = [item.dow];
                });

                calendarContainer.fullCalendar('option', {
                    businessHours: response[0],
                    minTime: response[1], //min value from schedule
                    maxTime: response[2], //max value from schedule
                    selectConstraint: 'businessHours',
                    scrollTime: '09:00:00'
                });

            }
        });

        calendarContainer.fullCalendar({
            header: {
                left: 'prev, title, next',
                center: 'today',
                right: 'agendaWeek, month'
            },
            selectable: true,
            selectHelper: true,
            unselectAuto: false,
            editable: false,
            defaultView: 'agendaWeek', //month
            weekNumberCalculation: 'ISO',
            height: $(document).height() - 100,
            allDaySlot: false,
            slotLabelFormat: 'HH:mm',

            events:
                {
                    url: "{{route('shifts_show')}}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
            eventStartEditable: false,

            select: function (start, end) {
                startTime = moment(start).format('Do of MMM - HH:mm');
                endTime = moment(end).format('Do of MMM - HH:mm');

                $(document).on('focus', '#datepicker', function () {
                    $(this).daterangepicker({
                        startDate: start,
                        endDate: end,
                        locale: {
                            format: 'Do of MMM - HH:mm'
                        },
                        dateLimit: {
                            days: 1
                        },
                        timePicker: true,
                        timePickerIncrement: 30,
                        timePicker24Hour: true,
                        opens: 'center',
                    });

                    $('#datepicker').on('apply.daterangepicker', function (ev, picker) {
                        start = picker.startDate;
                        end = picker.endDate;
                    });
                });

                swal({
                    title: 'Select employee',
                    html: 'Check interval </br> <input class="col-md-10" type="text" id="datepicker" value="' + startTime + ' to ' + endTime + '">',
                    input: 'select',
                    inputOptions: inputOptions,
                    inputPlaceholder: 'Select employee',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    inputValidator: function (value) {
                        return new Promise(function (resolve, reject) {
                            if (!value) {
                                reject('Please select an employee')
                            } else {
                                $.ajax({
                                    url: "{{route('shifts_store')}}",
                                    method: "POST",
                                    data: {
                                        email: value,
                                        start: moment(start).format(),
                                        end: moment(end).format()
                                    },
                                    success: function () {
                                        calendarContainer.fullCalendar('renderEvent', {
                                            "title": value,
                                            "start": moment(start).format(),
                                            "end": moment(end).format()
                                        });
                                        resolve()
                                    },
                                    error: function (error) {
                                        if (error.status === 422) {
                                            error = error.responseJSON;
                                            $.each(error, function (key, value) {
                                                reject(value[0])
                                            })
                                        }
                                    }
                                });
                            }
                        })
                    }
                }).then(function () {
                    swal({
                        type: 'success',
                        html: 'Shift added!'
                    });
                    calendarContainer.fullCalendar('refetchEvents')
                }, function (dismiss) {
                    calendarContainer.fullCalendar('unselect')
                }).catch(swal.noop);
            },
            eventClick: function (calEvent) {
                console.log(calEvent);
            }

        });
    });

</script>