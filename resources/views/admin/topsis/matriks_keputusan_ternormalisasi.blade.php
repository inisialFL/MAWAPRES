@extends('layouts.admin')
@section('title')
    Matriks Keputusan Ternormalisasi | MAWAPRES
@endsection
@section('content')
<br>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Matriks Keputusan Ternormalisasi</b></h4>
            <p class="text-muted font-14 m-b-30">
            
            </p>

            <table id="table-mahasiswa" class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Fakultas</th>
                    <th>Prestasi (C1)</th>
                    <th>Karya Ilmiah (C2)</th>
                    <th>Bahasa Inggris (C3)</th>
                    <th>IPK (C4)</th>
                    <th>Indeks SKS (C5)</th>
                </tr>
                </thead>


                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->
<!-- end row -->


@endsection
@push('scripts')
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#table-mahasiswa").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.topsis.ternormalisasi') !!}',
                    order:[0,'desc'],
                    columns:[
                        {data:'id', name: 'id'},
                        {data:'nim',name :'nim'},
                        {data:'nama', name: 'nama'},
                        {data:'fakultas',name:'fakultas'},
                        {data:'r_prestasi',name:'r_prestasi'},
                        {data:'r_karya_ilmiah',name:'r_karya_ilmiah'},
                        {data:'r_bahasa_inggris',name:'r_bahasa_inggris'},
                        {data:'r_ipk',name:'r_ipk'},
                        {data:'r_indeks_sks',name:'r_indeks_sks'}                        
                    ]
                });
            } );

        </script>
        @include("admin.script.form-modal-ajax")
@endpush