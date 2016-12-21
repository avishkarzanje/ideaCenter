/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function () { 
    $.post("getStandards.php",{all_users: true}, function(data){
        $("#id-table-dashboard").DataTable( {
            "scrollX": true,
            "data": data,
            "columns": [
                {data : 'first_name'},
                {data : 'last_name'},
                {data : 'organization_id'},
                {data : 'email_id'},
                {data : 'phone'},
                {data : 'country_name'},
                {data : 'ts_last_login_success'},
                {data : 'login_success_count'}
            ]
        } );
    },"json"); 
});