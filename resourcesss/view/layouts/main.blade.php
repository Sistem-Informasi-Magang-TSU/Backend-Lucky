<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'TSU Internship')</title>

  {{-- Vite (Tailwind + app.js) --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-slate-800">
  {{-- Navbar --}}
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">TSU</div>
          <span class="font-semibold text-lg">Tiga Serangkai University</span>
        </a>

        <nav class="hidden md:flex items-center gap-6">
          <a href="#" class="text-slate-600 hover:text-slate-900">Beranda</a>
          <a href="#" class="text-slate-600 hover:text-slate-900">Tentang</a>
          <a href="#" class="text-slate-600 hover:text-slate-900">Lowongan</a>
          <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Masuk / Daftar</a>
        </nav>

        {{-- mobile menu button --}}
        <div class="md:hidden">
          <button id="mobileMenuBtn" class="p-2 rounded-md focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  {{-- Main content --}}
  <main class="min-h-[70vh]">
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="bg-white border-t mt-12">
    <div class="max-w-7xl mx-auto px-4 py-8 text-sm text-slate-600">
      <div class="flex flex-col md:flex-row justify-between gap-4">
        <div>© {{ date('Y') }} Tiga Serangkai University. All rights reserved.</div>
        <div>Contact: it@tsu.ac.id · Phone: (021) 0000-0000</div>
      </div>
    </div>
  </footer>

</body>
</html>
