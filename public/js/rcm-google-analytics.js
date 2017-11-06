/**
 * rcm-google-analytics
 */
angular.module('rcmGoogleAnalytics', ['pascalprecht.translate'])
    .controller(
        'rcmGoogleAnalyticsAdminController',
        [
            '$http', 'translateFilter',
            function ($http, translateFilter) {

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
                 * @param response
                 */
                var onGetAnalyticSettingsSuccess = function (response) {
                    self.isNewAnalyticSettings = false;
                    self.hasAccess = true;
                    self.analyticSettings = response.data;
                };

                /**
                 * onGetAnalyticSettingsError
                 * @param response
                 */
                var onGetAnalyticSettingsError = function (response) {
                    if (response.code == 404) {
                        self.isNewAnalyticSettings = true;
                    }

                    if (response.code != 401) {
                        self.hasAccess = true;
                    }

                    if (response.code == 401) {
                        self.hasAccess = false;
                        self.error = data;
                    }
                };

                /**
                 * onSaveAnalyticSettingsSuccess
                 * @param response
                 */
                var onSaveAnalyticSettingsSuccess = function (response) {
                    self.isNewAnalyticSettings = false;
                    self.analyticSettings = response.data;
                };

                /**
                 * onSaveAnalyticSettingsError
                 * @param response
                 */
                var onSaveAnalyticSettingsError = function (response) {
                    self.error = response.messages;
                };

                /**
                 * onDeleteAnalyticSettingsSuccess
                 * @param response
                 */
                var onDeleteAnalyticSettingsSuccess = function (response) {
                    self.isNewAnalyticSettings = true;
                    self.analyticSettings = {};
                };

                /**
                 * getAnalyticSettings
                 */
                self.getAnalyticSettings = function () {
                    self.error = null;

                    var apiParams = {
                        method: 'GET',
                        url: url,
                    };

                    $http(
                        apiParams
                    ).then(
                        function successCallback(response) {
                            onLoadingChange(false);
                            onGetAnalyticSettingsSuccess(response.data);
                        },
                        function errorCallback(response) {
                            onLoadingChange(false);
                            onGetAnalyticSettingsError(response.data);
                        }
                    );
                };

                /**
                 * saveAnalyticSettings
                 */
                self.saveAnalyticSettings = function () {

                    self.error = null;

                    var apiParams = {
                        url: url,
                        data: self.analyticSettings,
                    };

                    if (self.isNewAnalyticSettings) {
                        apiParams.method = 'POST';
                    } else {
                        apiParams.method = 'PATCH';
                    }

                    $http(
                        apiParams
                    ).then(
                        function successCallback(response) {
                            onLoadingChange(false);
                            onSaveAnalyticSettingsSuccess(response.data);
                        },
                        function errorCallback(response) {
                            onLoadingChange(false);
                            onSaveAnalyticSettingsError(response.data);
                        }
                    );
                };

                /**
                 * deleteAnalyticSettings
                 */
                self.deleteAnalyticSettings = function () {

                    self.error = null;

                    var apiParams = {
                        method: 'DELETE',
                        url: url,
                        data: self.analyticSettings,
                        loading: onLoadingChange,
                        success: onDeleteAnalyticSettingsSuccess,
                        error: onSaveAnalyticSettingsError
                    };

                    $http(
                        apiParams
                    ).then(
                        function successCallback(response) {
                            onLoadingChange(false);
                            onDeleteAnalyticSettingsSuccess(response.data);
                        },
                        function errorCallback(response) {
                            onLoadingChange(false);
                            onSaveAnalyticSettingsError(response.data);
                        }
                    );
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
