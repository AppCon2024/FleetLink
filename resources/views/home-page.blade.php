<!DOCTYPE html>
 <html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleetLink</title>
    <meta name="description" content="Get started with a free landing page built with Tailwind CSS and the Flowbite Blocks system.">
    <link href="./output.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
@import 'node_modules/flowbite/dist/flowbite.min.css';
    </style>
<body>
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-blue-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a class="flex items-center">
                <img src="{{ asset('images/Fleet_Face.png') }}" alt="Your Logo" style="width: 40px; height: 40px;">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">FleetLink</span>
                </a>
                <div class="flex items-center lg:order-2">
                    <!-- <a href="#" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</a> -->

                    <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col ml-20 mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">Home</a>
                        </li>

                        <li>
                            <a href="#services" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Services</a>

                        </li>
                        <li>
                            <a href="#team" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Team</a>
                        </li>
                        <li>
                            <a href="#aboutus" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">About Us</a>
                        </li>
                        <li>
                            <a href="#refcontact" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">References and Contacts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="bg-white dark:bg--900">
        <div class="grid py-8 px-4 mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="place-self-center mr-auto lg:col-span-7">
                <h1 class="mb-4 max-w-2xl text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl dark:text-blue">Fleet on Sight, Keeps Crime Out of Sight</h1>
                <p class="mb-6 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-black-400">North Caloocan Police Fleet Management System.</p>
                <a class="inline-flex justify-center items-center py-3 px-5 mr-3 text-base font-medium text-center text-black rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Get started
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <a href="{{ route('login') }}" class="text-white font-bold hover:text-black-900 dark:hover:text-gray-300 rounded-lg inline-block px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-blue-800 dark:hover:bg-gray-700">
                    Login
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="{{ asset('images/car.png') }}" alt="Your Logo"  style="width: 250px; height: 230px; margin-left:50px;">
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-blue-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <h2 class="mb-8 text-3xl font-extrabold tracking-tight leading-tight text-center text-gray-900 lg:mb-16 dark:text-white md:text-4xl">You’ll be in good hands</h2>
            <div class="grid grid-cols-2 gap-8 text-gray-500 sm:gap-12 md:grid-cols-3 lg:grid-cols-6 dark:text-gray-400">
                <a href="#" class="flex justify-center items-center">
                <img src="{{ asset('images/shield.png') }}" alt="Image" style="width: 50px; height: 50px; /* Add any additional styles here */">
                </a>
                <a href="#" class="flex justify-center items-center">
                <img src="{{ asset('images/hat.png') }}" alt="Image" style="width: 50px; height: 50px; /* Add any additional styles here */">
                </a>
                <a href="#" class="flex justify-center items-center">
                <img src="{{ asset('images/comm.png') }}" alt="Image" style="width: 50px; height: 50px; /* Add any additional styles here */">
                </a>

                <a href="#" class="flex justify-center items-center">
                <img src="{{ asset('images/eye.png') }}" alt="Image" style="width: 50px; height: 50px; /* Add any additional styles here */">
                </a>
                <a href="#" class="flex justify-center items-center">
                <img src="{{ asset('images/map.png') }}" alt="Image" style="width: 50px; height: 50px; /* Add any additional styles here */">
                </a>
                <a href="#" class="flex justify-center items-center">
                <img src="{{ asset('images/marker.png') }}" alt="Image" style="width: 50px; height: 50px; /* Add any additional styles here */">
                </a>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-800">
        <div id="services" class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mb-8 max-w-screen-md lg:mb-16">
                <h2 class="mb-4 text-4xl font-extrabold text-gray-900 dark:text-white">Designed for Police Motorpool Agencies</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at FleetLink we focus on policing where technology and innovation can provide long-term value and drive police force.</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                    <img src="{{ asset('images/track.gif') }}" alt="Tracking Icon" class="w-5 h-5 text-primary-600 lg:w-100 lg:h-30 dark:text-primary-300">
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Tracking</h3>
                    <p class="text-gray-500 dark:text-gray-400">Wondering where is your vehicles, keep your Fleet monitored with realtime vehicle tracking.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                    <img src="{{ asset('images/uac.gif') }}" alt="Tracking Icon" class="w-20 h-20 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">User Access Control</h3>
                    <p class="text-gray-500 dark:text-gray-400">Protect your organization, with User Access Control that lets you provide specific privilege within your team.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                    <img src="{{ asset('images/automate.gif') }}" alt="Tracking Icon" class="w-20 h-20 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Process Automation</h3>
                    <p class="text-gray-500 dark:text-gray-400">Autofill forms, manage all of your records with ease with an easy to use record controls. </p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                    <img src="{{ asset('images/reserve.gif') }}" alt="Tracking Icon" class="w-20 h-20 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Reservations</h3>
                    <p class="text-gray-500 dark:text-gray-400">Let your team reserve a vehicle with just a tap on our auto generated QR Code, promoting ease and convenience than before.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                    <img src="{{ asset('images/maintenance.gif') }}" alt="Tracking Icon" class="w-20 h-20 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Maintenance</h3>
                    <p class="text-gray-500 dark:text-gray-400">Just let us know when and how often your vehicle must be maintained, we'll remind it to you.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                    <img src="{{ asset('images/chat.gif') }}" alt="Tracking Icon" class="w-20 h-20 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Communication</h3>
                    <p class="text-gray-500 dark:text-gray-400">Our built-in communication services lets you close the gap between you and your team.</p>
                </div>
            </div>
        </div>
      </section>

      <section id="team" class="bg-white dark:bg-blue-900">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl font-extrabold text-gray-900 dark:text-white">There's no need to reinvent the wheel.</h2>
                <p class="mb-4">We are Developers, Designers, Innovators and Problem Solvers. Despite our size, we are able to deliver your needs a solution. </p>
                <p>We value the balance between simplicity with functionality. Whether you require a quick fix or a technical solution, we're equipped to meet your demands with efficiency and precision. With us, you can expect solutions tailored to your needs.</p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
           <img src="{{ asset('images/Dev1.jpg') }}" alt="office content 1" class="w-full rounded-lg">
           <img src="{{ asset('images/Dev2.jpg') }}" alt="office content 2" class="mt-4 w-full rounded-lg lg:mt-10">


            </div>
        </div>
    </section>

    <section id="aboutus" class="bg-gray-50 dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="max-w-screen-lg text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">Leveraging innovation and convenience</h2>
                <p class="mb-4 font-light">Track vehicle across the fleet through an easy, and innovative platform, so your team have richer context of rapidly respond to, incidents, and commands.</p>
                <p class="mb-4 font-medium">Deliver great service experiences - without the complexity of traditional solutions. Accelerate operational task, save your time more.</p>
                <a href="#" class="inline-flex items-center font-medium text-primary-600 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-700">
                    Back to Top
                    <svg class="ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
        </div>
      </section>

      <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl font-extrabold leading-tight text-gray-900 dark:text-white">What are you waiting for?</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Join Us Now.</p>
                <a class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Here at FleetLink</a>
            </div>
        </div>
    </section>

    <footer id="refcontact" class="p-4 bg-gray-50 sm:p-6 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a class="flex items-center">
                    <img src="{{ asset('images/Fleet_Face.png') }}" alt="Your Logo" style="width: 40px; height: 40px;">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">FleetLink</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                                <a href="https://flowbite.com" class="hover:underline">Flowbite</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                            </li>
                        </br>
                            <li>
                                <a href="https://www.flaticon.com/" class="hover:underline">Flaticon</a>
                            </li>
                        </br>
                            <li>
                                <a href="https://www.freepik.com/" class="hover:underline">Freepik</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                            <a href="mailto:ncpdfms@fleetlink.online" class="hover:underline">Email</a>

                            </li>
                            <li>
                                <a href="https://github.com/SakMaestro05" class="hover:underline">GitHub</a>
                            </li>
                        </br>
                            <li>
                                <a href="https://www.linkedin.com/in/sak-maestro-b79560233/" class="hover:underline">LinkedIn</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
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
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com" class="hover:underline">FleetLink</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                <a href="mailto:ncpdfms@fleetlink.online" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                       <img src="{{ asset('images/gmail.png') }}" alt="Gmail Icon" class="w-5 h-5" />
                </a>
                    <a href="https://github.com/SakMaestro05" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                       <img src="{{ asset('images/github.png') }}" alt="Gmail Icon" class="w-5 h-5" />
                    </a>
                    <a href="https://www.linkedin.com/in/sak-maestro-b79560233/" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <img src="{{ asset('images/linkedin.png') }}" alt="Gmail Icon" class="w-5 h-5" />
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>

    <script>
    // Smooth scrolling
    document.querySelector('a[href="#services"]').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('#services').scrollIntoView({
            behavior: 'smooth'
        });
    });

    document.querySelector('a[href="#team"]').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('#team').scrollIntoView({
            behavior: 'smooth'
        });
    });

    document.querySelector('a[href="#aboutus"]').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('#aboutus').scrollIntoView({
            behavior: 'smooth'
        });
    });

    document.querySelector('a[href="#refcontact"]').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('#refcontact').scrollIntoView({
            behavior: 'smooth'
        });
    });
     </script>




</body>
</html>
