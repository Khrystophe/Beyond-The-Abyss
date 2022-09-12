<?php
if (isset($get_error) || isset($get_success)) {

  $messages = [
    1 => 'You haven\'t posted any content yet.',
    2 => 'You haven\'t purchased any content yet.',
    3 => 'This category does not exist.',
    4 => 'Please don\'t reload the page. 
    Use the menus to navigate the site.',
    5 => 'An error has occurred.',
    6 => 'You are already connected',
    7 => 'The use of cookies is necessary for the proper functioning of this site. 
    Please enable the use of cookies in your browser.
    
    If you have just created your account, it is active. All you have to do is connect, having previously activated the use of cookies in your browser.',
    8 => 'An error has occurred or you are not connected.',
    9 => 'This content does not exist.',
    10 => 'You have not buy this content.',
    11 => 'Your reporting have been sent. 
    Check notifications in your account. ',
    12 => 'The creation of your account is a success. ',
    13 => 'Contact an administrator. ',
    14 => 'Your password confirmation is wrong. ',
    15 => 'This email is already in use. ',
    16 => 'Your comment is posted. ',
    17 => 'You have been disconnected. ',
    18 => 'You are logged into your account ',
    19 => 'Your password is wrong. ',
    20 => 'This user does not exist. ',
    21 => 'Your like has been taken into account. ',
    22 => 'You have already liked this content. ',
    23 => 'Your like has been taken into account. ',
    24 => 'You have already liked this comment. ',
    25 => 'Your password has been changed successfully. ',
    26 => 'Your old password is wrong. ',
    27 => 'Your name/lastname have been changed successfully. ',
    28 => 'This content has been flagged. 
    You can no longer edit or delete it until an administrator has reviewed it.  ',
    29 => 'The file you tried to post is too big. Respect the 128 MB maximum. ',
    30 => 'The file could not be recovered . ',
    31 => 'Your content has been edited successfully . ',
    32 => 'Your comment has been edited successfully . ',
    33 => 'Your account has been deleted successfully . ',
    34 => 'As an administrator, you cannot modify some informations about yourself. 
    Please access your account to change what you are allowed to change. 
    If you want to delete your account, contact another administrator.  ',
    35 => 'The notification has been deleted. ',
    36 => 'The content has been deleted. ',
    37 => 'Your message has been sent.
    An administrator will answer you as soon as possible ',
    38 => 'Your purchase has been taken into account. ',
    39 => 'Your sold of credit is insufficient. ',
    40 => 'You are not an administrator.
    Please use this site correctly. ',
    41 => 'Reply sent. ',
    42 => 'User edited. ',
    43 => 'Purchased content deleted. ',
    44 => 'Message deleted. ',
    45 => 'Comment deleted. ',
    46 => 'You have been logged out automatically because you have been inactive for too long. ',
    47 => 'This content is not free. 
    Log in or register. 
    For any new registration you will get 50 credits. ',
    48 => 'Account deleted. ',
    49 => 'Your search result is empty.',
    50 => 'An error has occured. ',
    51 => 'This content has been flagged. 
    You can no longer edit or delete it until an administrator has reviewed it.  ',
    52 => 'Your content has been edited successfully . ',
    53 => 'An error has occurred.',
    54 => 'The file you tried to post is too big. Respect the 128 MB maximum. ',
    55 => 'The file could not be recovered . ',
    56 => 'Your content has been deleted. ',
    57 => 'Content add with success. ',
    58 => 'Content add with success. ',
  ];

  if (isset($get_error)) {

    $message = $messages[substr($get_error, 4)];
  } else if (isset($get_success)) {

    $message = $messages[substr($get_success, 4)];
  }

?>

  <div id="messages_modal" class="modal messages">
    <div class="modal-content">
      <div class="modal_form">
        <div class="modal_form_content">
          <form class="form_action">

            <div class="messages_logo">
              <img src="./assets/img/musicgrise.png" alt="" />
            </div>

            <br>

            <div><?= nl2br($message) ?></div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    let messages_modal = document.getElementById("messages_modal");

    messages_modal.style.display = "flex"

    document.onclick = function() {
      messages_modal.style.display = "none";
    }
  </script>

<?php } ?>



<div id="search_modal" class="modal">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <span id="search_close">&times;</span>
        <form class="form_action" action="/Diplome/content.php?category=search_results" method="post">

          <label for="search_title"></label>
          <input type="text" class="inputbox" placeholder="Title" id="search_title" name="title" />

          <label for="search_composer"></label>
          <input type="text" class="inputbox" placeholder="Composer" id="search_composer" name="composer" />

          <label for="search_category"></label>
          <select class="inputbox" id="search_category" name="category">
            <option value="">--Category--</option>
            <option value="tutorial">Tutorial</option>
            <option value="performance">Performances</option>
            <option value="sheet_music">Sheet Music</option>
          </select>

          <label for="search_level"></label>
          <select class="inputbox" id="search_level" name="level">
            <option value="">--Level--</option>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
            <option value="very-hard">Very Hard</option>
          </select>

          <label for="search_price">Free Content</label>
          <input type="checkbox" class="inputbox" id="search_price" value="Free" name="price">

          <button type="submit" class="button">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div id="contact_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/assets/actions/contact_action.php" method="post">
          <?php
          if (isset($session_users_id)) { ?>

            <label for="contact_id"></label>
            <input type="hidden" id="contact_id" name="id" value="<?= $session_users_id ?>">

            <label for=" contact_message">Contact an administrator</label>
            <textarea class="inputbox text" id="contact_message" name="message"></textarea>

            <button type="submit" class="button">Post</button>
            <div class="button" id="contact_close">Close</div>

          <?php } else { ?>

            <div>You are not logged in</div>
            <div class="button" id="contact_close">Close</div>

          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>


<div id="edit_modal" class="modal">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <span id="edit_close">&times;</span>
        <form class="form_action" action="/Diplome/assets/actions/edit_content_action.php?type=user" method="post" enctype="multipart/form-data">

          <label for="single_player_id"></label>
          <input type="hidden" id="single_player_id" name="id" value="<?= $content_id ?>">

          <label for="single_player_id_users"></label>
          <input type="hidden" id="single_player_id_users" name="id_users" value="<?= $content_id_user ?>">

          <label for="single_player_edit_title"></label>
          <input type="text" class="inputbox" value="<?= $content_title ?>" placeholder="<?= $content_title ?>" id="single_player_edit_title" name="title" />

          <label for="single_player_edit_composer"></label>
          <input type="text" class="inputbox" value="<?= $content_composer ?>" placeholder="<?= $content_composer ?>" id="single_player_edit_composer" name="composer" />

          <label for="single_player_edit_description"></label>
          <textarea class="inputbox" value="<?= $content_description ?>" id="single_player_edit_description" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);"><?= $content_description ?></textarea>

          <?php if ($content_category == 'Tutorial') {
            $content_category = 'tutorial';
          } else if ($content_category == 'Performance') {
            $content_category = 'performance';
          } else if ($content_category == 'Sheet Music') {
            $content_category = 'sheet_music';
          } ?>

          <label for="single_player_edit_category"></label>
          <select class="inputbox" id="single_player_edit_category" name="category">
            <option value="<?= $content_category ?>"><?= $content_category ?></option>
            <option value="tutorial">Tutorial</option>
            <option value="performance">Performances</option>
            <option value="sheet_music">Sheet Music</option>
          </select>

          <label for="single_player_edit_level"></label>
          <select class="inputbox" id="single_player_edit_level" name="level">
            <option value="<?= $content_level ?>"><?= $content_level ?></option>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
            <option value="very-hard">Very Hard</option>
          </select>

          <label for="single_player_edit_content"></label>
          <input type="file" class="inputbox" id="single_player_edit_content" name="content" onchange="javascript: return validContent('single_player_edit')" />

          <label for="single_player_edit_price">Price : from 1 to 50 or free (type 'Free')</label>
          <input type="text" class="inputbox" value="<?= $content_price ?>" placeholder="<?= $content_price ?>" id="single_player_edit_price" pattern="^([1-9]|[1-4][0-9]|50|Free)$" name="price" />

          <button type="submit" class="button">Edit</button>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="comment_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/assets/actions/post_comment_action.php" method="post">

          <label for="single_player_id_comment"></label>
          <input type="hidden" id="single_player_id_comment" name="id" value="<?= $content_id ?>">

          <label for="single_player_comment">Your comment</label>
          <textarea class="inputbox text" id="single_player_comment" name="comment"></textarea>

          <button type="submit" class="button">Post Comment</button>
          <div class="button" id="comment_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="report_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/assets/actions/reporting_action.php" method="post">

          <label for="single_player_id_report"></label>
          <input type="hidden" id="single_player_id_report" name="id" value="<?= $content_id ?>">

          <label for="single_player_report">Want to report this content? Any improper reporting will result in consequences.</label>
          <textarea class="inputbox text" id="single_player_report" name="message"></textarea>

          <button type="submit" class="button red">Report</button>
          <div class="button" id="report_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>