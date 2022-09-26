let scroll_nav = document.querySelectorAll(".scroll_nav");
let lastScrollValue = 0;
document.addEventListener("scroll", () => {
  let top = document.documentElement.scrollTop;

  for (let i = 0; i < scroll_nav.length; i++) {
    if (lastScrollValue < top) {
      scroll_nav[i].classList.add("hidden");
    } else {
      scroll_nav[i].classList.remove("hidden");
    }
  }
  lastScrollValue = top;
});

let position;
let old_position;
function input(string, id, maxLength, index) {
  function position_event(id) {
    document.getElementById(id).addEventListener("keydown", function () {
      position = this.selectionStart;
      return position;
    });

    old_position = position;
    return old_position;
  }
  position_event(id);

  let array_regex = {
    input_name_lastname: /^(?!\s*$)[a-zA-Zéèêàâçù '"-]+$/,
    input_password: /^[0-9a-zA-Z]+$/,
    input_title: /^[0-9a-zA-Zéèêàâçù '"!?°-]+$/,
    input_composer: /^[0-9a-zA-Zéèêàâçù -]+$/,
    input_description: /^[\s\r\n0-9a-zA-Zéèêàâçù# ()'".!?,;:°-]+$/,
    input_contact: /^[\s\r\n0-9a-zA-Zéèêàâçù# ()'".!?,;:°-]+$/,
    input_price: /^([1-9]|[1-9][0-9]|[1-4][0-9][0-9]|500|[Free]+)$/,
  };
  let regex = array_regex[index];

  if (
    (string.value.match(regex) && string.value.length < maxLength) ||
    event.key === "Tab" ||
    event.key === "Backspace" ||
    event.key === "Enter"
  ) {
    return true;
  } else {
    string_value = document.getElementById(id).value;
    document.getElementById(id).value = string_value.replace(event.key, "");

    document.getElementById(id).focus();
    document.getElementById(id).setSelectionRange(old_position, old_position);

    let input_modal = document.getElementById("input_modal");
    let message_regex = document.getElementById(index);

    input_modal.style.display = "flex";
    message_regex.style.display = "flex";

    document.onclick = function () {
      input_modal.style.display = "none";
      message_regex.style.display = "none";
    };

    document.onkeydown = function () {
      input_modal.style.display = "none";
      message_regex.style.display = "none";
    };
  }
}

function validContent(page) {
  let name = document.getElementById(page + "_content").files[0].name;
  let type = document.getElementById(page + "_content").files[0].type;
  let size = document.getElementById(page + "_content").files[0].size;

  let split_files_name = name.split(".");

  if (split_files_name.length == 2) {
    let allowed_extensions = ["webm", "mp4", "ogv"];
    let allowed_mime_types = ["video/webm", "video/mp4", "video/ogv"];
    let check_files_name =
      typeof split_files_name[0] === "string" ||
      split_files_name[0] instanceof String;
    let check_files_extension = allowed_extensions.includes(
      split_files_name[1].toLowerCase()
    );
    let check_files_mime_type = allowed_mime_types.includes(type.toLowerCase());

    if (
      split_files_name[0].match(/^[0-9a-zA-Zéèêàçù# ()'!,;°-]+$/) &&
      check_files_name === true &&
      check_files_extension === true &&
      check_files_mime_type === true &&
      size <= 128000000
    ) {
      return true;
    } else {
      document.getElementById(page + "_content").value = "";

      let input_modal = document.getElementById("input_modal");
      let message_regex = document.getElementById("input_content");

      input_modal.style.display = "flex";
      message_regex.style.display = "flex";

      document.onclick = function () {
        input_modal.style.display = "none";
        message_regex.style.display = "none";
      };
    }
  } else {
    document.getElementById(page + "_content").value = "";

    let input_modal = document.getElementById("input_modal");
    let message_regex = document.getElementById("input_content");

    input_modal.style.display = "flex";
    message_regex.style.display = "flex";

    document.onclick = function () {
      input_modal.style.display = "none";
      message_regex.style.display = "none";
    };
  }
}

function modal(id) {
  let modal = document.getElementById(id + "_modal");
  let button = document.getElementById(id + "_button");
  let close = document.getElementById(id + "_close");

  if (button != undefined) {
    button.onclick = function () {
      modal.style.display = "flex";
    };
    close.onclick = function () {
      modal.style.display = "none";
    };
  }

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}

function contact() {
  let modal = document.getElementById("contact_modal");
  let button = document.getElementsByClassName("contact_button");
  let close = document.getElementById("contact_close");

  for (let i = 0; i < button.length; i++) {
    if (button[i] != undefined) {
      button[i].onclick = function () {
        modal.style.display = "flex";
      };
      close.onclick = function () {
        modal.style.display = "none";
      };
    }

    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
  }
}

function modalForeach(name, id) {
  let modal = document.getElementById(name + "_modal" + id);
  let button = document.getElementById(name + "_button" + id);
  let close = document.getElementById(name + "_close" + id);

  if (button != undefined) {
    button.onclick = function () {
      modal.style.display = "flex";
    };
    close.onclick = function () {
      modal.style.display = "none";
    };
  }

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}

function foldUnfold(element, target) {
  let folder = document.querySelector("." + "fold_unfold_" + element);
  let fold_icons = document.querySelectorAll("." + element);
  let form = document.getElementById(target);

  if (folder !== null) {
    folder.addEventListener("click", function () {
      for (let i = 0; i < fold_icons.length; i++) {
        if (fold_icons[i].classList.contains("hide")) {
          fold_icons[i].classList.remove("hide");

          form.style.display = "none";
          form.style.height = "0";
        } else {
          fold_icons[i].classList.add("hide");

          form.style.display = "block";
          form.style.height = "auto";
        }
      }
    });
  }
}

foldUnfold("name_lastname", "show_name_lastname");
foldUnfold("password", "show_password");
foldUnfold("add_content", "show_add_content");

function autocomplete(input, array) {
  let currentFocus;

  input.addEventListener("input", function (e) {
    let a,
      b,
      i,
      val = this.value;

    closeAllLists();

    if (!val) {
      return false;
    }

    currentFocus = -1;

    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");

    this.parentNode.appendChild(a);

    for (i = 0; i < array.length; i++) {
      if (array[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        b = document.createElement("DIV");
        b.innerHTML = "<strong>" + array[i].substr(0, val.length) + "</strong>";
        b.innerHTML += array[i].substr(val.length);
        b.innerHTML += "<input type='hidden' value='" + array[i] + "'>";

        b.addEventListener("click", function (e) {
          input.value = this.getElementsByTagName("input")[0].value;
          closeAllLists();
        });

        a.appendChild(b);
      }
    }
  });

  input.addEventListener("keydown", function (e) {
    let x = document.getElementById(this.id + "autocomplete-list");

    if (x) {
      x = x.getElementsByTagName("div");
    }

    if (e.keyCode == 40) {
      currentFocus++;
      addActive(x);
    } else if (e.keyCode == 38) {
      currentFocus--;
      addActive(x);
    } else if (e.keyCode == 13) {
      e.preventDefault();

      if (currentFocus > -1) {
        if (x) {
          x[currentFocus].click();
        }
      }
    }
  });

  function addActive(x) {
    if (!x) {
      return false;
    }

    removeActive(x);

    if (currentFocus >= x.length) {
      currentFocus = 0;
    }
    if (currentFocus < 0) {
      currentFocus = x.length - 1;
    }

    x[currentFocus].classList.add("autocomplete-active");
  }

  function removeActive(x) {
    for (let i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }

  function closeAllLists(elmnt) {
    let x = document.getElementsByClassName("autocomplete-items");

    for (let i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != input) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }

  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}

autocomplete(document.getElementById("search_title"), titles);
autocomplete(document.getElementById("search_composer"), composers);
