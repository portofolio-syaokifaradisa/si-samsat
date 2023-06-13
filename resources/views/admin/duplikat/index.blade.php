@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pengajuan Duplikat</h1>
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
              <div class="card-header-form">
                <a href="{{ route('admin.duplikat.print') }}" class="btn btn-primary" target="_blank">
                  Cetak Pengajuan
                </a>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive px-4 pb-4 mt-3">
                <table class="table table-bordered" id="datatables">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 20px">No.</th>
                      <th class="text-center" style="width: 20px">Aksi</th>
                      <th class="text-center" style="width: 50px">Nomor Order</th>
                      <th class="text-center">Pengaju</th>
                      <th class="text-center" style="width: 50px">Tanggal Pengajuan</th>
                      <th class="text-center">Tarif</th>
                      <th class="text-center">Nomor</th>
                      <th class="text-center" style="width: 60px">BPKB</th>
                      <th class="text-center" style="width: 130px">Berkas Lainnya</th>
                      <th class="text-center" style="width: 80px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($orders) > 0)
                      @foreach ($orders as $index => $data)
                        <tr>
                          <td class="text-center align-middle">{{ $index + 1 }}</td>
                          <td class="text-center align-middle">
                            @if ($data->status != 'DIBATALKAN' && $data->status != "SELESAI")
                              <div class="btn-group dropright px-0 pr-2">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu dropright">
                                  @if($data->status == "TERKIRIM")
                                    <a class="dropdown-item has-icon" href="{{ route('admin.duplikat.review', ['id' => $data->id]) }}">
                                      Terima
                                    </a>
                                    <a class="dropdown-item has-icon" href="{{ route('admin.duplikat.reject', ['id' => $data->id]) }}">
                                      Tolak
                                    </a>
                                  @elseif ($data->status == "DITERIMA")
                                    <form action="{{ route('admin.duplikat.finishing', ['id' => $data->id]) }}" method="post" id="finishing-form-{{ $index }}">
                                      @csrf
                                      @method('PUT')

                                      <a class="dropdown-item has-icon" href="" id="btn-finish-confirmation-{{ $index }}">
                                        Konfirmasi Selesai
                                      </a>
                                    </form>
                                  @endif
                                </div>
                              </div>
                            @else
                              -
                            @endif
                          </td>
                          <td class="text-center align-middle">
                            {{ $data->order_number }}
                          </td>
                          <td class="align-middle text-left">
                           {{ $data->user->name }} <br>
                           {{ $data->user->email }} <br>
                           {{ $data->user->phone }}
                          </td>
                          <td class="text-center align-middle">
                            {{ date('d-m-Y', strtotime($data->created_at)) }} <br>
                            @if ($data->price)
                              s/d <br> {{ date('d-m-Y', strtotime($data->time_limit)) }}
                            @endif
                          </td>
                          <td class="text-center align-middle">
                            @if ($data->price)
                              {{ $data->price }}
                            @else
                              -
                            @endif
                          </td>
                          <td class="text-center align-middle">
                            Nomor Mesin<br>({{ $data->machine_number }})
                            <br><br>
                            Nomor rangka<br>({{ $data->chassis_number }}) 
                          </td>
                          <td class="text-center align-middle">
                            <a href="{{ $data->bpkb1_path }}" target="_blank">
                              Halaman 1
                            </a> <br>
                            <a href="{{ $data->bpkb2_path }}" target="_blank">
                              Halaman 2
                            </a> <br>
                            <a href="{{ $data->bpkb3_path }}" target="_blank">
                              Halaman 3
                            </a> <br>
                            <a href="{{ $data->bpkb4_path }}" target="_blank">
                              Halaman 4
                            </a>
                          </td>
                          <td class="text-center align-middle">
                            <a href="{{ $data->ktp_path }}" target="_blank">
                              KTP
                            </a> <br>
                            <a href="{{ $data->stnk_path }}" target="_blank">
                              STNK
                            </a> <br>
                            <a href="{{ $data->ket_polisi_path }}" target="_blank">
                              Keterangan Kepolisian
                            </a> <br>
                            <a href="{{ $data->notice_pajak_path }}" target="_blank">
                              Notice Pajak
                            </a> <br>
                            <a href="{{ $data->surat_kuasa_path }}" target="_blank">
                              Suara Kuasa
                            </a>
                          </td>
                          <td class="text-center align-middle">
                            <span class="badge 
                              @if($data->status == "DIBATALKAN" || $data->status == "DITOLAK") 
                                badge-danger 
                              @elseif ($data->status == "SELESAI")
                                badge-success
                              @else
                                badge-primary
                              @endif">
                              {{ $data->status }}
                            </span>
                        </tr>
                      @endforeach
                    @else
                        <tr>
                          <td colspan="11" class="text-center">
                            Pengajuan Duplikat Masih Kosong!
                          </td>
                        </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js-extends')
  <script>
    const table = document.getElementById('datatables');
    for(var i=0; i<(table.rows.length-1); i++){
      var btnConfirmation = document.getElementById(`btn-finish-confirmation-${i}`);
      if(btnConfirmation){
        btnConfirmation.addEventListener('click', function(event){
          event.preventDefault();
          Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          }).fire({
            title: 'Konfirmasi Selesai?',
            text: "Yakin ingin Menyelesaikan Pengajuan?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
          }).then(async (result) => {
            if (result.isConfirmed) {
              var dataId = event.target.id.split('-')[3];
              document.getElementById(`finishing-form-${dataId}`).submit();
            }
          });
        });
      }
    }
  </script>
@endsection