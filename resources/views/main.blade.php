<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RIS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Asset -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dataTables/jquery.dataTables.min.css')}}">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-data">
                    Data
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table cellspacing="0" cellpadding="5" id="tabel_stemming">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Token</th>
                            <th>Seleksi Stop Word</th>
                            <th>Case Folding</th>
                            <th>Proses Stemming</th>
                            <th>Hasil Stemming</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-data" tabindex="-1" aria-labelledby="modal-dataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-dataLabel">Data artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-data">
                    <input type="hidden" name="id" id="id-stemming" value="{{$stemming[0]->id}}">
                    <div class="modal-body">
                        <textarea name="data" class="form-control" id="" cols="30" rows="10">{{$stemming[0]->data}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('#form-data').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id-stemming').val()
                var url = '{{ route("perbaruiData", ":id") }}'.replace(':id', id);
                $.ajax({
                    url: url,
                    type: "PUT",
                    beforeSend: function () {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#form-data').serialize(),
                    dataType: "json",
                    success: function (data) {
                        console.log(data.status)
                        swal({
                            title: 'Berhasil!',
                            text: 'Data diperbarui!',
                            icon: 'success'
                        }).then(function () {
                            $('#modal-data').modal('hide');
                            window.location.href = "{{ route('mainIndex') }}";
                        });
                    },
                    error: function (e) {
                        console.log(e)
                        swal({
                            title: 'Gagal!',
                            text: 'Data gagal diperbarui!, silahkan menghubungi IT',
                            icon: 'error'
                        })
                    }
                });
                return false;

            }
        });
        // var tabel_stemming = $('#tabel_stemming').DataTable({
        // 	"responsive": true,
        // 	"serverSide": true,
        // 	"order": [],
        // });
    </script>
</body>

</html>