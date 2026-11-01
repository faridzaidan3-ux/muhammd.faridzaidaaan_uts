# Personal Portfolio Website

## Informasi Mahasiswa

- **Nama:** Muhammad Farid Zaidaan
- **NIM:** 202501151005
- **Program Studi:** Sistem Informasi
- **Perguruan Tinggi:** STMIK Rosma Karawang

## Deskripsi Proyek

Website Personal Portfolio ini dibuat sebagai bagian dari tugas Ujian Tengah Semester (UTS) mata kuliah Web Programming. Website ini berfungsi sebagai media untuk memperkenalkan profil diri, riwayat pendidikan, keterampilan, pengalaman, serta beberapa proyek yang pernah dikerjakan.

Website dikembangkan menggunakan HTML, CSS, dan PHP dengan tampilan responsif agar dapat diakses melalui berbagai ukuran perangkat.

## Teknologi yang Digunakan

- **HTML5** – Menyusun struktur halaman website.
- **CSS3** – Mengatur tampilan, layout, dan responsivitas website.
- **Flexbox** – Mengatur tata letak elemen.
- **PHP** – Mengolah fitur pencarian dan formulir kontak.

## Fitur Website

1. **Home** – Menampilkan perkenalan singkat dan profil utama.
2. **Tentang Saya** – Menampilkan informasi pribadi.
3. **Pendidikan** – Menampilkan riwayat pendidikan dan pengalaman.
4. **Skills** – Menampilkan keterampilan yang dimiliki.
5. **Projects** – Menampilkan proyek serta fitur pencarian.
6. **Contact** – Menyediakan informasi kontak dan formulir pesan.

### Fitur PHP

- **Search (`search.php`)** – Menggunakan metode GET untuk mencari informasi berdasarkan kata kunci.
- **Contact (`kontak.php`)** – Menggunakan metode POST untuk menerima dan memvalidasi data formulir kontak.

## Struktur Folder

```text
portofolio_uts/
│
├── assets/
│   └── image/
│       └── farid.jpeg
│
├── head.php
├── body.php
├── foot.php
├── index.html
├── index.php
├── search.php
├── kontak.php
├── style.css
└── README.md
```

## Cara Menjalankan Website

### 1. Menjalankan Website

- Pindahkan folder `portofolio_uts` ke dalam direktori `htdocs` jika menggunakan XAMPP.
- Jalankan Apache melalui XAMPP Control Panel.
- Buka browser dan akses:

```text
http://localhost/portofolio_uts/index.html
```

### 2. Menjalankan Fitur PHP

Pastikan Apache aktif, kemudian akses halaman berikut:

**Halaman pencarian:**

```text
http://localhost/portofolio_uts/search.php
```

**Halaman formulir kontak:**

```text
http://localhost/portofolio_uts/kontak.php
```

Fitur pencarian dan formulir kontak dijalankan melalui server lokal yang mendukung PHP.

## Deployment

Website utama telah di-deploy menggunakan Vercel.

**Link Website:*
[*https://muhammadfaridzaidaanweb.vercel.app/]

**Catatan:** Fitur PHP dijalankan dan diuji secara lokal menggunakan server PHP/XAMPP. Deployment statis di Vercel tidak menjalankan PHP secara langsung.

## Bukti Pengujian PHP

Bukti pengujian fitur PHP dapat dilihat melalui dokumentasi berikut:

- **Pengujian Search:** [foto pencarian berhasil.png] [foto pencarian gagal.png]

- **Pengujian Contact:** [foto pesan berhasil dikirim.png]

## Penutup

Melalui proyek ini, saya menerapkan dasar pengembangan website menggunakan HTML, CSS, dan PHP, mulai dari penyusunan struktur halaman, pengaturan tampilan responsif, hingga pengolahan data melalui metode GET dan POST.