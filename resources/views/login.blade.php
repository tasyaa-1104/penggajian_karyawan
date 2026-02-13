<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Penggajian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- 1. SETUP WARNA MAROON ELEGAN --- */
        :root {
            --primary-maroon: #800000;
            --dark-maroon: #5c0000;
            --light-bg: #f4f6f9;
            --text-main: #2c3e50;
            --text-muted: #7f8c8d;
            --input-border: #e0e0e0;
            --input-focus: #800000;
            --shadow-soft: 0 20px 50px rgba(0, 0, 0, 0.08);
            --card-radius: 20px;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            margin:0;
            height:100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-color: var(--light-bg);
            position: relative;
        }

        /* --- 2. BACKGROUND PARTICICLES --- */
        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(128,0,0,0.03) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: 1;
            pointer-events: none;
        }
        .p1 { width: 400px; height: 400px; top: -100px; right: -100px; animation: float 20s infinite linear; }
        .p2 { width: 300px; height: 300px; bottom: -50px; left: -50px; animation: float 25s infinite reverse linear; }

        @keyframes float {
            0% { transform: translate(0, 0); }
            50% { transform: translate(30px, 50px); }
            100% { transform: translate(0, 0); }
        }

        /* --- 3. CONTAINER & SPOTLIGHT EFFECT --- */
        .main-container {
            z-index: 10;
            perspective: 1500px;
        }

        .login-card {
            display: flex;
            width: 900px;
            height: 550px;
            background: #fff;
            border-radius: var(--card-radius);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            position: relative;
            /* Animation Utama Masuk */
            animation: cardEntrance 1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
            transform: scale(0.9);
        }

        /* Efek Cahaya Mengikuti Mouse */
        .login-card::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0; left: 0;
            background: radial-gradient(
                600px circle at var(--x, 50%) var(--y, 50%),
                rgba(128, 0, 0, 0.05),
                transparent 40%
            );
            z-index: 3; /* Di atas background, di bawah konten */
            pointer-events: none;
            transition: opacity 0.5s;
        }

        @keyframes cardEntrance {
            to { opacity: 1; transform: scale(1); }
        }

        /* --- 4. SISI KIRI: FOTO --- */
        .image-side {
            flex: 0 0 35%;
            background-image: url('https://z-cdn-media.chatglm.cn/files/4abd032b-72c4-4369-a91b-c92c7d9d2718.jpg?auth_key=1870881704-f315d37b08f542fbbd94ed3e58f583cd-0-8a65f9989b904182f075a310e11c9c4e');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .image-side::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, rgba(128,0,0,0.2), rgba(128,0,0,0.7));
        }

        .image-content {
            position: absolute;
            bottom: 40px;
            left: 30px;
            right: 30px;
            z-index: 2;
            color: #fff;
            text-align: left;
            opacity: 0; /* Mulai tersembunyi */
            animation: slideInLeft 0.8s ease-out 0.5s forwards;
        }

        .image-content h3 { font-size: 1.5rem; font-weight: 600; margin-bottom: 5px; }
        .image-content p { font-size: 0.9rem; opacity: 0.9; line-height: 1.4; }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* --- 5. SISI KANAN: FORM --- */
        .form-side {
            flex: 1;
            padding: 50px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            background: #fff;
            z-index: 5; /* Konten di atas spotlight */
        }

        /* Staggered Animation Classes */
        .stagger-anim {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .delay-1 { animation-delay: 0.2s; } /* Judul */
        .delay-2 { animation-delay: 0.4s; } /* Sub Judul */
        .delay-3 { animation-delay: 0.6s; } /* Input 1 */
        .delay-4 { animation-delay: 0.7s; } /* Input 2 */
        .delay-5 { animation-delay: 0.8s; } /* Link */
        .delay-6 { animation-delay: 0.9s; } /* Button */

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-side h2 {
            font-size: 28px;
            color: var(--primary-maroon);
            margin-bottom: 5px;
            font-weight: 700;
        }
        .form-side p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* --- 6. INPUT STYLE DENGAN GARIS BAWAH --- */
        .input-group {
            position: relative;
            margin-bottom: 25px;
            text-align: left;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            font-size: 14px;
            background: transparent;
            border: none;
            border-bottom: 2px solid #eee;
            border-radius: 4px 4px 0 0;
            color: #333;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            background: #fafafa;
            border-bottom-color: var(--primary-maroon);
        }

        /* Garis Bawah Animasi */
        .input-group::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-maroon);
            transition: width 0.4s ease;
        }

        .input-group input:focus ~ .input-group::after {
            width: 100%;
        }

        .input-group label {
            position: absolute;
            left: 45px;
            top: 12px;
            color: #aaa;
            font-size: 14px;
            pointer-events: none;
            transition: 0.3s;
        }

        .input-group input:focus ~ label,
        .input-group input:not(:placeholder-shown) ~ label {
            left: 0px;
            top: -10px;
            font-size: 11px;
            color: var(--primary-maroon);
            font-weight: 600;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            fill: none;
            stroke: #ccc;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: 0.3s;
        }

        .input-group input:focus ~ .input-icon {
            stroke: var(--primary-maroon);
            transform: translateY(-50%) scale(1.1);
        }

        /* --- 7. TOMBOL & LINK --- */
        .form-side a.forgot-pass {
            display: block;
            text-align: right;
            font-size: 12px;
            color: var(--text-muted);
            text-decoration: none;
            margin-bottom: 30px;
            transition: 0.3s;
        }
        .form-side a.forgot-pass:hover { color: var(--primary-maroon); }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, var(--primary-maroon), var(--dark-maroon));
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(128, 0, 0, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        /* Efek Kilau (Shine) saat Hover */
        .submit-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transform: skewX(-25deg);
            transition: 0.5s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(128, 0, 0, 0.3);
        }

        .submit-btn:hover::after {
            left: 150%;
            transition: 0.7s ease-in-out;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Efek Ripple */
        .ripple {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: rippleAnim 0.6s linear;
            pointer-events: none;
        }
        @keyframes rippleAnim {
            to { transform: scale(4); opacity: 0; }
        }

        .back-home {
            margin-top: 25px;
            font-size: 13px;
            color: var(--text-muted);
            text-decoration: none;
            transition: 0.3s;
            text-align: center;
            display: block;
        }
        .back-home:hover { color: var(--primary-maroon); }

        /* --- 8. RESPONSIVE --- */
        @media (max-width: 950px) {
            .login-card {
                flex-direction: column;
                width: 90%;
                height: auto;
            }
            .image-side {
                flex: none;
                height: 200px;
                width: 100%;
                border-radius: var(--card-radius) var(--card-radius) 0 0;
            }
            .form-side {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

    <!-- Background Particles -->
    <div class="particle p1"></div>
    <div class="particle p2"></div>

    <!-- Container Utama -->
    <div class="main-container">
        <!-- Kartu Login -->
        <div class="login-card" id="main-card">

            <!-- SISI KIRI: FOTO -->
            <div class="image-side">
                <div class="image-content">
                    <h3>SmartGaji</h3>
                    <p>Manajemen Penggajian Terpadu</p>
                </div>
            </div>

            <!-- SISI KANAN: FORM -->
            <div class="form-side">
                <!--
                   FORM LOGIN (LOGIKA LARAVEL TIDAK DIUBAH)
                -->
                <form method="POST" action="{{ route('login.proses') }}">
                    @csrf

                    <h2 class="stagger-anim delay-1">Login</h2>
                    <p class="stagger-anim delay-2">Silakan masuk dengan akun Anda</p>

                    <div class="input-group stagger-anim delay-3">
                        <input type="text" name="username" placeholder=" " required autocomplete="off">
                        <label>Username</label>
                        <svg class="input-icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>

                    <div class="input-group stagger-anim delay-4">
                        <input type="password" name="password" placeholder=" " required>
                        <label>Password</label>
                        <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </div>

                    <a href="#" class="forgot-pass stagger-anim delay-5">Lupa Password?</a>

                    <button type="submit" class="submit-btn stagger-anim delay-6" id="submitBtn">MASUK</button>

                    <a href="{{ url('/') }}" class="back-home stagger-anim delay-6">
                        ← Kembali ke Halaman Awal
                    </a>
                </form>
            </div>

        </div>
    </div>

    <script>
        // --- 1. SPOTLIGHT & TILT EFFECT ---
        const card = document.getElementById('main-card');

        if (window.innerWidth > 950) {
            document.addEventListener('mousemove', (e) => {
                // 1. Update variabel CSS untuk posisi Spotlight
                const x = e.pageX - card.offsetLeft;
                const y = e.pageY - card.offsetTop;
                card.style.setProperty('--x', `${x}px`);
                card.style.setProperty('--y', `${y}px`);

                // 2. Efek 3D Tilt Halus
                const xAxis = (window.innerWidth / 2 - e.pageX) / 50;
                const yAxis = (window.innerHeight / 2 - e.pageY) / 50;
                card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
            });

            document.addEventListener('mouseleave', () => {
                card.style.transform = `rotateY(0deg) rotateX(0deg)`;
            });
        }

        // --- 2. BUTTON RIPPLE & LOADING ---
        const btn = document.getElementById('submitBtn');
        btn.addEventListener('click', function(e) {
            this.innerText = "MEMPROSES...";
            this.style.opacity = "0.9";
            this.style.background = "#5c0000";

            let ripple = document.createElement('span');
            ripple.classList.add('ripple');
            let rect = this.getBoundingClientRect();
            let x = e.clientX - rect.left;
            let y = e.clientY - rect.top;
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    </script>
</body>
</html>
