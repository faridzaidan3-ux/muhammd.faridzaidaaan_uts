
<?php
$nama = '';
$email = '';
$pesan = '';
$error = '';
$berhasil = false;

$fileJson = __DIR__ . '/pesan-kontak.json';

function escapeHtml($value)
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

// Memproses formulir ketika tombol dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pesan = trim($_POST['pesan'] ?? '');

    // Validasi formulir
    if (empty($nama) || empty($email) || empty($pesan)) {

        $error = 'Semua kolom wajib diisi.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = 'Format alamat email tidak valid.';

    } elseif (
        strlen($nama) > 100 ||
        strlen($email) > 254 ||
        strlen($pesan) > 5000
    ) {

        $error = 'Data terlalu panjang. Silakan periksa kembali.';

    } else {

        // Membuat file JSON jika belum tersedia
        if (!file_exists($fileJson)) {
            file_put_contents(
                $fileJson,
                json_encode(
                    ['pesan' => []],
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                )
            );
        }

        // Membuka file JSON
        $handle = fopen($fileJson, 'c+');

        if ($handle === false) {

            $error = 'File penyimpanan pesan tidak dapat dibuka.';

        } elseif (!flock($handle, LOCK_EX)) {

            fclose($handle);
            $error = 'File penyimpanan sedang tidak dapat diakses.';

        } else {

            // Membaca isi JSON
            rewind($handle);
            $isiFile = stream_get_contents($handle);

            $data = json_decode($isiFile, true);

            // Memastikan struktur JSON benar
            if (
                !is_array($data) ||
                !isset($data['pesan']) ||
                !is_array($data['pesan'])
            ) {
                $data = ['pesan' => []];
            }

            // Menambahkan pesan baru
            $data['pesan'][] = [
                'nama' => $nama,
                'email' => $email,
                'pesan' => $pesan,
                'tanggal' => date('Y-m-d H:i:s')
            ];

            // Mengubah data menjadi JSON
            $jsonBaru = json_encode(
                $data,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );

            // Menyimpan data ke file
            if ($jsonBaru !== false) {

                rewind($handle);
                ftruncate($handle, 0);

                $jumlahTersimpan = fwrite($handle, $jsonBaru);

                if (
                    $jumlahTersimpan !== false &&
                    $jumlahTersimpan === strlen($jsonBaru) &&
                    fflush($handle)
                ) {
                    $berhasil = true;

                    $nama = '';
                    $email = '';
                    $pesan = '';

                } else {

                    $error = 'Pesan gagal disimpan. Periksa izin folder.';
                }

            } else {

                $error = 'Data pesan gagal dikonversi ke JSON.';
            }

            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kontak | Muhammad Farid Zaidaan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="header">
    <nav class="navbar container" aria-label="Navigasi utama">

        <a href="index.html#home" class="logo">
            FARID<span>.PORTFOLIO</span>
        </a>

        <ul class="nav-links">
            <li><a href="index.html#home">Home</a></li>
            <li><a href="index.html#about">Tentang</a></li>
            <li><a href="index.html#education">Pendidikan</a></li>
            <li><a href="index.html#skills">Skill</a></li>
            <li><a href="index.html#projects">Proyek</a></li>

            <li>
                <a
                    href="kontak.php"
                    class="nav-contact"
                    aria-current="page"
                >
                    Kontak
                </a>
            </li>
        </ul>

    </nav>
</header>

<main class="page-main container">

    <div class="page-heading">

        <span class="section-label">
            Hubungi Saya
        </span>

        <h1>Mari terhubung.</h1>

        <p>
            Isi formulir berikut untuk menyampaikan pertanyaan,
            ide, atau pesan kepada saya.
        </p>

    </div>

    <?php if ($berhasil): ?>

        <div class="status-message" role="status">

            <h2>Pesan berhasil dikirim!</h2>

            <p>
                Terima kasih sudah menghubungi saya.
                Pesan Anda berhasil disimpan.
            </p>

        </div>

    <?php else: ?>

        <?php if ($error !== ''): ?>

            <div class="status-message" role="alert">

                <p class="form-error">
                    <?= escapeHtml($error) ?>
                </p>

            </div>

        <?php endif; ?>

        <form
            action="kontak.php"
            method="POST"
            class="page-form"
        >

            <div class="form-group">

                <label for="nama">
                    Nama lengkap
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    maxlength="100"
                    value="<?= escapeHtml($nama) ?>"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="name"
                    required
                >

            </div>

            <div class="form-group">

                <label for="email">
                    Alamat email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    maxlength="254"
                    value="<?= escapeHtml($email) ?>"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                >

            </div>

            <div class="form-group">

                <label for="pesan">
                    Pesan
                </label>

                <textarea
                    id="pesan"
                    name="pesan"
                    maxlength="5000"
                    rows="6"
                    placeholder="Tulis pesan di sini..."
                    required
                ><?= escapeHtml($pesan) ?></textarea>

            </div>

            <button
                type="submit"
                class="button button-primary"
            >
                Kirim Pesan ↗
            </button>

        </form>

    <?php endif; ?>

    <a
        href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=faridzaidan3@gmail.com"
        target="_blank"
        rel="noopener noreferrer"
        class="back-link"
    >
        Atau kirim langsung melalui Gmail ↗
    </a>

    <p>
        <a href="index.html#contact" class="back-link">
            ← Kembali ke portfolio
        </a>
    </p>

</main>

<footer class="footer">

    <div class="container footer-content">

        <p>
            © <?= date('Y') ?> Muhammad Farid Zaidaan.
            Dibuat untuk portfolio pribadi.
        </p>

        <div class="footer-links">

            <a href="index.html#home">
                Kembali ke atas ↑
            </a>

            <a href="index.html#about">
                Tentang
            </a>

            <a href="index.html#contact">
                Kontak
            </a>

        </div>

    </div>

</footer>

</body>
</html>
