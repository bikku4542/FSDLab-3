<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity Tracker</title>
</head>
<body>
    <div class="container">
        <h1>User Activity Tracker</h1>
        <h2>Last Visited Page:</h2>
        <p id="lastPage">Loading...</p>
        <h2>Last Visit Timestamp:</h2>
        <p id="timestamp">Loading...</p>
    </div>

    <script>
        // Track activity across different pages and tabs
        function trackActivity() {
            // Get current page URL and timestamp
            const currentPage = window.location.href;
            const currentTimestamp = new Date().toLocaleString();

            // Store activity in localStorage
            localStorage.setItem('user_activity', JSON.stringify({
                last_page: currentPage,
                timestamp: currentTimestamp
            }));
        }

        // Function to display user activity
        function displayUserActivity() {
            // Retrieve activity from localStorage
            const activityData = localStorage.getItem('user_activity');
            
            // Select elements to update
            const lastPageElement = document.getElementById("lastPage");
            const timestampElement = document.getElementById("timestamp");

            if (activityData) {
                try {
                    const parsedActivity = JSON.parse(activityData);
                    
                    // Update last page
                    lastPageElement.textContent = parsedActivity.last_page || "No page recorded";
                    
                    // Update timestamp
                    timestampElement.textContent = parsedActivity.timestamp || "No timestamp";
                } catch (error) {
                    console.error("Error parsing user activity:", error);
                    lastPageElement.textContent = "Error reading activity";
                    timestampElement.textContent = "";
                }
            } else {
                lastPageElement.textContent = "No activity recorded.";
                timestampElement.textContent = "";
            }
        }

        // Track and display activity on page load
        window.addEventListener('load', () => {
            trackActivity();
            displayUserActivity();
        });

        // Track activity when navigating within the site
        window.addEventListener('pageshow', trackActivity);

        // Track activity for different tabs/windows
        window.addEventListener('storage', (event) => {
            if (event.key === 'user_activity') {
                displayUserActivity();
            }
        });
    </script>
</body>
</html>