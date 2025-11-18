<?php

use App\Livewire\Orders\NewOrderWizard;
use App\Models\Order as OrderModel;
use App\Models\Wallet;
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
    Route::get('orders/{order}/payment', function (OrderModel $order) {
        abort_unless($order->user_id === auth()->id(), 403);

        $wallet = Wallet::firstOrCreate(
            ['user_id' => auth()->id()],
            ['balance' => 0],
        );

        return view('orders.payment', [
            'order' => $order->load(['items.certificateType', 'subject']),
            'wallet' => $wallet,
        ]);
    })->name('orders.payment');

    Route::post('orders/{order}/payment/wallet', function (OrderModel $order) {
        abort_unless($order->user_id === auth()->id(), 403);

        $wallet = Wallet::firstOrCreate(
            ['user_id' => auth()->id()],
            ['balance' => 0],
        );

        if ($order->status !== 'awaiting_payment') {
            return back()->with('wallet_error', __('Pedido não está aguardando pagamento.'));
        }

        if ($wallet->balance < $order->total_amount) {
            return back()->with('wallet_error', __('Saldo insuficiente para pagar este pedido.'));
        }

        $payment = $order->payments()->create([
            'user_id' => auth()->id(),
            'method' => 'wallet',
            'amount' => $order->total_amount,
            'status' => 'paid',
        ]);

        $wallet->transactions()->create([
            'type' => 'debit',
            'source' => 'order_payment',
            'amount' => $order->total_amount,
            'description' => 'Pagamento do pedido #'.$order->id,
            'related_order_id' => $order->id,
            'related_payment_id' => $payment->id,
        ]);

        $wallet->decrement('balance', $order->total_amount);

        $order->update(['status' => 'paid']);

        return back()->with('wallet_success', __('Pedido pago com saldo.'));
    })->name('orders.payment.wallet');

    Route::get('saldo', function () {
        $wallet = Wallet::firstOrCreate(
            ['user_id' => auth()->id()],
            ['balance' => 0],
        );

        $transactions = $wallet->transactions()
            ->latest()
            ->limit(10)
            ->get();

        return view('wallet.balance', [
            'wallet' => $wallet,
            'transactions' => $transactions,
        ]);
    })->name('wallet.balance');
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
