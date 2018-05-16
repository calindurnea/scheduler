<script>

    $('#delete-user').click(function () {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this! (yes, you will)",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            focusCancel: true,
        }).then(function () {
            $.ajax({
                url: '{{route('users.destroy', $user->id)}}',
                type: 'delete',
                success: function () {
                    window.location.href = "../users";
                }
            });

        }).catch(swal.noop)
    })

    dateRangeInput = $('input[name="shiftrange"]');
    selectedShifts = [];
    shiftsTable = $('#shifts-table');

    dateRangeInput.daterangepicker({
        startDate: moment().subtract(1, 'month'),
        endDate: moment(),
        showDropdowns: true,
        showWeekNumbers: true,
        autoApply: true,
        autoUpdateInput: true,
        locale: {
            firstDay: 1,
            format: 'YYYY-MM-DD'
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    dateRangeInput.on('apply.daterangepicker', function (ev, picker) {
        getShifts(picker.startDate, picker.endDate)
    });


    function runningFormatter(value, row, index) {
        return index;
    }

    function getShifts(startDate, endDate) {
        var inputStartDate = startDate.format();
        var inputEndDate = endDate.format();

        // console.log(inputStartDate, inputEndDate);
        $.ajax({
            url: '{{route('users.getShifts')}}',
            dataType: 'JSON',
            type: 'get',
            data: {
                id: '{{$user->id}}',
                start: inputStartDate,
                end: inputEndDate
            },
            success: function (shifts) {
                console.log(shifts);

                $('#shifts-table').bootstrapTable('load', shifts);
            }
        })

    }


    //initial call
    getShifts(moment().subtract(1, 'month'), moment())

    shiftsTable.on('check-all.bs.table', function (e, row) {
        for (var i = 0; i < row.length; i++) {
            selectedShifts.push({id: row[i].id, start: row[i].start, end: row[i].end, duration: row[i].duration})
        }
    })

    shiftsTable.on('check.bs.table', function (e, row) {
        selectedShifts.push({id: row.id, start: row.start, end: row.end, duration: row.duration});
    })

    shiftsTable.on('uncheck-all.bs.table', function (e, row) {
        selectedShifts = [];
    })

    shiftsTable.on('uncheck.bs.table', function (e, row) {
        $.each(selectedShifts, function (index, value) {
            if (value.id === row.id) {
                selectedShifts.splice(index, 1);
            }
        });
    });

    $('#mail-shifts').click(function () {
        if (selectedShifts.length === 0) {
            swal(
                'No shifts selected!',
                'Please select some shifts and try again.',
                'warning'
            ).catch(swal.noop)
        } else {
            swal({
                title: 'Email is being assembled...',
                text: 'Please be patient',
                onOpen: () => {
                    swal.showLoading()
                }
            });
            $.ajax({
                url: '{{route('shifts.sendmail')}}',
                data: {id: '{{$user->id}}', shifts: selectedShifts},
                type: 'post',
                success: function () {
                    swal(
                        'Email sent to',
                        '{{$user->first_name}} {{$user->last_name}}',
                        'success'
                    ).catch(swal.noop)
                },
                error: function (error) {
                    swal(
                        'Oops...',
                        'Something went wrong! Please try again',
                        'error'
                    )
                }
            })
        }
    })
</script>