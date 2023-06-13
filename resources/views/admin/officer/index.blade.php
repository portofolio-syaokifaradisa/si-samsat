@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Manajemen Karyawan</h1>
    </div>

    <div class="section-body">
      {{-- <h2 class="section-title">Pengajuan Mutasi STNK</h2>
      <p class="section-lead">......</p> --}}

      <div class="row">
        <div class="col-12">
          @if (Session::has('success'))
              <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
          @elseif(Session::has('error'))
              <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
          @endif
          <div class="card">
            <div class="card-header">
              <h4>Tabel Karyawan</h4>
              <div class="card-header-form">
                <a href="{{ route('admin.officer.create') }}" class="btn btn-primary mr-2">
                  Tambah Karyawan
                </a>
                <a href="{{ route('admin.officer.print') }}" class="btn btn-primary">
                  Cetak Karyawan
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
                      <th class="text-center">Karyawan</th>
                      <th class="text-center">Alamat</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Jabatan</th>
                      <th class="text-center">Telepon</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($officers) > 0)
                      @foreach ($officers as $index => $data)
                        <tr>
                          <td class="text-center align-middle">{{ $index + 1 }}</td>
                          <td class="text-center align-middle">
                            <div class="btn-group dropright px-0 pr-2">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                              </button>
                              <div class="dropdown-menu dropright">
                                <a class="dropdown-item has-icon" href="{{ route('admin.officer.edit', ['id' => $data->id]) }}">
                                  Edit
                                </a>
                                <form action="{{route('admin.officer.delete', ['id' => $data->id])}}" id="delete-form-{{ $index }}" method="post">
                                  @method('DELETE')
                                  @csrf

                                  <a class="dropdown-item has-icon" href="{{ route('admin.officer.delete', ['id' => $data->id]) }}" id="btn-delete-{{ $index }}">
                                    Hapus
                                  </a>
                                </form>
                                
                              </div>
                            </div>
                          </td>
                          <td class="align-middle">
                            {{ $data->name }} <br>
                            {{ $data->nip }} <br>
                            {{ $data->gender }}
                          </td>
                          <td class="align-middle">
                            {{ $data->address }}
                          </td>
                          <td class="align-middle">
                            {{ $data->status }}
                          </td>
                          <td class="align-middle">
                            {{ $data->position }}
                          </td>
                          <td class="align-middle">
                            {{ $data->phone }}
                          </td>
                        </tr>
                      @endforeach
                    @else
                        <tr>
                          <td colspan="11" class="text-center">
                            Data karyawan Masih Kosong!
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
      var btnConfirmation = document.getElementById(`btn-delete-${i}`);
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
            title: 'Konfirmasi Hapus?',
            text: "Yakin ingin Menghapus Data Karyawan?",
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