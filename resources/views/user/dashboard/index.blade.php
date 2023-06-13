@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body px-3">
      <div class="row">
        <div class="card">
            <div class="card-header">
              <h4>Alur Pengajuan</h4>
            </div>
            <div class="card-body p-0">
                <img src="{{ asset('img/alur.jpeg') }}">
            </div>
        </div>
        <div class="card ml-2 col-lg-4">
            <div class="card-header">
              <h4>Menu Cepat</h4>
            </div>
            <div class="card-body p-0 text-center align-middle">
                <br>
                <a href="{{ route('baliknama.index') }}" class="btn btn-primary" style="width: 70%">
                    Bea Baliknama (BNN) <i class="fas fa-chevron-right"></i>
                </a>
                <br> <br>
                <a href="{{ route('duplikat.index') }}" class="btn btn-primary" style="width: 70%">
                    Duplikat <i class="fas fa-chevron-right"></i>
                </a>
                <br> <br>
                <a href="{{ route('mutasi.index', ['type' => 'keluar']) }}" class="btn btn-primary" style="width: 70%">
                    Mutasi Keluar <i class="fas fa-chevron-right"></i>
                </a>
                <br> <br>
                <a href="{{ route('mutasi.index', ['type' => 'masuk']) }}" class="btn btn-primary" style="width: 70%">
                    Mutasi Masuk <i class="fas fa-chevron-right"></i>
                </a>
                <br> <br>
                <a href="{{ route('pajak.index', ['type' => '1']) }}" class="btn btn-primary" style="width: 70%">
                    Perpanjangan Pajak 1 Tahun <i class="fas fa-chevron-right"></i>
                </a>
                <br> <br>
                <a href="{{ route('pajak.index', ['type' => '5']) }}" class="btn btn-primary" style="width: 70%">
                    Ganti Plat <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection