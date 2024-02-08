@extends('layout.main')
@section('title','Dashboard')

@section('isi')
<div class="col-md-10 p-5 pt-2">
    <h3><i class="fa-solid fa-gauge mr-2"></i>DASHBOARD</h3><hr>
    <div class="col-xl-7 col-xxl-7 mt-3 mb-3">
        <div class="card flex-fill w-100">
            <div class="card-body">
                {!! $tugasLaporChart->container() !!}
            </div>
        </div>
    </div>
    <div class="row text-white">
        <div class="card bg-info ml-3" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa-solid fa-list-check mr-2" style="color: #e6e6e6;"></i>
                </div>
            <h5 class="card-title">Laporan Keuangan</h5>
            <div class="display-4">4</div>
            <a href="/posts"><p class="card-text text-white">Lihat Detail <i class="fa fa-angle-double-right ml-2"></i>
            </p></a>
            </div>
        </div>
        <div class="card bg-success ml-5" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa-solid fa-list-check mr-2" style="color: #e6e6e6;"></i>
                </div>
            <h5 class="card-title">Laporan Unit Kerja</h5>
            <div class="display-4">2</div>
            <a href=""><p class="card-text text-white">Lihat Detail <i class="fa fa-angle-double-right ml-2"></i>
            </p></a>
            </div>
        </div>
        <div class="card bg-warning ml-5" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa-solid fa-list-check mr-2" style="color: #e6e6e6;"></i>
                </div>
            <h5 class="card-title">Audit Eksternal</h5>
            <div class="display-4">3</div>
            <a href=""><p class="card-text text-white">Lihat Detail <i class="fa fa-angle-double-right ml-2"></i>
            </p></a>
            </div>
        </div>
    </div>
    <div class="row text-white mt-5">
        <div class="card bg-success ml-3" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa-solid fa-list-check mr-2" style="color: #e6e6e6;"></i>
                </div>
            <h5 class="card-title">Audit Eksternal</h5>
            <div class="display-4">3</div>
            <a href=""><p class="card-text text-white">Lihat Detail <i class="fa fa-angle-double-right ml-2"></i>
            </p></a>
            </div>
        </div>
        <div class="card bg-primary ml-5" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa-solid fa-list-check mr-2" style="color: #e6e6e6;"></i>
                </div>
            <h5 class="card-title">Audit Eksternal</h5>
            <div class="display-4">3</div>
            <a href=""><p class="card-text text-white">Lihat Detail <i class="fa fa-angle-double-right ml-2"></i>
            </p></a>
            </div>
        </div>
        <div class="card bg-secondary ml-5" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa-solid fa-list-check mr-2" style="color: #e6e6e6;"></i>
                </div>
            <h5 class="card-title">Audit Eksternal</h5>
            <div class="display-4">3</div>
            <a href=""><p class="card-text text-white">Lihat Detail <i class="fa fa-angle-double-right ml-2"></i>
            </p></a>
            </div>
        </div>
    </div>




</div>

<script src="{{ $tugasLaporChart->cdn() }}"></script>
{{ $tugasLaporChart->script() }}
@endsection
