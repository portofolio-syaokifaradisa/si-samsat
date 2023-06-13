use Illuminate\Support\Facades\Request;
@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pengajuan Mutasi {{ $type }}</h1>
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
              <h4>Review Pengajuan Mutasi</h4>
            </div>
            <form action="{{ route('admin.mutasi.accept', ['id' => $order->id, 'type' => $type]) }}" method="post" enctype='multipart/form-data'>
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
                            @if ($type != "nopol")
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
                            @endif
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
                            @if ($order->surat_fiskal)
                                <div class="col-6 text-center">
                                    <a href="{{ $order->surat_fiskal_path }}" target="_blank">
                                        <img src="{{ $order->surat_fiskal_path }}" width="100%" height="300px">
                                    </a>
                                    <p>
                                        <b>
                                            Surat Fiskal
                                        </b>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group ml-4 col">
                            <label><b>Tarif Mutasi</b></label>
                            <input type="number" class="form-control" name="price" placeholder="Masukkan Tarif untuk Pengajuan Mutasi {{ ucwords($type) }}">
                        </div>
                        <div class="form-group mr-4 col">
                            <label><b>Batas Waktu</b></label>
                            <input type="date" class="form-control" name="time_limit">
                        </div>
                    </div>
                    @if ($type == "keluar")
                        <div class="form-group mt-2 mx-4">
                            <label><b>Surat Keterangan Fiskal</b></label>
                            <div class="custom-file">
                                <input type="file" name="fiskal" class="custom-file-input" id="uploaded-file-form-fiskal">
                                <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-fiskal">Choose file</label>
                            </div>
                        </div>
                    @endif
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

@section('js-extends')
    <script>
        function setFileNameUploaded(event){
            const id = event.target.id.split('-').pop();
            const fileName = event.target.value.split('\\').pop();

            document.getElementById(`uploaded-file-label-${id}`).innerHTML = fileName;
        }

        document.addEventListener("DOMContentLoaded", function(){
            document.getElementById('uploaded-file-form-fiskal').addEventListener('change', setFileNameUploaded);
        });
    </script>
@endsection