// razeni
function razeni(){
	document.getElementById("rad").submit();
  }
  function odhlas(){
	document.getElementById("odhlasit").submit();
  }
//vyhledavani
function myFunction(znacky) {
  var x = znacky;
  var znackos = document.getElementsByClassName("gallery");
  
  for(var i = 0;i < znackos.length;i ++){
  var q = document.getElementsByClassName("gallery")[i];
  if(x =="vse"){
	q.style.display = "block";
  }else{
  
	if(q.classList.contains(x)){
		q.style.display = "block";
		}else{
		q.style.display = "none";
			}
		}
	} 
}
//je skladem?
function myFunctionBox() {
	var znackos = document.getElementsByClassName("gallery");
	var e = document.getElementById("jeSkladem").checked;
	if(e == true){	
		for(var i = 0;i < znackos.length;i ++){
		  var q = document.getElementsByClassName("gallery")[i];
			if(q.classList.contains("0")){
				q.remove();
					}else{}
					}
				 }else{
					location.reload();	
				 }
	}
    function myFunctionFilter(){
        var kontrola = document.getElementById("filterCheck").checked;
        if(kontrola == true){
            var pocettrid = document.getElementsByClassName("podFiltr").length;
            for(var i = 0;i < pocettrid;i++){
                document.getElementsByClassName("podFiltr")[i].style.display = "block";
            }
            document.getElementById("ceckBoxFiler").style.display = "block";
        }
        if(kontrola == false){
            var pocettrid = document.getElementsByClassName("podFiltr").length;
            for(var i = 0;i < pocettrid;i++){
                document.getElementsByClassName("podFiltr")[i].style.display = "none";
            }
            document.getElementById("ceckBoxFiler").style.display = "block";
        }
    }
//pocet kusu
var znackos = document.getElementsByClassName("pocetSklad");
	for(var i = 0;i < znackos.length;i ++){
		var skld = document.getElementsByClassName("pocetSklad")[i].value;
		if(skld == 0){
		  document.getElementsByClassName("pocetSkladBarva")[i].innerHTML = "<a class='red'>není momentálně skladem</a>";
		  } 
		  if(skld == 1){
		  document.getElementsByClassName("pocetSkladBarva")[i].innerHTML = "<a class='orange'>skladem poslední kus</a>";
		  } 
		  if(skld == 2 || skld == 3 || skld == 4|| skld == 5){
		  document.getElementsByClassName("pocetSkladBarva")[i].innerHTML = "<a class='green'>skladem "+skld+" kusů</a>";
		  } if(skld > 5){
		  document.getElementsByClassName("pocetSkladBarva")[i].innerHTML = "<a class='green'>skladem 5 a více kusů</a>";
		  }
	 }
	 var modal = document.getElementById("myModal");
	 var img = document.getElementsByClassName("click");
	 var modalImg = document.getElementById("img01");
	 var captionText = document.getElementById("caption");
	  for (var i = 0; i < img.length; i++) {
		  
	  	  
    img[i].onclick = function(){	
	modalImg.src = this.src;
	modal.style.display = "block";
	captionText.innerHTML = this.alt;
	
	function load_js()
   {
      var head= document.getElementsByTagName('head')[0];
      var script= document.createElement('script');
      script.src= 'index_js.js';
      head.appendChild(script);
   }
   load_js2();
   load_js();

   function load_js2(){
      var head= document.getElementsByTagName('head')[0];
      var script= document.createElement('script');
      script.src= 'select/c.js';
      head.appendChild(script);
   }
	}
}	
		var span = document.getElementsByClassName("close")[0];
		document.getElementsByClassName("close")[0].style.zIndex = "13";
		span.onclick = function() { 
		  modal.style.display = "none";
}