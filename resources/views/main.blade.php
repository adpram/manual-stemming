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
                    data-bs-target="#modal-data">
                    Data
                </button>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-token-tidak-lolos">
                    Token tidak lolos
                </button>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-token-lolos">
                    Token lolos
                </button>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-hasil-stemming">
                    Hasil stemming
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <table cellspacing="0" cellpadding="5" id="tabel_stemming" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Token</th>
                            <th>Seleksi Stop Word</th>
                            <th>
                                Case Folding
                                <input type="hidden" id="tokenYangLolos" value="{{implode(' ', $tokenYangLolos)}}">
                                <button onclick="salinTokenLolos()" type="button" style="font-size: 12px" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Salin ke clipboard" id="salinTokenLolos">
                                    + case folding
                                </button>
                            </th>
                            <th>Proses Stemming</th>
                            <th>
                                Hasil Stemming
                                <button onclick="salinTokenLolos2()" type="button" style="font-size: 12px" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Salin ke clipboard" id="salinTokenLolos2">
                                    + stemming 2
                                </button>
                            </th>
                            <th>Seleksi Stop Word</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $tokenYangLolos2 = []; $daftarStopWord = [];@endphp
                        @foreach ($tokenizing as $index => $token)
                            <tr>
                                @php
                                    if ( in_array(strtolower($token), $tambahanTokenLolos) ) {
                                        $seleksisw = 'Lolos';
                                    } else if ( in_array(strtolower($token), $tokenTidakLolos) || preg_match('~[0-9]+~', $token) ) {
                                        $seleksisw = 'Tidak Lolos';                            
                                    } else {
                                        $seleksisw = 'Lolos';
                                    }
                                @endphp
                                <td>{{$index+1}}</td>
                                <td>{{$token}}</td>
                                <td>{{$seleksisw}}</td>
                                @if($seleksisw == "Tidak Lolos")
                                    <td>-</td>
                                    <td>-</td>
                                @else 
                                    <td>{{$token}}</td>
                                    <td></td>
                                @endif
                                @if(!empty($resultStemming[0]))
                                    @php
                                        if ( in_array(strtolower($resultStemming[$index]), $tambahanTokenLolos) ) {
                                            $seleksisw2 = 'Lolos';
                                            array_push($tokenYangLolos2, $resultStemming[$index]);
                                        } else if ( in_array(strtolower($resultStemming[$index]), $tokenTidakLolos) || preg_match('~[0-9]+~', $resultStemming[$index]) ) {
                                            $seleksisw2 = 'Tidak Lolos';      
                                            array_push($daftarStopWord, strtolower($token));
                                        } else if ( $resultStemming[$index] == "-" ) {
                                            $seleksisw2 = '-';
                                            array_push($daftarStopWord, strtolower($token));
                                        } else {
                                            $seleksisw2 = 'Lolos';
                                            array_push($tokenYangLolos2, $resultStemming[$index]);
                                        }
                                    @endphp
                                    <td>{{$resultStemming[$index]}}</td>
                                @else
                                    @php $seleksisw2 = "-"; @endphp
                                    <td></td>
                                @endif
                                <td>{{$seleksisw2}}</td>
                            </tr>
                        @endforeach
                        <input type="hidden" id="tokenYangLolos2" value="{{implode(' ', $tokenYangLolos2)}}">
                    </tbody>
                </table>
            </div>
            <div class="col-2">
                <table cellspacing="0" cellpadding="5" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                Daftar Stop Word
                                <button onclick="salinDaftarStopWord()" type="button" style="font-size: 12px" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Salin ke clipboard" id="salinDaftarStopWord">
                                    Stop Word
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $daftarSW = array_count_values($daftarStopWord); $keyStopWord = [];@endphp
                        @foreach ($daftarSW as $key => $row)
                            @php array_push($keyStopWord, $key) @endphp
                            <tr>
                                <td>{{$key}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" id="daftarStopWordKey" value="{{implode(' ', $keyStopWord)}}">
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

    <div class="modal fade" id="modal-token-tidak-lolos" tabindex="-1" aria-labelledby="modal-token-tidak-lolosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-token-tidak-lolosLabel">Token tidak lolos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-token-tidak-lolos">
                    <input type="hidden" name="id" id="id-token-tidak-lolos" value="{{$stemming[0]->id}}">
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" style="font-size: 13px">
                            Untuk pemisah antar kata gunakan spasi, jangan memasukkan tanda baca apapun kecuali istilah !
                        </div>
                        <input type="text" name="token_tidak_lolos" value="{{$stemming[0]->token_tidak_lolos}}" class="form-control" placeholder="desember tanggal">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-token-lolos" tabindex="-1" aria-labelledby="modal-token-lolosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-token-lolosLabel">Token lolos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-token-lolos">
                    <input type="hidden" name="id" id="id-token-lolos" value="{{$stemming[0]->id}}">
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert" style="font-size: 13px">
                            Untuk pemisah antar kata gunakan spasi, jangan memasukkan tanda baca apapun kecuali istilah !
                        </div>
                        <input type="text" name="token_lolos" value="{{$stemming[0]->token_lolos}}" class="form-control" placeholder="covid-19 membuat">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal-hasil-stemming" tabindex="-1" aria-labelledby="modal-hasil-stemmingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-hasil-stemmingLabel">Hasil Stemming</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-hasil-stemming">
                    <input type="hidden" name="id" id="id-hasil-stemming" value="{{$stemming[0]->id}}">
                    <div class="modal-body">
                        <textarea name="result_stemming" class="form-control" id="" cols="30" rows="10">{{$stemming[0]->result_stemming}}</textarea>
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

        $('#form-token-tidak-lolos').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id-token-tidak-lolos').val()
                var url = '{{ route("tambahTokenTidakLolos", ":id") }}'.replace(':id', id);
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
                    data: $('#form-token-tidak-lolos').serialize(),
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Token tidak lolos ditambahkan!',
                            icon: 'success'
                        }).then(function () {
                            $('#modal-data').modal('hide');
                            window.location.href = "{{ route('mainIndex') }}";
                        });
                    },
                    error: function (e) {
                        swal({
                            title: 'Gagal!',
                            text: 'Token tidak lolos gagal ditambahkan!, silahkan menghubungi IT',
                            icon: 'error'
                        })
                    }
                });
                return false;

            }
        });

        $('#form-token-lolos').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id-token-lolos').val()
                var url = '{{ route("tambahTokenLolos", ":id") }}'.replace(':id', id);
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
                    data: $('#form-token-lolos').serialize(),
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Token lolos ditambahkan!',
                            icon: 'success'
                        }).then(function () {
                            $('#modal-data').modal('hide');
                            window.location.href = "{{ route('mainIndex') }}";
                        });
                    },
                    error: function (e) {
                        swal({
                            title: 'Gagal!',
                            text: 'Token lolos gagal ditambahkan!, silahkan menghubungi IT',
                            icon: 'error'
                        })
                    }
                });
                return false;

            }
        });

        $('#form-hasil-stemming').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id-hasil-stemming').val()
                var url = '{{ route("perbaruiHasilStemming", ":id") }}'.replace(':id', id);
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
                    data: $('#form-hasil-stemming').serialize(),
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Hasil stemming sastrawi diperbarui!',
                            icon: 'success'
                        }).then(function () {
                            $('#modal-hasil-stemming').modal('hide');
                            window.location.href = "{{ route('mainIndex') }}";
                        });
                    },
                    error: function (e) {
                        swal({
                            title: 'Gagal!',
                            text: 'Hasil stemming gagal diperbarui!, silahkan menghubungi IT',
                            icon: 'error'
                        })
                    }
                });
                return false;

            }
        });

        // salin token yang lolos
        function salinTokenLolos() {
            var copyText = document.getElementById("tokenYangLolos");
            navigator.clipboard.writeText(copyText.value);

            var tooltip = document.getElementById("salinTokenLolos");
            tooltip.innerHTML = "Tersalin ya ges ya";
        }
        function salinTokenLolos2() {
            var copyText = document.getElementById("tokenYangLolos2");
            navigator.clipboard.writeText(copyText.value);

            var tooltip = document.getElementById("salinTokenLolos2");
            tooltip.innerHTML = "Tersalin ya ges ya";
        }

        function salinDaftarStopWord() {
            var copyText = document.getElementById("daftarStopWordKey");
            navigator.clipboard.writeText(copyText.value);

            var tooltip = document.getElementById("salinDaftarStopWord");
            tooltip.innerHTML = "Tersalin ya ges ya";
        }
    </script>
</body>

</html>