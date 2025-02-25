<?php

include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';


if (!isset($_COOKIE['UserID']) && !$_COOKIE['TypeUser']) {
  ob_end_flush(header("Location: index.php"));
}

?>

<div class="container-fluid">
  <div class="row py-5">
    <div class="chat-container">
      <!-- People List -->

      <div class="col-4 people-list card">
        <h5 class="sticky-header">People</h5>

        <?php

        $PeopleList = new fetch();
        $ResPeopleList = $PeopleList->PeopleList();

        if ($ResPeopleList->rowCount() != 0) {
          while ($RowPeopleList = $ResPeopleList->fetch()) {
        ?>
            <div class="person 
                        <?php
                        if (isset($_GET["UserID"])) {
                          if ($RowPeopleList["UserID"] == $_GET['UserID']) {
                            echo "selected";
                          }
                        }
                        ?>
                      ">
              <a class="d-flex align-items-center text-decoration-none text-black" href="messages.php?UserID=<?= $RowPeopleList["UserID"] ?>">
                <img src="./uploads/default.png" width="40" height="40" alt="avatar" class="rounded-circle me-2">
                <div class="mx-2">

                  <p class="d-lg-block d-none <?= $RowPeopleList["StatusRead"] == '0' ? "fws-bold" : "" ?>"><?= $RowPeopleList["FName"] . " " . $RowPeopleList["MName"] . " " . $RowPeopleList["LName"] ?></p>
                </div>
              </a>
            </div>
        <?php
          }
        }
        ?>

      </div>

      <!-- Chat Box -->
      <?php
      if (isset($_GET["UserID"])) {
      ?>
        <div class="col-8 chat-box p-0 ms-2">

          <div class="chat-content pb-0" id="chat-content">
            <?php
            $Converation = new fetch();
            $ResConversation = $Converation->Conversation($_GET["UserID"]);

            if ($ResConversation->rowCount() != 0) {
              while ($RowConversation = $ResConversation->fetch()) {



                $Date =  new DateTime($RowConversation["sent_at"]);
                $DateConverted = $Date->format('m-d-Y g:i a');

                if ($RowConversation["UserID"] === $_GET["UserID"]) {
            ?>
                  <div class="d-flex mb-3">
                    <div class="bg-success bg-opacity-75 text-white p-3  rounded chat-convo-box">
                      <p class="fw-bold"><?= $RowConversation["FName"] . " " . $RowConversation["MName"] . " " . $RowConversation["LName"] ?></p>
                      <input type="hidden" id="reciever_name" value="<?= $RowConversation["FName"] . " " . $RowConversation["MName"] . " " . $RowConversation["LName"] ?>">
                      <p class="p-0 mb-1"> <?= $RowConversation["message"] ?></p>
                      <small class="text-light d-flex justify-content-end"><?= $DateConverted ?></small>
                    </div>
                  </div>

                <?php
                } else {
                ?>
                  <div class="d-flex mb-3 justify-content-end">
                    <div class="bg-primary text-white p-3  rounded chat-convo-box">
                      <p class="p-0 mb-1"> <?= $RowConversation["message"] ?></p>
                      <small class="text-light d-flex justify-content-end"><?= $DateConverted ?></small>
                    </div>

                  </div>
            <?php
                }
              }
            }

            ?>

          </div>

          <!-- Chat Input -->
          <div class="chat-input">
            <form method="post" id="chat-form" class="d-flex w-100">
              <input type="hidden" value="<?= $_COOKIE["UserID"] ?>" id="senderId">
              <input type="hidden" value="<?= isset($_GET["UserID"]) ? $_GET["UserID"] : "" ?>" id="receiverID">
              <textarea class="form-control" rows="1" placeholder="Type your message..." id="message" required></textarea>
              <button class="btn btn-primary" type="submit" id="btnSubmit"><i class="fa-solid fa-paper-plane"></i> <small>Send</small></button>
            </form>
          </div>
        </div>
      <?php
      }

      ?>

    </div>
  </div>
</div>
<script src="./assets/js/chat.js"></script>

<?php
include 'includes/footer.php';
?>