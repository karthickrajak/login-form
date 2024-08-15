$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '../php/login.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.startsWith("success")) {
                    const token = response.split("&token=")[1];
                    localStorage.setItem('loggedIn', 'true');
                    localStorage.setItem('token', token);
                    window.location.href = 'profile.html';
                } else {
                    alert('Login failed: ' + response);
                }
            },
            error: function(xhr) {
                alert('Login failed: ' + xhr.responseText);
            }
        });
    });
});
