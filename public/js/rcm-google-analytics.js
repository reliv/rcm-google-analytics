/**
 * rcm-google-analytics-config
 *
 * @type {{}}
 */
var rcmGoogleAnalyticsConfig = {
    onAccessDenied : function (response) {
        // Default do nothing
        // console.error(response)
    },
    onNotFound : function (response) {
        // Default do nothing
        // console.error(response)
    },
    onSaveSuccess : function (response) {
        // Default do nothing
        // console.log(response)
    },
};

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
                self.showSaveSuccessMessage = false;

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
                        rcmGoogleAnalyticsConfig.onNotFound(response);
                    }

                    if (response.code != 401) {
                        self.hasAccess = true;
                    }

                    if (response.code == 401) {
                        self.hasAccess = false;
                        rcmGoogleAnalyticsConfig.onAccessDenied(response);
                    }
                };

                /**
                 * onSaveAnalyticSettingsSuccess
                 * @param response
                 */
                var onSaveAnalyticSettingsSuccess = function (response) {
                    self.isNewAnalyticSettings = false;
                    self.analyticSettings = response.data;
                    self.showSaveSuccessMessage = true;
                    rcmGoogleAnalyticsConfig.onSaveSuccess(response);
                };

                /**
                 * onSaveAnalyticSettingsError
                 * @param response
                 */
                var onSaveAnalyticSettingsError = function (response) {
                    self.error = response.messages;
                };

                /**
                 * getAnalyticSettings
                 */
                self.getAnalyticSettings = function () {
                    self.error = null;
                    self.showSaveSuccessMessage = false;
                    self.loading = true;

                    var apiParams = {
                        method: 'GET',
                        url: url,
                    };

                    $http(
                        apiParams
                    ).then(
                        function successCallback(response) {
                            self.loading = false;
                            onGetAnalyticSettingsSuccess(response.data);
                        },
                        function errorCallback(response) {
                            self.loading = false;
                            onGetAnalyticSettingsError(response.data);
                        }
                    );
                };

                /**
                 * saveAnalyticSettings
                 */
                self.saveAnalyticSettings = function () {
                    self.error = null;
                    self.showSaveSuccessMessage = false;
                    self.loading = true;

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
                            self.loading = false;
                            onSaveAnalyticSettingsSuccess(response.data);
                        },
                        function errorCallback(response) {
                            self.loading = false;
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
