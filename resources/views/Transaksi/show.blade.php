<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/transaksi/show.css') }}">
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
                    <div>
                        <h2 class="mb-0">Detail Transaksi</h2>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buatTransaksiModal">+ Buat Transaksi</button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">Filter</button>
                </div>
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <div class="table table-hover mb-0">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>bukti</th>
                                        <th>kode lokasi</th>
                                        <th>kode barang</th>
                                        <th>tanggal transaksi</th>
                                        <th>jam transaksi</th>
                                        <th>total transaksi</th>
                                        <th>tanggal masuk</th>
                                        <th>program</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- buat apend body tabel -->
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white py-3">
                            <div class="pagination-container">
                                <div class="text-muted small" id="info">
                                    <!-- buat apend info-->
                                </div>
                                <nav class="pagination">
                                    <!-- buat apend pagination-->
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="filterModalLabel">Modal filter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <form id="filterForm">
                    <div class="modal-body">
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Filter Bukti</h6>
                            <div id="bukti-list">
                                <div class="form-check">
                                    <input class="form-control" type="text" name="bukti" id="bukti" value="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-3">Filter Tanggal Transaksi</h6>
                            <div id="tanggal-transaksi-list">
                                <div class="form-check">
                                    <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
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
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="buatTransaksiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-create fs-5" id="filterModalLabel">Modal create</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div id="error-500" class="alert alert-danger mx-3 mt-3" style="display: none;" role="alert"></div>
                
                <form id="createForm">
                    <div class="modal-body">
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Jenis transaksi</h6>
                            <div id="jenis_transaksi-list">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_transaksi" id="jenis_transaksi_masuk" value="masuk">
                                    <label class="form-check-label" for="jenis_transaksi_masuk">Masuk</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_transaksi" id="jenis_transaksi_keluar" value="keluar">
                                    <label class="form-check-label" for="jenis_transaksi_keluar">keluar</label>
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-jenis_transaksi" style="display: none;"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-3">Bukti Transaksi</h6>
                            <div id="bukti_list">
                                <div class="form-check">
                                    <input type="text" class="form-control" id="bukti" name="bukti" value="">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-bukti" style="display: none;"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-3">Kode Lokasi</h6>
                            <div class="select-lokasi-modal">
                                <input type="text" value="Pilih Lokasi" readonly>
                            </div>
                            <div class="dropdown-lokasi-modal">
                                <div class="search-lokasi">
                                    <input type="text" name="lokasi_display" id="search_lokasi_modal" placeholder="Cari lokasi...">
                                    <input type="hidden" name="id_lokasi" id="id_lokasi_modal" value="">
                                </div>
                                <ul id="lokasi_list_modal">
                                    <!-- ini buat append -->
                                </ul>
                            </div>
                            <div class="text-danger small mt-1" id="error-id_lokasi" style="display: none;"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-3">Nama Barang</h6>
                            <div class="select-barang-modal">
                                <input type="text" value="Pilih Barang" readonly>
                            </div>
                            <div class="dropdown-barang-modal">
                                <div class="search-barang">
                                    <input type="text" name="barang_display" id="search_barang_modal" placeholder="Cari barang...">
                                    <input type="hidden" name="id_barang" id="id_barang_modal" value="">
                                </div>
                                <ul id="barang_list_modal">
                                    <!-- ini buat append -->
                                </ul>
                            </div>
                            <div class="text-danger small mt-1" id="error-id_barang" style="display: none;"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-3">Nama Program</h6>
                            <div class="select-program-modal">
                                <input type="text" value="Pilih Program" readonly>
                            </div>
                            <div class="dropdown-program-modal">
                                <div class="search-program">
                                    <input type="text" name="program_display" id="search_program_modal" placeholder="Cari program...">
                                    <input type="hidden" name="id_program" id="id_program_modal" value="">
                                </div>
                                <ul id="program_list_modal">
                                    <!-- ini buat append -->
                                </ul>
                            </div>
                            <div class="text-danger small mt-1" id="error-id_program" style="display: none;"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-3">Tanggal Transaksi</h6>
                            <div class="mb-3">
                                <input class="form-control" type="datetime-local" id="tgl_transaksi" name="tgl_transaksi" value="">
                            </div>
                            <div class="text-danger small mt-1" id="error-tgl_transaksi" style="display: none;"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-3">Jumlah</h6>
                            <div class="mb-3">
                                <input class="form-control" type="number" id="jumlah" name="quantity" value="0">
                            </div>
                            <div class="text-danger small mt-1" id="error-quantity" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
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
            var debounceTimer;
            // buat mengambil dan menampilkan data riwayat transaksi
            function fetchLaporanTransaksi() {
                var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                var searchParams = window.location.search;
                $.ajax({
                    url: '/api/transaksi/laporan' + searchParams,
                    method: 'GET',
                    success: function(response) {
                        var tableBody = $('tbody');
                        tableBody.empty();
                        console.log(response);
                        $.each(response.data.data, function(index, transaksi){
                            var row = '<tr>' +
                                '<td>' + transaksi.bukti_transaksi + '</td>' +
                                '<td>' + transaksi.kode_lokasi + '</td>' +
                                '<td>' + transaksi.kode_barang + '</td>' +
                                '<td>' + transaksi.tanggal_transaksi + '</td>' +
                                '<td>' + transaksi.jam_transaksi + '</td>' +
                                '<td>' + transaksi.total_transaksi + '</td>' +
                                '<td>' + transaksi.tanggal_masuk + '</td>' +
                                '<td>' + transaksi.program + '</td>' +
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
            fetchLaporanTransaksi();
            // handle ketika user pakai pagination
            $(document).on('click', '.page-link', function(e){
                e.preventDefault();
                var url = $(this).attr('href');
                window.history.pushState({}, '', url);
                fetchLaporanTransaksi();
            })
            // handle ketika user pakai undo/ redo di browser
            window.onpopstate = function() {
                fetchLaporanTransaksi();
            };
            // buat load data lokasi list di filter modal
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
            // buat load data barang list di filter modal
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

            // untuk handle dropdown di modal create
            $('.select-lokasi-modal').on('click', function() {
                $('.dropdown-lokasi-modal').toggleClass('active');
                $('.dropdown-barang-modal').removeClass('active');
                $('.dropdown-program-modal').removeClass('active');
            });
            $('.select-barang-modal').on('click', function() {
                $('.dropdown-barang-modal').toggleClass('active');
                $('.dropdown-lokasi-modal').removeClass('active');
                $('.dropdown-program-modal').removeClass('active');
            });
            $('.select-program-modal').on('click', function() {
                $('.dropdown-program-modal').toggleClass('active');
                $('.dropdown-lokasi-modal').removeClass('active');
                $('.dropdown-barang-modal').removeClass('active');
            });
            // Buat ngambil dan menaruh value dari pilihan ke select lokasi
            $('#lokasi_list_modal').on('click', '.dropdown-item', function() {
                var text = $(this).find('.lokasi-kode').text();
                var id = $(this).data('id');
                $('.select-lokasi-modal input').val(text);
                $('#id_lokasi_modal').val(id);
                $('.dropdown-lokasi-modal').removeClass('active');
            });
            // Buat ngambil dan menaruh value dari pilihan ke select barang
            $('#barang_list_modal').on('click', '.dropdown-item', function() {
                var text = $(this).find('.barang-kode').text();
                var id = $(this).data('id');
                $('.select-barang-modal input').val(text);
                $('#id_barang_modal').val(id);
                $('.dropdown-barang-modal').removeClass('active');
            });
            // Buat ngambil dan menaruh value dari pilihan ke select program
            $('#program_list_modal').on('click', '.dropdown-item', function() {
                var text = $(this).find('.program-kode').text();
                var id = $(this).data('id');
                $('.select-program-modal input').val(text);
                $('#id_program_modal').val(id);
                $('.dropdown-program-modal').removeClass('active');
            });
            
            // Load data untuk dropdown modal create
            function LoadDataLokasiModal() {
                $.ajax({
                    url: '/api/lokasi',
                    type: 'GET',
                    success: function(response) {
                        var lokasiList = response.data;
                        var dropdownList = $('#lokasi_list_modal');
                        dropdownList.empty();
                        var defaultItem = $('<li class="dropdown-item read-only">Pilih Lokasi</li>');
                        dropdownList.append(defaultItem);
                        $.each(lokasiList, function(index, lokasi){
                            var listItem = $('<li class="dropdown-item" data-id="' + lokasi.id + '"><span class="lokasi-kode">' + lokasi.kode_lokasi + '</span><span class="lokasi-nama">' + lokasi.nama_lokasi + '</span></li>');
                            dropdownList.append(listItem);
                        });
                    }, 
                    error: function(xhr) {
                        console.log('Error loading lokasi data');
                    }
                });
            }
            //buat nyari lokasi di modal create
            $('#search_lokasi_modal').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    $.ajax({
                        url: '/api/lokasi?search=' + value,
                        type: 'GET',
                        success: function(response) {
                            var lokasiList = response.data;
                            var dropdownList = $('#lokasi_list_modal');
                            dropdownList.empty();
                            var defaultItem = $('<li class="dropdown-item read-only">Pilih Lokasi</li>');
                            dropdownList.append(defaultItem);
                            $.each(lokasiList, function(index, lokasi){
                                var listItem = $('<li class="dropdown-item" data-id="' + lokasi.id + '"><span class="lokasi-kode">' + lokasi.kode_lokasi + '</span><span class="lokasi-nama">' + lokasi.nama_lokasi + '</span></li>');
                                dropdownList.append(listItem);
                            });
                        },
                        error: function(xhr) {
                            var errorResponse = xhr.responseJSON;
                            var dropdownList = $('#lokasi_list_modal');
                            dropdownList.empty();
                            var noDataItem = $('<li class="dropdown-item read-only">' + errorResponse.message + '</li>');
                            dropdownList.append(noDataItem);
                        }
                    });
                }, 500);
            });
            //buat load data barang list di create modal
            function LoadDataBarangModal() {
                $.ajax({
                    url: '/api/barang',
                    type: 'GET',
                    success: function(response) {
                        var barangList = response.data;
                        var dropdownList = $('#barang_list_modal');
                        dropdownList.empty();
                        var defaultItem = $('<li class="dropdown-item read-only">Pilih Barang</li>');
                        dropdownList.append(defaultItem);
                        $.each(barangList, function(index, barang){
                            var listItem = $('<li class="dropdown-item" data-id="' + barang.id + '"><span class="barang-kode">' + barang.kode_barang + '</span><span class="barang-nama">' + barang.nama_barang + '</span></li>');
                            dropdownList.append(listItem);
                        });
                    }, 
                    error: function(xhr) {
                        console.log('Error loading barang data');
                    }
                });
            }
            //buat nyari barang di modal create
            $('#search_barang_modal').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    $.ajax({
                        url: '/api/barang?search=' + value,
                        type: 'GET',
                        success: function(response) {
                            var barangList = response.data;
                            var dropdownList = $('#barang_list_modal');
                            dropdownList.empty();
                            var defaultItem = $('<li class="dropdown-item read-only">Pilih Barang</li>');
                            dropdownList.append(defaultItem);
                            $.each(barangList, function(index, barang){
                                var listItem = $('<li class="dropdown-item" data-id="' + barang.id + '"><span class="barang-kode">' + barang.kode_barang + '</span><span class="barang-nama">' + barang.nama_barang + '</span></li>');
                                dropdownList.append(listItem);
                            });
                        },
                        error: function(xhr) {
                            var errorResponse = xhr.responseJSON;
                            var dropdownList = $('#barang_list_modal');
                            dropdownList.empty();
                            var noDataItem = $('<li class="dropdown-item read-only">' + errorResponse.message + '</li>');
                            dropdownList.append(noDataItem);
                        }
                    });
                }, 500);
            });
            //buat load data program list di create modal
            function LoadDataProgramModal() {
                $.ajax({
                    url: '/api/program',
                    type: 'GET',
                    success: function(response) {
                        var programList = response.data;
                        var dropdownList = $('#program_list_modal');
                        dropdownList.empty();
                        var defaultItem = $('<li class="dropdown-item read-only">Pilih Program</li>');
                        dropdownList.append(defaultItem);
                        $.each(programList, function(index, program){
                            var listItem = $('<li class="dropdown-item" data-id="' + program.id + '"><span class="program-kode">' + program.nama_program + '</span></li>');
                            dropdownList.append(listItem);
                        });
                    }, 
                    error: function(xhr) {
                        console.log('Error loading program data');
                    }
                });
            }
            //buat nyari program di modal create
            $('#search_program_modal').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {

                    $.ajax({
                        url: '/api/program?search=' + value,
                        type: 'GET',
                        success: function(response) {
                            var programList = response.data;
                        var dropdownList = $('#program_list_modal');
                        dropdownList.empty();
                        var defaultItem = $('<li class="dropdown-item read-only">Pilih Program</li>');
                        dropdownList.append(defaultItem);
                        $.each(programList, function(index, program){
                            var listItem = $('<li class="dropdown-item" data-id="' + program.id + '"><span class="program-kode">' + program.id_program + '</span><span class="program-nama">' + program.nama_program + '</span></li>');
                            dropdownList.append(listItem);
                        });
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        var dropdownList = $('#program_list_modal');
                        dropdownList.empty();
                        var noDataItem = $('<li class="dropdown-item read-only">' + errorResponse.message + '</li>');
                        dropdownList.append(noDataItem);
                    }
                });
                }, 500);
            });
            LoadDataLokasiModal();
            LoadDataBarangModal();
            LoadDataProgramModal();
            
            $('#filterForm').submit(function(e){
                e.preventDefault();
                var formData = $(this).serializeArray();
                var params = new URLSearchParams();
                $.each(formData, function(index, field){
                    if(field.value){
                        params.append(field.name, field.value);
                    }
                });
                $('#filterModal').modal('hide');
                params.set('page', 1);
                var newUrl = window.location.pathname + '?' + params.toString();
                window.history.pushState({}, '', newUrl);
                fetchLaporanTransaksi();
            })
            $('#createForm').on('submit', function(e){
                e.preventDefault();
                
                // Sembunyikan semua error sebelumnya
                $('.text-danger').empty().hide();
                $('#error-500').empty().hide();
                
                var formData = $(this).serialize();
                $.ajax({
                    url: '/api/transaksi',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Transaksi berhasil dibuat!');
                        $('#buatTransaksiModal').modal('hide');
                        $('#createForm')[0].reset();
                        $('.select-lokasi-modal input').val('Pilih Lokasi');
                        $('.select-barang-modal input').val('Pilih Barang');
                        $('.select-program-modal input').val('Pilih Program');
                        fetchLaporanTransaksi();
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        console.log(errorResponse);
                        
                        // nampilin error 500
                        if (xhr.status === 500) {
                            $('#error-500').append(errorResponse.message);
                            return;
                        }
                        
                        // nampilin error validasi
                        if (errorResponse.errors) {
                            for (var key in errorResponse.errors) {
                                for (var i = 0; i < errorResponse.errors[key].length; i++) {
                                    switch (key) {
                                        case 'jenis_transaksi':
                                            $('#error-jenis_transaksi').append(errorResponse.errors[key][i]).show();
                                            break;
                                        case 'bukti':
                                            $('#error-bukti').append(errorResponse.errors[key][i]).show();
                                            break;
                                        case 'id_lokasi':
                                            $('#error-id_lokasi').append(errorResponse.errors[key][i]).show();
                                            break;
                                        case 'id_barang':
                                            $('#error-id_barang').append(errorResponse.errors[key][i]).show();
                                            break;
                                        case 'tgl_transaksi':
                                            $('#error-tgl_transaksi').append(errorResponse.errors[key][i]).show();
                                            break;
                                        case 'quantity':
                                            $('#error-quantity').append(errorResponse.errors[key][i]).show();
                                            break;
                                        case 'id_program':
                                            $('#error-id_program').append(errorResponse.errors[key][i]).show();
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            }
                        } else {
                            // kalau ada error yang bukan validasi sama 500
                            $('#error-500').text(errorResponse.message).show();
                            return;
                        }
                    }
                })
            })
        })
    </script>
</body>
</html>