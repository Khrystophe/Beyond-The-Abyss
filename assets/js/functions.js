
function input(string, id, maxLength, index) {

    let array_regex ={
      'input_name_lastname' : /^(?!\s*$)[a-zA-Zéèêàçù \'-]+$/,
      'input_password' : /^[0-9a-zA-Z]+$/,
      'input_title' : /^[0-9a-zA-Zéèêàçù '!?°-]+$/,
      'input_composer' : /^[0-9a-zA-Zéèêàçù -]+$/,
      'input_description' : /^[\\s\r\n0-9a-zA-Zéèêàçù# ()'.!?,;:°-]+$/,
      'input_contact' : /^[\\s\r\n0-9a-zA-Zéèêàçù# ()'.!?,;:°-]+$/,
      'input_price' : /^([1-9]|[1-9][0-9]|[1-4][0-9][0-9]|500|[Free]+)$/,
  }
  
  let regex = array_regex[index];
  
  if (((string.value.match(regex)) && string.value.length < maxLength) || event.key === 'Tab' || event.key === 'Backspace' || event.key === 'Enter') {
    
    return true
    
  } else {
    
    string = document.getElementById(id).value;
    document.getElementById(id).value = string.substring(0, string.length - 1);
    
    let input_modal = document.getElementById(index+"_modal");
    
    input_modal.style.display = "flex"
    
    document.onclick = function() {
      input_modal.style.display = "none";
    }

    document.onkeydown= function() {
      input_modal.style.display = "none";
    }
  }
}


function validContent(page){

  let name = document.getElementById(page+'_content').files[0].name;
  let type = document.getElementById(page+'_content').files[0].type;
  let size = document.getElementById(page+'_content').files[0].size;
 
 
  let split_files_name = name.split(".");

  if( split_files_name.length == 2 ){

    let allowed_extensions = ["webm", "mp4", "ogv"];
    let allowed_mime_types = ["video/webm", "video/mp4", "video/ogv"];
    let check_files_name = ((typeof split_files_name[0] === 'string' || split_files_name[0] instanceof String) );
    let check_files_extension = allowed_extensions.includes(split_files_name[1].toLowerCase());
    let check_files_mime_type = allowed_mime_types.includes(type.toLowerCase());

    if( 
      split_files_name[0].match(/^[0-9a-zA-Zéèêàçù# ()'!,;°-]+$/)
      &&check_files_name === true 
      && check_files_extension === true
      && check_files_mime_type === true
      && size <= 128000000 ){
        
        return true;

      } else{

        document.getElementById(page+'_content').value = '';

        let valid_content_modal = document.getElementById("valid_content_modal");

        valid_content_modal.style.display = "flex"

        document.onclick = function() {
          valid_content_modal.style.display = "none";
        }
        
      }
  } else {

    document.getElementById(page+'_content').value= '';
    
    
    let valid_content_modal = document.getElementById("valid_content_modal");

    valid_content_modal.style.display = "flex"

    document.onclick = function() {
      valid_content_modal.style.display = "none";
    }

  }
}

let search_modal = document.getElementById("search_modal");
let search_button = document.getElementById("search_button");
let search_close = document.getElementById("search_close");

if (search_button != undefined){
    search_button.onclick = function() {
    search_modal.style.display = "flex";
  }
    search_close.onclick = function() {
    search_modal.style.display = "none";
  }
}


let edit_modal = document.getElementById("edit_modal");
let edit_button = document.getElementById("edit_button");
let edit_close = document.getElementById("edit_close");

if (edit_button != undefined){
    edit_button.onclick = function() {
    edit_modal.style.display = "flex";
  }
    edit_close.onclick = function() {
    edit_modal.style.display = "none";
  }
}


let comment_modal = document.getElementById("comment_modal");
let comment_button = document.getElementById("comment_button");
let comment_close = document.getElementById("comment_close");

if (comment_button != undefined){
    comment_button.onclick = function(){
    comment_modal.style.display = "flex";
  }
    comment_close.onclick = function() {
    comment_modal.style.display = "none";
  }
}


let contact_modal = document.getElementById("contact_modal");
let contact_button = document.getElementsByClassName("contact_button");
let contact_close = document.getElementById("contact_close");

for(let i=0; i < contact_button.length; i++){

  if (contact_button[i] != undefined){
      contact_button[i].onclick = function() {
      contact_modal.style.display = "flex";
    }
      contact_close.onclick = function() {
      contact_modal.style.display = "none";
    }
  }
}


let report_modal = document.getElementById("report_modal");
let report_button = document.getElementById("report_button");
let report_close = document.getElementById("report_close");

if (report_button != undefined){
    report_button.onclick = function() {
      report_modal.style.display = "flex";
  }
  report_close.onclick = function() {
    report_modal.style.display = "none";
  }
}


let delete_content_modal = document.getElementById("delete_content_modal");
let delete_content_button = document.getElementById("delete_content_button");
let delete_content_close = document.getElementById("delete_content_close");

if (delete_content_button != undefined){
    delete_content_button.onclick = function() {
      delete_content_modal.style.display = "flex";
  }
  delete_content_close.onclick = function() {
    delete_content_modal.style.display = "none";
  }
}


let delete_users_modal = document.getElementById("delete_users_modal");
let delete_users_button = document.getElementById("delete_users_button");
let delete_users_close = document.getElementById("delete_users_close");

if (delete_users_button != undefined){
    delete_users_button.onclick = function() {
      delete_users_modal.style.display = "flex";
  }
  delete_users_close.onclick = function() {
    delete_users_modal.style.display = "none";
  }
}


let like_content_modal = document.getElementById("like_content_modal");
let like_content_button = document.getElementById("like_content_button");
let like_content_close = document.getElementById("like_content_close");

  if (like_content_button != undefined){
      like_content_button.onclick = function() {
      like_content_modal.style.display = "flex";
    }
      like_content_close.onclick = function() {
      like_content_modal.style.display = "none";
    }
  }


window.onclick = function(event) { 

    if (event.target == search_modal){
    search_modal.style.display = "none";

  }else if (event.target == edit_modal) {
    edit_modal.style.display = "none";

  } else if (event.target == comment_modal){
    comment_modal.style.display = "none";

  }else if (event.target == contact_modal) {
    contact_modal.style.display = "none";

  }else if (event.target == report_modal) {
    report_modal.style.display = "none";
  
  }else if (event.target == delete_content_modal) {
    delete_content_modal.style.display = "none";
    
  }else if (event.target == delete_users_modal) {
    delete_users_modal.style.display = "none";
  
  }else if (event.target == like_content_modal) {
    like_content_modal.style.display = "none";
  }
 
}

function buy(content_id){

let buy_modal = document.getElementById("buy_modal"+content_id);
let buy_button = document.getElementById("buy_button"+content_id);
let buy_close = document.getElementById("buy_close"+content_id);

  if (buy_button != undefined){
      buy_button.onclick = function() {
      buy_modal.style.display = "flex";
    }
      buy_close.onclick = function() {
      buy_modal.style.display = "none";
    }
  }
}

function editComment(comment_id){

let edit_comment_modal = document.getElementById("edit_comment_modal"+comment_id);
let edit_comment_button = document.getElementById("edit_comment_button"+comment_id);
let edit_comment_close = document.getElementById("edit_comment_close"+comment_id);

  if (edit_comment_button != undefined){
      edit_comment_button.onclick = function() {
      edit_comment_modal.style.display = "flex";
    }
      edit_comment_close.onclick = function() {
      edit_comment_modal.style.display = "none";
    }
  }
}

function likeComment(comment_id){

let like_comment_modal = document.getElementById("like_comment_modal"+comment_id);
let like_comment_button = document.getElementById("like_comment_button"+comment_id);
let like_comment_close = document.getElementById("like_comment_close"+comment_id);

  if (like_comment_button != undefined){
      like_comment_button.onclick = function() {
      like_comment_modal.style.display = "flex";
    }
      like_comment_close.onclick = function() {
      like_comment_modal.style.display = "none";
    }
  }
}

function deleteNotification(notification_id){

let delete_notification_modal = document.getElementById("delete_notification_modal"+notification_id);
let delete_notification_button = document.getElementById("delete_notification_button"+notification_id);
let delete_notification_close = document.getElementById("delete_notification_close"+notification_id);

  if (delete_notification_button != undefined){
      delete_notification_button.onclick = function() {
      delete_notification_modal.style.display = "flex";
    }
      delete_notification_close.onclick = function() {
      delete_notification_modal.style.display = "none";
    }
  }
}




