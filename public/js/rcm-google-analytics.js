angular.module('rcmGoogleAnalytics', ['rcmApi'])
    .controller(
    'rcmGoogleAnalyticsAdminController',
    [
        '$log', 'rcmApiService',
        function ($log, rcmApiService) {

            var self = this;

            self.loading = true;
            self.analyticSettings = {};
            self.error = null;

            self.translations = {
                "Loading.." : "Loading..",
                "Google Analytics Tracking Id" : "Google Analytics Tracking Id",
                "Submit" : "Submit",
                "Remove" : "Remove"
            };

            self.isNewAnalyticSettings = true;

            var url = '/api/rcm-google-analytics/current';

            var translationUrl = '/api/rcm-translate-api/default';

            var onLoadingChange = function (loading) {
                self.loading = loading;
            };

            /**
             * onGetTranslationsSuccess
             * @param data
             */
            var onGetTranslationsSuccess = function (data) {
                self.translations = data;

                self.initAnalytics();
            };

            /**
             * onGetTranslationsError
             * @param data
             */
            var onGetTranslationsError = function (data) {
                self.initAnalytics();
            };

            /**
             * onGetAnalyticSettingsSuccess
             * @param data
             */
            var onGetAnalyticSettingsSuccess = function (data) {

                self.isNewAnalyticSettings = false;
                self.analyticSettings = data.data;
            };

            /**
             * onGetAnalyticSettingsError
             * @param data
             */
            var onGetAnalyticSettingsError = function (data) {

                if(data.code == 404){
                    self.isNewAnalyticSettings = true;
                    return;
                }

                self.error = data;
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
             *
             */
            var getTranslations = function() {

                var apiParams = {
                    url: translationUrl,
                    params: self.translations,
                    loading: onLoadingChange,
                    success: onGetTranslationsSuccess,
                    error: onGetTranslationsError
                };

                rcmApiService.get(apiParams);
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

                if(self.isNewAnalyticSettings) {

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
            self.initAnalytics = function()
            {
                self.getAnalyticSettings();
            };

            /**
             * init
             */
            self.init = function () {

                getTranslations();
            };


            ///////////
            self.init();
        }
    ]
);

rcm.addAngularModule('rcmGoogleAnalytics');
