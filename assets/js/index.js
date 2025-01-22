function showForgotPasswordForm() {
  document.getElementById('login-form').style.display = 'none';
  document.getElementById('registro-form').style.display = 'none';
  document.getElementById('recuperacion-form').style.display = 'block';
}
function showLoginForm() {
  document.getElementById('login-form').style.display = 'block';
  document.getElementById('registro-form').style.display = 'none';
  document.getElementById('recuperacion-form').style.display = 'none';
}

function showRegistrationForm() {
  document.getElementById('login-form').style.display = 'none';
  document.getElementById('recuperacion-form').style.display = 'none';
  document.getElementById('registro-form').style.display = 'block';
}