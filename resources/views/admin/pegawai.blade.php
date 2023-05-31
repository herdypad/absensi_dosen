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

        {{-- --------------------------------------- S T A R T - P E G A W A I ----------------------------------------}}

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
                            <h6>Data Pegawai</h6>
                            <button id="addPegawai" class="btn  bg-gradient-dark mb-3" data-bs-toggle="modal"
                                data-bs-target="#addPegawaiModal">Tambah Data</button>
                        </div>

                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="pegawai-table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NIP</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Jabatan</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Cabang</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pegawai as $key => $p)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="px-2 mb-0 text-xs">{{$pegawai->firstItem()+$key}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{$p->pegawai->nip}}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold mb-0">{{$p->nama??'N/A'}}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{$p->pegawai->jabatan_id
                                                    == null
                                                    ?'N/A':$jabatan->find($p->pegawai->jabatan_id)->jabatan}}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{$p->pegawai->cabang_id
                                                    == null
                                                    ?'N/A':$cabang->find($p->pegawai->cabang_id)->cabang}}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target=" #editPegawai-{{$p->id}}">
                                                    <button class="btn btn-warning">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#deletePegawai-{{ $p->id }}">
                                                    <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i></button>
                                                </a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editPassword-{{ $p->id }}">
                                                    <button class="btn btn-secondary">
                                                    <i class="fa fa-key"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="px-3 page d-flex justify-content-between">

                                    <small style="font-weight: bold">
                                        Showing
                                        {{$pegawai->firstItem()}}
                                        to
                                        {{$pegawai->lastItem()}}
                                        of
                                        {{$pegawai->total()}}
                                        entries
                                    </small>
                                    {{$pegawai->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- --------------------------------------- E N D  - P E G A W A I -----------------------------------------}}


        {{-- ----------------------------------------- S T A R T - A D D -----------------------------------------}}

        <div class="modal fade" id="addPegawaiModal" aria-labelledby="addPegawaiLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPegawaiLabel">Pendaftaran Pegawai</h5>
                        <button class="btn-close bg-danger" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pegawai.createPegawai') }}" method="POST">
                            @csrf
                            <div class='mb-3'>
                                <input type="hidden" name="id" id="id" value="">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="number" name="nip" id="nip" class="form-control" autofocus>
                                <div id="nip-feedback" class="invalid-feedback"></div>
                            </div>
    
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control">
                                <div id="nama-feedback" class="invalid-feedback"></div>
                            </div>
    
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                                <div id="email-feedback" class="invalid-feedback"></div>
                            </div>
    
                            <div class="mb-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
                                <div id="tgl_lahir-feedback" class="invalid-feedback"></div>
                            </div>
    
                            <div class="mb-3">
                                <label for="j_k" class="form-label">Jenis Kelamin</label>
                                <select name="j_k" id="j_k" class="form-control">
                                    <option value="0" disabled selected>-- Jenis Kelamin --</option>
                                    <option value="1">
                                        Laki-laki
                                    </option>
                                    <option value="2">
                                        Perempuan
                                    </option>
                                </select>
                                <div id="j_k-feedback" class="invalid-feedback"></div>
                            </div>
    
                            <div class="mb-3">
                                <label for="no_tlp" class="form-label">Nomor Telepon</label>
                                <input type="tel" name="no_tlp" id="no_tlp" class="form-control">
                                <div id="no_tlp-feedback" class="invalid-feedback"></div>
                            </div>
    
                            <div class="mb-3">
                                <label for="jabatan_id" class="form-label">Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="form-control">
                                    <option value="0" selected disabled>-- Pilih Jabatan --</option>
                                    @foreach ($jabatan as $j)
                                    <option value="{{ $j->id }}">{{ $j->jabatan }}</option>
                                    @endforeach
                                </select>
                                <div id="jabatan_id-feedback" class="invalid-feedback"></div>
                            </div>
    
                            <div class="mb-3">
                                <label for="cabang_id" class="form-label">Cabang</label>
                                <select name="cabang_id" id="cabang_id" class="form-control" value="{{ old('cabang_id') }}">
                                    <option value="0" selected disabled>-- Pilih Cabang --</option>
                                    @foreach ($cabang as $c)
                                    <option value="{{ $c->id }}">{{ $c->cabang }}</option>
                                    @endforeach
                                </select>
                                <div id="cabang_id-feedback" class="invalid-feedback"></div>
                            </div>
    
                            <div class='mb-3'>
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                            </div>
    
                            <div style="float: right">
                                <button type="submit" class="btn btn-primary mb-2">Daftar</button>
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- ------------------------------------------- E N D - A D D -------------------------------------------}}


        {{---------------------------------------- E D I T ----------------------------------------}}

        @foreach($pegawai as $p)
        <div class="modal fade" id="editPegawai-{{$p->id}}" aria-labelledby="addPegawaiLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPegawaiLabel">Edit Pegawai</h5>
                        <button class="btn-close bg-danger" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="pegawai/update/{{ $p->id }}" method="POST">
                            @csrf
                            <div class='mb-3'>
                                <label for="nip" class="form-label">NIP</label>
                                <input type="number" name="nip" id="nip" class="form-control" 
                                value="{{ old('nip') ?? $p->pegawai->nip }}">
                                <div id="nip-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ old('nama') ?? $p->nama }}">
                                <div id="nama-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email') ?? $p->email }}">
                                <div id="email-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                value="{{ old('tgl_lahir') ?? $p->pegawai->tgl_lahir }}">
                                <div id="tgl_lahir-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="j_k" class="form-label">Jenis Kelamin</label>
                                <select name="j_k" id="j_k" class="form-control">
                                    <option value="0" disabled selected>-- Jenis Kelamin --</option>
                                    <option value="1">
                                        Laki-laki
                                    </option>
                                    <option value="2">
                                        Perempuan
                                    </option>
                                </select>
                                <div id="j_k-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="no_tlp" class="form-label">Nomor Telepon</label>
                                <input type="tel" name="no_tlp" id="no_tlp" class="form-control"
                                value="{{ old('tgl_lahir') ?? $p->pegawai->no_tlp}}">
                                <div id="no_tlp-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="jabatan_id" class="form-label">Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="form-control">
                                    <option value="0" selected disabled>Pilih Jabatan</option>
                                    @foreach ($jabatan as $j)
                                    <option value="{{ $j->id }}">{{ $j->jabatan }}</option>
                                    @endforeach
                                </select>
                                <div id="jabatan_id-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="cabang_id" class="form-label">Cabang</label>
                                <select name="cabang_id" id="cabang_id" class="form-control"
                                    value="{{ old('cabang_id') }}">
                                    <option value="0" selected disabled>-- Pilih Cabang --</option>
                                    @foreach ($cabang as $c)
                                    <option value="{{ $c->id }}">{{ $c->cabang }}</option>
                                    @endforeach
                                </select>
                                <div id="cabang_id-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class='mb-3'>
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ old('alamat') ?? $p->pegawai->alamat }}
                                </textarea>
                            </div>

                            <div style="float: right">
                                <button type="submit" class="btn btn-primary mb-2">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{----------------------------------- E N D - E D I T  -----------------------------------}}


        {{---------------------------------------- P A S S W O R D ----------------------------------------}}

        @foreach($pegawai as $p)
        <div class="modal fade" id="editPassword-{{ $p->id }}" aria-labelledby="passwordLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordLabel">Edit Password</h5>
                        <button class="btn-close bg-danger" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="pegawai/passwordupdate/{{ $p->id }}" method="POST">
                            @csrf
                            <div class='mb-3'>
                                <label for="password" class="form-label">New Password</label>
                                <input type="text" name="password" id="password" class="form-control" 
                                value="{{ old('password') ?? $p->pegawai->password }}">
                                <div id="password" class="invalid-feedback"></div>
                            </div>

                            <div style="float: right">
                                <button type="submit" class="btn btn-primary mb-2">Update Password</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{----------------------------------- E N D - P A S S W O R D -----------------------------------}}

        
        {{-------------------------------------- D E L E T E --------------------------------------}}
        @foreach($pegawai as $p)
        <div class="modal fade" id="deletePegawai-{{ $p->id }}"
            aria-labelledby="exampleModalLabel{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="padding: 15px">
                    <div class="modal-body">Hapus data {{$p->nama }} ?</div>
                    <div style="margin-right: 10px;">
                        <a class="btn btn-danger" href="pegawai/delete/{{$p->id}}"
                            style="float: right">Hapus</a>
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