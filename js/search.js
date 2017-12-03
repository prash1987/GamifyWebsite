$(document).ready(function() {
 
              $('#search_text_input').focus(function() {
                           if(window.matchMedia( "(min-width: 800px)" ).matches) {
                                         $(this).animate({width: '250px'}, 500);
                           }
              });
 
              $('#image_button').on('click', function() {
                           //document.search_form1.submit();
                           //alert("button is clicked");
              });
 
});
 
 
function getLiveSearchUsers(value, user) {
              
              $.post("handlers/ajax_search.php", {query:value, userLoggedIn: user}, function(data) {
                           if($(".search_results_footer_empty")[0]) {
                              	$(".search_results_footer_empty").toggleClass("search_results_footer");
                              	$(".search_results_footer_empty").toggleClass("search_results_footer_empty");
                           }
 
                           $('.search_results').html(data);
                           //$('.search_results_button').html("<a href='search.php?q=" + value + "'>See All Results</a>");
 
                           if(data == "") {
                                         $('.search_results_footer').html("");
                                         $('.search_results_footer').toggleClass("search_results_footer_empty");
                                         $('.search_results_footer').toggleClass("search_results_footer");
                           }
              });
}