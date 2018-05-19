<?php
include_once("header.php");
?>
<style>
    .contnt{text-align: center; padding: 100px;}
</style>

<div class="container" >
    
<div class="clearfix"></div>
    <div class="justify-content-md-center">
        
        <div id="notif" ></div>

        <form class="contnt" id="reset_form">
            <h1>Reset Password</h1>
            <p style="width: 480px; margin-left: 150px;">
                Enter your email address and we'll send you an email with instructions to reset your password.
            </p>
            <div style="padding: 20px 200px 0px 200px;  width: 800px;">
                <input type="email" class="form-control form-control-lg rounded-right" placeholder="johndoe@example.com" aria-label="Username" aria-describedby="basic-addon1" id="email" name="email">
                <br />
                <input type="hidden" name="reset_password_token" value="yes">
                <button id='reset' class="btn btn-primary btn-block" type="submit" style="border-radius: 8px;">Reset Password</button>
                <p style='color: #ADADAD '>
                     Already have account? <a href="login.php" style="text-decoration: none; "><span style="color: #1E99E0">Log In</span></a> 
                </p>
            </div>
        </form>
    </div> 
</div>

<script type="text/javascript">
       $( document ).ready(function() {
    $("#reset").click(function(e){
        e.preventDefault();

       
        var email = $("#email").val();
             
        if(email ==""){
            alert('please enter email');
            $("#notif").addClass(' alert alert-danger');
            $("#notif").html('Please enter email');
        }
       
        
        else{
            
            
            $("#reset").html('Requesting..');

             var data = $("#reset_form").serialize();

            

             $.ajax({
                url : 'process.php',
            type : 'post',
            data : data,
            success: function(data){
            if(data=="1"){
             
             $("#notif").addClass('alert alert-success');
            $("#notif").html("Password reset successful!");

            $("#reset").html('DONE');      
            }
             else if(data =="0"){
                 $("#notif").addClass('alert alert-danger'); 
                 $("#notif").html("Account does not exist!");
                 $("#reset").html('rest');
                 }
             else {
                   $("#notif").html(data);
                 }
                $("#notif").show();
            },
           error : function(jqXHR,textStatus,errorThrown){
                 if(textStatus ='error'){
                    alert('Request not completed');
                 }
                $("#reset").html('Failed');
            },
            beforeSend :function(){

            $("#notif").removeClass('alert alert-danger');
            $("#notif").html('');

            $("#reset").html('Requesting..');
            },
        });
    

        }
        
     });



    });
</script>
<?php
include_once("footer.php");
?>
