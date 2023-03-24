function showPassTheSame(){
	var pass1 = document.getElementById('passReg');
	var pass2 = document.getElementById('repeatReg');
	var same = document.getElementById('passSame');
	var butt = document.getElementById('submitReg');
	if(pass1.value != pass2.value){
		same.style.display = 'block';
		butt.disabled = true;
	} else {
		same.style.display = 'none';
		butt.disabled = false;
	}
}