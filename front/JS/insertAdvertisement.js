document.getElementById("insertForm").addEventListener("submit", function (event) {
  event.preventDefault(); // Evita envío normal del formulario  

  let formData = new FormData(this);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../../back/Controllers/insertAdvertisementController.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

      //let response = xhr.responseText;
    }
  };
  xhr.send(formData);
});

