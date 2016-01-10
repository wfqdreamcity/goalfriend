// JavaScript Document

	
	
	
//	
$(document).ready(function() {
	
/*L_order选择城市效果*/


$('#oCity ul li').click(function(){
	var ind=$('#oCity ul li').index($(this));
	var txt = $('#oCity ul li').eq(ind).html();
	$('.right_Three0 p').html(txt);
	$('#oCityBg').css('display','none');
	$('#oCity').css('display','none');
	})



/*L_order选择特色套餐*/

$('.u_taocan_items li a').click(function(){
	var ind=$('.u_taocan_items li a').index($(this));
	$('.u_taocan_items li a').removeClass('boderDown');
	$('.u_taocan_items li a').addClass('boderUp');
	$('.u_taocan_items li a').eq(ind).removeClass('boderUp');
	$('.u_taocan_items li a').eq(ind).addClass('boderDown');
	})




/*L_customization下拉选项效果*/


	
$('.oJiantou').click(function(){
	var ind=$('.oJiantou').index($(this));
	$('.chooseList_Down').eq(ind).toggleClass('ds');




})



$('.b1 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b1 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b1 ul li').css('color','#999999');
	$('.b1 ul li').eq(oind).css('color','#ff0000');
	$('.v1').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})
$('.b2 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b2 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b2 ul li').css('color','#999999');
	$('.b2 ul li').eq(oind).css('color','#ff0000');
	$('.v2').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})
$('.b3 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b3 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b3 ul li').css('color','#999999');
	$('.b3 ul li').eq(oind).css('color','#ff0000');
	$('.v3').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})
$('.b4 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b4 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b4 ul li').css('color','#999999');
	$('.b4 ul li').eq(oind).css('color','#ff0000');
	$('.v4').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})
$('.b5 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b5 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b5 ul li').css('color','#999999');
	$('.b5 ul li').eq(oind).css('color','#ff0000');
	$('.v5').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})

$('.b6 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b6 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b6 ul li').css('color','#999999');
	$('.b6 ul li').eq(oind).css('color','#ff0000');
	$('.v6').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})
$('.b7 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b7 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b7 ul li').css('color','#999999');
	$('.b7 ul li').eq(oind).css('color','#ff0000');
	$('.v7').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})
$('.b8 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b8 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b8 ul li').css('color','#999999');
	$('.b8 ul li').eq(oind).css('color','#ff0000');
	$('.v8').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})

$('.b9 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b9 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b9 ul li').css('color','#999999');
	$('.b9 ul li').eq(oind).css('color','#ff0000');
	$('.v9').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})

$('.b10 ul li').click(function(){
	var ind=$('.chooseList_Down ul li').index($(this));
	var oind=$('.b10 ul li').index($(this));
	var txt = $('.chooseList_Down ul li').eq(ind).html();
	$('.b10 ul li').css('color','#999999');
	$('.b10 ul li').eq(oind).css('color','#ff0000');
	$('.v10').html(txt);
	$('.chooseList_Down').addClass('ds');
	

})

/*L_customization下拉选项效果,多选框*/
$('.chooseList .left').click(function(){
	var result =$(this).attr("data");
	
	//空调养护,上门保养,300万检测点击当前状态不变
	/*
	if(result==9 || result==11){
		return false;
	}
	*/
	if(result==11){
		return false;
	}
	
	//如果选择为空调养护判断是否选择空调滤
	if(result ==6){
		/* var cla =$(".cate4").children(".Gou1").hasClass("ds");
		var cla1 =$(".cate15").children(".Gou1").hasClass("ds");
		if(cla && cla1){
			return false;
		} */
		return false;
	}
	
	//如果选择空调率处理空调养护的选择情况
	if(result ==4 || result ==15){
		var n=0;
		if(result==4){
			var cla =$(".cate4").children(".Gou1").hasClass("ds");
			if(cla){
				n='ok';
				var cla1 =$(".cate15").children(".Gou1").hasClass("ds");
				if(!cla1){
					var obj =$(".cate15");
					obj.children('.Gou1').toggleClass('ds');
					obj.children('.Gou').toggleClass('ds');
				}
			}
		}else{
			var cla =$(".cate15").children(".Gou1").hasClass("ds");
			if(cla){
				n='ok';
				var cla1 =$(".cate4").children(".Gou1").hasClass("ds");
				if(!cla1){
					var obj =$(".cate4");
					obj.children('.Gou1').toggleClass('ds');
					obj.children('.Gou').toggleClass('ds');
				}
			}
		}
		if(n=='ok'){
			var cla1 =$(".cate6").children(".Gou1").hasClass("ds");
			if(cla1){
				var obj =$(".cate6");
				obj.children('.Gou1').toggleClass('ds');
				obj.children('.Gou').toggleClass('ds');
		    }
		}else{
			var cla1 =$(".cate6").children(".Gou1").hasClass("ds");
			if(!cla1){
				var obj =$(".cate6");
				obj.children('.Gou1').toggleClass('ds');
				obj.children('.Gou').toggleClass('ds');
		    }
		}
	}
	
	var ind=$('.chooseList .left').index($(this));
	//$("input[name='a1']").eq(ind).click();
	$('.Gou1').eq(ind).toggleClass('ds');	
	$('.Gou').eq(ind).toggleClass('ds');	
	
	//勾选已有配件仅上门服务取消其他配件勾选状态
	if(result ==10){
		var cur =$(this).children(".Gou1").hasClass("ds");
		if(cur){//取消勾选已有配件仅上门服务
			$(".Gou1").each(function(){
					var obj =$(this).parent();
					var data =obj.attr("data");
					if(data==9){
						obj.children('.Gou1').toggleClass('ds');
						obj.children('.Gou').toggleClass('ds');
					}
			})
		}else{//增加勾选已有配件仅上门服务
			$(".Gou1").each(function(){
				var res =$(this).hasClass("ds");
				if(!res){
					var obj =$(this).parent();
					var data =obj.attr("data");
					if(data!=10 && data!=11){
						obj.children('.Gou1').toggleClass('ds');
						obj.children('.Gou').toggleClass('ds');
					}
				}	
			})
		}
	}else{
		$(".Gou1").each(function(){
					var cla =$(this).hasClass("ds");
					var obj =$(this).parent();
					var data =obj.attr("data");
					if((data==10 && !cla) || (data==9 && cla)){
						obj.children('.Gou1').toggleClass('ds');
						obj.children('.Gou').toggleClass('ds');
					}
		})
	}
	
})

/*L_pay下拉展开*/

$('.Pay_btn').click(function(){
	
	$('#Pay_zhan').toggleClass('ds')
	if($('#Pay_zhan').hasClass('ds')){
		$('.Pay_btn').removeClass('Pay_btnBgup');
		$('.Pay_btn').addClass('Pay_btnBgdown');
		}else{
			$('.Pay_btn').removeClass('Pay_btnBgdown');
		    $('.Pay_btn').addClass('Pay_btnBgup');
			
			}

	
})


/*L_pay支付单选框*/


$('.oInput').click(function(){
	var ind=$('.oInput').index($(this));
	$('.Gou1').addClass('ds');	
	$('.Gou').removeClass('ds');
	$('.Gou1').eq(ind).removeClass('ds');	
	$('.Gou').eq(ind).addClass('ds');
	
	
		})


$('.Right').click(function(){
	
	$('.QuanRight2').toggleClass('ds')
	if($('.QuanRight2').hasClass('ds')){
		$('.Right').removeClass('PayQuan_btnBgup');
		$('.Right').addClass('PayQuan_btnBgdown');
		}else{
			$('.Right').removeClass('PayQuan_btnBgdown');
		    $('.Right').addClass('PayQuan_btnBgup');
			
			}

	
})

$('.QuanRight2').click(function(){
	
	
	
	})


$('.QuanRight2').click(function(){
	var ind=$('.QuanRight2').index($(this));
	var txt = $('.QuanRight2').eq(ind).html();
	
	$('.Left').val(txt);
	$('.QuanRight2').addClass('ds');
	

})


/*L_ChooseYear年份选择*/
$('.ChooseYear_Three0_li a').click(function(){
	
	var ind=$('.ChooseYear_Three0_li a').index($(this));
	$('.ChooseYear_Three0_li a').removeClass('DOWN');
	$('.ChooseYear_Three0_li a').addClass('UP');
	$('.ChooseYear_Three0_li a').eq(ind).addClass('DOWN');
	$('.ChooseYear_Three0_li a').eq(ind).removeClass('UP');
	})










	
	 })
	 