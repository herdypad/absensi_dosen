<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
            <img src="/img/logo.png" class="navbar-brand-img h-100" alt="main_logo"> 
            <span class="ms-0 font-weight-bold">Sabang Digital Indonesia</span>
        </a>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class=" w-full" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role=='Pegawai')

            {{-- pegawai menu --}}
            <li class="nav-item">
                <a class="nav-link" href="/presensi">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-badge text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Presensi</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a style="cursor:pointer;" class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Task</span>
                </a>
                <ul class="collapse flex-column ms-1" style="list-style: none; margin-top:-10px;" id="collapseTwo"
                    data-bs-parent="#menu">
                    <li class="nav-item" style="margin-left: -30px">
                        <a class="nav-link" href="/task">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Task Harian</span>
                        </a>
                    </li>
                    <li style="margin-left: -30px; margin-top:-10px;">
                        <a class="nav-link" href="/taskMingguan">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Task Mingguan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Rekap Data</span>
                </a>
                <ul class="collapse flex-column ms-1" style="list-style: none; margin-top:-10px;" id="collapseFour"
                    data-bs-parent="#menu">
                    <li style="margin-left: -30px;">
                        <a href="/dataPresensiP" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-archive-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Data Hadir</span>
                        </a>
                    </li>
                    <li style="margin-left: -30px; margin-top:-20px;">
                        <a href="/dataIzinP" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-archive-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Data Izin</span>
                        </a>
                    </li>
                    <li style="margin-left: -30px; margin-top:-20px;">
                        <a href="/dataTelatP" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-archive-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Data Telat</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/profil">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>
            {{-- end pegawai menu --}}

            @else


            {{-- admin menu--}}
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Master Data</span>
                </a>
                <ul class="collapse flex-column ms-1" style="list-style: none; margin-top:-10px;" id="collapseTwo"
                    data-bs-parent="#menu">
                    <li style="margin-left: -30px;">
                        <a href="/admin" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Admin</span>
                        </a>
                    </li>
                    <li style="margin-left: -30px; margin-top:-20px;">
                        <a href="/pegawai" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Pegawai</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-badge text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Presensi</span>
                </a>
                <ul class="collapse flex-column ms-1" style="list-style: none; margin-top:-10px;" id="collapseThree"
                    data-bs-parent="#menu">
                    <li style="margin-left: -30px;">
                        <a href="/presensiManual" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-badge text-info text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Hadir</span>
                        </a>
                    </li>
                    <li style="margin-left: -30px; margin-top:-20px;">
                        <a href="/izinManual" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-badge text-info text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Izin</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Rekap Data</span>
                </a>
                <ul class="collapse flex-column ms-1" style="list-style: none; margin-top:-10px;" id="collapseFour"
                    data-bs-parent="#menu">
                    <li style="margin-left: -30px;">
                        <a href="/dataPresensi" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-archive-2 text-info text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Data Absensi</span>
                        </a>
                    </li>
                    <li style="margin-left: -30px; margin-top:-20px;">
                        <a href="/dataIzin" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-archive-2 text-info text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Data Izin</span>
                        </a>
                    </li>
                    <li style="margin-left: -30px; margin-top:-20px;">
                        <a href="/dataTelat" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-archive-2 text-info text-sm opacity-10"></i>
                            </div>
                            <span class="d-none nav-link d-sm-inline">Data Telat</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- end admin menu --}}
            @endif
        </ul>
    </div>
</aside>
