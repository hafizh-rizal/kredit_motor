<nav class="pcoded-navbar bg-c-blue">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">

            {{-- Dashboard (untuk semua role) --}}
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>

            @if (Auth::user()->role === 'admin')
                <div class="pcoded-navigatio-lavel">Master Data</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="{{ Request::routeIs('jenis_motor.*') ? 'active' : '' }}">
                        <a href="{{ route('jenis_motor.index') }}">
                            <span class="pcoded-micon"><i class="ti-car"></i></span>
                            <span class="pcoded-mtext">Jenis Motor</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('pelanggan.*') ? 'active' : '' }}">
                        <a href="{{ route('pelanggan.index') }}">
                            <span class="pcoded-micon"><i class="ti-user"></i></span>
                            <span class="pcoded-mtext">Pelanggan</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('jenis_cicilan.*') ? 'active' : '' }}">
                        <a href="{{ route('jenis_cicilan.index') }}">
                            <span class="pcoded-micon"><i class="ti-credit-card"></i></span>
                            <span class="pcoded-mtext">Jenis Cicilan</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('asuransi.*') ? 'active' : '' }}">
                        <a href="{{ route('asuransi.index') }}">
                            <span class="pcoded-micon"><i class="ti-shield"></i></span>
                            <span class="pcoded-mtext">Asuransi</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('metode_bayar.*') ? 'active' : '' }}">
                        <a href="{{ route('metode_bayar.index') }}">
                            <span class="pcoded-micon"><i class="ti-wallet"></i></span>
                            <span class="pcoded-mtext">Metode Bayar</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('motor.*') ? 'active' : '' }}">
                        <a href="{{ route('motor.index') }}">
                            <span class="pcoded-micon"><i class="ti-truck"></i></span>
                            <span class="pcoded-mtext">Motor</span>
                        </a>
                    </li>
                </ul>

                <div class="pcoded-navigatio-lavel">Transaksi</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="{{ Request::routeIs('pengajuan_kredit.*') ? 'active' : '' }}">
                        <a href="{{ route('pengajuan_kredit.index') }}">
                            <span class="pcoded-micon"><i class="ti-credit-card"></i></span>
                            <span class="pcoded-mtext">Pengajuan Kredit</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('kredit.*') ? 'active' : '' }}">
                        <a href="{{ route('kredit.index') }}">
                            <span class="pcoded-micon"><i class="ti-wallet"></i></span>
                            <span class="pcoded-mtext">Kredit</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('angsuran.*') ? 'active' : '' }}">
                        <a href="{{ route('angsuran.index') }}">
                            <span class="pcoded-micon"><i class="ti-money"></i></span>
                            <span class="pcoded-mtext">Angsuran</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('pengiriman.*') ? 'active' : '' }}">
                        <a href="{{ route('pengiriman.index') }}">
                            <span class="pcoded-micon"><i class="ti-truck"></i></span>
                            <span class="pcoded-mtext">Pengiriman</span>
                        </a>
                    </li>
                </ul>
            @endif

            @if (Auth::user()->role === 'marketing')
                <div class="pcoded-navigatio-lavel">Penjualan & Kredit</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="{{ Request::routeIs('pengajuan_kredit.*') ? 'active' : '' }}">
                        <a href="{{ route('pengajuan_kredit.index') }}">
                            <span class="pcoded-micon"><i class="ti-credit-card"></i></span>
                            <span class="pcoded-mtext">Pengajuan Kredit</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('kredit.*') ? 'active' : '' }}">
                        <a href="{{ route('kredit.index') }}">
                            <span class="pcoded-micon"><i class="ti-wallet"></i></span>
                            <span class="pcoded-mtext">Kredit</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('angsuran.*') ? 'active' : '' }}">
                        <a href="{{ route('angsuran.index') }}">
                            <span class="pcoded-micon"><i class="ti-money"></i></span>
                            <span class="pcoded-mtext">Angsuran</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('pengiriman.*') ? 'active' : '' }}">
                        <a href="{{ route('pengiriman.index') }}">
                            <span class="pcoded-micon"><i class="ti-truck"></i></span>
                            <span class="pcoded-mtext">Pengiriman</span>
                        </a>
                    </li>
                </ul>
            @endif
        </ul>
    </div>
</nav>