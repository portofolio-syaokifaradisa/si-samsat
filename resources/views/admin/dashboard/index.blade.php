@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.baliknama.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                      <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Bea Baliknama</h4>
                      </div>
                      <div class="card-body">
                        {{ $bnn }}
                      </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.duplikat.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Duplikat</h4>
                    </div>
                    <div class="card-body">
                        {{ $duplikat }}
                    </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.mutasi.index', ['type' => 'keluar']) }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Mutasi Masuk</h4>
                    </div>
                    <div class="card-body">
                        {{ $mutasi_keluar }}
                    </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.mutasi.index', ['type' => 'masuk']) }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Mutasi Keluar</h4>
                    </div>
                    <div class="card-body">
                        {{ $mutasi_masuk }}
                    </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.pajak.index', ['type' => 1]) }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Perpanjangan Pajak 1 Tahun</h4>
                    </div>
                    <div class="card-body">
                        {{ $pajak1 }}
                    </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.pajak.index', ['type' => 5]) }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Ganti Plat</h4>
                    </div>
                    <div class="card-body">
                        {{ $pajak5 }}
                    </div>
                    </div>
                </div>
            </a>
        </div>
      </div>
    </div>
  </section>
@endsection