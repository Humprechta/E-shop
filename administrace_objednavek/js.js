// changing text from order status
var znackos = document.getElementsByClassName("txt4");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt4")[i].innerHTML = "<a class='green'><div class='tooltip'>Děkujeme za objednávku<span class='tooltiptext'>Objednávka vyřízena.</span></div></a>";
	 }
     var znackos = document.getElementsByClassName("txt1");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt1")[i].innerHTML = "<a class='orange'><div class='tooltip'>Naskladňujeme.<span class='tooltiptext'>Tento krok zpravidla trvá nejdéle, protože externí dodavatel, nemusí boty mít na skladě (průměrně od objednání po naskladnění trvá 7 pracovních dnů)</span></div></a>";
	 }
     var znackos = document.getElementsByClassName("txt2");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt2")[i].innerHTML = "<a class='orange'><div class='tooltip'>Za chvíli pošleme<span class='tooltiptext'>Skvělá správa, produkt máme na skladě, za chvíli objednávku pošleme (zpravidla další pracovní den)</span></div></a>";
	 }
     var znackos = document.getElementsByClassName("txt3");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt3")[i].innerHTML = "<a class='orange'><div class='tooltip'>Posláno.<span class='tooltiptext'>Předáno dopravci, pokud jste si vybrali možnost dobírkou, objednávka je připravena na prodejně</span></div></a>";
	 }
     var znackos = document.getElementsByClassName("txt0");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt0")[i].innerHTML = "<a class='red'><div class='tooltip'>Zrušeno<span class='tooltiptext'>Podud se jedná o omyl, kontaktujte mě.</span></div></a>";
	 }
   //reset filter for orders
function reset(){
  var x = document.getElementById("vyhledat").value;
  var pocet = document.getElementsByClassName("hl").length;
  document.getElementById("vyhledat").value = "";
  for(var i = 0;i < pocet;i++ ){
    var q = document.getElementsByClassName("hl")[i];
    console.log(q);
    q.style.display = "table-row";
    localStorage.clear();
  }
}
function load(){//onload function
if (localStorage.getItem("hledat") !== null) {
    var yy = localStorage.getItem("hledat");
    document.getElementById("vyhledat").value = yy;
    //if localstorage is set, call vyhledat function with storage value
    vyhledat(yy);
  }
}
function vyhledat(y){//filter orders
  var x = document.getElementById("vyhledat").value;
  if(y != "0"){//if onload function call this
    x = y;
  }
  var pocet = document.getElementsByClassName("hl").length;
  localStorage.setItem("hledat",x);
  for(var i = 0;i < pocet;i++ ){
    var q = document.getElementsByClassName("hl")[i];
    
    if(x=="0" || x==""){
      document.getElementById("vyhledat").value = "";
      localStorage.clear();
      q.style.display = "table-row";
    }else{
    if(q.classList.contains(x)){
      q.style.display = "table-row";
      }else{
      q.style.display = "none";
        }
      }
  }
} 
//change order status js-call=>submit form
function zmenaPoctu(x1){
  document.getElementById(x1).submit();
} 
function razeni(){
  document.getElementById("rad").submit();
}
//block user
function zrusitho(x){
  let text = "Opravdu zablokovat uživatele?";
  if (confirm(text) == true) {
      document.getElementById("zrusithoTxT").value = x;
      document.getElementById("zrusitho").submit();
  } else {
    //nic se nedeje, klikl na zrusit
  }
}
//cancel older
function zrusit(x){
    let text = "Opravdu zrušit objednávku?";
    if (confirm(text) == true) {
      document.getElementById("zrusTxT").value = x;
      document.getElementById("myZrus").submit();
    } else {
      //nic se nedeje, klikl na zrusit
    }
}
