<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PatientController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes/web.php

Route::get('/patient/dashboard', [PatientController::class, 'PatientDashboard'])->name('patient.dashboard');
Route::get('/patient/dashboard/appointments', [PatientController::class, 'PatientAppointments'])->name('patient.dashboard.appointments');

//doctor profile//
Route::get('/doctor/profile', [DoctorController::class, 'profile'])->name('doctor.profile');
Route::put('/doctor/update/{id}', 'DoctorController@update')->name('doctor.update');


Route::get('/doctor/profile', [DoctorController::class, 'profile'])->name('doctor.profile');
Route::get('/doctor/edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');
Route::put('/doctor/update/{id}', [DoctorController::class, 'update'])->name('doctor.update');


// routes/web.php



Route::get('/mail', [PublicController::class, 'mail'])->name('mail');
Route::get('/', [PublicController::class, 'index'])->name('index');
Route::get('/dashboard', [PublicController::class, 'dashboard'])->middleware('auth')->name('dashboard.index');
Route::get('/news/{blog}', [PublicController::class, 'blogDetails'])->name('blog.details');
Route::get('/News', [PublicController::class, 'blogs'])->name('blogs.all');

Route::Post('/prescription', [PrescriptionController::class, 'store'])->name('prescription.store');
Route::Post('/prescription/update/{prescription}', [PrescriptionController::class, 'update'])->name('prescription.update');
Route::prefix('/appointment')->middleware('auth')->group(function () {
    Route::get('/edit/{id}', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::get('/prescribe/{id}', [AppointmentController::class, 'prescribe'])->name('appointment.prescribe');
    Route::get('/print/{id}', [AppointmentController::class, 'print'])->name('appointment.print');
    Route::get('/create', [AppointmentController::class, 'create'])->name('appointment.create');

    Route::post('/create', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/index', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/active/{appointment}', [AppointmentController::class, 'active'])->name('appointments.active');
    Route::get('/inactive/{appointment}', [AppointmentController::class, 'inactive'])->name('appointments.inactive');
});
Route::prefix('/profile')->middleware('auth')->group(function () {
    Route::get('/profile/complete-profile', [ProfileController::class, 'incomplete'])->name('profile.incomplete');
    Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
});

Route::prefix('/profile')->middleware('auth', 'profile.check')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');

    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/get-available-dates', [AvailabilityController::class, 'getAvailableDates']);

Route::prefix('/dashboard')->middleware('auth', 'admin')->group(function () {


    Route::prefix('services')->group(function () {
        // Hero-Routes
        Route::get('/', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/{service}', [ServiceController::class, 'show'])->name('services.show');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/{service}', [ServiceController::class, 'update'])->name('services.update');
        Route::get('/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
        Route::get('/active/{service}', [ServiceController::class, 'active'])->name('services.active');
        Route::get('/inactive/{service}', [ServiceController::class, 'inactive'])->name('services.inactive');
    });

    Route::prefix('testimonials')->group(function () {
        // Testimonial-Routes
        Route::get('/', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
        Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::get('/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
        Route::get('/active/{testimonial}', [TestimonialController::class, 'active'])->name('testimonials.active');
        Route::get('/inactive/{testimonial}', [TestimonialController::class, 'inactive'])->name('testimonials.inactive');
    });

    Route::prefix('faqs')->group(function () {
        // Faq-Routes
        Route::get('/', [FaqController::class, 'index'])->name('faqs.index');
        Route::get('/create', [FaqController::class, 'create'])->name('faqs.create');
        Route::post('/', [FaqController::class, 'store'])->name('faqs.store');
        Route::get('/{faq}', [FaqController::class, 'show'])->name('faqs.show');
        Route::get('/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
        Route::put('/{faq}', [FaqController::class, 'update'])->name('faqs.update');
        Route::get('/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
        Route::get('/active/{faq}', [FaqController::class, 'active'])->name('faqs.active');
        Route::get('/inactive/{faq}', [FaqController::class, 'inactive'])->name('faqs.inactive');
    });



    Route::prefix('blogs')->group(function () {
        // Blog-Routes
        Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/{blog}', [BlogController::class, 'show'])->name('blogs.show');
        Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::get('/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
        Route::get('/active/{blog}', [BlogController::class, 'active'])->name('blogs.active');
        Route::get('/inactive/{blog}', [BlogController::class, 'inactive'])->name('blogs.inactive');
    });

    Route::prefix('heros')->group(function () {
        // hero-Routes
        Route::get('/', [HeroController::class, 'index'])->name('heros.index');
        Route::get('/create', [HeroController::class, 'create'])->name('heros.create');
        Route::post('/', [HeroController::class, 'store'])->name('heros.store');
        Route::get('/{hero}', [HeroController::class, 'show'])->name('heros.show');
        Route::get('/{hero}/edit', [HeroController::class, 'edit'])->name('heros.edit');
        Route::put('/{hero}', [HeroController::class, 'update'])->name('heros.update');
        Route::get('/{hero}', [HeroController::class, 'destroy'])->name('heros.destroy');
        Route::get('/active/{hero}', [HeroController::class, 'active'])->name('heros.active');
        Route::get('/inactive/{hero}', [HeroController::class, 'inactive'])->name('heros.inactive');
    });

    Route::prefix('locations')->group(function () {
        //Location-Routes
        Route::get('/', [LocationController::class, 'index'])->name('locations.index');
        Route::get('/create', [LocationController::class, 'create'])->name('locations.create');
        Route::post('/', [LocationController::class, 'store'])->name('locations.store');
        Route::get('/{location}', [LocationController::class, 'show'])->name('locations.show');
        Route::get('/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
        Route::put('/{location}', [LocationController::class, 'update'])->name('locations.update');
        Route::delete('/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');
        Route::get('/active/{location}', [LocationController::class, 'active'])->name('locations.active');
        Route::get('/inactive/{location}', [LocationController::class, 'inactive'])->name('locations.inactive');
    });


    Route::prefix('availabilities')->group(function () {
        // Location-Routes
        Route::get('/', [AvailabilityController::class, 'index'])->name('availabilities.index');
        Route::get('/create', [AvailabilityController::class, 'create'])->name('availabilities.create');
        Route::post('/', [AvailabilityController::class, 'store'])->name('availabilities.store');
        Route::get('/{availability}', [AvailabilityController::class, 'show'])->name('availabilities.show');
        Route::get('/{availability}/edit', [AvailabilityController::class, 'edit'])->name('availabilities.edit');
        Route::put('/{availability}', [AvailabilityController::class, 'update'])->name('availabilities.update');
        Route::delete('/{availability}', [AvailabilityController::class, 'destroy'])->name('availabilities.destroy');
        Route::get('/active/{availability}', [AvailabilityController::class, 'active'])->name('availabilities.active');
        Route::get('/inactive/{availability}', [AvailabilityController::class, 'inactive'])->name('availabilities.inactive');
    });


    Route::prefix('content')->group(function () {
        // Hero-Routes
        Route::get('/about/{content}/edit', [ContentController::class, 'editAbout'])->name('about.edit');
        Route::put('/about/{content}', [ContentController::class, 'updateAbout'])->name('about.update');

        Route::get('/general/{content}/edit', [ContentController::class, 'editGeneral'])->name('general.edit');
        Route::put('/general/{content}', [ContentController::class, 'updateGeneral'])->name('general.update');
        Route::get('/contact/{content}/edit', [ContentController::class, 'editContact'])->name('contact.edit');
        Route::put('/contact/{content}', [ContentController::class, 'updateContact'])->name('contact.update');
        Route::get('/social/{content}/edit', [ContentController::class, 'editSocial'])->name('social.edit');
        Route::put('/social/{content}', [ContentController::class, 'updateSocial'])->name('social.update');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// for patient
Route::get('/chat-with-doctor', [App\Http\Controllers\ChatController::class, 'index'])->name('chat_with_doctor');
Route::post('/chat', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');

// for doctor chat
Route::get('/get-patient-chat', [App\Http\Controllers\ChatController::class, 'getPatientChat'])->name('get.patient.chat');
Route::get('/chat-with-patient/{id}', [App\Http\Controllers\ChatController::class, 'chat_with_patient'])->name('chat_with_patient');
Route::post('/patient-chat', [App\Http\Controllers\ChatController::class, 'patientChatStore'])->name('patient.chat.store');


 
Route::get('/without-reload-chat-with-doctor', [App\Http\Controllers\ChatController::class, 'withoutReloadChatWithDoctor'])->name('withoutReloadChatWithDoctor');
Route::get('/without-reload-chat-with-patient/{id}', [App\Http\Controllers\ChatController::class, 'withoutReloadChatWithPatient'])->name('withoutReloadChatWithP');

Route::get('test_routes', function(){
    dd(123);
});