// function showAlert() {
//   $("#theAlert").addClass("in");
// }

// window.setTimeout(function () {
//   showAlert();
// }, 1000);

// $(".alert").hide().fadeIn(700).slideUp(500, function () { 
//   $(this).remove();
// });

// window.setTimeout(function () {
//   $(".alert").fadeTo(500, 1).slideDown(500, function (){
//     $(this).remove()
//   });
// }, 3000);

// $(document).load(function (){
//   $(".alert").fadein(2000)
// });

// $(function (){
// // $(".alert").hide()

// $(".alert").fadeIn(2000)

// });

// $(".alert").hide()
// $(".alert").fadeIn(2000)
// $(document).ready(function () {


// //   .slideDown(500, function () {
// // $(this).show();
// // });

window.setTimeout(function () {
  $(".alert").fadeTo(500, 0).slideUp(500, function () {
    $(this).remove();
  });
}, 2000);

// });