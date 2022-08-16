     $(document).ready(function(){
     	$('#btn').click(function(){
        var name=$('#name').val();
         if(name==''){
          $('#tdiv').show();
           $('#msg').html('Enter your name');
         }else{
          $.ajax({
           type:'post',
           url:'test.php',
           data:{n:name},
           success: function(result){
          $('#tdiv').show();
           $('#msg').html(result);
           }
          });
         }
     	});

      $('#btn1').click(function(){
        var name=$('#name1').val();
         if(name==''){
          $('#tdiv1').show();
           $('#msg1').html('Enter your name');
         }else{
          $.ajax({
           type:'post',
           url:'test1.php',
           data:{n1:name},
           success: function(result){
          $('#tdiv1').show();
           $('#msg1').html(result);
           }
          });
         }
      });
     });