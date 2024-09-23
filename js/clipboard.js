let clipboard = document.getElementById("clipboard");
let copyText = document.getElementById("texte");
let tooltip = document.getElementById("myTooltip");

clipboard.addEventListener("click", function () {
    navigator.clipboard.writeText(copyText.innerText);

    tooltip.innerText = "Copié";

    clipboard.addEventListener("mouseout", function () {
        tooltip.innerText = "Copier";
    });
});

function playMorseSound(morse, speed = 30) {
    const dotSound = document.getElementById('dotSound');
    const dashSound = document.getElementById('dashSound');

    const dotDuration = 5000 / speed;
    const dashDuration = 11000 / speed;
    const symbolPause = (speed  * 100) / speed;
    const letterPause = 10000 / speed;

    let timeOffset = 0;

    morse.split('').forEach((symbol) => {
        setTimeout(() => {
            if (symbol === '.') {
                dotSound.play(); 
            } else if (symbol === '-') {
                dashSound.play();
            } else if (symbol === ' ') {
           
                setTimeout(() => { }, letterPause);
            }
        }, timeOffset);

        if (symbol === '.') {
            timeOffset += dotDuration + symbolPause;
        } else if (symbol === '-') {
            timeOffset += dashDuration + symbolPause;
        } else if (symbol === ' ') {
            timeOffset += letterPause;
        }
    });
}

document.getElementById('playMorseButton').addEventListener('click', function () {
    let morseMessage = copyText.innerText;
    playMorseSound(morseMessage, 30);
});
