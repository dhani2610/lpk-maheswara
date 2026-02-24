@extends('layouts-admin.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <style>
        .dropify-wrapper .dropify-message p { font-size: 14px !important; margin: 5px 0 0 0; }
        .dropify-wrapper .dropify-message span.file-icon { font-size: 24px !important; }
    </style>
@endsection

@section('content')
    <div class="content p-4">
        <h4 class="fw-bold mb-4">Pengaturan Global Website</h4>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card p-4 border-0 shadow-sm">
            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-4 text-center">
                        <label class="form-label fw-bold d-block text-start">Logo Utama Website</label>
                        <input type="file" name="logo" class="dropify"
                               data-height="200"
                               data-default-file="{{ $setting->logo ? asset('storage/' . $setting->logo) : '' }}" />
                        <small class="text-muted mt-2 d-block text-start">Format ideal: PNG dengan latar transparan (Max: 2MB).</small>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Website / Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="site_name" class="form-control"
                                   value="{{ old('site_name', $setting->site_name ?? 'LPK Maheswara') }}"
                                   placeholder="Contoh: LPK Maheswara" required>
                        </div>

                        <hr class="my-4">
                        <h6 class="fw-bold text-danger mb-3"><i class="fa-solid fa-share-nodes me-2"></i> Tautan Sosial Media</h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Facebook</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fa-brands fa-facebook text-primary fs-5"></i></span>
                                <input type="url" name="facebook_url" class="form-control border-start-0"
                                       value="{{ old('facebook_url', $setting->facebook_url) }}"
                                       placeholder="https://facebook.com/lpkmaheswara">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Instagram</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fa-brands fa-instagram text-danger fs-5"></i></span>
                                <input type="url" name="instagram_url" class="form-control border-start-0"
                                       value="{{ old('instagram_url', $setting->instagram_url) }}"
                                       placeholder="https://instagram.com/lpkmaheswara">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold small">YouTube</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fa-brands fa-youtube text-danger fs-5"></i></span>
                                <input type="url" name="youtube_url" class="form-control border-start-0"
                                       value="{{ old('youtube_url', $setting->youtube_url) }}"
                                       placeholder="https://youtube.com/@lpkmaheswara">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-2 mb-4">

                <div class="text-end">
                    <button type="submit" class="btn btn-red px-5 py-2 fw-bold shadow-sm">
                        <i class="fa-solid fa-save me-2"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag & drop logo / klik di sini',
                    'replace': 'Drag & drop / klik untuk mengganti',
                    'remove': 'Hapus',
                    'error': 'Terjadi kesalahan.'
                }
            });
        });
    </script>
@endsection
