//nav bar

$(document).ready(function () {
      $(".menu-icon").on("click", function () {
            $("nav ul").toggleClass("showing");
      });
});

// Scrolling Effect

$(window).on("scroll", function () {
      if ($(window).scrollTop()) {
            $('nav').addClass('black');
      } else {
            $('nav').removeClass('black');
      }
})

// delete post button
//! not working !
// $('.delete-post-btn').on('click', function () {

//       if (confirm('Are you sure ?')) {
//             return true;

//       } else {
//             return false;
//       }
// });

$('#password, #conf_password').on('keyup', function () {


      if ($('#password').val() == $('#conf_password').val() && $('#password').val() != "") {
            $('#message').html('Matching').css('color', 'green');
      } else
            $('#message').html('Not Matching').css('color', 'red');


});



//* scroll up button

var progressPath = document.querySelector('.progress-wrap path');
var pathLength = progressPath.getTotalLength();

progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
progressPath.style.strokeDashoffset = pathLength;
progressPath.getBoundingClientRect();
progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';

var updateProgress = function () {
      var scroll = $(window).scrollTop();
  var height = $(document).height() - $(window).height();
  var progress = pathLength - scroll * pathLength / height;
  progressPath.style.strokeDashoffset = progress;
};

updateProgress();

$(window).scroll(updateProgress);

var offset = 50;
var duration = 550;

jQuery(window).on('scroll', function () {
  if (jQuery(this).scrollTop() > offset) {
    jQuery('.progress-wrap').addClass('active-progress');
  } else {
    jQuery('.progress-wrap').removeClass('active-progress');
  }
});

jQuery('.progress-wrap').on('click', function (event) {
  event.preventDefault();
  jQuery('html, body').animate({ scrollTop: 0 }, duration);
  return false;
});