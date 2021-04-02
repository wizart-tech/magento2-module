define([
],
function () {
    return function (config, element) {

        (function() {
            var lc = document.createElement('script');
            lc.type = 'text/javascript';
            // lc.defer = true;
            lc.className = 'wizart__floating-button';
            lc.dataset.title = 'Custom button title';
            lc.dataset.token = 'tokensfdsfs';
            lc.src = 'https://wizart-files.fra1.digitaloceanspaces.com/production/integration/floating-button.min.js';
            var s = document.getElementsByTagName('script')[document.getElementsByTagName.length];
            s.parentNode.insertBefore(lc, s);
        })();
    }
});