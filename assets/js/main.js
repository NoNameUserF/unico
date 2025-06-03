// if (document.URL.includes("index.php") ) {
//   document.getElementById('privateLogin').style.display = 'block';
//   $(document).ready(function(){
//     $(".owl-carousel").owlCarousel({
//         dots: false,
//         loop: true,
//         items: 8,
//         margin: 18,
//         autoplay: true,
//         autoplayTimeout: 3000,
//         mouseDrag: false
//     });
//   });
// }

// if (document.URL.includes('sign-up.php')) {
//   document.getElementById('privateLogin').style.display = 'none';
// }

// if (document.URL.includes('sign-up.php')) {
//   document.getElementById('logOut').style.display = 'none';
// }

//------------- СЛАЙДЕР В STRATEGYS

if (document.URL.includes('settings-not-main')) {
  const btn = document.querySelector('.download');
  const arr = ['int.pdf', 'rdec.pdf'];
  btn.addEventListener('click', e => {
    arr.forEach(item => {
      const lin = document.createElement('a');
      lin.setAttribute('download', 'download');
      lin.href = `../files/${item}`;
      lin.click();
    });
  });
}

if (document.URL.includes('strategys.php')) {
  var slider = document.getElementById('slider');
  var slider2 = document.getElementById('slider2');
  var slider3 = document.getElementById('slider3');
  var slider4 = document.getElementById('slider4');
  var pipsValues = document.getElementById('pips-values');

  noUiSlider.create(slider, {
    start: 1,
    connect: 'lower',
    step: 1,
    range: {
      min: 1,
      max: 3,
    },
    pips: {
      mode: 'values',
      values: [1, 2, 3],
      density: 50,
    },
  });

  noUiSlider.create(slider2, {
    start: 1,
    connect: 'lower',
    step: 1,
    range: {
      min: [3, 3],
      '50%': [6, 12],
      max: 18,
    },
    pips: {
      mode: 'values',
      values: [3, 6, 18],
      density: 50,
    },
  });

  noUiSlider.create(slider3, {
    start: 1,
    connect: 'lower',
    step: 1,
    range: {
      min: [6, 6],
      '50%': [12, 12],
      max: 24,
    },
    pips: {
      mode: 'values',
      values: [6, 12, 24],
      density: 50,
    },
  });

  noUiSlider.create(slider4, {
    start: 1,
    connect: 'lower',
    step: 1,
    range: {
      min: [3, 3],
      '50%': [6, 6],
      max: 12,
    },
    pips: {
      mode: 'values',
      values: [3, 6, 12],
      density: 50,
    },
  });
}

// only for demo purposes
// $.validator.setDefaults({
// 	submitHandler: function() {
// 		alert("submitted!");
// 	}
// });
// $().ready(function() {
// 	// validate the form when it is submitted
// 	var validator = $("form").validate({
// 		errorPlacement: function(error, element) {
// 			// Append error within linked label
// 			$( element )
// 				.closest( "form" )
// 					.find( "label[for='" + element.attr( "id" ) + "']" )
// 						.append( error );
// 		},
//     rules: {
//       firstname: {
//         required: true,
//         minlength: 2,
//         maxlength: 12
//     },
//       secondname: {
//         required: true,
//         minlength: 2,
//         maxlength: 12
//     },
//       name: {
//           required: true,
//           minlength: 2,
//           maxlength: 32
//       },
//       password: {
//         required: true,
//         minlength: 7,
//         maxlength: 32
//       },
//       passwordconfirm: {
//         required: true,
//         equalTo: "#password"
//       },
//       email: {
//           required: true,
//           email: true,
//           minlength: 7,
//           maxlength: 32
//       },
//       tel: {
//           required: true,
//           minlength: 10,
//           maxlength: 20
//       },
//       textarea: {
//         minlength: 5,
//         maxlength: 200
//     }
//   },
// 		errorElement: "span",
// 		messages: {
// 			name: {
// 				minlength: "must be at least 2 characters"
// 			},
//       passwordconfirm: {
// 				equalTo: "passwords do not match"
// 			},
// 			tel: {
// 				minlength: "must be between 10 and 20 characters",
// 				maxlength: "must be between 10 and 20 characters"
// 			}
// 		}
// 	});
// 	$(".cancel").click(function() {
// 		validator.resetForm();
// 	});
// });

//------------- ОТКРЫТИЕ ОПИСАНИЯ СТРАТЕГИИ В MAIN
$('.strategy-text-opener').on('click', function () {
  $(this).parent().parent().find('p').toggleClass('strategy-text-opened');
  $(this).toggleClass('strategy-text-opener-active');
});

$('.ak-user-btn').on('click', function () {
  $(this).parent().parent().parent().find('.ak-user-inner').toggleClass('ak-user-inner-active');
  $(this).toggleClass('ak-user-btn-active');
});

$('.chat-img-adm').on('click', function () {
  $(this)
    // .parent()
    .parent()
    .parent()
    .find('.chat_modal')
    .toggleClass('chat_modal-active');
});

//------------- КОПИРОВАНИЕ ID
function copytext(el) {
  var $tmp = $('<textarea>');
  $('body').append($tmp);
  $tmp.val($(el).text()).select();
  document.execCommand('copy');
  $tmp.remove();
}

//------------- КНОПКА-ПЕРЕКЛЮЧАТЕЛЬ В SECURITY
$(function () {
  $('.switch-btn').click(function (e, changeState) {
    if (changeState === undefined) {
      $(this).toggleClass('switch-on');
    }
    if ($(this).hasClass('switch-on')) {
      $(this).trigger('on.switch');
    } else {
      $(this).trigger('off.switch');
    }
  });

  $('.switch-btn').on('on.switch', function () {
    console.log('Кнопка переключена в состояние on');
  });

  $('.switch-btn').on('off.switch', function () {
    console.log('Кнопка переключена в состояние off');
  });

  $('.switch-btn').each(function () {
    $(this).triggerHandler('click', false);
  });
});

//------------- ЗАПРЕТ ПИСАТЬ В ИНПУТ БУКВЫ
$('.phone').on('input', function () {
  $(this).val(
    $(this)
      .val()
      .replace(/[A-Za-zА-Яа-яЁё]/, '')
  );
});

//------------- ВЫБОР СТРАНЫ В ИНПУТ ТЕЛ
const input = document.querySelector('#tel');

window.intlTelInput(input, {
  utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js',
});
