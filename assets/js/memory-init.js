function initMemory() {
    let difficulty = document.getElementById('difficulty-select');
    let theme = document.getElementById('theme-select');
    let err = document.createElement("p");
    err.style.color = "red";

    if (difficulty.value == "" || theme.value == "") {
        if (difficulty.value == "") {
            document.getElementById("difficulty-err").style.visibility = "visible";
        }
        if (theme.value == "") {
            document.getElementById("theme-err").style.visibility = "visible";
        }
    } else {
        localStorage.setItem("difficulty", difficulty.value);
        localStorage.setItem("memory-theme", theme.value);
        window.location.href = "http://localhost:8888/fantasy-memory/games/memory/index.php";
    }
}