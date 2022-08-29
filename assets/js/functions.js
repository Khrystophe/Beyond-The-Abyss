
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
