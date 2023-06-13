@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Akun User Terdaftar</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Akun User Terdaftar</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive px-4 pb-4 mt-3">
                <a href="#" id="btn-report" class="btn btn-secondary px-3 mb-1">
                  Cetak Laporan
                </a>
                <table class="table table-bordered" id="user-datatables-report">
                  <thead>
                    <tr>
                      <th class="text-center">Nama</th>
                      <th class="text-center">No Telepon</th>
                      <th class="text-center">Email</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th id="name" class="text-center">Nama</th>
                      <th id="phone" class="text-center">No Telepon</th>
                      <th id="email" class="text-center">Email</th>
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
        $('#user-datatables-report tfoot th').each(function () {
            var name = $(this).attr('id');
            var title = $(this).text();
            $(this).html('<input type="text" name="'+ name +'" placeholder="Filter ' + title + '" id="'+ name +'-form"/>');
        });

        $('#user-datatables-report').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            dom: 'Brtip',
            ajax: "{{ route('admin.report.user.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });

                    $('select', this.footer()).on('change', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        });

        $('#btn-report').click(function(){
          var order_number = $('#order_number-form').val();
          var name = $('#name-form').val();
          var phone = $('#phone-form').val();
          var email = $('#email-form').val();

          location.href = `http://si-samsat.test/admin/report/user/download?name=${name}&phone=${phone}&email=${email}`
        });
    });
  </script>
@endsection