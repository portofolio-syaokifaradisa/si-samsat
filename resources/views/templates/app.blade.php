<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title }} | UPPD Samsat Kandangan 2022</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/stisla/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/stisla/css/datatables.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/logo/logo.png') }}" />
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar float-right">
        <ul class="navbar-nav mr-3">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="navbar-nav navbar-right ml-auto">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            {{-- <img alt="image" src="{{ asset('img/logo/logo.png') }}" class="rounded-circle mr-1"> --}}
            <div class="d-sm-none d-lg-inline-block">
              @if (Auth::guard('web')->check())
                {{ Auth::guard('web')->user()->name }}
              @else
                {{ Auth::guard('admin')->user()->name }}
              @endif  
            </div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand mt-2">
            <a href="index.html"> <img src="{{ asset('img/logo/logo.png') }}" alt="" style="width: 30px; margin-right: 5px"> UPPD Kandangan</a>
          </div>
          <ul class="sidebar-menu mt-4">
            <li class="menu-header">Beranda</li>
            <li class="{{ $menu == 'home' ? 'active' : '' }}">
                <a class="nav-link" href="@if (Auth::guard('web')->check()) {{ route('home') }} @else {{ route('admin.home') }} @endif">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            
            <li class="menu-header">Pengajuan</li>
            <li class="{{ $menu == 'baliknama' ? 'active' : '' }}">
                <a class="nav-link" href="@if (Auth::guard('web')->check()) {{ route('baliknama.index') }} @else {{ route('admin.baliknama.index') }} @endif">
                  <i class="fas fa-id-card"></i>
                  <span>Bea Balik Nama (BBN)</span>
                </a>
            </li>
            <li class="{{ $menu == 'duplikat' ? 'active' : '' }}">
                <a class="nav-link" href="@if (Auth::guard('web')->check()) {{ route('duplikat.index') }} @else {{ route('admin.duplikat.index') }} @endif">
                  <i class="fas fa-id-card"></i>
                    <span>Duplikat</span>
                </a>
            </li>

            <li class="menu-header">Mutasi</li>
            <li class="{{ $menu == 'mutasi-keluar' ? 'active' : '' }}">
                <a class="nav-link" href="@if (Auth::guard('web')->check()) {{ route('mutasi.index', ['type' => 'keluar']) }} @else {{ route('admin.mutasi.index', ['type' => 'keluar']) }} @endif">
                  <i class="fas fa-id-card"></i>
                  <span>Keluar</span>
                </a>
            </li>
            <li class="{{ $menu == 'mutasi-masuk' ? 'active' : '' }}">
                <a class="nav-link" href="@if (Auth::guard('web')->check()) {{ route('mutasi.index', ['type' => 'masuk']) }} @else {{ route('admin.mutasi.index', ['type' => 'masuk']) }} @endif">
                  <i class="fas fa-id-card"></i>
                  <span>Masuk</span>
                </a>
            </li>
            <li class="{{ $menu == 'mutasi-nopol' ? 'active' : '' }}">
              <a class="nav-link" href="@if (Auth::guard('web')->check()) {{ route('mutasi.index', ['type' => 'nopol']) }} @else {{ route('admin.mutasi.index', ['type' => 'nopol']) }} @endif">
                <i class="fas fa-id-card"></i>
                <span>Nopol</span>
              </a>
            </li>
            <li class="{{ $menu == 'pajak1' ? 'active' : '' }}">
                <a class="nav-link" href="@if (Auth::guard('web')->check()) {{ route('pajak.index', ['type' => 1]) }} @else {{ route('admin.pajak.index', ['type' => 1]) }} @endif">
                    <i class="fas fa-id-card"></i>
                    <span>Perpanjangan 1 Tahun</span>
                </a>
            </li>
            <li class="{{ $menu == 'pajak5' ? 'active' : '' }}">
              <a class="nav-link" href="@if (Auth::guard('web')->check()) {{ route('pajak.index', ['type' => 5]) }} @else {{ route('admin.pajak.index', ['type' => 5]) }} @endif">
                  <i class="fas fa-id-card"></i>
                  <span>Ganti Plat</span>
              </a>
            </li>

            @if (Auth::guard('admin')->check())
              <li class="menu-header">Data Master</li>
              <li class="{{ $menu == 'announcement' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('admin.announcement.index') }}">
                      <i class="fas fa-bullhorn"></i>
                      <span>Pengumuman</span>
                  </a>
              </li>
              <li class="{{ $menu == 'officer' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.officer.index') }}">
                    <i class="fas fa-bullhorn"></i>
                    <span>Pegawai</span>
                </a>
              </li>
              @if (Auth::guard('admin')->user()->role == "superadmin")
                <li class="{{ $menu == 'account' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('admin.account.index') }}">
                      <i class="fas fa-user"></i>
                      <span>Akun</span>
                  </a>
                </li>
              @endif
              @if (Auth::guard('admin')->check())
                <li class="nav-item dropdown @if (str_contains($menu, 'report')) active @endif">
                  <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-building"></i> 
                    <span>Laporan</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="nav-link @if($menu == "bbn-report") text-primary @endif" href="{{ route('admin.report.bbn.index') }}">BBN</a>
                    </li>
                    <li>
                      <a class="nav-link @if($menu == "duplikat-report") text-primary @endif" href="{{ route('admin.report.duplikat.index') }}">Duplikat</a>
                    </li>
                    <li>
                      <a class="nav-link @if($menu == "mutasi-out-report") text-primary @endif" href="{{ route('admin.report.mutasi-out.index') }}">Mutasi Keluar</a>
                    </li>
                    <li>
                      <a class="nav-link @if($menu == "mutasi-in-report") text-primary @endif" href="{{ route('admin.report.mutasi-in.index') }}">Mutasi Masuk</a>
                    </li>
                    <li>
                      <a class="nav-link @if($menu == "mutasi-nopol-report") text-primary @endif" href="{{ route('admin.report.mutasi-nopol.index') }}">Mutasi Nopol</a>
                    </li>
                    <li>
                      <a class="nav-link @if($menu == "pajak1-report") text-primary @endif" href="{{ route('admin.report.pajak1.index') }}">Perpanjangan 1 Tahun</a>
                    </li>
                    <li>
                      <a class="nav-link @if($menu == "pajak5-report") text-primary @endif" href="{{ route('admin.report.pajak5.index') }}">Ganti Plat</a>
                    </li>
                    <li>
                      <a class="nav-link @if($menu == "user-report") text-primary @endif" href="{{ route('admin.report.user.index') }}">User</a>
                    </li>
                    <li>
                      <a class="nav-link @if($menu == "officer-report") text-primary @endif" href="{{ route('admin.report.officer.index') }}">Pegawai</a>
                    </li>
                  </ul>
                </li>
              @endif
            @endif
        </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2022
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('vendor/stisla/js/stisla.js') }}"></script>

  <script src="{{ asset('vendor/stisla/js/scripts.js') }}"></script>
  @yield('js-extends')

  <script src="{{ asset('vendor/stisla/js/jquery-datatables.js') }}"></script>
  <script src="{{ asset('vendor/stisla/js/datatables-bootstrap.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('#datatables').DataTable({
            dom: '<"row"<"col"l><"col"f>>rt<"row"<"col"i><"col"p>>',
            responsive: true
      });
    });
  </script>
</body>
</html>
