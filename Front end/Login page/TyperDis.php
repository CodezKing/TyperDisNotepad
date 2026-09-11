<?php

$errors = [];

function validateEmail($email)
{
    if (empty($email)) {
        return 'Email is required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email format.';
    }

    return null;
}

$email = $_POST['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors['email'] = validateEmail($email);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-amber-300">

    <!-- Open Button -->

    <button
        type="button"
        onclick="openWindow()"
        class="m-6 text-white border-white border-solid border py-3 px-5 hover:bg-white hover:text-black transition-colors">

        Open Window

    </button>

    <!-- Login Window -->

    <div
        id="wrapper"
        class="bg-white h-[420px] absolute p-6 rounded-lg shadow-md w-[350px] space-y-4 hidden left-0 right-0 top-0 bottom-0 m-auto">

        <!-- Header -->

        <div
            id="header"
            class="flex justify-between cursor-move text-black p-6 bg-white border-2 rounded-t-2xl w-[350px] relative bottom-[30px] left-[-24px] m-auto">

            <div
                id="actions"
                class="float-right absolute right-[30px] flex gap-3 cursor-pointer"
                onmousedown="event.stopPropagation(); event.stopImmediatePropagation(); event.preventDefault();">

                <i class="fa fa-window-minimize" onclick="toggleMinimize()"></i>

                <i class="fa fa-window-maximize" onclick="toggleMaximize()"></i>

                <i class="fa fa-window-close" onclick="closeWindow()"></i>

            </div>
        </div>

        <!-- Form -->

        <form method="POST">

            <!-- Profile Image -->

            <div class="flex justify-center">

                <img
                    class="w-24 h-24 rounded-full object-cover"
                    src="Image/profile1-removebg-preview.png"
                    alt="Profile Image">

            </div>

            <!-- Email -->

            <div>

                <label for="email" class="block text-black mb-1">
                    Email:
                </label>

                <input
                    class="w-full border border-black rounded-md p-2"
                    type="email"
                    name="email"
                    id="email"
                    value="<?= htmlspecialchars($email) ?>"
                    required>

                <?php if (!empty($errors['email'])) : ?>

                    <p class="text-red-500 text-sm mt-1">
                        <?= $errors['email'] ?>
                    </p>

                <?php endif; ?>

            </div>

            <!-- Password -->

            <div>

                <label for="password" class="block text-black mb-1">
                    Password:
                </label>

                <input
                    class="w-full border border-black rounded-md p-2 mb-4"
                    type="password"
                    name="password"
                    id="password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters"
                    required>

            </div>

            <!-- Login Button -->

            <button
                class="w-full bg-gray-600 hover:bg-gray-800 text-white p-2 rounded-md transition duration-300"
                type="submit">

                Login

            </button>

            <!-- Create Profile -->

            <div class="text-center mt-3">

                <a href="Profile.php" class="text-blue-600 hover:underline">

                    Create a new profile

                </a>

            </div>

        </form>

    </div>

    <script>

        const wrapper = document.getElementById('wrapper');
        const actions = document.getElementById('actions');

        function openWindow() {

            wrapper.classList.remove('hidden');

            if (wrapper.dataset.savedLeft !== undefined) {

                if (wrapper.dataset.savedLeft)
                    wrapper.style.left = wrapper.dataset.savedLeft;
                else
                    wrapper.style.left = '';

                delete wrapper.dataset.savedLeft;
            }

            if (wrapper.dataset.savedTop !== undefined) {

                if (wrapper.dataset.savedTop)
                    wrapper.style.top = wrapper.dataset.savedTop;
                else
                    wrapper.style.top = '';

                delete wrapper.dataset.savedTop;
            }

            if (actions) {
                actions.classList.remove('hidden');
            }
        }

        function closeWindow() {
            wrapper.classList.add('hidden');
        }

        function toggleMinimize() {
            wrapper.classList.toggle('h-[420px]');
        }

        function toggleMaximize() {

            wrapper.classList.toggle('w-screen');
            wrapper.classList.toggle('h-screen');

        }

    </script>

</body>

</html>