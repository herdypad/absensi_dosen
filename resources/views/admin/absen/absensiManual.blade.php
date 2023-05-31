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
                    
                    <div class="card-body">
                        <div class="card mb-4">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h6>Absen Manual</h6>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <form action="{{ route('presensi.createPresensiManual') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="user_id" class="form-label">Nama pegawai</label>
                                            <select name="user_id" id="user_id" class="form-control">
                                                <option value="0" selected disabled>-- Pilih Nama Pegawai -- </option>
                                                @foreach ($absen as $item)
                                                <option value="{{$item->id}}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tgl_presensi" class="form-label">Tanggal Absen</label>
                                                <input required type="date" name="tgl_presensi" id="tgl_presensi" value="{{ old('tgl_presensi') }}"
                                                    class="form-control @error('tgl_presensi') is-invalid @enderror" autofocus>
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jam_masuk" class="form-label">Jam Masuk</label>
                                                <input required type="time" name="jam_masuk" id="jam_masuk" value="{{ old('jam_masuk') }}"
                                                    class="form-control @error('jam_masuk') is-invalid @enderror" autofocus>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jam_pulang" class="form-label">Jam Pulang</label>
                                                <input required type="time" name="jam_pulang" id="jam_pulang" value="{{ old('jam_pulang') }}"
                                                    class="form-control @error('jam_pulang') is-invalid @enderror" autofocus>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ket" class="form-label">Keterangan</label>
                                                <textarea required type="text" name="ket" id="ket" value="{{ old('ket') }}"
                                                    class="form-control @error('ket') is-invalid @enderror" autofocus rows="3"> </textarea>
                                                   
                                            </div>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="telat" name="telat">
                                            <label class="custom-control-label" for="telat">Telat</label>
                                        </div>

                                        <div style="float: right">
                                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end container-->
    {{-- footer --}}
    @include('template.footer')
    {{-- end footer --}}
</div>
</main>
<!--   Core JS Files   -->
@include('template.script')
</body>
</html>
