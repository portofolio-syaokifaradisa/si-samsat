@extends('templates.app')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Pegawai</h1>
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
              <h4>Form Pegawai</h4>
            </div>
            <form action="@if(isset($officer)) {{ route('admin.officer.update', ['id' => $officer->id]) }} @else {{ route('admin.officer.store') }} @endif" method="POST">
                @csrf
                @if(isset($officer))
                    @method('PUT')
                @endif

                <div class="card-body px-4 py-0">
                    <div class="row">
                        <div class="form-group col">
                            <label><b>Nama</b></label>
                            <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Lengkap Karyawan" value="{{ $officer->name ?? '' }}">
                        </div>
                        <div class="form-group col">
                            <label><b>NIP</b></label>
                            <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP Karyawan" value="{{ $officer->nip ?? '' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label><b>Jenis Kelamin</b></label>
                            <select class="form-control selectric" name="gender">
                                <option value="" selected hidden>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" @if (isset($officer))
                                    @if ($officer->gender == "Laki-laki")
                                        selected
                                    @endif
                                @endif>
                                Laki-laki
                                </option>
                                <option value="Perempuan" @if (isset($officer))
                                    @if ($officer->gender == "perempuan")
                                        selected
                                    @endif
                                @endif>
                                Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label><b>Jabatan</b></label>
                            <input type="text" class="form-control" name="position" placeholder="Masukkan Jabatan Karyawan" value="{{ $officer->position ?? '' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label><b>Nomor Telepon</b></label>
                            <input type="text" class="form-control" name="phone" placeholder="Masukkan Nomor Telepon Karyawan" value="{{ $officer->phone ?? '' }}">
                        </div>
                        <div class="form-group col">
                            <label><b>Status Pernikahan</b></label>
                            <select class="form-control selectric" name="status">
                                <option value="" selected hidden>Pilih Status Pernikahan</option>
                                <option value="SUDAH MENIKAH" @if (isset($officer))
                                    @if ($officer->status == "SUDAH MENIKAH")
                                        selected
                                    @endif
                                @endif>
                                Sudah Menikah
                                </option>
                                <option value="BELUM MENIKAH" @if (isset($officer))
                                    @if ($officer->status == "BELUM MENIKAH")
                                        selected
                                    @endif
                                @endif>
                                Belum Menikah
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label><b>Alamat</b></label>
                        <input type="text" class="form-control" name="address" placeholder="Masukkan Alamat Rumah Karyawan" value="{{ $officer->address ?? '' }}">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary px-3">
                        @if (isset($officer))
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