<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h1 { color: #333; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"],
        input[type="email"] {
            width: 300px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error { color: red; font-size: 0.9em; margin-top: -5px; margin-bottom: 10px; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Create New User</h1>
    <?= \Config\Services::validation()->listErrors() ?>

    <?= form_open('/users/create') ?>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= old('username') ?>" required>
        <?php if (isset($validation) && $validation->hasError('username')): ?>
            <div class="error"><?= $validation->getError('username') ?></div>
        <?php endif; ?>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
        <?php if (isset($validation) && $validation->hasError('email')): ?>
            <div class="error"><?= $validation->getError('email') ?></div>
        <?php endif; ?>
        <br>

        <input type="submit" value="Submit">
    <?= form_close() ?>
    <p><a href="<?= url_to('User::index') ?>">Back to User List</a></p>
</body>
</html>
