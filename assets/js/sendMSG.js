function ajaxEnvoie(pseudo) {
    var text = document.getElementById("chat-input").value;
  if(text !== ""){
    let request =
    $.ajax({
      type: "POST",
      url: "../../sendMessage.php",
      data: {'sendMessage': text}
    });
  
  request.done(function (output) {
    var chatContent = document.getElementById("content-message");

    var newMessageDiv = document.createElement("div");
    newMessageDiv.className = "chat-send-by-me";

    var messageInfoDiv = document.createElement("div");
    messageInfoDiv.className = "infos-message flex-row-reverse";

    var profilePicture = document.createElement("img");
    profilePicture.src = "https://img.freepik.com/vecteurs-premium/icone-profil-style-glitch-homme-vecteur_549897-2126.jpg";
    profilePicture.className = "pp-players";

    var messageStackDiv = document.createElement("div");
    messageStackDiv.className = "stack-message-me";

    var senderNameDiv = document.createElement("div");
    senderNameDiv.className = "chat-my_name";
    senderNameDiv.textContent = pseudo;

    var messageContentDiv = document.createElement("div");
    messageContentDiv.className = "chat-message chat-message-send-by-me";
    messageContentDiv.textContent = text;

    var messageTimeDiv = document.createElement("div");
    messageTimeDiv.className = "chat-time";
    messageTimeDiv.textContent = "Maintenant";

    messageStackDiv.appendChild(senderNameDiv);
    messageStackDiv.appendChild(messageContentDiv);
    messageStackDiv.appendChild(messageTimeDiv);

    messageInfoDiv.appendChild(profilePicture);
    messageInfoDiv.appendChild(messageStackDiv);

    newMessageDiv.appendChild(messageInfoDiv);

    chatContent.appendChild(newMessageDiv);

    document.getElementById("chat-input").value = "";

  
});}
}

let gamechat = document.querySelector('.game-chat');
let closeChat = document.getElementById('group-arrow');
let openChat = document.getElementById('group-up');

closeChat.addEventListener('click', function(){
  gamechat.style.display = "none";
  openChat.style.display = "block";
});

openChat.addEventListener('click', function(){
  gamechat.style.display = "flex";
  openChat.style.display = "none";

});