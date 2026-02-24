@extends('layouts-admin.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 14px !important;
            margin: 5px 0 0 0;
        }

        .dropify-wrapper .dropify-message span.file-icon {
            font-size: 24px !important;
        }

        .dataTables_wrapper .row {
            margin-bottom: 15px;
        }

        div.dataTables_filter input {
            border-radius: 6px;
            border: 1px solid #dee2e6;
            padding: 4px 10px;
        }
    </style>
@endsection

@section('content')
    <div class="content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Galeri Kegiatan</h4>
            <button class="btn btn-red" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fa-solid fa-upload me-1"></i> Upload Foto
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
                <table id="galleryTable" class="table table-hover align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Judul Kegiatan (Title)</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $gallery->image) }}" width="100"
                                        class="rounded shadow-sm" alt="Gallery Image"
                                        style="object-fit: cover; height: 60px;">
                                </td>
                                <td class="fw-bold">{{ $gallery->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($gallery->date)->translatedFormat('d F Y') }}</td>
                                <td>
                                    @if ($gallery->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $gallery->id }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $gallery->id }}">
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

    {{-- AREA MODAL EDIT & DELETE --}}
    @foreach ($galleries as $gallery)
        <div class="modal fade" id="editModal{{ $gallery->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-light">
                            <h5 class="modal-title fw-bold">Edit Foto Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload Foto</label>
                                <input type="file" name="image" class="dropify"
                                    data-default-file="{{ asset('storage/' . $gallery->image) }}" data-height="150" />
                                <small class="text-muted" style="font-size: 12px;">Biarkan kosong jika tidak mengubah
                                    foto.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul Kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ $gallery->title }}"
                                    required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control" value="{{ $gallery->date }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="is_active" class="form-select">
                                        <option value="1" {{ $gallery->is_active == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $gallery->is_active == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
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

        <div class="modal fade" id="deleteModal{{ $gallery->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content border-0">
                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title fw-bold">Hapus Foto?</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center py-4">
                            <i class="fa-solid fa-triangle-exclamation text-warning fs-1 mb-3"></i>
                            <p class="mb-0">Yakin ingin menghapus foto kegiatan
                                <br><strong>"{{ $gallery->title }}"</strong>?</p>
                            <p class="text-muted small mt-1">File gambar juga akan dihapus dari server.</p>
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

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold">Upload Foto Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Foto <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="dropify" data-height="150" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Kegiatan <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control"
                                placeholder="Contoh: Pelatihan Web Developer Batch 1" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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

    <script>
        $(document).ready(function() {
            // DataTables
            $('#galleryTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 4]
                }]
            });

            // Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag & drop foto / klik di sini',
                    'replace': 'Drag & drop / klik untuk mengganti foto',
                    'remove': 'Hapus',
                    'error': 'Terjadi kesalahan.'
                }
            });
        });
    </script>
@endsection
