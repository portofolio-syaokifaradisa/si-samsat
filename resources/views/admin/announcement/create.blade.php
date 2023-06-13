@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pengumuman</h1>
    </div>

    <div class="section-body">
      {{-- <h2 class="section-title">Pengumuman Informasi</h2>
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
              <h4>Form Pengumuman</h4>
            </div>
            <form action="@if(isset($announcement)) {{ route('admin.announcement.update', ['id' => $announcement->id]) }} @else {{ route('admin.announcement.store') }} @endif" method="POST" enctype='multipart/form-data'>
                @csrf
                @if(isset($announcement))
                    @method('PUT')
                @endif

                <div class="card-body px-4 py-0">
                    <div class="form-group">
                        <label><b>Judul</b></label>
                        <input type="text" class="form-control" name="title" placeholder="Masukkan Judul Pengumuman" value="{{ $announcement->title ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label><b>Isi Pengumuman</b></label>
                        <input type="text" class="form-control" name="body" placeholder="Masukkan Isi Pengumuman yang ingin disampaikan"  value="{{ $announcement->body ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label><b>File Lampiran</b></label>
                        <div class="custom-file">
                            <input type="file" name="attachment" class="custom-file-input" id="uploaded-file-form-attachment">
                            <label class="custom-file-label" for="uploaded-file-form" id="uploaded-file-label-attachment">Choose file</label>
                        </div>
                        @if (isset($announcement->file))
                            <small class="mt-2">
                                File Lampiran anda sebelumnya dapat dilihat <a href="{{ $announcement->file_path }}" target="_blank">disini</a>
                            </small>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary px-3">
                        @if (isset($order))
                            Edit
                        @else
                            Simpan
                        @endif 
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
            document.getElementById('uploaded-file-form-attachment').addEventListener('change', setFileNameUploaded);
        });
    </script>
@endsection