$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '../php/register.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                window.location.href = 'login.html';
            },
            error: function(xhr) {
                alert('Registration failed: ' + xhr.responseText);
            }
        });
    });
});
