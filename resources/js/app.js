// Pulls in all the JavaScript files that are required 
require('./bootstrap');
require('./imageUpload');
require('./financeCalculator');
require('./contactForm');
require('./carLike');
require('./deleteCar');
require('./deleteProfile');
require('./makeAndRemoveAdmins');
require('./search');
require('./addingOrUpdatingCar');
require('./increaseTextSize');
require('./compareCars');
require('./cookieConsent');
require('./deleteMessage');
require('lightbox2');

// Additional Code for the advanced search box
$(document).ready(function(){
    $(".searchBox").hide();

    $("#advancedSearch").click(function(){
        $(".searchBox").slideToggle();
    });
});