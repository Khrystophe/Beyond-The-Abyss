<?php
if (isset($get_error) || isset($get_success)) {

  $messages = [
    1 => 'You haven\'t posted any content yet',
    2 => 'You haven\'t purchased any content yet',
    3 => 'This category does not exist',
    4 => 'Please don\'t reload the page 

    Use the menu to navigate the site',
    5 => 'An error has occurred',
    6 => 'You are already connected',
    7 => 'The use of cookies is necessary for the proper functioning of this site. 
    Please enable the use of cookies in your browser.
    
    If you have just created your account, it is active. All you have to do is connect, having previously activated the use of cookies in your browser.',
    8 => 'An error has occurred or you are not connected',
    9 => 'This content does not exist',
    10 => 'You have not buy this content',
    11 => 'Your reporting have been sent 

    Check notifications in your account',
    12 => 'The creation of your account is a success',
    13 => 'Contact an administrator',
    14 => 'Your password confirmation is wrong',
    15 => 'This email is already in use',
    16 => 'Your comment is posted',
    17 => 'You have been disconnected',
    18 => 'You are logged into your account',
    19 => 'Your password is wrong',
    20 => 'This user does not exist',
    21 => 'Your like has been taken into account',
    22 => 'You have already liked this content',
    23 => 'Your like has been taken into account',
    24 => 'You have already liked this comment',
    25 => 'Password changed successfully',
    26 => 'Your old password is wrong',
    27 => 'Your name/lastname have been changed successfully',
    28 => 'This content has been flagged

    You can no longer edit or delete it until an administrator has reviewed it',
    29 => 'The file you tried to post is too big. Respect the 128 MB maximum',
    30 => 'The file could not be recovered',
    31 => 'Content edited successfully',
    32 => 'Your comment has been edited successfully',
    33 => 'User deleted successfully',
    34 => 'As an administrator, you cannot modify some informations about yourself 

    Please access your account to change what you are allowed to change 

    If you want to delete your account, contact another administrator',
    35 => 'The notification has been deleted',
    36 => 'The content has been deleted',
    37 => 'Your message has been sent

    An administrator will answer you as soon as possible',
    38 => 'Your purchase has been taken into account',
    39 => 'Your sold of credit is insufficient',
    40 => 'You are not an administrator

    Please use this site correctly',
    41 => 'Reply sent',
    42 => 'User edited',
    43 => 'Purchased content deleted',
    44 => 'Message deleted',
    45 => 'Comment deleted',
    46 => 'You have been logged out automatically because you have been inactive for too long',
    47 => 'This content is not free 
    
    Log in or register

    For any new registration you will get 500 credits
    
    Otherwise you can use the search function to see free content',
    48 => 'Your account has been deleted successfully',
    49 => 'Your search result is empty',
    50 => '!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!EMPTY!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',
    51 => 'This content has been flagged

    You can no longer edit or delete it until an administrator has reviewed it',
    52 => 'Your content has been edited successfully',
    53 => 'An error has occurred',
    54 => 'The file you tried to post is too big. Respect the 128 MB maximum',
    55 => 'The file could not be recovered',
    56 => 'Your content has been deleted',
    57 => 'Content add with success',
    58 => 'Content add with success',
    59 => 'User none exist. Use the menu to navigate the site',
    60 => 'User edited',
    61 => 'Reporting deleted',
    62 => 'No content sorry',
    63 => 'You are not connected'
  ];

  if (isset($get_error)) {

    if ((in_array($messages[substr($get_error, 4)], $messages)) == true) {

      $message = $messages[substr($get_error, 4)];
    } else {

      header('location: index.php?error= 00115');
      die();
    }
  } else if (isset($get_success)) {

    if ((in_array($messages[substr($get_success, 4)], $messages)) == true) {

      $message = $messages[substr($get_success, 4)];
    } else {

      header('location: index.php?error= 00115');
      die();
    }
  }

?>

  <div id="messages_modal" class="modal_messages">
    <div class="modal-content">
      <div class="modal_form">
        <div class="modal_form_content messages">
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


<div id="input_modal" class="modal_messages">
  <div class="modal-content">
    <div class="modal_form">
      <div class="modal_form_content messages">
        <form class="form_action">

          <div class="messages_logo">
            <img src="./assets/img/musicgrise.png" alt="" />
          </div>

          <br>

          <div id="input_price">Price : (from 1 to 500 or free (type 'Free'))</div>
          <div id="input_contact">Respect format : (|\s0-9a-zA-Zéèêàçù# ()'".!?,;:°-| max 10000 chars )</div>
          <div id="input_description">Respect format : (|\s0-9a-zA-Zéèêàçù# ()'".!?,;:°-| max 250 chars )</div>
          <div id="input_composer">Respect format : (|0-9a-zA-Zéèêàçù -| max 20 chars )</div>
          <div id="input_title">Respect format : (|0-9a-zA-Zéèêàçù '"!?°-| max 20 chars )</div>
          <div id="input_password">Respect format : (|0-9a-zA-Z|) min 2 max 40 chars</div>
          <div id="input_name_lastname">Respect format : (|a-zA-Zéèêàçù '"-| min 1 max 10 chars)</div>
          <div id="input_content">Respect files format : |0-9a-zA-Zéèêàçù# ()\'!,;°-| |.| |webm/mp4/ogv| and 128 Mo max.</div>

        </form>
      </div>
    </div>
  </div>
</div>