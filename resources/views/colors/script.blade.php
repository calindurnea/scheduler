<script>
    $('.color-list-item').hover(function () {
        initialText = $(this).text();
        initialOpacity = $(this).css('opacity');

        $(this).css('opacity', 1);
        $(this).html('<button class="btn btn-danger btn-delete-color">Delete</button>');
    }, function () {
        $(this).css('opacity', initialOpacity);
        $(this).html(initialText);
    });

    $(document).on('click', '.btn-delete-color', function () {
        colorId = $(this).parent().data('color-id');
        $.ajax({
            url: '{{route('colors_delete')}}',
            data: {id: colorId},
            method: 'POST'
        })
    })

    $('.btn-add-color').click(function () {

    })
</script>