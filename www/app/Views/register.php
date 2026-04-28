<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="background"></div>

<div class="container">

    <div class="card">

        <h1>MovieWatchlist</h1>
        <h2>Create your account</h2>

        <form method="post" action="<?= site_url('/sign-up') ?>">




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

            <div class="form-group">
                <label>Repeat Password</label>
                <input
                        type="password"
                        name="password_repeat"
                >
                <?php if (session('errors.password_repeat')): ?>
                    <p class="error"><?= esc(session('errors.password_repeat')) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit">Register</button>
        </form>


        <p class="text-center" style="margin-top: 1rem;">
            Already have an account?
            <a href="<?= site_url('/sign-in') ?>" class="link-login">Sign in here</a>
        </p>

    </div>

</div>

</body>
</html>