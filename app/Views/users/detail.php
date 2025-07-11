<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail - <?= esc($user['username']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="container mx-auto p-4 max-w-2xl bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">User Detail</h1>
        <?php if (!empty($user)): ?>
            <div class="space-y-4 text-lg">
                <p><strong class="font-semibold text-gray-700 w-32 inline-block">ID:</strong> <?= esc($user['id']) ?></p>
                <p><strong class="font-semibold text-gray-700 w-32 inline-block">Username:</strong> <?= esc($user['username']) ?></p>
                <p><strong class="font-semibold text-gray-700 w-32 inline-block">Email:</strong> <?= esc($user['email']) ?></p>
            </div>
        <?php else: ?>
            <p class="text-center text-red-600 text-lg">User not found.</p>
        <?php endif; ?>
        <div class="mt-8 text-center">
            <a href="<?= url_to('User::index') ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">Back to User List</a>
        </div>
    </div>
</body>
</html>
