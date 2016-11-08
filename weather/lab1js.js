city ="Toronto";
mweather="";
desweather="";
temp="";
id=0;
kcf=0;
function search(form){
	var x = document.getElementById("frm1").country.value;
	kcf= document.getElementById("frm1").temp.value;
	var xhttp = new XMLHttpRequest();
	var xhttp1 = new XMLHttpRequest();
	var xhttp2 = new XMLHttpRequest();
	var jsonResponse;
	/*
	if(temp== "cel")
	{
		document.getElementById("temp").innerHTML = "c";
	}
	else
		document.getElementById("temp").innerHTML = "f";
	document.getElementById("test").innerHTML = x;
	*/
	city=x;  
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			jsonResponse=xhttp.responseText;
			//document.getElementById("api").innerHTML = xhttp.responseText;
			getinfo(jsonResponse);
		}
	};
	xhttp1.onreadystatechange = function() {
		if (xhttp1.readyState == 4 && xhttp1.status == 200) {
			jsonResponse=xhttp1.responseText;
			//document.getElementById("temp1").innerHTML = xhttp1.responseText;
			getinfo5(jsonResponse);
		}
	};
	xhttp2.onreadystatechange = function() {
		if (xhttp2.readyState == 4 && xhttp2.status == 200) {
			jsonResponse=xhttp2.responseText;
			//document.getElementById("temp1").innerHTML = xhttp1.responseText;
			getinfoh(jsonResponse);
		}
	};
  xhttp.open("GET", "http://api.openweathermap.org/data/2.5/weather?q="+city+"&appid=027b6063ed0f9ebab88f4d3ad5c7013b", true);
  xhttp.send();
  xhttp1.open("GET", "http://api.openweathermap.org/data/2.5/forecast/daily/?q="+city+"&cnt=5&appid=027b6063ed0f9ebab88f4d3ad5c7013b", true);
  xhttp1.send();
  xhttp2.open("GET", "http://api.openweathermap.org/data/2.5/forecast/?q="+city+"&appid=027b6063ed0f9ebab88f4d3ad5c7013b", true);
  xhttp2.send();
}

function getinfo(response) {
var report=JSON.parse(response);
mweather=report.weather[0].main;
temp=convert(report.main.temp);
desweather=report.weather[0].description;
id=report.weather[0].id;
var humid=report.main.humidity;
var wind=report.wind.speed;
document.getElementById("tempc").innerHTML = "temp:"+temp;
document.getElementById("desc").innerHTML = desweather;
document.getElementById("humidc").innerHTML = "humid:"+humid;
document.getElementById("windc").innerHTML = "wind spd:"+wind;
getimage(id, "imagec");
}
function getinfoh(response)
{
var report=JSON.parse(response);
var temp1=convert(report.list[0].main.temp);
var temp2=convert(report.list[1].main.temp);
var temp3=convert(report.list[2].main.temp);
var id1=report.list[0].weather[0].id;
var id2=report.list[1].weather[0].id;
var id3=report.list[2].weather[0].id;
var des1=report.list[0].weather[0].description;
var des2=report.list[1].weather[0].description;
var des3=report.list[2].weather[0].description;
var t1=report.list[0].dt_txt;
var t2=report.list[1].dt_txt;
var t3=report.list[2].dt_txt;
var humid1=report.list[0].main.humidity;
var humid2=report.list[1].main.humidity;
var humid3=report.list[2].main.humidity;
var wind1=report.list[0].wind.speed;
var wind2=report.list[1].wind.speed;
var wind3=report.list[2].wind.speed;
document.getElementById("desh1").innerHTML = des1;
document.getElementById("desh2").innerHTML = des2;
document.getElementById("desh3").innerHTML = des3;
document.getElementById("hour1").innerHTML = t1;
document.getElementById("hour2").innerHTML = t2;
document.getElementById("hour3").innerHTML = t3;
document.getElementById("temph1").innerHTML = "temp:"+temp1;
document.getElementById("temph2").innerHTML = "temp:"+temp2;
document.getElementById("temph3").innerHTML = "temp:"+temp3;
document.getElementById("humidh1").innerHTML = "humid:"+humid1;
document.getElementById("humidh2").innerHTML = "humid:"+humid2;
document.getElementById("humidh3").innerHTML = "humid:"+humid3;
document.getElementById("windh1").innerHTML = "wind spd:"+wind1;
document.getElementById("windh2").innerHTML = "wind spd:"+wind2;
document.getElementById("windh3").innerHTML = "wind spd:"+wind3;
getimage(id1, "imageh1");
getimage(id2, "imageh2");
getimage(id3, "imageh3");
}
function getinfo5(response)
{
var report=JSON.parse(response);
var temp1=convert(report.list[0].temp.day);
var temp2=convert(report.list[1].temp.day);
var temp3=convert(report.list[2].temp.day);
var temp4=convert(report.list[3].temp.day);
var temp5=convert(report.list[4].temp.day);
var id1=report.list[0].weather[0].id;
var id2=report.list[1].weather[0].id;
var id3=report.list[2].weather[0].id;
var id4=report.list[3].weather[0].id;
var id5=report.list[4].weather[0].id;
var des1=report.list[0].weather[0].description;
var des2=report.list[1].weather[0].description;
var des3=report.list[2].weather[0].description;
var des4=report.list[3].weather[0].description;
var des5=report.list[4].weather[0].description;
var wind1=report.list[0].speed;
var wind2=report.list[1].speed;
var wind3=report.list[2].speed;
var wind4=report.list[3].speed;
var wind5=report.list[4].speed;
document.getElementById("desd1").innerHTML = des1;
document.getElementById("desd2").innerHTML = des2;
document.getElementById("desd3").innerHTML = des3;
document.getElementById("desd4").innerHTML = des4;
document.getElementById("desd5").innerHTML = des5;
document.getElementById("tempd1").innerHTML = "temp:"+temp1;
document.getElementById("tempd2").innerHTML = "temp:"+temp2;
document.getElementById("tempd3").innerHTML = "temp:"+temp3;
document.getElementById("tempd4").innerHTML = "temp:"+temp4;
document.getElementById("tempd5").innerHTML = "temp:"+temp5;
document.getElementById("windd1").innerHTML = "wind spd:"+wind1;
document.getElementById("windd2").innerHTML = "wind spd:"+wind2;
document.getElementById("windd3").innerHTML = "wind spd:"+wind3;
document.getElementById("windd4").innerHTML = "wind spd:"+wind4;
document.getElementById("windd5").innerHTML = "wind spd:"+wind5;
getimage(id1, "imaged1");
getimage(id2, "imaged2");
getimage(id3, "imaged3");
getimage(id4, "imaged4");
getimage(id5, "imaged5");
}
function convert(temp)
{
	if (kcf=="cel")
	{
		temp=temp-273.15;
	}
	else 
		temp=(temp-273.15)*1.8+32;
	return temp;
}
function getimage(idnum, elemimg){
if(idnum==804 || idnum==803)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/04d.png";
}
else if(idnum==802)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/03d.png";
}
else if(idnum==801)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/02d.png";
}
else if(idnum==800)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/01d.png";
}
else if(idnum==701 || idnum==711 || idnum==721 || idnum==731 || idnum==741 
|| idnum==751 || idnum==761 || idnum==762 || idnum==771 || idnum==781)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/50d.png";
}
else if(idnum==600 || idnum==601 || idnum==602 || idnum==611 || idnum==612 
|| idnum==615 || idnum==616 || idnum==620 || idnum==621 || idnum==622 || idnum==511)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/13d.png";
}
else if(idnum==500 || idnum==501 || idnum==502 || idnum==504 || idnum==503)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/10d.png";
}
else if(idnum==521 || idnum==522 || idnum==520 || idnum==531 || idnum==300 || idnum==301
|| idnum==302 || idnum==310 || idnum==311 || idnum==312 || idnum==313 || idnum==314|| idnum==321)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/09d.png";
}
else if(idnum==201 || idnum==211 || idnum==221 || idnum==231 || idnum==200 
|| idnum==202 || idnum==210 || idnum==230 || idnum==232 || idnum==212)
{
	document.getElementById(elemimg).src = "http://openweathermap.org/img/w/11d.png";
}
}