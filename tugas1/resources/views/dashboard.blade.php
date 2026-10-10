<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/dashboard.css')
</head>
<body>
    <div class="shell">
        <header>
            <h1>Dashboard</h1>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </header>

        <main>
            <p class="greeting">Selamat datang, {{ auth()->user()->nama_lengkap }}.</p>
            <p class="note">Halaman ini hanya bisa dibuka setelah login.</p>

            <dl>
                <dt>Nama lengkap</dt>
                <dd>{{ auth()->user()->nama_lengkap }}</dd>
                <dt>Username</dt>
                <dd>{{ auth()->user()->username }}</dd>
            </dl>
        </main>
    </div>
</body>
</html>
