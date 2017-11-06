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
                self.success = null;
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

                var clearMessages = function () {
                    self.error = null;
                    self.success = null;
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
                        self.error = response.message;
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
                    self.success = response.message;
                    rcmGoogleAnalyticsConfig.onSaveSuccess(response);
                };

                /**
                 * onSaveAnalyticSettingsError
                 * @param response
                 */
                var onSaveAnalyticSettingsError = function (response) {
                    self.error = response.message;
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
                    clearMessages();

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
                    clearMessages();

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
                    clearMessages();

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
