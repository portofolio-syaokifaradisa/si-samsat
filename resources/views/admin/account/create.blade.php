@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Manajemen Akun</h1>
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
              <h4>Form Akun</h4>
            </div>
            <form action="@if(isset($admin)) {{ route('admin.account.update', ['id' => $admin->id]) }} @else {{ route('admin.account.store') }} @endif" method="POST" enctype='multipart/form-data'>
                @csrf
                @if(isset($admin))
                    @method('PUT')
                @endif

                <div class="card-body px-4 py-0">
                    <div class="form-group">
                        <label><b>Nama Lengkap</b></label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Pemegang Akun" value="{{ $admin->name ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label><b>Email</b></label>
                        <input type="text" class="form-control" name="email" placeholder="Masukkan Isi Pengumuman yang ingin disampaikan"  value="{{ $admin->email ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label><b>Password</b></label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password Akun">
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