<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if the user is not logged in
  header("Location: login.php");
  exit;
}

// Display the messaging interface
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Messaging System</title>
</head>
<body>
  <h1>My Messaging System</h1>
  <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
  
  <form>
    <label for="recipient">Recipient:</label>
    <input type="text" name="recipient" id="recipient">
    <br>
    <label for="message">Message:</label>
    <textarea name="message" id="message"></textarea>
    <br>
    <button type="submit" id="send-button">Send</button>
  </form>
  
  <div id="message-list">
    <!-- Messages will be displayed here -->
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // AJAX function to send a message
    function sendMessage(recipient, message) {
      $.post("send-message.php", { recipient: recipient, message: message }, function(response) {
        // Display the response message
        alert(response.message);
      });
    }
    
    // Handle form submission
    $("#send-button").click(function(event) {
      event.preventDefault();
      
      // Get the recipient and message from the form
      var recipient = $("#recipient").val();
      var message = $("#message").val();
      
      // Send the message via AJAX
      sendMessage(recipient, message);
    });
    
    // AJAX function to get messages
    function getMessages() {
      $.get("get-messages.php", function(response) {
        // Display the messages
        $("#message-list").html(response);
      });
    }
    
    // Update the messages every 5 seconds
    setInterval(getMessages, 5000);
  </script>
</body>
</html>
