<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PengingatObat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengingatObatController extends Controller
{
    public function index()
    {
        $pengingatObat = PengingatObat::where('user_id', Auth::id())->get();

        $now = now()->setTimezone('Asia/Jakarta');

        foreach ($pengingatObat as $pengingat) {
            $reminderDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $pengingat->tanggal . ' ' . $pengingat->pukul)
                ->setTimezone('Asia/Jakarta');

            if ($reminderDateTime < $now && $pengingat->status === 'Menunggu') {
                $pengingat->status = 'Terlewatkan';
                $pengingat->save();
            }
        }

        return view('user.pengingat-obat', compact('pengingatObat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat' => 'required|string|max:255',
            'kategori' => 'required|in:Sebelum Makan,Sesudah Makan,Saat Makan',
            'jml_obat' => 'required|integer|min:1',
            'jenis_obat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pukul' => 'required|date_format:H:i',
        ]);

        PengingatObat::create([
            'user_id' => Auth::id(),
            'obat' => $request->obat,
            'jml_obat' => $request->jml_obat,
            'jenis_obat' => $request->jenis_obat,
            'tanggal' => $request->tanggal,
            'pukul' => $request->pukul,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('pengingatObat')->with('success', 'Pengingat obat berhasil ditambahkan.');
    }
    public function destroy($id)
    {
        $pengingatObat = PengingatObat::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$pengingatObat) {
            return redirect()->route('pengingatObat')->with('error', 'Pengingat obat tidak ditemukan.');
        }

        $pengingatObat->delete();

        return redirect()->route('pengingatObat')->with('success', 'Pengingat obat berhasil dihapus.');
    }
    public function updateStatusSudah($id)
    {
        $pengingatObat = PengingatObat::where('id', $id)->where('user_id', Auth::id())->first();

        if ($pengingatObat) {
            $pengingatObat->status = 'Sudah';
            $pengingatObat->save();
        }

        return redirect()->route('pengingatObat')->with('success', 'Status pengingat obat diperbarui menjadi Sudah.');
    }

    public function updateStatusTerlewat($id)
    {
        $pengingatObat = PengingatObat::where('id', $id)->where('user_id', Auth::id())->first();

        if ($pengingatObat) {
            $pengingatObat->status = 'Terlewatkan';
            $pengingatObat->save();
        }

        return redirect()->route('pengingatObat')->with('success', 'Status pengingat obat diperbarui menjadi Terlewat.');
    }
}
