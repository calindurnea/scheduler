<script>

    {{--$('.btn-edit').click(function () {--}}
    {{--editValue = $(this).text().trim().toLowerCase();--}}

    {{--switch (editValue) {--}}
    {{--case "name":--}}
    {{--swalObj = {--}}
    {{--input: "string",--}}
    {{--inputPlaceholder: '{{$user->first_name}} {{$user->last_name}}'--}}
    {{--};--}}
    {{--break;--}}
    {{--case "email":--}}
    {{--swalObj = {--}}
    {{--input: "email",--}}
    {{--inputPlaceholder: '{{$user->email}}'--}}
    {{--};--}}
    {{--break;--}}
    {{--case "phone":--}}
    {{--swalObj = {--}}
    {{--input: "number",--}}
    {{--inputPlaceholder: '{{$user->phone}}'--}}
    {{--};--}}
    {{--break;--}}
    {{--case "color":--}}
    {{--inputOptions = {};--}}
    {{--$.ajax({--}}
    {{--url: '{{route('colors_get')}}',--}}
    {{--method: 'get',--}}
    {{--success: function (colors) {--}}
    {{--for (var i = 0; i < colors.length; i++) {--}}
    {{--inputOptions[colors[i].id] = colors[i].hexCode;--}}
    {{--}--}}
    {{--}--}}
    {{--}--}}
    {{--);--}}

    {{--swalObj = {--}}
    {{--inputType: "select",--}}
    {{--inputOptions: inputOptions,--}}
    {{--inputPlaceholder: '{{$user->hexColor()}}'--}}
    {{--};--}}
    {{--break;--}}
    {{--case "position":--}}
    {{--inputType = "select";--}}
    {{--break;--}}
    {{--default:--}}
    {{--swal(--}}
    {{--'Oops...',--}}
    {{--'Something went wrong! Try again.',--}}
    {{--'error'--}}
    {{--);--}}
    {{--return;--}}
    {{--}--}}


    {{--swal({--}}
    {{--options: swalObj,--}}
    {{--showCancelButton: true,--}}
    {{--confirmButtonText: 'Submit',--}}
    {{--showLoaderOnConfirm: true,--}}
    {{--preConfirm:--}}
    {{--function (email) {--}}
    {{--return new Promise(function (resolve, reject) {--}}
    {{--setTimeout(function () {--}}
    {{--if (email === 'taken@example.com') {--}}
    {{--reject('This email is already taken.')--}}
    {{--} else {--}}
    {{--resolve()--}}
    {{--}--}}
    {{--}, 2000)--}}
    {{--})--}}
    {{--},--}}
    {{--allowOutsideClick: true--}}
    {{--}).then(function (email) {--}}
    {{--swal({--}}
    {{--swalObj,--}}
    {{--type: 'success',--}}
    {{--title: 'Ajax request finished!',--}}
    {{--html: 'Submitted email: ' + email--}}
    {{--})--}}
    {{--}).catch(swal.noop)--}}
    {{--});--}}

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
                method: 'delete',
                success: function () {
                    window.location.href = "../users";
                }
            });

        }).catch(swal.noop)
    })
</script>