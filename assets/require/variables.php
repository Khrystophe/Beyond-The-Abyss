<?php

if (isset($getRandomTuto) && !empty($getRandomTuto)) {

  $random_tuto_id = htmlspecialchars($getRandomTuto['id']);
  $random_tuto_title = htmlspecialchars($getRandomTuto['title']);
  $random_tuto_content = htmlspecialchars($getRandomTuto['content']);
  $random_tuto_price = htmlspecialchars($getRandomTuto['price']);
  $random_tuto_composer = htmlspecialchars($getRandomTuto['composer']);
  $random_tuto_category = htmlspecialchars($getRandomTuto['category']);
  $random_tuto_level = htmlspecialchars($getRandomTuto['level']);
  $random_tuto_description = nl2br(htmlspecialchars($getRandomTuto['description']));
  $random_tuto_likes = htmlspecialchars($getRandomTuto['likes']);
  $random_tuto_id_users = htmlspecialchars($getRandomTuto['id_users']);
}

if (isset($getRandomPerf) && !empty($getRandomPerf)) {

  $random_perf_id = htmlspecialchars($getRandomPerf['id']);
  $random_perf_title = htmlspecialchars($getRandomPerf['title']);
  $random_perf_content = htmlspecialchars($getRandomPerf['content']);
  $random_perf_price = htmlspecialchars($getRandomPerf['price']);
  $random_perf_composer = htmlspecialchars($getRandomPerf['composer']);
  $random_perf_category = htmlspecialchars($getRandomPerf['category']);
  $random_perf_level = htmlspecialchars($getRandomPerf['level']);
  $random_perf_description = nl2br(htmlspecialchars($getRandomPerf['description']));
  $random_perf_likes = htmlspecialchars($getRandomPerf['likes']);
  $random_perf_id_users = htmlspecialchars($getRandomPerf['id_users']);
}

if (isset($getRandomSheet) && !empty($getRandomSheet)) {

  $random_sheet_id = htmlspecialchars($getRandomSheet['id']);
  $random_sheet_title = htmlspecialchars($getRandomSheet['title']);
  $random_sheet_content = htmlspecialchars($getRandomSheet['content']);
  $random_sheet_price = htmlspecialchars($getRandomSheet['price']);
  $random_sheet_composer = htmlspecialchars($getRandomSheet['composer']);
  $random_sheet_category = htmlspecialchars($getRandomSheet['category']);
  $random_sheet_level = htmlspecialchars($getRandomSheet['level']);
  $random_sheet_description = nl2br(htmlspecialchars($getRandomSheet['description']));
  $random_sheet_likes = htmlspecialchars($getRandomSheet['likes']);
  $random_sheet_id_users = htmlspecialchars($getRandomSheet['id_users']);
}

if (isset($getUserInformations) && !empty($getUserInformations)) {

  $user_session_id = htmlspecialchars($getUserInformations['id']);
  $user_session_credits = htmlspecialchars($getUserInformations['credits']);
}

if (isset($getContentOfPageContent) && !empty($getContentOfPageContent)) {

  $content_id = htmlspecialchars($getContentOfPageContent['id']);
  $content_title = htmlspecialchars($getContentOfPageContent['title']);
  $content_composer = htmlspecialchars($getContentOfPageContent['composer']);
  $content_category = htmlspecialchars($getContentOfPageContent['category']);
  $content_level = htmlspecialchars($getContentOfPageContent['level']);
  $content_video = htmlspecialchars($getContentOfPageContent['content']);
  $content_price = htmlspecialchars($getContentOfPageContent['price']);
  $content_description = nl2br(htmlspecialchars($getContentOfPageContent['description']));
  $content_likes = htmlspecialchars($getContentOfPageContent['likes']);
  $content_id_user = htmlspecialchars($getContentOfPageContent['id_users']);

  if ($content_category == 'tutorial') {
    $content_category = 'Tutorial';
  } else if ($content_category == 'performance') {
    $content_category = 'Performance';
  } else if ($content_category == 'sheet_music') {
    $content_category = 'Sheet Music';
  }
}

if (isset($getUserContentInformations) && !empty($getUserContentInformations)) {

  $user_content_id = htmlspecialchars($getUserContentInformations['id']);
  $user_content_name = htmlspecialchars($getUserContentInformations['name']);
  $user_content_lastname = htmlspecialchars($getUserContentInformations['lastname']);
}

if (isset($getUserInformations) && !empty($getUserInformations)) {

  $get_user_id = htmlspecialchars($getUserInformations['id']);
  $get_user_name = htmlspecialchars($getUserInformations['name']);
  $get_user_lastname = htmlspecialchars($getUserInformations['lastname']);
  $get_user_email = htmlspecialchars($getUserInformations['email']);
  $get_user_type = htmlspecialchars($getUserInformations['type']);
  $get_user_credits = htmlspecialchars($getUserInformations['credits']);
}

if (isset($getNotification) && !empty($getNotification)) {

  $notification_id = htmlspecialchars($getNotification['id']);
  $notification_text = nl2br(htmlspecialchars($getNotification['notification']));
  $notification_date = htmlspecialchars($getNotification['date']);
}
