<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
            @yield('main')
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.selectpicker').select2();
        });
        function deleteImage(event,p_id,img,elem) {
            event.preventDefault();
            $.ajax({
                url: '/deleteImage/'+p_id+"/"+img,
                success: function(result){
                    let wrapper = elem.parentElement;
                    wrapper.parentElement.removeChild(wrapper);
                    $("#hidden_image").val(result);
                }
            });
        }
    </script>
</body>
</html>
