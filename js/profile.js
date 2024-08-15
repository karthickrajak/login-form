$(document).ready(function() {
    // Redirect to login if not logged in
    if (localStorage.getItem('loggedIn') !== 'true') {
        window.location.href = 'login.html';
    }

    $('#profileForm').on('submit', function(e) {
        e.preventDefault();
        const token = localStorage.getItem('token');
        if (!token) {
            alert('User not logged in');
            return;
        }

        $.ajax({
            url: '../php/profile.php',
            type: 'POST',
            data: $(this).serialize() + '&token=' + token,
            success: function(response) {
                alert('Profile updated successfully!');
            },
            error: function(xhr) {
                alert('Profile update failed: ' + xhr.responseText);
            }
        });
    });
});
