function afficheReponse(idCarte) {
  var reponseDiv = document.getElementById("reponse-" + idCarte);
  var infoDiv = document.getElementById("info-" + idCarte);
  if (reponseDiv.style.display === "none") {
      reponseDiv.style.display = "block";
      infoDiv.style.display = "none"; 
  } else {
      reponseDiv.style.display = "none";
      infoDiv.style.display = "";}
}

function validerCarte(idCarte) {
 // Afficher le message de confirmation
 var confirmation = confirm("Êtes-vous sûr de vouloir valider cette carte ?");
 if (confirmation) {



  var questionDiv = document.getElementById("question-" + idCarte);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "valider_carte.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          // Traitez la réponse, par exemple, affichez un message de succès
          var response = JSON.parse(this.responseText);
          if(response.status === 'success') {
              alert(response.message);
              questionDiv.style.display = "none";
              // Vous pouvez ajouter du code pour modifier l'interface, comme masquer la carte validée
          } else {
              alert(response.message);
          }
      }
  }
  xhr.send("id_carte=" + idCarte);
} else {
  // L'utilisateur a cliqué sur "Annuler", ne rien faire
}
}

function supprimerCarte(idCarte, idData, nomClasse) {
 // Afficher le message de confirmation
  var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cette carte ?");
  if (confirmation) {




    var questionDiv = document.getElementById("question-" + idCarte);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "supprimer_carte.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Traitez la réponse, par exemple, affichez un message de succès
            var response = JSON.parse(this.responseText);
            if(response.status === 'success') {
                alert(response.message);
                questionDiv.style.display = "none";
                // Vous pouvez ajouter du code pour modifier l'interface, comme masquer la carte validée
            } else {
                alert(response.message);
            }
        }
    }
    var params = "id_carte=" + idCarte + "&id_data=" + idData + "&nom_classe=" + encodeURIComponent(nomClasse);
    xhr.send(params);
  } else {
    // L'utilisateur a cliqué sur "Annuler", ne rien faire
}
  }



  $('#maModal').modal('show');