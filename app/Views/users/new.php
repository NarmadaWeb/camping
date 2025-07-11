<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="container mx-auto p-4 max-w-xl bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">Create New User</h1>

        <?php if (isset($validation) && $validation->getErrors()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Please correct the following errors:</span>
                <ul class="mt-2 list-disc list-inside">
                    <?php foreach ($validation->getErrors() as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?= form_open('/users/create', ['class' => 'space-y-4']) ?>
            <div>
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                <input type="text" id="username" name="username" value="<?= old('username') ?>" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline 
                              <?= (isset($validation) && $validation->hasError('username')) ? 'border-red-500' : '' ?>">
            </div>

            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              <?= (isset($validation) && $validation->hasError('email')) ? 'border-red-500' : '' ?>">
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300">
                    Submit
                </button>
                <a href="<?= url_to('User::index') ?>" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                    Back to User List
                </a>
            </div>
        <?= form_close() ?>
    </div>
</body>
</html>
