<?php

$portfolio = [
    [
        "title" => "Muhammad Farid Zaidaan",
        "description" => "Mahasiswa Sistem Informasi yang ingin terus belajar, mengembangkan kemampuan, menambah pengalaman, dan mempersiapkan diri menghadapi dunia kerja.",
        "category" => "Profil",
        "keywords" => "Farid mahasiswa student portfolio"
    ],
    [
        "title" => "STMIK Rosma Karawang",
        "description" => "Mempelajari teknologi informasi, pengolahan data, pemecahan masalah, dan perancangan solusi digital.",
        "category" => "Pendidikan",
        "keywords" => "STMIK Rosma Karawang perguruan tinggi kuliah Sistem Informasi"
    ],
    [
        "title" => "SMK Rosma Karawang",
        "description" => "Mempelajari infrastruktur jaringan dan konfigurasi MikroTik serta menjalani pengalaman magang selama enam bulan di Hotel Resinda.",
        "category" => "Pendidikan & Pengalaman",
        "keywords" => "SMK Rosma jaringan MikroTik magang Hotel Resinda"
    ],
    [
        "title" => "Teknologi",
        "description" => "Pengetahuan dan keterampilan dasar di bidang teknologi, pengembangan website, dan komputer.",
        "category" => "Keahlian",
        "keywords" => "HTML CSS komputer MikroTik teknologi website"
    ],
    [
        "title" => "Pengembangan Diri",
        "description" => "Kemampuan yang mendukung proses belajar, penyelesaian masalah, dan pengembangan karier.",
        "category" => "Soft Skills",
        "keywords" => "Problem Solving disiplin belajar mandiri"
    ],
    [
        "title" => "Kemampuan Kerja",
        "description" => "Keterampilan dasar untuk berkolaborasi, berkomunikasi, dan menyelesaikan tanggung jawab.",
        "category" => "Soft Skills",
        "keywords" => "komunikasi kerja tim manajemen waktu"
    ],
    [
        "title" => "Website Portfolio Pribadi",
        "description" => "Website responsif untuk memperkenalkan profil, pendidikan, kemampuan, dan proyek menggunakan HTML dan CSS.",
        "category" => "Proyek",
        "keywords" => "website portfolio HTML CSS Responsive Design"
    ],
    [
        "title" => "Proyek Akademik",
        "description" => "Proyek pembelajaran dan tugas akademik yang mendukung pemahaman materi, kerja sama, dan pengembangan kemampuan di bidang Sistem Informasi.",
        "category" => "Proyek",
        "keywords" => "tugas akademik pembelajaran Sistem Informasi"
    ],
    [
        "title" => "Kontak dan Media Sosial",
        "description" => "Informasi kontak melalui email, Instagram, dan LinkedIn.",
        "category" => "Kontak",
        "keywords" => "email faridzaidan3@gmail.com Instagram faridzaidan3 LinkedIn"
    ]
];

/
function aman($teks)
{
    return htmlspecialchars(
        (string) $teks,
        ENT_QUOTES,
        "UTF-8"
    );
}


$keyword = trim($_GET["q"] ?? "");
$hasil = [];

if ($keyword !== "") {
    foreach ($portfolio as $item) {
        $teksPencarian =
            $item["title"] . " " .
            $item["description"] . " " .
            $item["category"] . " " .
            $item["keywords"];

        if (stripos($teksPencarian, $keyword) !== false) {
            $hasil[] = $item;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pencarian Portfolio | Muhammad Farid Zaidaan</title>

    <meta
        name="description"
        content="Cari informasi profil, pendidikan, keahlian, pengalaman, dan proyek Muhammad Farid Zaidaan."
    >

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- HEADER -->
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
                    <a href="index.html#contact" class="nav-contact">
                        Kontak
                    </a>
                </li>
            </ul>

        </nav>
    </header>

    <main>

        <!-- PENCARIAN -->
        <section class="section">
            <div class="container">

                <span class="section-label">
                    Pencarian Portfolio
                </span>

                <h1 class="section-title">
                    Temukan informasi yang lu cari.
                </h1>

                <p class="section-description">
                    Cari informasi seputar profil, pendidikan,
                    kemampuan, pengalaman, dan proyek.
                </p>

                <form
                    action="search.php"
                    method="GET"
                    class="portfolio-search"
                >

                    <label for="portfolio-query">
                        Cari informasi di portfolio
                    </label>

                    <div class="portfolio-search-row">

                        <input
                            type="search"
                            id="portfolio-query"
                            name="q"
                            placeholder="Cari pendidikan, skill, HTML, MikroTik..."
                            value="<?= aman($keyword) ?>"
                            required
                        >

                        <button
                            type="submit"
                            class="button button-primary"
                        >
                            Cari
                        </button>

                    </div>

                </form>

                <!-- HASIL PENCARIAN -->
                <section aria-live="polite">

                    <h2 class="section-title">
                        Hasil Pencarian
                    </h2>

                    <?php if ($keyword === ""): ?>

                        <p class="section-description">
                            Masukkan kata kunci untuk mencari informasi portfolio.
                        </p>

                    <?php elseif (count($hasil) > 0): ?>

                        <p class="section-description">
                            Ditemukan <?= count($hasil) ?> hasil untuk
                            "<strong><?= aman($keyword) ?></strong>".
                        </p>

                        <div class="project-grid">

                            <?php foreach ($hasil as $item): ?>

                                <article class="project-card">

                                    <div class="project-content">

                                        <h3>
                                            <?= aman($item["title"]) ?>
                                        </h3>

                                        <p>
                                            <?= aman($item["description"]) ?>
                                        </p>

                                        <div class="skill-tags">
                                            <span class="skill-tag">
                                                <?= aman($item["category"]) ?>
                                            </span>
                                        </div>

                                    </div>

                                </article>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="empty-state">

                            <h3>
                                Informasi tidak ditemukan
                            </h3>

                            <p>
                                Belum ada informasi yang cocok dengan
                                kata kunci
                                "<strong><?= aman($keyword) ?></strong>".
                            </p>

                            <p>
                                Coba kata kunci seperti HTML, CSS,
                                MikroTik, pendidikan, atau proyek.
                            </p>

                        </div>

                    <?php endif; ?>

                </section>

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">

        <div class="container footer-content">

            <p>
                &copy; <?= date("Y") ?>
                Muhammad Farid Zaidaan.
                Dibuat untuk portfolio pribadi.
            </p>

            <div class="footer-links">
                <a href="index.html#home">
                    Kembali ke Beranda ↑
                </a>

                <a href="index.html#contact">
                    Kontak
                </a>
            </div>

        </div>

    </footer>

</body>

</html>
