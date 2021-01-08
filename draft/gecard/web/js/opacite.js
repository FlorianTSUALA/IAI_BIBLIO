
function set_opacity(id, opacity) 
{ 
el = document.getElementById(id); 
el.style["filter"] = "alpha(opacity="+opacity+")"; 
el.style["-moz-opacity"] = opacity/100; 
el.style["-khtml-opacity"] = opacity/100; 
el.style["opacity"] = opacity/100; 
return true; 
} 


function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
