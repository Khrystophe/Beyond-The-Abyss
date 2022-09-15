<?php if (isset($content_id)) { ?>


  <div id="buy_modal<?= $content_id ?>" class="modal messages">
    <div class="modal-content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form class="form_action" action="./assets/actions/buy_content_action.php?id=<?= $content_id ?>" method="post">

            <h2>Content Description</h2>
            <br>

            <div class="modal_description"><?= $content_description ?></div>
            <br>

            <h2>This content is not free !</h2>
            <br>

            <?php if (isset($session_users_id)) {


              $message = 'You have ' . $user_session_credits . ' credits.
              Do you want to buy ' . $content_title . ' of ' . $content_composer . ' for ' . $content_price . ' credits ?'; ?>

              <div class="modal_message"><?= nl2br($message) ?></div>
              <br>
              <button type="submit" class="button red">Buy</button>
              <div class="button" id="buy_close<?= $content_id ?>">Close</div>


            <?php } else { ?>


              <div>You are not connected.<br>Log in or register.<br>You will get 50 credits.</div>
              <br>
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

            <h2>Your comment</h2>
            <br>

            <label for="single_player_edit_comment<?= $comment_id ?>">Comment : (|\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-|</label>
            <textarea class="inputbox text" id="single_player_edit_comment<?= $comment_id ?>" name="comment" pattern="^[\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-]+$" value="<?= $comment_text ?>"><?= $comment_text ?></textarea>

            <button type="submit" class="button">Edit Comment</button>
            <div class="button" id="edit_comment_close<?= $comment_id ?>">Close</div>

          </form>
        </div>
      </div>
    </div>
  </div>


<?php } ?>