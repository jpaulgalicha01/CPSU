<?php

include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row py-5">
        <div class="chat-container">
          <!-- People List -->

          <div class="col-4 people-list card">
            <h5 class="sticky-header">People</h5>

            
            <div class="person selected">
              <div class="d-flex align-items-center">
                <img src="./uploads/default.png" width="40" height="40" alt="avatar" class="rounded-circle me-2">
                <div class="mx-2">
                  <strong class="d-lg-block d-none">John Doe</strong><br />
                </div>
              </div>
            </div>
            <div class="person ">
              <div class="d-flex align-items-center">
                <img src="./uploads/default.png" width="40" height="40" alt="avatar" class="rounded-circle me-2">
                <div class="mx-2">
                  <strong class="d-lg-block d-none">John Doe</strong><br />
                </div>
              </div>
            </div>
         
     
          </div>

          <!-- Chat Box -->
          <div class="col-8 chat-box p-0 ms-2">
            <div class="chat-content" id="chat-content">

                <?php
                
                for($y = 1; $y  < 100; $y++){
                    ?>

              <div class="d-flex mb-3">
                <img src="./uploads/default.png" width="40" height="40" alt="avatar" class="rounded-circle me-2">
                <div class="bg-light p-3 rounded">
                  <strong>John Doe</strong><br />
                  Hello! How are you today?
                </div>
              </div>

              <div class="d-flex mb-3 justify-content-end">
                <div class="bg-primary text-white p-3 rounded">
                  I'm good! What about you?
                </div>
                <img src="./uploads/default.png" width="40" height="40" alt="avatar" class="rounded-circle ms-2">
              </div>

                <?php
                    }
                ?>

            </div>

            <!-- Chat Input -->
            <div class="chat-input">
              <textarea class="form-control" rows="1" placeholder="Type your message..." id="message-input"></textarea>
              <button class="btn btn-primary" id="send-btn">Send</button>
            </div>
          </div>
        </div>
      </div>
  </div>

  <script>
    const chatContent = document.getElementById('chat-content');
    const sendBtn = document.getElementById('send-btn');
    const messageInput = document.getElementById('message-input');

    // Function to scroll chat to the bottom
    function scrollToBottom() {
      chatContent.scrollTop = chatContent.scrollHeight;
    }

    // Add a new message and scroll to bottom
    // sendBtn.addEventListener('click', function () {
    //   const message = messageInput.value.trim();
    //   if (message) {
    //     // Create new message div
    //     const messageDiv = document.createElement('div');
    //     messageDiv.classList.add('d-flex', 'mb-3', 'justify-content-end');
    //     messageDiv.innerHTML = `
    //       <div class="bg-primary text-white p-3 rounded">${message}</div>
    //       <img src="https://via.placeholder.com/40" alt="avatar" class="rounded-circle ms-2">
    //     `;
    //     chatContent.appendChild(messageDiv);
        
    //     // Clear input field
    //     messageInput.value = '';

    //     // Scroll to the bottom
    //     scrollToBottom();
    //   }
    // });

    window.onload = scrollToBottom;
  </script>

<?php
include 'includes/footer.php';
?>