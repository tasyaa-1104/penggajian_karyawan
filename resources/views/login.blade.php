<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Penggajian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- 1. SETUP WARNA BIRU LANGIT --- */
        :root {
            --sky-top: #4facfe;       /* Biru Langit Terang */
            --sky-bottom: #00f2fe;    /* Cyan Langit */
            --ocean-blue: #0072ff;    /* Biru Utama */
            --white: #ffffff;
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
            display:flex;
            justify-content:center;
            align-items:center;
            /* Background Langit Biru Cerah */
            background: linear-gradient(180deg, var(--sky-top) 0%, var(--sky-bottom) 100%);
            overflow: hidden;
            position: relative;
            perspective: 1000px;
        }

        /* --- 2. ANIMASI OMBAK (WAVES) --- */
        .waves-container {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 15vh;
            min-height: 100px;
            max-height: 150px;
            z-index: 1;
            overflow: hidden;
        }

        .parallax > use {
            animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
        }
        .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; }
        .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; }
        .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; }
        .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; }

        @keyframes move-forever {
            0% { transform: translate3d(-90px,0,0); }
            100% { transform: translate3d(85px,0,0); }
        }

        /* --- 3. ANIMASI AWAN (CLOUDS) --- */
        .clouds {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .cloud {
            position: absolute;
            background: rgba(255,255,255,0.6);
            border-radius: 50px;
            animation: floatCloud 20s infinite linear;
            opacity: 0.8;
        }

        @keyframes floatCloud {
            0% { transform: translateX(-200px); }
            100% { transform: translateX(120vw); }
        }

        /* --- 4. KARTU LOGIN (PUTIH BERSIH) --- */
        .login-box{
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            width: 380px;
            padding: 45px 35px;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 114, 255, 0.2);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transform-style: preserve-3d;
            transition: transform 0.2s ease;
            animation: popIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            opacity: 0;
        }

        @keyframes popIn {
            from { transform: scale(0.8) translateY(50px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }

        .login-box h2{
            margin-bottom: 10px;
            font-size: 32px;
            color: var(--ocean-blue);
            font-weight: 700;
            text-shadow: 2px 2px 0px rgba(0,0,0,0.05);
        }

        .login-box p{
            margin-bottom: 30px;
            color: #666;
            font-size: 14px;
        }

        /* --- 5. INPUT STYLE --- */
        .input-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }

        .login-box input{
            width: 100%;
            padding: 14px 15px 14px 45px;
            font-size: 15px;
            color: #333;
            background: #f8fbff;
            border: 2px solid #e1e9f5;
            border-radius: 12px;
            outline: none;
            transition: all 0.3s;
        }

        .login-box input:focus {
            background: #fff;
            border-color: var(--sky-top);
            box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
        }

        /* Floating Label */
        .login-box label {
            position: absolute;
            left: 45px;
            top: 14px;
            color: #aaa;
            pointer-events: none;
            transition: 0.3s;
            font-size: 15px;
        }

        .login-box input:focus ~ label,
        .login-box input:not(:placeholder-shown) ~ label {
            left: 15px;
            top: -10px;
            font-size: 11px;
            background: var(--white);
            padding: 0 5px;
            color: var(--ocean-blue);
            font-weight: 600;
            border-radius: 4px;
        }

        /* Icon SVG */
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            fill: none;
            stroke: #ccc;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: 0.3s;
        }

        .login-box input:focus ~ .input-icon {
            stroke: var(--ocean-blue);
        }

        /* --- 6. LINKS --- */
        .login-box a.forgot-pass {
            display: block;
            text-align: right;
            font-size: 13px;
            color: #666;
            text-decoration: none;
            margin-bottom: 25px;
            font-weight: 500;
        }
        .login-box a.forgot-pass:hover { color: var(--ocean-blue); }

        /* --- 7. BUTTON --- */
        .login-box button{
            width:100%;
            padding:16px;
            border:none;
            background: var(--ocean-blue);
            color:#fff;
            border-radius: 12px;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition: 0.3s;
            box-shadow: 0 8px 15px rgba(0, 114, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-box button:hover{
            background: #0056b3;
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(0, 114, 255, 0.4);
        }

        .back-home{
            display:inline-block;
            margin-top:25px;
            font-size:13px;
            color: #666;
            text-decoration:none;
            transition:0.3s;
        }
        .back-home:hover { color: var(--ocean-blue); }

    </style>
</head>
<body>

    <!-- Animasi Awan -->
    <div class="clouds" id="cloud-container"></div>

    <!-- Animasi Ombak -->
    <div class="waves-container">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>
    </div>

    <!--
       FORM LOGIN (LOGIKA TIDAK DIUBAH)
       - Method POST
       - Action ke Route Login
       - Name="username" & "password" tetap sama
       - CSRF diembalikan agar form berfungsi di Laravel
    -->
    <form class="login-box" id="tilt-card" method="POST" action="{{ route('login.proses') }}">
        @csrf

        <h2>Login</h2>
        <p>Sistem Informasi Penggajian</p>

        <div class="input-group">
            <!-- Placeholder wajib spasi untuk animasi label -->
            <input type="text" name="username" placeholder=" " required autocomplete="off">
            <label>Username</label>
            <svg class="input-icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder=" " required>
            <label>Password</label>
            <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
        </div>

        <a href="#" class="forgot-pass">Lupa Password?</a>

        <!-- Tidak ada event 'submit' di JS yang menghalangi form ini -->
        <button type="submit" id="submitBtn">LOGIN</button>

        <br>
        <a href="{{ url('/') }}" class="back-home">
            ← Kembali ke Halaman Awal
        </a>
    </form>

    <script>
        // --- 1. GENERATE CLOUDS ---
        const cloudContainer = document.getElementById('cloud-container');
        function createCloud() {
            const cloud = document.createElement('div');
            cloud.classList.add('cloud');
            const width = Math.random() * 100 + 100;
            const height = width * 0.35;
            cloud.style.width = `${width}px`;
            cloud.style.height = `${height}px`;
            cloud.style.top = `${Math.random() * 50}%`;
            const duration = Math.random() * 20 + 20;
            cloud.style.animationDuration = `${duration}s`;
            cloud.style.opacity = Math.random() * 0.5 + 0.3;
            cloudContainer.appendChild(cloud);
        }
        for(let i=0; i<8; i++) createCloud();

        // --- 2. EFEK 3D TILT ---
        const card = document.getElementById('tilt-card');
        document.body.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 40;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 40;
            card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });
        document.body.addEventListener('mouseleave', () => {
            card.style.transform = `rotateY(0deg) rotateX(0deg)`;
        });

        // --- 3. VISUAL BUTTON ONLY ---
        // Script ini hanya mengubah teks tombol, TIDAK MENCEGAH SUBMIT FORM
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.addEventListener('click', function() {
            this.innerText = "SEDANG MASUK...";
            this.style.opacity = "0.8";
            // Form akan tetap tersubmit ke server Laravel secara normal
        });
    </script>
</body>
</html>
