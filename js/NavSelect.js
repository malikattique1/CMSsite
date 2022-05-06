
$(function() {
    // this will get the full URL at the address bar
    var url = window.location.href;
    
    // passes on every "a" tag
    $("#navbarcollapseCMS a").each(function() {
        // checks if its the same on the address bar
        if (url == (this.href)) {
            $(this).closest("li").addClass("active");
            //for making parent of submenu active
            $(this).closest("li").parent().parent().addClass("active");
        }
    });
}); 






window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navbar").style.cssText = "position:sticky; width: 100%; top: 0px;";

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;
function myFunction() {
    if (window.pageYOffset >= sticky ) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}




// window.onscroll = function() {myFunction2()};
// // var sidebar = document.getElementById("sidebar").style.cssText = "position:fixed; width: 100%; top: 0;";

// var sidebarlink = document.getElementById("sidebar");
// var offset = sidebarlink.offset();
// var top = offset.top;
// var left = offset.left;
// var right = $(window).width() - sidebarlink.width();
// var bottom = $(window).height() - offset.top - sidebarlink.height();

// var sticky = top;


// console.log(sticky);
// function myFunction2() {
//     if (window.pageYOffset <= 2950 && window.pageYOffset >=1950 ) {
//         sidebar.style.cssText = "position:fixed; width: 28%; height:100px; bottom: 1; right:0;  margin-right:99px;";
//         // sidebar.classList.add("sticky2");
//     } else {
//         sidebar.style.cssText = "";
//         // sidebar.classList.remove("sticky2");
//     }
// }









// var link = $(element);

// var offset = link.offset();
// var top = offset.top;
// var left = offset.left;
// var bottom = $(window).height() - top - link.height();
// var right = $(window).width() - link.width();
// right = offset.left - right;