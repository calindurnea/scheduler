<!-- Scripts -->
{{--jquery--}}
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="{{ asset('js/app.js') }}"></script>

{{--sweetalert--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"
        integrity="sha256-egVvxkq6UBCQyKzRBrDHu8miZ5FOaVrjSqQqauKglKc=" crossorigin="anonymous"></script>

{{--sweetalert2--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"
        integrity="sha256-Cx9rA5vmyLN1w4VBrMl1cCaCD5FN7K+H1uTpf0/V+7s=" crossorigin="anonymous"></script>

@include('sweet::alert')
