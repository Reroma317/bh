// JavaScript to handle form toggling between Login and Signup
document.addEventListener("DOMContentLoaded", function () {
    const loginLink = document.querySelector('.toggle-login');
    const signupLink = document.querySelector('.toggle-signup');
    const loginForm = document.querySelector('.login');
    const signupForm = document.querySelector('.signup');

    loginLink.addEventListener('click', function (e) {
        e.preventDefault();
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';
    });

    signupLink.addEventListener('click', function (e) {
        e.preventDefault();
        signupForm.style.display = 'block';
        loginForm.style.display = 'none';
    });
});
