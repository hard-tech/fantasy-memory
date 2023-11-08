let difficulty = document.getElementById('difficulty-select');
let theme = document.getElementById('theme-select');


function initMemory() {
    localStorage.setItem("difficulty", difficulty.value);
    localStorage.setItem("memory-theme", theme.value);
}