const chatContent = document.getElementById("chat-content");
const sendBtn = document.getElementById("send-btn");
const messageInput = document.getElementById("message-input");

// Function to scroll chat to the bottom
function scrollToBottom() {
  chatContent.scrollTop = chatContent.scrollHeight;
}

var conn = new WebSocket("ws://localhost:8080");
conn.onopen = function (e) {
  console.log("Connection established!");
};

conn.onmessage = function (e) {
  var data = JSON.parse(e.data);
  var senderID = $("#senderId").val();
  var reciever_name = $("#reciever_name").val();
  var date = data.date;

  var content = "";
  var html_data = "";

  if (data.receiverUserID == senderID) {
    content =
      '<div class="bg-success bg-opacity-75 text-white p-3 rounded" style="width:50%"><p class="fw-bold">' +
      reciever_name +
      '</p><p class="p-0 mb-1">' +
      data.message +
      '</p><small class="text-light d-flex justify-content-end">' +
      date +
      "</small></div>";
    html_data = '<div class="d-flex mb-3">' + content + "</div>";
  }
  if (data.receiverUserID !== senderID) {
    content =
      '<div class="bg-primary text-white p-3 rounded" style="width:50%"><p class="p-0 mb-1">' +
      data.message +
      '</p><small class="text-light d-flex justify-content-end">' +
      date +
      "</small></div>";
    html_data =
      '<div class="d-flex mb-3 justify-content-end">' + content + "</div>";
  }

  $("#chat-content").append(html_data);
  $("#message").val("");
  scrollToBottom();
};

$("#chat-form").on("submit", function (e) {
  try {
    e.preventDefault();
    document.getElementById("btnSubmit").disabled = true;

    $("#btnSubmit").html(
      "<div class='text-center'><i class='spinner-border spinner-border-sm'></i></div>"
    );
    var senderID = $("#senderId").val();
    var receiverID = $("#receiverID").val();
    var message = $("#message").val();

    var data = {
      senderUserID: senderID,
      receiverUserID: receiverID,
      message: message,
    };
    const res = conn.send(JSON.stringify(data));

    if (res) {
      $("#btnSubmit").html(
        "<i class='fa fa-paper-plane'></i> <small>Send</small>"
      );
      document.getElementById("btnSubmit").disabled = false;
    } else {
      $("#btnSubmit").html(
        "<i class='fa fa-paper-plane'></i> <small>Send</small>"
      );
      document.getElementById("btnSubmit").disabled = false;
    }
  } catch (error) {
    alert("There's something error please try again");
    console.error(error);
  }
});

window.onload = scrollToBottom;
