@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>
        @if ($type == 5)
          Ganti Plat
        @else
          Perpanjangan Pajak
        @endif
      </h1>
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
              <h4>Tabel Pengajuan</h4>
            </div>
            <form action="@if(isset($order)) {{ route('pajak.update', ['id' => $order->id, 'type' => $type]) }} @else {{ route('pajak.store', ['type' => $type]) }} @endif" method="POST" enctype='multipart/form-data'>
                @csrf
                @if(isset($order))
                    @method('PUT')
                @endif

                <div class="card-body px-4 py-0">
                    @if ($type == 5)
                        <div class="row">
                            <div class="form-group col">
                                <label><b>Nomor Mesin</b></label>
                                <input type="text" class="form-control" name="machine_number" placeholder="Masukkan Nomor Mesin" value="{{ $order->machine_number ?? '' }}">
                            </div>
                            <div class="form-group col">
                                <label><b>Nomor Rangka</b></label>
                                <input type="text" class="form-control" name="chassis_number" placeholder="Masukkan Nomor Rangka" value="{{ $order->chassis_number ?? '' }}">
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col">
                            <label><b>Kartu Tanda Penduduk (KTP)</b></label>
                            <div class="custom-file">
                                <input type="file" name="ktp" class="custom-file-input" id="uploaded-file-form-ktp" @if(!isset($order)) required @endif>
                                <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-ktp">Choose file</label>
                            </div>
                            @if (isset($order->ktp))
                                <small class="mt-2">
                                    File KTP anda sebelumnya dapat dilihat <a href="{{ $order->ktp_path }}" target="_blank">disini</a>
                                </small>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label><b>STNK</b></label>
                            <div class="custom-file">
                                <input type="file" name="stnk" class="custom-file-input" id="uploaded-file-form-stnk" @if(!isset($order)) required @endif>
                                <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-stnk">Choose file</label>
                            </div>
                            @if (isset($order->stnk))
                                <small class="mt-2">
                                    File STNK anda sebelumnya dapat dilihat <a href="{{ $order->stnk_path }}" target="_blank">disini</a>
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label><b>Notice Pajak</b></label>
                            <div class="custom-file">
                                <input type="file" name="notice_pajak" class="custom-file-input" id="uploaded-file-form-pajak" @if(!isset($order)) required @endif>
                                <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-pajak">Choose file</label>
                            </div>
                            @if (isset($order->notice_pajak))
                                <small class="mt-2">
                                    File Notice Pajak anda sebelumnya dapat dilihat <a href="{{ $order->notice_pajak_path }}" target="_blank">disini</a>
                                </small>
                            @endif
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label><b>BPKB Halaman 1</b></label>
                            <div class="custom-file">
                                <input type="file" name="bpkb1" class="custom-file-input" id="uploaded-file-form-bpkb1" @if(!isset($order)) required @endif>
                                <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-bpkb1">Choose file</label>
                            </div>
                            @if (isset($order->bpkb_first_page))
                                <small class="mt-2">
                                    File BPKB Halaman 1 anda sebelumnya dapat dilihat <a href="{{ $order->bpkb_first_path }}" target="_blank">disini</a>
                                </small>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label><b>BPKB Halaman 2</b></label>
                            <div class="custom-file">
                                <input type="file" name="bpkb2" class="custom-file-input" id="uploaded-file-form-bpkb2" @if(!isset($order)) required @endif>
                                <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-bpkb2">Choose file</label>
                            </div>
                            @if (isset($order->bpkb_second_page))
                                <small class="mt-2">
                                    File BPKB Halaman 2 anda sebelumnya dapat dilihat <a href="{{ $order->bpkb_second_path }}" target="_blank">disini</a>
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label><b>BPKB Halaman 3</b></label>
                            <div class="custom-file">
                                <input type="file" name="bpkb3" class="custom-file-input" id="uploaded-file-form-bpkb3" @if(!isset($order)) required @endif>
                                <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-bpkb3">Choose file</label>
                            </div>
                            @if (isset($order->bpkb_third_page))
                                <small class="mt-2">
                                    File BPKB Halaman 3 anda sebelumnya dapat dilihat <a href="{{ $order->bpkb_third_path }}" target="_blank">disini</a>
                                </small>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label><b>BPKB Halaman 4</b></label>
                            <div class="custom-file">
                                <input type="file" name="bpkb4" class="custom-file-input" id="uploaded-file-form-bpkb4" @if(!isset($order)) required @endif>
                                <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-bpkb4">Choose file</label>
                            </div>
                            @if (isset($order->bpkb_fourth_page))
                                <small class="mt-2">
                                    File BPKB Halaman 4 anda sebelumnya dapat dilihat <a href="{{ $order->bpkb_fourth_path }}" target="_blank">disini</a>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary px-3">
                        @if (isset($order))
                            Edit
                        @else
                            Kirim
                        @endif 
                        Pengajuan
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
            document.getElementById('uploaded-file-form-ktp').addEventListener('change', setFileNameUploaded);
            document.getElementById('uploaded-file-form-stnk').addEventListener('change', setFileNameUploaded);
            document.getElementById('uploaded-file-form-pajak').addEventListener('change', setFileNameUploaded);
            document.getElementById('uploaded-file-form-bpkb1').addEventListener('change', setFileNameUploaded);
            document.getElementById('uploaded-file-form-bpkb2').addEventListener('change', setFileNameUploaded);
            document.getElementById('uploaded-file-form-bpkb3').addEventListener('change', setFileNameUploaded);
            document.getElementById('uploaded-file-form-bpkb4').addEventListener('change', setFileNameUploaded);
        });
    </script>
@endsection