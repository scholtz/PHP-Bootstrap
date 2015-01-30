<?php
namespace BT;




class Settings{
	public static $prettyPrint = true;
}
class Base{
	protected $id = "";
	protected $element = "div";
	protected $classes = array();
	protected $attributes = array();
	protected $innerobjects = null;
	protected $onelineelement = false;
	protected $preservewhitespace = false;

	public function __construct(){
		$args = func_get_args();		
		$this->innerobjects = new Classes();
		while(($arg = array_shift($args)) !== null){
			if(is_a($arg,"\BT\Classes")){
				$this->innerobjects = $arg;
			}
			if(is_a($arg,"\BT\Attribute")){
				if($arg->getName() == "class"){
					$this->addClass($arg->getValue());
				}else{
					$this->addAttribute($arg);
				}
			}
			if(is_string($arg)){
				$this->append($arg);
			}
			if(is_a($arg,"\BT\Base")){
				$this->append($arg);
			}
		}
		
	}
	
	public function setId($id){$this->id=$id;}
	public function getId(){return $this->id;}
	
	public function setElement($Element){$this->element=$Element;}
	public function getElement(){return $this->element;}

	public function addClass($class){$this->classes[] = $class;}
	public function getClass(){return $this->classes;}
	public function removeClass($class){$this->classes = array_diff($this->classes,array($class));}
	public function setClasses($classes){$this->classes = $classes;}

	public function addAttribute($attribute){$this->attributes[] = $attribute;}
	public function getAttributes(){return $this->attributes;}
	public function removeAttribute($attributes){$this->attributes = array_diff($this->attributes,array($attributes));}
	public function setAttributes($attributes){$this->attributes = $attributes;}

	public function a($obj){return $this->append($obj);}
	public function append($obj){$this->innerobjects->append($obj);}
	public function prepend($obj){$this->innerobjects->prepend($obj);}
	public function removeObject($obj){$this->innerobjects->removeObject($obj);}

	public function getObjects(){return $this->innerobjects;}
	public function setObjects($obj){$this->innerobjects = $obj;}

	/**
	 Renders the object
	*/
	public function s($level = 1){return $this->show($level);}
	public function show($level = 1){
		$classes = "";
		foreach($this->classes as $class){
		if($classes) $classes .= ' ';
			$classes .= $class;
		}
		$ret = "";
		if(Settings::$prettyPrint){$ret.="\n".str_repeat("\t",$level);}
		$ret.= '<'.$this->element.'';
		if($classes) $ret.= ' class="'.$classes.'"';
		foreach($this->attributes as $k => $attribute){
			if(is_a($attribute,"\BT\Attribute")){
				$ret.= ' '.$attribute->show();
			}else{
				$ret.= ' '.$k.'="'.htmlspecialchars($attribute).'"';
			}
		}
		//$ret.=var_export($this->onelineelement,true);
		if($this->onelineelement){
			$ret.= '/>';
		}else{
			$ret.= '>';
			$ret.= $this->innerobjects->show($level);
			//	$ret.=var_export($this->preservewhitespace,true);
			if(!$this->preservewhitespace)
				if(Settings::$prettyPrint){$ret.="\n".str_repeat("\t",$level);}
			$ret.='</'.$this->element.'>';
		}
		return $ret;
	}
}
class Classes{
	protected $innerobjects = array();

	public function a($obj){return $this->append($obj);}
	public function append($obj){$this->innerobjects[] = $obj;}
	public function prepend($obj){array_unshift($this->innerobjects,$obj);}
	public function getObjects(){return $this->innerobjects;}
	public function setObjects($obj){$this->innerobjects = $obj;}
	public function removeObject($obj){$this->innerobjects = array_diff($this->innerobjects,array($obj));}
	
	public function s($level = 1){return $this->show($level);}
	public function show($level = 1){
		$ret ="";
		foreach($this->innerobjects as $obj){
			if(is_a($obj,"\BT\Base")){
				$ret.=$obj->show($level+1);
			}else{
				if(Settings::$prettyPrint){$ret.="\n".str_repeat("\t",$level);}
				$ret.=$obj;
			}
		}
		return $ret;
	}
}
class Attribute{
	private $name = "";
	private $value = "";
	
	public function __construct($par1=null,$par2=null){
		if($par2 !== null){
			$this->name = $par1;
			$this->value = $par2;
		}elseif($par1 !== null){
			$this->value = $par1;
		}
	}
	public function getName(){return $this->name;}
	public function getValue(){return $this->value;}
	public function s(){return $this->show();}
	public function show(){
		return $this->name.'="'.htmlspecialchars($this->value).'"';
	}
}
class Container extends Base{
	protected $classes = array("container");
}
class ContainerFluid extends Base{
	protected $classes = array("container-fluid");
}
class Row extends Base{
	protected $classes = array("row");
}
class ColMd12 extends Base{
	protected $classes = array("col-md-12");
}
class ColMd11 extends Base{
	protected $classes = array("col-md-11");
}
class ColMd10 extends Base{
	protected $classes = array("col-md-10");
}
class ColMd9 extends Base{
	protected $classes = array("col-md-9");
}
class ColMd8 extends Base{
	protected $classes = array("col-md-8");
}
class ColMd7 extends Base{
	protected $classes = array("col-md-7");
}
class ColMd6 extends Base{
	protected $classes = array("col-md-6");
}
class ColMd5 extends Base{
	protected $classes = array("col-md-5");
}
class ColMd4 extends Base{
	protected $classes = array("col-md-4");
}
class ColMd3 extends Base{
	protected $classes = array("col-md-3");
}
class ColMd2 extends Base{
	protected $classes = array("col-md-2");
}
class ColMd1 extends Base{
	protected $classes = array("col-md-1");
}
class Section extends Base{
	protected $element = "section";
}
class MediaList extends Base{
	protected $element = "ul";
	protected $classes = array("media-list");
}
class MediaListItem extends Base{
	protected $element = "li";
	protected $classes = array("media");
}
class MediaBody extends Base{
	protected $classes = array("media-body");
}
class MediaHeading extends Base{
	protected $element = "h4";
	protected $classes = array("media-heading");
}
class PanelDefault extends Base{
	protected $classes = array("panel","panel-default");
}
class Panel extends PanelDefault{}
class PanelPrimary extends Base{
	protected $classes = array("panel","panel-primary");
}
class PanelSuccess extends Base{
	protected $classes = array("panel","panel-success");
}
class PanelInfo extends Base{
	protected $classes = array("panel","panel-info");
}
class PanelWarning extends Base{
	protected $classes = array("panel","panel-warning");
}
class PanelDanger extends Base{
	protected $classes = array("panel","panel-danger");
}
class PanelHeading extends Base{
	protected $classes = array("panel-heading");
}
class PanelBody extends Base{
	protected $classes = array("panel-body");
}
class PanelFooter extends Base{
	protected $classes = array("panel-footer");
}
class Form extends Base{
	protected $element = "form";
}
class Input extends Base{
	protected $element = "input";
	protected $classes = array("form-control");
	protected $onelineelement = true;
}
class TextArea extends Base{
	protected $element = "textarea";
	protected $classes = array("form-control");
	protected $preservewhitespace = true;
}
class Button extends Base{
	protected $element = "input";
	protected $classes = array("form-control");
	protected $attributes = array("type"=>"submit");
	protected $onelineelement = true;
}

?>