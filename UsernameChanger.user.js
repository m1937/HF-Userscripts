// ==UserScript==
// @name      Roger Waters Username Changer
// @namespace      Pillows
// @description     Replaces your signature with your payee's.
// @require      http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js
// @include      *hackforums.net/*
// @version      1.0
// ==/UserScript==

original="Roger Waters";
newUserName="meep";
if(window.location.href.indexOf("hackforums.net/showthread.php?tid=") >= 1) {

    var usernames=$(".group0");
    
    for(var i=0;i<usernames.length;i++) {
    	var meep = usernames[i].innerHTML;
        if(meep==original) {
            usernames[i].innerHTML = newUserName;
        }
    }
}
