<?php
$letters = [
    "a" => ".-",
    "b" => "-...",
    "c" => "-.-.",
    "d" => "-..",
    "e" => ".",
    "f" => "..-.",
    "g" => "--.",
    "h" => "....",
    "i" => "..",
    "j" => ".---",
    "k" => "-.-",
    "l" => ".-..",
    "m" => "--",
    "n" => "-.",
    "o" => "---",
    "p" => ".--.",
    "q" => "--.-",
    "r" => ".-.",
    "s" => "...",
    "t" => "-",
    "u" => "..-",
    "v" => "...-",
    "w" => ".--",
    "x" => "-..-",
    "y" => "-.--",
    "z" => "--..",
    "0" => "-----",
    "1" => ".----",
    "2" => "..---",
    "3" => "...--",
    "4" => "....-",
    "5" => ".....",
    "6" => "-....",
    "7" => "--...",
    "8" => "---..",
    "9" => "----.",
    "," => "--..--",
    "." => ".-.-.-",
    "?" => "..--..",
    "!" => "-.-.--",
    "'" => ".----.",
    "(" => "-.--.-",
    ")" => "-.--.-",
    ":" => "---...",
    ";" => "-.-.-.",
    "=" => "-...-",
    "+" => ".-.-.",
    "-" => "-....-",
    "/" => "-..-.",
];

if (isset($_POST['traduire']) && !empty($_POST['texte'])) {
    $texte = explode(" ", strtolower(trim($_POST['texte'])));
    foreach ($texte as $key => $value) {
        if ($value == "/") {
            $traduction[] = "/";
        } else {
            $traduction[] = array_search($value, $letters);
        }
    }
    $traduction = implode(" ", explode("/", implode("", $traduction)));
}

if (isset($_POST['crypter']) && !empty($_POST['texteCrypt'])) {
    $texte = str_split(strtolower(trim($_POST['texteCrypt'])));
    foreach ($texte as $key => $value) {
        if (key_exists($value, $letters)) {
            $traduction[] = $letters[$value];
        } else {
            if ($value == " ") {
                $traduction[] = "  ";
            }
        }
    }
    $traduction = implode(" ", str_replace("  ", "/", $traduction));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <audio id="dotSound" src="court.wav"></audio>
    <audio id="dashSound" src="long.wav"></audio>
    <main class="w-[90%] mx-auto mt-10">

        <?php if (isset($traduction)) { ?>
            <section class="mb-5">
                <h2 class="text-3xl font-bold mb-2">Mon texte :</h2>
                <article class="border-b-2 p-3 flex items-center justify-between">
                    <p class="w-full" id="texte">
                        <?php echo $traduction; ?>
                    </p>
                    <div class="flex flex-row items-center gap-5 w-[200px]">
                        <!-- <form method="post" class="w-full">
                            <input type="text" name="audio" value="<?php echo $traduction; ?>" hidden> -->
                            <button type="button" name="lire" id="playMorseButton" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Lire le morse</button>
                        <!-- </form> -->
                        <div class="tooltip">
                            <p class="cursor-pointer" id="clipboard">
                                <span class="tooltiptext" id="myTooltip">Copier</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-5 h-5">
                                    <path d="M280 64l40 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 128C0 92.7 28.7 64 64 64l40 0 9.6 0C121 27.5 153.3 0 192 0s71 27.5 78.4 64l9.6 0zM64 112c-8.8 0-16 7.2-16 16l0 320c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16l0-320c0-8.8-7.2-16-16-16l-16 0 0 24c0 13.3-10.7 24-24 24l-88 0-88 0c-13.3 0-24-10.7-24-24l0-24-16 0zm128-8a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                                </svg>
                            </p>
                        </div>
                    </div>
                </article>
            </section>
        <?php } ?>

        <form method="post" class="mb-10">
            <textarea name="texte" rows="10" cols="50" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-3" required></textarea>
            <button type="submit" name="traduire" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Traduire</button>
        </form>
        <form method="post">
            <textarea name="texteCrypt" rows="10" cols="50" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-3" required></textarea>
            <button type="submit" name="crypter" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Convertir en morse</button>
        </form>

    </main>
    <script src="js/clipboard.js"></script>
</body>

</html>