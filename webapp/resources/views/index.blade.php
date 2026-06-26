<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>PLECO - Membersihkan perairan tenang</title>

    <meta name="description"
        content="PLECO hadir sebagai solusi autonomous untuk memantau dan membersihkan sampah di perairan secara lebih cerdas.">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white text-gray-900 font-sans antialiased">

    <main class="max-w-[1440px] mx-auto">
        <x-navbar.index></x-navbar.index>
        
        <div class="px-6 lg:px-8 py-10 space-y-24">
            <!-- Hero Section -->
            <section id="home" class="relative">
                <div
                    class="bg-gradient-to-br from-blue-800 to-indigo-800 rounded-3xl pt-16 pb-16 md:pb-12 px-6 md:px-12 text-center flex flex-col items-center shadow-xl h-auto md:h-170">
                    <!-- Badge -->
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#DDDBFF] text-[#736FB7] border border-white/10 backdrop-blur-sm mb-1">
                        <img src="{{ asset('images/bot.png') }}" alt="Bot Icon" class="h-4 w-4">
                        PLECO
                    </span>

                    <!-- Heading -->
                    <h1
                        class="text-3xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white max-w-4xl leading-tight mb-6">
                        Teknologi Cerdas untuk <br class="hidden md:block">Perairan yang Lebih Bersih
                    </h1>

                    <!-- Subheading -->
                    <p class="text-white text-sm md:text-base lg:text-lg max-w-2xl leading-relaxed mb-6 md:mb-12">
                        PLECO hadir sebagai solusi autonomous untuk membantu <br class="hidden md:block"> membersihkan
                        sampah di perairan secara lebih cerdas.
                    </p>


                </div>
                <!-- Video/Thumbnail -->
                <div
                    class="relative w-full max-w-6xl aspect-[16/9] rounded-[30px] overflow-hidden shadow-2xl group border-4 border-indigo-500/20 mx-auto -mt-20 md:-mt-80">
                    <img src="{{ asset('images/hero_video_thumbnail.png') }}" alt="Plastik terapung di perairan"
                        class="w-full h-full object-cover">
                    <!-- Play Button Overlay -->
                    <div class="absolute inset-0 bg-black/10 flex items-center justify-center">
                        <button
                            class="w-16 h-16 md:w-20 md:h-20 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center shadow-2xl cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                            <x-lucide-play class="size-7 fill-current" />
                        </button>
                    </div>
                </div>
            </section>

            <!-- Benefit Section -->
            <section id="benefit" class="space-y-12 pt-6">
                <!-- Badge & Header -->
                <div class="space-y-4">
                    <span
                        class="inline-flex items-center px-4 py-1.5 rounded-full text-[14px] font-semibold tracking-wider bg-[#DDDBFF] text-[#736FB7] border border-indigo-100">
                        Keuntungan produk
                    </span>
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight md:max-w-md">
                            Solusi untuk Perairan yang Lebih Bersih
                        </h2>
                        <p class="text-black text-sm md:text-lg leading-relaxed md:max-w-xl">
                            Dirancang untuk membantu mengurangi sampah kecil di perairan tenang, robot autonomous yang
                            mampu
                            bekerja secara otomatis dan real-time
                        </p>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Feature 1 -->
                    <div
                        class="bg-indigo-50 hover:bg-indigo-50/50 transition-colors rounded-2xl p-6  flex flex-col justify-between h-full">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 mb-6">
                                <img src="{{ asset('images/navigation.png') }}" alt="Auto Icon" class="h-6 w-6">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Otomatisasi</h3>
                            <p class="text-xs text-black leading-relaxed">
                                PLECO membantu proses pengumpulan sampah perairan secara otomatis untuk mengurangi
                                ketergantungan pada pembersihan manual.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="bg-indigo-50 hover:bg-indigo-50/50 transition-colors rounded-2xl p-6  flex flex-col justify-between h-full">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 mb-6">
                                <img src="{{ asset('images/square-activity.png') }}" alt="Auto Icon" class="h-6 w-6">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Monitoring</h3>
                            <p class="text-xs text-black leading-relaxed">
                                Sistem berbasis IoT memungkinkan kondisi robot dan aktivitas pembersihan dipantau secara
                                real-time melalui website.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="bg-indigo-50 hover:bg-indigo-50/50 transition-colors rounded-2xl p-6  flex flex-col justify-between h-full">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 mb-6">
                                <img src="{{ asset('images/sparkles.png') }}" alt="Auto Icon" class="h-6 w-6">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Efisiensi</h3>
                            <p class="text-xs text-black leading-relaxed">
                                Dirancang untuk membantu proses pembersihan perairan menjadi lebih cepat, modern, dan
                                efisien di area perairan dangkal.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div
                        class="bg-indigo-50 hover:bg-indigo-50/50 transition-colors rounded-2xl p-6   flex flex-col justify-between h-full">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 mb-6">
                                <img src="{{ asset('images/bubbles.png') }}" alt="Auto Icon" class="h-6 w-6">
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Keberlanjutan</h3>
                            <p class="text-xs text-black leading-relaxed">
                                PLECO mendukung terciptanya lingkungan perairan yang lebih bersih dan berkelanjutan
                                melalui
                                teknologi ramah lingkungan.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- About/Mission Section -->
            <section id="tentang" class="space-y-8 pt-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    PLECO dan Misi di Baliknya
                </h2>

                <!-- Logo Card -->
                <div>
                    <img src="{{ asset('images/Background_Pleco.jpeg') }}"
                        class="w-full h-[300px] md:h-[600px] object-cover rounded-3xl shadow-lg" alt="PLECO Logo">
                </div>

                <!-- About Description -->
                <div class="flex flex-col md:flex-row gap-6 pt-4">
                    <div class="flex-shrink-0 ">
                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-[14px] font-semibold tracking-wider bg-[#DDDBFF] text-[#736FB7] border border-indigo-100">
                            Tentang PLECO
                        </span>
                    </div>
                    <p class="text-black text-md md:text-[24px]  md:max-w-4xl  md:ml-auto">
                        PLECO adalah autonomous ocean trash collector berbasis IoT yang dirancang untuk membantu menjaga
                        kebersihan daerah perairan tenang secara lebih modern dan efisien. Dibangun dengan teknologi
                        navigasi otomatis, object detection, dan monitoring real-time, PLECO mampu mendeteksi serta
                        mengumpulkan sampah terapung secara mandiri. Lebih dari sekadar robot pembersih, PLECO hadir
                        sebagai
                        langkah menuju lingkungan perairan yang lebih bersih, cerdas, dan berkelanjutan.
                    </p>
                </div>
            </section>

            <!-- Team Section -->
            <section id="tim" class="space-y-12 pt-6">
                <!-- Badge & Header -->
                <div class="space-y-4">
                    <span
                        class="inline-flex items-center px-4 py-1.5 rounded-full text-[14px] font-semibold tracking-wider bg-[#DDDBFF] text-[#736FB7] border border-indigo-100">
                        Tim Kami
                    </span>
                    <div class="flex justify-between items-end">
                        <div class="space-y-2">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                                Temui Tim Pengembang PLECO
                            </h2>
                            <p class="text-black text-sm md:text-lg leading-relaxed max-w-xl">
                                Sekelompok mahasiswa yang menggabungkan teknologi, inovasi, dan kepedulian lingkungan
                                dalam
                                pengembangan PLECO.
                            </p>
                        </div>
                        <!-- Slider Arrows -->
                        <div class="flex space-x-3">
                            <button id="team-prev"
                                class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center shadow transition-colors cursor-pointer"
                                aria-label="Previous">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button id="team-next"
                                class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center shadow transition-colors cursor-pointer"
                                aria-label="Next">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Team Slider Outer Container -->
                <div class="relative overflow-hidden w-full px-1 py-4">
                    <div id="team-slider" class="flex gap-8 transition-transform duration-500 ease-out">
                        <!-- Member 1 -->
                        <div
                            class="w-full md:w-[calc((100%-64px)/3)] flex-shrink-0 bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
                            <div class="h-96 w-full overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/juan.png') }}" alt="Juan Immanuel Tinambuan"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900">Juan Immanuel Tinambuan</h3>
                                <p class="text-xs text-gray-400 mt-1 font-medium">Project Manager & Hardware Engineer
                                </p>
                            </div>
                        </div>

                        <!-- Member 2 -->
                        <div
                            class="w-full md:w-[calc((100%-64px)/3)] flex-shrink-0 bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
                            <div class="h-96 w-full overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/wasyn.png') }}" alt="Wasyn Sulaiman Siregar"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900">Wasyn Sulaiman Siregar</h3>
                                <p class="text-xs text-gray-400 mt-1 font-medium">System Architect & Hardware Engineer
                                </p>
                            </div>
                        </div>

                        <!-- Member 3 -->
                        <div
                            class="w-full md:w-[calc((100%-64px)/3)] flex-shrink-0 bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
                            <div class="h-96 w-full overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/aidil.png') }}" alt="Muhammad Aidil Jupriadi Saleh"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900">Muhammad Aidil Jupriadi Saleh</h3>
                                <p class="text-xs text-gray-400 mt-1 font-medium">UI/UX Designer & Hardware Engineer</p>
                            </div>
                        </div>

                        <!-- Member 4 -->
                        <div
                            class="w-full md:w-[calc((100%-64px)/3)] flex-shrink-0 bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
                            <div class="h-96 w-full overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/farhan.png') }}" alt="Farhan Maulana"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900">Farhan Maulana</h3>
                                <p class="text-xs text-gray-400 mt-1 font-medium">Software Engineer</p>
                            </div>
                        </div>

                        <!-- Member 5 -->
                        <div
                            class="w-full md:w-[calc((100%-64px)/3)] flex-shrink-0 bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
                            <div class="h-96 w-full overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/siti.png') }}" alt="Siti Rahma"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900">Siti Rahma</h3>
                                <p class="text-xs text-gray-400 mt-1 font-medium">UI/UX Designer</p>
                            </div>
                        </div>

                        <!-- Member 6 -->
                        <div
                            class="w-full md:w-[calc((100%-64px)/3)] flex-shrink-0 bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
                            <div class="h-96 w-full overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/dodi.png') }}" alt="Dodi Hermawan"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900">Dodi Hermawan</h3>
                                <p class="text-xs text-gray-400 mt-1 font-medium">Embedded Systems Engineer</p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- Footer Card -->
            <footer
                class="bg-gradient-to-br from-blue-800 to-indigo-800 rounded-3xl py-12 px-6 md:px-12 text-white shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                    <!-- Left Details -->
                    <div class="space-y-4 max-w-md">
                        <img src="{{ asset('images/logo_text.png') }}" class="h-8 brightness-0 invert object-contain"
                            alt="PLECO Logo">
                        <p class="text-white text-xs md:text-sm leading-relaxed">
                            Mengintegrasikan teknologi autonomous dan IoT untuk menciptakan solusi pembersihan sampah di
                            perairan yang cerdas, efisien, dan berkelanjutan.
                        </p>
                    </div>
                    <!-- Social Links -->
                    <div class="flex space-x-3">
                        <!-- YouTube -->
                        <a href="#"
                            class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors"
                            aria-label="YouTube">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.516 0-9.387.507a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.969.503 5.837a3.003 3.003 0 0 0 2.11 2.11c1.871.507 9.387.507 9.387.507s7.517 0 9.389-.507a3.002 3.002 0 0 0 2.11-2.11C24 15.969 24 12 24 12s0-3.969-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#"
                            class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors"
                            aria-label="Instagram">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                            </svg>
                        </a>
                        <!-- GitHub / Git -->
                        <a href="#"
                            class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors"
                            aria-label="GitHub">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                        <!-- LinkedIn -->
                        <a href="#"
                            class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors"
                            aria-label="LinkedIn">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <hr class="border-white/10 my-8">

                <div class="flex justify-between items-center text-xs text-indigo-200">
                    <p>© 2026 PLECO Seluruh hak cipta dilindungi.</p>
                </div>
            </footer>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slider = document.getElementById('team-slider');
            const prevBtn = document.getElementById('team-prev');
            const nextBtn = document.getElementById('team-next');

            if (!slider || !prevBtn || !nextBtn) return;

            let currentIndex = 0;

            function getVisibleCardsCount() {
                return window.innerWidth >= 768 ? 3 : 1;
            }

            function getCardWidth() {
                const cards = slider.children;
                if (cards.length === 0) return 0;
                return cards[0].offsetWidth;
            }

            function updateSlider() {
                const visibleCards = getVisibleCardsCount();
                const cards = slider.children;
                const maxIndex = cards.length - visibleCards;

                if (currentIndex < 0) currentIndex = 0;
                if (currentIndex > maxIndex) currentIndex = maxIndex;

                const cardWidth = getCardWidth();
                const gap = 32;
                const offset = currentIndex * (cardWidth + gap);

                slider.style.transform = `translateX(-${offset}px)`;

                prevBtn.disabled = currentIndex === 0;
                nextBtn.disabled = currentIndex === maxIndex;

                prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
                prevBtn.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';
                nextBtn.style.opacity = currentIndex === maxIndex ? '0.5' : '1';
                nextBtn.style.cursor = currentIndex === maxIndex ? 'not-allowed' : 'pointer';
            }

            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateSlider();
                }
            });

            nextBtn.addEventListener('click', () => {
                const visibleCards = getVisibleCardsCount();
                const maxIndex = slider.children.length - visibleCards;
                if (currentIndex < maxIndex) {
                    currentIndex++;
                    updateSlider();
                }
            });

            window.addEventListener('resize', () => {
                updateSlider();
            });

            setTimeout(updateSlider, 150);
        });
    </script>
</body>

</html>