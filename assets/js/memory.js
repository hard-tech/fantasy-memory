

let gameBoard = document.getElementById('game-board');
let scorePTN = document.getElementById('score');


function Card(theme, name, img, nbr) {
    this.theme = theme;
    this.name = name;
    this.imgsrc = img;
    this.nbr = nbr;
  }

const knight = new Card("Medieval", "Chevalier", "../../assets/img/memoryThemeFantaisy/knight.jpeg", 2);
const dragon = new Card("Medieval", "Dragon", "../../assets/img/memoryThemeFantaisy/king.jpeg", 2);



let mycards = [knight , knight , dragon , dragon];

let mixed = shuffle(mycards);
let flippedCards = [];
let matchedPairs = 0;   
let currentRow;

mixed.forEach((card, index) => {

    if (index % 4 === 0) {

        currentRow = document.createElement('tr');
        gameBoard.appendChild(currentRow);
      }

      let cardElement = document.createElement('td');
      let div = document.createElement('td');
      cardElement.classList.add('card');
      cardElement.classList.add('back');
      cardElement.dataset.index = index;
    cardElement.style.backgroundImage = `url(${card.imgsrc})`;
    cardElement.addEventListener('click', () => flipCard(cardElement));
    currentRow.appendChild(cardElement);

  });

  function checkMatch() {
    const [card1, card2] = flippedCards;
    const index1 = card1.dataset.index;
    const index2 = card2.dataset.index;
  
    if (mixed[index1] === mixed[index2]) {
      // Cards match
      card1.removeEventListener('click', () => flipCard(card1));
      card2.removeEventListener('click', () => flipCard(card2));
      matchedPairs++;
      scorePTN.innerText = matchedPairs;
      if (matchedPairs === mycards.length / 2) {
        alert('Bravo, vous avez gagné !');
      }
    } else {
      // Cards don't match
      card1.classList.remove('flipped');
      card2.classList.remove('flipped');
      card1.classList.add('back');
      card2.classList.add('back');

    }
  
    flippedCards = [];
  }
  


  function flipCard(cardElement) {
    if (flippedCards.length < 2 && !flippedCards.includes(cardElement) && !cardElement.classList.contains('flipped')) {
      cardElement.classList.add('flipped');
      cardElement.classList.remove('back');
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



