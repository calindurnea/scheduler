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

        for (i = 0; i < users.length; i++) {
            if (!users[i].last_name) {
                users[i].last_name = "";
            }
            inputOptions[users[i].email] = users[i].first_name + " " + users[i].last_name;
        }

        $.ajax({
            url: "{{route('schedule_get')}}",
            method: 'get',
            success: function (response) {

                response[0].map(function (item, key) {
                    return item.dow = [item.dow];
                });

                calendarContainer.fullCalendar('option', {
                    businessHours: response[0],
                    minTime: response[1], //min value from schedule
                    maxTime: response[2], //max value from schedule
                    selectConstraint: 'businessHours',
                    scrollTime: '09:00:00',
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
            editable: true,
            defaultView: 'agendaWeek',
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
            eventStartEditable:
                false,

            select:

                function (start, end) {
                    shiftHourInterval = moment(start).format("HH:mm") + " - " + moment(end).format("HH:mm");
                    shiftDayInterval = moment(start).format("Do of MMM") + " - " + moment(end).format("Do of MMM");
                    swal({
                        title: 'Select employee',
                        html: shiftHourInterval + "</br>" + shiftDayInterval,
                        input: 'select',
                        inputOptions: inputOptions,
                        inputPlaceholder: 'Select employee',
                        showCancelButton: true,
                        allowOutsideClick: false,
                        inputValidator: function (value) {
                            return new Promise(function (resolve, reject) {
                                if (!value) {
                                    reject('Please select an employee')
                                } else if (!availableNewEvent(value, start)) {
                                    reject('This employee already has a shift in the same day!')

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
                                            console.log(error);
                                        }
                                    });
                                }
                            })
                        }
                    }).then(function (result) {
                        swal({
                            type: 'success',
                            html: 'Shift added!'
                        });
                    }).catch(swal.noop);
                }

            ,
        })
        ;

    });

    function availableNewEvent(selectionValue, selectionStart) {
        calendarEvents = calendarContainer.fullCalendar('clientEvents');
        selectionStart = moment(selectionStart).format();
        for (i = 0; i < calendarEvents.length; i++) {
            eventStart = moment(calendarEvents[i].start).format();
            if (calendarEvents[i].email === selectionValue && moment(selectionStart).isSame(eventStart, 'day')) {
                return false;
            }
        }
        return true;
    }
</script>