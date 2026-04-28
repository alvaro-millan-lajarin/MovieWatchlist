<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieWatchlist - Favorites</title>
    <link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/movies.css') ?>">
</head>
<body>

<div class="background"></div>

<div class="container home-container">

    <header class="header">
        <h1>MovieWatchlist</h1>
    </header>

    <nav class="nav-menu">
        <ul>
            <li><a href="<?= site_url('/') ?>">Home</a></li>
            <li><a href="<?= site_url('/movies') ?>">Movies Search</a></li>
            <li><a href="<?= site_url('/favorites') ?>">Favorites</a></li>
            <li><a href="<?= site_url('/shared') ?>">Shared Movies</a></li>
            <li><a href="<?= site_url('/logout') ?>">Logout</a></li>
        </ul>
    </nav>

    <h2 class="page-title">My Favorites</h2>

    <?php if (empty($movies)): ?>
        <p>You have no favorite movies yet.</p>
    <?php else: ?>
        <div class="movies-grid">
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card" onclick="window.location='<?= site_url('/movie/' . $movie['api_id']) ?>'">
                    <img src="<?= esc($movie['poster']) ?>" alt="<?= esc($movie['title']) ?>">
                    <div class="movie-card-info">
                        <h3><?= esc($movie['title']) ?></h3>
                        <p><?= esc($movie['year']) ?></p>
                        <p class="movie-intro"><?= esc(substr($movie['introduction'], 0, 120)) ?>...</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>