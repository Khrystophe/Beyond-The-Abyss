
function input(string, id, maxLength, index) {

    let array_regex ={
      'input_name_lastname' : /^(?!\s*$)[a-zA-Zéèêàçù '"-]+$/,
      'input_password' : /^[0-9a-zA-Z]+$/,
      'input_title' : /^[0-9a-zA-Zéèêàçù '"!?°-]+$/,
      'input_composer' : /^[0-9a-zA-Zéèêàçù -]+$/,
      'input_description' : /^[\s\r\n0-9a-zA-Zéèêàçù# ()'".!?,;:°-]+$/,
      'input_contact' : /^[\s\r\n0-9a-zA-Zéèêàçù# ()'".!?,;:°-]+$/,
      'input_price' : /^([1-9]|[1-9][0-9]|[1-4][0-9][0-9]|500|[Free]+)$/,
  }
  
  let regex = array_regex[index];
  
  if (((string.value.match(regex)) && string.value.length < maxLength) || event.key === 'Tab' || event.key === 'Backspace' || event.key === 'Enter') {
    
    return true
    
  } else {
    
    string = document.getElementById(id).value;
    document.getElementById(id).value = string.substring(0, string.length - 1);
    
    let input_modal = document.getElementById("input_modal");
    let message_regex = document.getElementById(index);
    
    input_modal.style.display = "flex"
    message_regex.style.display = "flex"
    
    document.onclick = function() {
      input_modal.style.display = "none";
      message_regex.style.display = "none"
    }
    
    document.onkeydown= function() {
      input_modal.style.display = "none";
      message_regex.style.display = "none"
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

        let input_modal = document.getElementById("input_modal");
        let message_regex = document.getElementById("input_content");
        
        input_modal.style.display = "flex"
        message_regex.style.display = "flex"
        
        document.onclick = function() {
          input_modal.style.display = "none";
          message_regex.style.display = "none"
        }
        
      }
    } else {
      
      document.getElementById(page+'_content').value= '';
      
      
      let input_modal = document.getElementById("input_modal");
      let message_regex = document.getElementById("input_content");
      
      input_modal.style.display = "flex"
      message_regex.style.display = "flex"
      
      document.onclick = function() {
        input_modal.style.display = "none";
        message_regex.style.display = "none"
    }

  }
}


function modal(id){
  
  let modal = document.getElementById(id+"_modal");
  let button = document.getElementById(id+"_button");
  let close = document.getElementById(id+"_close");
  
  if (button != undefined){
      button.onclick = function() {
      modal.style.display = "flex";
    }
      close.onclick = function() {
      modal.style.display = "none";
    }
  }

    window.onclick = function(event) { 

      if (event.target == modal){
      modal.style.display = "none";
    }
  }
}

function contact(){

  let modal = document.getElementById("contact_modal");
  let button = document.getElementsByClassName("contact_button");
  let close = document.getElementById("contact_close");

  for(let i=0; i < button.length; i++){
    
    if (button[i] != undefined){
      button[i].onclick = function() {
        modal.style.display = "flex";
      }
        close.onclick = function() {
        modal.style.display = "none";
      }
    }

      window.onclick = function(event) { 
        
        if (event.target == modal){
        modal.style.display = "none";
      }
    }
  }
}

function modalForeach(name, id){

let modal = document.getElementById(name+"_modal"+id);
let button = document.getElementById(name+"_button"+id);
let close = document.getElementById(name+"_close"+id);

  if (button != undefined){
      button.onclick = function() {
      modal.style.display = "flex";
    }
      close.onclick = function() {
      modal.style.display = "none";
    }
  }
    window.onclick = function(event) { 

      if (event.target == modal){
      modal.style.display = "none";
    }
  }
}








