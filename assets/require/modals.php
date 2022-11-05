<div id="search_modal" class="modal messages">
  <div class="modal_content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/content.php?category=search_results" method="post">

          <h2>Search for content</h2>
          <br>

          <div>To see all content do not fill in anything. Just click on the search button</div>

          <label for="search_title"></label>
          <div class="autocomplete">
            <input type="text" class="inputbox" placeholder="Title" id="search_title" name="title" onkeyup="javascript:input(this,'search_title',26, 'input_title');" />
          </div>

          <label for="search_composer"></label>
          <div class="autocomplete">
            <input type="text" class="inputbox" placeholder="Composer" id="search_composer" name="composer" onkeyup="javascript:input(this,'search_composer',26, 'input_composer');" />
          </div>

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

          <button type="submit" class="button gray">Search</button>

          <div class="flex_close">
            <div class="button gray" id="search_close">Close</div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="contact_modal" class="modal messages">
  <div class="modal_content">
    <div class="modal_form">
      <div class="modal_form_content">

        <form class="form_action" action="/Diplome/assets/actions/contact_action.php" method="post">


          <?php if (isset($session_users_id)) { ?>


            <label for="contact_id"></label>
            <input type="hidden" id="contact_id" name="id" value="<?= $session_users_id ?>">

            <h2>Contact an administrator</h2>
            <br>

            <label for=" contact_message"></label>
            <textarea class="inputbox text" placeholder="Your message (max 10000 chars)" id="contact_message" name="message" onkeyup="javascript:input(this,'contact_message',10000, 'input_contact');" required></textarea>

            <button type="submit" class="button gray">Post</button>

            <div class="flex_close">
              <div class="button gray" id="contact_close">Close</div>
            </div>


          <?php } else { ?>


            <div>You are not logged in</div>

            <div class="flex_close">
              <button type="button" class="button gray" id="contact_close">Close</button>
            </div>


          <?php } ?>


        </form>
      </div>
    </div>
  </div>
</div>


<?php if (isset($getContentAndUserInformations) && !empty($getContentAndUserInformations)) { ?>

  <div id="edit_modal" class="modal messages">
    <div class="modal_content">
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
            <textarea class="inputbox text" value="<?= $getContentAndUserInformations_description ?>" placeholder="<?= $getContentAndUserInformations_description ?>" id="single_player_edit_description" name="description" onkeyup="javascript:input(this,'single_player_edit_description',1501, 'input_description');"><?= $getContentAndUserInformations_description ?></textarea>

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

            <?php if ($getContentAndUserInformations_price == '0') {
              $getContentAndUserInformations_price = 'Free';
            } ?>

            <label for="single_player_edit_price">Price : from 1 to 500 or free (type 'Free')</label>
            <input type="text" class="inputbox" value="<?= $getContentAndUserInformations_price ?>" placeholder="<?= $getContentAndUserInformations_price ?>" id="single_player_edit_price" name="price" onkeyup="javascript:input(this,'single_player_edit_price',5, 'input_price');" />

            <button type="submit" class="button gray">Edit</button>

            <div class="flex_close">
              <div class="button gray" id="edit_close">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="comment_modal" class="modal messages">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form class="form_action" action="/Diplome/assets/actions/post_comment_action.php" method="post">

            <label for="single_player_id_comment"></label>
            <input type="hidden" id="single_player_id_comment" name="id" value="<?= $getContentAndUserInformations_id ?>">

            <h2>Your comment</h2>
            <br>

            <label for="single_player_comment"></label>
            <textarea class="inputbox text" id="single_player_comment" name="comment" onkeyup="javascript:input(this,'single_player_comment',10000, 'input_contact');" required></textarea>

            <button type="submit" class="button gray">Post Comment</button>

            <div class="flex_close">
              <div class="button gray" id="comment_close">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>




  <div id="report_modal" class="modal messages">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form class="form_action" action="/Diplome/assets/actions/reporting_action.php" method="post">

            <label for="single_player_id_report"></label>
            <input type="hidden" id="single_player_id_report" name="id" value="<?= $getContentAndUserInformations_id ?>">

            <h2>Want to report this content? Any improper reporting will result in consequences.</h2>
            <br>

            <label for="single_player_report"></label>
            <textarea class="inputbox text" id="single_player_report" name="message" onkeyup="javascript:input(this,'single_player_report',10000, 'input_contact');" required></textarea>

            <button type="submit" class="button gray">Report</button>

            <div class="flex_close">
              <div class="button gray" id="report_close">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <div id="delete_content_modal" class="modal messages">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form data-barba-prevent class="form_action" action="/Diplome/assets/actions/delete_content_action.php?id=<?= $getContentAndUserInformations_id ?>&type=user" method="post">

            <div class="messages_logo">
              <img src="./assets/img/musicgrise.png" alt="" />
            </div>

            <h2>Are you sure you want to delete these content ? This action is irreversible !</h2>
            <br>

            <button type="submit" class="button gray">Delete</button>

            <div class="flex_close">
              <div class="button gray" id="delete_content_close">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <div id="like_content_modal" class="modal messages">
    <div class="modal_content">
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

            <button type="submit" class="button gray">Like</button>

            <div class="flex_close">
              <div class="button gray" id="like_content_close">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<?php } ?>



<?php if (isset($session_users_id) && $page == 'my_account') { ?>

  <div id="delete_users_modal" class="modal messages">
    <div class="modal_content">
      <div class="modal_form">
        <div class="modal_form_content">

          <form data-barba-prevent class="form_action" action="/Diplome/assets/actions/delete_users_action.php?id=<?= $session_users_id ?>&type=user" method="post">

            <div class="messages_logo">
              <img src="./assets/img/musicgrise.png" alt="" />
            </div>

            <h2>Are you sure you want to delete your account and all your content ? This action is irreversible !</h2>
            <br>

            <button type="submit" class="button gray">Delete</button>

            <div class="flex_close">
              <div class="button gray" id="delete_users_close">Close</div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<?php } ?>


<div id="privacy_modal" class="modal messages">
  <div class="modal_content">
    <div class="modal_form">
      <div class="modal_form_content messages">
        <form class="form_action">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <br>

          <h2>Privacy Policy</h2>

          <br>

          <p>We are committed to maintaining the accuracy, confidentiality, and security of your personally identifiable information ("Personal Information"). As part of this commitment, our privacy policy governs our actions as they relate to the collection, use and disclosure of Personal Information. Our privacy policy is based upon the values set by the Canadian Standards Association's Model Code for the Protection of Personal Information and Canada's Personal Information Protection and Electronic Documents Act.</p>

          <br>

          <span> 1. Introduction</span>

          <br>
          <br>

          <p>We are responsible for maintaining and protecting the Personal Information under our control. We have designated an individual or individuals who is/are responsible for compliance with our privacy policy.</p>

          <br>

          <span>2. Identifying Purposes</span>

          <br>
          <br>

          <p>We collect, use and disclose Personal Information to provide you with the product or service you have requested and to offer you additional products and services we believe you might be interested in. The purposes for which we collect Personal Information will be identified before or at the time we collect the information. In certain circumstances, the purposes for which information is collected may be clear, and consent may be implied, such as where your name, address and payment information is provided as part of the order process.</p>


          <br>

          <span>3. Consent</span>

          <br>
          <br>

          <p>Knowledge and consent are required for the collection, use or disclosure of Personal Information except where required or permitted by law. Providing us with your Personal Information is always your choice. However, your decision not to provide certain information may limit our ability to provide you with our products or services. We will not require you to consent to the collection, use, or disclosure of information as a condition to the supply of a product or service, except as required to be able to supply the product or service.</p>

          <br>

          <span>4. Limiting Collection</span>

          <br>
          <br>

          <p>The Personal Information collected will be limited to those details necessary for the purposes identified by us. With your consent, we may collect Personal Information from you in person, over the telephone or by corresponding with you via mail, facsimile, or the Internet.</p>

          <br>

          <span>5. Limiting Use, Disclosure and Retention</span>

          <br>
          <br>

          <p>Personal Information may only be used or disclosed for the purpose for which it was collected unless you have otherwise consented, or when it is required or permitted by law. Personal Information will only be retained for the period of time required to fulfill the purpose for which we collected it or as may be required by law.</p>

          <br>

          <div class="flex_close">
            <div class="button gray" id="privacy_close">Close</div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<div id="terms_modal" class="modal messages">
  <div class="modal_content">
    <div class="modal_form">
      <div class="modal_form_content messages">
        <form class="form_action">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <br>

          <h2>Terms</h2>

          <br>

          <p>You agree to use our website for legitimate purposes and not for any illegal or unauthorized purpose, including without limitation, in violation of any intellectual property or privacy law. By agreeing to the Terms, you represent and warrant that you are at least the age of majority in your state or province of residence and are legally capable of entering into a binding contract.</p>

          <br>

          <p>You agree to not use our website to conduct any activity that would constitute a civil or criminal offence or violate any law. You agree not to attempt to interfere with our website’s network or security features or to gain unauthorized access to our systems.</p>

          <br>

          <p>You agree to provide us with accurate personal information, such as your email address, mailing address and other contact details in order to complete your order or contact you as needed. You agree to promptly update your account and information. You authorize us to collect and use this information to contact you in accordance with our Privacy Policy</p>

          <br>

          <div class="flex_close">
            <div class="button gray" id="terms_close">Close</div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<div id="about_modal" class="modal messages">
  <div class="modal_content">
    <div class="modal_form">
      <div class="modal_form_content messages">
        <form class="form_action">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <br>

          <h2>About</h2>

          <br>


          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis nisl vel justo tempus egestas. Nulla tincidunt nunc lorem, euismod varius sem volutpat in. Etiam a neque lobortis massa dignissim varius id laoreet purus. Sed in diam in lacus suscipit pellentesque nec nec ipsum. Cras accumsan lobortis turpis non mattis. Proin ac tincidunt diam. Vestibulum in ullamcorper orci. Maecenas eu eros massa. Proin et pellentesque erat. Donec ut consequat velit. Cras bibendum erat quis orci blandit efficitur.</p>

          <br>

          <p>Mauris sed mollis arcu. Mauris sem neque, vestibulum ut efficitur id, pulvinar sed mauris. Etiam consectetur pretium massa non feugiat. Phasellus aliquam enim in enim mollis rhoncus. Morbi vulputate ultricies aliquam. Mauris at posuere dui. Aliquam sit amet pellentesque dolor. Pellentesque quis lorem eu massa cursus interdum ultricies id mauris.</p>

          <br>

          <p>Curabitur eu diam eget velit cursus lobortis congue in eros. Quisque malesuada imperdiet purus. Nulla elit leo, feugiat sed feugiat ac, aliquam id eros. Suspendisse ut nunc sed odio dictum posuere nec vitae neque. Pellentesque gravida arcu odio, cursus tincidunt enim ultricies et. Donec a malesuada magna. Nulla posuere nisl sit amet mauris vehicula semper. Nunc ut metus lorem. Suspendisse nec tellus metus. Integer varius neque id ultricies condimentum. Fusce interdum enim et erat aliquam aliquam. Nullam fringilla ut ipsum sit amet fermentum.</p>

          <br>

          <div class="flex_close">
            <div class="button gray" id="about_close">Close</div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>