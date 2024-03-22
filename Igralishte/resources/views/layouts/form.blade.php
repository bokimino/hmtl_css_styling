<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <!-- Latest compiled and minified Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Latest Font-Awesome CDN -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    @yield('scripts')
    <script>
        //This is IMAGES
        $(document).ready(function() {
            $('.image-upload').change(function() {
                var inputId = $(this).attr('id').replace('upload', '');
                var previewId = '#preview' + inputId;
                var removeBtn = '#remove' + inputId;

                var file = this.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(previewId + ' img').attr('src', e.target.result);
                    $(previewId).show();
                }

                reader.readAsDataURL(file);
            });

            $('.remove-image').click(function() {
                var inputId = $(this).attr('id').replace('remove', '');
                var previewId = '#preview' + inputId;
                var fileInput = '#upload' + inputId;

                $(previewId + ' img').attr('src', '');
                $(previewId).hide();
                $(fileInput).val('');
            });
        });
    </script>
</body>

</html>