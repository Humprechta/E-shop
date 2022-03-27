var znackos = document.getElementsByClassName("4");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt4")[i].innerHTML = "<a class='green'><div class='tooltip'>Děkujeme za objednávku<span class='tooltiptext'>Objednávka vyřízena.</span></div></a>";
	 }
     var znackos = document.getElementsByClassName("1");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt1")[i].innerHTML = "<a class='orange'><div class='tooltip'>Naskladňujeme.<span class='tooltiptext'>Tento krok zpravidla trvá nejdéle, protože externí dodavatel, nemusí boty mít na skladě (průměrně od objednání po naskladnění trvá 7 pracovních dnů)</span></div></a>";
	 }
     var znackos = document.getElementsByClassName("2");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt2")[i].innerHTML = "<a class='orange'><div class='tooltip'>Za chvíli objednávku pošleme<span class='tooltiptext'>Skvělá správa, produkt máme na skladě, za chvíli objednávku pošleme (zpravidla další pracovní den)</span></div></a>";
	 }
     var znackos = document.getElementsByClassName("3");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt3")[i].innerHTML = "<a class='orange'><div class='tooltip'>Posláno.<span class='tooltiptext'>Předáno dopravci, pokud jste si vybrali možnost dobírkou, objednávka je připravena na prodejně</span></div></a>";
	 }
     var znackos = document.getElementsByClassName("0");
	for(var i = 0;i < znackos.length;i ++){
		  document.getElementsByClassName("txt0")[i].innerHTML = "<a class='red'><div class='tooltip'>Zrušeno<span class='tooltiptext'>Podud se jedná o omyl, kontaktujte mě.</span></div></a>";
	 }

   function odhlas(){
    document.getElementById("odhlasit").submit();
    }


     function delat(){
        let text = "Deaktivovat účet?\nÚčet nelze zpětně aktivovat, vaše objednávky nebudou zrušeny.";
        if (confirm(text) == true) {
          document.getElementById("myForm").submit();
        } else {
          //nic se nedeje, klikl na zrusit
        }
      }

    function zrusit(x){
        let text = "Opravdu zrušit objednávku?";
        if (confirm(text) == true) {
            document.getElementById("zrusTxT").value = x;
            document.getElementById("myZrus").submit();
        } else {
          //nic se nedeje, klikl na zrusit
        }
    }
