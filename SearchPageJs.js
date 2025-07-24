const search = () =>{
	const searchbox = document.getElementById("search-marvel").value.toUpperCase();
	const marvelitems = document.getElementById("marvel-list")
	const marvelMTVs = document.getElementById("marvel")
	const Mname = marvelitems.getElementsByTagName("h2")
	
	for(var i=0; i<Mname.length; i++){
		let match = marvelMTVs[i].getElementsByTagName('h2')[0];
		
		if(match){
			let textvalue = match.textContent || match.innerHTML
			
			if(textvalue.toUpperCase().indexOf(searchbox) > -1){
				marvelMTVs[i].style.display = "";
			}else{
			    marvelMTVs[i].style.display = "None";
			}
		}
	}
}