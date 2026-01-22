<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/lokasi/show.css') }}" rel="stylesheet">
    <title>Lokasi Master</title>
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
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold">Lokasi Master</h3>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buatLokasiModal">+ Tambah Lokasi</button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterLokasiModal">Filter By</button>
                </div>
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Kode Lokasi</th>
                                    <th>Nama Lokasi </th>
                                    <th>Tanggal ditambahkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- tempat apent main table -->
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white py-3">
                        <div class="pagination-container">
                            <div class="text-muted small" id="info">
                                <!-- tempat append info halaman -->
                            </div>
                            <nav class="pagination">
                                <!-- tempat append pagination -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="buatLokasiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-create" id="buatLokasiModalLabel">Buat Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div id="error-500" class="alert alert-danger mx-3 mt-3" style="display: none;" role="alert"></div>
                <form id="createForm">
                    <div class="modal-body">
                        <div>
                            <h6 class="fw-bold mb-3">Kode Lokasi</h6>
                            <div class="kode_list">
                                <div class="form-check p-0">
                                    <input type="text" class="form-control kode-create" name="kode_lokasi" id="kode_lokasi" value="" placeholder="Masukkan kode lokasi">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-kode-lokasi" style="display: none;"></div>
                        </div>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-3">Nama Lokasi</h6>
                            <div class="nama_list">
                                <div class="form-check p-0">
                                    <input type="text" class="form-control nama-create" name="nama_lokasi" id="nama_lokasi" value="" placeholder="Masukkan nama lokasi">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-nama-lokasi" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="reset" class="btn btn-secondary reset-button">Reset</button>
                        <button type="submit" class="btn btn-primary">Buat Lokasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editLokasiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLokasiModalLabel">Edit Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div id="edit-error-500" class="alert alert-danger mx-3 mt-3" style="display: none;" role="alert"></div>
                <form id="editForm">
                    <div class="modal-body">
                        <div>
                            <h6 class="fw-bold mb-3">Kode Lokasi</h6>
                            <div class="kode_list">
                                <div class="form-check p-0">
                                    <input type="hidden" name="id_lokasi" id="edit_id_lokasi" value="">
                                    <input type="text" class="form-control kode-edit-lokasi" name="kode_lokasi" id="edit_kode_lokasi" value="" placeholder="Masukkan kode lokasi">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-edit-kode-lokasi" style="display: none;"></div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-3">Nama Lokasi</h6>
                            <div class="nama_list">
                                <div class="form-check p-0">
                                    <input type="text" class="form-control nama-edit-lokasi" name="nama_lokasi" id="edit_nama_lokasi" value="" placeholder="Masukkan nama lokasi">
                                </div>
                            </div>
                            <div class="text-danger small mt-1" id="error-edit-nama-lokasi" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal edit</button>
                        <button type="submit" class="btn btn-primary">Perbarui lokasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="filterLokasiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterLokasiModalLabel">Filter Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="filterForm">
                    <div class="modal-body">
                        <div>
                            <h6 class="fw-bold mb-3">Kode Lokasi | Nama Lokasi</h6>
                            <div class="kode_list">
                                <div class="form-check p-0">
                                    <input type="text" class="form-control lokasi-filter" name="search" id="search_lokasi" value="" placeholder="Masukkan kode atau nama lokasi">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            function toCommas(value){
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            function formatDate(dateString){
                var date = new Date(dateString);
                var formattedDate = date.toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                });
                var formattedTime = date.toLocaleTimeString('en-EN', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });
                return formattedDate + ' ' + formattedTime;
            }
            // buat ambil data lokasi
            function fetchLokasi() {
                var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                var searchParams = window.location.search;
                searchParams += searchParams ? '&master=1' : '?master=1';
                $.ajax({
                    url: '/api/lokasi' + searchParams,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        var tbody = $('table tbody');
                        tbody.empty();
                        var currentPaginationPage = response.data.current_page;
                        var perPage = response.data.per_page;
                        $.each(response.data.data, function(index, lokasi) {
                            var number = (currentPaginationPage - 1) * perPage + index + 1;
                            // var number = 1000000;
                            var row = '<tr>' +
                                '<td>' + toCommas(number) + '</td>' +
                                '<td>' + lokasi.kode_lokasi + '</td>' +
                                '<td>' + lokasi.nama_lokasi + '</td>' +
                                '<td>' + formatDate(lokasi.created_at)  + '</td>' +
                                '<td>' +
                                    '<button class="btn btn-sm btn-warning me-2 edit-button" data-edit-id="' + lokasi.id + '" data-bs-toggle="modal" data-bs-target="#editLokasiModal">Edit</button>' +
                                    '<button class="btn btn-sm btn-danger" data-id="' + lokasi.id + '" id="delete-button">Hapus</button>' +
                                '</td>' +
                            '</tr>';
                            tbody.append(row);
                        });
                        var information = $('#info');
                        information.empty();
                        information.append('Menampilkan <strong>' + response.data.from + '</strong> dari <strong>' + response.data.total + '</strong> stok <span class="mx-1">|</span> Halaman <strong>' + response.data.current_page + '</strong> dari <strong>' + response.data.last_page + '</strong>');
                        var pagination = $('.pagination');
                        pagination.empty();
                        var url = new URLSearchParams(window.location.search);
                        var paginationList = '<ul class="pagination mb-0">';
                        if(currentPage == 1){
                            paginationList += '<li class="disabled page-item">' +
                            '<a class="page-link">Prev</a></li>' +
                            '</li>';
                        } else {
                            var prevPage = currentPage - 1;
                            url.set('page', prevPage);
                            paginationList += '<li class="page-item">' +
                                '<a class="page-link" href="?' + url.toString() + '">Prev</a></li>' +
                                '</li>';
                        };
                        for (var i = 1; i <= response.data.last_page; i++) {
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
                            '<a class="page-link">Next</a>' +
                            '</li>';
                        } else {
                            var nextPage = ++currentPage;
                            url.set('page', nextPage);
                            paginationList += '<li class="page-item">' +
                                '<a class="page-link" href="?' + url.toString() + '">Next</a>' +
                                '</li>';
                        };
                        pagination.append(paginationList);
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        // var row = '<tr><td colspan="5" class="text-center">Tidak ada data lokasi</td></tr>';
                        // tbody.append(row);
                        $('tbody').empty();
                        $('#info').empty();
                        $('.pagination').empty();
                        $('tbody').append('<tr><td colspan="5" class="text-center">' + errorResponse.message + '</td></tr>');
                    }
                });
            }
            fetchLokasi();
            $('#kode_lokasi').on('blur', function () {
                $kode_lokasi = $(this).val();
                $('#kode_lokasi').val($kode_lokasi.toUpperCase());  
            })
            $('#nama_lokasi').on('blur', function () {
                $nama_lokasi = $(this).val();
                $('#nama_lokasi').val($nama_lokasi.toUpperCase());  
            })
            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $('.text-danger').empty().hide();
                $('#error-500').hide().empty();
                $('#success').empty().hide();
                var formData = $(this).serialize();
                $.ajax({
                    url: '/api/lokasi',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        fetchLokasi();
                        var successAlert = $('#success');
                        successAlert.append(response.message).show();
                        $('#buatLokasiModal').modal('hide');
                        $('#createForm')[0].reset();
                    }, 
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        // console.log(errorResponse);
                        if (errorResponse.errors) {
                            if (errorResponse.errors.kode_lokasi) {
                                $('#error-kode-lokasi').text(errorResponse.errors.kode_lokasi[0]).show();
                            }
                            if (errorResponse.errors.nama_lokasi) {
                                $('#error-nama-lokasi').text(errorResponse.errors.nama_lokasi[0]).show();
                            }
                        } else {
                            $('#error-500').text(errorResponse.message).show();
                        }
                    }
                })
            })
            $('.reset-button').on('click', function() {
                $('.text-danger').empty().hide();
                $('#error-500').hide().empty(); 
            });
            $('tbody').on('click', '#delete-button', function() {
                var lokasiId = $(this).data('id');
                var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
                var jumlahItem = $('tbody tr').length;
                if (confirm('Apakah Anda yakin ingin menghapus lokasi ini?')) {
                    $.ajax({
                        url: '/api/lokasi/' + lokasiId,
                        method: 'DELETE',
                        success: function(response) {
                            if(jumlahItem == 1 && currentPage > 1) {
                                var url = new URLSearchParams(window.location.search);
                                url.set('page', currentPage - 1);
                                window.history.pushState({}, '', '?' + url.toString());
                                fetchLokasi();
                            } else {
                                fetchLokasi();
                            }
                            var successAlert = $('#success');
                            successAlert.empty();
                            successAlert.append(response.message).show();
                        },
                        error: function(xhr) {
                            var errorResponse = xhr.responseJSON;
                            alert('Gagal menghapus lokasi: ' + errorResponse.message);
                        }
                    });
                }
            });
            $('tbody').on('click', '.edit-button', function(e) {
                var lokasiId = $(this).data('edit-id');
                $.ajax({
                    url: '/api/lokasi/' + lokasiId,
                    method: 'GET',
                    success: function(response) {
                        $('#edit_id_lokasi').val(response.data.id);
                        $('#edit_kode_lokasi').val(response.data.kode_lokasi);
                        $('#edit_nama_lokasi').val(response.data.nama_lokasi);
                    },
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        var form = $('#editForm');
                        var error = $('#edit-error-500');
                        form.empty();
                    }
                })
            })
            $('#edit_kode_lokasi').on('blur', function () {
                $kode_lokasi = $(this).val();
                $('#edit_kode_lokasi').val($kode_lokasi.toUpperCase());  
            });
            $('#edit_nama_lokasi').on('blur', function () {
                $nama_lokasi = $(this).val();
                $('#edit_nama_lokasi').val($nama_lokasi.toUpperCase());
            });
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                $id_lokasi = $('#edit_id_lokasi').val();
                // console.log($id_lokasi);
                $('.text-danger').empty().hide();
                $('#error-500').empty().hide();
                $.ajax({
                    url: '/api/lokasi/' + $id_lokasi,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        var successAlert = $('#success');
                        successAlert.empty();
                        successAlert.append(response.message).show();
                        $('#editLokasiModal').modal('hide');
                        $('#createForm')[0].reset();
                        fetchLokasi();
                    }, 
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
                        // console.log(errorResponse);
                        if (errorResponse.errors) {
                            if (errorResponse.errors.kode_lokasi) {
                                $('#error-edit-kode-lokasi').text(errorResponse.errors.kode_lokasi[0]).show();
                            }
                            if (errorResponse.errors.nama_lokasi) {
                                $('#error-edit-nama-lokasi').text(errorResponse.errors.nama_lokasi[0]).show();
                            }
                        } else {
                            $('#edit-error-500').text(errorResponse.message).show();
                        }
                    }
                })
            })
            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                window.history.pushState({}, '', url);
                fetchLokasi();
            });
            window.onpopstate = function() {
                fetchLokasi();
            }
            $('#filterForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                var params = new URLSearchParams();
                $.each(formData, function(index, field) {
                    if(field.value) {
                        params.append(field.name, field.value);
                    }
                });
                $('#filterLokasiModal').modal('hide');
                params.set('page', 1);
                var newUrl = window.location.pathname + '?' + params.toString();
                window.history.pushState({}, '', newUrl);
                fetchLokasi();
            });
            $('#filterForm').on('reset', function() {
                setTimeout(function() {
                    $('#search_lokasi').val('');
                }, 0);
            });
        });
    </script>
</body>
</html>