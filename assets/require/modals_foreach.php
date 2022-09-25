<?php if (isset($getContent_id) && ($page == 'tutorial' || $page == 'search_results') || $page == 'performance' || $page == 'sheet_music' || $page == 'user_content' || $page == 'unique_content') {

  $getComments = getComments($bdd, $getContent_id); ?>

  <div id="buy_modal<?= $getContent_id ?>" class="modal messages">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form class="form_action" action="./assets/actions/buy_content_action.php?id=<?= $getContent_id ?>" method="post">

            <h2>Content Description</h2>
            <br>

            <div class="modal_description"><?= $getContent_description ?></div>
            <br>

            <h2>This content is not free !</h2>
            <br>


            <?php if (isset($session_users_id)) {


              $message = 'You have ' . $getUserInformations_credits . ' credits.

              Do you want to buy ' . $getContent_title . ' of ' . $getContent_composer . ' for ' . $getContent_price . ' credits ?'; ?>

              <div class="modal_message"><?= nl2br($message) ?></div>
              <br>
              <button type="submit" class="button gray">Buy</button>
              <br>
              <button type="button" class="button gray" id="content_comment_button<?= $getContent_id ?>" onfocus="javascript:modalForeach('content_comment','<?= $getContent_id ?>')">View comments</button>

              <div class="flex_close">
                <div class="button gray" id="buy_close<?= $getContent_id ?>">Close</div>
              </div>


            <?php } else { ?>


              <div>You are not connected.<br>Log in or register.<br>You will get 500 credits.</div>
              <br>


              <?php if (isset($getComments) && !empty($getComments)) { ?>

                <button type="button" class="button gray" id="content_comment_button<?= $getContent_id ?>" onfocus="javascript:modalForeach('content_comment','<?= $getContent_id ?>')">View comments</button>

              <?php } ?>


              <div class="flex_close">
                <div class="button gray" id="buy_close<?= $getContent_id ?>">Close</div>
              </div>


            <?php } ?>


          </form>
        </div>
      </div>
    </div>
  </div>


  <div id="content_comment_modal<?= $getContent_id ?>" class="modal messages content_comment">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content content_comment">
          <div class="form_action">


            <?php foreach ($getComments as $getComment) {

              require('variables.php'); ?>


              <div class='deck content_comment'>
                <div class='content_comment_card'>

                  <div class='cardHeader'>

                    <span class='cardHeader_date'><?= $getComment_date ?></span>
                  </div>

                  <div class='cardBody'>

                    <p class='cardText'><?= $getComment_text ?></p>

                    <section class='cardStats'>


                      <span class='cardStats_stat cardStats_stat-likes'><?= $getComment_likes ?> <i class="far fa-thumbs-up"></i></span>

                    </section>
                  </div>
                </div>
              </div>


            <?php } ?>


            <div class="flex_close">
              <button type="button" class="button gray" id="content_comment_close<?= $getContent_id ?>">Close</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>


<?php } ?>


<?php if (isset($getComment_id) && $page == "single_player") { ?>


  <div id="edit_comment_modal<?= $getComment_id ?>" class="modal messages">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form class="form_action" action="./assets/actions/edit_comment_action.php?id=<?= $getContentAndUserInformations_id ?>" method="post">

            <label for="single_player_id_edit_comment<?= $getComment_id ?>"></label>
            <input type="hidden" id="single_player_id_edit_comment<?= $getComment_id ?>" name="id" value="<?= $getComment_id ?>">

            <h2>Your comment</h2>
            <br>

            <label for="single_player_edit_comment<?= $getComment_id ?>"></label>
            <textarea class="inputbox text" id="single_player_edit_comment<?= $getComment_id ?>" name="comment" onkeyup="javascript:input(this,'single_player_edit_comment<?= $getComment_id ?>',10000, 'input_contact');" value="<?= $getComment_text ?>"><?= $getComment_text ?></textarea>

            <button type="submit" class="button gray">Edit Comment</button>

            <div class="flex_close">
              <div class="button gray" id="edit_comment_close<?= $getComment_id ?>">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <div id="like_comment_modal<?= $getComment_id ?>" class="modal messages">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form class="form_action" action="./assets/actions/like_action.php?name=comment&id_comment=<?= $getComment_id ?>&id=<?= $getContentAndUserInformations_id ?>" method="post">

            <div class="messages_logo">
              <img src="./assets/img/musicgrise.png" alt="" />
            </div>

            <br>

            <?php
            $message = "Like " . $getComment_user_name . " " . $getComment_user_lastname . "'s comments ?";
            ?>

            <div><?= nl2br($message) ?></div>

            <button type="submit" class="button gray">Like</button>

            <div class="flex_close">
              <div class="button gray" id="like_comment_close<?= $getComment_id ?>">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


<?php } ?>


<?php if (isset($getNotification_id) && $page == "my_account") { ?>

  <div id="delete_notification_modal<?= $getNotification_id ?>" class="modal messages">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form data-barba-prevent class="form_action" action="/Diplome/assets/actions/delete_notification_action.php?id=<?= $getNotification_id ?>" method="post">

            <div class="messages_logo">
              <img src="./assets/img/musicgrise.png" alt="" />
            </div>

            <h2>Are you sure you want to delete these notification ? This action is irreversible !</h2>
            <br>

            <button type="submit" class="button gray">Delete</button>

            <div class="flex_close">
              <div class="button gray" id="delete_notification_close<?= $getNotification_id ?>">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<?php } ?>