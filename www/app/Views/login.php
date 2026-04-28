<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="background"></div>

<div class="container">

    <div class="card">

        <h1>MovieWatchlist</h1>
        <h2>Sign in to your account</h2>

        <form method="post" action="<?= site_url('/sign-in') ?>">

            <?= csrf_field() ?>

            <div class="form-group">
                <label>Email</label>
                <input
                        type="text"
                        name="email"
                        value="<?= old('email') ?>"
                >
                <?php if (session('errors.email')): ?>
                    <p class="error"><?= esc(session('errors.email')) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                        type="password"
                        name="password"
                >
                <?php if (session('errors.password')): ?>
                    <p class="error"><?= esc(session('errors.password')) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit">Sign In</button>
        </form>


        <p class="text-center" style="margin-top: 1rem;">
            Don't have an account?
            <a href="<?= site_url('/sign-up') ?>">Register here</a>
        </p>

    </div>

</div>

</body>
</html>