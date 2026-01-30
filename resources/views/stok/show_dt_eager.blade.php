<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stok/show.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.bootstrap5.min.css" />
    <title>Laporan Stok</title>
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
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="">
                        <h3 class="fw-bold">Laporan Stok</h3>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">Filter by</button>
                </div>
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="stokTable">
                            <thead>
                                <tr>
                                    <th>Kode Lokasi</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th class="text-end">Saldo</th>
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
                <h1 class="modal-title fs-5" id="filterModalLabel">Filter Stok</h1>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Terapkan filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var stokTable;
        $(document).ready(function() {
            // buat mengambil dan menampilkan data stok
            function toCommas(value){
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            //format tanggal ke format indonesia
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
            stokTable = $('#stokTable').DataTable({
                paging: true,
                searching: true,
                info: true,
                ajax: {
                    url: '/api/stok/laporan/eager',
                    type: 'GET',
                    dataSrc: 'data',
                    'error': function(xhr, error, code){
                        if (xhr.status === 404) {
                            // Clear table dan tampilkan pesan custom
                            $('#stokTable tbody').html(
                                '<tr><td colspan="5" class="text-center text-muted">' +
                                'Data stok tidak ditemukan' +
                                '</td></tr>'
                            );
                        } else {
                            $('#stokTable tbody').html(
                                '<tr><td colspan="5" class="text-center text-danger py-4">' +
                                'Terjadi kesalahan saat memuat data. Silakan refresh halaman.' +
                                '</td></tr>'
                            );
            }
                    },
                },
                columns: [
                    { data: 'lokasi.kode_lokasi' },
                    { data: 'barang.kode_barang' },
                    { data: 'barang.nama_barang' },
                    { 
                        data: 'saldo',
                        className: 'text-end',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return toCommas(data);
                            }
                            return data;
                        }
                    },
                    { 
                        data: 'tanggal_masuk',
                        render: function(data, type, row) {
                            // return formatDate(data);
                            if (type === 'display' ){
                                return formatDate(data);
                            }
                            return data;
                        }
                    },
                    
                ],
            });
            // handle ketika user pakai undo/ redo di browser
            window.onpopstate = function() {
                stokTable.ajax.url('/api/stok/laporan/eager' + window.location.search).load();
            };
            // buat nampilin data lokasi di modal filter
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
            // buat nampilin data barang di modal filter
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
            // handle submit filter form
            $('#filterForm').on('submit', function(e){
                e.preventDefault();
                var selectedLokasi = $('input[name="id_lokasi"]:checked').val();
                var selectedBarang = $('input[name="id_barang"]:checked').val();
                var params = new URLSearchParams(window.location.search);
                if (selectedLokasi){
                    params.set('id_lokasi', selectedLokasi);
                } else {
                    params.delete('id_lokasi');
                } 
                if (selectedBarang){
                    params.set('id_barang', selectedBarang);
                } else {
                    params.delete('id_barang');
                }
                params.set('page', 1);
                var newUrl = window.location.pathname + '?' + params.toString();
                window.history.pushState({}, '', newUrl);
                $('#filterModal').modal('hide');
                stokTable.ajax.url('/api/stok/laporan' + '?' + params.toString()).load();
                stokTable.ajax.reload();
            });
        });
    </script>
</body>
</html>