function login(){
    var username = $('#username').val();
    var password = $('#password').val();
    if(username!="" && password!=""){
        $.ajax({ url: 'admin/login/'+username+'/'+password,
            method: 'post', 
            success:function(data){
                if(data=="NOK"){
                    userError();
                }
                else{
                    window.location.reload(true);
                }
            }
        });
    }
    else{
        if(password==undefined || password==""){
            emptyPasswordError();
        }
        if(username==undefined || username==""){
            emptyUsernameError();
        }
    }
    
}

function emptyUsernameError(){
    if($('#username').val()==""){
        $('#username').addClass("errorInput").focus();
    }
    else{
        $('#username').removeClass("errorInput");
    }
}

function emptyPasswordError(){
    if($('#password').val()==""){
        $('#password').addClass("errorInput").focus();
    }
    else{
        $('#password').removeClass("errorInput");
    }
}
function userError(){
    $('#errorUser').show();
}