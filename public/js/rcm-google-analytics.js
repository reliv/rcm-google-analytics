/**
 * rcm-google-analytics
 */
angular.module('rcmGoogleAnalytics', ['rcmApi', 'pascalprecht.translate'])
    .controller(
    'rcmGoogleAnalyticsAdminController',
    [
        '$log', 'rcmApiService', 'translateFilter',
        function ($log, rcmApiService, translateFilter) {

            var self = this;

            self.loading = true;
            self.analyticSettings = {};
            self.error = null;
            self.hasAccess = false;

            /* translations:
                "Loading.."
                "Google Analytics Tracking Id"
                "Submit"
                "Remove"
            */

            self.isNewAnalyticSettings = true;

            var url = '/api/rcm-google-analytics/current';

            var onLoadingChange = function (loading) {
                self.loading = loading;
            };


            /**
             * onGetAnalyticSettingsSuccess
             * @param data
             */
            var onGetAnalyticSettingsSuccess = function (data) {

                self.isNewAnalyticSettings = false;
                self.hasAccess = true;
                self.analyticSettings = data.data;
            };

            /**
             * onGetAnalyticSettingsError
             * @param data
             */
            var onGetAnalyticSettingsError = function (data) {

                if (data.code == 404) {
                    self.isNewAnalyticSettings = true;
                }

                if (data.code != 401) {
                    self.hasAccess = true;
                }

                if (data.code == 401) {
                    self.hasAccess = false;
                    self.error = data;
                }
            };

            /**
             * onSaveAnalyticSettingsSuccess
             * @param data
             */
            var onSaveAnalyticSettingsSuccess = function (data) {

                self.isNewAnalyticSettings = false;
                self.analyticSettings = data.data;
            };

            /**
             * onSaveAnalyticSettingsError
             * @param data
             */
            var onSaveAnalyticSettingsError = function (data) {

                self.error = data;
            };

            /**
             * onDeleteAnalyticSettingsSuccess
             * @param data
             */
            var onDeleteAnalyticSettingsSuccess = function (data) {

                self.isNewAnalyticSettings = true;
                self.analyticSettings = {};
            };

            /**
             * getAnalyticSettings
             */
            self.getAnalyticSettings = function () {

                self.error = null;

                var apiParams = {
                    url: url,
                    data: self.analyticSettings,
                    prepareErrors: true,
                    loading: onLoadingChange,
                    success: onGetAnalyticSettingsSuccess,
                    error: onGetAnalyticSettingsError
                };

                rcmApiService.get(apiParams);
            };

            /**
             * saveAnalyticSettings
             */
            self.saveAnalyticSettings = function () {

                self.error = null;

                var apiParams = {
                    url: url,
                    data: self.analyticSettings,
                    prepareErrors: true,
                    loading: onLoadingChange,
                    success: onSaveAnalyticSettingsSuccess,
                    error: onSaveAnalyticSettingsError
                };

                if (self.isNewAnalyticSettings) {

                    rcmApiService.post(apiParams);
                } else {

                    rcmApiService.patch(apiParams);
                }
            };

            /**
             * deleteAnalyticSettings
             */
            self.deleteAnalyticSettings = function () {

                self.error = null;

                var apiParams = {
                    url: url,
                    data: self.analyticSettings,
                    prepareErrors: true,
                    loading: onLoadingChange,
                    success: onDeleteAnalyticSettingsSuccess,
                    error: onSaveAnalyticSettingsError
                };

                rcmApiService.del(apiParams);

            };
            /**
             * initAnalytics
             */
            self.initAnalytics = function () {
                self.getAnalyticSettings();
            };

            /**
             * init
             */
            self.init = function () {

                self.initAnalytics();
            };


            ///////////
            self.init();
        }
    ]
);

if (typeof rcm !== 'undefined') {
    rcm.addAngularModule('rcmGoogleAnalytics');
}
