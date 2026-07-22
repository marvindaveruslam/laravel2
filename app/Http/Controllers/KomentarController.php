<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class KomentarController extends Controller  // <-- Tambahkan { di sini
{
    public function index()
    {
        return Inertia::render('Komentar/Index');
    }
    /**
     * Simpan komentar baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'artikel_id' => 'required|exists:artikels,id',
            'isi' => 'required'
        ]);

        Komentar::create([
            'artikel_id' => $request->artikel_id,
            'user_id' => Auth::id(),
            'isi' => $request->isi,
        ]);

        return redirect()->back()
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Hapus komentar.
     */
    public function destroy(Komentar $komentar)
    {
        if ($komentar->user_id != Auth::id()) {
            abort(403);
        }

        $komentar->delete();

        return redirect()->back()
            ->with('success', 'Komentar berhasil dihapus.');
    }

}
