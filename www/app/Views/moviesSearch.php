<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies Search</title>
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

    <h2>Movies Search</h2>

    <form method="get" action="<?= site_url('/movies') ?>" class="search-box">
        <input
            type="text"
            name="query"
            placeholder="Search for a movie..."
            value="<?= esc($query) ?>"
        >
        <button type="submit">Search</button>
    </form>

    <?php if ($query && empty($movies)): ?>
        <p class="no-results">No movies found.</p>
    <?php endif; ?>

    <div class="movies-grid">
        <?php foreach ($movies as $movie): ?>
            <div class="movie-card" onclick="window.location='<?= site_url('/movie/' . $movie['id']) ?>'">
                <img src="<?= esc($movie['poster']) ?>" alt="Poster">
                <div class="movie-card-info">
                    <h3><?= esc($movie['title']) ?> (<?= esc($movie['year']) ?>)</h3>
                    <p><?= esc($movie['plot']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>