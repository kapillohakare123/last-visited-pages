var $ = jQuery.noConflict();
function checkHistory(targetClass, count) {

    var history = $.cookie('history');
    var htmlContent = '';

    if (history != "" && history != null) {
        var insert = true;
        var sp = history.toString().split(",");
        htmlContent += '<ul>';
         var getLocation = function(href) {
    var l = document.createElement("a");
    l.href = href;
    return l;
};
        for (var i = sp.length - 1; i >= 0; i--) {
          var page=(getLocation(sp[i]).pathname).split("/");
            var page_slug=page[page.length-2];
            htmlContent += '<li><a class="demo-pricing demo-pricing-1"  href="'
                    + sp[i]
                    + '">'
                    + page_slug + '</a></li>';
            if (sp[i] == document.URL) {
                insert = false;
            }
            $('.' + targetClass).html(htmlContent);
        }
        htmlContent += '</ul>';
        if (insert) {
            sp.push(document.URL);
            if ((sp.length - 1) == count)
                sp.shift();
        }
        $.cookie('history', sp.toString(), {expires: 30, path: '/'});
    } else {
        var stack = new Array();
        stack.push(document.URL);
        $.cookie('history', stack.toString(), {expires: 30, path: '/'});
    }
}
function clearHistory(targetClass) {
    $.removeCookie('history', {path: '/'});
    $('.' + targetClass).html("");
//    alert("Visited page links were cleared");
}