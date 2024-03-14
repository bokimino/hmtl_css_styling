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

        /* Style for selected checkboxes */
        .size-checkbox:checked+.size-label {
            background-color: yellow;
            border-color: yellow;
        }

        .tagify {
            width: 100%;
            max-width: 700px;
        }

        .image-label {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 150px;
            height: 150px;
            border: 1px dashed #ccc;
            cursor: pointer;
        }

        .image-label i {
            font-size: 48px;
        }

        .image-preview {
            position: relative;
            display: inline-block;
            margin-right: 10px;
            width: 150px;
            /* Set the width of the image preview container */
            height: 150px;
            /* Set the height of the image preview container */
        }

        .image-preview img {
            display: block;
            max-width: 100%;
            /* Ensure the image does not exceed the width of its container */
            max-height: 100%;
            /* Ensure the image does not exceed the height of its container */
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
        }

        .remove-image i {
            color: red;
        }

        .image-upload {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const decreaseBtn = document.querySelector('.decrease');
            const increaseBtn = document.querySelector('.increase');
            const quantityInput = document.querySelector('input[name="quantity"]');

            // Event listener for the decrease button
            decreaseBtn.addEventListener('click', function() {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantity--;
                    quantityInput.value = quantity;
                }
            });

            // Event listener for the increase button
            increaseBtn.addEventListener('click', function() {
                let quantity = parseInt(quantityInput.value);
                quantity++;
                quantityInput.value = quantity;
            });
        });

        //Brendovi 
        $(document).ready(function() {
            $('#brand_id').change(function() {
                var brandId = $(this).val();
                if (brandId) {
                    $.ajax({
                        type: 'GET',
                        url: '/fetch-brand-categories/' + brandId,
                        success: function(response) {
                            var options = '<option value="">Select Brand Category</option>';
                            $.each(response, function(index, category) {
                                options += '<option value="' + category.id + '">' + category.name + '</option>';
                            });
                            $('#brand_category_id').html(options);
                        }
                    });
                } else {
                    $('#brand_category_id').html('<option value="">Select Brand Category</option>');
                }
            });
        });


        var input = document.getElementById('tag')

        new Tagify(input, {
            whitelist: [1, 2, 3, 4, 5],
            userInput: false
        })

        //This is IMAGES
        $(document).ready(function() {
            // Handle file input change
            $('#image-upload').change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').append('<div class="image-preview"><img src="'  + e.target.result + '" width="200px" height="200px"><span class="remove-image">X</span></div>');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Handle click on remove image
            $(document).on('click', '.remove-image', function() {
                $(this).parent('.image-preview').remove();
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const showCategoriesBtn = document.getElementById('show-categories-btn');
            const categoriesSelect = document.getElementById('brand_category_id');

            showCategoriesBtn.addEventListener('click', function() {
                categoriesSelect.style.display = 'block';
                showCategoriesBtn.style.display = 'none';
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const showCategoriesBtn = document.getElementById('show-categories-btn');
            const categoriesSelect = document.getElementById('brand_category_ids');

            showCategoriesBtn.addEventListener('click', function() {
                categoriesSelect.style.display = 'block';
                showCategoriesBtn.style.display = 'none';
            });
        });
    </script>
</body>

</html>