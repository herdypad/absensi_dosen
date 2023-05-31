<!-- navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form method="get">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="cari" placeholder="Search"
                        style="padding-right: 150px">
                </div>
            </form>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <button type="button" class="btn btn-danger mt-3">Logout</button>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
            </ul>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="padding: 15px">
                        <div class="modal-body">Apakah anda yakin untuk logout?</div>
                        <div style="margin-right: 10px;">
                            @if (auth()->user())
                            <form action="{{ route('auth.logout') }}" method="post">
                                @csrf
                                <button class="btn btn-danger" style="float: right">Logout</button>
                            </form>
                            @else
                            <h1>Tidak Ada Session</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end logout modal-->
        </div>
    </div>
</nav>
<!--end navbar-->