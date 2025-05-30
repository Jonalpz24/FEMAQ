<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Botones Login/Register -->
    @if (Route::has('login'))
        <div class="absolute top-6 right-6 z-50 flex gap-4 text-sm">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-white/80 dark:bg-zinc-900 border rounded text-black dark:text-white hover:shadow">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-white/80 dark:bg-zinc-900 border rounded text-black dark:text-white hover:shadow">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white/80 dark:bg-zinc-900 border rounded text-black dark:text-white hover:shadow">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <!-- Carrusel -->
    <div x-data="{ current: 0, images: [
        'https://mx.dewalt.global/LAG/PRODUCT/IMAGES/HIRES/D25980-B3/D25980_1.jpg?resize=530x530',
        'https://www.hilti.com.mx/medias/sys_master/images/h9a/hd6/9644035768350.jpg',
        'https://mx.dewalt.global/LAG/PRODUCT/IMAGES/HIRES/D25733K-B3/D25733K_K1.jpg?resize=530x530'
    ] }"
         x-init="setInterval(() => current = (current + 1) % images.length, 5000)"
         class="absolute inset-0 z-0">

        <template x-for="(img, index) in images" :key="index">
            <div x-show="current === index" x-transition
                class="absolute inset-0 w-full h-full bg-center bg-cover"
                :style="'background-image: url(' + img + ')'">
            </div>
        </template>
    </div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40 z-10"></div>

</body>
</html>
