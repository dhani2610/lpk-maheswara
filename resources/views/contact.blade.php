@extends('layouts-admin.app')

@section('content')
    <div class="content p-4">
        <h4 class="fw-bold mb-4">Informasi Kontak & Lokasi</h4>

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
            <form action="{{ route('contact.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Telepon / WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-brands fa-whatsapp text-success fs-5"></i></span>
                            <input type="text" name="phone" class="form-control border-start-0"
                                   value="{{ old('phone', $contact->phone) }}"
                                   placeholder="Contoh: 085176745512">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Email Resmi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-envelope text-danger"></i></span>
                            <input type="email" name="email" class="form-control border-start-0"
                                   value="{{ old('email', $contact->email) }}"
                                   placeholder="Contoh: jdevaofficial@gmail.com">
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold">Alamat Kantor Lengkap</label>
                        <textarea name="address" class="form-control" rows="3"
                                  placeholder="Contoh: Jl. Raya Madiun No.1, Jawa Timur">{{ old('address', $contact->address) }}</textarea>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold">Link Embed Google Maps (Iframe)</label>
                        <textarea name="embed_map" class="form-control" rows="5"
                                  placeholder='<iframe src="https://www.google.com/maps/embed?..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'>{{ old('embed_map', $contact->embed_map) }}</textarea>

                        <div class="mt-2 text-muted small bg-light p-3 rounded border">
                            <strong><i class="fa-solid fa-circle-info me-1"></i> Cara mendapatkan kode embed:</strong><br>
                            1. Buka <a href="https://maps.google.com" target="_blank" class="text-danger text-decoration-none fw-semibold">Google Maps</a> dan cari lokasi kantor LPK Maheswara.<br>
                            2. Klik tombol <strong>Bagikan (Share)</strong>.<br>
                            3. Pilih tab <strong>Sematkan Peta (Embed a map)</strong>.<br>
                            4. Klik <strong>Salin HTML (Copy HTML)</strong> dan *paste* kodenya ke kotak di atas.
                        </div>
                    </div>
                </div>

                <hr class="mt-2 mb-4">

                <div class="text-end">
                    <button type="submit" class="btn btn-red px-5 py-2 fw-bold shadow-sm">
                        <i class="fa-solid fa-save me-2"></i> Simpan Kontak
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
