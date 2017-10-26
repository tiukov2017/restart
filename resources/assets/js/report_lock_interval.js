

$(document).ready(function(){

    window.setInterval(lockReport,60*1000);

});
function lockReport(){

    $.ajax({

        url: '{{ report/lock }}',

        method:'post',

        data :{id:REPORT_ID,_token:TOKEN}

    }).success(function(){


    }).error(function(){

    });
}