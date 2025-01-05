<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if($errors->any()): ?>
        <div style="color: red;">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('login.submit')); ?>" method="POST">
        <?php echo csrf_field(); ?> <!-- Token CSRF -->
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
<?php /**PATH C:\laragon\www\utsframework\resources\views/login.blade.php ENDPATH**/ ?>