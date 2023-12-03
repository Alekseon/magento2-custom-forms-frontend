define(['jquery'], function($) {
    'use strict';

    return function() {
        $.validator.addMethod(
            'alekseon-validate-form-filesize',
            function(v, element, params) {
                const maxSize = params * 1024;
                const file = element.files[0];

                if(!file) {
                    return true
                }

                const fsize = Math.round((file.size / 1024));
                if(fsize > maxSize) {
                    return false;
                }
                return true;
            },
            $.mage.__('File size too large.')
        );

        $.validator.addMethod(
            'alekseon-validate-form-filetype',
            function(v, element, params = 'image') {
                const file = element.files[0];

                if(!file) {
                    return true;
                }

                const pattern = new RegExp(`^${params}\/.+`);

                if(!pattern.test(file.type)) {
                    return false;
                }
                return true;
            },
            $.mage.__('File is not an image.')
        )
    }
});
