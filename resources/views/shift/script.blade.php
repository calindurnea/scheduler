{{--fullcalendar--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"
        integrity="sha256-MDHWvW/uBfL2FEZwh9gqePZTrrxfCgNlQelyThMV8/c=" crossorigin="anonymous"></script>

<script>

    @if(Session::has('flash_message'))
    swal({
        title: '{{ Session::get('flash_message') }}',
        type: '{{Session::get('flash_type')}}'
    })
    @endif

        calendarContainer = $("#calendar");

    $(document).ready(function () {

        shifts = {!! json_encode($shifts) !!};
        users = {!!json_encode($users)!!};

        var inputOptions = {};

        for (var i = 0; i < users.length; i++) {
            if (!users[i].last_name) {
                users[i].last_name = "";
            }
            inputOptions[users[i].email] = users[i].first_name + " " + users[i].last_name;
        }

        $.ajax({
            url: "{{route("schedules.index")}}",
            method: "GET",
            success: function (response) {
                response[0].map(function (item) {
                    return item.dow = [item.dow];
                });

                calendarContainer.fullCalendar("option", {
                    businessHours: response[0],
                    minTime: response[1], //min value from schedule
                    maxTime: response[2], //max value from schedule
                    selectConstraint: "businessHours",
                    scrollTime: "08:00:00"
                });

            }
        });

        calendarContainer.fullCalendar({
            header: {
                left: "prev, title, next",
                center: "today",
                right: "agendaWeek, month"
            },
            selectable: true,
            selectHelper: true,
            unselectAuto: false,
            editable: false,
            defaultView: "agendaWeek", // or  -  month
            weekNumberCalculation: "ISO",
            height: "auto",
            allDaySlot: false,
            slotLabelFormat: "HH:mm",
            events: shifts,
            eventStartEditable: false,
            select: function (start, end) {
                startTime = moment(start).format("Do of MMM - HH:mm");
                endTime = moment(end).format("Do of MMM - HH:mm");

                $(document).on("focus", "#datepicker", function () {
                    $(this).daterangepicker({
                        startDate: start,
                        endDate: end,
                        locale: {
                            format: "Do of MMM - HH:mm"
                        },
                        dateLimit: {
                            days: 1
                        },
                        timePicker: true,
                        timePickerIncrement: 30,
                        timePicker24Hour: true,
                        opens: "center",
                    });

                    $("#datepicker").on("apply.daterangepicker", function (ev, picker) {
                        start = picker.startDate;
                        end = picker.endDate;
                    });
                });

                swal({
                    title: "New shift",
                    html: "Check interval </br> <input class='col-md-10' type='text' id='datepicker' value='" + startTime + " to " + endTime + "'>",
                    input: "select",
                    inputOptions: inputOptions,
                    inputPlaceholder: "Select employee",
                    showCancelButton: true,
                    allowOutsideClick: false,
                    inputValidator: function (value) {
                        return new Promise(function (resolve, reject) {
                            if (!value) {
                                reject("Please select an employee")
                            } else {
                                $.ajax({
                                    url: "{{route("shifts.store")}}",
                                    method: "POST",
                                    data: {
                                        email: value,
                                        start: moment(start).format(),
                                        end: moment(end).format()
                                    },
                                    success: function () {
                                        window.location.reload();
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
                        type: "success",
                        html: "Shift added!"
                    });
                    calendarContainer.fullCalendar("refetchEvents")
                }, function (dismiss) {
                    calendarContainer.fullCalendar("unselect")
                }).catch(swal.noop);
            },
            eventClick: function (calEvent) {
                start = calEvent.start;
                end = calEvent.end;

                startTime = moment(calEvent.start).format("Do of MMM - HH:mm");
                endTime = moment(calEvent.end).format("Do of MMM - HH:mm");
                swal({
                    title: calEvent.title,
                    text: startTime + " to " + endTime,
                    showCloseButton: true,
                    showCancelButton: true,
                    cancelButtonText: "Delete",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Edit",
                }).then(function () {
                    $(document).on("focus", "#datepicker", function () {
                        $(this).daterangepicker({
                            startDate: start,
                            endDate: end,
                            locale: {
                                format: "Do of MMM - HH:mm"
                            },
                            dateLimit: {
                                days: 1
                            },
                            timePicker: true,
                            timePickerIncrement: 30,
                            timePicker24Hour: true,
                            opens: "center",
                        });

                        $("#datepicker").on("apply.daterangepicker", function (ev, picker) {
                            start = picker.startDate;
                            end = picker.endDate;
                        });
                    });
                    swal({
                        title: "Edit shift",
                        html: "Check interval </br> <input class='col-md-10' type='text' id='datepicker' value='" + startTime + " to " + endTime + "'>",
                        input: "select",
                        inputOptions: inputOptions,
                        inputPlaceholder: "Select employee",
                        inputValue: calEvent.email,
                        showCancelButton: true,
                        allowOutsideClick: false,
                        inputValidator: function (value) {
                            return new Promise(function (resolve, reject) {
                                if (!value) {
                                    reject("Please select an employee")
                                } else {
                                    $.ajax({
                                        url: "shifts/" + calEvent.id,
                                        method: "PUT",
                                        data: {
                                            email: value,
                                            start: moment(start).format(),
                                            end: moment(end).format()
                                        },
                                        success: function (shift) {
                                            window.location.reload();
                                        },
                                        error: function (error) {
                                            window.location.reload();
                                        }
                                    });
                                }
                            })
                        }
                    }).catch(swal.noop);
                }, function (dismiss) {
                    if (dismiss === "cancel") {
                        swal({
                                title: "Delete shift",
                                html: "Are you sure? <br><br>" + calEvent.title + "<br>" + startTime + " to " + endTime,
                                type: "warning",
                                confirmButtonText: "Yes"
                            }
                        ).then(function () {
                            $.ajax({
                                url: "shifts/" + calEvent.id,
                                method: "delete",
                                success: function () {
                                    window.location.reload();
                                },
                                error: function () {
                                    window.location.reload();
                                }
                            })
                        }).catch(swal.noop)
                    }
                }).catch(swal.noop);
            }

        });
    });

</script>