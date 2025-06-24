<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .container {
            text-align: center;
            color: white;
            z-index: 10;
            position: relative;
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 0 10px 20px rgba(0,0,0,0.3);
            animation: pulse 2s infinite;
        }
        
        .message {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .sub-message {
            font-size: 1.2rem;
            margin-bottom: 3rem;
            opacity: 0.7;
        }
        
        .btn-home {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        
        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.3);
        }
        
        /* Dibujo SVG animado */
        .drawing-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            opacity: 0.1;
        }
        
        .astronaut {
            animation: float 6s ease-in-out infinite;
        }
        
        .planet {
            animation: rotate 20s linear infinite;
        }
        
        .star {
            animation: twinkle 2s ease-in-out infinite alternate;
        }
        
        .ufo {
            animation: hover 4s ease-in-out infinite;
        }
        
        /* Partículas flotantes */
        .particle {
            position: absolute;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float-particles 15s linear infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes twinkle {
            from { opacity: 0.3; }
            to { opacity: 1; }
        }
        
        @keyframes hover {
            0%, 100% { transform: translateX(0px) translateY(0px); }
            25% { transform: translateX(10px) translateY(-5px); }
            50% { transform: translateX(-5px) translateY(-10px); }
            75% { transform: translateX(-10px) translateY(5px); }
        }
        
        @keyframes float-particles {
            0% {
                transform: translateY(100vh) translateX(0px);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }
        
        @media (max-width: 768px) {
            .error-code {
                font-size: 6rem;
            }
            
            .message {
                font-size: 1.5rem;
            }
            
            .sub-message {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="drawing-container">
        <svg width="800" height="600" viewBox="0 0 800 600">
            <!-- Estrellas de fondo -->
            <circle class="star" cx="100" cy="80" r="2" fill="white"/>
            <circle class="star" cx="200" cy="50" r="1.5" fill="white"/>
            <circle class="star" cx="700" cy="100" r="2" fill="white"/>
            <circle class="star" cx="650" cy="150" r="1" fill="white"/>
            <circle class="star" cx="150" cy="200" r="1.5" fill="white"/>
            <circle class="star" cx="750" cy="250" r="2" fill="white"/>
            
            <!-- Planeta -->
            <g class="planet">
                <circle cx="150" cy="450" r="60" fill="#ff7675"/>
                <ellipse cx="150" cy="430" rx="50" ry="8" fill="#d63031" opacity="0.5"/>
                <ellipse cx="150" cy="460" rx="45" ry="6" fill="#d63031" opacity="0.3"/>
            </g>
            
            <!-- OVNI -->
            <g class="ufo">
                <ellipse cx="650" cy="200" rx="40" ry="15" fill="#74b9ff"/>
                <ellipse cx="650" cy="195" rx="25" ry="12" fill="#0984e3"/>
                <circle cx="635" cy="190" r="3" fill="#00b894"/>
                <circle cx="650" cy="188" r="3" fill="#00b894"/>
                <circle cx="665" cy="190" r="3" fill="#00b894"/>
            </g>
            
            <!-- Astronauta -->
            <g class="astronaut">
                <!-- Cuerpo -->
                <ellipse cx="400" cy="320" rx="30" ry="45" fill="#ddd"/>
                <!-- Casco -->
                <circle cx="400" cy="280" r="35" fill="rgba(255,255,255,0.8)" stroke="#bbb" stroke-width="3"/>
                <!-- Cara -->
                <circle cx="390" cy="275" r="2" fill="#333"/>
                <circle cx="410" cy="275" r="2" fill="#333"/>
                <ellipse cx="400" cy="285" rx="4" ry="2" fill="#ff7675"/>
                <!-- Brazos -->
                <ellipse cx="370" cy="310" rx="8" ry="25" fill="#ddd" transform="rotate(-20 370 310)"/>
                <ellipse cx="430" cy="310" rx="8" ry="25" fill="#ddd" transform="rotate(20 430 310)"/>
                <!-- Piernas -->
                <ellipse cx="385" cy="370" rx="10" ry="25" fill="#ddd"/>
                <ellipse cx="415" cy="370" rx="10" ry="25" fill="#ddd"/>
                <!-- Jetpack -->
                <rect x="390" y="330" width="20" height="15" fill="#fd79a8" rx="3"/>
            </g>
            
            <!-- Cohete -->
            <g transform="translate(500, 400)">
                <!-- Cuerpo del cohete -->
                <ellipse cx="0" cy="0" rx="15" ry="40" fill="#e17055"/>
                <!-- Punta -->
                <path d="M -15,-40 L 0,-60 L 15,-40 Z" fill="#d63031"/>
                <!-- Ventana -->
                <circle cx="0" cy="-20" r="8" fill="#74b9ff"/>
                <!-- Llamas -->
                <ellipse cx="0" cy="45" rx="8" ry="15" fill="#fd79a8"/>
                <ellipse cx="0" cy="50" rx="5" ry="10" fill="#fdcb6e"/>
            </g>
        </svg>
    </div>
    
    <div class="container">
        <div class="error-code">404</div>
        <div class="message">¡Ups! Página no encontrada</div>
        <div class="sub-message">Parece que te has perdido en el espacio digital</div>
    </div>
    
    <script>
        // Crear partículas flotantes
        function createParticles() {
            const particleCount = 50;
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Tamaño aleatorio
                const size = Math.random() * 4 + 1;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                
                // Posición aleatoria
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.top = '100vh';
                
                // Velocidad aleatoria
                const duration = Math.random() * 10 + 10;
                particle.style.animationDuration = duration + 's';
                particle.style.animationDelay = Math.random() * 5 + 's';
                
                document.body.appendChild(particle);
                
                // Remover partícula después de la animación
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.parentNode.removeChild(particle);
                    }
                }, (duration + 5) * 1000);
            }
        }
        
        // Crear partículas iniciales
        createParticles();
        
        // Crear nuevas partículas cada 3 segundos
        setInterval(createParticles, 3000);
        
        // Efecto de hover en el botón
        const btn = document.querySelector('.btn-home');
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    </script>
</body>
</html>