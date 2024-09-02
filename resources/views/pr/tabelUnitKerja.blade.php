@extends('layout.main')
@section('title', 'Tabel Matrik')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa-regular fa-newspaper mr-2"></i>TABEL MATRIK</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">Matrik</span>
            <span class="span1">Analisis Risiko</span>
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sangat Jarang</th>
                                    <th>Jarang</th>
                                    <th>Kadang</th>
                                    <th>Sering</th>
                                    <th>Pasti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Sangat Berpengaruh (5)</th>
                                    <td id="R-5-1" class="bg-warning">Cukup-5</td>
                                    <td id="R-5-2" class="bg-warning">Cukup-10</td>
                                    <td id="R-5-3" class="bg-warning">Cukup-15</td>
                                    <td id="R-5-4" class="bg-danger">Tinggi-20</td>
                                    <td id="R-5-5" class="bg-danger">Tinggi-25</td>
                                </tr>
                                <tr>
                                    <th>Berpengaruh (4)</th>
                                    <td id="R-4-1" class="bg-success">Sangat Rendah-4</td>
                                    <td id="R-4-2" class="bg-success">Rendah-8</td>
                                    <td id="R-4-3" class="bg-success">Rendah-12</td>
                                    <td id="R-4-4" class="bg-warning">Cukup-16</td>
                                    <td id="R-4-5" class="bg-danger">Tinggi-20</td>
                                </tr>
                                <tr>
                                    <th>Cukup Berpengaruh (3)</th>
                                    <td id="R-3-1" class="bg-success">Sangat Rendah-3</td>
                                    <td id="R-3-2" class="bg-success">Rendah-6</td>
                                    <td id="R-3-3" class="bg-success">Rendah-9</td>
                                    <td id="R-3-4" class="bg-warning">Cukup-12</td>
                                    <td id="R-3-5" class="bg-warning">Cukup-15</td>
                                </tr>
                                <tr>
                                    <th>Kurang Berpengaruh (2)</th>
                                    <td id="R-2-1" class="bg-success">Sangat Rendah-2</td>
                                    <td id="R-2-2" class="bg-success">Sangat Rendah-4</td>
                                    <td id="R-2-3" class="bg-success">Rendah-6</td>
                                    <td id="R-2-4" class="bg-success">Rendah-8</td>
                                    <td id="R-2-5" class="bg-warning">Cukup-10</td>
                                </tr>
                                <tr>
                                    <th>Tidak Berpengaruh (1)</th>
                                    <td id="R-1-1" class="bg-success">Sangat Rendah-1</td>
                                    <td id="R-1-2" class="bg-success">Sangat Rendah-2</td>
                                    <td id="R-1-3" class="bg-success">Sangat Rendah-3</td>
                                    <td id="R-1-4" class="bg-success">Sangat Rendah-4</td>
                                    <td id="R-1-5" class="bg-warning">Cukup-5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($matrix as $key => $codes)
        <script>
            document.getElementById("{{ $key }}").innerHTML = `
            @foreach ($codes as $code)
                <span class="badge badge-primary">{{ $code }}</span><br/>
            @endforeach
        `;
        </script>
    @endforeach

    <style>
        table {
            width: 100%;
            text-align: center;
        }

        .badge {
            display: inline-block;
            margin: 2px;
            padding: 5px;
        }
    </style>
@endsection
