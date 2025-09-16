/**
 * File load-more.js
 *
 * Handles AJAX loading of more posts.
 */
(function ($) {
    $(function () {
        var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
            button = $('.load-more-button'),
            container = $('.masonry-grid'); // Keep the container class for consistency

        button.on('click', function () {
            if (authorpro_loadmore_params.current_page != authorpro_loadmore_params.max_page && canBeLoaded == true) {
                $.ajax({
                    url: authorpro_loadmore_params.ajaxurl,
                    data: {
                        'action': 'loadmore',
                        'query': authorpro_loadmore_params.posts,
                        'page': authorpro_loadmore_params.current_page
                    },
                    type: 'POST',
                    beforeSend: function (xhr) {
                        canBeLoaded = false;
                        button.text('Loading...');
                    },
                    success: function (data) {
                        if (data) {
                            // Append new posts
                            container.append(data);

                            authorpro_loadmore_params.current_page++;
                            button.text('Load More');
                            canBeLoaded = true;

                            if (authorpro_loadmore_params.current_page == authorpro_loadmore_params.max_page) {
                                button.remove();
                            }
                        } else {
                            button.remove();
                        }
                    }
                });
            }
        });
    });
}(jQuery));
