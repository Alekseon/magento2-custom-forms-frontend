/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'Magento_Ui/js/modal/confirm',
    'mage/translate'
], function ($, modal, confirm, $t) {
    'use strict';

    var frontendViewModal = {
        initialize: function (config) {
        },

        open: function (config) {
            $.ajax({
                url: config.modalUrl,
                type: 'GET',
                contentType: 'application/json',
                data: {
                    view_id: config.viewId
                },
                showLoader: true
            }).done(function (response) {
                this.modal = $(config.modalId).modal({
                    closed: function () {
                        $(this).html('');
                    },
                    opened: function () {
                    },
                    modalClass: 'magento',
                    type: 'popup',
                    title: $t('test'),
                    buttons: [{
                        text: 'Save',
                        class: 'action-primary',
                        click: function () {
                            const form = $(config.formId);
                            const modal = this;
                            $.ajax({
                                type: 'POST',
                                url: config.saveUrl,
                                data: form.serialize(),
                                showLoader: true
                            }).done(function (response) {
                                modal.closeModal();
                                eval(config.gridJsName).doFilter();
                            });
                        }
                    }]
                });
                this.modal.html(response);
                this.modal.modal('openModal');
            }).fail(function (error) {
            });
        }
    }

    return function (config) {
        $(config.add_button).click(function () {
            config.viewId = 0;
            frontendViewModal.open(config);
        });

        document.addEventListener("open_frontend_view_modal", function(){
            config.viewId = document.frontendViewId;
            frontendViewModal.open(config);
        });

        document.addEventListener("delete_frontend_view", function(){
            confirm({
                content: $t('Are you sure you want to delete this view?'),
                actions: {
                    confirm: function () {
                        $.ajax({
                            url: config.deleteUrl,
                            type: 'GET',
                            contentType: 'application/json',
                            data: {
                                view_id:  document.frontendViewId
                            },
                            showLoader: true
                        }).done(function (response) {
                            eval(config.gridJsName).doFilter();
                        });
                    },
                    cancel: function () {
                        return false;
                    }
                }
            });
        });
    }
});
