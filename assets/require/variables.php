<?php

if (isset($getRandomTuto) && !empty($getRandomTuto)) {

  $getRandomTuto_id = htmlspecialchars($getRandomTuto['id']);
  $getRandomTuto_title = htmlspecialchars($getRandomTuto['title']);
  $getRandomTuto_content = htmlspecialchars($getRandomTuto['content']);
  $getRandomTuto_image = explode('.', $getRandomTuto_content);
  $getRandomTuto_price = htmlspecialchars($getRandomTuto['price']);
  $getRandomTuto_composer = htmlspecialchars($getRandomTuto['composer']);
  $getRandomTuto_category = htmlspecialchars($getRandomTuto['category']);
  $getRandomTuto_level = htmlspecialchars($getRandomTuto['level']);
  $getRandomTuto_description = str_replace('<br />', '', nl2br(htmlspecialchars($getRandomTuto['description'])));
  $getRandomTuto_likes = htmlspecialchars($getRandomTuto['likes']);
  $getRandomTuto_id_users = htmlspecialchars($getRandomTuto['id_users']);
}

if (isset($getRandomPerf) && !empty($getRandomPerf)) {

  $getRandomPerf_id = htmlspecialchars($getRandomPerf['id']);
  $getRandomPerf_title = htmlspecialchars($getRandomPerf['title']);
  $getRandomPerf_content = htmlspecialchars($getRandomPerf['content']);
  $getRandomPerf_image = explode('.', $getRandomPerf_content);
  $getRandomPerf_price = htmlspecialchars($getRandomPerf['price']);
  $getRandomPerf_composer = htmlspecialchars($getRandomPerf['composer']);
  $getRandomPerf_category = htmlspecialchars($getRandomPerf['category']);
  $getRandomPerf_level = htmlspecialchars($getRandomPerf['level']);
  $getRandomPerf_description = str_replace('<br />', '', nl2br(htmlspecialchars($getRandomPerf['description'])));
  $getRandomPerf_likes = htmlspecialchars($getRandomPerf['likes']);
  $getRandomPerf_id_users = htmlspecialchars($getRandomPerf['id_users']);
}

if (isset($getRandomSheet) && !empty($getRandomSheet)) {

  $getRandomSheet_id = htmlspecialchars($getRandomSheet['id']);
  $getRandomSheet_title = htmlspecialchars($getRandomSheet['title']);
  $getRandomSheet_content = htmlspecialchars($getRandomSheet['content']);
  $getRandomSheet_image = explode('.', $getRandomSheet_content);
  $getRandomSheet_price = htmlspecialchars($getRandomSheet['price']);
  $getRandomSheet_composer = htmlspecialchars($getRandomSheet['composer']);
  $getRandomSheet_category = htmlspecialchars($getRandomSheet['category']);
  $getRandomSheet_level = htmlspecialchars($getRandomSheet['level']);
  $getRandomSheet_description = str_replace('<br />', '', nl2br(htmlspecialchars($getRandomSheet['description'])));
  $getRandomSheet_likes = htmlspecialchars($getRandomSheet['likes']);
  $getRandomSheet_id_users = htmlspecialchars($getRandomSheet['id_users']);
}

if (isset($getContent) && !empty($getContent)) {

  $getContent_id = htmlspecialchars($getContent['id']);
  $getContent_title = htmlspecialchars($getContent['title']);
  $getContent_composer = htmlspecialchars($getContent['composer']);
  $getContent_category = htmlspecialchars($getContent['category']);
  $getContent_level = htmlspecialchars($getContent['level']);
  $getContent_video = htmlspecialchars($getContent['content']);
  $getContent_image = explode('.', $getContent_video);
  $getContent_price = htmlspecialchars($getContent['price']);
  $getContent_description = str_replace('<br />', '', nl2br(htmlspecialchars($getContent['description'])));
  $getContent_likes = htmlspecialchars($getContent['likes']);
  $getContent_id_user = htmlspecialchars($getContent['id_users']);

  if ($getContent_category == 'tutorial') {
    $getContent_category = 'Tutorial';
  } else if ($getContent_category == 'performance') {
    $getContent_category = 'Performance';
  } else if ($getContent_category == 'sheet_music') {
    $getContent_category = 'Sheet Music';
  }
}

if (isset($getUserContentInformations) && !empty($getUserContentInformations)) {

  $getUserContentInformations_name = htmlspecialchars($getUserContentInformations['name']);
  $getUserContentInformations_lastname = htmlspecialchars($getUserContentInformations['lastname']);
}

if (isset($getUserInformations) && !empty($getUserInformations)) {

  $getUserInformations_id = htmlspecialchars($getUserInformations['id']);
  $getUserInformations_name = htmlspecialchars($getUserInformations['name']);
  $getUserInformations_lastname = htmlspecialchars($getUserInformations['lastname']);
  $getUserInformations_email = htmlspecialchars($getUserInformations['email']);
  $getUserInformations_type = htmlspecialchars($getUserInformations['type']);
  $getUserInformations_credits = htmlspecialchars($getUserInformations['credits']);
}

if (isset($getNotification) && !empty($getNotification)) {

  $getNotification_id = htmlspecialchars($getNotification['id']);
  $getNotification_text = str_replace('<br />', '', nl2br(htmlspecialchars($getNotification['notification'])));
  $getNotification_date = htmlspecialchars($getNotification['date']);
}

if (isset($getContentAndUserInformations) && !empty($getContentAndUserInformations)) {

  $getContentAndUserInformations_id = htmlspecialchars($getContentAndUserInformations['id']);
  $getContentAndUserInformations_title = htmlspecialchars($getContentAndUserInformations['title']);
  $getContentAndUserInformations_composer = htmlspecialchars($getContentAndUserInformations['composer']);
  $getContentAndUserInformations_category = htmlspecialchars($getContentAndUserInformations['category']);
  $getContentAndUserInformations_level = htmlspecialchars($getContentAndUserInformations['level']);
  $getContentAndUserInformations_video = htmlspecialchars($getContentAndUserInformations['content']);
  $getContentAndUserInformations_price = htmlspecialchars($getContentAndUserInformations['price']);
  $getContentAndUserInformations_description = str_replace('<br />', '', nl2br(htmlspecialchars($getContentAndUserInformations['description'])));
  $getContentAndUserInformations_likes = htmlspecialchars($getContentAndUserInformations['likes']);
  $getContentAndUserInformations_id_user = htmlspecialchars($getContentAndUserInformations['id_users']);
  $getContentAndUserInformations_author_name = htmlspecialchars($getContentAndUserInformations['name']);
  $getContentAndUserInformations_author_lastname = htmlspecialchars($getContentAndUserInformations['lastname']);
}

if (isset($getComment) && !empty($getComment)) {

  $getComment_id = htmlspecialchars($getComment['id']);
  $getComment_user_id = htmlspecialchars($getComment['id_users']);
  $getComment_user_name = htmlspecialchars($getComment['name']);
  $getComment_user_lastname = htmlspecialchars($getComment['lastname']);
  $getComment_text = str_replace('<br />', '', nl2br(htmlspecialchars($getComment['comment'])));
  $getComment_date = htmlspecialchars($getComment['date']);
  $getComment_likes = htmlspecialchars($getComment['likes']);
}

if (isset($getNumbersOfcomments) && !empty($getNumbersOfcomments)) {

  $getNumbersOfcomments_from_user = htmlspecialchars(implode($getNumbersOfcomments));
}
