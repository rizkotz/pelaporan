@extends('layout.main')
@section('title','Feedback')

@section('isi')

<div class="col-md-16 p-5 pt-2">
    <h3><i class="fa-regular fa-user mr-2"></i>FEEDBACK</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Feedback</span>
        <span class="span1">User</span>
    </h4>
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <table class="table table-white table-sm">
                        <tr>

                            Untuk mengisi kuesioner feedback aplikasi, silahkan
                                klik link di bawah ini

                        </tr>
                        <p>
                        <tr>
                            <th class="text-left">Link : </th>
                            <td>
                                <a href="https://forms.gle/mahK8WtUnzsizVgw8" target="_blank">
                                    https://forms.gle/mahK8WtUnzsizVgw8
                                </a>
                            </td>
                        </tr>
                        <!-- Tambahkan konten profil lainnya sesuai kebutuhan -->
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection
