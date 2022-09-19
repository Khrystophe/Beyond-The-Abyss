<?php

if (isset($getUser) && !empty($getUser)) {

  $getUser_id = htmlspecialchars($getUser['id']);
  $getUser_name = htmlspecialchars($getUser['name']);
  $getUser_last_name = htmlspecialchars($getUser['lastname']);
  $getUser_email = htmlspecialchars($getUser['email']);
  $getUser_credits = htmlspecialchars($getUser['credits']);
  $getUser_type = htmlspecialchars($getUser['type']);
}

if (isset($getReporting) && !empty($getReporting)) {

  $getReporting_id = htmlspecialchars($getReporting['id']);
  $getReporting_message = nl2br(htmlspecialchars($getReporting['message']));
  $getReporting_date = htmlspecialchars($getReporting['date']);
  $getReporting_id_users = htmlspecialchars($getReporting['id_users']);
  $getReporting_id_contents = htmlspecialchars($getReporting['id_contents']);
}

if (isset($getUserInformations) && !empty($getUserInformations)) {

  $getUserInformations_name = htmlspecialchars($getUserInformations['name']);
  $getUserInformations_lastname = htmlspecialchars($getUserInformations['lastname']);
  $getUserInformations_email = htmlspecialchars($getUserInformations['email']);
}

if (isset($getContentInformations) && !empty($getContentInformations)) {

  $getContentInformations_title = htmlspecialchars($getContentInformations['title']);
  $getContentInformations_composer = htmlspecialchars($getContentInformations['composer']);
}

if (isset($getPurchased_content) && !empty($getPurchased_content)) {

  $getPurchased_content_id = htmlspecialchars($getPurchased_content['id']);
  $getPurchased_content_id_contents = htmlspecialchars($getPurchased_content['id_contents']);
  $getPurchased_content_id_users = htmlspecialchars($getPurchased_content['id_users']);
  $getPurchased_content_original_price = htmlspecialchars($getPurchased_content['original_price']);
  $getPurchased_content_buyer_repayment = htmlspecialchars($getPurchased_content['buyer_repayment']);
}

if (isset($getNotification) && !empty($getNotification)) {

  $getNotification_id = htmlspecialchars($getNotification['id']);
  $getNotification_message = nl2br(htmlspecialchars($getNotification['notification']));
  $getNotification_date = htmlspecialchars($getNotification['date']);
  $getNotification_id_users = htmlspecialchars($getNotification['id_users']);
}

if (isset($getAllContent) && !empty($getAllContent)) {

  $getAllContent_id = htmlspecialchars($getAllContent['id']);
  $getAllContent_title = htmlspecialchars($getAllContent['title']);
  $getAllContent_composer = htmlspecialchars($getAllContent['composer']);
  $getAllContent_video = htmlspecialchars($getAllContent['content']);
  $getAllContent_category = htmlspecialchars($getAllContent['category']);
  $getAllContent_level = htmlspecialchars($getAllContent['level']);
  $getAllContent_description = nl2br(htmlspecialchars($getAllContent['description']));
  $getAllContent_price = htmlspecialchars($getAllContent['price']);
  $getAllContent_likes = htmlspecialchars($getAllContent['likes']);
  $getAllContent_reporting = htmlspecialchars($getAllContent['reporting']);
  $getAllContent_id_users = htmlspecialchars($getAllContent['id_users']);
}

if (isset($getContact) && !empty($getContact)) {

  $getContact_id = htmlspecialchars($getContact['id']);
  $getContact_message = nl2br(htmlspecialchars($getContact['message']));
  $getContact_date = htmlspecialchars($getContact['date']);
  $getContact_id_users = htmlspecialchars($getContact['id_users']);
}

if (isset($getComment) && !empty($getComment)) {

  $getComment_id = htmlspecialchars($getComment['id']);
  $getComment_message = nl2br(htmlspecialchars($getComment['comment']));
  $getComment_date = htmlspecialchars($getComment['date']);
  $getComment_likes = htmlspecialchars($getComment['likes']);
  $getComment_id_contents = htmlspecialchars($getComment['id_contents']);
  $getComment_id_users = htmlspecialchars($getComment['id_users']);
}
