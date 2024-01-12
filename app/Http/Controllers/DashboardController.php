<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashmin');
    }

    public function userDashboard()
    {
        $users = User::all();
        return view('dashboard.dashuser', ['users' => $users]);
    }


    public function bookDashboard()
    {
        $books = Book::all();
        return view('dashboard.dashbook', ['books' => $books]);
    }

    public function reserveDashboard()
    {
        $reservations = Reservation::all();
        return view('dashboard.dashreserve', ['reservations' => $reservations]);
    }

    public function userhome()
{
    $books = Book::paginate(9);
    return view('userhome',compact('books'));
}


    public function back()
    {
        return $this->index();
    }

}
