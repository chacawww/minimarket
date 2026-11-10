<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();

        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rotasi' => 'nullable|in:0,90,180,270',
        ]);

        $data = $request->only([
            'nama_produk',
            'harga',
            'stok',
            'kategori',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->prosesGambar(
                $request->file('gambar'),
                (int) $request->input('rotasi', 0)
            );
        }

        Produk::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rotasi' => 'nullable|in:0,90,180,270',
        ]);

        $data = $request->only([
            'nama_produk',
            'harga',
            'stok',
            'kategori',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarLama = $produk->gambar;

            $data['gambar'] = $this->prosesGambar(
                $request->file('gambar'),
                (int) $request->input('rotasi', 0)
            );

            if ($gambarLama) {
                Storage::disk('public')->delete($gambarLama);
            }
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diubah!');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    private function prosesGambar($file, int $rotasi = 0): string
    {
        $manager = ImageManager::usingDriver(Driver::class);

        $image = $manager->decodeSplFileInfo($file);

        // Resize gambar maksimal 800 x 800 piksel.
        $image->scaleDown(width: 800, height: 800);

        // Crop gambar menjadi persegi 600 x 600 piksel.
        $image->cover(600, 600);

        // Memutar gambar sesuai pilihan.
        if ($rotasi !== 0) {
            $image->rotate($rotasi);
        }

        // Menambahkan watermark.
        $image->text(
            'MINIMARKET',
            20,
            $image->height() - 20,
            function ($font) {
                $font->size(20);
                $font->color('ffffff');
            }
        );

        // Mengubah gambar menjadi format WebP.
        $hasil = $image->encodeUsingFormat(
            Format::WEBP,
            quality: 80
        );

        // Menyimpan gambar hasil manipulasi.
        $namaFile = 'products/' . Str::uuid() . '.webp';

        Storage::disk('public')->put(
            $namaFile,
            (string) $hasil
        );

        return $namaFile;
    }
}
