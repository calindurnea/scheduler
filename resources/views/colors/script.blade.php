<script>

    @if(Session::has('message'))

    swal(
        'Success',
        '{{Session::get("message")}}',
        'success'
    )
    @endif

    $('.color-list-item').hover(function () {
        $(this).find('span').toggle();
        $(this).find('form').toggle();
    }, function () {
        $(this).find('span').toggle();
        $(this).find('form').toggle();
    });

    $(document).on('focus', '#colorpicker', function () {
        $(this).colorpicker({
            // inline: true,
            // container: true,
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }).on('change create', function (e) {
            const colorInput = $('#color-picker-input');
            colorInput.css('background-color', colorInput.val())
        });
    });

    $("#btn-add-color").click(function () {
        swal({
            title: 'Choose a color',
            html: '<div id="colorpicker" class="input-group colorpicker-component col-md-5 m-auto">' +
            '<input id="color-picker-input" autofocus type="text" value="#00AABB" class="form-control input-lg" />' +
            '<span class="input-group-addon"><i></i></span>' +
            '</div><br>',
            showCancelButton: true,
            confirmButtonText: 'Add',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                let colorInputVal = $('#color-picker-input').val();
                return new Promise((resolve, reject) => {
                    if (colorInputVal === "") {
                        reject('Please select a color')
                    } else {
                        $.ajax({
                            url: "{{route('colors.store')}}",
                            type: "POST",
                            data: {hexCode: colorInputVal},
                            success: function (response) {
                                resolve(swal({
                                    title: 'Color created',
                                    type: 'success'
                                }).catch(swal.noop));
                                window.location.reload()
                            },
                            error: function (error) {
                                if (error.status === 422) {
                                    error = error.responseJSON;
                                    $.each(error, function (key, value) {
                                        reject(value[0])
                                    })
                                }
                            }
                        })
                    }
                })
            },
            allowOutsideClick: () => !swal.isLoading()
        }).catch(swal.noop)
    })
</script>