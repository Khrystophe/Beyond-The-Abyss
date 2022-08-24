/*VERSION FACTORISEE*/
const compare = (ids, asc) => (row1, row2) => {
  const tdValue = (row, ids) => row.children[ids].textContent;
  const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
  return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
};

const tbody = document.querySelector('tbody');
const thx = document.querySelectorAll('th');
const trxb = tbody.querySelectorAll('tr');
thx.forEach(th => th.addEventListener('click', () => {
  let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
  classe.forEach(tr => tbody.appendChild(tr));
}));


document.addEventListener("readystatechange", function() {
  if (document.readyState=="interactive") {
    /* Trouver et parcourir tous les tableaux de classe tritable */
    var elts=document.querySelectorAll("table.tritable");
    for (var i=0; i<elts.length; i++) {
      elts[i].dataset.tritable=true;
      /* Rechercher toutes les en-têtes de l'élément i */
      var ths=elts[i].querySelectorAll("th");
      for (var j=0; j<ths.length; j++) {
        /* Ajout de l'icone indiquant la possibilité de tri */  
        ths[j].innerHTML+=" <i class=\"fas fa-sort light\"></i>";
        ths[j].dataset.sens="";
        /* Ajout de l'event click */  
        ths[j].addEventListener("click", triColonne, false);
      }
    }
  }
});
  
  
/* Fonction appelée sur le clic du titre de colonne */  
function triColonne(evt) {
  var elt=evt.currentTarget;
  var table=elt.parentElement.parentElement.parentElement;
  /* Mise à jour des icones du sens de tri sur tous les TH */
  var ths=table.querySelectorAll("th");
  for (var j=0; j<ths.length; j++) {
    var icon=ths[j].querySelector("i.fas");
    if (ths[j]===elt) {
      /* On est sur la colonne cliquée */
      /* Détermination du sens de tri en fonction du sens actuel */
      if (ths[j].dataset.sens=="up") { 
          var sens="down";
      } else {
          var sens="up";
      }
      icon.className="fas fa-sort-"+sens+" active";        
      /* Lancement du tri du tableau table sur la colonne j dans le bon sens */
      ths[j].dataset.sens=sens;
      triTable(table, j, sens);
    } else {
      /* On repasse à l'icone non trié pour les autres colonnes */  
      ths[j].dataset.sens="";
      icon.className="fas fa-sort light";
    }
  }
} 