<div id="search_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/content.php?category=search_results" method="post">

          <h2>Search for content</h2>
          <br>

          <div>To see all content do not fill in anything. Just click on the search button</div>

          <label for="search_title"></label>
          <input type="text" class="inputbox" placeholder="Title" id="search_title" name="title" onkeyup="javascript:input(this,'search_title',26, 'input_title');" />

          <label for="search_composer"></label>
          <input type="text" class="inputbox" placeholder="Composer" id="search_composer" name="composer" onkeyup="javascript:input(this,'search_composer',26, 'input_composer');" />

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

          <button type="submit" class="button green">Search</button>
          <div class="button green" id="search_close">Close</div>
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

            <h2>Contact an administrator</h2>
            <br>

            <label for=" contact_message"></label>
            <textarea class="inputbox text" placeholder="Your message (max 10000 chars)" id="contact_message" name="message" onkeyup="javascript:input(this,'contact_message',10000, 'input_contact');" required></textarea>

            <button type="submit" class="button orange">Post</button>
            <div class="button green" id="contact_close">Close</div>

          <?php } else { ?>

            <div>You are not logged in</div>
            <div class="button green" id="contact_close">Close</div>

          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>


<div id="edit_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/assets/actions/edit_content_action.php?type=user" method="post" enctype="multipart/form-data">

          <label for="single_player_id"></label>
          <input type="hidden" id="single_player_id" name="id" value="<?= $getContentAndUserInformations_id ?>">

          <label for="single_player_id_users"></label>
          <input type="hidden" id="single_player_id_users" name="id_users" value="<?= $getContentAndUserInformations_id_user ?>">

          <label for="single_player_reporting"></label>
          <input type="hidden" id="single_player_reporting" name="reporting" value="<?= htmlspecialchars($getContentAndUserInformations['reporting']) ?>">

          <h2>Edit Content</h2>
          <br>

          <label for="single_player_edit_title"></label>
          <input type="text" class="inputbox" value="<?= $getContentAndUserInformations_title ?>" placeholder="<?= $getContentAndUserInformations_title ?>" id="single_player_edit_title" name="title" onkeyup="javascript:input(this,'single_player_edit_title',21, 'input_title');" />

          <label for="single_player_edit_composer"></label>
          <input type="text" class="inputbox" value="<?= $getContentAndUserInformations_composer ?>" placeholder="<?= $getContentAndUserInformations_composer ?>" id="single_player_edit_composer" name="composer" onkeyup="javascript:input(this,'single_player_edit_composer',21, 'input_composer');" />

          <label for="single_player_edit_description"></label>
          <textarea class="inputbox text" value="<?= $getContentAndUserInformations_description ?>" placeholder="<?= $getContentAndUserInformations_description ?>" id="single_player_edit_description" name="description" onkeyup="javascript:input(this,'single_player_edit_description',251, 'input_description');"><?= $getContentAndUserInformations_description ?></textarea>

          <?php if ($getContentAndUserInformations_category == 'Tutorial') {
            $getContentAndUserInformations_category = 'tutorial';
          } else if ($getContentAndUserInformations_category == 'Performance') {
            $getContentAndUserInformations_category = 'performance';
          } else if ($getContentAndUserInformations_category == 'Sheet Music') {
            $getContentAndUserInformations_category = 'sheet_music';
          } ?>

          <label for="single_player_edit_category"></label>
          <select class="inputbox" id="single_player_edit_category" name="category">
            <option value="<?= $getContentAndUserInformations_category ?>"><?= $getContentAndUserInformations_category ?></option>
            <option value="tutorial">Tutorial</option>
            <option value="performance">Performances</option>
            <option value="sheet_music">Sheet Music</option>
          </select>

          <label for="single_player_edit_level"></label>
          <select class="inputbox" id="single_player_edit_level" name="level">
            <option value="<?= $getContentAndUserInformations_level ?>"><?= $getContentAndUserInformations_level ?></option>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
            <option value="very-hard">Very Hard</option>
          </select>

          <label for="single_player_edit_content">Files format : webm/mp4/ogv 128 Mo max.</label>
          <input type="file" class="inputbox" id="single_player_edit_content" name="content" onchange="javascript:validContent('single_player_edit')" />

          <label for="single_player_edit_price">Price : (from 1 to 500 or free (type 'Free'))</label>
          <input type="text" class="inputbox" value="<?= $getContentAndUserInformations_price ?>" placeholder="<?= $getContentAndUserInformations_price ?>" id="single_player_edit_price" name="price" onkeyup="javascript:input(this,'single_player_edit_price',5, 'input_price');" />

          <button type="submit" class="button orange">Edit</button>
          <div class="button green" id="edit_close">Close</div>

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
          <input type="hidden" id="single_player_id_comment" name="id" value="<?= $getContentAndUserInformations_id ?>">

          <h2>Your comment</h2>
          <br>

          <label for="single_player_comment">Comment : (|\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-|)</label>
          <textarea class="inputbox text" id="single_player_comment" name="comment" onkeyup="javascript:input(this,'single_player_comment',10000, 'input_contact');" required></textarea>

          <button type="submit" class="button green">Post Comment</button>
          <div class="button green" id="comment_close">Close</div>

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
          <input type="hidden" id="single_player_id_report" name="id" value="<?= $getContentAndUserInformations_id ?>">

          <h2>Want to report this content? Any improper reporting will result in consequences.</h2>
          <br>

          <label for="single_player_report">Message : (|\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-|)</label>
          <textarea class="inputbox text" id="single_player_report" name="message" onkeyup="javascript:input(this,'single_player_report',10000, 'input_contact');" required></textarea>

          <button type="submit" class="button red">Report</button>
          <div class="button green" id="report_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="delete_content_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form data-barba-prevent class="form_action" action="/Diplome/assets/actions/delete_content_action.php?id=<?= $getContentAndUserInformations_id ?>&type=user" method="post">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <h2>Are you sure you want to delete these content ? This action is irreversible !</h2>
          <br>

          <button type="submit" class="button red">Delete</button>
          <div class="button green" id="delete_content_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="delete_users_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form data-barba-prevent class="form_action" action="/Diplome/assets/actions/delete_users_action.php?id=<?= $session_users_id ?>&type=user" method="post">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <h2>Are you sure you want to delete your account and all your content ? This action is irreversible !</h2>
          <br>

          <button type="submit" class="button red">Delete</button>
          <div class="button green" id="delete_users_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="like_content_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="./assets/actions/like_action.php?name=content&id=<?= $getContentAndUserInformations_id ?>" method="post">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <br>

          <?php
          $message = "Like " . $getContentAndUserInformations_author_name . " " . $getContentAndUserInformations_author_lastname . "'s content ?";
          ?>

          <div><?= nl2br($message) ?></div>

          <button type="submit" class="button green">Like</button>
          <div class="button green" id="like_content_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>