/*for (const btn of document.querySelectorAll('.vote')) {
    btn.addEventListener('click', event => {
      event.currentTarget.classList.toggle('on');
    });
}*/

function like(e){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var url = this.responseURL.split("/");
      if(url[url.length - 1] == "login"){
        var url2 = window.location.href.split("/");
        /*if(url2[url2.length - 2] == "forum"){
          //window.location.href = '../user/login';
        }
        else{
          //window.location.href = 'user/login';
        }*/
        window.location.href = this.responseURL;
        
      }
      else{
        uppvote(e);
        var izpis = this.responseText.split("/");
        var count = document.getElementById("p" + e.id);
        count.innerHTML = izpis[1];
      }
      
    }
  };
  xmlhttp.open("POST", "", true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send("idpost=" + e.id);
}


function uppvote(e){
  e.classList.toggle('on');
}