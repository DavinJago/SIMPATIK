<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyek Pertama</title>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black dark:bg-slate-900 dark:text-white transition-colors duration-300 flex flex-col items-center justify-center min-h-screen">

    @if(session('success'))
    <div id="successAlert" 
        class="mb-4 px-6 py-3 bg-green-500 text-white font-semibold rounded-xl shadow-lg transition-all duration-500 transform opacity-100 scale-100">
        {{ session('success') }}
    </div>
    @endif

    @if(session('success'))
    <script>
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            if (alert) {
                alert.classList.add('opacity-0', 'scale-95', '-translate-y-2');
                
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }
        }, 1000);
    </script>
    @endif
    
    <div class="absolute top-5 right-5">
        <button onclick="toggleTheme()" 
            class="relative inline-flex h-6 w-25 items-center rounded-full transition-colors duration-300 focus:outline-none bg-gray-300 dark:bg-green-600">
            <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-300 translate-x-1 dark:translate-x-20">
    
            </span>
        </button>
    </div>

    @error('loginError')
        <div class="w-full max-w-md mb-4 p-4 text-center bg-red-500 text-white font-semibold rounded-xl shadow-lg">
            {{ $message }}
        </div>
    @enderror

    <form action="{{ route ('login.check') }}" method="POST">
        @csrf
        <div class="container p-8 w-full max-w-[90%] md:max-w-md h-auto flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
            <h1 class="text-4xl font-bold mt-2">Login</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Please login to continue</p>
            <input type="email" name="email" class="mt-4 p-2 rounded border font-medium border-3 border-gray-300 dark:border-gray-600" placeholder="Email">
            <input type="password" name="password" class="mt-4 p-2 rounded border font-medium border-3 border-gray-300 dark:border-gray-600" placeholder="Password">
            <button type="submit" class="mt-4 p-2 bg-blue-500 text-white rounded hover:bg-blue-600">Login</button>
            <br>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a></p>
            
        </div>
    </form>

    <script>
        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
</body>
</html>