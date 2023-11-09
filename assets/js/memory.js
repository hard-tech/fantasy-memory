let inGame = false;

let chrono = document.getElementById("chrono");
let h = 0, m = 0, s = 0, ms = 0, score = 0;
chrono.innerHTML = `${h.toString().padStart(2, "0")} : \
                    ${m.toString().padStart(2, "0")} : \
                    ${s.toString().padStart(2, "0")} : \
                    ${ms.toString().padStart(2, "0")}`;

let intervalId;
function startTimer() {
  intervalId = setInterval(function () {
    ms+=10; score++;
    if (ms == 1000) { 
      ms = 0; s++; 
      if (s == 60) {
        s = 0; m++; 
        if (m == 60) {
          m = 0; h++; 
        }
      }
    }
    chrono.innerHTML = `${h.toString().padStart(2, "0")} : \
                        ${m.toString().padStart(2, "0")} : \
                        ${s.toString().padStart(2, "0")} : \
                        ${(ms/10).toString().padStart(2, "0")}`;
  }, 10);
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

/*          FANTASY THEME          */
const knight = "../../assets/img/memoryTheme/knight.jpeg";
const dragon = "../../assets/img/memoryTheme/dragon.jpeg";
const king = "../../assets/img/memoryTheme/king.jpeg";
const queen = "../../assets/img/memoryTheme/reine.jpeg";
const castle = "../../assets/img/memoryTheme/chateau.jpeg";
const witch = "../../assets/img/memoryTheme/sorciere.jpeg";
let fantasyCardsEasy = [knight, knight, dragon, dragon];
let fantasyCardsMedium = [knight, knight, dragon, dragon, king, king, queen, queen];
let fantasyCardsHard = [ knight, knight, dragon, dragon, king, king, queen, queen, castle, castle, witch, witch];

let mixed;
let dimension = 0;
switch (difficulty) {
  case "easy": mixed = shuffle(fantasyCardsEasy); break;
case "medium": mixed = shuffle(fantasyCardsMedium); break;
  case "hard": mixed = shuffle(fantasyCardsHard); break;
  default: break;
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
  cardElement.style.backgroundImage = `url(${card})`;
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

  if (mixed[index1] == mixed[index2]) {
    card1.removeEventListener("click", () => flipCard(card1));
    card2.removeEventListener("click", () => flipCard(card2));
    matchedPairs++;
    scorePTN.innerText = matchedPairs;
    if (matchedPairs === mixed.length / 2) {
      stopTimer();
      game.appendChild(buttonsContainer);
      inGame = false;
      $.ajax({
        url: "../../savescore.php",
        type: "POST",
        data: {"gameId" : 1, "score" : score, "gameDifficulty" : difficulty.toLowerCase()}
      });
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
