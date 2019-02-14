// JavaScript Document
$(document).ready(function(e) {
    
	count = $('.slideshow ul li').length;
	$('.slideshow ul li:nth-child(1)').css('display','block');
	
	i = 2;
	setInterval(function(){
		
		$('.slideshow ul li').css('display','none');
		$('.slideshow ul li:nth-child('+i+')').css('display','block');
		
		if(i>=count){
			i = 1;	
		}else{
			i++;	
		}
		
	},3000);
	
});