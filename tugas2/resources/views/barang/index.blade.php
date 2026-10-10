<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>Toko Alat Tulis</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="mx-auto w-full max-w-3xl px-4 py-8">
        <header class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
            <h1 class="text-xl font-semibold">Toko Alat Tulis</h1>
            <a class="link -my-3 py-3 text-sm" href="{{ route('keranjang.index') }}">
                Keranjang ({{ $count }})
            </a>
        </header>

        @if (session('success'))
            <p class="alert alert-success mt-6" role="status">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="alert alert-error mt-6" role="alert">{{ session('error') }}</p>
        @endif

        <main class="mt-8">
            <h2 class="text-sm font-medium text-muted">Daftar Barang</h2>

            @if ($barangs->isEmpty())
                <p class="mt-3 text-sm text-muted">Belum ada barang yang dijual.</p>
            @else
                <ul class="mt-3 divide-y divide-line border-y border-line">
                    @foreach ($barangs as $barang)
                        <li class="flex flex-wrap items-center justify-between gap-4 py-4">
                            <div>
                                <h3 class="font-medium">{{ $barang->nama }}</h3>
                                <p class="text-sm text-muted">
                                    Rp{{ number_format($barang->harga, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex items-center gap-4">
                                <p class="text-sm text-muted">Stok {{ $barang->stok }}</p>
                                <form action="{{ route('keranjang.store', $barang) }}" method="post">
                                    @csrf
                                    <button class="btn btn-primary" type="submit" @disabled($barang->stok < 1)>
                                        Tambah ke keranjang
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </main>
    </div>
</body>
</html>
