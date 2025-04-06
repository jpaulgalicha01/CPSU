const chatContent = document.getElementById("chat-content");
const messageInput = document.getElementById("message-input");

// Scroll chat to bottom
function scrollToBottom() {
  chatContent.scrollTop = chatContent.scrollHeight;
}

// Initialize Pusher
var pusher = new Pusher("34fb7ca0523a79360d6f", {
  cluster: "ap1",
  encrypted: true,
});

// Subscribe to the chat channel
const channel = pusher.subscribe("chat");

// Listen for new messages
channel.bind("new_message", function (data) {
  var senderID = $("#senderId").val();
  var receiver_name = $("#receiver_name").val();
  var date = data.date;

  var content = "";
  var html_data = "";

  if (data.receiverUserID == senderID) {
    content =
      '<div class="bg-success text-white p-3 rounded"><p class="fw-bold">' +
      receiver_name +
      "</p><p>" +
      data.message +
      '</p><small class="d-flex justify-content-end">' +
      date +
      "</small></div>";
    html_data = '<div class="d-flex mb-3">' + content + "</div>";
  } else {
    content =
      '<div class="bg-primary text-white p-3 rounded"><p>' +
      data.message +
      '</p><small class="d-flex justify-content-end">' +
      date +
      "</small></div>";
    html_data =
      '<div class="d-flex mb-3 justify-content-end">' + content + "</div>";
  }

  $("#chat-content").append(html_data);
  $("#message").val("");
  scrollToBottom();
});

$("#chat-form").on("submit", function (e) {
  e.preventDefault();

  $("#btnSubmit")
    .html(
      "<div class='text-center'><i class='spinner-border spinner-border-sm'></i></div>"
    )
    .prop("disabled", true); // Optional: disable button to prevent spamming

  var senderID = $("#senderId").val();
  var receiverID = $("#receiverID").val();
  var message = $("#message").val();

  $.ajax({
    url: "./bin/chat-server.php",
    type: "POST",
    data: {
      senderUserID: senderID,
      receiverUserID: receiverID,
      message: message,
    },
    success: function () {
      $("#message").val(""); // Clear input field
      scrollToBottom();
    },
    error: function () {
      alert("Error sending message.");
    },
    complete: function () {
      // Always reset button after request is done
      $("#btnSubmit")
        .html("<i class='fa fa-paper-plane'></i> <small>Send</small>")
        .prop("disabled", false);
    },
  });
});
