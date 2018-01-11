<?php
namespace app\index\controller;
use think\Controller;
header("Content-type:text/html;charset=utf-8");
class Index extends Controller
{
    public function index()
    {
		$db=db('mz');
		$info=$db->select();
		$this->assign('vo',$info);
		$db1=db('region');
        $parent_id['parent_id'] = 1;
        $region=$db1->where($parent_id)->select();
        $this->assign('region',$region);
        return $this->fetch();
    }
	// public function pros()
    // {
		// $db=db('region');
        // $parent_id['parent_id'] = 1;
        // $region=$db->where($parent_id)->select();
        // $this->assign('region',$region);
        // return $this->fetch('./application/index/view/index.html');
    // }
    public function pro(){
		$parent_id['region_name'] = input('post.pro_id');
        $list = db('region')->where($parent_id)->find();
		$region=db('region')->where("parent_id=".$list['id'])->select();
        $data = "<option value='null'>--请选择市区--</option>";
        foreach($region as $key=>$v){
            $data.= "<option value='{$v['region_name']}'>{$v['region_name']}</option>";
        }
        return json($data);
    }
    public function area(){
        $parent_id['region_name'] = input('post.pro_id');
		$list=db('region')->where($parent_id)->find();
        $region = db('region')->where("parent_id=".$list['id'])->select();
        $data = '<option>--请选择市区--</option>';
        foreach($region as $key=>$v){
            $data.= "<option value='{$v['region_name']}'>{$v['region_name']}</option>";
        }
        return json($data);
    }
	//请假人
	public function dododo(){
		$name=input('post.name');
		if($name==''){
			$result=[
				'msg'=>'请假人不可以为空',
				'status'=>1,
			];
		}else{
			$result=[
				'msg'=>'请假人可用',
				'status'=>2,
			];
		}
		return json($result);
	}
	//家长姓名
	public function fname(){
		$name=input('post.name');
		if($name==''){
			$result=[
				'msg'=>'家长姓名不可以为空',
				'status'=>1,
			];
		}else{
			$result=[
				'msg'=>'家长姓名可用',
				'status'=>2,
			];
		}
		return json($result);
	}
	//家庭住址
	public function adress(){
		$name=input('post.name');
		if($name==''){
			$result=[
				'msg'=>'家庭住址不可以为空',
				'status'=>1,
			];
		}else{
			$result=[
				'msg'=>'家庭住址可用',
				'status'=>2,
			];
		}
		return json($result);
	}
	//户籍所在地
	public function hujiadress(){
		$name=input('post.name');
		if($name==''){
			$result=[
				'msg'=>'户籍所在地不可以为空',
				'status'=>1,
			];
		}else{
			$result=[
				'msg'=>'户籍所在地可用',
				'status'=>2,
			];
		}
		return json($result);
	}

	
	//处理添加
	public function do_add(){
		$data=input('post.');
		$db=db('information');
		$file=request()->file('photo');
		if($file){
			$fileinfo=$file->move(config('upload_path'));
			$data['photo']=$fileinfo->getSavename();
			$info=$db->insert($data);
		}else{
			$data['photo']='';
			$info=$db->insert($data);
		}
		if($info){
			echo "添加成功";
		}else{
			echo "失败";
		}
		
	}
	public function do_adds(){
		$data=input('post.');
		
		if($data['username']==''){
			$info=[
				'msg'=>'姓名不为空',
				'status'=>'2'
			];
			return $info;
		}
		// if($result=db('information')->where('username='.$data['username'])->find()){
			// $info=[
				// 'msg'=>'重复',
				// 'status'=>'2',
			// ];
			// return $info;
		// }
		if($data['date']==''){
			$info=[
				'msg'=>'出生日期不可以为空',
				'status'=>'2',
			];
			return $info;
		}
		if($data['famname']==''){
			$info=[
				'msg'=>'家长姓名不可以为空',
				'status'=>'2',
			];
			return $info;
		}
		if($data['idcate']==''){
			$info=[
				'msg'=>'身份证号码不可以为空',
				'status'=>'2',
			];
			return $info;
		} 
		if($data['adress']==''){
			$info=[
				'msg'=>'家庭住址不可以为空',
				'status'=>'2',
			];
			return $info;
		}
		if($data['stutel']==''){
			$info=[
				'msg'=>'学生手机号不可以为空',
				'status'=>'2',
			];
			return $info;
		}	
		if($data['famtel']==''){
			$info=[
				'msg'=>'家长手机号不可以为空',
				'status'=>'2',
			];
			return $info;
		}	
		if($data['hujiadress']==''){
			$info=[
				'msg'=>'户籍所在地不可以为空',
				'status'=>'2',
			];
			return $info;
		}	
		if($data['weixin']==''){
			$info=[
				'msg'=>'微信号不可以为空',
				'status'=>'2',
			];
			return $info;
		}
		if($data['qq']==''){
			$info=[
				'msg'=>'QQ不可以为空',
				'status'=>'2',
			];
			return $info;
		}	
		if($data['email']==''){
			$info=[
				'msg'=>'邮箱不可以为空',
				'status'=>'2',
			];
			return $info;
		}
		$db=db('information');

		$file=request()->file('photo');
		if($file){
			$fileinfo=$file->move(config('upload_path'));
			$data['photo']=$fileinfo->getSavename();
			$list=$db->insert($data);
		}else{
			$info=[
				'msg'=>'请选择头像',
				'status'=>'2',
			];
			return $info;
		}
		if($list){
			$info=[
				'msg'=>'succ',
				'status'=>'1',
			];
			return $info;
		}else{
			$info=[
				'msg'=>'fail',
				'status'=>'2',
			];
			return $info;
		}
	}
	
	
	

	public function sphone(){
		$sphone=input('post.sphone');
	}
	public function abc(){
		return $this->fetch();
		
	}
	//请假
	public function leave(){
		return $this->fetch();
	}
    public function do_leavee(){
        $data=input('post.');
        $db=db('leave');
        $info=$db->insert($data);
        if($info)
        {
           $result=[
            'msg'=>'请加成功',
            'status'=>1,
           ];
        }else
        {
           $result=[
            'msg'=>'请加失败',
            'status'=>2,
           ];
        }
        return json($result);
    }
	public function hui(){
		return $this->fetch();
	}
	public function do_hui(){
		$data=input('post.');
		echo "<pre>";
		print_r($data);
	}
	public function lists(){
		return $this->fetch();
	}
	// public function do_index(){
		// $data=input('post.');
		// if($data['name']==''){
			// $result=[
				// 'msg'=>'请假人不可以为空',
				// 'status'=>1,
			// ];
			// return json($result);
		// }
		// if($data['content']==''){
			// $result=[
				// 'msg'=>'内容不可以为空',
				// 'status'=>2,
			// ];
			// return json($result);
		// }
		// if($data['sphone']==''){
			// $result=[
				// 'msg'=>'手机号不可以为空',
				// 'status'=>3,
			// ];
			// return json($result);
		// }
		// if($data['fphone']==''){
			// $result=[
				// 'msg'=>'手机号不可以为空',
				// 'status'=>4,
			// ];
			// return json($result);
		// }
		// $db=db('leave');
		// $list=$db->insert($data);
		// if($list){
			// $result=[
				// 'msg'=>'请假成功',
				// 'status'=>5,
			// ];
		// }else{
			// $result=[
				// 'msg'=>'请假失败',
				// 'status'=>6,
			// ];	
		// }
		// return json($result);
	// }
	
}
