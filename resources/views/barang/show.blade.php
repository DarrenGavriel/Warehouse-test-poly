<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/barang/show.css') }}">
    <title>Master Barang</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="/lokasi/master">Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/barang/master">Barang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="success" class="alert alert-success mx-3 mt-3" style="display: none;" role="alert"></div>
    <div id="error-general" class="alert alert-danger mx-3 mt-3" style="display: none;" role="alert"></div>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold">Barang Master</h3>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBarangModal">+ Tambah Barang</button>
                    <button type="button" class="btn btn-secondary">Filter By</button>
                </div>
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal ditambahkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- tempat append buat barang getAll -->
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white py-3">
                        <div class="pagination-container">
                            <div class="text-muted small" id="info">
                                <!-- tempat append info halaman barang master -->
                            </div>
                            <div class="pagination">
                                <!-- tempat append pagination barang master -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createBarangModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBarangModalLabel">Buat Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="error" class="alert alert-danger mx-3 mt-3" style="display: none;" role="alert"></div>
                <form id="createForm">
                    <div class="modal-body">
                        <div>
                            <h6 class="fw-bold">Kode Barang</h6>
                            <div class="kode_list">
                                <div class="form-check p-0">
                                    <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Masukkan kode barang" value="">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-kode-barang" style="display: none;"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold">Nama Barang</h6>
                            <div class="nama_list">
                                <div class="form-check p-0">
                                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Masukkan nama barang" value="">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-nama-barang" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBarangModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="error-edit" class="alert alert-danger mx-3 mt-3" style="display: none;" role="alert"></div>
                <form id="editForm">
                    <div class="modal-body">
                        <div>
                            <h6 class="fw-bold">Kode Barang</h6>
                            <div class="kode_list">
                                <input type="hidden" name="id" id="edit_id" value="">
                                <div class="form-check p-0">
                                    <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Masukkan kode barang" value="">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-kode-barang-edit" style="display: none;" role="alert"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold">Nama Barang</h6>
                            <div class="nama_list">
                                <div class="form-check p-0">
                                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Masukkan nama barang" value="">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-nama-barang-edit" style="display: none;" role="alert"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            var error_kode_barang = $('#error-kode-barang');
            var error_nama_barang = $('#error-nama-barang');
            var error_general = $('#error');
            var success = $('#success');
            function formatDate(dateString){
                var date = new Date(dateString);
                var formattedDate = date.toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                });
                var formattedTime = date.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });
                return formattedDate + ' ' + formattedTime;
            }
            function fetchBarang(){
                var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                var searchParams = window.location.search;
                searchParams += searchParams ? '&master=1' : '?master=1';
                $.ajax({
                    url: '/api/barang' + searchParams,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        
                        var tbody = $('table tbody');
                        tbody.empty();
                        var currentPaginationPage = response.data.current_page;
                        var perPage = response.data.per_page;
                        $.each(response.data.data, function(index, barang) {
                            var number = (currentPaginationPage - 1) * perPage + index + 1;
                            var row = '<tr>' +
                                '<td>' + number + '</td>' +
                                '<td>' + barang.kode_barang + '</td>' +
                                '<td>' + barang.nama_barang + '</td>' +
                                '<td>' + formatDate(barang.created_at) + '</td>' +
                                '<td><button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBarangModal" data-id="' + barang.id + '" id="edit-button">Edit</button> ';
                                if(barang.is_used){
                                    // row += '<button class="btn btn-sm btn-danger" id="delete-button" data-id="' + barang.id + '" disabled>Hapus</button></td>';
                                    row += '</td>';
                                } else {
                                    row += '<button class="btn btn-sm btn-danger" id="delete-button" data-id="' + barang.id + '">Hapus</button></td>';
                                }
                                '</tr>';
                            tbody.append(row);
                        });
                        var info = $('#info');
                        info.empty();
                        info.append('Menampilkan <strong>' + response.data.from + '</strong> dari <strong>' + response.data.total + '</strong> stok <span class="mx-1">|</span> Halaman <strong>' + response.data.current_page + '</strong> dari <strong>' + response.data.last_page + '</strong>');
                        var pagination = $('.pagination');
                        pagination.empty();
                        var url = new URLSearchParams(window.location.search);
                        var paginationList = '<ul class="pagination mb-0">';
                        if(currentPage == 1){
                            paginationList += '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
                        } else {
                            var prevPage = currentPage - 1;
                            url.set('page', prevPage);
                            paginationList += '<li class="page-item">'+
                                '<a class="page-link" href="?' + url.toString() + '">Previous</a>' + 
                                '</li>';
                        }
                        for (let i = 1; i <= response.data.last_page; i++) {
                            url.set('page', i);
                            if(i == currentPage){
                                paginationList += '<li class="page-item active">'+
                                    '<a class="page-link" href="?' + url.toString() + '">' + i + '</a>' + 
                                    '</li>';
                            } else {
                                paginationList += '<li class="page-item">'+
                                    '<a class="page-link" href="?' + url.toString() + '">' + i + '</a>' + 
                                    '</li>';
                            }
                        }
                        if(currentPage == response.data.last_page){
                            paginationList += '<li class="disabled page-item">'+
                            '<a class="page-link">Next</a>'+
                            '</li>';
                        } else {
                            var nextPage = ++currentPage;
                            url.set('page', nextPage);
                            paginationList += '<li class="page-item">' +
                            '<a class="page-link" href="?' + url.toString() +'">Next</a>' +
                            '</li>';
                        }
                        pagination.append(paginationList);
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        var tbody = $('table tbody');
                        tbody.empty();
                        tbody.append('<tr><td colspan="5" class="text-center">' + errorResponse.message + '</td></tr>');
                    }
                });
            };
            fetchBarang();
            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                window.history.pushState({}, '', url);
                fetchBarang();
            });
            window.onpopstate = function() {
                fetchBarang();
            };
            $('#createForm').on('submit', function(e){
                e.preventDefault();
                error_kode_barang.empty();
                error_nama_barang.empty();
                error_general.empty();
                success.empty();    
                var formData = $(this).serialize();
                $.ajax({
                    url: '/api/barang',
                    method: 'POST',
                    data: formData,
                    success: function(response){
                        fetchBarang();
                        $('#createBarangModal').modal('hide');
                        $('#createForm')[0].reset();
                        success.text(response.message).show();
                    },
                    error: function(xhr){
                        var errorResponse = xhr.responseJSON;
                        // console.log(errorResponse.errors);
                        if(errorResponse.errors){
                            if(errorResponse.errors.kode_barang){
                                error_kode_barang.append(errorResponse.errors.kode_barang[0]).show();
                            } 
                            if (errorResponse.errors.nama_barang){
                                error_nama_barang.append(errorResponse.errors.nama_barang[0]).show();
                            }
                        } else {
                            error_general.text(errorResponse.message).show();
                        }
                    }
                })
            });
            $('#kode_barang').on('blur', function() {
                var kode_barang = $(this).val();
                kode_barang = kode_barang.toUpperCase();
                $(this).val(kode_barang);
            });
            $('#nama_barang').on('blur', function() {
                var nama_barang = $(this).val();
                nama_barang = nama_barang.toUpperCase();
                $(this).val(nama_barang);
            });
            $('tbody').on('click', '#edit-button', function() {
                var barangId = $(this).data('id');
                $.ajax({
                    url: '/api/barang/' + barangId,
                    method: 'GET',
                    success: function(response) {
                        $('#edit_id').val(response.data.id);
                        $('#editBarangModal #kode_barang').val(response.data.kode_barang);
                        $('#editBarangModal #nama_barang').val(response.data.nama_barang);
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        $('.modal-body').empty();
                        $('.modal-body').append('<div class="alert alert-danger" role="alert">' + errorResponse.message + '</div>');
                    }
                })
            })
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var id_barang = $('#edit_id').val();
                var error_kode_barang_edit = $('#error-kode-barang-edit');
                var error_nama_barang_edit = $('#error-nama-barang-edit');
                error_kode_barang_edit.empty();
                error_nama_barang_edit.empty();
                success.empty();
                $.ajax({
                    url: '/api/barang/' + id_barang,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        fetchBarang();
                        $('#editBarangModal').modal('hide');
                        $('#editForm')[0].reset();
                        success.append(response.message).show();
                    }, 
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        if(errorResponse.errors){
                            if(errorResponse.errors.kode_barang){
                                error_kode_barang_edit.append(errorResponse.errors.kode_barang[0]).show();
                            }
                            if(errorResponse.errors.nama_barang){
                                error_nama_barang_edit.append(errorResponse.errors.nama_barang[0]).show();
                            }
                        } else {
                            $('#error-edit').text(errorResponse.message).show();
                        }
                    }
                })
            })
            $('tbody').on('click', '#delete-button', function(e) {
                e.preventDefault();
                var id_barang = $(this).data('id');
                var success = $('#success');
                success.empty();
                
                // Hitung jumlah item yang ada di halaman saat ini sebelum delete
                var jumlahItem = $('tbody tr').length;
                var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                // currentPage = parseInt(currentPage);
                
                $.ajax({
                    url: '/api/barang/' + id_barang,
                    method: 'delete',
                    success: function(response){
                        // Jika item yang dihapus adalah item terakhir di halaman dan bukan di halaman pertama
                        if(jumlahItem === 1 && currentPage > 1) {
                            // Redirect ke halaman sebelumnya
                            var url = new URLSearchParams(window.location.search);
                            url.set('page', currentPage - 1);
                            window.history.pushState({}, '', '?' + url.toString());
                            fetchBarang();
                        } else {
                            // Refresh halaman biasa
                            fetchBarang();
                        }
                        success.append(response.message).show();
                    },
                    error: function(xhr){
                        var errorResponse = xhr.responseJSON;
                        var error = $('#error-general');
                        error.empty();
                        error.append(errorResponse.message).show();
                    }
                })
            })
        });
    </script>
</body>
</html>