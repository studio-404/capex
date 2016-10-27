var Config = {
	website:"http://capex.404.ge/",
	ajax:"http://capex.404.ge/ajax/index", 
	pleaseWait:"მოთხოვნა იგზავნება..."
};

var sign_in_try = function(){
	var ajaxFile = "/signing";
	var username = typeof $("#username").val() === "undefined" ? "" : $("#username").val();
	var password = typeof $("#password").val() === "undefined" ? "" : $("#password").val();
	var errorMsg = $(".error-msg");
	errorMsg.text(Config.pleaseWait).fadeIn();
	
	$.ajax({
		method: "POST",
		url: Config.ajax + ajaxFile,
		data: { username: username, password: password }
	}).done(function( msg ) {
		var obj = $.parseJSON(msg);
		if(obj.Error.Code==1){
			errorMsg.text(obj.Error.Text).fadeIn();
		}else{
			location.href = obj.redirect;
		}
	});
	
};

var add_page = function(){
	var ajaxFile = "/addPageForm";
	var header = "<h4>გვერდის დამატება</h4><p class=\"modal-message-box\"></p>";
	var content = "<p>გთხოვთ დაიცადოთ...</p>";
	var footer = "<a href=\"javascript:void(0)\" id=\"modalButton\" class=\"waves-effect waves-green btn-flat\">დამატება</a>";

	$("#modal1 .modal-content").html(header + content);
	$("#modal1 .modal-footer").html(footer);
	$('#modal1').openModal();

	$.ajax({
		method: "POST",
		url: Config.ajax + ajaxFile,
		data: { call: true }
	}).done(function( msg ) {
		var obj = $.parseJSON(msg);
		if(obj.Error.Code==1){
			errorMsg.text(obj.Error.Text).fadeIn();
			var errorText = "<p>" + obj.Error.Text +"</p>";
			$("#modal1 .modal-content").html(header + errorText);
		}else{
			var form = "<p>" + obj.form +"</p>";
			$("#modal1 .modal-content").html(header + form);
			$("#choosePageType").material_select();
			$("#modalButton").attr({"onclick": obj.attr });
		}
	});
};

var formPageAdd = function(){
	var ajaxFile = "/addPage";
	var choosePageType = $("#choosePageType").val();
	var title = $("#title").val();
	var slug = $("#slug").val();
	var pageDescription = $("#pageDescription").val();
	var pageText = $("#pageText").val();
	$(".modal-message-box").html("გთხოვთ დაიცადოთ...");
	if(
		(typeof choosePageType === "undefined" || choosePageType=="") || 
		(typeof title === "undefined" || title=="") || 
		(typeof slug === "undefined" || slug=="") || 
		(typeof pageDescription === "undefined" || pageDescription=="") || 
		(typeof pageText === "undefined" || pageText=="")
	){
		$(".modal-message-box").html("ყველა ველი სავალდებულოა !");
	}else{
		$.ajax({
			method: "POST",
			url: Config.ajax + ajaxFile,
			data: { choosePageType: choosePageType, title: title, slug: slug, pageDescription: pageDescription, pageText: pageText }
		}).done(function( msg ) {
			var obj = $.parseJSON(msg);
			if(obj.Error.Code==1){
				$(".modal-message-box").html(obj.Error.Text);
			}else if(obj.Success.Code==1){
				$(".modal-message-box").html(obj.Success.Text);
				$("#choosePageType").val("");
				$("#title").val("");
				$("#slug").val("");
				$("#pageDescription").val("");
				$("#pageText").val("");
				scrollTop();
			}else{
				$(".modal-message-box").html("E");
			}
		});
	}
};

var scrollTop = function(){
	var body = $("html, body");
	body.stop().animate({scrollTop:0}, '500', 'swing', function() { });
}

$(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false 
    });
    $('.tooltipped').tooltip({delay: 50});
 });
// console.log(Config.ajax);