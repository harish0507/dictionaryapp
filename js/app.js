//Angular js app
var app = angular.module('dictionaryApp', ['angularUtils.directives.dirPagination']);

function wordsController($scope, $http) {
    $scope.currentPage = 1;
    $scope.pageSize = 10;
    $scope.displaySelectedWord = true;
    //htttp get request for api hits
    $http.get("script/dictionary.php?type=json&query=api_hits").success(function(response) {
        $scope.apiHitsCount = response.api_hits;
    });
    //htttp get request for bookmarks from backend
    $http.get(window.location.href + "script/get_bookmarks.php").success(function(response) {
        $scope.bookmarkCount = response.length;
        $scope.bookmarks = response;
    });
    //http get request for words
    $http.get("script/dictionary.php?type=json&query=A").success(function(response) {
        $scope.alphabets = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
        $scope.words = response;
        $scope.getWords = function(alphabet) {
            $http.get("script/dictionary.php?type=json&query=" + alphabet).success(function(response) {
                $scope.currentPage = 1;
                $scope.displaySelectedWord = true;
                $scope.words = response;
            });
        };
    });
    //displays selected word
    $scope.showSelectedWord = function(word) {
        //creating audio tag for the selected word		
        $scope.audioCheck = true;
        var text = word.word.trim().replace(/[^\w\s]/gi, ' ').split(" ");
        var formatted_text = [];
        for(var str in text) {
            formatted_text.push(text[str].toLowerCase());
        }
        
        var url = "http://vaas.acapela-group.com/Services/UrlMaker.json?cl_login=EVAL_VAAS&cl_app=EVAL_8101870&cl_pwd=kktgikd5&req_voice=sharon22k&req_text=" + formatted_text.join("+");
        $http.get(url).success(function(data) {
            if (data.res === "OK") {
                jQuery("#audio").attr("src", data.snd_url);
                $scope.audioCheck = false;
            }
        });
        
        $scope.selectedWord = word.word;
        $scope.selectedWordDescription = word.description;
        $scope.displaySelectedWord = false;
    };
    //saves the selected bookmark to the backend via http post request
    $scope.saveBookmark = function() {
        var request = $http({
            method: "post",
            url: window.location.href + "script/add_bookmark.php",
            data: {
                word: $scope.selectedWord,
                description: $scope.selectedWordDescription
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.success(function(data) {
            location.reload();
        });
    };
    //deletes all the bookmarks from backend via http post request
    $scope.emptyBookmarks = function() {
        var request = $http({
            method: "post",
            url: window.location.href + "script/delete_bookmarks.php",
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        request.success(function(data) {
            location.reload();
        });
    };
}

//app controller
app.controller('wordsController', ["$scope", "$http", wordsController]);