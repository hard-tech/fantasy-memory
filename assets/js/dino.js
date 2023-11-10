// Définir les variables du jeu
let moyenCube;
let petitCube;
let petitrond;
let isJumping = false;
let gameOver = false;
let score = 0; // Ajoutez cette variable pour le score
let gold = 0; // Ajoutez cette variable pour le gold

// Sélectionner l'élément d'affichage du score
let scoreDisplay = document.getElementById("score");
let goldDisplay = document.getElementById("gold");
let start = document.getElementById("start");
let reload = document.getElementById("reload");

function entitenbr(){
    return Math.floor(Math.random() * 3);
}

function startGame() {
  moyenCube = document.getElementById("moyen-cube");
  petitCube = document.getElementById("petit-cube");
  petitrond = document.getElementById("petit-rond");

  // Écouter l'événement de la barre d'espace pour sauter
  document.addEventListener("keydown", jump);

  // Générer un nombre aléatoire (0, 1, ou 2) pour décider quelle entité déplacer en premier
  const randomEntity = entitenbr();
  petitCube.style.display = "none";
  petitrond.style.display = "none";

  if (randomEntity === 0) {
    // Déplacer le petit cube en premier
    console.log('rond');
    movePetitR();
  } else {
    console.log('cube');
    // Déplacer le petit rond en premier
    movePetitC();
  }
}

function whoHasThat() {

  // Générer un nombre aléatoire (0, 1, ou 2) pour décider quelle entité déplacer en premier
  const randomEntity = entitenbr();

  if (randomEntity === 0) {
    // Déplacer le petit cube en premier
    movePetitR();
  } else {
    // Déplacer le petit rond en premier
    movePetitC();
  }
}
function jump(event) {
    event.preventDefault();
    event.stopPropagation();
  
    // Utilisez 38 pour la touche de la flèche du haut
    if ( event.keyCode === 38 && !isJumping && !gameOver) {
      isJumping = true;
      moyenCube.classList.add("jump");
  
      // Retirer la classe "jump" après un certain délai
      setTimeout(() => {
        moyenCube.classList.remove("jump");
        isJumping = false;
      }, 500);
    }
  }
  
  
  

function updateScore() {
        score ++;
        scoreDisplay.innerText = "Score: " + score;
}

function updateGold() {
    gold += 1;
    goldDisplay.innerText = "Gold: " + gold;
}


// Fonction pour déplacer le petit cube
function movePetitC() {
  let position = 500;
  let speed = 5;
  const gameArea = document.getElementById("game-area");
  if(score > 1000){
    speed = 7;
  }else if(score > 1500){
    speed = 10;
  }
  const moveInterval = setInterval(() => {
    if (!gameOver) {
        updateScore()
      position -= speed;
      petitCube.style.left = position + "px";
      petitCube.style.display = "block";

      // Vérifier la collision
      if (
        position < moyenCube.offsetLeft + moyenCube.offsetWidth -5 &&
        position + petitCube.offsetWidth > moyenCube.offsetLeft +5 &&
        moyenCube.offsetTop + moyenCube.offsetHeight > gameArea.offsetHeight - petitCube.offsetHeight
      ) {
        // Collision détectée, fin de la partie
        gameOver = true;
        gameArea.classList.add("game-over");
      }
        //   /////////// debut  cheat 
        if(score < 1000){
          if (
            position < moyenCube.offsetLeft + moyenCube.offsetWidth + 100 &&
            position + petitCube.offsetWidth > moyenCube.offsetLeft + 100  &&
            moyenCube.offsetTop + moyenCube.offsetHeight > gameArea.offsetHeight - petitCube.offsetHeight
          ) {
            // // Collision détectée, fin de la partie
            // gameOver = true;
            // gameArea.classList.add("game-over");
            isJumping = true;
            moyenCube.classList.add("jump");
            // Retirer la classe "jump" après un certain délai
            setTimeout(() => {
              moyenCube.classList.remove("jump");
              isJumping = false;
            }, 500);
          }
        }else{
          if (
            position < moyenCube.offsetLeft + moyenCube.offsetWidth + 150 &&
            position + petitCube.offsetWidth > moyenCube.offsetLeft + 150  &&
            moyenCube.offsetTop + moyenCube.offsetHeight > gameArea.offsetHeight - petitCube.offsetHeight
          ) {
            // // Collision détectée, fin de la partie
            // gameOver = true;
            // gameArea.classList.add("game-over");
            isJumping = true;
            moyenCube.classList.add("jump");
            // Retirer la classe "jump" après un certain délai
            setTimeout(() => {
              moyenCube.classList.remove("jump");
              isJumping = false;
            }, 500);
          }
        }

        //  /////////// fin cheat 

      // Si le petit cube a quitté l'écran, réinitialiser sa position
      if (position + petitCube.offsetWidth < 0) {
        position = 500;
        petitCube.style.left = position + "px";
        petitCube.style.display = "none";
        petitrond.style.display = "none";
        whoHasThat();
        clearInterval(moveInterval);


      }
    } else {
        console.log('gameover');
      clearInterval(moveInterval);
      reload.style.display = "block";


    
    }
  }, 10);
}
// Fonction pour déplacer le petit rond
function movePetitR() {
  let position = 500;
  let speed = 5;
  const gameArea = document.getElementById("game-area");
  if(score > 1000){
    speed = 7;
  }else if(score > 1500){
    speed = 10;
  }
  const moveInterval = setInterval(() => {
    if (!gameOver) {
        updateScore()
      position -= speed;
      petitrond.style.left = position + "px";
      petitrond.style.display = "block";

      // Vérifier la collision
      if (
        position < moyenCube.offsetLeft + moyenCube.offsetWidth &&
        position + petitrond.offsetWidth > moyenCube.offsetLeft &&
        moyenCube.offsetTop + moyenCube.offsetHeight > gameArea.offsetHeight - petitrond.offsetHeight
      ) {
        // Collision détectée, fin de la partie
        updateGold();
        petitrond.style.display = "none";
        whoHasThat();
        clearInterval(moveInterval);

      }

      // Si le petit cube a quitté l'écran, réinitialiser sa position
      if (position + petitrond.offsetWidth < 0) {
        position = 500;
        petitrond.style.left = position + "px";
        petitCube.style.display = "none";
        petitrond.style.display = "none";
        whoHasThat();
        clearInterval(moveInterval);
        
      }
    } else {
        console.log('gameover');
      clearInterval(moveInterval);
      
    }
  }, 10);
}

start.addEventListener("click", function(){
// Démarrer le jeu
    start.style.display = "none";
    startGame();

})

reload.addEventListener("click", function(){
    // Démarrer le jeu
    location. reload() 

})