// TIMER ----------------------------------------------------------------------

let timer = document.getElementById("timer");
timer.innerHTML = "00:00:00:00";

let h = 0, m = 0, s = 0, ms = 0, score = 0;
let intervalId;

function startTimer() {
  intervalId = setInterval(function () {
    ms+=10;score++;if(ms==1000){ms=0;s++;if(s==60){s=0;m++;if(m==60){m =0;h++;}}}
    timer.innerHTML = `${h.toString().padStart(2, "0")} : 
                       ${m.toString().padStart(2, "0")} : 
                       ${s.toString().padStart(2, "0")} : 
                       ${(ms/10).toString().padStart(2, "0")}`;
  }, 10);
}

function stopTimer() {
  clearInterval(intervalId);
}

// GAME INIT ------------------------------------------------------------------

let inGame = false;

let difficulty   = localStorage.getItem("difficulty");
let choosenTheme = localStorage.getItem("memory-theme");

let game         = document.getElementById("game");
let gameBoard    = document.getElementById("game-board");
let scorePTN     = document.getElementById("score");

let themes;
var cards;
let flippedCards = [];
let matchedPairs = 0;
let currentRow;

let request = new XMLHttpRequest();
request.open("GET", "http://localhost:8888/fantasy-memory/assets/img/themes/themes.json");
request.responseType = "text";
request.send();

request.onload = function () {
  themes = JSON.parse(request.response);

  switch (difficulty) {
    case "easy":
      let easyDeck = themes[choosenTheme].slice(0, 2)
        .map(value => "../../assets/img/themes/" + choosenTheme + "/" + value);
      easyDeck = [...easyDeck, ...easyDeck];
      cards = shuffle(easyDeck);
      break;

    case "medium":
      let mediumDeck = themes[choosenTheme].slice(0, 4)
        .map(value => "../../assets/img/themes/" + choosenTheme + "/" + value);
      mediumDeck = [...mediumDeck, ...mediumDeck];
      cards = shuffle(mediumDeck);
      break;

    case "hard":
      let hardDeck = themes[choosenTheme].slice(0, 6)
        .map(value => "../../assets/img/themes/" + choosenTheme + "/" + value);
      hardDeck = [...hardDeck, ...hardDeck];
      cards = shuffle(hardDeck);
      break;

    default: break;
  }

  cards.forEach((card, index) => {
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
};

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

  if (cards[index1] == cards[index2]) {
    card1.removeEventListener("click", () => flipCard(card1));
    card2.removeEventListener("click", () => flipCard(card2));
    matchedPairs++;
    scorePTN.innerText = matchedPairs;
    if (matchedPairs === cards.length / 2) {
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
