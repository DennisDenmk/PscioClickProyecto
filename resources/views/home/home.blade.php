<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayJu Life - Salud en Movimiento | Fisioterapia</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#2d6a4f',
                        'primary-dark': '#1b5e20',
                        'primary-light': '#4caf50',
                        'teal': '#0f4c75',
                        'teal-dark': '#0d3a5f',
                        'green-light': '#81c784',
                        'accent': '#00d4aa',
                        'accent-pink': '#ff6b9d',
                        'primarycolor-logo': '#0b5d63' // <- color del logo agregado aquí
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(45, 106, 79, 0.3);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 40px rgba(45, 106, 79, 0.6);
                transform: scale(1.05);
            }
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes slide-in-left {
            from { transform: translateX(-100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slide-in-right {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes bounce-in {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes color-wave {
            0%, 100% { background: linear-gradient(45deg, #2d6a4f, #0f4c75); }
            33% { background: linear-gradient(45deg, #0f4c75, #00d4aa); }
            66% { background: linear-gradient(45deg, #00d4aa, #2d6a4f); }
        }

        @keyframes floating-shapes {
            0%, 100% { transform: translateY(0px) translateX(0px) rotate(0deg); }
            25% { transform: translateY(-30px) translateX(10px) rotate(90deg); }
            50% { transform: translateY(-20px) translateX(-15px) rotate(180deg); }
            75% { transform: translateY(-40px) translateX(5px) rotate(270deg); }
        }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .animate-gradient-shift {
            background: linear-gradient(-45deg, #2d6a4f, #1b5e20, #0f4c75, #00d4aa);
            background-size: 400% 400%;
            animation: gradient-shift 6s ease infinite;
        }
        .animate-slide-in-left { animation: slide-in-left 0.8s ease-out; }
        .animate-slide-in-right { animation: slide-in-right 0.8s ease-out; }
        .animate-bounce-in { animation: bounce-in 0.8s ease-out; }
        .animate-color-wave { animation: color-wave 8s ease-in-out infinite; }
        .animate-floating-shapes { animation: floating-shapes 12s ease-in-out infinite; }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .card-hover:hover::before {
            left: 100%;
        }

        .card-hover:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(45, 106, 79, 0.2);
        }

        .btn-magnetic {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-magnetic::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            transition: width 0.3s ease;
        }

        .btn-magnetic:hover::before {
            width: 100%;
        }

        .btn-magnetic:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.3);
        }

        .floating-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: floating-shapes 15s ease-in-out infinite;
        }

        .text-gradient {
            background: linear-gradient(45deg, #2d6a4f, #00d4aa, #0f4c75);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-shift 4s ease infinite;
            background-size: 300% 300%;
        }

        .section-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            height: auto !important;
            min-height: 0 !important;
        }

        .section-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .parallax-bg {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-white overflow-x-hidden">

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="floating-element w-64 h-64 bg-gradient-to-br from-primary to-accent top-10 left-10" style="animation-delay: 0s;"></div>
        <div class="floating-element w-32 h-32 bg-gradient-to-br from-accent to-accent-pink top-1/2 right-20" style="animation-delay: 2s;"></div>
        <div class="floating-element w-48 h-48 bg-gradient-to-br from-teal to-primary bottom-20 left-1/4" style="animation-delay: 4s;"></div>
        <div class="floating-element w-20 h-20 bg-gradient-to-br from-accent-pink to-accent top-1/4 right-1/3" style="animation-delay: 6s;"></div>
    </div>

    <!-- HEADER -->
<header class="bg-white/80 backdrop-blur-xl shadow-lg border-b border-gray-200 sticky top-0 z-50 transition-all duration-300 rounded-b-3xl">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

      <!-- LOGO + NOMBRE -->
      <div class="flex items-center gap-4 group cursor-pointer">
        <div class="shrink-0">
          <x-application-logo class="h-10 w-10 rounded-full border border-primary p-1 shadow-md" />
        </div>
        <div class="leading-tight">
            <h1 class="text-2xl font-extrabold text-primarycolor-logo">DayJu Life</h1>
          <p class="text-xs text-gray-500 font-medium group-hover:text-primary transition duration-300">Salud en Movimiento</p>
        </div>
      </div>

      <!-- NAVEGACIÓN -->
      <nav class="hidden lg:flex gap-6 items-center">
        <a href="#inicio" class="text-gray-700 hover:text-primary transition font-medium">Inicio</a>
        <a href="#servicios" class="text-gray-700 hover:text-primary transition font-medium">Servicios</a>
        <a href="#nosotros" class="text-gray-700 hover:text-primary transition font-medium">Nosotros</a>
        <a href="#contacto" class="text-gray-700 hover:text-primary transition font-medium">Contacto</a>
      </nav>


      <!-- BOTÓN SISTEMA -->
      <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-2 px-5 py-2 rounded-full bg-primarycolor-logo text-white font-semibold shadow-md hover:shadow-xl transition hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5l6 6m0 0l-6 6m6-6H4.5" />
        </svg>
        Sistema
      </a>




      <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-full hover:bg-gray-100 transition shadow-sm">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <!-- MENÚ MÓVIL DESPLEGABLE MODERNO -->
    <div id="mobile-menu" class="lg:hidden max-h-0 overflow-hidden transition-all duration-500 bg-white/90 backdrop-blur-xl border-t border-gray-200 shadow-lg rounded-b-2xl">
      <div class="px-6 py-8 flex flex-col items-center space-y-5 text-center">

        <!-- Menú Items -->
        <a href="#inicio" class="flex items-center gap-3 text-gray-800 hover:text-primary font-medium text-lg transition-transform hover:translate-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75M4.5 10.5v8.25h15V10.5" />
          </svg>
          Inicio
        </a>
        <a href="#servicios" class="flex items-center gap-3 text-gray-800 hover:text-primary font-medium text-lg transition-transform hover:translate-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 4.5h7.5m-9 3h10.5M12 12v7.5m4.5-3.75H7.5" />
          </svg>
          Servicios
        </a>
        <a href="#nosotros" class="flex items-center gap-3 text-gray-800 hover:text-primary font-medium text-lg transition-transform hover:translate-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 6.75A2.25 2.25 0 0119.5 9v6a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 15V9a2.25 2.25 0 012.25-2.25h10.5z" />
          </svg>
          Nosotros
        </a>
        <a href="#contacto" class="flex items-center gap-3 text-gray-800 hover:text-primary font-medium text-lg transition-transform hover:translate-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6.75L12 13.5l9.75-6.75M2.25 6.75v10.5a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25V6.75" />
          </svg>
          Contacto
        </a>

        <!-- Botón sistema -->
        <a href="{{ route('login') }}" class="mt-6 w-full max-w-xs px-6 py-3 rounded-full bg-primarycolor-logo text-white font-bold shadow-lg hover:shadow-xl transition hover:scale-105 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5l6 6m0 0l-6 6m6-6H4.5" />
            </svg>
            Sistema
          </a>


      </div>
    </div>
  </header>


    <!-- Hero Section -->
<section id="inicio" class="relative overflow-hidden min-h-screen flex items-center justify-center py-24">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://centromedicoporsalud.com/wp-content/uploads/2024/12/esp-terapia-y-rehabilitacion.jpg');">
      <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-teal/80 to-accent/90 animate-gradient-shift"></div>
    </div>

    <!-- Floating Shapes -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-green-400 to-accent rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-floating-shapes"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-br from-teal to-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-floating-shapes" style="animation-delay: 3s;"></div>

    <!-- Main Content -->
    <div class="relative z-10 max-w-6xl px-6 text-white text-center">
      <div class="space-y-6 section-reveal">
        <span class="inline-block bg-white/20 backdrop-blur-sm px-5 py-2 rounded-full text-sm font-semibold animate-bounce-in tracking-wide">
          ✨ Atención Profesional 24/7
        </span>

        <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold leading-tight tracking-tight">
          Salud en <span class="text-green-300 animate-pulse">Movimiento</span>
        </h1>

        <p class="text-lg sm:text-xl text-green-100 font-light max-w-3xl mx-auto leading-relaxed">
          Servicios especializados en fisioterapia y enfermería.<br class="hidden sm:block">
          Profesionales certificados para tu bienestar y recuperación en casa.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4 pt-6">
            <a href="#contacto" class="bg-white text-primary px-8 py-4 rounded-full font-semibold shadow-lg hover:shadow-xl transition hover:scale-105 btn-magnetic group">
              <span class="group-hover:scale-110 transition-transform duration-300 inline-block">📞 Solicitar Servicio</span>
            </a>
            <a href="#nosotros" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold backdrop-blur-sm hover:scale-105 transition btn-magnetic group">
              <span class="group-hover:scale-110 transition-transform duration-300 inline-block">📋 Conocer Más</span>
            </a>
          </div>
      </div>
    </div>
  </section>


    <!-- Servicios -->
    <section id="servicios" class="py-20 bg-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
          <!-- Título -->
          <div class="text-center mb-16 section-reveal">
            <h2 class="text-3xl font-bold text-gradient mb-4">Nuestros Servicios</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
              Potenciamos tu bienestar con atención personalizada y tratamientos profesionales 💪
            </p>
          </div>

          <!-- Servicios -->
          <div class="grid md:grid-cols-2 gap-8">
            <!-- Fisioterapia -->
            <div class="bg-white rounded-2xl p-8 shadow-lg card-hover section-reveal hover:-translate-y-1 hover:shadow-2xl transition duration-300">
              <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mb-6 animate-pulse-glow">
                <span class="text-white text-2xl">🧘‍♀️</span>
              </div>
              <h3 class="text-2xl font-extrabold text-gray-800 mb-4 tracking-tight">Fisioterapia</h3>
              <p class="text-gray-600 mb-4">
                Recupera tu movilidad y mejora tu calidad de vida con tratamientos personalizados.
              </p>
              <ul class="text-gray-700 space-y-3 text-base">
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-primary to-accent rounded-full mr-3"></span><strong>Terapia Física </strong> : Ejercicios específicos y seguimiento profesional.</li>
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-primary to-accent rounded-full mr-3"></span><strong>Masaje Terapéutico </strong> : Alivio del dolor y relajación muscular.</li>
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-primary to-accent rounded-full mr-3"></span><strong>Rehabilitación Geriátrica</strong> : Cuidado integral para adultos mayores.</li>
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-primary to-accent rounded-full mr-3"></span><strong>Valoración Funcional</strong> : Diagnóstico para planes efectivos.</li>
              </ul>
            </div>

            <!-- Enfermería -->
            <div class="bg-white rounded-2xl p-8 shadow-lg card-hover section-reveal hover:-translate-y-1 hover:shadow-2xl transition duration-300">
              <div class="w-16 h-16 bg-gradient-to-br from-teal to-accent-pink rounded-full flex items-center justify-center mb-6 animate-pulse-glow">
                <span class="text-white text-2xl">🩺</span>
              </div>
              <h3 class="text-2xl font-extrabold text-gray-800 mb-4 tracking-tight">Enfermería</h3>
              <p class="text-gray-600 mb-4">
                Atención confiable y segura con personal altamente capacitado.
              </p>
              <ul class="text-gray-700 space-y-3 text-base">
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-teal to-accent-pink rounded-full mr-3"></span><strong>Signos Vitales</strong> : Monitoreo preciso y constante.</li>
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-teal to-accent-pink rounded-full mr-3"></span><strong>Cuidados Generales</strong> : Asistencia humana y cálida.</li>
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-teal to-accent-pink rounded-full mr-3"></span><strong>Medicamentos</strong> : Administración segura y controlada.</li>
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-teal to-accent-pink rounded-full mr-3"></span><strong>Sueros y Vitaminas</strong> : Rehidratación y energía al instante.</li>
                <li class="flex items-center"><span class="w-2 h-2 bg-gradient-to-r from-teal to-accent-pink rounded-full mr-3"></span><strong>Curación de Heridas </strong> : Tratamientos limpios y eficaces.</li>
              </ul>
            </div>
          </div>
        </div>
      </section>



    <!-- Nosotros -->
    <section id="nosotros" class="py-20 bg-white relative overflow-visible">
        <div class="text-center mb-16 section-reveal">
            <h2 class="text-3xl font-bold text-gradient mb-4">¿Por qué elegirnos?</h2>
          </div>

    <div class="container mx-auto px-4 relative z-10">
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <!-- Texto -->
        <div class="section-reveal">
          <p class="text-lg text-gray-600 mb-8">
            En <strong>DayJu Life</strong> nos enfocamos en brindarte un servicio humano, profesional y transformador.
            Nuestra misión es ayudarte a recuperar tu bienestar con calidad, empatía y resultados reales.
          </p>

          <div class="space-y-6">
            <!-- Ítem 1 -->
            <div class="flex items-start group">
              <div class="w-8 h-8 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mr-4 mt-1 group-hover:scale-125 transition-transform duration-300">
                <span class="text-white text-sm">✓</span>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">Profesionales Certificados</h3>
                <p class="text-gray-600">Fisioterapeutas y enfermeras con experiencia y formación actualizada.</p>
              </div>
            </div>

            <!-- Ítem 2 -->
            <div class="flex items-start group">
              <div class="w-8 h-8 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mr-4 mt-1 group-hover:scale-125 transition-transform duration-300">
                <span class="text-white text-sm">✓</span>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">Atención Personalizada</h3>
                <p class="text-gray-600">Planes diseñados específicamente para tus necesidades y tu recuperación.</p>
              </div>
            </div>

            <!-- Ítem 3 -->
            <div class="flex items-start group">
              <div class="w-8 h-8 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mr-4 mt-1 group-hover:scale-125 transition-transform duration-300">
                <span class="text-white text-sm">✓</span>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">Resultados Comprobados</h3>
                <p class="text-gray-600">Más de 600 pacientes han mejorado su calidad de vida junto a nosotros.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Contador -->
        <div class="relative section-reveal">
          <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl p-8 animate-pulse-glow">
            <div class="grid grid-cols-2 gap-6">
              <div class="text-center group">
                <div class="text-4xl font-bold text-gradient mb-2 counter" data-target="600">0</div>
                <div class="text-gray-600">Pacientes Atendidos</div>
              </div>
              <div class="text-center group">
                <div class="text-4xl font-bold text-gradient mb-2 counter" data-target="3">0</div>
                <div class="text-gray-600">Años de Experiencia</div>
              </div>
              <div class="text-center group">
                <div class="text-4xl font-bold text-gradient mb-2 counter" data-target="98">0</div>
                <div class="text-gray-600">% Satisfacción</div>
              </div>
              <div class="text-center group">
                <div class="text-4xl font-bold text-gradient mb-2">24/7</div>
                <div class="text-gray-600">Disponibilidad</div>
              </div>
            </div>
          </div>
        </div>
      </div>


            <!-- Galería de Nuestro Trabajo -->
            <div class="mt-20 section-reveal">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gradient mb-4">Nuestro Trabajo en Acción</h3>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Conoce algunos de los casos y tratamientos que hemos realizado con éxito
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Imagen 1: Fisioterapia en Casa -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                 alt="Fisioterapia domiciliaria profesional"
                                 class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">
                              Fisioterapia Avanzada
                            </h4>
                            <p class="text-gray-600 mb-3">
                              Sesiones especializadas para tu recuperación muscular, articular y postural con técnicas modernas.
                            </p>
                            <div class="flex items-center text-sm text-gray-500">
                              <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium">Fisioterapia</span>
                              <span class="ml-auto">📍 Otavalo</span>
                            </div>
                          </div>
                    </div>

                    <!-- Imagen 2: Enfermería Profesional -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                 alt="Enfermería profesional a domicilio"
                                 class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-accent/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">Cuidados de Enfermería</h4>
                            <p class="text-gray-600 mb-3">Atención especializada y control de signos vitales</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Enfermería</span>
                                <span class="ml-auto">📍 Ibarra</span>
                            </div>
                        </div>
                    </div>

                    <!-- Imagen 3: Rehabilitación Geriátrica -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                 alt="Rehabilitación geriátrica especializada"
                                 class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-teal/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">Rehabilitación Geriátrica</h4>
                            <p class="text-gray-600 mb-3">Terapia especializada para adultos mayores</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full">Geriatría</span>
                                <span class="ml-auto">📍 Atuntaqui</span>
                            </div>
                        </div>
                    </div>

                    <!-- Imagen 4: Masaje Terapéutico -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                 alt="Masaje terapéutico profesional"
                                 class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-accent-pink/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">Masaje Terapéutico</h4>
                            <p class="text-gray-600 mb-3">Relajación y recuperación muscular especializada</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terapia</span>
                                <span class="ml-auto">📍 Cotacachi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Imagen 5: Sueros Vitamínicos -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1559757175-0eb30cd8c063?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                 alt="Administración de sueros vitamínicos"
                                 class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-teal/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">Sueros Vitamínicos</h4>
                            <p class="text-gray-600 mb-3">Hidratación y nutrición intravenosa especializada</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Nutrición</span>
                                <span class="ml-auto">📍 Urcuquí</span>
                            </div>
                        </div>
                    </div>

                    <!-- Imagen 6: Curación de Heridas -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                 alt="Curación profesional de heridas"
                                 class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">Curación de Heridas</h4>
                            <p class="text-gray-600 mb-3">Tratamiento especializado y seguimiento de heridas</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full">Curación</span>
                                <span class="ml-auto">📍 Pimampiro</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="py-20 bg-gradient-to-br from-gray-50 to-gray-100 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16 section-reveal">
                <h2 class="text-3xl font-bold text-gradient mb-4">Contacto</h2>
                <p class="text-xl text-gray-600">¿Listo para comenzar tu tratamiento?</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover section-reveal">
                    <h3 class="text-2xl font-bold text-gradient mb-6">Información de Contacto</h3>

                    <div class="space-y-6">
                        <div class="flex items-center group">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-white">📍</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors duration-300">Dirección</h4>
                                <p class="text-gray-600">Baltazar Pillajo y Av. Juan de Albarracín</p>
                                <p class="text-gray-600">Cdla. Jacinto Collahuazo 2da Etapa</p>
                                <p class="text-gray-600">Otavalo - Ecuador</p>
                            </div>
                        </div>

                        <div class="flex items-center group">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-white">📞</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors duration-300">Teléfono</h4>
                                <p class="text-gray-600">+593 959 677 239</p>
                            </div>
                        </div>

                        <div class="flex items-center group">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-white">✉️</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors duration-300">Email</h4>
                                <p class="text-gray-600">info@fisioterapiaibarra.com</p>
                            </div>
                        </div>

                        <div class="flex items-center group">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-white">🕒</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors duration-300">Horario</h4>
                                <p class="text-gray-600">Lun - Vie: 8:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover section-reveal">
                    <h3 class="text-2xl font-bold text-gradient mb-6">Reservar Cita</h3>

                    <form id="form-reserva" class="space-y-4">
                        <div class="group">
                            <input type="text" id="nombre" placeholder="Nombre completo" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300 group-hover:border-primary">
                        </div>
                        <div class="group">
                            <input type="email" id="email" placeholder="Email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300 group-hover:border-primary">
                        </div>
                        <div class="group">
                            <input type="tel" id="telefono" placeholder="Teléfono" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300 group-hover:border-primary">
                        </div>
                        <div class="group">
                            <select id="servicio" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300 group-hover:border-primary">
                                <option value="">Seleccionar servicio</option>
                                <option>Fisioterapia - Terapia Física</option>
                                <option>Fisioterapia - Masaje Terapéutico</option>
                                <option>Fisioterapia - Rehabilitación Geriátrica</option>
                                <option>Fisioterapia - Valoración Funcional</option>
                                <option>Enfermería - Control de Signos Vitales</option>
                                <option>Enfermería - Cuidados de pacientes</option>
                                <option>Enfermería - Administración de medicamentos</option>
                                <option>Enfermería - Sueros Vitamínicos</option>
                                <option>Enfermería - Curación de Heridas</option>
                            </select>
                        </div>
                        <div class="group">
                            <textarea id="mensaje" placeholder="Mensaje" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-300 group-hover:border-primary"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-accent text-white py-3 rounded-lg font-semibold btn-magnetic group">
                            <span class="group-hover:scale-110 transition-transform duration-300 inline-block">📱 Enviar por WhatsApp</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer -->
<footer class="bg-gray-800 text-white py-16 relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-4 gap-10">

            <!-- Logo y descripción -->
            <div class="section-reveal space-y-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center animate-pulse-glow mr-3">
                        <span class="text-white font-bold text-2xl">D</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gradient">DayJu Life</h3>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Salud en Movimiento. Servicios profesionales de fisioterapia y enfermería
                    a domicilio para tu bienestar y comodidad.
                </p>
            </div>

            <!-- Enlaces rápidos -->
            <div class="section-reveal">
                <h4 class="text-lg font-semibold mb-4 text-gradient">Enlaces Rápidos</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="#inicio" class="hover:text-accent transition-all duration-300 hover:translate-x-2 inline-block">Inicio</a></li>
                    <li><a href="#servicios" class="hover:text-accent transition-all duration-300 hover:translate-x-2 inline-block">Servicios</a></li>
                    <li><a href="#nosotros" class="hover:text-accent transition-all duration-300 hover:translate-x-2 inline-block">Nosotros</a></li>
                    <li><a href="#contacto" class="hover:text-accent transition-all duration-300 hover:translate-x-2 inline-block">Contacto</a></li>
                </ul>
            </div>

            <!-- Dirección -->
            <div class="section-reveal space-y-3">
                <h4 class="text-lg font-semibold mb-2 text-gradient">Dirección</h4>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Baltazar Pillajo y Av. Juan de Albarracín<br>
                    Cdla. Jacinto Collahuazo 2da Etapa<br>
                    Otavalo - Ecuador
                </p>
            </div>

            <!-- Redes sociales -->
            <div class="section-reveal">
                <h4 class="text-lg font-semibold mb-4 text-gradient">Síguenos</h4>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center hover:scale-125 transition-all duration-300 animate-pulse-glow group">
                        <span class="group-hover:rotate-12 transition-transform duration-300">f</span>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gradient-to-br from-accent to-accent-pink rounded-full flex items-center justify-center hover:scale-125 transition-all duration-300 animate-pulse-glow group">
                        <span class="group-hover:rotate-12 transition-transform duration-300">i</span>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gradient-to-br from-teal to-primary rounded-full flex items-center justify-center hover:scale-125 transition-all duration-300 animate-pulse-glow group">
                        <span class="group-hover:rotate-12 transition-transform duration-300">w</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Derechos reservados -->
        <div class="border-t border-gray-700 mt-12 pt-6 text-center text-gray-400 text-sm">
            <p>&copy; 2025 DayLife - Salud en Movimiento. Todos los derechos reservados.</p>
        </div>
    </div>

    <!-- Línea animada -->
    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-primary via-accent to-accent-pink animate-gradient-shift"></div>
</footer>

    <script>
        // Smooth scrolling para navegación
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Intersection Observer para revelar secciones
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');

                    // Si la sección contiene contadores, iniciarlos
                    if (entry.target.querySelector('.counter')) {
                        animateCounters(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Observar todos los elementos con clase section-reveal
        document.querySelectorAll('.section-reveal').forEach(el => {
            observer.observe(el);
        });

        // Animación de contadores
        function animateCounters(section) {
            const counters = section.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                let current = 0;
                const increment = target / 60;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                updateCounter();
            });
        }

        // Efecto parallax para elementos flotantes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;

            document.querySelectorAll('.floating-element').forEach((element, index) => {
                const speed = 0.3 + (index * 0.1);
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Efecto magnético para botones
        document.querySelectorAll('.btn-magnetic').forEach(button => {
            button.addEventListener('mouseenter', (e) => {
                e.target.style.transform = 'translateY(-3px) scale(1.05)';
            });

            button.addEventListener('mouseleave', (e) => {
                e.target.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Cambio de color del header al hacer scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
                header.style.backdropFilter = 'blur(20px)';
            } else {
                header.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
                header.style.backdropFilter = 'blur(10px)';
            }
        });

        // Formulario de reserva con WhatsApp
        document.getElementById('form-reserva').addEventListener('submit', function (e) {
            e.preventDefault();

            const nombre = document.getElementById('nombre').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const servicio = document.getElementById('servicio').value.trim();
            const mensaje = document.getElementById('mensaje').value.trim();

            // Validación básica
            if (!nombre || !email || !telefono || !servicio) {
                alert('Por favor, completa todos los campos obligatorios.');
                return;
            }

            // Validación de email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Por favor, ingresa un email válido.');
                return;
            }

            const numero = "593986868908";
            const texto = `Hola, quiero reservar una cita:%0A%0A👤 *Nombre:* ${nombre}%0A📧 *Email:* ${email}%0A📱 *Teléfono:* ${telefono}%0A🩺 *Servicio:* ${servicio}%0A📝 *Mensaje:* ${mensaje || 'Sin mensaje adicional'}`;

            const url = `https://wa.me/${numero}?text=${encodeURIComponent(texto)}`;

            // Mostrar feedback visual
            const button = e.target.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            button.innerHTML = '<span class="animate-pulse">Enviando...</span>';
            button.disabled = true;

            setTimeout(() => {
                window.open(url, "_blank");
                button.innerHTML = originalText;
                button.disabled = false;

                // Opcional: limpiar formulario
                e.target.reset();
            }, 1000);
        });

        // Efecto de tipeo para el título principal
        const title = document.querySelector('#inicio h2');
        if (title) {
            const text = title.textContent;
            title.textContent = '';
            title.style.borderRight = '3px solid #00d4aa';

            let i = 0;
            const typeWriter = () => {
                if (i < text.length) {
                    title.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                } else {
                    setTimeout(() => {
                        title.style.borderRight = 'none';
                    }, 1000);
                }
            };

            // Iniciar el efecto después de un breve retraso
            setTimeout(typeWriter, 1000);
        }

        // Cursor personalizado (opcional)
        document.addEventListener('mousemove', (e) => {
            const cursor = document.querySelector('.cursor');
            if (cursor) {
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
            }
        });

        // Efecto de partículas flotantes
        function createFloatingParticles() {
            const particlesContainer = document.createElement('div');
            particlesContainer.className = 'fixed inset-0 pointer-events-none z-0';
            document.body.appendChild(particlesContainer);

            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'absolute w-2 h-2 bg-gradient-to-r from-primary to-accent rounded-full opacity-20';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 10 + 's';
                particle.style.animationDuration = (Math.random() * 20 + 10) + 's';
                particle.classList.add('animate-floating-shapes');
                particlesContainer.appendChild(particle);
            }
        }

        // Inicializar partículas
        // createFloatingParticles();

        // Efecto de ondas en los botones
        document.querySelectorAll('button, .btn-magnetic').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>

<script>
    function toggleMobileMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('max-h-0');
      menu.classList.toggle('max-h-96');

      // Solo añadir el evento si se muestra el menú
      if (!menu.classList.contains('max-h-0')) {
        // Esperamos un frame para evitar que el mismo clic de apertura lo cierre
        setTimeout(() => {
          document.addEventListener('click', handleOutsideClick);
        }, 0);
      } else {
        document.removeEventListener('click', handleOutsideClick);
      }
    }

    function handleOutsideClick(event) {
      const menu = document.getElementById('mobile-menu');
      const toggleButton = event.target.closest('button[onclick="toggleMobileMenu()"]');

      if (!menu.contains(event.target) && !toggleButton) {
        menu.classList.remove('max-h-96');
        menu.classList.add('max-h-0');
        document.removeEventListener('click', handleOutsideClick);
      }
    }
  </script>



    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>
</html>
