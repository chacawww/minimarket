@extends('layouts.admin')

@section('title', 'Data Produk')

@section('page-title', 'Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Data Produk</h2>
        <p class="text-muted">
            Kelola data produk minimarket.
        </p>
    </div>

    <a href="{{ route('produk.create') }}" class="btn btn-dark">
        + Tambah Produk
    </a>

</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($produks as $produk)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $produk->nama_produk }}
                            </td>

                            <td>
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $produk->stok }}
                            </td>

                            <td>
                                {{ $produk->kategori }}
                            </td>

                            <td>

                                <a href="{{ route('produk.show', $produk->id) }}"
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('produk.edit', $produk->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('produk.destroy', $produk->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data produk.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection