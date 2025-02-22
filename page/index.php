<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ruang Dapur</title>
    <!-- Tailwind CSS -->

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="assets/style.css" />
  </head>
  <body>
    <!-- Navbar -->

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div
        class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
      >
        <a
          href=""
          class="flex items-center space-x-3 rtl:space-x-reverse"
        >
          <img src="assets/logo.png" alt="Logo" class="h-8">
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
          
          <a
            href="login.php"
            
            class=" text-orange-700 hover:bg-orange-800   font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-orange-600 dark:hover:bg-orange-700"
          >
            Login
          </a>
          <a
            href="daftar.php"
            class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800"
          >
            Daftar
          </a>
          <button
            data-collapse-toggle="navbar-cta"
            type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-cta"
            aria-expanded="false"
          >
            <span class="sr-only">Open main menu</span>
            <svg
              class="w-5 h-5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 17 14"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15"
              />
            </svg>
          </button>
        </div>
        <div
          class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
          id="navbar-cta"
        >
          <ul
            class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
          >
            <li>
              <a
                href="#"
                class="block py-2 px-3 md:p-0 text-white bg-orange-700 rounded md:bg-transparent md:text-orange-700 md:dark:text-orange-500"
                aria-current="page"
                >Home</a
              >
            </li>
            <li>
              <a
                href="katalog.php"
                class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-orange-700 md:dark:hover:text-orange-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                >Recipe</a
              >
            </li>
            <li>
              <a
                href="artikel.php"
                class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-orange-700 md:dark:hover:text-orange-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                >Artikel</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="bg-yellow-200">
      <div class="px-10 md:px-32 flex justify-start items-center h-full">
        <div class="title">
          <h1 class="font-bold text-4xl">Masak makin menyenangkan</h1>
          <p>Temukan dan bagikan resep lezat untuk masakan harianmu</p>
          <div class="button mt-6">
            <a href="katalog.php" class="btn-1">Telusuri</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Content -->
    <div class="bg-yellow-50 px-10 md:px-32 pb-32">
        <div class="content-1 flex flex-wrap items-center justify-between pt-32 md:flex md:flex-nowrap gap-10">
            <div class="">
              <h1 class="text-2xl font-semibold">
                Cari dan temukan resep dari RuangDapur!
              </h1>
              <p class="description mt-2 text-wrap w-full">
                Melalui fitur pencarian di RuangDapur, kamu dapat menemukan resep
                berdasarkan bahan atau nama hidangan, memastikan kamu selalu
                mendapat inspirasi masak setiap harinya.
              </p>
              <div class="button mt-6 text-white font-semibold">
                <a href="katalog.html" class="btn-1">Telusuri</a>
              </div>
            </div>
            <img src="assets/resep.png" alt="" />
          </div>
          

      <div
        class="content-2 flex flex-wrap items-center justify-between mt-32  md:flex md:flex-nowrap gap-10"
      >
        <img src="assets/share.png" alt="" />
        <div class="">
          <h1 class="text-2xl font-semibold">Bagikan resepmu!</h1>
          <p class="description mt-2 text-wrap	w-full">
            Melalui fitur pencarian di RuangDapur, kamu dapat menemukan resep
            berdasarkan bahan atau nama hidangan, memastikan kamu selalu
            mendapat inspirasi masak setiap harinya.
          </p>
          <div class="button mt-6 text-white font-semibold">
            <a href="addresep.html" class="btn-1">Mulai</a>
          </div>
        </div>
      </div>

      <div
        class="content-3 flex flex-wrap items-center justify-between mt-32  md:flex md:flex-nowrap gap-10"
      >
        <div class="">
          <h1 class="text-2xl font-semibold">Telusuri Artikel Tips Memasak</h1>
          <p class="description mt-2 text-wrap	w-full">
            Melalui fitur pencarian di RuangDapur, kamu dapat menemukan resep
            berdasarkan bahan atau nama hidangan, memastikan kamu selalu
            mendapat inspirasi masak setiap harinya.
          </p>
          <div class="button mt-6 text-white font-semibold">
            <a href="artikel.html" class="btn-1">Telusuri</a>
          </div>
        </div>
        <img src="assets/artikel.png" alt="" />
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#ED9455] text-white">
      <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
            <a href="home.html" class="flex items-center">
              <img
                src="assets/logo.png"
                class="h-8 me-3"
                alt="FlowBite Logo"
              />
            </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
            <div>
              <h2 class="mb-6 text-sm font-semibold text-white uppercase">
                Menu
              </h2>
              <ul class="text-white font-medium">
                <li class="mb-4">
                  <a href="https://flowbite.com/" class="hover:underline"
                    >Home</a
                  >
                </li>
                <li class="mb-4">
                  <a href="https://tailwindcss.com/" class="hover:underline"
                    >Recipe</a
                  >
                </li>
                <li>
                  <a href="https://tailwindcss.com/" class="hover:underline"
                    >Artikel</a
                  >
                </li>
              </ul>
            </div>
            <div>
              <h2 class="mb-6 text-sm font-semibold text-white uppercase">
                Follow us
              </h2>
              <ul class="text-white font-medium">
                <li class="mb-4">
                  <a
                    href="https://github.com/themesberg/flowbite"
                    class="hover:underline"
                    >Github</a
                  >
                </li>
                <li>
                  <a
                    href="https://discord.gg/4eeurUVvTy"
                    class="hover:underline"
                    >Discord</a
                  >
                </li>
              </ul>
            </div>
            <div>
              <h2 class="mb-6 text-sm font-semibold text-white uppercase">
                Legal
              </h2>
              <ul class="text-white font-medium">
                <li class="mb-4">
                  <a href="#" class="hover:underline">Privacy Policy</a>
                </li>
                <li>
                  <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-white sm:text-center"
            >© 2023
            <a href="https://flowbite.com/" class="hover:underline"
              >RuangDapur</a
            >. All Rights Reserved.
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0">
            <a href="#" class="text-white hover:text-gray-900">
              <svg
                class="w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 8 19"
              >
                <path
                  fill-rule="evenodd"
                  d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                  clip-rule="evenodd"
                />
              </svg>
              <span class="sr-only">Facebook page</span>
            </a>
            <a href="#" class="text-white hover:text-gray-900">
              <svg
                class="w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 21 16"
              >
                <path
                  d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"
                />
              </svg>
              <span class="sr-only">Discord community</span>
            </a>
            <a href="#" class="text-white hover:text-gray-900">
              <svg
                class="w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 17"
              >
                <path
                  fill-rule="evenodd"
                  d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                  clip-rule="evenodd"
                />
              </svg>
              <span class="sr-only">Twitter page</span>
            </a>
            <a href="#" class="text-white hover:text-gray-900">
              <svg
                class="w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                  clip-rule="evenodd"
                />
              </svg>
              <span class="sr-only">GitHub account</span>
            </a>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
