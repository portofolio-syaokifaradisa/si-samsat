<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SI-SAMSAT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('img/logo/logo.png') }}" rel="icon">
  <link href="{{ asset('img/logo/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/enno/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/enno/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/enno/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/enno/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/enno/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/enno/css/style.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body>
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="{{ route('landingpage') }}">Si-SAMSAT</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li>
              <a class="nav-link scrollto" href="
                @if (Route::current()->getName() == "landingpage")
                    #
                @else
                    {{ Route('landingpage') }}
                @endif">
                Home
            </a>
        </li>
          @if (Route::current()->getName() == "login" || Route::current()->getName() == "register")
            <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
            <li><a class="nav-link scrollto" href="#services">Layanan</a></li>
            <li><a class="nav-link scrollto" href="#pengumuman">Pengumuman</a></li>
          @endif
        
          @if (Auth::guard('web')->check() || Auth::guard('admin')->check())
            <li><a class="nav-link scrollto active" href="@if(Auth::guard('web')->check()) {{ route('home') }} @else {{ route('admin.home') }} @endif">Dashboard</a></li>
          @else
            <li><a class="nav-link scrollto @if(Route::current()->getName() == "register.index") active @endif" href="{{ route('register.index') }}">Daftar</a></li>
            <li><a class="nav-link scrollto @if(Route::current()->getName() == "login.index") active @endif" href="{{ route('login.index') }}">Login</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  

  <section id="hero" class="d-flex align-items-center">
    <div class="container mt-5 pt-5">
      <div class="row mt-5 pt-2">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>SI-SAMSAT</h1>
          <h2>Aplikasi Website Pendaftaran Bea Balik Nama (BNN), Duplikat, Mutasi, dan Perpanjangan Pajak 1 dan 5 Tahun</h2>
          <div class="d-flex">
            <a href="{{ route('register.index') }}" class="btn-get-started scrollto">Daftar Sekarang</a>
          </div>
        </div>
        <img src="{{ asset('img/illustration/hero-img.png') }}" class="img-fluid animated col-lg-6 order-1" alt="">
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <section id="about" class="about mt-5 ">
      <div class="container mt-3">

        <div class="row">
          <div class="col-lg-6">
            <img src="{{ asset('img/illustration/about.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content">
            <h3>Tentang Kami</h3>
            <p class="mt-2">
              SAMSAT merupakan suatu sistem kerjasama secara terpadu antara polri, Dinas Pendapatan Provinsi, dan PT Jasa Raharja (Persero)
              dalam pelayanan untuk menerbitkan STNK dan Tanda Nomor Kendaraan Bermotor yang dikaitkan dengan pemasukan uang ke kas negara baik
              melalui Pajak Kendaraaan Bermotor (PKB), BEC Balik Nama Kendaraan Bermotor, dan Sumbangan Wajib Dana Kecelakaan Lalu Lintas jalan (SWDKLJJ),
              dan dilaksanakan pada satu kantor yang dinamakan "Kantor Bersama Samsat".
            </p>
          </div>
        </div>

      </div>
    </section>
    <section id="services" class="services section-bg counts">
      <div class="container">

        <div class="section-title">
          <span>Layanan</span>
          <h2>Layanan Web</h2>
          <p>Layanan pendaftaran dalam website ini ada 3 antara lain</p>
        </div>

        <div class="row counters">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
                <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
                <h4>Mutasi</h4>
                <p>
                Dilakukan apabila pemilik kendaraan bermotor berpindah domisili atau daerah tinggal yang baru.
                </p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
                <span data-purecounter-start="0" data-purecounter-end="2" data-purecounter-duration="1" class="purecounter"></span>
                <h4>Duplikasi</h4>
                <p>
                  Membuat STNK baru yang sama apabila terjadi kehilangan STNK
                </p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
                <span data-purecounter-start="0" data-purecounter-end="3" data-purecounter-duration="1" class="purecounter"></span>
                <h4>Balik Nama</h4>
                <p>
                Proses pengalihan kepemilikan kendaraan bermotor dari pemilik lama ke pemilik baru
                </p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->
    <!-- ======= Testimonials Section ======= -->
    <section id="pengumuman" class="testimonials section-bg">
      <div class="container">
        <div class="section-title">
          <span>Pengumuman</span>
          <h2>Pengumuman</h2>
          <p>Informasi terkini dari pihak samsat kandangan</p>
        </div>
        <div>
            @foreach($announcements as $data)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ date('d-m-y', strtotime($data->created_at)) }}</h6>
                        <p class="card-text">{{ $data->body }}</p>
                        @if ($data->file)
                          <a href="{{ $data->file_path }}" target="_blank">
                            <i class="fas fa-file-alt mr-1"></i>
                            Lihat File
                          </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Samsat Kandangan 2022</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/enno-free-simple-bootstrap-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/enno/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('vendor/enno/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/enno/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/enno/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/enno/swiper/swiper-bundle.min.js') }}"></script>

  <script src="{{ asset('vendor/enno/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/enno/jquery-easing/jquery.easing.min.js') }}"></script>


  <!-- Template Main JS File -->
  <script src="{{ asset('vendor/enno/js/index.js') }}"></script>

</body>

</html>