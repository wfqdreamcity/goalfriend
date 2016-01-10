<?php
  header("Content-type:text/html; charset=utf-8");
  Class NewsAction extends OrderAction{
Public function _initialize(){
		$urlchanshu=explode('_',I('get.canshu'));
		$make=M('car_make')->field('id,name,left(spell,1) firstchar')->order('spell asc')->select();
		foreach($make as $key=>$val){
		  $firstchar[]=$val['firstchar'];
		}
		$newfirstchar=array_unique($firstchar);

		$this->assign("newfirstchar",$newfirstchar);
		
		$cityregion_name=$this->getcityname($urlchanshu['0']);
		/* if($cityregion_name){
			$this->assign('cityid',$cityid);
			$this->assign('cityregion_name',$cityregion_name);
		}else{
			$this->assign('cityregion_name','北京');
		} */
		$opencity=M("region")->where("region_type=2 and enabled=1")->select();
		$this->assign("opencity",$opencity);
		$cityid=$urlchanshu['0'];;
		
		if($cityid){
			$city['id']=$cityid;
			$city['region_name']=$cityregion_name;
		}else{
			$ip=$this->getIPaddress();
			$city=$this->chenvxuIP($ip);	
			if(!$city){
				$city['id']='52';
				$city['region_name']='北京';
			}		
		}
		$this->assign("cityregion_name",$city);		
	}
	Public function index(){
	      $id=I('get.id');
	      if($id==1)
	      {
	      	  $this->display('huodong');
	      }
	      if($id==2)
	      {
	      	  $this->display('rongzi');
	      }
	       if($id==3)
	      {
	      	  $this->display('youhui');
	      }
		  if($id==4)
	      {
	      	  $this->display('mailuntai');
	      }

	  }
	  public function getcityname($id){
		$name=M("region")->where("id=".$id." and enabled=1")->find();
		return $name['region_name'];
	  }
	
	
  }  
?>