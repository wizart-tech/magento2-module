define([
    'jquery'
], function ($) {
    return function (config) {
        const serverAddress = config.server_address;
        const apiToken = config.api_token;
        const context = config.context;
        const locale = config.locale;

        // bba (back button action) param is used to add back button to wizart component
        const fittingRoomEndpoint = serverAddress
            + 'fitting-room'
            + '?api_token=' + apiToken
            + '&context=' + context
            + '&locale=' + locale
            + '&bba=true';

        function openFittingRoom (searchQuery) {
            const componentEndpoint = searchQuery ? fittingRoomEndpoint + searchQuery : fittingRoomEndpoint;

            let fittingRoomObject = document.getElementById('wizart-fitting-room-object');
            // const fittingRoomObjectContainer = fittingRoomObject.parentElement;
            const fittingRoomObjectContainer = document.getElementsByTagName('body')[0];

            fittingRoomObject.setAttribute('src', componentEndpoint);
            // object clonning is necessary as some browsers does not render "object" twice after changing data attribute
            const clonnedFittingRoomObject = fittingRoomObject.cloneNode(true);

            fittingRoomObjectContainer.appendChild(clonnedFittingRoomObject);
            fittingRoomObject.remove();

            clonnedFittingRoomObject.classList.add('active');

            // should be added to avoid duplicating scrollbars
            document.getElementsByTagName('html')[0].style.overflow = 'hidden';
        }

        function openSpecificFittingRoom (event) {
            let vendorCode = $(this).data('sku');
            // query can be updated to search for necessary article
            const articleSearchQuery = '&article_query='
                + '{\"vendor_code\": \"'
                + vendorCode
                + '\"}'
            ;

            openFittingRoom(articleSearchQuery);

            return false;
        }

        function stripTrailingSlash(str) {
            if(str.substr(-1) === '/') {
                return str.substr(0, str.length - 1);
            }
            return str;
        }

        // bba event - fired when back button is clicked at wizart component
        window.addEventListener('message', function (event) {

            if (~event.origin.indexOf(stripTrailingSlash(serverAddress))) {
                // exactly 'close_overlay' as it's sent from wizart component
                if (event.data === 'close_overlay') {
                    // return overflow of target page to initial state
                    document.getElementsByTagName('html')[0].style.overflow = 'auto';

                    document.getElementById('wizart-fitting-room-object').classList.remove('active');
                }
            }
        });

        $('.wizart__entry-point-link').on('click', openSpecificFittingRoom);
    }
});
