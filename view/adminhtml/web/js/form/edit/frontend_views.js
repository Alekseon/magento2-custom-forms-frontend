/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
define([
    'jquery',
    "Magento_Ui/js/modal/modal",
    'mage/translate',
], function ($, modal, $t) {
    'use strict';

    var frontendViewModal = {
        initialize: function (config) {
        },

        open: function (url, modalId) {
            $.ajax({
                url: url,
                type: 'GET',
                contentType: 'application/json',
                showLoader: true
            }).done(function (response) {
                this.modal = $(modalId).modal({
                    closed: function () {
                        $(this).html('');
                    },
                    opened: function () {
                    },
                    modalClass: 'magento',
                    type: 'popup',
                    title: $t('test'),
                    buttons: []
                });
                this.modal.html(response);
                this.modal.modal('openModal');
            }).fail(function (error) {
            });
        }
    }

    return function (config) {
        $(config.add_button).click(function () {
            frontendViewModal.open(config.url, config.modalId);
        });
    }
});
