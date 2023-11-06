function checkPassword() {
  var mediumPassword = new RegExp("((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))");
  var strongPassword = new RegExp("(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}");
  var password = document.getElementById("password");
  var indicator = document.getElementById("password-indicator");
  
  if (strongPassword.test(password.value)) {
    indicator.style.display = "flex";
    indicator.style.backgroundColor = "green";
    indicator.style.width = "100%";
    indicator.innerHTML = "Strong password";
  } else if (mediumPassword.test(password.value)) {
    indicator.style.display = "flex";
    indicator.style.backgroundColor  = "orange";
    indicator.style.width = "50%";
    indicator.innerHTML = "Medium password";
  } else if (password.value.length > 0) {
    indicator.style.display = "flex";
    indicator.style.backgroundColor = "red";
    indicator.style.width = "25%";
    indicator.innerHTML = "Weak password";
  } else {
    indicator.style.display = "none";
  }
}
