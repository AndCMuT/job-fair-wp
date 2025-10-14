(function($) {

  $("#hamburger-menu").click(function(event) {
    event.stopPropagation();
    $(".header-navigation").addClass("open");

  });

    $(".close-menu").click(function(event) {
    event.stopPropagation();
    $(".header-navigation").removeClass("open");

  });

  $("#hamburger-menu").keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {
      $(".header-navigation").addClass("open");
    }
  });

  $(".close-menu").keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {
      $(".header-navigation").removeClass("open");
    }
  });


$('#search_categories').chosen().change( function(obj, result) {
});


})(jQuery);

if (jQuery(window).width() < 991){
  const  jobclub_focusableElements =
  'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
const jobclub_modal = document.querySelector('nav#site-navigation'); 

const jobclub_firstFocusableElement = jobclub_modal.querySelectorAll(jobclub_focusableElements)[0]; 
const jobclub_focusableContent = jobclub_modal.querySelectorAll(jobclub_focusableElements);
const jobclub_lastFocusableElement = jobclub_focusableContent[jobclub_focusableContent.length - 1];


document.addEventListener('keydown', function(e) {
let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

if (!isTabPressed) {
  return;
}

if (e.shiftKey) { // if shift key pressed for shift + tab combination
  if (document.activeElement === jobclub_firstFocusableElement) {
    jobclub_lastFocusableElement.focus(); // add focus for the last focusable element
    e.preventDefault();
  }
} else { // if tab key is pressed
  if (document.activeElement === jobclub_lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
    jobclub_firstFocusableElement.focus(); // add focus for the first focusable element
    e.preventDefault();
  }
}
});

jobclub_firstFocusableElement.focus();}