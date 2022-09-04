
function MaxLengthDescription(description, maxlength) {
  if (description.value.length > maxlength) {
    description.value = description.value.substring(0, maxlength);
    alert('Maximum ' + maxlength + ' characters!');
  }
}

function validContent(id){

  let name = document.getElementById('admin_content'+id).files[0].name;
  let type = document.getElementById('admin_content'+id).files[0].type;
  let size = document.getElementById('admin_content'+id).files[0].size;
 
  let split_files_name = name.split(".");

  if( split_files_name.length == 2 ){

    let allowed_extensions = ["webm", "mp4", "ogv"];
    let allowed_mime_types = ["video/webm", "video/mp4", "video/ogv"];
    let check_files_name = ((typeof split_files_name[0] === 'string' || split_files_name[0] instanceof String) );
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

        document.getElementById('admin_content'+id).value = '';
        return alert('Respect files format : "(A-Za-z0-9space)(.)(webm/mp4/ogv)"');
        
      }
  } else {

    document.getElementById('admin_content'+id).value= '';
    return alert ('Respect files format : "(A-Za-z0-9space)(.)(webm/mp4/ogv)"')

  }
}

const compare = (clicked_table_head, sort_order) => (line_to_sort1, line_to_sort2) => {
  
  const cellValue = (row_of_clicked_table_head, clicked_table_head) => 

  row_of_clicked_table_head.children[clicked_table_head].textContent;

  const sorting = (cellValue1, cellValue2) =>

  cellValue1 !== '' && cellValue2 !== '' && !isNaN(cellValue1) && !isNaN(cellValue2) ? 
  cellValue1 - cellValue2 : 
  cellValue1.toString().localeCompare(cellValue2);

  return sorting(cellValue(sort_order ? line_to_sort1 : line_to_sort2, clicked_table_head), cellValue(sort_order ? line_to_sort2 : line_to_sort1, clicked_table_head));
};

const table_body = document.querySelector('tbody');
const table_heads = document.querySelectorAll('th');
const table_rows = table_body.querySelectorAll('tr');

table_heads.forEach(clicked_table_head => 
  clicked_table_head.addEventListener('click', () => {

  let line_to_sort = Array.from(table_rows).sort(compare(Array.from(table_heads).indexOf(clicked_table_head), this.sort_order = !this.sort_order));
  
  line_to_sort.forEach(sorted_row => 
    table_body.appendChild(sorted_row));
    
  }));

document.addEventListener("readystatechange", function()
{
  if (document.readyState == "interactive") {
  
    let tables = document.querySelectorAll("table.sortable");

    for (let i=0; i<tables.length; i++) {
     
      let table_heads = tables[i].querySelectorAll("th");

      for (let j=0; j<table_heads.length; j++) {
      
        table_heads[j].style.backgroundColor = "#c9c9c9";
      
        table_heads[j].addEventListener("click", changeTableHeadsColor, false);
      }
    }
  }
});

function changeTableHeadsColor(click) {

  let clicked_table_head = click.currentTarget;
  let table = clicked_table_head.parentElement.parentElement.parentElement;
  let table_heads = table.querySelectorAll("th");

  for (let j=0; j<table_heads.length; j++) {

    if(table_heads[j] === clicked_table_head){

    table_heads[j].style.backgroundColor = "gray";

    } else {

    table_heads[j].style.backgroundColor = "#c9c9c9";

    }
  }

} 