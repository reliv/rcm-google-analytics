angular.module('rcmGoogleAnalytics', ['rcmApi'])
    .controller(
    'rcmGoogleAnalyticsAdminController',
    [
        'rcmApiService',
        function (rcmApiService) {


            var self = this;

            self.loading = true;
            self.analyticSettings = {};
            self.error = {};

            var url = '/api/rcm-google-analytics/current';

            var onLoadingChange = function(loading){
                self.loading = loading;
            };

            var onGetAnalyticSettingsSuccess = function(data){
                self.analyticSettings = data.data;
            };

            var onGetAnalyticSettingsError = function(data){
                self.error = data;
            };

            self.init = function() {

                self.getAnalyticSettings();
            };

            self.getAnalyticSettings = function(){

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






            self.init();
        }
    ]
);
