@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pegawai</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Pegawai</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive px-4 pb-4 mt-3">
                <a href="#" id="btn-report" class="btn btn-secondary px-3 mb-1">
                  Cetak Laporan
                </a>
                <table class="table table-bordered" id="officer-datatables-report">
                  <thead>
                    <tr>
                      <th class="text-center">Nama</th>
                      <th class="text-center">NIP</th>
                      <th class="text-center">Jabatan</th>
                      <th class="text-center">Jenis Kelamin</th>
                      <th class="text-center">Telepon</th>
                      <th class="text-center">Alamat</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th id="name" class="text-center">Nama</th>
                      <th id="nip" class="text-center">NIP</th>
                      <th id="position" class="text-center">Jabatan</th>
                      <th id="gender" class="text-center">Jenis Kelamin</th>
                      <th id="phone" class="text-center">Telepon</th>
                      <th id="address" class="text-center">Alamat</th>
                      <th id="status" class="text-center">status</th>
                    </tr>
                  </tfoot>
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
  <script type="text/javascript">
    $(function () {
        $('#officer-datatables-report tfoot th').each(function () {
            var name = $(this).attr('id');
            var title = $(this).text();
            if(name === "gender"){
                $(this).html(`
                    <select class="custom-select" name="${name}-form" id="${name}-form">
                        <option value="" selected hidden>Filter Jenis Kelamin</option>
                        <option value="">Semua</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">perempuan</option>
                    </select>
                `);
            }else if(name == "status"){
              $(this).html(`
                    <select class="custom-select" name="${name}-form" id="${name}-form">
                        <option value="" selected hidden>Filter Status Pernikahan</option>
                        <option value="">Semua</option>
                        <option value="SUDAH MENIKAH">Sudah Menikah</option>
                        <option value="BELUM MENIKAH">Belum Menikah</option>
                    </select>
                `);
            }else{
                $(this).html('<input type="text" name="'+ name +'" placeholder="Filter ' + title + '" id="'+ name +'-form"/>');
            }
        });

        $('#officer-datatables-report').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            dom: 'Brtip',
            ajax: "{{ route('admin.report.officer.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'nip', name: 'nip'},
                {data: 'position', name: 'position'},
                {data: 'gender', name: 'gender'},
                {data: 'phone', name: 'phone'},
                {data: 'address', name: 'address'},
                {data: 'status', name: 'status'},
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });

                    $('#gender-form', this.footer()).on('change', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });

                    $('#status-form', this.footer()).on('change', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        });

        $('#btn-report').click(function(){
          var name = $('#name-form').val();
          var nip = $('#nip-form').val();
          var position = $('#position-form').val();
          var gender = $('#gender-form').val();
          var phone = $('#phone-form').val();
          var address = $('#address-form').val();
          var status = $('#status-form').val();

          location.href = `http://si-samsat.test/admin/report/officer/download?name=${name}&nip=${nip}&position=${position}&gender=${gender}&phone=${phone}&address=${address}&status=${status}`
        });
    });
  </script>
@endsection