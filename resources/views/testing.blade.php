<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <form class="input-group input-group-sm mb-3 dropdown mr-5" style="position: relative;">
        <!-- <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
        </div> -->
        <!-- <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="search"> -->
        <input type="text" name="lokasi" id="search_lokasi">
        <div class="dropdown-menu hide" aria-labelledby="search_lokasi" style="position: absolute; top: 100%;">
            <!-- Dynamic search results will be appended here -->
        </div>
    </form>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#search_lokasi').on('keyup', function(e) {
                e.preventDefault();
                let query = $(this).val();
                $.ajax({
                    url: '/api/lokasi' + '?nama=' + query,
                    type: 'GET',
                    success: function(response) {
                        let dropdown = $('.dropdown-menu');
                        var data = response.data;
                        dropdown.removeClass('hide');
                        dropdown.addClass('show');
                        dropdown.empty();
                        $.each(data, function(index, item) {
                            dropdown.append('<a class="dropdown-item" href="#">' + item.nama_lokasi + '</a>');
                        });
                        // $('.dropdown-item').on('click', function() {
                        //     $('#search').val($(this).text());
                        //     dropdown.removeClass('show');
                        //     dropdown.addClass('hide');
                        // });
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        let dropdown = $('.dropdown-menu');
                        dropdown.removeClass('hide');
                        dropdown.addClass('show');
                        dropdown.empty();
                        if(errorResponse.http_code == 500) {
                            dropdown.append('<a class="dropdown-item disabled" href="#">' + errorResponse.message + '</a>');
                            return;
                        }
                        dropdown.append('<a class="dropdown-item disabled" href="#">' + errorResponse.message + '</a>');
                    }
                })
            })
            $('#search_lokasi').on('blur', function() {
                setTimeout(function() {
                    let dropdown = $('.dropdown-menu');
                    dropdown.removeClass('show');
                    dropdown.addClass('hide');
                }, 200);
            })
            $('.dropdown-menu').on('click', '.dropdown-item', function() {
                $('#search_lokasi').val($(this).text());
                let dropdown = $('.dropdown-menu');
                dropdown.removeClass('show');
                dropdown.addClass('hide');
            });
        });
    </script>
</body>
</html>