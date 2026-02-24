<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Models\Slider;
use App\Models\About;
use App\Models\Program;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Setting;

Route::get('/', function () {
    $sliders = Slider::where('is_active', 1)->get();
    $about = About::first() ?? new About();
    $programs = Program::latest()->get(); // Ambil 6 program terbaru
    $galleries = Gallery::where('is_active', 1)->orderBy('date', 'desc')->get();
    $contact = Contact::first() ?? new Contact();
    $setting = Setting::first() ?? new Setting();

    return view('welcome', compact('sliders', 'about', 'programs', 'galleries', 'contact', 'setting'));
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Slider
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
    Route::put('/slider/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::put('/about', [AboutController::class, 'update'])->name('about.update');

    Route::get('/program', [ProgramController::class, 'index'])->name('program.index');
    Route::post('/program', [ProgramController::class, 'store'])->name('program.store');
    Route::put('/program/{id}', [ProgramController::class, 'update'])->name('program.update');
    Route::delete('/program/{id}', [ProgramController::class, 'destroy'])->name('program.destroy');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::put('/contact', [ContactController::class, 'update'])->name('contact.update');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');
});

require __DIR__.'/auth.php';
