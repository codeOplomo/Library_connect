<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Book;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

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

    


    public function storeViaAjax(Request $request)
    {
        $validatedData = $request->validate([
            'reservedBooks' => 'required|array',
            'reservedBooks.*.bookId' => 'required|exists:books,id',
            'reservedBooks.*.description' => 'required|string',
            'reservedBooks.*.quantity' => 'required|integer|min:1',
            'returnDate' => 'required|date',
        ]);

        foreach ($validatedData['reservedBooks'] as $reservationData) {
            $book = Book::findOrFail($reservationData['bookId']);
            if ($book->available_copies < $reservationData['quantity']) {
                return response()->json(['status' => false, 'message' => 'Not enough copies available']);
            }

            $reservation = new Reservation([
                'description' => $reservationData['description'],
                'reservation_date' => now(),
                'return_date' => $validatedData['returnDate'],
                'is_returned' => false,
                'user_id' => auth()->id(),
                'book_id' => $reservationData['bookId'],
            ]);

            $reservation->save();
            $book->decrement('available_copies', $reservationData['quantity']);
        }

        return response()->json(['status' => true, 'message' => 'Reservation successful']);
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
// public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'reservedBooks' => 'required|array',
    //         'reservedBooks.*.bookId' => 'required|exists:books,id',
    //         'reservedBooks.*.description' => 'required|string',
    //         'reservedBooks.*.quantity' => 'required|integer|min:1',
    //         'returnDate' => 'required|date',
    //     ]);

    //     foreach ($data['reservedBooks'] as $reservationData) {
    //         $reservation = new Reservation([
    //             'description' => $reservationData['description'],
    //             'reservation_date' => now(),
    //             'return_date' => $data['returnDate'],
    //             'is_returned' => false,
    //             'user_id' => auth()->user()->id, // Assuming you are using authentication
    //             'book_id' => $reservationData['bookId'],
    //         ]);

    //         $reservation->save();

    //         // Decrement available copies in the books table
    //         $book = Book::find($reservationData['bookId']);
    //         $book->decrement('available_copies', $reservationData['quantity']);
    //     }

    //     return response()->json(['status' => true]);
    // }