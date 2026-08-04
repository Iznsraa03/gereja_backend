<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Church Finder</title>
    <!-- 👱‍♀️ ponytail: no npm/vite needed for standard styling, just load from CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Fira Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-indigo-600 selection:text-white flex h-screen overflow-hidden">
    
    @auth
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col h-full shadow-lg shadow-black/20 z-10 flex-shrink-0">
        <div class="p-6 border-b border-slate-800">
            <a href="/admin/dashboard" class="font-bold text-xl tracking-tight text-white flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-indigo-500 animate-pulse"></span>
                Admin Panel
            </a>
        </div>
        
        <nav class="flex-grow p-4 space-y-1 overflow-y-auto">
            <a href="/admin/dashboard" class="block px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-white rounded-md transition-colors font-medium">Dashboard</a>
            <a href="/admin/churches" class="block px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-white rounded-md transition-colors font-medium">Churches</a>
            <a href="/admin/categories" class="block px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-white rounded-md transition-colors font-medium">Categories</a>
            <a href="/admin/facilities" class="block px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-white rounded-md transition-colors font-medium">Facilities</a>
            <a href="/admin/activities" class="block px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-white rounded-md transition-colors font-medium">Activities</a>
            <a href="/admin/announcements" class="block px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-white rounded-md transition-colors font-medium">Announcements</a>
            <a href="/admin/articles" class="block px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-white rounded-md transition-colors font-medium">Articles</a>
        </nav>
        
        <div class="p-4 border-t border-slate-800">
            <form action="/admin/logout" method="POST">
                @csrf 
                <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-md transition-colors font-medium">
                    Logout
                </button>
            </form>
        </div>
    </aside>
    @endauth
    
    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        <main class="flex-1 overflow-y-auto p-6 md:p-8 w-full">
            @if(session('success')) 
                <div class="bg-emerald-900/30 border border-emerald-500/30 text-emerald-400 p-4 rounded-lg mb-6 shadow-sm">
                    {{ session('success') }}
                </div> 
            @endif
            @if($errors->any()) 
                <div class="bg-red-900/30 border border-red-500/30 text-red-400 p-4 rounded-lg mb-6 shadow-sm">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $e) <li>{{$e}}</li> @endforeach
                    </ul>
                </div> 
            @endif
            
            <div class="w-full max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>