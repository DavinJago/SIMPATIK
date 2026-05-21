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
    
    <div class="absolute top-5 right-5">
        <button onclick="toggleTheme()" 
            class="relative inline-flex h-6 w-25 items-center rounded-full transition-colors duration-300 focus:outline-none bg-gray-300 dark:bg-green-600">
            <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-300 translate-x-1 dark:translate-x-20">
    
            </span>
        </button>
    </div>

    @if ($errors->any())
        <div class="w-full max-w-md mb-4 p-4 bg-red-500 text-white font-semibold rounded-xl shadow-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container p-8 w-full max-w-md h-auto flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mt-2">Register</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Please register to continue</p>
        <form action="{{ route('saveRegister') }}" method="POST" class="flex flex-col items-center justify-center">
            @csrf 
            <input type="text" name="name" class="mt-4 p-2 rounded border font-medium border-3 border-gray-300 dark:border-gray-600" placeholder="Username">
            <input type="email" name="email" class="mt-4 p-2 rounded border font-medium border-3 border-gray-300 dark:border-gray-600" placeholder="Email">
            <input type="password" name="password" class="mt-4 p-2 rounded border font-medium border-3 border-gray-300 dark:border-gray-600" placeholder="Password (min : 6 elemen)">
            <br>
            <button type="submit" class="mt-4 p-2 bg-blue-500 text-white rounded hover:bg-blue-600">Register</button>
        </form>
        <br>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a></p>

    </div>

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