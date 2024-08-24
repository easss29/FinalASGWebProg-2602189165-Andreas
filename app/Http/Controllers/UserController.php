<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $currentUserID = Auth::user()->id;
    // dd($currentUserID);

    // Ambil istilah pencarian dari permintaan
    $searchTerm = $request->input('search');
    $selectedGender = $request->input('gender');

    // Subquery untuk mendapatkan daftar ID pengguna yang mengirimkan permintaan pertemanan ke pengguna saat ini
    $sentRequestUserIDs = DB::table('friend_requests')
        ->where('sender_id', '=', $currentUserID)
        ->pluck('receiver_id');

    // Subquery untuk mendapatkan daftar ID pengguna yang sudah berteman dengan pengguna saat ini
    $friendUserIDs = DB::table('friends')
        ->where('user_id', '=', $currentUserID)
        ->pluck('friend_id');

    // Cek apakah pengguna baru belum ada request atau teman
    if ($sentRequestUserIDs->isEmpty() && $friendUserIDs->isEmpty()) {
        // Tampilkan semua pengguna kecuali pengguna saat ini
        $dataUser = User::where('id', '!=', $currentUserID)
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })->get();
    } else {
        // Query untuk mendapatkan pengguna yang belum mengirim permintaan teman dan bukan teman pengguna saat ini
        $dataUser = User::whereNotIn('id', $sentRequestUserIDs)
            ->whereNotIn('id', $friendUserIDs)
            ->where('id', '!=', $currentUserID)
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->when($selectedGender, function ($query, $selectedGender) {
                return $query->where('gender', $selectedGender);
            })
            ->get();
    }

    // dd($dataUser);

    return view('home', compact('dataUser'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
