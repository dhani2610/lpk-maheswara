@extends('layouts-admin.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        .dropify-wrapper .dropify-message p { font-size: 14px !important; margin: 5px 0 0 0; }
        .dropify-wrapper .dropify-message span.file-icon { font-size: 24px !important; }
        .note-editor .note-editing-area { background: #fff; }
    </style>
@endsection

@section('content')
    <div class="content p-4">
        <h4 class="fw-bold mb-4">Pengaturan Tentang Kami</h4>

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
            <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label class="form-label fw-bold">Gambar Representasi</label>
                        <input type="file" name="image" class="dropify"
                               data-height="300"
                               data-default-file="{{ $about->image ? asset('storage/' . $about->image) : '' }}" />
                        <small class="text-muted mt-2 d-block">Disarankan format mendatar (Landscape).</small>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Konten (Deskripsi Panjang)</label>
                            <textarea id="summernote" name="content">{{ old('content', $about->content) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Daftar Keunggulan LPK (Checklist)</label>
                            <div id="checklistContainer">
                                @if($about->checklists && count($about->checklists) > 0)
                                    @foreach($about->checklists as $index => $checklist)
                                        <div class="input-group mb-2">
                                            <span class="input-group-text bg-white"><i class="fa-solid fa-check text-success"></i></span>
                                            <input type="text" name="checklists[]" class="form-control" value="{{ $checklist }}" placeholder="Keunggulan LPK...">
                                            <button class="btn btn-outline-danger btn-remove-checklist" type="button"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <span class="input-group-text bg-white"><i class="fa-solid fa-check text-success"></i></span>
                                        <input type="text" name="checklists[]" class="form-control" placeholder="Contoh: Instruktur Berpengalaman">
                                        <button class="btn btn-outline-danger btn-remove-checklist" type="button"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2 fw-semibold" id="addChecklist">
                                <i class="fa-solid fa-plus me-1"></i> Tambah Keunggulan
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-end">
                    <button type="submit" class="btn btn-red px-4 py-2 fw-bold">
                        <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag & drop foto About di sini',
                    'replace': 'Drag & drop atau klik untuk mengganti foto',
                    'remove': 'Hapus',
                    'error': 'Terjadi kesalahan.'
                }
            });

            // Inisialisasi Summernote
            $('#summernote').summernote({
                placeholder: 'Tuliskan profil atau deskripsi lengkap LPK Maheswara di sini...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Logika JS untuk Dynamic Input Checklist
            const btnAddChecklist = document.getElementById('addChecklist');
            const checklistContainer = document.getElementById('checklistContainer');

            btnAddChecklist.addEventListener('click', function() {
                const inputGroup = document.createElement('div');
                inputGroup.className = 'input-group mb-2';
                inputGroup.innerHTML = `
                    <span class="input-group-text bg-white"><i class="fa-solid fa-check text-success"></i></span>
                    <input type="text" name="checklists[]" class="form-control" placeholder="Keunggulan lainnya...">
                    <button class="btn btn-outline-danger btn-remove-checklist" type="button"><i class="fa-solid fa-trash"></i></button>
                `;
                checklistContainer.appendChild(inputGroup);
            });

            checklistContainer.addEventListener('click', function(e) {
                // Cari tombol delete terdekat yang diklik
                const btnRemove = e.target.closest('.btn-remove-checklist');
                if(btnRemove) {
                    btnRemove.closest('.input-group').remove();
                }
            });
        });
    </script>
@endsection
