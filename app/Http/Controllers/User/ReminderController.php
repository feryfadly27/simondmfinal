<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', auth()->id())->get(); // Filter berdasarkan user login
        return view('user.reminder', compact('reminders'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'reminder_date' => 'required|date',
            'reminder_time' => 'required'
        ]);

        Reminder::create([
            'title' => $request->title,
            'reminder_date' => $request->reminder_date,
            'reminder_time' => $request->reminder_time,
            'user_id' => auth()->id() // Simpan user_id
        ]);

        return redirect()->back()->with('success', 'Reminder berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $reminder = Reminder::where('id', $id)->where('user_id', auth()->id())->first();
    
        if (!$reminder) {
            return redirect()->back()->with('error', 'Reminder tidak ditemukan atau Anda tidak memiliki akses.');
        }
    
        $reminder->delete();
        return redirect()->back()->with('success', 'Reminder berhasil dihapus!');
    }

}



