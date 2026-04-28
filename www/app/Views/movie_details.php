<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/movies.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/movie-details.css') ?>">
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

    <h2>Movie Details</h2>

    <div class="movie-details-card">
        <div class="movie-poster">
            <img src="<?= $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.esc($movie['poster_path']) : '' ?>" alt="Poster">
        </div>
        <div class="movie-info">
            <h1><?= esc($movie['title']) ?> (<?= substr($movie['release_date'],0,4) ?>)</h1>

            <p><strong>Genre:</strong> <?= esc($genres) ?></p>
            <p><strong>Director:</strong> <?= esc($director ?? 'N/A') ?></p>
            <p><strong>Actors:</strong> <?= esc(implode(', ', $actors) ?: 'N/A') ?></p>
            <p><?= esc($movie['overview']) ?></p>

            <div style="margin-top:1rem;">

                <form method="post" action="<?= site_url('/favorites') ?>" class="inline-form">
                    <input type="hidden" name="movie_id" value="<?= $movieDB['id'] ?>">
                    <button type="submit"><?= $isFavorite ? 'Remove from favorites' : 'Add to favorites' ?></button>
                </form>


                <form method="post" action="<?= site_url('/shared') ?>" class="inline-form">
                    <input type="hidden" name="movie_id" value="<?= $movieDB['id'] ?>">
                    <button type="submit"><?= $isShared ? 'Shared' : 'Share movie' ?></button>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <h2>Comments</h2>
    <div class="comments-section">
        <?php if(empty($comments)): ?>
            <p>No comments yet.</p>
        <?php else: ?>
            <?php foreach($comments as $c): ?>
                <div class="comment-card">
                    <p><strong><?= esc($c['user_id']) ?>:</strong> <?= esc($c['comment']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <form method="post" action="<?= site_url('/movie/'.$movieDB['api_id']) ?>" class="add-comment-form">
        <textarea name="comment" placeholder="Add your comment..." required></textarea>
        <button type="submit">Add Comment</button>
    </form>

</div>

</body>
</html>
