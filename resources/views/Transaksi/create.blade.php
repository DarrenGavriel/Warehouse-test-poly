<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css/transaksi/create.css') }}">
</head>
<body>
    <form id="transaksiForm" class="transaksi-form">
        <div class="select-lokasi">
            <input type="text" name="" value="Pilih" id="" readonly>
        </div>
        <div class="dropdown-lokasi">
            <div class="search-lokasi">
                <input type="text" name="lokasi_display" id="search_lokasi" placeholder="Cari lokasi...">
                <input type="hidden" name="id_lokasi" id="id_lokasi" value="">
            </div>
            <ul id="lokasi_list">
                <!-- ini buat append -->
            </ul>
        </div>
        <div class="select-barang">
            <input type="text" name="" value="Pilih" id="" readonly>
        </div>
        <div class="dropdown-barang">
            <div class="search-barang">
                <input type="text" name="barang_display" id="search_barang" placeholder="Cari barang...">
                <input type="hidden" name="id_barang" id="id_barang" value="">
            </div>
            <ul id="barang_list">
                <!-- ini buat append -->
            </ul>
        </div>
    </form>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas iste eius doloremque adipisci delectus facere. Ea, molestias enim! Sequi illum molestiae est tempore unde corrupti reprehenderit fuga consectetur! Perferendis, doloremque.
    Voluptatum, ipsum! Dicta iste optio modi temporibus repudiandae sit obcaecati culpa nulla aperiam, atque, accusantium rerum voluptate vel ad et, harum reiciendis aliquid officia at odit delectus? Culpa, sit! Pariatur!
    Earum eaque libero, vero enim consectetur mollitia doloremque asperiores. Incidunt ratione labore voluptatibus dolorum repellat modi culpa autem reiciendis saepe explicabo vitae dolore nostrum cum exercitationem sapiente soluta, dolorem eos!
    Ab aliquam ipsa, et nulla autem numquam aut neque cum, quisquam repudiandae ducimus dolorem mollitia quasi voluptatibus quo ex quis delectus vero aspernatur. At suscipit unde reiciendis facilis necessitatibus animi!
    Commodi perferendis quas eum? Accusamus exercitationem numquam hic iure natus ratione aspernatur. Quidem voluptatem neque asperiores vero perspiciatis consequuntur, officia obcaecati facere, eum eos harum reprehenderit tenetur dicta dolores corrupti.
    Non voluptates vel autem soluta mollitia aliquam accusamus, ratione eos. Nisi in obcaecati corporis autem, temporibus corrupti deserunt! Accusamus repellendus quibusdam eligendi vel officiis itaque asperiores est repellat, exercitationem quidem!
    Earum, dolore? Aspernatur cupiditate officiis architecto necessitatibus. Ipsam amet placeat cupiditate autem ea eos error natus, voluptatum recusandae fugiat sequi sapiente beatae ratione distinctio, cum quidem at quos blanditiis. Beatae.
    Aut quaerat reiciendis fuga similique quibusdam consequuntur iusto perferendis iure aperiam nesciunt mollitia, minus voluptates dicta officiis adipisci ullam possimus alias id cumque unde eligendi cupiditate quisquam. Vero, eligendi fugiat!
    Praesentium ullam accusantium consectetur numquam et deserunt quod inventore, suscipit sit odio dolorum alias! Quis, unde eaque. Saepe similique, aspernatur quam quo nobis expedita accusantium! Natus provident quibusdam possimus asperiores?
    Sequi quis iure error, quod et quos esse enim soluta ad accusantium, vitae laborum. Non dolorum nisi provident quo, saepe modi delectus ratione cumque voluptate eaque doloremque quasi alias unde?</p>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-lokasi').click(function() {
                $('.dropdown-lokasi').toggleClass('active');
                $('.dropdown-barang').removeClass('active');
            });
            $('.select-barang').click(function() {
                $('.dropdown-barang').toggleClass('active');
                $('.dropdown-lokasi').removeClass('active');
            });
            $('#lokasi_list').on('click', '.dropdown-item', function() {
                var text = $(this).find('.lokasi-kode').text();
                var id = $(this).data('id');
                $('.transaksi-form .select-lokasi input').val(text);
                $('#id_lokasi').val(id);
                $('.dropdown-lokasi').removeClass('active');
            });
            $('#barang_list').on('click', '.dropdown-item', function() {
                var text = $(this).find('.barang-kode').text();
                var id = $(this).data('id');
                $('.transaksi-form .select-barang input').val(text);
                $('#id_barang').val(id);
                $('.dropdown-barang').removeClass('active');
            });
            LoadDataLokasi();
            LoadDataBarang();
            function LoadDataLokasi() {
                $.ajax ({
                    url: '/api/lokasi',
                    type: 'GET',
                    success: function(response) {
                        var lokasiList = response.data;
                        var dropdownList = $('.transaksi-form .dropdown-lokasi ul');
                        dropdownList.empty();
                        var defaultItem = $('<li class="dropdown-item read-only">Pilih Lokasi</li>');
                        dropdownList.append(defaultItem);
                        $.each(lokasiList, function(index, lokasi){
                            var listItem = $('<li class="dropdown-item" data-id="' + lokasi.id + '"><span class="lokasi-kode">' + lokasi.kode_lokasi + '</span><span class="lokasi-nama">' + lokasi.nama_lokasi + '</span></li>');
                            dropdownList.append(listItem);
                        })
                    }, 
                    error: function(xhr) {
                        console.log('Error loading lokasi data');
                    }   
                })
            }
            $('#search_lokasi').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $.ajax({
                    url: '/api/lokasi?search=' + value,
                    type: 'GET',
                    success: function(response) {
                        var lokasiList = response.data;
                        var dropdownList = $('.transaksi-form .dropdown-lokasi ul');
                        dropdownList.empty();
                        var defaultItem = $('<li class="dropdown-item read-only">Pilih Lokasi</li>');
                        dropdownList.append(defaultItem);
                        $.each(lokasiList, function(index, lokasi){
                            var listItem = $('<li class="dropdown-item" data-id="' + lokasi.id + '"><span class="lokasi-kode">' + lokasi.kode_lokasi + '</span><span class="lokasi-nama">' + lokasi.nama_lokasi + '</span></li>');
                            dropdownList.append(listItem);
                        })
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        var dropdownList = $('#lokasi_list');
                        dropdownList.empty();
                        var noDataItem = $('<li class="dropdown-item read-only">' + errorResponse.message + '</li>');
                        dropdownList.append(noDataItem);
                    }
                })
            })
            function LoadDataBarang() {
                $.ajax ({
                    url: '/api/barang',
                    type: 'GET',
                    success: function(response) {
                        var barangList = response.data;
                        var dropdownList = $('.transaksi-form .dropdown-barang ul');
                        dropdownList.empty();
                        var defaultItem = $('<li class="dropdown-item read-only">Pilih Barang</li>');
                        dropdownList.append(defaultItem);
                        $.each(barangList, function(index, barang){
                            var listItem = $('<li class="dropdown-item" data-id="' + barang.id + '"><span class="barang-kode">' + barang.kode_barang + '</span><span class="barang-nama">' + barang.nama_barang + '</span></li>');
                            dropdownList.append(listItem);
                        })
                    }, 
                    error: function(xhr) {
                        console.log('Error loading barang data');
                    }   
                })
            }
            $('#search_barang').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $.ajax({
                    url: '/api/barang?search=' + value,
                    type: 'GET',
                    success: function(response) {
                        var barangList = response.data;
                        var dropdownList = $('.transaksi-form .dropdown-barang ul');
                        dropdownList.empty();
                        var defaultItem = $('<li class="dropdown-item read-only">Pilih Barang</li>');
                        dropdownList.append(defaultItem);
                        $.each(barangList, function(index, barang){
                            var listItem = $('<li class="dropdown-item" data-id="' + barang.id + '"><span class="barang-kode">' + barang.kode_barang + '</span><span class="barang-nama">' + barang.nama_barang + '</span></li>');
                            dropdownList.append(listItem);
                        })
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        var dropdownList = $('#barang_list');
                        dropdownList.empty();
                        var noDataItem = $('<li class="dropdown-item read-only">' + errorResponse.message + '</li>');
                        dropdownList.append(noDataItem);
                    }
                })
            })
    });
    </script>
</body>
</html>