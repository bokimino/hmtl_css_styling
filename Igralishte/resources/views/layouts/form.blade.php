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
    <script src="https://kit.fontawesome.com/3257d9ad29.js" crossorigin="anonymous"></script>
    <style>
        .size-checkbox {
            display: none;
        }

        .size-label {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-color: pink;
            border: 1px solid pink;
            margin-right: 10px;
            text-align: center;
            line-height: 30px;
            cursor: pointer;
        }

        .size-checkbox:checked+.size-label {
            background-color: #8A8328;

        }

        .fancyOlive {
            background-color: #8A8328;
        }

        .underline {
            border-bottom: 2px solid black;
            display: inline;
        }

        .color-label {
            display: inline-block;
            width: 30px;
            height: 30px;

            margin-right: 5px;
            cursor: pointer;
        }

        .size-checkbox:checked+.color-label {
            border: 3px solid black;

        }

        .image-preview {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid #ccc;
            display: none;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #fff;
            border: none;
            cursor: pointer;
        }

        .image-upload {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 36px;
            color: #ccc;
            cursor: pointer;
        }

        .square-box {
            width: 100%;
            padding-bottom: 100%;
            position: relative;
            background-color: #f8f9fa;
        }

        .square-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
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