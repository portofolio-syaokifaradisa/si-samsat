@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pengajuan BBN</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Pengajuan BBN</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive px-4 pb-4 mt-3">
                <a href="#" id="btn-report" class="btn btn-secondary px-3 mb-1">
                  Cetak Laporan
                </a>
                <table class="table table-bordered" id="bbn-datatables-report">
                  <thead>
                    <tr>
                      <th class="text-center">Nomor Order</th>
                      <th class="text-center">Nomor<br>Mesin</th>
                      <th class="text-center">Nomor<br>Rangka</th>
                      <th class="text-center">Pengaju</th>
                      <th class="text-center">Tanggal Pengajuan</th>
                      <th class="text-center">Tarif</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                      <th id="order_number" class="text-center">Nomor Order</th>
                      <th id="machine_number" class="text-center">Nomor<br>Mesin</th>
                      <th id="chassis_number" class="text-center">Nomor<br>Rangka</th>
                      <th id="name" class="text-center">Pengaju</th>
                      <th id="date" class="text-center">Tanggal Pengajuan</th>
                      <th id="price" class="text-center">Tarif</th>
                      <th id="status" class="text-center">Status</th>
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
        $('#bbn-datatables-report tfoot th').each(function () {
            var name = $(this).attr('id');
            var title = $(this).text();
            if(name === "status"){
                $(this).html(`
                    <select class="custom-select" name="${name}-form" id="${name}-form">
                        <option value="" selected hidden>Filter Status</option>
                        <option value="">Semua</option>
                        <option value="DIBATALKAN">Dibatalkan</option>
                        <option value="TERKIRIM">Terkirim</option>
                        <option value="DITERIMA">Diterima</option>
                        <option value="DITOLAK">Ditolak</option>
                        <option value="SELESAI">Selesai</option>
                    </select>
                `);
            }else{
                $(this).html('<input type="text" name="'+ name +'" placeholder="Filter ' + title + '" id="'+ name +'-form"/>');
            }
        });

        $('#bbn-datatables-report').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            dom: 'Brtip',
            ajax: "{{ route('admin.report.bbn.index') }}",
            columns: [
                {data: 'order-number', name: 'order-number'},
                {data: 'machine-number', name: 'machine-number'},
                {data: 'chassis-number', name: 'chassis-number'},
                {data: 'name', name: 'name'},
                {data: 'date', name: 'date'},
                {data: 'price', name: 'price'},
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
          var machine_number = $('#machine_number-form').val();
          var chassis_number = $('#chassis_number-form').val();
          var date = $('#date-form').val();
          var name = $('#name-form').val();
          var price = $('#price-form').val();
          var status = $('#status-form').val();

          location.href = `http://si-samsat.test/admin/report/bbn/download?order_number=${order_number}&name=${name}&date=${date}&price=${price}&status=${status}&machine_number=${machine_number}&chassis_number=${chassis_number}`
        });
    });
  </script>
@endsection