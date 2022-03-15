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
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-data-artikel-1">
                    Data 1
                </button>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-data-artikel-2">
                    Data 2
                </button>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-data-artikel-3">
                    Data 3
                </button>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-data-artikel-4">
                    Data 4
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table cellspacing="0" cellpadding="5" class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center">Term Unik</th>
                            <th colspan="4" class="text-center">Tf</th>
                            <th colspan="4" class="text-center">Tf_wt</th>
                            <th rowspan="2" class="text-center">Df</th>
                            <th rowspan="2" class="text-center">Idf</th>
                            <th colspan="4" class="text-center">Tf_idf</th>
                        </tr>
                        <tr>
                            <th>Tf Artikel 1</th>
                            <th>Tf Artikel 2</th>
                            <th>Tf Artikel 3</th>
                            <th>Tf Artikel 4</th>
                            <th>Tf_wt Artikel 1</th>
                            <th>Tf_wt Artikel 2</th>
                            <th>Tf_wt Artikel 3</th>
                            <th>Tf_wt Artikel 4</th>
                            <th>Tf_idf Artikel 1</th>
                            <th>Tf_idf Artikel 2</th>
                            <th>Tf_idf Artikel 3</th>
                            <th>Tf_idf Artikel 4</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($term as $row => $key)
                            <tr>
                                <td>{{$row}}</td>
                                @php
                                    if(in_array($row, $artikel1)){
                                        $artikel1Value = $artikel1Count[$row];
                                        $tf_wt_artikel1 = log10($artikel1Value) + 1;
                                        $df1 = 1;
                                    }else{
                                        $artikel1Value = 0;
                                        $tf_wt_artikel1 = 0;
                                        $df1 = 0;
                                    }

                                    if(in_array($row, $artikel2)){
                                        $artikel2Value = $artikel2Count[$row];
                                        $tf_wt_artikel2 = log10($artikel2Value) + 1;
                                        $df2 = 1;
                                    }else{
                                        $artikel2Value = 0;
                                        $tf_wt_artikel2 = 0;
                                        $df2 = 0;
                                    }

                                    if(in_array($row, $artikel3)){
                                        $artikel3Value = $artikel3Count[$row];
                                        $tf_wt_artikel3 = log10($artikel3Value) + 1;
                                        $df3 = 1;
                                    }else{
                                        $artikel3Value = 0;
                                        $tf_wt_artikel3 = 0;
                                        $df3 = 0;
                                    }

                                    if(in_array($row, $artikel4)){
                                        $artikel4Value = $artikel4Count[$row];
                                        $tf_wt_artikel4 = log10($artikel4Value) + 1;
                                        $df4 = 1;
                                    }else{
                                        $artikel4Value = 0;
                                        $tf_wt_artikel4 = 0;
                                        $df4 = 0;
                                    }
                                @endphp
                                <td>{{$artikel1Value}}</td>
                                <td>{{$artikel2Value}}</td>
                                <td>{{$artikel3Value}}</td>
                                <td>{{$artikel4Value}}</td>
                                <td>{{round($tf_wt_artikel1,3)}}</td>
                                <td>{{round($tf_wt_artikel2,3)}}</td>
                                <td>{{round($tf_wt_artikel3,3)}}</td>
                                <td>{{round($tf_wt_artikel4,3)}}</td>
                                <td>{{$dfValue = $df1+$df2+$df3+$df4}}</td>
                                @if($dfValue > 0)
                                    <td>{{$idf = round(log10(4/$dfValue),3)}}</td>
                                @else 
                                    <td>{{$idf = 1;}}</td>
                                @endif
                                <td>{{round($tf_wt_artikel1 * $idf,3)}}</td>
                                <td>{{round($tf_wt_artikel2 * $idf,3)}}</td>
                                <td>{{round($tf_wt_artikel3 * $idf,3)}}</td>
                                <td>{{round($tf_wt_artikel4 * $idf,3)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-data-artikel-1" tabindex="-1" aria-labelledby="modal-data-artikel-1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-data-artikel-1Label">Data artikel 1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-data-artikel-1">
                    <input type="hidden" name="id" id="id-tfidf-1" value="{{$tfidf[0]->id}}">
                    <div class="modal-body">
                        <textarea name="artikel1" class="form-control" id="" cols="30" rows="10">{{$tfidf[0]->artikel1}}</textarea>
                    </div>
                    <input type="hidden" name="artikel2" value="{{$tfidf[0]->artikel2}}">
                    <input type="hidden" name="artikel3" value="{{$tfidf[0]->artikel3}}">
                    <input type="hidden" name="artikel4" value="{{$tfidf[0]->artikel4}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-data-artikel-2" tabindex="-1" aria-labelledby="modal-data-artikel-2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-data-artikel-2Label">Data artikel 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-data-artikel-2">
                    <input type="hidden" name="id" id="id-tfidf-2" value="{{$tfidf[0]->id}}">
                    <div class="modal-body">
                        <textarea name="artikel2" class="form-control" id="" cols="30" rows="10">{{$tfidf[0]->artikel2}}</textarea>
                    </div>
                    <input type="hidden" name="artikel1" value="{{$tfidf[0]->artikel1}}">
                    <input type="hidden" name="artikel3" value="{{$tfidf[0]->artikel3}}">
                    <input type="hidden" name="artikel4" value="{{$tfidf[0]->artikel4}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-data-artikel-3" tabindex="-1" aria-labelledby="modal-data-artikel-3Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-data-artikel-3Label">Data artikel 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-data-artikel-3">
                    <input type="hidden" name="id" id="id-tfidf-3" value="{{$tfidf[0]->id}}">
                    <div class="modal-body">
                        <textarea name="artikel3" class="form-control" id="" cols="30" rows="10">{{$tfidf[0]->artikel3}}</textarea>
                    </div>
                    <input type="hidden" name="artikel2" value="{{$tfidf[0]->artikel2}}">
                    <input type="hidden" name="artikel1" value="{{$tfidf[0]->artikel1}}">
                    <input type="hidden" name="artikel4" value="{{$tfidf[0]->artikel4}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-data-artikel-4" tabindex="-1" aria-labelledby="modal-data-artikel-4Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-data-artikel-4Label">Data artikel 4</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-data-artikel-4">
                    <input type="hidden" name="id" id="id-tfidf-4" value="{{$tfidf[0]->id}}">
                    <div class="modal-body">
                        <textarea name="artikel4" class="form-control" id="" cols="30" rows="10">{{$tfidf[0]->artikel4}}</textarea>
                    </div>
                    <input type="hidden" name="artikel2" value="{{$tfidf[0]->artikel2}}">
                    <input type="hidden" name="artikel3" value="{{$tfidf[0]->artikel3}}">
                    <input type="hidden" name="artikel1" value="{{$tfidf[0]->artikel1}}">
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
    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('#form-data-artikel-1').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id-tfidf-1').val()
                var url = '{{ route("perbaruiArtikel", ":id") }}'.replace(':id', id);
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
                    data: $('#form-data-artikel-1').serialize(),
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Artikel 1 diperbarui!',
                            icon: 'success'
                        }).then(function () {
                            $('#modal-data-artikel-1').modal('hide');
                            window.location.href = "{{ route('tfidfIndex') }}";
                        });
                    },
                    error: function (e) {
                        swal({
                            title: 'Gagal!',
                            text: 'Artikel 1 gagal diperbarui!, silahkan menghubungi IT',
                            icon: 'error'
                        })
                    }
                });
                return false;

            }
        });

        $('#form-data-artikel-2').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id-tfidf-2').val()
                var url = '{{ route("perbaruiArtikel", ":id") }}'.replace(':id', id);
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
                    data: $('#form-data-artikel-2').serialize(),
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Artikel 2 diperbarui!',
                            icon: 'success'
                        }).then(function () {
                            $('#modal-data-artikel-2').modal('hide');
                            window.location.href = "{{ route('tfidfIndex') }}";
                        });
                    },
                    error: function (e) {
                        swal({
                            title: 'Gagal!',
                            text: 'Artikel 2 gagal diperbarui!, silahkan menghubungi IT',
                            icon: 'error'
                        })
                    }
                });
                return false;

            }
        });

        $('#form-data-artikel-3').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id-tfidf-3').val()
                var url = '{{ route("perbaruiArtikel", ":id") }}'.replace(':id', id);
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
                    data: $('#form-data-artikel-3').serialize(),
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Artikel 3 diperbarui!',
                            icon: 'success'
                        }).then(function () {
                            $('#modal-data-artikel-3').modal('hide');
                            window.location.href = "{{ route('tfidfIndex') }}";
                        });
                    },
                    error: function (e) {
                        swal({
                            title: 'Gagal!',
                            text: 'Artikel 3 gagal diperbarui!, silahkan menghubungi IT',
                            icon: 'error'
                        })
                    }
                });
                return false;

            }
        });

        $('#form-data-artikel-4').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id-tfidf-4').val()
                var url = '{{ route("perbaruiArtikel", ":id") }}'.replace(':id', id);
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
                    data: $('#form-data-artikel-4').serialize(),
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Artikel 4 diperbarui!',
                            icon: 'success'
                        }).then(function () {
                            $('#modal-data-artikel-4').modal('hide');
                            window.location.href = "{{ route('tfidfIndex') }}";
                        });
                    },
                    error: function (e) {
                        swal({
                            title: 'Gagal!',
                            text: 'Artikel 4 gagal diperbarui!, silahkan menghubungi IT',
                            icon: 'error'
                        })
                    }
                });
                return false;

            }
        });
    </script>
</body>

</html>