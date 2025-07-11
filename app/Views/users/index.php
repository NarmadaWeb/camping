<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="container mx-auto p-4 max-w-4xl">
        <h1 class="text-3xl font-bold mb-6 text-center">Users List</h1>
        <div class="flex justify-center mb-6">
            <a href="<?= url_to('User::new') ?>" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">Add New User</a>
        </div>
        
        <?php if (!empty($users) && is_array($users)): ?>
            <ul class="space-y-4">
            <?php foreach ($users as $user): ?>
                <li class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
                    <a href="<?= url_to('User::show', $user['id']) ?>" class="block flex-grow">
                        <strong class="text-xl font-semibold text-blue-700 hover:text-blue-900 transition duration-300"><?= esc($user['username']) ?></strong> 
                        <span class="text-gray-600"> (<?= esc($user['email']) ?>)</span>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center text-gray-600 text-lg mt-8">No users found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
