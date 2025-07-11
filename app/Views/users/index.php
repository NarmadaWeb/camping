<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h1 { color: #333; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
        .add-user { display: inline-block; margin-bottom: 20px; padding: 8px 15px; background-color: #28a745; color: white; border-radius: 5px; }
        .add-user:hover { background-color: #218838; }
    </style>
</head>
<body>
    <h1>Users List</h1>
    <a href="<?= url_to('User::new') ?>" class="add-user">Add New User</a>
    <?php if (!empty($users) && is_array($users)): ?>
        <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <a href="<?= url_to('User::show', $user['id']) ?>">
                    <strong><?= esc($user['username']) ?></strong> (<?= esc($user['email']) ?>)
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>
