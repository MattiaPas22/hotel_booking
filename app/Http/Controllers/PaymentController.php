<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Elenco pagamenti
    public function index()
    {
        $payments = Payment::with('booking')->get();
        return view('payments.index', compact('payments'));
    }

    // Form nuovo pagamento (opzionale, se necessario)
    public function create()
    {
        //
    }

    // Salvataggio pagamento
    public function store(Request $request)
    {
        //
    }

    // Visualizza singolo pagamento
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    // Form modifica pagamento
    public function edit(Payment $payment)
    {
        //
    }

    // Aggiornamento pagamento
    public function update(Request $request, Payment $payment)
    {
        //
    }

    // Cancellazione pagamento
    public function destroy(Payment $payment)
    {
        //
    }
}
