<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('dashboard.dashreserve', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'reservation_date' => 'required',
            'return_date' => 'required',
            'is_returned' => 'required',
        ]);

        Reservation::create([
            'user_id' => $request->input('user_id'),
            'book_id' => $request->input('book_id'),
            'reservation_date' => $request->input('reservation_date'),
            'return_date' => $request->input('return_date'),
            'is_returned' => $request->input('is_returned'),
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
{
    return view('reservations.edit', compact('reservation'));
}


public function update(Request $request, Reservation $reservation)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_id' => 'required|exists:books,id',
        'reservation_date' => 'required|date',
        'return_date' => 'required|date',
        'is_returned' => 'required|boolean',
    ]);

    $reservation->update([
        'user_id' => $request->input('user_id'),
        'book_id' => $request->input('book_id'),
        'reservation_date' => $request->input('reservation_date'),
        'return_date' => $request->input('return_date'),
        'is_returned' => $request->input('is_returned'),
    ]);

    return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully');
}



    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully');
    }
}
