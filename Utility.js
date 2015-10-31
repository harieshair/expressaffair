/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

changetoreadonlymode=function(){
		fun_edit_save_cancel();
                callservicebyajax("",'profileinfo/profilereadmode.php',function(){getpubliccontentresponse('dispprofile')});
	}
fun_edit_save_cancel =function() {
            $("#dispprofile").toggle(); 
            $("#editprofile").toggle();       
}    

