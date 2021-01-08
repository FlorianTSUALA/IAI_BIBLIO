<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <title></title>
  <meta name="Generator" content="Cocoa HTML Writer">
  <meta name="CocoaVersion" content="1138.47">
 
<SCRIPT type="text/javascript" src="../web/js/jquery.js"></SCRIPT>
 
</head>
<body>

 <a href="#" id="addButtonAction">
		<img src="../web/icones/add.png" alt="ca marche pas" />
	</a>

<table id="monTab" border="">
<tr>
 
<td>test</td>
 
<td>test</td>
 
<td> </td>
</tr>
</table>
 
 
<script type="text/javascript">
$(document).ready(function() 
{
 
	var indice = 0 ;
 
    $("a#addButtonAction").click(function() 
                    {
						$("table#monTab").append('<tr id="indice">'
													+'<td>dddd</td>'
													+'<td>ddd</td>'
													+' <td> <a href="#" name="removeButton" ><img src="../web/icones/delete.png" alt="" /></a><td> '
												+'</tr>');
                    }
                );
 
	$("table#monTab").delegate('[name="removeButton"]', 'click', function() 
	                {
				var $this = $(this);
     
       $this.closest('tr').remove();  
	                }
	            );
 
});     
</script>
 
</body>
</html>