<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Church Finder</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">
        @auth
        <nav class="bg-blue-600 text-white p-4 flex justify-between shadow-md">
            <a href="/admin/dashboard" class="font-bold text-xl">Church Finder Admin</a>
            <div class="flex gap-4 items-center">
                <a href="/admin/churches" class="hover:underline">Churches</a>
                <form action="/admin/logout" method="POST" class="inline">
                    @csrf <button type="submit" class="hover:underline">Logout</button>
                </form>
            </div>
        </nav>
        @endauth
        <main class="flex-grow p-6">
            @if(session('success')) <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div> @endif
            @if($errors->any()) <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><ul>@foreach($errors->all() as $e) <li>{{$e}}</li> @endforeach</ul></div> @endif
            @yield('content')
        </main>
    </div>
</body>
</html>