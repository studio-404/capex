$( function() {
    $( "#line1" ).slider1({
      animate: "normal",
      value: 300,
      min: 300,
      max: 2000,
      step: 50,
      range: "min",
      classes: {
      "ui-slider-handle": "drop1"
    },
      slide: function( event, ui ) {
        $(".drop1").text( ui.value );
      $(".money label").text( ui.value );
      $("#loanMoney").text(ui.value);
      $("#loanMoney2").val(ui.value);
      summa1(ui.value);
      }
    });
    $(".drop1").text( $( "#line1" ).slider1( "value" ) );
});


$( function() {
    $( "#line2" ).slider1({
      animate: "normal",
      value:3,
      min: 3,
      max: 24,
      step: 1,
      range: "min",
      classes: {
      "ui-slider-handle": "drop2"
    },
      slide: function( event, ui ) {
        $( ".drop2" ).text( ui.value );
      $( ".month label" ).text( ui.value );
      $("#loanMonth").text(ui.value);
      $("#loanMonth2").val(ui.value);
      summa2(ui.value);
      }
    });
    $( ".drop2" ).text( $( "#line2" ).slider1( "value" ) );
  } );

  function summa1(a){
    $(".procent label").text(a * $( "#line2" ).slider1( "value" ) / 100);
  };

  function summa2(a){
    $(".procent label").text($( "#line1" ).slider1( "value" ) * a / 100);
  };

  function Credit(elem, drop, col, step, starts) {
  var elem = elem;
  var drop = drop;
  var col = col;
  var step = step;
  var widthCircle = $(".circle").width();
  this.current = 0;
  var self = this;
  this.init = function(){
    this.createCircle();
    // this.setCircle();
    this.clickCircle();
    // this.resize();
  }
  this.createCircle = function(){
    var price = starts;
    var procent = 0;
    var stepProcent = 100 / (col - 1);
    for (var i = col - 1; i >= 0; i--) {
      $(elem).append('<div class="circle" style="left:'+procent+'%"><div class="placeholder">'+price+'</div></div>');
      price += step;
      procent += stepProcent;
    }
  }

  this.setCirclePro = function(){
    var widthLine = $(elem).width();
    var widthCircleAll = widthCircle * col;
    var marginRight = (widthLine - widthCircleAll) / (col - 1);
    $(elem + " .circle").css({"margin-right": marginRight, "background-color":"red"});
  }
  this.clickCircle = function(){
    $(elem + " .circle").click(function(){
      $(elem + " .circle").removeClass("active");
      $(this).addClass("active");
    });
  }

  this.init();
}

setTimeout(function(){
  line1 = new Credit("#line1", "#drop1", 35, 50, 300);
  line2 = new Credit("#line2", "#drop2", 22, 1, 3);
}, 200)


$(function() {
  $('.ScrollAnimate').click(function() {

    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);

      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
           scrollTop: target.offset().top
        }, 1000);
        return false;$(this).addClass('active');
      }
    }
  });
});

/*
Material Design Modal Open
*/
$(document).ready(function(){
    $('.OpenModalClick').leanModal();
});


/*
Material Design Selector
*/
$(document).ready(function() {
    $('select').material_select(); 
});


/*
Responsive Menu
*/
$(document).ready(function(){
    $('.nav_bar').click(function(){
        $('.navigation').toggleClass('visible');
        $('body').toggleClass('BodyOpacity');
    });
	$('.MenuCloseClick').click(function(){
        $('.navigation').removeClass('visible');
        $('body').removeClass('BodyOpacity');
    });
	$(".MenuCloseClick2").click(function() {
		$('.navigation').removeClass('visible');
        $('body').removeClass('BodyOpacity');
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 1000);
	});
  $('#PersonalNumber').bind('keyup', function(e) {
    console.log(e.keyCode);
    if ( e.keyCode === 13 ) { 
      $("#siButton").click();
    }
  });
  $('#PersonalPass').bind('keyup', function(e) {
    console.log(e.keyCode);
    if ( e.keyCode === 13 ) { 
      $("#siButton").click();
    }
  });
});

$('body').on("click", function (ev) {
   $('body').removeClass('visible');
});


$('.modal-trigger').leanModal({
    ready: function () {
        var modelImgW = $('.modal-content img').innerWidth();
        var modelImgH = $('.modal-content img').innerHeight();
        $('.media-insert .model').css({
            'height': modelImgH + 'px'
        });
        $('.media-insert .model').css({
            'width': modelImgW + 'px'
        });

    }
});




if (document.documentElement.clientWidth > 900) {

    $(function(){
        var windowH = $(window).height();
        var wrapperH = $('.height100').height();
        if(windowH > wrapperH) {                            
            $('.height100').css({'height':($(window).height())+'px'});
        }                                                                               
        $(window).resize(function(){
            var windowH = $(window).height();
            var wrapperH = $('.height100').height();
            var differenceH = windowH - wrapperH;
            var newH = wrapperH + differenceH;
            var truecontentH = $('#truecontent').height();
            if(windowH > truecontentH) {
                $('.height100').css('height', (newH)+'px');
            }

        })          
    });



}


function setModalMaxHeight(element) {
  this.$element     = $(element);  
  this.$content     = this.$element.find('.modal');
  var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
  var dialogMargin  = $(window).width() < 768 ? 20 : 60;
  var contentHeight = $(window).height() - (dialogMargin + borderWidth);
  var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
  var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
  var maxHeight     = contentHeight - (headerHeight + footerHeight);

  this.$content.css({
      'overflow': 'hidden'
  });
  
  this.$element
    .find('.modal-body').css({
      'max-height': maxHeight,
      'overflow-y': 'auto'
  });
}

$('.modal').on('show.bs.modal', function() {
  $(this).show();
  setModalMaxHeight(this);
});

$(window).resize(function() {
  if ($('.modal.in').length != 0) {
    setModalMaxHeight($('.modal.in'));
  }
});

/* Gio Js Start */
var Config = {
  website:"http://capex.404.ge/",
  ajax:"http://capex.404.ge/ajax/index", 
  profile:"http://capex.404.ge/profile/index", 
  pleaseWait:"მოთხოვნა იგზავნება..."
};

var makeStatement = function(){
  var form = $("#loanForm");
  var serial = form.serialize();

  var ajaxFile = "/makeStatement";
  $.ajax({
      method: "POST",
      url: Config.ajax + ajaxFile,
      data: { formData:serial }
    }).done(function( msg ) {
      var obj = $.parseJSON(msg);
      if(obj.Error.Code==1){
        $(".modal-message-box").html(obj.Error.Text);
      }else if(obj.Success.Code==1){
        $(".modal-message-box").html(obj.Success.Text);
        $("#loanForm input[type='text']").each(function(){
          $(this).val('');
        });
      }else{
        $(".modal-message-box").html("E");
      }
      scrollTop();
  });
}

var signintry = function(user, pass){
  var ajaxFile = "/callapi";
  $(".modal-message-box-auth").html("გთხოვთ დაელოდოთ...");
  if(typeof user == "undefined" || typeof pass == "undefined" || user=="" || pass==""){
    $(".modal-message-box-auth").html("მომხმარებლის სახელი ან პაროლი არასწორია !");
  }else{
    $.ajax({
      method: "POST",
      url: Config.ajax + ajaxFile,
      data: { user: user, pass:pass }
    }).done(function( msg ) {
      var obj = $.parseJSON(msg);
      if(obj.Success.Code == 1){
        location.href = Config.profile;
      }else{
        $(".modal-message-box-auth").html(obj.Error.Text);
      }
    });
  }
};

var scrollTop = function(){
  var body = $("html, body");
  body.stop().animate({scrollTop:0}, '500', 'swing', function() { });
};

var gotox = function(l){
   window.open(l,'_blank');
}


var recoverPassword = function(){
  $('.modal-close').click(); 
  // $("#recover").modal("open");
};

var updateProfile = function(){
  var form = $("#editloanForm");
  var serial = form.serialize();

  var ajaxFile = "/editStatement";
  $.ajax({
      method: "POST",
      url: Config.ajax + ajaxFile,
      data: { formData:serial }
    }).done(function( msg ) {
      var obj = $.parseJSON(msg);
      if(obj.Error.Code==1){
        $(".modal-message-box").html(obj.Error.Text);
      }else if(obj.Success.Code==1){
        $(".modal-message-box").html(obj.Success.Text);
      }else{
        $(".modal-message-box").html("E");
      }
      scrollTop();
  });
};

var upPassword = function(){
  var form = $("#password-update");
  var serial = form.serialize();

  var ajaxFile = "/updatePassword";
  $.ajax({
      method: "POST",
      url: Config.ajax + ajaxFile,
      data: { formData:serial }
    }).done(function( msg ) {
      var obj = $.parseJSON(msg);
      if(obj.Error.Code==1){
        $(".modal-message-box-password").html(obj.Error.Text);
      }else if(obj.Success.Code==1){
        $(".modal-message-box-password").html(obj.Success.Text);
        $("#password-update input[type='password']").each(function(){
          $(this).val('');
        });
      }else{
        $(".modal-message-box-password").html("E");
      }
      scrollTop();
  });
}; 

var reButton = function(){
  var email = $("#recover-email").val();
  var secure = $("#secure").val();
  var ajaxFile = "/recoverEmail";
  $.ajax({
      method: "POST",
      url: Config.ajax + ajaxFile,
      data: { email:email, secure:secure }
    }).done(function( msg ) {
      var obj = $.parseJSON(msg);
      if(obj.Error.Code==1){
        $(".modal-message-box-recover").html(obj.Error.Text);
      }else if(obj.Success.Code==1){
        $(".modal-message-box-recover").html(obj.Success.Text);
        $("#recover-email").val('');
      }else{
        $(".modal-message-box-recover").html("E");
      }
      scrollTop();
  });
};

var reGetMoney = function(){
  var money = $("#loanMoney2").val();
  var month = $("#loanMonth2").val();
  
  var ajaxFile = "/reget";
  $.ajax({
      method: "POST",
      url: Config.ajax + ajaxFile,
      data: { money:money, month:month }
    }).done(function( msg ) {
      var obj = $.parseJSON(msg);
      if(obj.Error.Code==1){
        $(".modal-message-box-recover").html(obj.Error.Text);
      }else if(obj.Success.Code==1){
        $(".modal-message-box-recover").html(obj.Success.Text);
        $("#recover-email").val('');
      }else{
        $(".modal-message-box-recover").html("E");
      }
      scrollTop();
  });
};
