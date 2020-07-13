<div class="header-area header-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12  d-none d-lg-block">
                <div class="horizontal-menu">
                    <nav>
                        <ul id="nav_menu">
                            <li>
                                <a href="{{ route('admin.dashboard') }}"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="{{ route('transaksi.index') }}"><i class="ti-list"></i><span>Transaksi</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="ti-package"></i><span>Master Data</span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('bank.index') }}">Bank</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="ti-user"></i><span>Pengguna</span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('user.index') }}">Daftar Pengguna</a></li>
                                    <li><a href="#" onclick="warningAlert('Halaman tidak tersedia !')">Daftar Pengunjung</a></li>
                                    <li><a href="{!! route('karyawan.index') !!}">Daftar Karyawan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{!! route('wahana.index') !!}"><i class="ti-package"></i><span>Wahana</span></a>
                            </li>
                            <li>
                                <a href="#" onclick="warningAlert('Halaman tidak tersedia !')"><i class="ti-notepad"></i><span>Laporan</span></a>
                                <ul class="submenu">
                                    <li><a href="#" onclick="warningAlert('Halaman tidak tersedia !')">Laporan Penjualan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" onclick="warningAlert('Halaman tidak tersedia !')"><i class="ti-panel"></i><span>Pengaturan</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- mobile_menu -->
            <div class="col-12 d-block d-lg-none">
                <div id="mobile_menu"></div>
            </div>
        </div>
    </div>
</div>