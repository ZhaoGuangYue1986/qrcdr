/*
 * QrCdr - jQuery Plugin
 * version: 5.2
 * @requires jQuery >= 1.7.0
 * @requires popper
 * @requires bootstrap
 * @requires spectrum
 * @requires bootstrap-maxlength
 * @requires cropit
 *
 * Copyright 2020-2021 Nicola Franchini - @nicolafranchini
 *
 */

/* global jQuery */
(function($){
    "use strict";   
    $.fn.extend({
        // plugin name - qrcdr
        qrcdr: function(options) {
            var plugin = this;
            var $myForm, formInputs, formOnInput, formOnChange, submitform, linksholder, qrcolorpicker, colorpickerback, preloader, alert_placeholder, transparent_bg, resultholder, generate_qrcode_btn, holdresult;
            var collapse_control, collapse_control_reverse, upmarker, isSvg, event, map, timer, setvalue, yesdonation, nodonation, init_lat, init_lng, btcInput, settings, tabs, section, relative, sendOptions, slider;
            var removebg, exportbg, gradientbg, transbg, imagefield, selectbg, cropinput, imageeditor, collapsebg, cropzoom, croppreview, negative;

            var svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 48 48"><path d="M28.9,18.4l-3.4,3.4V10.5C25.5,9.7,24.8,9,24,9s-1.5,0.7-1.5,1.5v11.4l-3.4-3.4c-0.6-0.6-1.5-0.6-2.1,0 c-0.6,0.6-0.6,1.5,0,2.1l6,6c0.6,0.6,1.5,0.6,2.1,0c0,0,0,0,0,0l6-6c0.6-0.6,0.6-1.5,0-2.1C30.5,17.9,29.5,17.9,28.9,18.4z"/><path d="M42,30V13.5L28.5,0H12C8.7,0,6,2.7,6,6v24c-1.7,0.1-3,1.4-3,3.1v5.8c0,1.7,1.3,3,3,3.1v0c0,3.3,2.7,6,6,6h24 c3.3,0,6-2.7,6-6v0c1.7-0.1,3-1.4,3-3.1v-5.8C45,31.4,43.7,30.1,42,30z M36,45H12c-1.7,0-3-1.3-3-3h30C39,43.7,37.7,45,36,45z M16.6,37.2c-0.2-0.2-0.4-0.3-0.7-0.4c-0.3-0.1-0.6-0.2-1.1-0.3c-0.6-0.1-1.1-0.3-1.6-0.5c-0.4-0.2-0.8-0.5-1-0.8 c-0.2-0.3-0.4-0.8-0.4-1.3c0-0.5,0.1-0.9,0.4-1.3c0.3-0.4,0.6-0.7,1.1-0.9c0.5-0.2,1.1-0.3,1.7-0.3c0.5,0,1,0.1,1.4,0.2 c0.4,0.1,0.7,0.3,1,0.5c0.3,0.2,0.4,0.4,0.6,0.7c0.1,0.2,0.2,0.5,0.2,0.7c0,0.2-0.1,0.4-0.2,0.6s-0.3,0.3-0.6,0.3 c-0.2,0-0.4-0.1-0.5-0.2c-0.1-0.1-0.2-0.3-0.3-0.5c-0.2-0.3-0.3-0.6-0.6-0.8c-0.2-0.2-0.6-0.3-1.1-0.3c-0.5,0-0.8,0.1-1.1,0.3 s-0.4,0.4-0.4,0.7c0,0.2,0,0.3,0.1,0.4c0.1,0.1,0.2,0.2,0.4,0.3c0.2,0.1,0.3,0.2,0.5,0.2c0.2,0.1,0.4,0.1,0.8,0.2 c0.5,0.1,0.9,0.2,1.3,0.4c0.4,0.1,0.7,0.3,1,0.5c0.3,0.2,0.5,0.4,0.6,0.7s0.2,0.7,0.2,1.1c0,0.5-0.1,1-0.4,1.4 c-0.3,0.4-0.7,0.7-1.2,1c-0.5,0.2-1.1,0.4-1.8,0.4c-0.9,0-1.6-0.2-2.1-0.5c-0.4-0.2-0.7-0.5-1-0.9c-0.2-0.4-0.4-0.8-0.4-1.1 c0-0.2,0.1-0.4,0.2-0.5s0.3-0.2,0.6-0.2c0.2,0,0.3,0.1,0.5,0.2c0.1,0.1,0.2,0.3,0.3,0.5c0.1,0.3,0.2,0.5,0.4,0.7s0.3,0.3,0.5,0.5 c0.2,0.1,0.5,0.2,0.9,0.2c0.5,0,0.9-0.1,1.3-0.4c0.3-0.2,0.5-0.5,0.5-0.9C16.9,37.7,16.8,37.4,16.6,37.2z M19.5,32.4 c0-0.2,0.1-0.4,0.2-0.5s0.4-0.2,0.6-0.2c0.3,0,0.5,0.1,0.6,0.3c0.1,0.2,0.2,0.5,0.4,0.9l2,5.8l2-5.8c0.1-0.3,0.2-0.5,0.2-0.6 c0.1-0.1,0.1-0.2,0.3-0.3c0.1-0.1,0.3-0.1,0.5-0.1c0.2,0,0.3,0,0.4,0.1c0.1,0.1,0.2,0.2,0.3,0.3s0.1,0.2,0.1,0.4c0,0.1,0,0.2,0,0.3 S27,32.8,27,32.9c0,0.1-0.1,0.2-0.1,0.3l-2.1,5.6c-0.1,0.2-0.2,0.4-0.2,0.6c-0.1,0.2-0.2,0.4-0.3,0.5s-0.2,0.3-0.4,0.4 s-0.4,0.1-0.6,0.1c-0.2,0-0.4,0-0.6-0.1c-0.2-0.1-0.3-0.2-0.4-0.4c-0.1-0.2-0.2-0.3-0.3-0.5c-0.1-0.2-0.1-0.4-0.2-0.6l-2.1-5.6 c0-0.1-0.1-0.2-0.1-0.3c0-0.1-0.1-0.2-0.1-0.3C19.5,32.5,19.5,32.4,19.5,32.4z M30.4,38.3c0.5,0.5,1.1,0.8,1.9,0.8 c0.4,0,0.8-0.1,1.1-0.2c0.4-0.1,0.7-0.3,1.1-0.5v-1.4h-1.4c-0.3,0-0.6,0-0.7-0.1c-0.2-0.1-0.3-0.3-0.3-0.5c0-0.2,0.1-0.4,0.2-0.5 c0.1-0.1,0.3-0.2,0.6-0.2h2c0.2,0,0.5,0,0.6,0.1c0.2,0,0.3,0.1,0.4,0.3c0.1,0.1,0.2,0.4,0.2,0.7v1.7c0,0.2,0,0.4-0.1,0.5 c0,0.1-0.1,0.2-0.2,0.4s-0.3,0.2-0.4,0.3c-0.5,0.3-1,0.5-1.5,0.6s-1,0.2-1.6,0.2c-0.7,0-1.3-0.1-1.8-0.3c-0.5-0.2-1-0.5-1.4-0.9 c-0.4-0.4-0.7-0.9-0.9-1.4c-0.2-0.6-0.3-1.2-0.3-1.9c0-0.7,0.1-1.3,0.3-1.8c0.2-0.6,0.5-1,0.9-1.4s0.9-0.7,1.4-0.9 c0.6-0.2,1.2-0.3,1.9-0.3c0.6,0,1.1,0.1,1.5,0.2s0.8,0.4,1.1,0.6c0.3,0.2,0.5,0.5,0.6,0.7c0.1,0.3,0.2,0.5,0.2,0.7 c0,0.2-0.1,0.4-0.2,0.6s-0.4,0.2-0.6,0.2c-0.1,0-0.2,0-0.4-0.1c-0.1-0.1-0.2-0.1-0.3-0.2c-0.2-0.3-0.4-0.6-0.5-0.8 c-0.1-0.2-0.4-0.3-0.6-0.4c-0.3-0.1-0.6-0.2-1-0.2c-0.4,0-0.8,0.1-1.1,0.2s-0.6,0.3-0.8,0.6s-0.4,0.6-0.5,1 c-0.1,0.4-0.2,0.8-0.2,1.3C29.7,37,29.9,37.8,30.4,38.3z M39,30H9V6c0-1.7,1.3-3,3-3h16.5v6c0,2.5,2,4.5,4.5,4.5h6V30z"/></svg>';
            var pngIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 48 48"><path d="M28.9,18.4l-3.4,3.4V10.5C25.5,9.7,24.8,9,24,9s-1.5,0.7-1.5,1.5v11.4l-3.4-3.4c-0.6-0.6-1.5-0.6-2.1,0 c-0.6,0.6-0.6,1.5,0,2.1l6,6c0.6,0.6,1.5,0.6,2.1,0c0,0,0,0,0,0l6-6c0.6-0.6,0.6-1.5,0-2.1C30.5,17.9,29.5,17.9,28.9,18.4z"/><path d="M42,30V13.5L28.5,0H12C8.7,0,6,2.7,6,6v24c-1.7,0.1-3,1.4-3,3.1v5.8c0,1.7,1.3,3,3,3.1v0c0,3.3,2.7,6,6,6h24 c3.3,0,6-2.7,6-6v0c1.7-0.1,3-1.4,3-3.1v-5.8C45,31.4,43.7,30.1,42,30z M36,45H12c-1.7,0-3-1.3-3-3h30C39,43.7,37.7,45,36,45z M11.5,39.3v-6.6c0-0.4,0.1-0.7,0.3-0.8s0.5-0.2,0.8-0.2h2.2c0.7,0,1.2,0.1,1.5,0.2c0.4,0.1,0.7,0.3,0.9,0.5s0.4,0.5,0.6,0.8 s0.2,0.7,0.2,1.1c0,0.9-0.3,1.5-0.8,2s-1.3,0.7-2.4,0.7h-1.6v2.4c0,0.3-0.1,0.6-0.2,0.8s-0.4,0.3-0.6,0.3c-0.3,0-0.5-0.1-0.6-0.3 S11.5,39.6,11.5,39.3z M19.5,39.3v-6.6c0-0.3,0-0.5,0.1-0.7c0.1-0.2,0.2-0.3,0.4-0.4s0.4-0.2,0.6-0.2c0.2,0,0.3,0,0.4,0.1 s0.2,0.1,0.3,0.2s0.2,0.2,0.3,0.3s0.2,0.3,0.3,0.4l3.3,5.1v-5.1c0-0.3,0.1-0.6,0.2-0.7s0.3-0.2,0.6-0.2c0.3,0,0.4,0.1,0.6,0.2 s0.2,0.4,0.2,0.7v6.8c0,0.8-0.3,1.1-0.9,1.1c-0.2,0-0.3,0-0.4-0.1s-0.2-0.1-0.4-0.2s-0.2-0.2-0.3-0.3s-0.2-0.3-0.3-0.4l-3.3-5v5 c0,0.3-0.1,0.6-0.2,0.7s-0.3,0.3-0.6,0.3c-0.2,0-0.4-0.1-0.6-0.3S19.5,39.7,19.5,39.3z M30.7,38.2c0.5,0.5,1.1,0.8,1.9,0.8 c0.4,0,0.8-0.1,1.1-0.2s0.7-0.3,1.1-0.5V37h-1.3c-0.3,0-0.6,0-0.7-0.1s-0.2-0.3-0.2-0.5c0-0.2,0.1-0.4,0.2-0.5s0.3-0.2,0.6-0.2h2 c0.2,0,0.4,0,0.6,0.1s0.3,0.1,0.4,0.3s0.2,0.4,0.2,0.7v1.6c0,0.2,0,0.4-0.1,0.5s-0.1,0.2-0.2,0.4s-0.3,0.2-0.4,0.3 c-0.5,0.3-1,0.5-1.5,0.6s-1,0.2-1.6,0.2c-0.7,0-1.3-0.1-1.8-0.3s-1-0.5-1.4-0.9s-0.7-0.9-0.9-1.4s-0.3-1.2-0.3-1.8 c0-0.7,0.1-1.3,0.3-1.8s0.5-1,0.9-1.4s0.9-0.7,1.4-0.9s1.2-0.3,1.9-0.3c0.6,0,1.1,0.1,1.5,0.2s0.8,0.3,1.1,0.6s0.5,0.5,0.6,0.7 s0.2,0.5,0.2,0.7c0,0.2-0.1,0.4-0.2,0.6s-0.4,0.2-0.6,0.2c-0.1,0-0.2,0-0.4-0.1s-0.2-0.1-0.3-0.2c-0.2-0.3-0.4-0.6-0.5-0.8 s-0.3-0.3-0.6-0.4s-0.6-0.2-1-0.2c-0.4,0-0.8,0.1-1.1,0.2s-0.6,0.3-0.8,0.6s-0.4,0.6-0.5,1S30,35.4,30,35.9 C30,36.9,30.3,37.6,30.7,38.2z M39,30H9V6c0-1.7,1.3-3,3-3h16.5v6c0,2.5,2,4.5,4.5,4.5h6V30z"/><path d="M15.5,35.4c0.3-0.1,0.5-0.2,0.6-0.4s0.2-0.5,0.2-0.8c0-0.4-0.1-0.7-0.3-0.9c-0.3-0.3-0.8-0.4-1.5-0.4h-1.2v2.6h1.2 C14.8,35.5,15.2,35.5,15.5,35.4z"/></svg>';
            var pdfIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 48 48"><path d="M28.9,18.4l-3.4,3.4V10.5C25.5,9.7,24.8,9,24,9s-1.5,0.7-1.5,1.5v11.4l-3.4-3.4c-0.6-0.6-1.5-0.6-2.1,0 c-0.6,0.6-0.6,1.5,0,2.1l6,6c0.6,0.6,1.5,0.6,2.1,0l6-6c0.6-0.6,0.6-1.5,0-2.1C30.5,17.9,29.5,17.9,28.9,18.4z"/><path d="M24.6,39c0.2,0,0.3-0.1,0.5-0.1c0.2-0.1,0.3-0.2,0.5-0.3c0.6-0.5,0.9-1.4,0.9-2.6c0-0.9-0.1-1.5-0.4-2 c-0.3-0.4-0.6-0.7-1-0.8C24.8,33,24.3,33,23.8,33h-1.2v6h1.4C24.2,39,24.5,39,24.6,39z"/><path d="M42,30V13.5L28.5,0H12C8.7,0,6,2.7,6,6v24c-1.7,0.1-3,1.4-3,3.1v5.8c0,1.7,1.3,3,3,3.1c0,3.3,2.7,6,6,6h24c3.3,0,6-2.7,6-6 c1.7-0.1,3-1.4,3-3.1v-5.8C45,31.4,43.7,30.1,42,30z M36,45H12c-1.7,0-3-1.3-3-3h30C39,43.7,37.7,45,36,45z M12.5,39.5v-6.8 c0-0.4,0.1-0.7,0.3-0.8c0.2-0.2,0.5-0.3,0.9-0.3H16c0.7,0,1.2,0.1,1.6,0.2c0.4,0.1,0.7,0.3,0.9,0.5c0.3,0.2,0.5,0.5,0.6,0.9 c0.1,0.3,0.2,0.7,0.2,1.1c0,0.9-0.3,1.6-0.8,2C17.9,36.7,17.1,37,16,37h-1.6v2.5c0,0.4-0.1,0.6-0.3,0.8c-0.2,0.2-0.4,0.3-0.6,0.3 c-0.3,0-0.5-0.1-0.7-0.3C12.6,40.1,12.5,39.8,12.5,39.5z M20.8,39.1v-6.5c0-0.4,0.1-0.7,0.3-0.8c0.2-0.2,0.5-0.3,0.8-0.3h2.3 c0.6,0,1.1,0.1,1.6,0.2c0.4,0.1,0.8,0.3,1.2,0.6c0.9,0.8,1.4,2,1.4,3.6c0,0.5,0,1-0.1,1.5c-0.1,0.4-0.2,0.8-0.4,1.2 c-0.2,0.4-0.4,0.7-0.7,0.9c-0.2,0.2-0.5,0.4-0.8,0.5c-0.3,0.1-0.6,0.2-0.9,0.3s-0.7,0.1-1.1,0.1h-2.3c-0.3,0-0.6-0.1-0.7-0.1 c-0.2-0.1-0.3-0.2-0.3-0.4C20.8,39.7,20.8,39.4,20.8,39.1z M34.6,35.2c0.3,0,0.5,0.1,0.6,0.2c0.1,0.1,0.2,0.3,0.2,0.5 c0,0.2-0.1,0.4-0.2,0.5c-0.1,0.1-0.3,0.2-0.6,0.2h-2.9v2.9c0,0.4-0.1,0.6-0.2,0.8s-0.4,0.3-0.6,0.3s-0.5-0.1-0.6-0.3 c-0.2-0.2-0.2-0.5-0.2-0.8v-6.8c0-0.3,0-0.5,0.1-0.6s0.2-0.3,0.4-0.4s0.4-0.1,0.6-0.1h4.2c0.3,0,0.5,0.1,0.6,0.2 C36,31.9,36,32,36,32.2c0,0.2-0.1,0.4-0.2,0.5c-0.1,0.1-0.4,0.2-0.6,0.2h-3.5v2.3H34.6z M39,30H9V6c0-1.7,1.3-3,3-3h16.5v6 c0,2.5,2,4.5,4.5,4.5h6V30z"/><path d="M16.6,35.5c0.3-0.1,0.5-0.2,0.6-0.4c0.2-0.2,0.2-0.5,0.2-0.8c0-0.4-0.1-0.7-0.3-1c-0.3-0.3-0.8-0.4-1.6-0.4h-1.2v2.7h1.2 C16,35.6,16.3,35.6,16.6,35.5z"/></svg>';
            var printIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"><path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/><path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/></svg>';
            var loadIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" class="icon-spin"><path d="M0 11c.511-6.158 5.685-11 12-11s11.489 4.842 12 11h-2.009c-.506-5.046-4.793-9-9.991-9s-9.485 3.954-9.991 9h-2.009zm21.991 2c-.506 5.046-4.793 9-9.991 9s-9.485-3.954-9.991-9h-2.009c.511 6.158 5.685 11 12 11s11.489-4.842 12-11h-2.009z"/></svg>';
            // default options
            var defaults = {
                // saveCode: function(){},
                svglogo : false
            };

            var option = $.extend(defaults, options);

            return this.each(function() {

                var obj = $(this);

                if (obj.data('qrcdr')) {
                    return true;
                }

                $myForm = obj.find('.qrcdr-form');
                submitform = $myForm.find(':submit');
                formInputs = obj.find('.qrcdr-form :input');
                sendOptions = obj.find('#collapseSettings :input');
                formOnInput = obj.find('.qrcdr-form :input[type="text"], .qrcdr-form textarea');
                formOnChange = obj.find('.qrcdr-form :input:not([type="text"]):not(textarea), .qrcolorpicker :input');
                linksholder = obj.find('.linksholder');
                qrcolorpicker = obj.find('.qrcolorpicker');
                colorpickerback = obj.find('.colorpickerback');
                preloader = obj.find('.preloader');
                alert_placeholder = obj.find('.alert_placeholder .toast-body');
                transparent_bg = obj.find('#trans-bg');
                resultholder = obj.find('.resultholder');
                generate_qrcode_btn = obj.find('.generate_qrcode'); // #submitsave
                holdresult = obj.find('.holdresult');
                setvalue = obj.find('.setvalue');
                yesdonation = obj.find('.yesdonation');
                nodonation = obj.find('.nodonation');
                collapse_control = obj.find('.collapse-control');
                collapse_control_reverse = obj.find('.collapse-control-reverse');
                btcInput = obj.find('input[name=btc_account]');
                upmarker = obj.find('#upmarker');
                event = obj.find('#event');
                settings = obj.find('#collapseSettings :input');
                tabs = obj.find('a[data-bs-toggle="tab"]');
                section = $("#getsec").val();
                relative = obj.find('#qrcdr-relative').val();
                slider = obj.find('.qrcdr-slider-input');
                removebg = obj.find('.remove-bg-image');
                exportbg = obj.find('.export-bg-image');
                gradientbg = obj.find('#gradient-bg');
                transbg = obj.find('#trans-bg');
                imagefield = obj.find('#bg_image');
                selectbg = obj.find('.select-image-btn');
                cropinput = obj.find('.cropit-image-input');
                imageeditor = obj.find('.image-editor');
                collapsebg = obj.find('#collapse-image-bg');
                cropzoom = obj.find('.cropit-image-zoom-input');
                croppreview = obj.find('.cropit-preview');
                negative = obj.find('.negative-code');

                isSvg = 'no';

                obj.data('qrcdr', true);

                // methods to be used outside the plugin
                plugin.getSettings = function() {
                    return getsettings();
                };
                plugin.updateCode = function() {
                    return updateCode();
                };

                // Open section from URL
                if (location.hash) {
                    const hash = location.href.split("#");
                    section = '#'+hash[1];
                    obj.find('a[data-bs-toggle="tab"][href="'+section+'"]').tab("show");
                    $("#getsec").val(section).change();
                }

                // Limit textarea length
                $('[maxlength]').maxlength({
                    alwaysShow:  true,
                    validate: true,
                    appendToParent: true
                });

                // init alert
                $('.toast').toast();

                function updateSliderVal(theslider, thisval){
                    theslider.parent('.qrcdr-slider').find('.qrcdr-slider-value').html(thisval + '%');
                }

                slider.each(function() {
                    var thisval = $(this).val();
                    updateSliderVal($(this), thisval);
                });
                slider.on('input', function(){
                    var thisval = $(this).val();
                    updateSliderVal($(this), thisval);
                });

                qrcolorpicker.spectrum({
                    type: "text",
                    // type: "component",
                    showPalette: false,
                    showAlpha: false,
                    showButtons: false,
                    allowEmpty: false,
                    preferredFormat: "hex",
                    change: triggerInput
                    //move: triggerInput
                });

                // Custom Collpase
                collapse_control.on('change', function(){
                    var target = $(this).data('target');
                    if ($(this).prop('checked')) {
                        $(target).collapse('show');
                    } else {
                        $(target).collapse('hide');
                    }
                });
                collapse_control_reverse.on('change', function(){
                    var target = $(this).data('target');
                    if ($(this).prop('checked')) {
                        $(target).collapse('hide');
                    } else {
                        $(target).collapse('show');
                    }
                });

                collapse_control_reverse.each(function(){
                    var target = $(this).data('target');
                    if ($(this).prop('checked')) {
                        $(target).collapse('hide');
                    } else {
                        $(target).collapse('show');
                    }
                });
            
                // Transparent background
                transparent_bg.on('change', function(){
                    if ($(this).prop('checked')) {
                        colorpickerback.spectrum('set', 'transparent');
                        colorpickerback.spectrum('disable');
                    } else {
                        colorpickerback.spectrum('set', '#ffffff');
                        colorpickerback.spectrum('enable');
                    }
                });

                if (transparent_bg.prop('checked')) {
                    colorpickerback.spectrum('set', 'transparent');
                    colorpickerback.spectrum('disable');
                } else {
                    colorpickerback.spectrum('set', '#ffffff');
                    colorpickerback.spectrum('enable');
                }

                /*
                 * Validate form
                 */
                var validateforms = document.getElementsByClassName('needs-validationNO');
                var validation = Array.prototype.filter.call(validateforms, function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                  //      form.classList.add('was-validated');
                    }, false);
                });

                /*
                 * Update QR code preview
                 */
                function updateCode() {
                    $('.toast').toast('hide');
                    clearTimeout(timer);
                
                    generate_qrcode_btn.attr('disabled', true);
                    linksholder.html('');
                    timer = setTimeout(function(){

                        if (!$myForm[0].checkValidity()) {
                            submitform.click();
                        }

                        colorpickerback.spectrum('enable');
                        preloader.fadeIn(100, function(){

                            var sendIputs = obj.find(section + ' :input');

                            var sendata = 'section='+section+'&';
                            sendata += sendIputs.filter(function(index, element) {
                                return $(element).val() != "";
                            }).serialize();

                            sendata += '&';
                            sendata += sendOptions.filter(function(index, element) {
                                return $(element).val() != "";
                            }).serialize();

                            $.ajax({
                                type: "POST",
                                url: relative + "ajax/process.php",
                                cache: false,
                                data: sendata
                            })
                            .fail(function(error) {
                                alert_placeholder.html(error.statusText);
                                $('.toast').toast('show');
                            })
                            .done(function(msg) {
                                if (transparent_bg.prop('checked')) {
                                    colorpickerback.spectrum('disable');
                                }
                                var result = JSON.parse(msg);
                                
                                if (result.hasOwnProperty('errore')) {
                                    if (result.errore.hasOwnProperty('msg')) {
                                        alert_placeholder.html(result.errore.msg);
                                        $('.toast').toast('show');
                                    }
                                    resultholder.html('<img src="' + result.placeholder + '">');
                                    preloader.fadeOut('slow');
                                } else {
                                    holdresult.val(msg);
                                    generate_qrcode_btn.attr('disabled', false);
                                    resultholder.html(result.content);
                                    preloader.fadeOut('slow');
                                }
                            });
                        });
                    }, 1000);
                }

                // Update preview on input
                formOnInput.on('input', triggerInput);

                function triggerInput( event ){
                    var thistarget = event.target;
                    if (!$(thistarget).hasClass('nopreview')) {
                        generate_qrcode_btn.attr('disabled', true);
                        linksholder.html('');

                        clearTimeout(timer);

                        timer = setTimeout(function(){
                            updateCode();
                        }, 1000);
                    }
                }

                // Update preview on change
                formOnChange.on('change', triggerChange);

                function triggerChange( event ){
                    var thistarget = event.target;
                    if (!$(thistarget).hasClass('nopreview')) {
                        updateCode();
                    }
                }

                // Print QRCODE
                function printIt(printThis) {

                    var infopanel = "";
                    /*
                    // Print data
                    var thisdata = $("#create").find(".tab-pane.active :input").filter(function(index, element) {
                        return $(element).val() != "";
                    }).serializeArray();
                    var formData = JSON.stringify(thisdata);
                    var dede = $.parseJSON( formData );
                    $.each(dede, function(i, item) {
                        var dato = item.name + ": " + item.value;
                        infopanel += "<br>" + dato;
                    });
                    */
                    var src = $(printThis).attr('href');
                    var win = window.open('about:blank', "_new");
                    win.document.open();
                    win.document.write('<html><head></head><body onload="window.print()" onafterprint="window.close()"><img src="' + src + '"/>'+infopanel + '</body></html>');
                    win.document.close();
                }

                function getsettings(){
                    var settingInputs = settings.filter(function(index, element) {
                        return $(element).val() != "";
                    }).serializeArray();

                    var datasettings = {};
                    $(settingInputs).each(function(index, obj){
                        datasettings[obj.name] = obj.value;
                    });
                    return datasettings;
                }

                /*
                 * Generate SVG and dowload buttons
                 */
                function saveCode(){
                    var sendata = holdresult.val();

                    var dataObj = JSON.parse(sendata);
                    var usefonts = dataObj.svgfonts ? '' : '&fonts=1';

                    preloader.fadeIn(100, function(){
                        $.ajax({
                            type: "POST",
                            url: relative + "ajax/create.php",
                            cache: false,
                            data: {
                                create: sendata
                            }
                        })
                        .fail(function(error) {
                            alert_placeholder.html(error.statusText);
                            $('.toast').toast('show');
                        })
                        .done(function(msg) {
                            if (msg.length) {
                                var getdata = JSON.parse(msg);
                                if (getdata.error) {
                                    alert_placeholder.html(getdata.error);
                                    $('.toast').toast('show');
                                } else {
                                    var filepath = getdata.filedir+'/'+getdata.basename;

                                    var downloadlinks = '<button class="btn btn-default svgtopng" data-path="'+filepath+'">'+pngIcon+'</button><a href="#" class="btn btn-default d-none preload-png">'+loadIcon+'</a><a class="serve-png d-none" href="'+filepath+'.png" download="'+getdata.basename+'.png" data-path="'+filepath+'">PNG</a>';
                                    downloadlinks = downloadlinks + '<a class="btn btn-default serve-svg" href="'+filepath+'.svg" download="'+getdata.basename+'.svg">'+svgIcon+'</a>';
                                    if (!dataObj.nopdf) {
                                        downloadlinks = downloadlinks + '<a target="_blank" class="btn btn-default" href="'+relative+'pdf/?f='+getdata.basename+usefonts+'">'+pdfIcon+'</a>';
                                    }
                                    downloadlinks = downloadlinks + '<button class="btn btn-default print">'+printIcon+'</button>';
                                    linksholder.html(downloadlinks);
                                    generate_qrcode_btn.attr('disabled', true);
                                    obj.find('.print').on('click', function(){
                                        printIt('.serve-svg');
                                    });
                                }
                            }

                            preloader.fadeOut('slow');
                            // Callback
                            // option.saveCode(getdata);
                        });

                    });
                }

                // Save SVG
                generate_qrcode_btn.on('click', function(){
                    saveCode();
                });

                /*
                 * Generate PNG and dowload it
                 */
                function createPng() {

                    var newImg, canva, ctx, filename, fake, imgSrc, link, servePng;
                    link = obj.find('.svgtopng');
                    servePng = link.parent().find('.serve-png');
                    fake = link.parent().find('.preload-png');
                    link.addClass('d-none');
                    fake.removeClass('d-none');

                    filename = servePng.attr('download');

                    // var d = new Date();
                    // var n = d.getTime();
                    // imgSrc = link.data('path')+'.svg?t='+n;
                    imgSrc = link.data('path')+'.svg';

                    newImg = new Image();

                    preloader.fadeIn(100, function(){

                        newImg.onload = function() {

                            canva = document.createElement("canvas");
                            ctx = canva.getContext("2d");

                            setTimeout(function(){ // Fix for Safari missing images
                                var newImgW = (newImg.width*2);
                                var newImgH = (newImg.height*2);
                                canva.width  = newImgW;
                                canva.height = newImgH;
                                ctx.drawImage(newImg, 0, 0, newImgW, newImgH);
                                var dataURL = canva.toDataURL();
                                $.ajax({
                                    type: "POST",
                                    url: relative + "ajax/png.php",
                                    cache: false,
                                    data: {imgdata: dataURL, filename: filename}
                                })
                                .fail(function(error) {                                    
                                    alert_placeholder.html(error.statusText);
                                    $('.toast').toast('show');
                                })
                                .done(function(msg) {
                                    if (msg == 'error') {
                                        alert_placeholder.html("File not found");
                                        $('.toast').toast('show');
                                    } else {
                                        fake.addClass('d-none');
                                        link.removeClass('d-none');
                                        servePng[0].click();
                                    }
                                    preloader.fadeOut('slow');
                                });

                            }, 100);

                        };
                        newImg.src = imgSrc; // this must be done AFTER setting onload
                    });
                }

                // Save PNG
                $(document).on('click', '.svgtopng', createPng);

                /*
                 * Upload custom marker
                 */
                upmarker.on('change', function(e){
                    $(this).removeClass('is-invalid');
                    if (this.files[0].type.match('image.*')) {
                        var file = this.files[0];
                        var newimg = new Image();
                        newimg.crossOrigin = "Anonymous";
                        var reader = new FileReader();

                        if (file.type.indexOf('svg') > 0) {
                            isSvg = 'svg';
                        }

                        reader.onload = function (e) {
                            $('.logoselecta label').removeClass('active').find('input').removeAttr('checked');
                            var out = '<img src="'+e.target.result+'" class="user_watermark">';
                            // Update custom watermark option
                            $('.custom-watermark .hold-custom-watermark').html(out);
                            newimg.src = $('.logoselecta .btn-group-toggle label' ).last().find('img').attr('src');
                            $('.custom-watermark').addClass('active');
                            $('.custom-watermark input').val(e.target.result).prop("checked", true);
                        };

                        reader.readAsDataURL(file);

                        newimg.onload = function () {
                            var canvas = document.createElement("canvas");

                            // resize thumb
                            var MAX_WIDTH = 400;
                            var MAX_HEIGHT = 400;
                            var width = this.width;
                            var height = this.height;
                        
                            if (!options.svglogo || (options.svglogo && isSvg !== 'svg')) {
                                if (width == 0 || height == 0) {
                                    $('#upmarker').addClass('is-invalid');
                                    $('.logoselecta .btn-group-toggle label' ).last().remove();
                                    return false;
                                }
                                var ctx = canvas.getContext("2d");
                                ctx.drawImage(newimg, 0, 0);

                                if (width > height) {
                                    height *= MAX_WIDTH / width;
                                    width = MAX_WIDTH;
                                } else {
                                    width *= MAX_HEIGHT / height;
                                    height = MAX_HEIGHT;
                                }
                                canvas.width = width;
                                canvas.height = height;

                                var ctx = canvas.getContext("2d");
                                ctx.drawImage(newimg, 0, 0, width, height);
                                var dataurl = canvas.toDataURL();

                                $('.logoselecta .btn-group-toggle label' ).last().find('img').attr('src', dataurl);
                                $('.logoselecta .btn-group-toggle label' ).last().find( "input[name='optionlogo']" ).val(dataurl);
                            }
                        }; // img.onload
                    } else {
                        $(this).addClass('is-invalid');
                    }
                });

                if (!options.svglogo) {
                    $('.logoselecta img').each(function(){

                        var theimage = $(this);
                        var extension = theimage.attr('src').split('.').pop();
                        if (extension == 'svg') {
                            var newimg = new Image();
                            newimg.crossOrigin = "Anonymous";
                            newimg.onload = function () {

                                var MAX_WIDTH = 400;
                                var MAX_HEIGHT = 400;
                                var width = this.width;
                                var height = this.height;

                                if (!width || !height) {
                                    theimage.parent().remove();
                                    return false;
                                }

                                var canvas = document.createElement("canvas");
                                var ctx = canvas.getContext("2d");

                                if (width > height) {
                                    height *= MAX_WIDTH / width;
                                    width = MAX_WIDTH;
                                } else {
                                    width *= MAX_HEIGHT / height;
                                    height = MAX_HEIGHT;
                                }
                                canvas.width = width;
                                canvas.height = height;

                                ctx.drawImage(newimg, 0, 0, width, height);
                                var dataurl = canvas.toDataURL();
                                theimage.parent().find('input').attr('value', dataurl);    
                            };
                            newimg.src = theimage.attr('src');
                        }
                    });
                }
                
                /**
                 * Events Calendar
                 */
                if (event.length) {

                    let currentlocale = event[0].getAttribute('data-locale');
                    if (currentlocale) {
                        tempusDominus.loadLocale(tempusDominus.locales[currentlocale]);
                        tempusDominus.locale(tempusDominus.locales[currentlocale].name);
                    }
                    document.querySelectorAll('.datetimepicker-input').forEach(function(obj){
                        let mydatepicker = new tempusDominus.TempusDominus(obj, {
                            display: {
                                icons: {
                                    time: 'fa fa-clock-o',
                                    date: 'fa fa-calendar',
                                    up: 'fa fa-arrow-up',
                                    down: 'fa fa-arrow-down',
                                    next: 'fa fa-chevron-right',
                                    previous: 'fa fa-chevron-left',
                                    today: 'fa fa-calendar-check',
                                    clear: 'fa fa-trash',
                                    close: 'fa fa-x'
                                }
                            }
                        });
                        obj.addEventListener(tempusDominus.Namespace.events.change, (e) => {
                            const timestampInSeconds = Math.floor(e.detail.date.getTime() / 1000);
                            var getinput = obj.dataset.timestamp;
                            $(getinput).attr('value', timestampInSeconds).change();
                        });
                    });
                }

                /**
                 * GoogleMaps
                 */
                function initializeMap() {

                    if ( $( "#map-canvas" ).length ) {
                        // Google MAP
                        init_lat = $( "#map-canvas" ).data('lat');
                        init_lng = $( "#map-canvas" ).data('lng');
                        var start = new google.maps.LatLng(init_lat, init_lng);
                        var marker;
                        var input = (document.getElementById('pac-input'));
                        var getdata = (document.getElementById('latlong'));
                        var latbox = document.getElementById('latbox');
                        var lngbox = document.getElementById('lngbox');

                        var searchBox;

                        var mapOptions = {
                            zoom: 10,
                            center: start
                        };

                        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                        searchBox = new google.maps.places.SearchBox((input));
                        marker = new google.maps.Marker({
                            map:map,
                            draggable:true,
                            animation: google.maps.Animation.DROP,
                            position: start
                        });

                        google.maps.event.addListener(marker, 'dragend', function(event) {
                            var latlang = marker.getPosition().lat()+","+marker.getPosition().lng();
                            updateposition(latlang);
                        });

                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(getdata);

                        if ((latbox.value.length > 0 ) && (lngbox.value.length > 0)) {
                            setPosition(Number(latbox.value), Number(lngbox.value));
                        }

                        google.maps.event.addListener(searchBox, 'places_changed', function() {
                            var places = searchBox.getPlaces();

                            if (places.length == 0) {
                              return;
                            }

                            for (var i = 0, place; place = places[i]; i++) {
                                marker.setPosition(place.geometry.location);
                                map.setCenter(place.geometry.location);
                                updateposition();
                            }
                        });
                    }

                    var updateposition = function (){
                        latbox.value = marker.getPosition().lat();
                        lngbox.value = marker.getPosition().lng();
                        // Update code preview
                        updateCode();
                    };

                    var setPosition = function (latvar, lngvar){
                        map.setCenter({lat: latvar, lng: lngvar});
                        marker.setPosition({lat: latvar, lng: lngvar});
                        updateposition();
                    };

                    $('#latbox, #lngbox').on('input', function(){
                        if ((latbox.value.length > 0 ) && (lngbox.value.length > 0)) {
                            setPosition(Number(latbox.value), Number(lngbox.value));
                        }
                    });
                }

                /*
                 * OpenMaps
                 */
                function loadGeolocator(geomap_id, geomarker_id) {

                    if ( $( "#wpol-admin-map" ).length ) {
                        init_lat = $( "#wpol-admin-map" ).data('lat');
                        init_lng = $( "#wpol-admin-map" ).data('lng');

                        if (typeof ol === 'undefined' || ol === null) {
                          console.log('WARNING: OpenLayers Library not loaded');
                          return false;
                        }

                        var om_map_pos = ol.proj.fromLonLat([init_lng, init_lat]);
                        var view = new ol.View({
                            center: om_map_pos,
                            zoom: 4
                        });

                        // Init map
                        map = new ol.Map({
                            target: 'wpol-admin-map',
                            view: view,
                            layers: [
                              new ol.layer.Tile({
                                source: new ol.source.OSM()
                              })
                            ],
                            controls: ol.control.defaults({ attributionOptions: { collapsible: true } }),
                            interactions: ol.interaction.defaults({mouseWheelZoom:false})
                        });

                        // Add Marker
                        var marker_el = document.getElementById(geomarker_id);
                        var infomarker = new ol.Overlay({
                            position: om_map_pos,
                            positioning: 'center-center',
                            // offset: [0, -20],
                            element: marker_el,
                            stopEvent: false,
                            dragging: false
                        });
                        map.addOverlay(infomarker);

                        var dragPan;
                        map.getInteractions().forEach(function(interaction){
                            if (interaction instanceof ol.interaction.DragPan) {
                                dragPan = interaction;  
                          }
                        });

                        marker_el.addEventListener('mousedown', function(evt) {
                          dragPan.setActive(false);
                          infomarker.set('dragging', true);
                        });

                        map.on('pointermove', function(evt) {
                            if (infomarker.get('dragging') === true) {
                            infomarker.setPosition(evt.coordinate);
                          }
                        });

                        map.on('pointerup', function(evt) {
                            if (infomarker.get('dragging') === true) {
                                dragPan.setActive(true);
                                infomarker.set('dragging', false);
                                var coordinate = evt.coordinate;
                                var lonlat = ol.proj.toLonLat(coordinate);
                                $('.venomaps-get-lat').val(lonlat[1]);
                                $('.venomaps-get-lon').val(lonlat[0]);
                                // Update code preview
                                updateCode();
                            }
                        });

                        // Update lat lon fields
                        var georesponse = function (response){
                            var lat = response[0].lat;
                            var lon = response[0].lon;
                            var newcoord = ol.proj.fromLonLat([lon, lat]);
                            infomarker.setPosition(newcoord);
                            view.setCenter(newcoord);
                            view.setZoom(6);
                            $('.venomaps-get-lat').val(lat);
                            $('.venomaps-get-lon').val(lon);
                            // Update code preview
                            updateCode();
                        };

                        // Get coordinates from Address.
                        $('.venomaps-get-coordinates').on('click', function(){

                            var button = $(this);
                            var address = $('.venomaps-set-address').val();

                            if ( address.length > 3 ) {
                                button.hide();
                                var encoded = encodeURIComponent(address);
                                $.ajax({
                                    url: 'https://nominatim.openstreetmap.org/search?q='+encoded+'&format=json',
                                    type: 'GET',
                                }).done(function(res) {
                                    georesponse(res);
                                })
                                .always(function() {
                                    button.fadeIn();
                                });
                            }
                        });

                        var updateMap = function (lat, lon){
                            var newcoord = ol.proj.fromLonLat([lon, lat]);
                            infomarker.setPosition(newcoord);
                            view.setCenter(newcoord);
                            //view.setZoom(6);
                        };

                        $('.setinput-latlon').on('input', function(){
                            var lat = $('.venomaps-get-lat').val();
                            var lon = $('.venomaps-get-lon').val();
                            updateMap(lat, lon);
                        });
                    }
                }

                // Load OpenMaps
                loadGeolocator( 'wpol-admin-map', 'infomarker_admin' );

                // Load GoogleMaps
                initializeMap();

                // Change section
                tabs.on('shown.bs.tab', function (e) {

                    section = $(e.target).attr('href');

                    $("#getsec").val(section).change();

                    var newUrl = location.href.split("#")[0] + section;
                    history.replaceState(null, null, newUrl);

                    // Load maps
                    if (section == "#location") {
                        // ReLoad GoogleMaps
                        initializeMap();

                        // Update Openlayers map
                        if ( $('#wpol-admin-map').length ) {
                            map.updateSize();
                        }
                    }
                    
                });

                /**
                 * PayPal
                 */
                 // Set currency
                setvalue.on('change', function(){
                    var value = $(this).val();
                    var getvalue = $(this).data('target');
                    $(getvalue).html(value);
                });

                // PayPal button type
                $("#pp_type").on('change', function(){
                    var value = $(this).val();
                    if (value === '_donations') {
                        nodonation.addClass('d-none');
                        yesdonation.removeClass('col-sm-3');
                    } else {
                        nodonation.removeClass('d-none');
                        yesdonation.addClass('col-sm-3');
                    }
                }); 

                /**
                 * BitCoin
                 */
                btcInput.on('input', function(){
                    var address = btcInput.val();
                    $.ajax({
                      method: "POST",
                      url: relative + "ajax/btc-check.php",
                      data: { btc_account: address }
                    })
                    .done(function( msg ) {
                        if (msg == 'ok') {
                            btcInput.removeClass('is-invalid').addClass('is-valid');
                        } else {
                            btcInput.removeClass('is-valid').removeClass('is-invalid');
                        }
                    });
                });

                /**
                 * Transparent code
                 */
                imageeditor.cropit({
                    // minZoom: 'fit', // 'fill' || 'fit'
                    // originalSize: true,
                    type: 'image/jpeg',
                    quality: 0.9,

                    allowDragNDrop: false,
                    smallImage: 'allow',
                    // width: 250,
                    // height: 250,
                    exportZoom: 3,
                    maxZoom: 1,
                    imageBackground: true,
                    imageBackgroundBorderWidth: 25, // Width of background border
                    onImageLoaded: function() {
                        removebg.removeClass('d-none');
                        exportbg.removeClass('d-none');
                        $('.cropit-preview-image').css('opacity', 1);
                        $('.cropit-preview-background').css('opacity', 0.2);
                        cropzoom.addClass('cropit-image-loaded');
                    }
                });

                // When user clicks select image button,
                // open select file dialog programmatically
                selectbg.on('click', function() {
                    cropinput.click();
                });

                exportbg.on('click', function() {
                    var imageData = imageeditor.cropit('export');
                    imagefield.attr('value', imageData).change();
                    negative.removeClass('d-none');
                });

                removebg.on('click', function() {
                    $('.cropit-preview-image').css('opacity', 0);
                    $('.cropit-preview-background').css('opacity', 0);
                    removebg.addClass('d-none');
                    exportbg.addClass('d-none');
                    negative.addClass('d-none');
                    croppreview.removeClass('cropit-image-loaded');
                    cropzoom.removeClass('cropit-image-loaded');
                    imagefield.attr('value', '').change();
                });

                collapsebg.on('show.bs.collapse', function () {
                    gradientbg.prop( "checked", false ).change();
                    gradientbg.parent('.form-check').hide();
                    transbg.prop( "checked", false ).change();
                    transbg.parent('.form-check').hide();
                });
                collapsebg.on('hidden.bs.collapse', function () {
                    gradientbg.parent('.form-check').fadeIn();
                    transbg.parent('.form-check').fadeIn();
                });

            }); // each
        } // qrcdr
    }); // extend
})(jQuery);

var QRcdr;
