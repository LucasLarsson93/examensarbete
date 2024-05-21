document.addEventListener("DOMContentLoaded", function() {
    fetch('/api/users/count')
        .then(response => response.json())
        .then(data => {
            // Display the total number of users
            document.getElementById('total-users').innerText = data.total_users;

            // Display the latest user
            const latestUser = data.latest_user;
            if (latestUser) {
                document.getElementById('latest-user').innerText = data.latest_user;
            }
        })
        .catch(error => console.error('Error fetching user data:', error));
});
