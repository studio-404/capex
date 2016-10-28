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
				location.reload();
			}else{
				$(".modal-message-box").html("E");
			}
		});
	}
};

var changeVisibility = function(vis, idx){
	console.log(vis + " " + idx);
	var ajaxFile = "/changeVisibility";

	var header = "<h4>შეტყობინება</h4><p class=\"modal-message-box\">გთხოვთ დაიცადოთ...</p>";
	var footer = "<a href=\"javascript:void(0)\" id=\"modalButton\" class=\"waves-effect waves-green btn-flat modal-close\">დახურვა</a>";

	$("#modal1 .modal-content").html(header);
	$("#modal1 .modal-footer").html(footer);
	$('#modal1').openModal();

	if(typeof vis === "undefined" || typeof idx === "undefined"){
		$(".modal-message-box").html("E2");
	}else{
		$.ajax({
			method: "POST",
			url: Config.ajax + ajaxFile,
			data: { visibility: vis, idx: idx }
		}).done(function( msg ) {
			var obj = $.parseJSON(msg);
			if(obj.Error.Code==1){
				$(".modal-message-box").html(obj.Error.Text);
			}else if(obj.Success.Code==1){
				$(".modal-message-box").html(obj.Success.Text);
				location.reload();
			}else{
				$(".modal-message-box").html("E3");
			}
		});
	}
}

var askRemovePage = function(pos, idx){
	console.log(pos + " " + idx);
	var header = "<h4>შეტყობინება</h4><p class=\"modal-message-box\">გნებავთ წაშალოთ მონაცემი ?</p>";
	var footer = "<a href=\"javascript:void(0)\" onclick=\"removePage('"+pos+"', '"+idx+"')\" class=\"waves-effect waves-green btn-flat\">დიახ</a>";
	footer += "<a href=\"javascript:void(0)\" class=\"waves-effect waves-green btn-flat modal-close\">დახურვა</a>";

	$("#modal1 .modal-content").html(header);
	$("#modal1 .modal-footer").html(footer);
	$('#modal1').openModal();
}

var removePage = function(pos, idx){
	console.log(pos + " " + idx);
	var ajaxFile = "/removePage";
	if(typeof pos === "undefined" || typeof idx === "undefined"){
		$(".modal-message-box").html("E4");
	}else{
		$.ajax({
			method: "POST",
			url: Config.ajax + ajaxFile,
			data: { pos: pos, idx: idx }
		}).done(function( msg ) {
			var obj = $.parseJSON(msg);
			if(obj.Error.Code==1){
				$(".modal-message-box").html(obj.Error.Text);
			}else if(obj.Success.Code==1){
				$(".modal-message-box").html(obj.Success.Text);
				location.reload();
			}else{
				$(".modal-message-box").html("E5");
			}
		});
	}
}

var changePositionsOfPages = function(){
	var ajaxFile = "/changePagePositions";
	var i = "";
	var arr = new Array(); 
	$('.sortablePagePositionChange tr').each(function(){
		i = $(this).attr("data-item");
		arr.push(i)
	});
	var serialized = serialize(arr);

	var header = "<h4>შეტყობინება</h4><p class=\"modal-message-box\">მიმდინარეობს მონაცემის განახლება...</p>";
	var footer = "<a href=\"javascript:void(0)\" class=\"waves-effect waves-green btn-flat modal-close\">დახურვა</a>";

	$("#modal1 .modal-content").html(header);
	$("#modal1 .modal-footer").html(footer);
	$('#modal1').openModal();

	$.ajax({
		method: "POST",
		url: Config.ajax + ajaxFile,
		data: { s:serialized }
	}).done(function( msg ) {
		var obj = $.parseJSON(msg);
		if(obj.Error.Code==1){
			$(".modal-message-box").html(obj.Error.Text);
		}else if(obj.Success.Code==1){
			$(".modal-message-box").html(obj.Success.Text);
		}else{
			$(".modal-message-box").html("E5");
		}
	});
};

$(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false 
    });
    $('.tooltipped').tooltip({delay: 50});
    $('.sortablePagePositionChange').sortable({
    	items: ".level-0",
		update: function( event, ui ) { changePositionsOfPages(); }
	});
	$('.sortablePagePositionChange').disableSelection();
 });



/* Additional functions */
var serialize = function(mixed_value) {
	var val, key, okey,
	ktype = '',
	vals = '',
	count = 0,
	_utf8Size = function(str) {
		var size = 0,
		i = 0,
		l = str.length,
		code = '';
		for (i = 0; i < l; i++) {
			code = str.charCodeAt(i);
			if (code < 0x0080) {
				size += 1;
			} else if (code < 0x0800) {
				size += 2;
			} else {
			size += 3;
			}
		}
		return size;
	};
	_getType = function(inp) {
		var match, key, cons, types, type = typeof inp;

		if (type === 'object' && !inp) {
			return 'null';
		}
		if (type === 'object') {
			if (!inp.constructor) {
				return 'object';
			}
			cons = inp.constructor.toString();
			match = cons.match(/(\w+)\(/);
			if (match) {
				cons = match[1].toLowerCase();
			}
			types = ['boolean', 'number', 'string', 'array'];
			for (key in types) {
				if (cons == types[key]) {
					type = types[key];
					break;
				}
			}
		}
		return type;
	};
	type = _getType(mixed_value);

	switch (type) {
		case 'function':
			val = '';
			break;
		case 'boolean':
			val = 'b:' + (mixed_value ? '1' : '0');
			break;
		case 'number':
			val = (Math.round(mixed_value) == mixed_value ? 'i' : 'd') + ':' + mixed_value;
			break;
		case 'string':
			val = 's:' + _utf8Size(mixed_value) + ':"' + mixed_value + '"';
			break;
		case 'array':
			case 'object':
				val = 'a';

				for (key in mixed_value) {
					if (mixed_value.hasOwnProperty(key)) {
						ktype = _getType(mixed_value[key]);
						if (ktype === 'function') {
							continue;
						}
						okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
						vals += this.serialize(okey) + this.serialize(mixed_value[key]);
						count++;
					}
				}
				val += ':' + count + ':{' + vals + '}';
				break;
		case 'undefined':
			default:
				val = 'N';
				break;
	}

	if (type !== 'object' && type !== 'array') {
		val += ';';
	}
	return val;
};

var scrollTop = function(){
	var body = $("html, body");
	body.stop().animate({scrollTop:0}, '500', 'swing', function() { });
};