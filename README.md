# Kelompok 10 proyek Basdat

Membuat frontend input data mahasiswa dan input data ke database MySQL
---

## Ingfo Setup

1. **Konfigurasi Proyek:**
   - Download folder atau clone (`Uas_Basdat`) ke folder `htdocs`  di XAMPP.
     - Default Path:
       - Windows: `C:\xampp\htdocs\`
       - macOS/Linux: `/opt/lampp/htdocs/`

2. **Bikin Database:**
   - Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`.
   - Buat database baru: `datamahasiswa`.
   - Jalankan query SQL berikut untuk membuat tabel `students`:
     ```sql
     CREATE TABLE students (
         -- id INT AUTO_INCREMENT PRIMARY KEY, (optional) -- 
         nama VARCHAR(255) NOT NULL,
         nim INT NOT NULL,
         alamat VARCHAR(255),
         prodi VARCHAR(255),
         ukt INT
     );
     ```

5. **Cara Run:**
   - Buka browser dan navigasikan ke: `http://localhost/ProyekUAS/index.html`.

6. **Uji Formu:**
   - Isi formulir dan klik **Submit**.
   - Cek data di phpMyAdmin di database `datamahasiswa` dan tabel `students`.

---



