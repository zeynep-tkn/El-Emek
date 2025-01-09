<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivasyon Mesajı</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('index.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
            overflow: hidden;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            text-align: center;
            position: relative;
            z-index: 10;
        }
        h1 {
            color:rgb(155, 10, 109) ;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .signature {
            margin-top: 30px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .fireworks {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Değerli Kadın Girişimcilerimiz,</h1>
        <p>
            Sizler, cesaretiniz ve azminizle bu platformda yer alarak büyük bir adım attınız. Her birinizin hikayesi, 
            ilham verici ve güçlendirici. Kendi işinizi kurarak, sadece kendiniz için değil, aynı zamanda çevrenizdeki 
            diğer kadınlar için de bir umut ışığı oldunuz.
        </p>
        <p>
            Bu yolculukta karşılaşacağınız zorluklar, sizi daha da güçlü kılacak. Her başarısızlık, bir öğrenme fırsatıdır 
            ve her başarı, daha büyük hedeflere ulaşmanız için bir basamaktır. Unutmayın ki, sizler sadece birer girişimci 
            değil, aynı zamanda geleceğin liderlerisiniz.
        </p>
        <p>
            Ürünlerinizi bu platformda sergileyerek, yaratıcılığınızı ve emeğinizi dünyaya tanıtıyorsunuz. Her bir ürün, 
            sizin hikayenizin bir parçası ve bu hikaye, müşterilerinizin hayatına dokunacak. Sizlerin başarısı, bizim 
            başarımızdır ve bu yolculukta sizlere destek olmaktan gurur duyuyoruz.
        </p>
        <p>
            Hep birlikte, daha güçlü ve daha başarılı bir topluluk oluşturacağız. Sizlere olan inancımız tam ve 
            başarılarınızla gurur duyuyoruz. Yolunuz açık, başarılarınız daim olsun.
        </p>
        <div class="signature">
            Saygılarımla,<br>
            Zeynep Tekin<br>
            CEO, El Emek
        </div>
    </div>
    <canvas class="fireworks"></canvas>
    <script>
        // Fireworks effect
        const canvas = document.querySelector('.fireworks');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        function random(min, max) {
            return Math.random() * (max - min) + min;
        }

        class Firework {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = canvas.height;
                this.targetY = random(100, canvas.height / 2);
                this.speed = random(2, 5);
                this.radius = random(2, 4);
                this.color = `hsl(${random(0, 360)}, 100%, 50%)`;
                this.exploded = false;
                this.particles = [];
            }

            update() {
                if (this.y > this.targetY && !this.exploded) {
                    this.y -= this.speed;
                } else {
                    this.exploded = true;
                    for (let i = 0; i < 100; i++) {
                        this.particles.push(new Particle(this.x, this.y, this.color));
                    }
                }
            }

            draw() {
                if (!this.exploded) {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                    ctx.fillStyle = this.color;
                    ctx.fill();
                } else {
                    this.particles.forEach(particle => {
                        particle.update();
                        particle.draw();
                    });
                }
            }
        }

        class Particle {
            constructor(x, y, color) {
                this.x = x;
                this.y = y;
                this.speed = random(1, 5);
                this.angle = random(0, Math.PI * 2);
                this.radius = random(1, 3);
                this.color = color;
                this.alpha = 1;
                this.decay = random(0.01, 0.03);
            }

            update() {
                this.x += Math.cos(this.angle) * this.speed;
                this.y += Math.sin(this.angle) * this.speed;
                this.alpha -= this.decay;
            }

            draw() {
                ctx.save();
                ctx.globalAlpha = this.alpha;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = this.color;
                ctx.fill();
                ctx.restore();
            }
        }

        let fireworks = [];

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (Math.random() < 0.001) {
                fireworks.push(new Firework());
            }
            fireworks.forEach((firework, index) => {
                firework.update();
                firework.draw();
                if (firework.exploded && firework.particles.every(p => p.alpha <= 0)) {
                    fireworks.splice(index, 1);
                }
            });
            requestAnimationFrame(animate);
        }

        animate();
    </script>
</body>
</html>