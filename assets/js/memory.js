let inGame = false;

let chrono = document.getElementById("chrono");
let h = 0, m = 0, s = 0;
let minutes = 0;
let hours = 0;
chrono.innerHTML = `${h.toString().padStart(2, "0")} : \
                    ${m.toString().padStart(2, "0")} : \
                    ${s.toString().padStart(2, "0")}`;

let intervalId;
function startTimer() {
  intervalId = setInterval(function () {
    s++; if (s == 60) {s = 0; m++; if (m == 60) { m = 0; h++; } }
    chrono.innerHTML = `${h.toString().padStart(2, "0")} : \
                        ${m.toString().padStart(2, "0")} : \
                        ${s.toString().padStart(2, "0")}`;
  }, 1000);
}

function stopTimer() {
  clearInterval(intervalId);
}

let difficulty = localStorage.getItem("difficulty");
let theme = localStorage.getItem("memory-theme");

let game = document.getElementById("game");
let gameBoard = document.getElementById("game-board");
let scorePTN = document.getElementById("score");
let contentStart = document.getElementById("contentStart");

function Card(theme, name, img, nbr) {
  this.theme = theme;
  this.name = name;
  this.imgsrc = img;
  this.nbr = nbr;
}

/*          FANTASY THEME          */
// EASY
const knight = new Card(
  "Medieval",
  "Chevalier",
  "../../assets/img/memoryTheme/knight.jpeg",
  2
);
const dragon = new Card(
  "Medieval",
  "Dragon",
  "../../assets/img/memoryTheme/dragon.jpeg",
  2
);
// MEDIUM
const king = new Card(
  "Medieval",
  "Roi",
  "../../assets/img/memoryTheme/king.jpeg",
  2
);
const queen = new Card(
  "Medieval",
  "Reine",
  "../../assets/img/memoryTheme/reine.jpeg",
  2
);
//  HARD
const castle = new Card(
  "Medieval",
  "Chateau",
  "../../assets/img/memoryTheme/chateau.jpeg",
  2
);
const witch = new Card(
  "Medieval",
  "Sorciere",
  "../../assets/img/memoryTheme/sorciere.jpeg",
  2
);
/*          GREC THEME          */

let mycardsE = [knight, knight, dragon, dragon];
let mycardsM = [knight, knight, dragon, dragon, king, king, queen, queen];
let mycardsH = [
  knight,
  knight,
  dragon,
  dragon,
  king,
  king,
  queen,
  queen,
  castle,
  castle,
  witch,
  witch,
];

let mixed;
let dimension = 0;
switch (difficulty) {
  case "easy":
    dimension = 4;
    mixed = shuffle(mycardsE);
    break;

  case "medium":
    dimension = 6;
    mixed = shuffle(mycardsM);
    break;

  case "hard":
    dimension = 8;
    mixed = shuffle(mycardsH);
    break;

  default:
    break;
}

let flippedCards = [];
let matchedPairs = 0;
let currentRow;

mixed.forEach((card, index) => {
  if (index % 4 === 0 || index % 8 === 0) {
    currentRow = document.createElement("tr");
    gameBoard.appendChild(currentRow);
  }
  let cardElement = document.createElement("td");
  cardElement.classList.add("card");
  cardElement.classList.add("back");
  cardElement.dataset.index = index;
  cardElement.style.backgroundImage = `url(${card.imgsrc})`;
  cardElement.addEventListener("click", () => flipCard(cardElement));
  currentRow.appendChild(cardElement);
});

let startButton = document.createElement("button");
startButton.classList.add("button");
startButton.style.display = "flex";
startButton.style.margin = "auto";
startButton.style.zIndex = 2;
startButton.innerHTML = "Play";
startButton.addEventListener("click", () => { 
  startTimer(); 
  startButton.style.display = "none";
  gameBoard.style.filter = "none";
  inGame = true;
});
game.appendChild(startButton);

let playAgainButton = document.createElement("button");
playAgainButton.classList.add("button");
playAgainButton.innerHTML = "Play again";
playAgainButton.style.margin = ("0px 10px");
playAgainButton.addEventListener("click", () => {
  location.reload();
});
let gameSettings = document.createElement("button");
gameSettings.classList.add("button");
gameSettings.innerHTML = "Game settings";
gameSettings.style.margin = ("0px 10px");
gameSettings.addEventListener("click", () => {
  window.location.href = "http://localhost:8888/fantasy-memory/games/memory/filter.php";
});
let buttonsContainer = document.createElement("div");
buttonsContainer.style.display = "flex";
buttonsContainer.style.width = "100vw";
buttonsContainer.style.flexDirection= "row";
buttonsContainer.style.justifyContent = "center";
buttonsContainer.appendChild(playAgainButton);
buttonsContainer.appendChild(gameSettings);

function checkMatch() {
  const [card1, card2] = flippedCards;
  const index1 = card1.dataset.index;
  const index2 = card2.dataset.index;

  if (mixed[index1] === mixed[index2]) {
   card1.removeEventListener("click", () => flipCard(card1));
    card2.removeEventListener("click", () => flipCard(card2));
    matchedPairs++;
    scorePTN.innerText = matchedPairs;
    if (matchedPairs === mixed.length / 2) {
      stopTimer();
      game.appendChild(buttonsContainer);
      inGame = false;
    }
  } else {
    card1.classList.remove("flipped");
    card2.classList.remove("flipped");
    card1.classList.add("back");
    card2.classList.add("back");
  }

  flippedCards = [];
}

function flipCard(cardElement) {
  if (
    inGame && flippedCards.length < 2 &&
    !flippedCards.includes(cardElement) &&
    !cardElement.classList.contains("flipped")
  ) {
    cardElement.classList.add("flipped");
    cardElement.classList.remove("back");
    flippedCards.push(cardElement);

    if (flippedCards.length === 2) {
      setTimeout(checkMatch, 1000);
    }
  }
}

function shuffle(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}
