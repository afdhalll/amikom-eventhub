<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

```
<script src="https://cdn.tailwindcss.com"></script>
```

</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

```
<div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-md">

    <h1 class="text-3xl font-bold text-center mb-2">
        Login Admin
    </h1>

    <p class="text-center text-slate-500 mb-6">
        AmikomEventHub
    </p>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Email
            </label>

            <input
                type="email"
                name="email"
                required
                class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-6">
            <label class="block mb-2 font-semibold">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <button
            type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-bold transition">

            Login

        </button>

    </form>

</div>
```

</body>
</html>
