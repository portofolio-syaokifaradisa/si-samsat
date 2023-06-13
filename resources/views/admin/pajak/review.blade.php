@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pengajuan @if ($type == 5)
        Ganti Plat
      @else
        Perpanjangan Pajak
      @endif</h1>
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
              <h4>Review Pengajuan</h4>
            </div>
            <form action="{{ route('admin.pajak.accept', ['id' => $order->id, 'type' => $type]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="card-body px-3 py-0">
                    <div class="form-group mx-3">
                        <label><b>Berkas Pengajuan</b></label>
                        <div class="row">
                            <div class="col-6 text-center">
                                <a href="{{ $order->ktp_path }}" target="_blank">
                                    <img src="{{ $order->ktp_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        Scan KTP
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
                            <div class="col-6 text-center"></div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->bpkb_first_path }}" target="_blank">
                                    <img src="{{ $order->bpkb_first_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        BPKB Halaman 1
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->bpkb_second_path }}" target="_blank">
                                    <img src="{{ $order->bpkb_second_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        BPKB Halaman 2
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->bpkb_third_path }}" target="_blank">
                                    <img src="{{ $order->bpkb_third_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        BPKB Halaman 3
                                    </b>
                                </p>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ $order->bpkb_fourth_path }}" target="_blank">
                                    <img src="{{ $order->bpkb_fourth_path }}" width="100%" height="300px">
                                </a>
                                <p>
                                    <b>
                                        BPKB Halaman 4
                                    </b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group ml-4 col">
                            <label><b>Tarif Perpanjangan Pajak</b></label>
                            <input type="number" class="form-control" name="price" placeholder="Masukkan Tarif untuk Perpanjangan Pajak">
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