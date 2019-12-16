// JavaScript Document
function showLoader() {
	$("#loading_result").html("<div class=\"loading_bao\" style=\"position:fixed; top:50%; right:50%; text-align:center; width:120px;  color:#000000;background-color: rgba(57, 83, 83, 0.7);z-index:99999999999; padding: 8px;-moz-border-radius: 6px;border-radius: 6px;\"><div  style=\"background:#fff; height:50px;padding-top: 15px; \" >Đang tải...<br><img src='/images/ajax-loader1.gif'></div></div>").hide().fadeIn(10);
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


function alert_mgs(msg,mod){

    $.ajax({
		    url:'/action.php',
     
        type: 'POST',
        data: 'act=alert&msg='+encodeURIComponent(msg)+'&mod='+mod,
        dataType: "html",
        success: function(data){
			  showResult("luu_result",data);
			
			  
        }
    });
	return false;
}

function show_lienhe(){
		
    $.ajax({
		    url:'/action.php',
     
        type: 'POST',
        data: 'act=lien_he&mod=new',
        dataType: "html",
        success: function(data){
           showResult("load_hoang_gia",data);
		   Cufon.replace('.tin_tuc_2,.tin_khac', {fontFamily:'HP-Impact',color:'#da251c'});

        }
    });

}


function show_lienhe_sent(frm){
txt_ten =frm.name.value
txt_email =frm.email.value
tieude =frm.tieude.value
dienthoai =frm.dienthoai.value
txtSubject =frm.noidung.value
	if (txt_ten == "")
		{
		alert('Vui lòng nhập họ tên');
		frm.name.focus();
			return false;
		}
		if (!txt_email.match(/^([-\d\w][-.\d\w]*)?[-\d\w]@([-\w\d]+\.)+[a-zA-Z]{2,6}$/))
		{
		alert('Email của bạn không hợp lệ');
		frm.email.focus();
			return false;
		}
		if (tieude == "")
		{
		frm.tieude.focus();
		alert('Vui lòng nhập tiêu đề');	
			return false;
		}
		if (txtSubject == "")
		{
		frm.noidung.focus();
		alert('Vui lòng nhập nội dung');	
			return false;
		}
		if(dienthoai!="")
            { str=dienthoai;
	            for(var i = 0; i < str.length; i++)
	            {	
		            var temp = str.substring(i, i + 1);		
		            if(!(temp == "," || temp == "." || (temp >= 0 && temp <=9)))
		            {
			           alert('Vui lòng nhập số điện thoại hợp lệ');
					
			        frm.dienthoai.focus();
						return false;
		            }  
	            }
	         
            }


    $.ajax({
		    url:'/action.php',
     
        type: 'POST',
        data: "act=lien_he&mod=sent&txt_ten="+txt_ten+"&txt_email="+txt_email+"&tieude="+tieude+"&txtSubject="+txtSubject+"&dienthoai="+dienthoai,
        dataType: "html",
        success: function(data){
           alert(data);
		  	frm.name.value="";
			frm.email.value="";
			frm.tieude.value="";
			frm.dienthoai.value="";
			frm.noidung.value="";
			
        }
    });
	return false;
}

function load_trong(){

    $.ajax({
		    url:'/action.php',
     
        type: 'POST',
        data: 'act=load_trong',
        dataType: "html",
        success: function(data){
           showResult("load_thucdon",data);

        }
    });
	return false;
}


function load_duan_trang(hien_thi,page){

    $.ajax({
		    url:'/action.php',
     
        type: 'POST',
        data: 'act=du_an&mod=duan&hien_thi='+hien_thi+'&page='+page,
        dataType: "html",
        success: function(data){
           showResult("du_an_load",data);

        }
    });
	
	 $.ajax({
		    url:'/action.php',
     
        type: 'POST',
        data: 'act=du_an&mod=page&hien_thi='+hien_thi+'&page='+page,
        dataType: "html",
        success: function(data){
           showResult("du_an_load_page",data);

        }
    });
	return false;
}


function load_tiem_kiem(page){
	var noi_dung=$('#tim_kiem_album').val();
	if(noi_dung==''){
		alert('Vui lòng nhập thông tin cần tìm kiếm !');
		return false;
		}
showLoader();
    $.ajax({
		    url:'/action.php',
     
        type: 'POST',
        data: 'act=load_tiem_kiem&noi_dung='+noi_dung+'&page='+page,
        dataType: "html",
        success: function(data){
           showResult("load_tiem_kiem",data);

        }
    });
	return false;
}


function load_fb(d, s, id) {
	//$('#fb-root').html('');
  var js, fjs = d.getElementsByTagName(s)[0];
  
 // if (d.getElementById(id)) return;
  
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
	// alert(d.getElementById(id).value);
};


function load_tiem_kiem_kh(page){
	var noi_dung=$('#tim_kiem_album').val();
	if(noi_dung==''){
		alert('Vui lòng nhập thông tin cần tìm kiếm !');
		return false;
		}

	return false;
}

 
