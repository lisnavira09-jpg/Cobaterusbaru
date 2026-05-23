<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Form Multi Bagian Kucing</title>
    
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
            overflow: hidden; /* Mengunci layar utama agar tidak bisa digulir liar */

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
        }

        .halaman {
            background-color: #f9f9f9;
            padding: 20px; 
            width: 100%;
            height: 100%; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 0; 
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
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
            overflow-y: auto; /* Izinkan konten bergeser internal jika layar sangat pendek */
            flex: 1;
            padding-bottom: 80px; /* Ruang aman agar tidak tertutup tombol */
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

        /* --- CONTAINER TOMBOL SAKTI DI CHROME --- */
        .tombol-container {
            width: 100%;
            max-width: 400px;
            padding: 15px 20px;
            box-sizing: border-box;
            background-color: #f9f9f9; 
            position: absolute; /* Default nempel mentok di bawah */
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            z-index: 999;
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
    </style>
</head>
<body>

    <div class="wrapper" id="mainWrapper">
        
        <div id="bagian1" class="halaman">
            <div class="konten-form">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400&h=400&fit=crop" alt="Foto Bagian 1">
                <h1>BAGIAN 1</h1>
                <p>Lengkapi data awal kamu:</p>
                <input type="text" id="inputNama" placeholder="Masukkan Nama Lengkap" onfocus="angkatTombol(this)" onblur="turunkanTombol()">
                <input type="number" id="inputUmur" placeholder="Masukkan Umur Kamu" onfocus="angkatTombol(this)" onblur="turunkanTombol()">
            </div>
            <div class="tombol-container">
                <button onclick="pindahKe(2)">Lanjut ke Bagian 2</button>
            </div>
        </div>

        <div id="bagian2" class="halaman">
            <div class="konten-form">
                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=400&h=400&fit=crop" alt="Foto Bagian 2">
                <h1>BAGIAN 2</h1>
                <p>Satu langkah lagi:</p>
                <input type="text" id="inputHobi" placeholder="Apa Hobi / Cita-citamu?" onfocus="angkatTombol(this)" onblur="turunkanTombol()">
            </div>
            <div class="tombol-container">
                <button onclick="tampilkanHasil()">Lanjut ke Bagian 3</button>
            </div>
        </div>

        <div id="bagian3" class="halaman">
            <div class="konten-form">
                <h1>BAGIAN 3</h1>
                <p>Terima kasih! Data kamu sedang diproses.</p>
                <img src="https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=400&h=400&fit=crop" alt="Foto Bagian 3">
            </div>
            <div class="tombol-container">
                <button class="btn-ulang" onclick="pindahKe(1)">Isi Ulang Data</button>
            </div>
        </div>

    </div>

    <script>
        // Mengunci tinggi wrapper utama
        function sesuaikanTinggiLayar() {
            document.getElementById('mainWrapper').style.height = window.innerHeight + 'px';
        }
        window.addEventListener('load', sesuaikanTinggiLayar);
        sesuaikanTinggiLayar();

        // --- TRIK BARU KHUSUS GOOGLE CHROME DI VERCEL ---
        function angkatTombol(inputElement) {
            // 1. Paksa halaman bergeser sedikit ke atas agar inputan fokus berada di tengah kenyamanan mata
            setTimeout(function() {
                inputElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 150);

            // 2. Ubah paksa posisi wadah tombol menjadi 'fixed' agar terangkat melayang di atas keyboard Chrome
            document.querySelectorAll('.tombol-container').forEach(el => {
                el.style.position = 'fixed';
                el.style.bottom = '0';
            });
        }

        function turunkanTombol() {
            // Kembalikan posisi tombol mentok ke bawah semula saat selesai mengetik
            document.querySelectorAll('.tombol-container').forEach(el => {
                el.style.position = 'absolute';
                el.style.bottom = '0';
            });
            
            // Perbaiki bug layar gulir Chrome setelah keyboard ditutup
            window.scrollTo(0, 0);
            setTimeout(sesuaikanTinggiLayar, 100);
        }

        function tampilkanHasil() {
            var nama = document.getElementById('inputNama').value;
            var umur = document.getElementById('inputUmur').value;
            var hobi = document.getElementById('inputHobi').value;

            if (hobi == "") {
                alert("Harap isi hobi kamu dulu ya!");
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
            turunkanTombol(); // Reset posisi tombol
            
            document.getElementById('bagian1').style.display = 'none';
            document.getElementById('bagian2').style.display = 'none';
            document.getElementById('bagian3').style.display = 'none';

            var target = document.getElementById('bagian' + nomorHalaman);
            target.style.display = 'flex';
            sesuaikanTinggiLayar();
        }
    </script>
</body>
</html>
