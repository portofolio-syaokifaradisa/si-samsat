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
              <div class="card-header-form">
                <a href="{{ route('pajak.create', ['type' => $type]) }}" class="btn btn-primary">
                  Ajukan Pengajuan
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
                      <th class="text-center">Nomor Order</th>
                      @if ($type == 5)
                        <th class="text-center">Nomor</th>
                      @endif
                      <th class="text-center" style="width: 100px">Tanggal Pengajuan</th>
                      <th class="text-center">Tarif</th>
                      <th class="text-center">Berkas Pengajuan</th>
                      <th class="text-center">BPKB</th>
                      <th class="text-center" style="width: 100px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($orders) > 0)
                      @foreach ($orders as $index => $data)
                        <tr>
                          <td class="text-center align-middle">{{ $index + 1 }}</td>
                          <td class="text-center align-middle">
                            @if ($data->status != 'DIBATALKAN')
                            <div class="btn-group dropright px-0 pr-2">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                              </button>
                              <div class="dropdown-menu dropright">
                                @if($data->status == "TERKIRIM")
                                  <a class="dropdown-item has-icon" href="{{ route('pajak.edit', ['id' => $data->id, 'type' => $type ]) }}">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                  </a>
                                  <form action="{{ route('pajak.cancel', ['id' => $data->id, 'type' => $type]) }}" method="POST" id="delete-form-{{ $index }}">
                                    @csrf
                                    @method('PUT')

                                    <a class="dropdown-item has-icon" href="#" id="delete-btn-{{ $index }}">
                                      <i class="fas fa-trash-alt"></i>
                                      Batalkan
                                    </a>
                                  </form>
                                @elseif ($data->status == "DITERIMA" || $data->status == "SELESAI")
                                  <a class="dropdown-item has-icon" href="{{ route('pajak.print', ['id' => $data->id, 'type' => $type]) }}" target="_blank">
                                    <i class="fas fa-file-alt"></i>
                                    Bukti Pengajuan
                                  </a>
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
                          @if ($type == 5)
                            <td class="text-center align-middle">
                              Nomor Mesin<br>({{ $data->machine_number }})
                              <br><br>
                              Nomor rangka<br>({{ $data->chassis_number }}) 
                            </td>
                          @endif
                          <td class="text-center align-middle">
                            {{ date('d-m-Y', strtotime($data->created_at)) }}
                          </td>
                          <td class="text-center align-middle">
                            @if ($data->price)
                              {{ $data->price }}
                            @else
                              -
                            @endif
                          </td>
                          <td class="text-center align-middle">
                            <a href="{{ $data->ktp_path }}" target="_blank">
                              KTP
                            </a>
                            <br>
                            <a href="{{ $data->stnk_path }}" target="_blank">
                              STNK
                            </a>
                            <br>
                            <a href="{{ $data->notice_pajak_path }}" target="_blank">
                              Notice Pajak
                            </a>
                          </td>
                          <td class="text-center align-middle">
                            @if ($data->bpkb_first_path)
                              <a href="{{ $data->bpkb_first_path }}" target="_blank">
                                Halaman 1
                              </a> <br>
                              <a href="{{ $data->bpkb_second_path }}" target="_blank">
                                Halaman 2
                              </a> <br>
                              <a href="{{ $data->bpkb_third_path }}" target="_blank">
                                Halaman 3
                              </a> <br>
                              <a href="{{ $data->bpkb_fourth_path }}" target="_blank">
                                Halaman 4
                              </a>
                              <br>
                            @else
                              -
                            @endif
                          </td>
                          <td class="text-center align-middle">
                            <span class="badge 
                              @if($data->status == "DIBATALKAN") 
                                badge-danger 
                              @elseif ($data->status == "TERKIRIM")
                                badge-primary
                              @endif">
                              {{ $data->status }}
                            </span>
                          </td>
                        </tr>
                      @endforeach
                    @else
                        <tr>
                          <td colspan="9" class="text-center">
                            Anda Belum Pernah Melakukan Order!
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
      var cancelButton = document.getElementById(`delete-btn-${i}`);
      if(cancelButton){
        cancelButton.addEventListener('click', function(event){
          event.preventDefault();
          Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          }).fire({
            title: 'Konfirmasi Pembatalan?',
            text: "Yakin ingin Membatalkan Pengajuan?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
          }).then(async (result) => {
            if (result.isConfirmed) {
              var dataId = event.target.id.split('-')[2];
              document.getElementById(`delete-form-${dataId}`).submit();
            }
          });
        });
      }
    }

  </script>
@endsection