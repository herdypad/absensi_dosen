<!DOCTYPE html>
<html lang="en">
@include('template.head')

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    {{-- sidebar --}}
    @include('template.sidebar')
    {{-- end sidebar --}}
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('template.navbar')
        {{-- end navbar --}}


        {{----------------------------------------- V I E W -----------------------------------------}}

        <!--start container-->
        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('msg'))
                    <div class="alert alert-success" style="color:white;">
                        {{ session()->get('msg') }}
                        <div style="float: right">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                </div>


                <div class="col-12">
                    @if(session()->has('pesan'))
                    <div class="alert alert-success" style="color:white;">
                        {{ session()->get('pesan')}}
                        <div style="float: right">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Data Izin</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="dataabsensi" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No
                                            </th>

                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tanggal
                                            </th>

                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NIP
                                            </th>

                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama
                                            </th>

                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Cabang
                                            </th>

                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Keterangan
                                            </th>

                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($presensi->count() > 0)
                                            @foreach($absen as $key => $p)            
                                                @if ($p->status=='Izin')
                                                <?php $no = 1; ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="px-2 mb-0 text-xs">{{$no++}} 
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td class="align-middle">
                                                        <span class="text-secondary text-xs font-weight-bold">
                                                            {{$p->tgl_presensi??'N/A'}}
                                                        </span>
                                                    </td>
                                                    
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-xs font-weight-bold mb-0">{{$p->user->pegawai->nip??'N/A'}}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{$p->user->nama}}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">{{
                                                        $p->user->pegawai->cabang_id == null
                                                            ?'N/A':
                                                        $cabang->find($p->user->pegawai->cabang_id)->cabang}}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">
                                                            {{$p->ket??'N/A'}}
                                                        </span>
                                                    </td>

                                                    <td class="align-middle text-center">

                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target=" #editIzin-{{$p->id}}">
                                                        <button class="btn btn-warning">
                                                        <i class="fa fa-edit"></i></button>
                                                    </a>

                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#deleteDataIzin-{{ $p->id }}">
                                                        <button class="btn btn-danger">
                                                        <i class="fa fa-trash"></i></button>
                                                    </a>
                                                        
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach

                                        @else
                                        
                                        <tbody>
                                            <tr>
                                                <td class="text-center">Tidak Ada Data</td>
                                            </tr>
                                        </tbody>

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{----------------------------------------- E N D  - V I E W -----------------------------------------}}



        {{-------------------------------------- E D I T --------------------------------------}}
        
        @if($presensi->count() > 0)
            @foreach($absen as $p)
            <div class="modal fade" id="editIzin-{{$p->id}}" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Izin Pegawai</h5>
                            <button class="btn-close bg-danger" type="button"
                                data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="editDataIzin/update/{{ $p->id }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="nama"
                                        value="{{ old('nama') ?? $p->user->nama }}"
                                        class="form-control @error('nama') is-invalid @enderror" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_presensi" class="form-label">Tanggal</label>
                                    <input type="date" name="tgl_presensi" id="tgl_presensi"
                                        value="{{ old('tgl_presensi') ?? $p->tgl_presensi }}"
                                        class="form-control @error('tgl_presensi') is-invalid @enderror">
                                </div>

                                <div class="mb-3">
                                    <label for="ket" class="form-label">Keterangan</label>
                                    <input type="text" name="ket" id="ket"
                                        value="{{ old('ket') ?? $p->ket }}"
                                        class="form-control @error('ket') is-invalid @enderror">
                                </div>
                                
                                <div style="float: right">
                                    <button type="submit"
                                        class="btn btn-primary mb-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif

        {{----------------------------------- E N D - E D I T  -----------------------------------}}


        
        {{-------------------------------------- D E L E T E --------------------------------------}}
        
        @foreach($absen as $p)
        <div class="modal fade" id="deleteDataIzin-{{ $p->id }}"
                aria-labelledby="exampleModalLabel{{ $p->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="padding: 15px">
                        <div class="modal-body">Hapus data {{$p->nama }} ?</div>
                        <div style="margin-right: 10px;">
                            <a class="btn btn-danger" href="deleteDataIzin/delete/{{$p->id}}"
                                style="float: right">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        {{----------------------------------- E N D - D E L E T E --------------------------------------}}

      
        <!--end container-->
        {{-- footer --}}
        @include('template.footer')
        {{-- end footer --}}
        </div>
    </main>
    <!--   Core JS Files   -->
    @include('template.script')

    <script src="/js/pegawai.js"></script>
</body>

</html>