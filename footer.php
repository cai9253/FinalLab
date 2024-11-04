
<script src="zoom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
    // Clear sessionStorage at the start
    sessionStorage.clear();
    
    // Handle click event for all heart icons
    $(".socmed #heart").click(function (e) {
        e.preventDefault();
        
        // Get the like count from the corresponding span and increment
        var likeSpan = $(this).find(".like-count");
        var count = parseInt(likeSpan.text());

        // Send the AJAX request to update the like count on the server
        $.ajax({
            type: "GET",
            url: "heart.php",
            data: {
                count: count
            },
            dataType: "json",
            success: function (response) {
                // Update the corresponding like-count span with the new count
                likeSpan.text(response.count);
                sessionStorage.setItem("count", response.count); // Store in sessionStorage
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });
});
    </script>
   
</body>
</html>