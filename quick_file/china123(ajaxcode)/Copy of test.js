$(document).ready(function(){
     	$('#r').click(function(){
			$('#tdiv1').show();
			$('#tdiv2').hide();
			 $('#m1').hide();
			 $('#btn22').show();
			 $('#btn11').hide();
			 $('#btn33').hide();
			});
			
			$('#b3').click(function(){
				var mobile=$('#mobile1').val();
			if(mobile==''){
				$('#m1').show();
			$('#msg1').html('Please submit your mobile number or register');
			}
			else
			{
				  $('#tdiv2').hide();
				$('#m1').show();
			$('#msg1').html('Please submit your mobile number or register');
			}
			});
			
			$('#r3').click(function(){
				
			 
			var mobile=$('#mobile1').val();
			if(mobile==''){
				$('#tdiv1').hide();
				$('#btn22').hide();
				$('#btn11').hide();
				$('#btn33').show();
			 $('#m1').show();
			 $('#tdiv2').hide();
          $('#msg1').html('Enter your mobile number');
		}
		   else{
			   
          $.ajax({
			  
           type:'post',
           url:'mb.php',
           data:{m1:mobile},
           success: function(result){
			   //$('#btn22').hide();
				//$('#btn11').show();
				//$('#btn33').hide();
			   $('#m1').hide();
          $('#tdiv2').show();
		  $('#tdiv1').hide();
          $('#msg4').html(result);
           }
          });
         }
			});
			
			
			$('#b1').click(function(){
			
			var name=$('#fname').val();
			var email=$('#email').val();
			var mobile=$('#mobile').val();
			var product1=$('#pd1').val();
			var product2=$('#pd2').val();
			var product3=$('#pd3').val();
			var quantity=$('#quant').val();
			var date=$('#datepicker').val();
         if(name==''){
			 $('#m1').show();
          $('#msg1').html('Enter your name');
         }
		 else
			 if(email==''){
			 $('#m1').show();
          $('#msg1').html('Enter your email');
		}
		else
			 if(mobile==''){
			 $('#m1').show();
          $('#msg1').html('Enter your mobile');
		}
		else
			 if(product1==''){
			 $('#m1').show();
          $('#msg1').html('Enter atleast two products');
		}
		else
			 if(quantity==''){
			 $('#m1').show();
          $('#msg1').html('Enter quantity');
		}
		 else{
          $.ajax({
           type:'post',
           url:'db1.php',
           data:{n:name,e:email,m:mobile,p1:product1,p2:product2,p3:product3,q:quantity,d:date},
           success: function(result){
          $('#m1').show();
          $('#msg1').html('inserted into database');
           }
          });
         }
			});
			
			
			$('#b2').click(function(){
			
			var name=$('#fname1').val();
			var email=$('#email1').val();
			var mobile=$('#mobile2').val();
			var product1=$('#pd1').val();
			var product2=$('#pd2').val();
			var product3=$('#pd3').val();
			var quantity=$('#quant').val();
			var date=$('#datepicker').val();
         if(name==''){
			 $('#m1').show();
          $('#msg1').html('Enter your name');
         }
		 else
			 if(email==''){
			 $('#m1').show();
          $('#msg1').html('Enter your email');
		}
		else
			 if(mobile==''){
			 $('#m1').show();
          $('#msg1').html('Enter your mobile');
		}
		else
			 if(product1==''){
			 $('#m1').show();
          $('#msg1').html('Enter atleast two products');
		}
		else
			 if(quantity==''){
			 $('#m1').show();
          $('#msg1').html('Enter quantity');
		}
		 else{
          $.ajax({
           type:'post',
           url:'db1.php',
           data:{n:name,e:email,m:mobile,p1:product1,p2:product2,p3:product3,q:quantity,d:date},
           success: function(result){
          $('#m1').show();
          $('#msg1').html('inserted into database');
           }
          });
         }
			});
			
			 });