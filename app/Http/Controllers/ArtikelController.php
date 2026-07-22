<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ArtikelController extends Controller
{
    /**
     * Menampilkan semua artikel.
     */
    public function index()
    {
        $artikels = Artikel::with(['user', 'kategori'])
            ->latest()
            ->get();

        return Inertia::render('Artikel/Index', [
            'artikels' => $artikels
        ]);
    }

    /**
     * Menampilkan form tambah artikel.
     */
    public function create()
    {
        $kategoris = Kategori::all();

        return Inertia::render('Artikel/Create', [
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Menyimpan artikel ke database.
     */
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|max:255',
        'isi' => 'required',
        'kategori_id' => 'required|exists:kategoris,id',
    ]);

    Artikel::create([
        'judul' => $request->judul,
        'slug' => Str::slug($request->judul),
        'isi' => $request->isi,
        'kategori_id' => $request->kategori_id,
        'user_id' => Auth::id(),
        'status' => 'draft',
    ]);

    return redirect()->route('artikel.index')
        ->with('success', 'Artikel berhasil ditambahkan.');
}

    /**
     * Menampilkan detail artikel.
     */
    public function show(Artikel $artikel)
    {
        $artikel->load(['user', 'kategori', 'komentars']);

        return Inertia::render('Artikel/Show', [
            'artikel' => $artikel
        ]);
    }

    /**
     * Menampilkan form edit artikel.
     */
    public function edit(Artikel $artikel)
    {
        $kategoris = Kategori::all();

        return Inertia::render('Artikel/Edit', [
            'artikel' => $artikel,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Update artikel.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $artikel->update([
            'judul' => $request->judul,
            'slug' => \Illuminate\Support\Str::slug($request->judul),
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Hapus artikel.
     */
    public function destroy(Artikel $artikel)
    {
         if ($artikel->user_id != Auth::id()) {
            abort(403);
    }
        $artikel->delete();

        return redirect()->route('artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

}
