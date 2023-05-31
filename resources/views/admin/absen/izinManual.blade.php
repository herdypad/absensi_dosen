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
                                <h6>Izin Manual</h6>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <form action="{{ route('izin.createIzinManual') }}" method="POST">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="user_id" class="form-label">Nama pegawai</label>
                                                <select name="user_id" id="user_id" class="form-control">
                                                    <option value="0" selected disabled>-- Pilih Nama Pegawai -- </option>
                                                    @foreach ($absen as $a)
                                                    <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tgl_presensi" class="form-label">Tanggal Izin</label>
                                                <input required type="date" name="tgl_presensi" id="tgl_awal" value="{{ old('tgl_presensi') }}"
                                                    class="form-control @error('tgl_presensi') is-invalid @enderror" autofocus>
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ket" class="form-label">Keterangan</label>
                                                <textarea required type="text" name="ket" id="ket" value="{{ old('ket') }}"
                                                    class="form-control @error('ket') is-invalid @enderror" autofocus rows="1"> </textarea>
                                            </div>
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