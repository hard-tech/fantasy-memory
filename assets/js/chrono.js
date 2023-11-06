let chrono = document.getElementById('chrono');
let seconde = 0
console.log('start')

setInterval(function() {
    seconde++;
    chrono.innerHTML = seconde}, 800);


