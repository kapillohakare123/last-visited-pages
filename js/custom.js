var $ = jQuery.noConflict();
function checkHistory(targetClass, count) {

    var history = $.cookie('history');
    var htmlContent = '';

    if (history != "" && history != null) {
        var insert = true;
        var sp = history.toString().split(",");
        htmlContent += '<ul>';
        for (var i = sp.length - 1; i >= 0; i--) {
            htmlContent += '<li><a class="demo-pricing demo-pricing-1"  href="'
                    + sp[i]
                    + '">'
                    + sp[i] + '</a></li>';
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