<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\BookingTransaction;
use App\Models\Ticket;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function booking(Ticket $ticket)
    {
        return view('front.booking', compact('ticket'));
    }

    public function bookingStore(Ticket $ticket, StoreBookingRequest $request)
    {
        $validated = $request->validated();

        $totals = $this->bookingService->calculateTotals($ticket->id, $validated['total_participant']);

        $this->bookingService->storeBookingSession($ticket, $validated, $totals);

        return redirect()->route('front.payment');
    }

    public function payment()
    {
        $data = $this->bookingService->payment();

        if (!$data) {
            return redirect()->route('front.index')->withErrors(['error' => 'Booking data not found.']);
        }

        return view('front.payment', $data);
    }

    public function paymentStore(StorePaymentRequest $request)
    {
        $validated = $request->validated();
        $bookingTransactionId = $this->bookingService->paymentStore($validated);

        if ($bookingTransactionId) {
            return redirect()->route('front.booking-finished', $bookingTransactionId);
        }

        return redirect()->route('front.index')->withErrors(['error' => 'Payment failed. Please try again.']);
    }

    public function bookingFinished(BookingTransaction $bookingTransaction)
    {
        return view('front.booking-finished', compact('bookingTransaction'));
    }

    public function checkBooking()
    {
        return view('front.check-booking');
    }

    public function checkBookingDetails(StoreCheckBookingRequest $request)
    {
        $validated = $request->validated();

        $bookingDetails = $this->bookingService->getBookingDetails($validated);

        if ($bookingDetails) {
            return view('front.check-booking-details', compact('bookingDetails'));
        }

        return redirect()->route('front.check-booking')->withErrors(['error' => 'Transaction not found']);
    }
}
