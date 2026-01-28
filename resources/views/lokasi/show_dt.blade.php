<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/lokasi/show.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.bootstrap5.min.css" />
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
    <div id="error-general" class="alert alert-danger mx-3 mt-3" style="display: none;" role="alert"></div>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold">Lokasi Master</h3>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buatLokasiModal">+ Tambah Lokasi</button>
                </div>
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="lokasiTable">
                            <thead>
                                <tr>
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
                        <button type="submit" class="btn btn-primary">Edit lokasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var lokasiTable;
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
                    hourCycle: 'h23',
                });
                return formattedDate + ' ' + formattedTime;
            }
            lokasiTable = $('#lokasiTable').DataTable({
                paging: true,
                searching: true,
                info: true,
                ajax: {
                    url: '/api/lokasi',
                    type: 'GET',
                    dataSrc: 'data',
                },
                columns: [
                    { data: 'kode_lokasi' },
                    { data: 'nama_lokasi' },
                    { 
                        data: 'created_at',
                        render: function(data, type) {
                            if(type == 'display'){
                                return formatDate(data);
                            }    
                            return data;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            var editButton = '<button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editLokasiModal" data-edit-id="' + row.id + '">Edit</button>';
                            var deleteButton = '';
                            if(row.is_used){
                                deleteButton = '';
                            } else {
                                deleteButton = '<button class="btn btn-sm btn-danger delete-button" data-id="' + row.id + '">Hapus</button>';
                            }
                            return editButton + deleteButton;
                        }
                    }
                ]
            })
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
                        lokasiTable.ajax.reload();
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
            $('tbody').on('click', '.delete-button', function() {
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
                                lokasiTable.ajax.reload();
                            } else {
                                lokasiTable.ajax.reload();
                            }
                            var successAlert = $('#success');
                            successAlert.empty();
                            successAlert.append(response.message).show();
                        },
                        error: function(xhr) {
                            var errorResponse = xhr.responseJSON;
                            var errorGeneral = $('#error-general');
                            errorGeneral.empty();
                            errorGeneral.append(errorResponse.message).show();
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
                        lokasiTable.ajax.reload();
                    }, 
                    error: function(xhr) {
                        var errorResponse = xhr.responseJSON;
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
        });
    </script>
</body>
</html>