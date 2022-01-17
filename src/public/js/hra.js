let textArea = document.querySelector(".textArea");
let rewriteText = document.querySelector(".rewriteText");
let autor = document.querySelector(".autor");
let casovacElement = document.querySelector(".timer");
const DEFAULT_TIME = 60;
let casovac = null;


const hlaskyPolitikov = [
    ["Žiaden človek nedokáže dať toľko lásky človeku, ako dokáže len človek človeku.", "Kpt.JUDr.Danko"],
    ["Dočkaj času jak hus klasu. Prepáčte, že tykám.", "Mgr.Igor Matovič"],
    ["Môžem vám aj za-re-po-vať.", "JUDr. Štefan Harabin"],
    ["Preto som sa rozhodol tu, z tejto maštale povedať pravdu slovenskej verejnosti!", "Ing. Miroslav Jureňa"],
    ["Z dlhodobého hľadiska sme všetci mŕtvi.", "Ing. Richard Sulík"],
    ["My pôjdeme do tankoch a pôjdeme a zrovnáme Budapešť!", "Ing. Ján Slota"],
    ["Prosím vás neotravujte tu sme pri žatve.", "Doc JUDr Robert Fico, CSc"],
    ["Tá choroba existuje, ale je vymyslená a je to ďalší druh chrípky.", "Ing. Mgr Marian Kotleba"]
];

let aktualnaHlaska = dajHlasku();
let aktualnyText = "";

let uplynulyCas = 0;
let zostavajuciCas = 60;

function inizializuj() {
    rewriteText.innerText = aktualnaHlaska[0];
    autor.innerText = aktualnaHlaska[1];

    textArea.addEventListener('click', spustiHru);
    textArea.addEventListener('input', spracujAktualnyText);
}

function dajHlasku() {
    let dlzka = hlaskyPolitikov.length;
    let rndIndex = Math.floor(Math.random() * dlzka);
    return hlaskyPolitikov[rndIndex];
}

function spracujAktualnyText() {
    aktualnyText = textArea.value;
    if (aktualnyText.length < aktualnaHlaska[0].length) {
        aktualnyTextZnaky = aktualnyText.split('');
        spansAll = document.querySelectorAll('.span_char');
        spansAll.forEach((aktualnySpan, index) => {
            aktualnyZnak = aktualnyTextZnaky[index];

            if (aktualnyZnak == null) {
                aktualnySpan.classList.remove('matchOK');
                aktualnySpan.classList.remove('matchNOK');
            } else if (aktualnyZnak === aktualnySpan.innerText) {
                aktualnySpan.classList.add('matchOK');
                aktualnySpan.classList.remove('matchNOK');
            } else {
                aktualnySpan.classList.add('matchNOK');
                aktualnySpan.classList.remove('matchOK');
            }
        });
    }
}

function spustiHru() {

    oznacZnaky();

    clearInterval(casovac);
    casovac = setInterval(updateTime, 1000);
}

function oznacZnaky() {
    rewriteText.innerText = "";
    aktualnaHlaska[0].split('').forEach(znak => {
        let span = document.createElement('span');
        span.classList.add('span_char');
        span.innerText = znak;
        rewriteText.appendChild(span);
    });
}

function updateTime() {
    if (zostavajuciCas > 0) {
        zostavajuciCas--;
        uplynulyCas++;
        casovacElement.innerText = `Zostáva: ${zostavajuciCas} s`;
    } else {
        ukonciHru();
    }
}

function resetTime() {

}

function ukonciHru() {

}

inizializuj();