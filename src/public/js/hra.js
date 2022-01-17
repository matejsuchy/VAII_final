let textArea = document.querySelector(".textArea");
let rewriteText = document.querySelector(".rewriteText");
let autor = document.querySelector(".autor");
let casovacElement = document.querySelector(".timer");
const DEFAULT_TIME = 60;
let casovac = null;

const RANDOM_QUOTE_API_URL = "http://api.quotable.io/random";

let aktualnaHlaska;
let aktualnyText = "";

let uplynulyCas = 0;
let zostavajuciCas = 60;

async function inizializuj() {
  aktualnaHlaska = await dajHlasku();
  rewriteText.innerText = aktualnaHlaska.content;
  autor.innerText = aktualnaHlaska.author;

  textArea.addEventListener("click", spustiHru);
  textArea.addEventListener("input", spracujAktualnyText);
}

function dajHlasku() {
  return fetch(RANDOM_QUOTE_API_URL)
    .then((response) => response.json())
    .then((data) => data);
}

function spracujAktualnyText() {
  let finsihed = true;
  aktualnyText = textArea.value;
  if (aktualnyText.length < aktualnaHlaska.content.length) {
    aktualnyTextZnaky = aktualnyText.split("");
    spansAll = document.querySelectorAll(".span_char");
    spansAll.forEach((aktualnySpan, index) => {
      aktualnyZnak = aktualnyTextZnaky[index];

      if (aktualnyZnak == null) {
        aktualnySpan.classList.remove("matchOK");
        aktualnySpan.classList.remove("matchNOK");
        finsihed = false;
      } else if (aktualnyZnak === aktualnySpan.innerText) {
        aktualnySpan.classList.add("matchOK");
        aktualnySpan.classList.remove("matchNOK");
      } else {
        aktualnySpan.classList.add("matchNOK");
        aktualnySpan.classList.remove("matchOK");
        finsihed = false;
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
  aktualnaHlaska.content.split("").forEach((znak) => {
    let span = document.createElement("span");
    span.classList.add("span_char");
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

function resetTime() {}

function ukonciHru() {}

inizializuj();
