@extends('admin.layouts.master')
@section('title', 'Tambah Karyawan')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Data Karyawan</h3>
                <p class="text-subtitle text-muted">Silahkan isi data karyawan yang ingin ditambahkan</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">Submit Error!</h5>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form class="form" action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama_Karyawan</label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Masukkan Nama Karyawan" name="fullname" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Username</label>
                                <textarea type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Nomor Telepon</label>
                                <textarea type="text" class="form-control" id="phone" placeholder="Masukkan Nomor Handpone" name="phone"
                                    required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role_id"></select>
                            </div>

                            <div class="form-group">
                                <label for="description"></label>
                                <textarea type="text" class="form-control" id="role" placeholder="Masukkan Role" name="role_name" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea type="text" class="form-control" id="description" placeholder="Masukkan Deskripsi" name="description"
                                    required></textarea>
                            </div>

                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                <a href="{{ route('users.index') }}" type="submit"
                                    class="btn btn-light-secondary me-1 mb-1">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
