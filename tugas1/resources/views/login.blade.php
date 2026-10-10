<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/login.css')
</head>
<body>
    <main>
        <h1>Login</h1>
        <p class="subtitle">Masuk untuk membuka dashboard</p>

        @error('username')
            <p class="error" id="username-error" role="alert">{{ $message }}</p>
        @enderror

        <form action="/login" method="POST">
            @csrf
            <div class="field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required
                       autocomplete="username" autocapitalize="none" spellcheck="false"
                       @error('username') aria-invalid="true" aria-describedby="username-error" @enderror>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required
                       autocomplete="current-password">
            </div>
            <button type="submit">Masuk</button>
        </form>
    </main>
</body>
</html>
