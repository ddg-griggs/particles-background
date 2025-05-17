document.addEventListener('DOMContentLoaded', function() {
    if (typeof particlesJS !== 'undefined' && typeof particlesConfig !== 'undefined') {
        // Устанавливаем фон
        const bgElement = document.getElementById('particles-js');
        if (particlesConfig.background.type === 'gradient') {
            bgElement.style.background = `linear-gradient(${particlesConfig.background.gradient.angle}deg, 
                                        ${particlesConfig.background.gradient.start}, 
                                        ${particlesConfig.background.gradient.end})`;
        } else {
            bgElement.style.backgroundColor = particlesConfig.background.color;
        }
        
        // Инициализация частиц
        particlesJS("particles-js", {
            particles: {
                number: { 
                    value: parseInt(particlesConfig.number),
                    density: { enable: true, value_area: 800 }
                },
                color: {
                    value: particlesConfig.colors
                },
                shape: { type: "circle" },
                opacity: { value: 0.5 },
                size: { value: 3, random: true },
                line_linked: { 
                    enable: particlesConfig.lines.enabled == 1,
                    color: particlesConfig.lines.color,
                    width: parseFloat(particlesConfig.lines.width)
                },
                move: { 
                    enable: true, 
                    speed: parseFloat(particlesConfig.speed),
                    direction: "none",
                    out_mode: "out"
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" }
                }
            }
        });
    }
});
