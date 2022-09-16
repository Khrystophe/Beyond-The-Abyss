<div id="search_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/content.php?category=search_results" method="post">

          <h2>Search for content</h2>
          <br>

          <div>To see all content do not fill in anything. Just click on the search button</div>

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
          <div class="button" id="search_close">Close</div>
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

            <label for=" contact_message">Message : (|\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-|)</label>
            <textarea class="inputbox text" id="contact_message" name="message" pattern="^[\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-]+$" required></textarea>

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


<div id="edit_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/assets/actions/edit_content_action.php?type=user" method="post" enctype="multipart/form-data">

          <label for="single_player_id"></label>
          <input type="hidden" id="single_player_id" name="id" value="<?= $content_id ?>">

          <label for="single_player_id_users"></label>
          <input type="hidden" id="single_player_id_users" name="id_users" value="<?= $content_id_user ?>">

          <h2>Edit Content</h2>
          <br>

          <label for="single_player_edit_title">Title : (|0-9a-zA-Zéèêàçù '!?°-| max 25 chars )</label>
          <input type="text" class="inputbox" value="<?= $content_title ?>" placeholder="<?= $content_title ?>" id="single_player_edit_title" name="title" pattern="^[0-9a-zA-Zéèêàçù '!?°-]+$" maxlength="25" />

          <label for="single_player_edit_composer">Composer : (|0-9a-zA-Zéèêàçù -| max 25 chars )</label>
          <input type="text" class="inputbox" value="<?= $content_composer ?>" placeholder="<?= $content_composer ?>" id="single_player_edit_composer" name="composer" pattern="^[0-9a-zA-Zéèêàçù -]+$" maxlength="25" />

          <label for="single_player_edit_description">Description : (|\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-| max 250 chars )</label>
          <textarea class="inputbox text" value="<?= $content_description ?>" id="single_player_edit_description" name="description" pattern="^[\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-]+$" onkeyup="javascript:MaxLengthDescription(this, 250);"><?= $content_description ?></textarea>

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

          <label for="single_player_edit_content">Files format : (|0-9a-zA-Zéèêàçù# ()'!,;°-| |.| |webm/mp4/ogv|) and 128 Mo max.</label>
          <input type="file" class="inputbox" id="single_player_edit_content" name="content" onchange="javascript: return validContent('single_player_edit')" />

          <label for="single_player_edit_price">Price : (from 1 to 500 or free (type 'Free'))</label>
          <input type="text" class="inputbox" value="<?= $content_price ?>" placeholder="<?= $content_price ?>" id="single_player_edit_price" pattern="^([1-9]|[1-9][0-9]|[1-4][0-9][0-9]|500|Free)$" name="price" />

          <button type="submit" class="button">Edit</button>
          <div class="button" id="edit_close">Close</div>

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

          <h2>Your comment</h2>
          <br>

          <label for="single_player_comment">Comment : (|\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-|)</label>
          <textarea class="inputbox text" id="single_player_comment" name="comment" pattern="^[\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-]+$" required></textarea>

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

          <h2>Want to report this content? Any improper reporting will result in consequences.</h2>
          <br>

          <label for="single_player_report">Message : (|\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-|)</label>
          <textarea class="inputbox text" id="single_player_report" name="message" pattern="^[\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-]+$" required></textarea>

          <button type="submit" class="button red">Report</button>
          <div class="button" id="report_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="delete_content_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form data-barba-prevent class="form_action" action="/Diplome/assets/actions/delete_content_action.php?id=<?= $content_id ?>&type=user" method="post">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <h2>Are you sure you want to delete these content ? This action is irreversible !</h2>
          <br>

          <button type="submit" class="button red">Delete</button>
          <div class="button" id="delete_content_close">Close</div>

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
          <div class="button" id="delete_users_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="like_content_modal" class="modal messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="./assets/actions/like_action.php?name=content&id=<?= $content_id ?>" method="post">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <br>

          <?php
          $message = "Like " . $content_author_name . " " . $content_author_lastname . "'s content ?";
          ?>

          <div><?= nl2br($message) ?></div>

          <button type="submit" class="button">Like</button>
          <div class="button" id="like_content_close">Close</div>

        </form>
      </div>
    </div>
  </div>
</div>