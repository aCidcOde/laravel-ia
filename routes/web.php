<?php

use App\Livewire\Orders\NewOrderWizard;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $certidoes = auth()->user()
        ->certidoes()
        ->orderByDesc('data_inclusao')
        ->orderByDesc('created_at')
        ->get();

    return view('dashboard', compact('certidoes'));
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('orders/new', NewOrderWizard::class)->name('orders.new');
    Route::get('orders/{order}/payment', function (\App\Models\Order $order) {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('orders.payment', [
            'order' => $order->load(['items.certificateType', 'subject']),
        ]);
    })->name('orders.payment');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
