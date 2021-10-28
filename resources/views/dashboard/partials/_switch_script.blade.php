<script>
    $('body').on('change', '.switchType', function (e) { 
            var form = $(this).closest('form');
                data = form.serialize(),
                route = form.attr('action');
           $.ajax({
            type: "post",
            url: route,
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response);
            }
        });
     })
 
</script>