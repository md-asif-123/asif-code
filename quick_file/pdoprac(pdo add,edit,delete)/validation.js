

function doDelete()
{ 
   c=confirm("are you sure want to delete");
   return c;
	
}

function selectAll()
{
	len=document.regForm.elements.length;
	for(i=0;i<len;i++){
		elt=document.regForm.elements[i];
		
		if(elt.type=='checkbox' && elt.name=='list'){
			elt.checked=true;
		}
		
	}
		
}


checked=false;
function checkedAll (regForm) {
    var aa= document.getElementById('regForm');
	
     if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
		  
    for (var i =0; i < aa.elements.length; i++) 
    {
		
     aa.elements[i].checked = checked;
    }
      }
	  
	  function checkboxes(){
    var inputElems = document.getElementsByTagName("input"),
    count = 0;
    for (var i=0; i<inputElems.length; i++) {
    if (inputElems[i].type === "checkbox" && inputElems[i].checked === true && inputElems[i].name == 'list[]'){
        count++;
        
    }
	
}
    if(count==0)
	{
		alert("no item selected");
		return false;
	}
	else
	{
   c=confirm("are you sure want to delete " +count+" details");
return c;
	}
}
