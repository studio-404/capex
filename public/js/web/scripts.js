$( function() {
    $( "#line1" ).slider1({
      animate: "normal",
      value:0,
      min: 0,
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
      value:0,
      min: 0,
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

  function Credit(elem, drop, col, step) {
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
    var price = 0;
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
  line1 = new Credit("#line1", "#drop1", 41, 50);
  line2 = new Credit("#line2", "#drop2", 25, 1);
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
});

$('body').on("click", function (ev) {
   $('body').removeClass('visible');
});



function initMap() {
        var uluru = {lat: 41.6983177, lng: 44.7562612};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: uluru,
        });
        var image = '../img/map.png';
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          icon: image
        });
      }


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
  });
}

var b64EncodeUnicode = function(str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
        return String.fromCharCode('0x' + p1);
    }));
};

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