
function buy(userCredits, contentTitle, contentComposer, contentPrice) {
  return confirm("You have " + userCredits + " credits. Do you want to buy " + contentTitle + " of " + contentComposer + " for " + contentPrice + " credits ? ")
}

function login() {
  return alert('You are not connected !')
}

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

  console.log('page',page);

  let name = document.getElementById(page+'_content').files[0].name;
  let type = document.getElementById(page+'_content').files[0].type;
  let size = document.getElementById(page+'_content').files[0].size;
 
 
  let split_files_name = name.split(".");

  if( split_files_name.length == 2 ){

    let allowed_extensions = ["webm", "mp4", "ogv"];
    let allowed_mime_types = ["video/webm", "video/mp4", "video/ogv"];
    let check_files_name = ((typeof split_files_name[0] === 'string' ||split_files_name[0] instanceof String) );
    let check_files_extension = allowed_extensions.includes(split_files_name[1].toLowerCase());
    let check_files_mime_type = allowed_mime_types.includes(type.toLowerCase());

    if( 
      split_files_name[0].match(/^[A-Za-z0-9 ]+$/)
      &&check_files_name === true 
      && check_files_extension === true
      && check_files_mime_type === true
      && size <= 128000000 ){
        
        return true;

      } else{

        document.getElementById(page+'_content').value = '';
        return alert('Respect files format : "(A-Za-z0-9space)(.)(webm/mp4/ogv)"');

      }
  } else {

    document.getElementById(page+'_content').value= '';
    return alert ('Respect files format : "(A-Za-z0-9space)(.)(webm/mp4/ogv)"')

  }
}

