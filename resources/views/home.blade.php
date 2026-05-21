<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
  href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
  rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-neutral-800">
  <button style="background-image: url('/images/simpatik.png');" class="bg-cover bg-center w-25 h-25 absolute top-0 left-0 hover:scale-110 transition duration-300 cursor-pointer border-none"></button>
  <button style="background-image: url('/images/Settings.png');" class="bg-cover bg-center w-12 h-12 absolute top-4 right-4 hover:scale-110 transition duration-300 cursor-pointer border-none"></button>
  <div class="flex justify-center items-center mt-10">
    <a href="{{ route('login')}}" class="font-[Inter] font-bold hover:bg-sky-700 text-white text-3xl bg-neutral-600 p-5 rounded-3xl w-fit">
      Dashboard Jadwal Modul Bank Soal
    </a>
  </div> 
  <div class="font-[Inter] text-center font-bold text-white text-5xl mt-15">
    Selamat Datang di SIMPATIK<br>
    <span class="font-medium text-2xl">Sistem Manajemen Praktikum Terpadu. <div class="break-normal">Membantu Efisiensi
        Asisten Praktikum dalam sehari-hari.</div></span>
  </div><br>
  <div style="background-image: url('/images/a10.png');" class="bg-cover bg-center w-200 h-100 mx-auto rounded-xl flex items-center justify-center"></div>

  <div class="flex justify-center gap-16 font-[Inter] text-white font-bold text-3xl mt-5 text-center">
  <div>
    <p class="font-bold">Anggota</p>
    <p class="text-4xl font-bold counter" data-target="26">0</p>
  </div>

  <div>
    <p class="font-bold">Partners</p>
    <p class="text-4xl font-bold counter" data-target="6">0</p>
  </div>

  <div>
    <p class="font-bold">Dosen</p>
    <p class="text-4xl font-bold counter" data-target="50">0</p>
  </div>
</div>

  <script>
const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
  const target = +counter.getAttribute('data-target');
  let count = 0;

  const update = () => {
    const increment = target / 100;

    if (count < target) {
      count += increment;
      counter.innerText = Math.ceil(count);
      setTimeout(update, 20);
    } else {
      counter.innerText = target;
    }
  };

  update();
});
</script>
</body>

</html>