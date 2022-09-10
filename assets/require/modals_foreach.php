<?php if (isset($content_id)) { ?>


  <div id="buy_modal<?= $content_id ?>" class="modal messages">
    <div class="modal-content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form class="form_action" action="./assets/actions/buy_content_action.php?id=<?= $content_id ?>" method="post">

            <div class="messages_logo">
              <img src="./assets/img/musicgrise.png" alt="" />
            </div>


            <?php if (isset($session_users_id)) {


              $message = 'You have ' . $user_session_credits . ' credits.
											Do you want to buy ' . $content_title . ' of ' . $content_composer . ' for ' . $content_price . ' credits ?'; ?>


              <div><?= nl2br($message) ?></div>
              <button type="submit" class="button red">Buy</button>
              <div class="button" id="buy_close<?= $content_id ?>">Close</div>


            <?php } else { ?>


              <div>You are not connected.<br>Log in or register.<br>You will get 50 credits.</div>
              <div class="button" id="buy_close<?= $content_id ?>">Close</div>


            <?php } ?>


          </form>
        </div>
      </div>
    </div>
  </div>

<?php } ?>


<?php if (isset($comment_id)) { ?>


  <div id="edit_comment_modal<?= $comment_id ?>" class="modal messages">
    <div class="modal-content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form class="form_action" action="./assets/actions/edit_comment_action.php?id=<?= $content_id ?>" method="post">

            <label for="single_player_id_edit_comment<?= $comment_id ?>"></label>
            <input type="hidden" id="single_player_id_edit_comment<?= $comment_id ?>" name="id" value="<?= $comment_id ?>">

            <label for="single_player_edit_comment<?= $comment_id ?>">Your comment</label>
            <textarea class="inputbox text" id="single_player_edit_comment<?= $comment_id ?>" name="comment" value="<?= $comment_text ?>"><?= $comment_text ?></textarea>

            <button type="submit" class="button">Edit Comment</button>
            <div class="button" id="edit_comment_close<?= $comment_id ?>">Close</div>

          </form>
        </div>
      </div>
    </div>
  </div>


<?php } ?>