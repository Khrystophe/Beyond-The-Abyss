
function deleteAlert() {
  return confirm("Are you sure you want to delete these content ? This action is irreversible !")
}

function MaxLengthDescription(description, maxlength) {
  if (description.value.length > maxlength) {
    description.value = description.value.substring(0, maxlength);
    alert('Maximum ' + maxlength + ' characters!');
  }
}

function likeContent(content_author_name, content_author_lastname) {
  return confirm("Like " + content_author_name + " " + content_author_lastname +"'s contents ?")
}

function likeComment(comment_author_name, comment_author_lastname) {
  return confirm("Like " + comment_author_name + " " + comment_author_lastname + "'s comments ?")
}

function deleteAccountAlert() {
  return confirm("Are you sure you want to delete your account and all your content ? This action is irreversible ! ")
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
        return alert('Respect files format : "|0-9a-zA-Zéèêàçù# ()\'!,;°-| |.| |webm/mp4/ogv|" and 128 Mo max.');

      }
  } else {

    document.getElementById(page+'_content').value= '';
    return alert ('Respect files format : "(0-9a-zA-Zéèêàçù# ()\'!,;°-)(.)(webm/mp4/ogv)"')

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



