<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail - <?= esc($user['username']) ?></title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h1 { color: #333; }
        p { margin-bottom: 10px; }
        strong { display: inline-block; width: 100px; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>User Detail</h1>
    <?php if (!empty($user)): ?>
        <p><strong>ID:</strong> <?= esc($user['id']) ?></p>
        <p><strong>Username:</strong> <?= esc($user['username']) ?></p>
        <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
    <p><a href="<?= url_to('User::index') ?>">Back to User List</a></p>
</body>
</html>
