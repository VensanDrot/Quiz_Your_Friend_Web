myApp.service('QuizService',['$q', '$http', function($q, $http){        

         this.saveUserQuiz = function(postData) {
            var url='/save-user-quiz';
            console.log(postData);
            //set timezone of user
            var request = $q.defer();
            //{'monthDayDateTime': monthDayDateTime, 'studentId': studentId, 'lectureTimeTableId': lectureTimeTableId}
            $http({
                method: "POST",
                url: url,
                data: postData,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response) {
                request.resolve(response);
            }).error(function(error) {
                request.reject(error);
            });

            return request.promise;
        }

        this.updateQuizStats = function(postData) {
            var url='/api/v1/quiz/'+postData.quizId;
            let postParam='action='+postData.action;
            console.log(postParam);
            //set timezone of user
            var request = $q.defer();
            //{'monthDayDateTime': monthDayDateTime, 'studentId': studentId, 'lectureTimeTableId': lectureTimeTableId}
            $http({
                method: "POST",
                url: url,
                data: postParam,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response) {
                request.resolve(response);
            }).error(function(error) {
                request.reject(error);
            });

            return request.promise;
        }
}]);
myApp.filter('secondsToDateTime', [function() {
    /**
     * This code returns a date string formatted manually.
     * Code "new Date(1970, 0, 1).setSeconds(seconds)" returns malformed output on days.
     * Eg. 4 days, magically becomes 5, 15 becomes 16 and so on...;
     * */
    return function(seconds) {
    var days = Math.floor(seconds/86400);
    var hours = Math.floor((seconds % 86400) / 3600);
    var mins = Math.floor(((seconds % 86400) % 3600) / 60);
    var secs = ((seconds % 86400) % 3600) % 60;
    return ('00'+mins).slice(-2)+':' + ('00'+secs).slice(-2);
    };
}]);
myApp.service('UserThemeService',['$q', '$http', function($q, $http){        

         this.setUserTheme = function(themeId) {
            var url='/user-theme/'+themeId;
            //set timezone of user
            var request = $q.defer();
            //{'monthDayDateTime': monthDayDateTime, 'studentId': studentId, 'lectureTimeTableId': lectureTimeTableId}
            $http({
                method: "GET",
                url: url,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response) {
                request.resolve(response);
            }).error(function(error) {
                request.reject(error);
            });

            return request.promise;
        }
}]);


myApp.service('OtherUserStatsService',['$q', '$http', function($q, $http){        

         this.getUserStats = function(encUserQuizId) {
            var url='';
            if(arrJsConfig.URL_PREFIX!=''){
              url +='/'+arrJsConfig.URL_PREFIX;
            }
            url +='/other-user-stats/'+encUserQuizId;
            
            //set timezone of user
            var request = $q.defer();
            //{'monthDayDateTime': monthDayDateTime, 'studentId': studentId, 'lectureTimeTableId': lectureTimeTableId}
            $http({
                method: "GET",
                url: url,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response) {
                request.resolve(response);
            }).error(function(error) {
                request.reject(error);
            });

            return request.promise;
        }
}]);

myApp.service('getUserPopupStats',['$q', '$http', function($q, $http){        

    this.getData = function(id) {
      var domainUrl='/';
        if(arrJsConfig.URL_PREFIX!=''){
              domainUrl='/'+arrJsConfig.URL_PREFIX+'/';
        }console.log(domainUrl,arrJsConfig);
       var url=domainUrl+'get-quiz-by-user-quiz-id';
       var request = $q.defer();
       $http({
           method: "POST",
           url: url,
           params: {id:id},
           headers: {'Content-Type': 'application/x-www-form-urlencoded'}
       }).success(function (response) {
           request.resolve(response);
       }).error(function(error) {
           request.reject(error);
       });

       return request.promise;
   }
}]);

myApp.service('userService',function($http){

    this.request    =   function(elem,data){
                            return $http({
                                    method  :   "POST",
                                    url     :   angular.element(elem).attr('url'),
                                    headers :   { 'Content-Type': 'application/x-www-form-urlencoded' },
                                    data    :    $.param(data),
                        });
    }    
});