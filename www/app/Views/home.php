<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieWatchlist - Home</title>
    <link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
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
            <?php if(session()->has('user_email')): ?>
                <li><a href="<?= site_url('/movies') ?>">Movies Search</a></li>
                <li><a href="<?= site_url('/favorites') ?>">Favorites</a></li>
                <li><a href="<?= site_url('/shared') ?>">Shared Movies</a></li>
                <li><a href="<?= site_url('/logout') ?>">Logout</a></li>
            <?php else: ?>
                <li class="disabled">Movies Search (Login required)</li>
                <li class="disabled">Favorites (Login required)</li>
                <li class="disabled">Shared Movies (Login required)</li>
                <li><a href="<?= site_url('/sign-in') ?>">Sign in</a></li>
                <li><a href="<?= site_url('/sign-up') ?>">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <h2 class="page-title">Home</h2>


    <h3 class="welcome-text">
        Hello <?= esc($username) ?>!
    </h3>
    <section class="promo">
        <div class="promo-card">
            <h3>Search Movies</h3>
            <p>Find your favorite movies quickly and easily with our advanced search tool.</p>
        </div>

        <div class="promo-card">
            <h3>Movie Details</h3>
            <p>Get detailed information about each movie including cast, genre, and ratings.</p>
        </div>

        <div class="promo-card">
            <h3>Shared Movies</h3>
            <p>Share your favorite movies with friends and explore what others are watching.</p>
        </div>
    </section>

</div>

</body>
</html>