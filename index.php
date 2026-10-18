<?php

// ============================================================
// THE CASTLE - STORY EDITION
// PHP CLI | ANSI colors | ASCII animations | 2 endings
// ============================================================

// ---------- TERMINAL / COLORS ----------

const RESET   = "\033[0m";
const RED     = "\033[31m";
const GREEN   = "\033[32m";
const YELLOW  = "\033[33m";
const BLUE    = "\033[34m";
const MAGENTA = "\033[35m";
const CYAN    = "\033[36m";
const WHITE   = "\033[37m";
const BOLD    = "\033[1m";
const DIM     = "\033[2m";

function color($text, $color)
{
    return $color . $text . RESET;
}

function clearScreen()
{
    // ANSI clear-screen + cursor-home
    echo "\033[2J\033[H";
}

function hideCursor()
{
    echo "\033[?25l";
}

function showCursor()
{
    echo "\033[?25h";
}

function typeText($text, $speed = 15000)
{
    $characters = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($characters as $character) {
        echo $character;
        flush();

        if ($speed > 0) {
            usleep($speed);
        }
    }
}

function pauseGame($seconds = 1)
{
    sleep($seconds);
}

function normalizeAnswer($answer)
{
    // UTF-8 Hungarian uppercase handling without requiring mbstring.
    $answer = strtr(trim($answer), [
        'Á' => 'á', 'É' => 'é', 'Í' => 'í',
        'Ó' => 'ó', 'Ö' => 'ö', 'Ő' => 'ő',
        'Ú' => 'ú', 'Ü' => 'ü', 'Ű' => 'ű'
    ]);

    $answer = strtolower($answer);

    return strtr($answer, [
        'á' => 'a', 'é' => 'e', 'í' => 'i',
        'ó' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ú' => 'u', 'ü' => 'u', 'ű' => 'u'
    ]);
}

function loading($text, $color = CYAN)
{
    echo "\n";
    typeText($text, 25000);

    for ($i = 0; $i < 3; $i++) {
        echo color(".", $color);
        flush();
        usleep(350000);
    }

    echo "\n\n";
    pauseGame(1);
}

function scene($title, $description)
{
    echo "\n";
    echo color("╔══════════════════════════════════════════════════╗\n", MAGENTA);
    echo color("  " . $title . "\n", BOLD . CYAN);
    echo color("╚══════════════════════════════════════════════════╝\n\n", MAGENTA);

    typeText($description . "\n", 12000);
    pauseGame(1);
}

function renderFrame($frame, $caption = '', $captionColor = CYAN)
{
    clearScreen();
    echo "\n";
    echo $frame . "\n\n";

    if ($caption !== '') {
        echo color($caption . "\n", $captionColor);
    }

    flush();
}

// ---------- ANIMATIONS ----------

function animateTitle()
{
    $frames = [
<<<'FRAME'
                 .       *          .
          *                  .              *
                         _ .-.
             .       .-'     '-.       *
                   .'  .-----.  '.
                  /   /       \   \
             ____|___|  _____  |___|____
            |        | |     | |        |
            |  []    | |     | |   []   |
            |        |_|_____|_|        |
            |     ___   _____   ___     |
            |____|   |_|     |_|   |____|
                 |_________________|
             ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
FRAME,
<<<'FRAME'
              *          .              *
                     _ .-.
                 .-'     '-.
               .'  .-----.  '.       *
              /   /       \   \
         ____|___|  _____  |___|____
        |        | |     | |        |
        |  []    | |     | |   []   |
        |        |_|_____|_|        |
        |     ___   _____   ___     |
        |____|   |_|     |_|   |____|
             |_________________|
           ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
FRAME,
<<<'FRAME'
           .           *          .       *
                       _ .-.
                  _.-'     '-._
                .'   .-----.   '. 
               /    /       \    \
          ____|____|  _____  |____|____
         |         | |     | |         |
         |   []    | |     | |    []   |
         |         |_|_____|_|         |
         |      ___   _____   ___      |
         |_____|   |_|     |_|   |_____|
               |_________________|
            ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
FRAME
    ];

    for ($cycle = 0; $cycle < 2; $cycle++) {
        foreach ($frames as $frame) {
            clearScreen();
            echo "\n\n";
            echo color($frame, BLUE) . "\n";
            echo color("               R I D D L E   Q U E S T\n", BOLD . MAGENTA);
            echo color("                  STORY EDITION\n", CYAN);
            usleep(450000);
        }
    }

    clearScreen();
    echo color(<<<'TITLE'

╔════════════════════════════════════════════════════╗
║                                                    ║
║                 RIDDLE QUEST                       ║
║                STORY EDITION                       ║
║                                                    ║
║            A KASTÉLY TITKOS REJTÉLYE               ║
║                                                    ║
╚════════════════════════════════════════════════════╝

TITLE, BOLD . MAGENTA);
    pauseGame(1);
}

function animateCastle()
{
    $frames = [
<<<'FRAME'
           .       *             .         *
                      .-.
                 .-'       '-.
              .'   .-------.   '.      .
             /    /  _____  \    \
        ____|____|  |     |  |____|____
       |         |  | []  |  |         |
       |  []     |  |_____|  |     []  |
       |_________|___________|_________|
       |     ___     _____     ___      |
       |____|   |___|     |___|   |_____|
               |_________________|
        ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
FRAME,
<<<'FRAME'
      *        .          *              .
                   .-.
              _.-'     '-._
            .'  .-------.  '.        *
           /   /  _____  \   \
      ____|___|  |     |  |___|____
     |        |  | []  |  |        |
     |  []    |  |_____|  |    []  |
     |________|___________|________|
     |    ___    _______    ___     |
     |___|   |__|       |__|   |____|
            |_________________|
      ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
FRAME,
<<<'FRAME'
           .             *          .
                  _.-^-._
                .'  ___  '.
               /   /   \   \
          ____|___|_____|___|____
         |       |  []  |       |
         |  []   |______|   []  |
         |______________________|
         |   ___    ___    ___   |
         |__|   |__|   |__|   |__|
               |_____________|
       ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
FRAME
    ];

    for ($cycle = 0; $cycle < 3; $cycle++) {
        foreach ($frames as $i => $frame) {
            renderFrame($frame, "A köd sűrűsödik... a kastély fényei pislákolnak.", $i === 1 ? MAGENTA : BLUE);
            usleep(450000);
        }
    }

    typeText("\nA kastély kapuja előtt állsz. A szél a nevedet suttogja...\n\n", 25000);
    pauseGame(1);
}

function animateGate()
{
    $frames = [
<<<'FRAME'
       ╔══════════════════════════════╗
       ║          A KŐKAPU            ║
       ║       ┌────────────┐         ║
       ║       │     ?      │         ║
       ║       │            │         ║
       ║       │            │         ║
       ╚═══════╧════════════╧═════════╝
FRAME,
<<<'FRAME'
       ╔══════════════════════════════╗
       ║          A KŐKAPU            ║
       ║       ┌──────┬─────┐         ║
       ║       │      │     │         ║
       ║       │      │     │         ║
       ║       │      │     │         ║
       ╚═══════╧══════╧═════╧═════════╝
FRAME,
<<<'FRAME'
       ╔══════════════════════════════╗
       ║          A KŐKAPU            ║
       ║       ┌───┐        ┌───┐     ║
       ║       │   │        │   │     ║
       ║       │   │        │   │     ║
       ║       │   │        │   │     ║
       ╚═══════╧═══╧════════╧═══╧═════╝
FRAME,
<<<'FRAME'
       ╔══════════════════════════════╗
       ║          A KŐKAPU            ║
       ║       │   │          │   │   ║
       ║       │   │          │   │   ║
       ║       │   │          │   │   ║
       ║       │   │          │   │   ║
       ╚═══════╧═══╧══════════╧═══╧═══╝
FRAME
    ];

    foreach ($frames as $i => $frame) {
        renderFrame($frame, "A nehéz kőkapu lassan megmozdul...", $i === 3 ? GREEN : YELLOW);
        usleep(500000);
    }

    clearScreen();
    typeText(color("\nA KAPU KITÁRULT!\n\n", BOLD . GREEN), 30000);
    pauseGame(1);
}

function animateGhost()
{
    $frames = [
<<<'FRAME'
                    .-""""-.
                   /  .--.  \
                  |  /    \  |
                  | | o  o | |
                  | |  __  | |
                   \ \____/ /
                    '------'
                      ||
                   .--||--.
                  /   ||   \
                 /    ||    \
                /     ||     \
               '--------------'
FRAME,
<<<'FRAME'
                      .-""""-.
                     /  .--.  \
                    |  /    \  |
                    | | O  O | |
                    | |  __  | |
                     \ \____/ /
                      '------'
                   ___/ || \___
                  /     ||     \
                 /      ||      \
                /       ||       \
               '------------------'
FRAME,
<<<'FRAME'
                    .-""""-.
                   /  .--.  \
                  |  /    \  |
                  | | @  @ | |
                  | |  --  | |
                   \ \____/ /
                    '------'
                    \  ||  /
                     \ || /
                  .---\\||//---.
                 /      ||      \
                /       ||       \
               '------------------'
FRAME,
<<<'FRAME'
                      .-""""-.
                     /  .--.  \
                    |  /    \  |
                    | | O  O | |
                    | |  __  | |
                     \ \____/ /
                      '------'
                        ||
                      __||__
                     /  ||  \
                    /   ||   \
                   '----------'
FRAME
    ];

    for ($cycle = 0; $cycle < 3; $cycle++) {
        foreach ($frames as $i => $frame) {
            renderFrame($frame, "A SZELLEM FELEMELKEDIK A SÖTÉTSÉGBŐL...", $i === 2 ? RED : MAGENTA);
            usleep(300000);
        }
    }

    clearScreen();
    typeText(color("\"HALANDÓ... VÉGRE MEGÉRKEZTÉL.\"\n\n", BOLD . MAGENTA), 45000);
    pauseGame(1);
}

function animateChest()
{
    $frames = [
<<<'FRAME'
                   __________________
                  /_________________/|
                 |                 | |
                 |   KINCSLÁDA     | |
                 |_________________|/
FRAME,
<<<'FRAME'
                   __________________
                  /_______________ /|
                 /_______________/ ||
                |                 | ||
                |   KINCSLÁDA     | /
                |_________________|/
FRAME,
<<<'FRAME'
                       _____________
                      /___________ /|
                     /___________/ ||
                    /____________\ ||
                   |              | |
                   |   KINCSLÁDA  | /
                   |______________|/
FRAME,
<<<'FRAME'
                         *  .  *
                     .     |     .
                       \   |   /
                    _____\ | /_____
                   /_____________/|
                  | *  ARANYKINC S| |
                  |_______________|/
                     *  *  *  *  *
FRAME,
<<<'FRAME'
              *       .       *       .
                   \    |    /
                *   \   |   /   *
                     \  |  /
                 _____\ | /_____
                /_____________/|
               |  $  $  $  $  | |
               |  $  ARANY  $  | /
               |_______________|/
              *   *   *   *   *   *
FRAME
    ];

    foreach ($frames as $i => $frame) {
        renderFrame($frame, $i < 3 ? "A zár kattan... a fedél megmozdul..." : "A KINCS FÉNYE BETÖLTI A TERMET!", $i < 3 ? YELLOW : BOLD . YELLOW);
        usleep($i < 3 ? 450000 : 650000);
    }

    typeText(color("\nA láda kinyílt! A kincs a tiéd!\n\n", BOLD . YELLOW), 25000);
    pauseGame(1);
}

function animateBadEnding()
{
    $frames = [
<<<'FRAME'
        .------------------------------------------------.
        |                                                |
        |                 .-""""-.                       |
        |                /  X  X  \                      |
        |               |    __    |                     |
        |                \  \__/  /                      |
        |                 '------'                       |
        |                                                |
        |               NINCS KIUT...                    |
        '------------------------------------------------'
FRAME,
<<<'FRAME'
        .------------------------------------------------.
        |   !!!                                          |
        |                 .-""""-.                       |
        |                /  @  @  \                      |
        |               |    --    |                     |
        |                \  ____  /                      |
        |                 '------'                       |
        |                                                |
        |              OROKRE ITT MARADSZ                |
        '------------------------------------------------'
FRAME,
<<<'FRAME'
        .------------------------------------------------.
        |  !!!  !!!  !!!                                 |
        |                 .-""""-.                       |
        |                /  @  @  \                      |
        |               |   \__/   |                     |
        |                \  ____  /                      |
        |                 '------'                       |
        |                                                |
        |                 NINCS KIUT                     |
        '------------------------------------------------'
FRAME
    ];

    for ($cycle = 0; $cycle < 3; $cycle++) {
        foreach ($frames as $i => $frame) {
            renderFrame($frame, "A SZELLEM LECSAP!", $i === 1 ? BOLD . RED : RED);
            usleep(250000);
        }
    }

    clearScreen();
    typeText(color("\nA SZELLEM ELKAPOTT...\n", BOLD . RED), 50000);
    pauseGame(2);
}

function animateTrap()
{
    $frames = [
<<<'FRAME'
          ______________________________
         |                              |
         |         KŐKAPU               |
         |                              |
         |                              |
         |______________________________|
FRAME,
<<<'FRAME'
          ______________________________
         |                              |
         |   ||                    ||   |
         |   ||                    ||   |
         |___||____________________||___|
FRAME,
<<<'FRAME'
          ______________________________
         |   ||                    ||   |
         |   ||      FOGOLY        ||   |
         |___||____________________||___|
             ||                    ||
             ||____________________||
FRAME
    ];

    foreach ($frames as $frame) {
        renderFrame($frame, "A kőajtó becsapódik mögötted...", RED);
        usleep(400000);
    }
}

// ---------- RIDDLE SYSTEM ----------

function playChallenge($title, $question, $answers, $hint)
{
    scene($title, $question);
    $attempts = 3;

    $normalizedAnswers = array_map('normalizeAnswer', $answers);

    while ($attempts > 0) {
        echo color("Próbálkozások: ", YELLOW) . color((string)$attempts, BOLD . YELLOW) . "\n";
        $answer = normalizeAnswer(readline(color("Válaszod (vagy 'tipp'): ", CYAN)));

        if ($answer === 'tipp') {
            typeText(color("\nA titok hangja: ", MAGENTA) . $hint . "\n\n", 18000);
            continue;
        }

        if (in_array($answer, $normalizedAnswers, true)) {
            loading("Valami megmozdul", GREEN);
            typeText(color("Helyes válasz! A titok feltárult előtted...\n\n", BOLD . GREEN), 18000);
            return true;
        }

        $attempts--;
        typeText(color("\nA válaszod nem helyes.\n", RED));

        if ($attempts > 0) {
            typeText("Próbáld újra, kalandor!\n\n", 15000);
        }
    }

    typeText(color("\nA sötétség lassan körülvesz...\n", RED));
    typeText(color("Elfogytak a próbálkozásaid. GAME OVER.\n", BOLD . RED));

    return false;
}

// ---------- GAME START ----------

hideCursor();

try {
    animateTitle();

    $name = trim(readline(color("\nMi a neved, kalandor? ", CYAN)));

    if ($name === '') {
        $name = 'Kalandor';
    }

    typeText(color("\nÜdvözöllek, " . $name . "...\n", BOLD . GREEN), 35000);
    pauseGame(1);

    typeText("\nEgy hideg őszi estén egy régi térképre bukkansz.\n", 14000);
    typeText("A térkép egy elfeledett kastélyhoz vezet.\n", 14000);
    typeText("A legenda szerint odabent egy ősi titok rejtőzik.\n\n", 14000);

    $start = normalizeAnswer(readline(color("Elfogadod a küldetést? (igen/nem): ", YELLOW)));

    if ($start !== 'igen') {
        typeText("\nA térkép lassan elhalványul a kezedben...\n");
        typeText("Talán egy másik napon visszatérsz.\n");
        exit;
    }

    loading("A kaland elkezdődik", MAGENTA);

    // CHAPTER 1
    animateCastle();

    scene(
        "1. FEJEZET - A KÓDOS KAPU",
        "Hosszú séta után megérkezel a kastélyhoz.\n"
        . "A hatalmas kapun egy felirat világít a holdfényben.\n"
        . "A zár csak akkor nyílik ki, ha megfejted a talányt."
    );

    if (!playChallenge(
        "Az első talány",
        "Mi az, ami mindig előtted van, de sosem láthatod?",
        ["jövő", "a jövő"],
        "Gondolj arra, ami még nem történt meg."
    )) {
        exit;
    }

    animateGate();

    // CHAPTER 2
    scene(
        "2. FEJEZET - A KŐKAMRA",
        "Odabent poros folyosón haladsz végig.\n"
        . "Egy hatalmas kőajtó állja utadat.\n"
        . "A falon egy újabb talány jelenik meg..."
    );

    if (!playChallenge(
        "A második talány",
        "Minél többet veszel el belőle, annál nagyobb lesz. Mi az?",
        ["gödör", "egy gödör"],
        "A földben találod, és ásással lehet nagyobbá tenni."
    )) {
        exit;
    }

    // CHAPTER 3
    scene(
        "3. FEJEZET - A KÍSÉRTET",
        "A kincsesláda már csak néhány lépésre van tőled...\n"
        . "Ám hirtelen különös, mély morajlás rázza meg a termet.\n"
        . "A fáklyák lángja vadul táncolni kezd, majd egyenként kialszanak.\n\n"
        . "Sötétség borul mindenre.\n"
        . "Jéghideg szél söpör végig a termen, pedig az ablakok zárva vannak.\n"
        . "A tarkódon érzed, hogy valaki figyel.\n\n"
        . "A falak mélyéről halk kaparászás hallatszik...\n"
        . "Kaparászás, mintha valaki a túloldalról próbálna áttörni.\n\n"
        . "Aztán csend.\n"
        . "Olyan mély csend, hogy még a saját lélegzetedet is túl hangosnak érzed.\n\n"
        . "A terem túlsó végében egy árnyék mozdul meg.\n"
        . "Nem jár. Nem lépked. Lassan, természetellenesen lebeg feléd.\n"
        . "Az alak áttetsző teste átsiklik a köveken, feje pedig lassan oldalra billen.\n\n"
        . "Két üres szemgödör mered rád.\n"
        . "Aztán a sötétségből egy rekedt, túlvilági hang szólal meg:\n\n"
        . "\"Már régóta vártalak, halandó...\"\n"
        . "\"Sokan jöttek már a kincsért. Egyikük sem távozott.\"\n\n"
        . "A szellem közelebb lebeg.\n"
        . "Jéghideg ujjával a kincsesláda felé mutat.\n\n"
        . "\"Ha a kincsre vágysz, felelj az utolsó kérdésemre...\"\n"
        . "\"De jól gondold meg a válaszodat.\"\n"
        . "\"Mert ha elbuksz... itt maradsz velem. ÖRÖKRE.\""
    );
    echo "\n";
    echo color(">>> SZÓLÍTSD MEG A SZELLEMET! <<<", BOLD . RED) . "\n";
    readline(color("Nyomj ENTER-t a folytatáshoz...", CYAN));

    animateGhost();

    $finalSuccess = playChallenge(
        "Az utolsó talány",
        "Nincs testem, mégis követlek.\n"
        . "Nincs hangom, mégis utánozlak.\n"
        . "Mi vagyok?",
        ["árnyék", "a saját árnyékom", "sajat arnyekom"],
        "A fény hoz létre, és a lábadnál is megjelenhet."
    );

    // TWO ENDINGS
    clearScreen();

    if ($finalSuccess) {
        echo color(<<<'GOOD'
╔══════════════════════════════════════════════════╗
║                  JÓ BEFEJEZÉS                    ║
║                A KASTÉLY ÖRÖKÖSE                 ║
╚══════════════════════════════════════════════════╝

GOOD, BOLD . GREEN);

        echo "\n";
        typeText("A szellem mozdulatlanná dermed...\n", 25000);
        pauseGame(1);
        typeText(color("\"Helyes... Méltó vagy a titokhoz.\"\n\n", MAGENTA), 35000);
        pauseGame(1);

        animateChest();

        typeText("\nA kincsesláda felnyílik, és aranyfény tölti be a termet!\n", 18000);
        typeText("A szellem meghajol előtted, majd lassan eltűnik.\n\n", 18000);
        typeText(color("A kastély mostantól a tiéd, " . $name . "!\n", BOLD . GREEN), 25000);
        typeText("Nemcsak a kincset szerezted meg, hanem a kastély titkát is megfejtetted.\n\n");
        echo color("       *  KÜLDETÉS TELJESÍTVE!  *\n\n", BOLD . YELLOW);
    } else {
        echo color(<<<'BAD'
╔══════════════════════════════════════════════════╗
║                 ROSSZ BEFEJEZÉS                  ║
║                 A KASTÉLY FOGLYA                 ║
╚══════════════════════════════════════════════════╝

BAD, BOLD . RED);

        animateBadEnding();

        typeText(color("\"Rossz válasz, halandó! A kastély most már nem enged el.\"\n\n", RED), 30000);
        animateTrap();

        typeText("A szellem nevetése végigvisszhangzik a folyosókon...\n\n", 20000);
        typeText("A történeted itt véget ér, " . $name . ".\n", 20000);
        typeText("Vagy talán egyszer valaki kiszabadít...\n\n", 20000);
    }

    typeText(color("\nKöszönöm, hogy játszottál a RIDDLE QUEST-tel!\n\n", BOLD . CYAN), 20000);

} finally {
    showCursor();
    echo RESET;
}
