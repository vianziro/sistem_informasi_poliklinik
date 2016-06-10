function selectRecord(id){

	if(!hasClass(id, "selected")){
		removeClass(".selected","selected");
		addClass(id, "selected");
		buttonEnable("edit-btn");
		buttonEnable("del-btn");
		buttonEnable("daftar-btn");
		buttonEnable("report-btn");
	}
	else {
		removeClass(id, "selected");
		buttonDisable("edit-btn");
		buttonDisable("del-btn");
		buttonDisable("daftar-btn");
		buttonDisable("report-btn");
	}
}

function buttonDisable(id){	
	//$('.'+id).disabled = true;
	//$('.'+id).style.display = "none";
	document.getElementById(id).disabled = true;
	document.getElementById(id).style.display = "none";
}

function buttonEnable(id){
	//$('.'+id).disabled = false;
	//$('.'+id).style.display = "inline";
	document.getElementById(id).disabled = false;
	document.getElementById(id).style.display = "inline";
}

function hasClass(id,cls) {
	ele = document.querySelector(id);
	if(ele != null)
		return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
}
 
function addClass(id,cls) {
	ele = document.querySelector(id);
	if (!this.hasClass(id,cls)) ele.className += " "+cls;
}
 
function removeClass(id,cls) {
	ele = document.querySelector(id);
	if (hasClass(id,cls)) {
    	var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
		ele.className=ele.className.replace(reg,' ');
	}
}

function editRecord(link){
	element = document.querySelector("tr.selected");
	window.location = link+"?id="+element.id.replace(/[^0-9]/g, "");
}

function deleteRecord(link){
	element = document.querySelector("tr.selected");

	if(confirm("Anda yakin ?")){
		window.location = link+"?id="+element.id.replace(/[^0-9]/g, "");
	}
	else
		return false;
	
}

function printDocument(){
	var mywindow = window.open('', 'Laporan Inventaris', 'height=600,width=900');
	mywindow.document.write('<html><head><title>SIIB | Laporan</title><link rel="stylesheet" type="text/css" href="css/print.css">');
    //mywindow.document.write('<link rel="stylesheet" href="../css/style.css" type="text/css" />');
	mywindow.document.write('</head><body style="background-color: #FFF;">');
	var judul = $('#toolbar').attr('class');
	mywindow.document.write('<div id="wrap">');
	mywindow.document.write('<center><h2>Laporan '+judul+'</h2></center>');
	mywindow.document.write(document.getElementById("ubah").innerHTML);
	mywindow.document.write('</div>');
	mywindow.document.write('</body></html>');
	mywindow.document.close(); // necessary for IE >= 10
	mywindow.focus(); // necessary for IE >= 10
	mywindow.print();
	mywindow.close();
    return true;
}