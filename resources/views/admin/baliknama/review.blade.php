use Illuminate\Support\Facades\Request;
@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pengajuan Baliknama</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          @if (Session::has('success'))
              <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
          @elseif(Session::has('error'))
              <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
          @endif
          <div class="card">
            <div class="card-header">
              <h4>Review Pengajuan Baliknama</h4>
            </div>
            <form action="{{ route('admin.baliknama.accept', ['id' => $order->id]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="card-body px-3 py-0">
                    <div class="form-group mx-3">
                        <div class="row">
                            <div class="form-group col">
                                <label><b>Nomor Mesin</b></label>
                                <input type="text" class="form-control" name="machine_number" placeholder="Masukkan Nomor Mesin" value="{{ $order->machine_number }}" readonly>
                            </div>
                            <div class="form-group col">
                                <label><b>Nomor Rangka</b></label>
                                <input type="text" class="form-control" name="chassis_number" placeholder="Masukkan Nomor Rangka" value="{{$order->chassis_number }}" readonly>
                            </div>
                        </div>
                        <br>

                        <label><b>Berkas Pengajuan</b></label>
                        <div class="row">
                            <div class="col-6 text-center">
                                <a href="{{ $order->ktp1_path }}" target="_blank">
                                    <img src="{{ $order->ktp1_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        Scan KTP Pihak 1
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->ktp2_path }}" target="_blank">
                                    <img src="{{ $order->ktp2_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        Scan KTP Pihak 2
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->stnk_path }}" target="_blank">
                                    <img src="{{ $order->stnk_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        Scan STNK
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->notice_pajak_path }}" target="_blank">
                                    <img src="{{ $order->notice_pajak_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        Scan Notice Pajak
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->bpkb1_path }}" target="_blank">
                                    <img src="{{ $order->bpkb1_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        BPKB Halaman 1
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->bpkb2_path }}" target="_blank">
                                    <img src="{{ $order->bpkb2_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        BPKB Halaman 2
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->bpkb3_path }}" target="_blank">
                                    <img src="{{ $order->bpkb3_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        BPKB Halaman 3
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->bpkb4_path }}" target="_blank">
                                    <img src="{{ $order->bpkb4_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        BPKB Halaman 4
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->kwitansi_path }}" target="_blank">
                                    <img src="{{ $order->kwitansi_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        kwitansi
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->polda_recommendation_path }}" target="_blank">
                                    <img src="{{ $order->polda_recommendation_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        Surat Rekomendasi Polda
                                    </b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group ml-4 col">
                            <label><b>Tarif Baliknama</b></label>
                            <input type="number" class="form-control" name="price" placeholder="Masukkan Tarif untuk Pengajuan Baliknama">
                        </div>
                        <div class="form-group mr-4 col">
                            <label><b>Batas Waktu</b></label>
                            <input type="date" class="form-control" name="time_limit">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary px-3">
                      Konfirmasi Pengajuan
                    </button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection