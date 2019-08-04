function reg(){
	
	var user = document.getElementById('tbUsername');
	
	var pass = document.getElementById('tbPass');
	
	var reUser = /^[a-z]+(\s[\w\d\-]+)*$/;
	
	var greske = new Array();
	var greskeID = new Array();
	var sadrzaj = new Array();
	
	if(user.value.match(reUser))
	{
		
		return true;
	}
	else
	{
		alert("Username nije u dobrom formatu, ili prelazi dozvoljeni broj karaktera");
		return false;
	}
	

}