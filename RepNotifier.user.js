// ==UserScript==
// @name      Reputation Notifier
// @namespace      Pillows
// @description     Sends you an alert whenever your rep changes.
// @require      http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js
// @grant      GM_getValue
// @grant      GM_setValue
// @grant      GM_deleteValue
// @include      *hackforums.net/*
// @version      1.0
// ==/UserScript==

/* Your UID
 * Make sure to change this before installing the script.
 * Or else you'll just make it really buggy
 */

var uid=0;

if(! GM_getValue("rep") && ! GM_getValue("time")) {
    var rep = 0;
    var lastCheck = 0
} else {
    rep = GM_getValue("rep");
    lastCheck = GM_getValue("time");
}

function run() {
    curTime=new Date().getTime();
    difference=(curTime - lastCheck);

    if(difference > 1800000) { 
        $.ajax({
            url: "http://www.hackforums.net/reputation.php?uid=" + uid + "&show=neutral",
            type : "POST",
            dataType : "text",
            success: function(data) {
                var reqrep=$(data).find(".repbox").text();
                
                /*
                 * If the request rep is different from the current rep, then 
                 * make an alert and change the current rep value into the
                 * requested rep value.
                */
                
                if(reqrep != rep) {
                    var repchange=(reqrep - rep);
                    
                    if(repchange > 0) 
                    	repchange += "+";
                    else 
                        repchange += "-";
                    alert("Your rep has changed in " + repchange + " points.");
                	GM_setValue("rep", reqrep);
                }
            }
        });
        GM_setValue("time", curTime);
    }
}

run();

setInterval(function() {
    run();
}, 1800000); 


