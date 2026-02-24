@extends('layouts-admin.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        .dropify-wrapper .dropify-message p { font-size: 14px !important; margin: 5px 0 0 0; }
        .dropify-wrapper .dropify-message span.file-icon { font-size: 24px !important; }
        .dataTables_wrapper .row { margin-bottom: 15px; }
        div.dataTables_filter input { border-radius: 6px; border: 1px solid #dee2e6; padding: 4px 10px; }
        .note-editor .note-editing-area { background: #fff; }
    </style>
@endsection

@section('content')
    <div class="content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Kelola Program Pelatihan</h4>
            <button class="btn btn-red" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fa-solid fa-plus me-1"></i> Tambah Program
            </button>
        </div>

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
            <div class="table-responsive">
                <table id="programTable" class="table table-hover align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Deskripsi Singkat</th>
                            <th>Tgl Dibuat</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $program)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $program->cover) }}" width="80" class="rounded shadow-sm" alt="Cover" style="object-fit: cover; height: 50px;">
                                </td>
                                <td class="fw-bold">{{ $program->title }}</td>
                                <td>{{ Str::limit($program->short_description, 40) ?: '-' }}</td>
                                <td>{{ $program->created_at->format('d M Y') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $program->id }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $program->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL AREA (DILUAR TABEL) --}}
    @foreach ($programs as $program)
        <div class="modal fade" id="editModal{{ $program->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{ route('program.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-light">
                            <h5 class="modal-title fw-bold">Edit Program</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Cover Image</label>
                                    <input type="file" name="cover" class="dropify" data-default-file="{{ asset('storage/' . $program->cover) }}" data-height="150" />
                                    <small class="text-muted" style="font-size: 12px;">Kosongkan jika tidak ubah gambar.</small>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Program <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ $program->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Deskripsi Singkat (Tampil di Card)</label>
                                        <textarea name="short_description" class="form-control" rows="2">{{ $program->short_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="form-label fw-semibold">Konten Lengkap</label>
                                    <textarea name="content" class="summernote">{{ $program->content }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-red px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal{{ $program->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content border-0">
                    <form action="{{ route('program.destroy', $program->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title fw-bold">Hapus Program?</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center py-4">
                            <i class="fa-solid fa-triangle-exclamation text-warning fs-1 mb-3"></i>
                            <p class="mb-0">Apakah Anda yakin ingin menghapus program <br><strong>"{{ $program->title }}"</strong>?</p>
                            <p class="text-muted small mt-1">Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                        <div class="modal-footer bg-light justify-content-center">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger px-4">Ya, Hapus!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="addModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('program.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold">Tambah Program</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Cover Image <span class="text-danger">*</span></label>
                                <input type="file" name="cover" class="dropify" data-height="150" required />
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Program <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Deskripsi Singkat (Tampil di Card)</label>
                                    <textarea name="short_description" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-label fw-semibold">Konten Lengkap</label>
                                <textarea name="content" class="summernote"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-red px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // DataTables
            $('#programTable').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
                "columnDefs": [ { "orderable": false, "targets": [0, 4] } ]
            });

            // Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag & drop cover / klik di sini',
                    'replace': 'Drag & drop / klik untuk mengganti',
                    'remove': 'Hapus',
                    'error': 'Terjadi kesalahan.'
                }
            });

            // Summernote
            $('.summernote').summernote({
                placeholder: 'Tuliskan deskripsi lengkap, kurikulum, atau fasilitas program di sini...',
                tabsize: 2,
                height: 250,
                dialogsInBody: true, // WAJIB ada jika Summernote berada di dalam Modal
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endsection
