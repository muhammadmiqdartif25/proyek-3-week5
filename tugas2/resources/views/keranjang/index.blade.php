<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>Keranjang Belanja</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="mx-auto w-full max-w-3xl px-4 py-8">
        <header class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
            <h1 class="text-xl font-semibold">Keranjang Belanja</h1>
            <a class="link -my-3 py-3 text-sm" href="{{ route('barang.index') }}">Lanjut belanja</a>
        </header>

        @if (session('success'))
            <p class="alert alert-success mt-6" role="status">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="alert alert-error mt-6" role="alert">{{ session('error') }}</p>
        @endif

        <main class="mt-8">
            @if ($items->isEmpty())
                <p class="text-sm text-muted">Keranjang masih kosong.</p>
                <a class="btn btn-primary mt-4" href="{{ route('barang.index') }}">Lihat daftar barang</a>
            @else
                <h2 class="sr-only">Isi keranjang</h2>

                <ul class="divide-y divide-line border-y border-line">
                    @foreach ($items as $item)
                        <li class="flex flex-wrap items-center justify-between gap-x-6 gap-y-3 py-4">
                            <div>
                                <h3 class="font-medium">{{ $item->barang->nama }}</h3>
                                <p class="text-sm text-muted">
                                    Rp{{ number_format($item->barang->harga, 0, ',', '.') }} x {{ $item->qty }} =
                                    <span class="font-medium text-ink">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </p>
                            </div>

                            <div class="flex items-center gap-2">
                                <form action="{{ route('keranjang.update', $item->barang) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-quiet btn-sm" type="submit" name="delta" value="-1"
                                            aria-label="Kurangi jumlah {{ $item->barang->nama }}">&minus;</button>
                                </form>

                                <p class="field text-sm">
                                    <span class="sr-only">Jumlah {{ $item->barang->nama }}</span>
                                    {{ $item->qty }}
                                </p>

                                <form action="{{ route('keranjang.update', $item->barang) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-quiet btn-sm" type="submit" name="delta" value="1"
                                            aria-label="Tambah jumlah {{ $item->barang->nama }}"
                                            @disabled($item->qty >= $item->barang->stok)>+</button>
                                </form>

                                <form class="ml-2" action="{{ route('keranjang.destroy', $item->barang) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-quiet" type="submit"
                                            aria-label="Hapus {{ $item->barang->nama }} dari keranjang">Hapus</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                    <p class="text-lg">
                        Total <span class="font-semibold">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                    <form action="{{ route('keranjang.clear') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-quiet" type="submit">Kosongkan keranjang</button>
                    </form>
                </div>
            @endif
        </main>
    </div>
</body>
</html>
