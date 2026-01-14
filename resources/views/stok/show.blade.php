<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stok/show.css') }}">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/stok/laporan">Stok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/transaksi/laporan">Transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="">
                        <h3 class="fw-bold">Laporan Stok</h3>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">Filter by</button>
                </div>
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Kode Lokasi</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Saldo</th>
                                    <th>Tanggal Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- buat apend body tabel-->
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white py-3">
                        <div class="pagination-container">
                            <div class="text-muted small" id="info">
                                <!-- buat apend info -->
                            </div>
                            <nav class="pagination">
                                <!-- buat apend pagination -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="filterModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="filterForm">
                <div class="modal-body">
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Filter Lokasi</h6>
                        <div id="lokasi-list">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="id_lokasi" id="lokasi_semua" value="" checked>
                                <label class="form-check-label" for="lokasi_semua">
                                    Semua Lokasi
                                </label>
                            </div>
                            <!-- Lokasi options will be loaded here -->
                        </div>
                    </div>
                    <hr>
                    <div>
                        <h6 class="fw-bold mb-3">Filter Barang</h6>
                        <div id="barang-list">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="id_barang" id="barang_semua" value="" checked>
                                <label class="form-check-label" for="barang_semua">
                                    Semua Barang
                                </label>
                            </div>
                            <!-- Barang options will be loaded here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchLaporanStok() {
                var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                var searchParams = window.location.search;
                $.ajax({
                    url: '/api/stok/laporan' + searchParams,
                    method: 'GET',
                    cache: false,
                    success: function(response) {
                        var tableBody = $('tbody');
                        // var data = response.data;
                        console.log(response.data.data);
                        tableBody.empty();
                        $.each(response.data.data, function(index, stok){
                            var row = '<tr>' +
                                '<td class="text-center text-muted fw-medium">' + stok.kode_lokasi + '</td>' +
                                '<td class="text-center text-muted fw-medium">' + stok.kode_barang + '</td>' +
                                '<td class="text-center text-muted fw-medium">' + stok.nama_barang + '</td>' +
                                '<td class="text-center text-muted fw-medium">' + stok.total_saldo + '</td>' +
                                '<td class="text-center text-muted fw-medium">' + stok.tanggal_masuk + '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        })
                        var information = $('#info');
                        information.empty();
                        information.append('Menampilkan <strong>' + response.data.from + '</strong> dari <strong>' + response.data.total + '</strong> stok <span class="mx-1">|</span> Halaman <strong>' + response.data.current_page + '</strong> dari <strong>' + response.data.last_page + '</strong>');
                        var pagination = $('.pagination');
                        var url = new URLSearchParams(window.location.search);
                        
                        pagination.empty();
                        var paginationList = '<ul class="pagination mb-0">';
                        if(currentPage == 1){
                            paginationList += '<li class="disabled page-item">' +
                                '<a class="page-link"> Prev </a>' +
                                '</li>';
                        } else {
                            var prevPage = currentPage - 1;
                            url.set('page', prevPage);
                            paginationList += '<li class="page-item">' +
                                '<a href="?' + url.toString() + '" class="page-link"> Prev </a>' +
                                '</li>';
                        };
                        for (var i = 1; i <= response.data.last_page; i++){
                            url.set('page', i);
                            if(i == currentPage){
                                paginationList += '<li class="page-item active">' +
                                    '<a href="?' + url.toString() + '" class="page-link">' + i + '</a>' +
                                    '</li>';
                            }else{
                                paginationList += '<li class="page-item">' +
                                    '<a href="?' + url.toString() + '" class="page-link">' + i + '</a>' +
                                    '</li>';
                            }
                        }
                        if(currentPage == response.data.last_page){
                            paginationList += '<li class="disabled page-item">' +
                                '<a class="page-link"> Next </a>' +
                                '</li>';
                        } else {
                            var nextPage = ++currentPage;
                            url.set('page', nextPage);
                            paginationList += '<li class="page-item">' +
                                '<a href="?' + url.toString() + '" class="page-link"> Next </a>' +
                                '</li>';
                        };
                        pagination.append(paginationList);

                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        $('tbody').empty();
                        $('#info').empty();
                        $('.pagination').empty();
                        $('tbody').append('<tr><td colspan="5" class="text-center text-muted fw-medium"> ' + errorResponse.message + ' </td></tr>');
                    }
                })
            }
            fetchLaporanStok();
            $(document).on('click', '.page-link', function(e){
                e.preventDefault();
                var url = $(this).attr('href');
                window.history.pushState({}, '', url);
                fetchLaporanStok();
        });
        window.onpopstate = function() {
            fetchLaporanStok();
        };
        
        function fetchLokasi() {
            $.ajax({
                url: '/api/lokasi',
                method: 'GET',
                success: function(response) {
                    var lokasiList = $('#lokasi-list');
                    $.each(response.data, function(index, lokasi) {
                        var lokasiOption = '<div class="form-check">' +
                            '<input class="form-check-input" type="radio" name="id_lokasi" id="lokasi_' + lokasi.id + '" value="' + lokasi.id + '">' +
                                '<label class="form-check-label" for="lokasi_' + lokasi.id + '">' +
                                    lokasi.kode_lokasi + ' | ' + lokasi.nama_lokasi +
                                '</label>' +
                            '</div>';
                        lokasiList.append(lokasiOption);
                    });
                }
            })
        }
        function fetchBarang() {
            $.ajax({
                url: '/api/barang',
                method: 'GET',
                success: function(response) {
                    var barangList = $('#barang-list');
                    $.each(response.data, function(index, barang) {
                        var barangOption = '<div class="form-check">' +
                            '<input class="form-check-input" type="radio" name="id_barang" id="barang_' + barang.id + '" value="' + barang.id + '">' +
                                '<label class="form-check-label" for="barang_' + barang.id + '">' +
                                    barang.kode_barang + ' | ' + barang.nama_barang +
                                '</label>' +
                            '</div>';
                        barangList.append(barangOption);
                    });
                }
            })
        }
        fetchLokasi();
        fetchBarang();
        $('#filterForm').on('submit', function(e){
            e.preventDefault();
            var selectedLokasi = $('input[name="id_lokasi"]:checked').val();
            var selectedBarang = $('input[name="id_barang"]:checked').val();

            var params = new URLSearchParams(window.location.search);
            
            if (selectedLokasi) params.set('id_lokasi', selectedLokasi);
            else params.delete('id_lokasi');
            
            if (selectedBarang) params.set('id_barang', selectedBarang);
            else params.delete('id_barang');
            
            // Reset ke halaman 1 setiap kali filter berubah
            params.set('page', 1);

            // 3. Update URL di Address Bar Browser tanpa reload
            var newUrl = window.location.pathname + '?' + params.toString();
            window.history.pushState({}, '', newUrl);
            
            // 4. Panggil fungsi sakti yang akan ambil data berdasarkan URL sekarang
            $('#filterModal').modal('hide');
            // fetchLaporanStok(params.toString());
            fetchLaporanStok();
        });
        });
    </script>
</body>
</html>