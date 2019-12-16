
function showLoader() {
	$("#loading_result").html("<div style=\"position:fixed; top:50%; right:50%; text-align:center; background:url(../images/nen_slide.png); width:90px; height:70px; padding-top:20px\"><img src='../images/loading-icon1.gif'></div>").hide().fadeIn(10);
	block = true;
}
function closeLoader() {
	$("#loading_result").html("").hide().fadeOut('slow');
	block = false;
}
function showResult(type,data) {
	closeLoader();
	$("#"+type+"").html(data).hide().fadeIn('slow');
	block = false;
}



function edit_cat_thongtin(id){

showLoader();
ten=encodeURIComponent(document.getElementById('cat_'+id).value);
			
		showLoader();	
    $.ajax({
		    url:'/admin/prog/edit_cat.php',
     
        type: 'POST',
        data: 'id='+id+'&ten='+ten,
        dataType: "html",
        success: function(data){
           showResult("thong_bao_"+id,data);
		

        }
    });

}




function loan_calculator_money(mnt){if(mnt.length<4)return mnt;mnt=loan_calculator_fmtMoney(mnt,0,'.',',');mnt=mnt.replace('N','00');return mnt;};function loan_calculator_fmtMoney(n,c,d,t){var m=(c=Math.abs(c)+1?c:2,d=d||",",t=t||".",/(\d+)(?:(\.\d+)|)/.exec(n+"")),x=m[1].length%3;return(x?m[1].substr(0,x)+t:"")+m[1].substr(x).replace(/(\d{3})(?=\d)/g,"$1"+t)+(c?d+(+m[2]).toFixed(c).substr(2):"");};var adGroupObjList=new Array();var adSize=new Array();var objMap=new Array();function BindData(l,gId,w,h){var n=l.length;if(n==0)return;else if(n==1){var player=document.getElementById("AdPlayer-"+gId);player.innerHTML=Build_Banners(gId,l[0].Id,l[0].IsImage?1:0,l[0].Url,l[0].ClickUrl," class='banner-"+w+"x"+h+"' ",l[0].Tooltip);return;}
else{var adObjList=new Array();for(var i=0;i<n;i++){var adObj=new Array();adObj.push(l[i].Id);adObj.push(l[i].Url);adObj.push(l[i].Tooltip);adObj.push(l[i].TTL);adObj.push(l[i].TTL);adObj.push(l[i].IsImage?1:0);adObj.push(l[i].ClickUrl);adObjList.push(adObj);}
adGroupObjList.push(adObjList);adSize.push(" class='banner-"+w+"x"+h+"' ");objMap.push(gId);var objIndex=0;var gIndex=jQuery.inArray(gId,objMap);var player=document.getElementById("AdPlayer-"+gId);player.innerHTML=Build_Banners(gId,adGroupObjList[gIndex][objIndex][0],adGroupObjList[gIndex][objIndex][5],adGroupObjList[gIndex][objIndex][1],adGroupObjList[gIndex][objIndex][6],adSize[gIndex],adGroupObjList[gIndex][objIndex][2]);AdLive(gId,objIndex);}}
function AdLive(gId,objIndex){var player=document.getElementById("AdPlayer-"+gId);var gIndex=jQuery.inArray(gId,objMap);if(adGroupObjList.length>0){adGroupObjList[gIndex][objIndex][4]--;if(adGroupObjList[gIndex][objIndex][4]==0){objIndex++;if(objIndex==adGroupObjList[gIndex].length){objIndex=0;for(var i=0;i<adGroupObjList[gIndex].length;i++)
adGroupObjList[gIndex][i][4]=adGroupObjList[gIndex][i][3];}
player.innerHTML=Build_Banners(gId,adGroupObjList[gIndex][objIndex][0],adGroupObjList[gIndex][objIndex][5],adGroupObjList[gIndex][objIndex][1],adGroupObjList[gIndex][objIndex][6],adSize[gIndex],adGroupObjList[gIndex][objIndex][2]);}
setTimeout(function(){AdLive(gId,objIndex)},1000);}}




function $(id) {
	return document.getElementById(id);
}
// AJAX INIT
function khoitao_ajax()
{
	var x;
	try 
	{
		x	=	new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
    	try 
		{
			x	=	new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(f) { x	=	null; }
  	}
	if	((!x)&&(typeof XMLHttpRequest!="undefined"))
	{
		x=new XMLHttpRequest();
  	}
	return  x;
}
//	Sieu thi dia oc function
function	Forward(url)
{
	window.location.href = url;
}
function	_postback()
{
	return void(1);
}

function loadingthanhpho_ajax(url) {

 $('#load_quan').html('<p><img src="ajax-loader-2.gif/></p>');
 
    $('#load_quan').load(url,"",
        function(responseText, textStatus, XMLHttpRequest) {
            if(textStatus == 'error') {
                $('#load_quan').html('<p>There was an error making the AJAX request</p>');
            }
        }
    );
	
};


function load_upload_action(){
$('#upload_result').html('<p><img src="ajax-loader-2.gif/></p>');
    $('#upload_result').load('load_upload_hinh.php', "",
        function(responseText, textStatus, XMLHttpRequest) {
            if(textStatus == 'error') {
                $('#upload_result').html('<p>There was an error making the AJAX request</p>');
            }
        }
    );
	
};

function delete_hinh(ten,id,bien) {
	
	$('#hinh_delete_'+bien+'').hide();

 $('#loading_delete_hinh').html('<p><img src="ajax-loader-2.gif/></p>');
    $('#loading_delete_hinh').load('delete_hinh.php?id='+id+'&ten='+ten, "",
        function(responseText, textStatus, XMLHttpRequest) {
            if(textStatus == 'error') {
                $('#loading_delete_hinh').html('<p>There was an error making the AJAX request</p>');
            }
        }
    );

}


function them_note(id,hinh){

		showLoader();	
		
    $.ajax({
		    url:'/admin/note_photos.php',
     
        type: 'POST',
        data: 'mod=view&id='+id+'&hinh='+hinh,
        dataType: "html",
        success: function(data){
			$('#khung_note').show();
           showResult("khung_note",data);
        	}
   		 });
	
	
	}
	
	
function luu_note(id,hinh){

		showLoader();	

		var note=encodeURIComponent($('#chu_thich_photo').val());
    $.ajax({
		    url:'/admin/note_photos.php',
     
        type: 'POST',
        data: 'mod=luu&id='+id+'&hinh='+hinh+'&note='+note,
        dataType: "html",
        success: function(data){
			
           showResult("show_note",data);
        	}
   		 });
	
	
	}	


