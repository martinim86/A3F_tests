<?php
namespace Index;
$urls = 'http://localhost/test2/index.html';
$preg_much_string = '(\<(/?[^>]+)>)';

//basic interface
interface Basic
{
    function file_get_contents();
}

//trait count tags
trait StructureContent
{
    public function structure($clear_content) {
            echo("<h1>Реализация подсчета количества тегов</h1>");
            echo('</br>');
            foreach ($clear_content as  $key => $value) {
                if($value != ''){
                    echo("Тег ".$key." повторяется ".$value." раз");
                    echo('</br>');
                }
                
            }
        }
}
//trait to preg match
trait PregMuch
{
    public function preg_much($preg_much_string, $out) {
        preg_match_all($preg_much_string, $out, $tags);
        return $tags;
        }
}

//class realization
class GetContent implements Basic 
{
    public $link;
    public $out;
    public function __construct($link){
        $this->link = $link;
    }
    function file_get_contents()
    {
        $out = file_get_contents($this->link);
        $this->out = $out;
        return  $out;
    }
}

//Inheritance class realization
class ClearContent extends GetContent {
    use PregMuch;
    use StructureContent;
    public function clear_content($content){
        $result = array_count_values($content[1]);
        return $result;
    }
}

//abstract class define methods
abstract class AbstractRealization{
    protected $urls;
    protected $preg_much_string;
    protected $obj;
    abstract function get_cont();
    abstract function file_get_content();
    abstract function preg_much();
    abstract function clear();
    abstract function structure();
}
//realization by objects
class Realization extends AbstractRealization
{

     public function __construct($urls,$preg_much_string){
        $this->urls = $urls;
        $this->preg_much_string = $preg_much_string;
        $this->get_cont();
        $this->structure();
    }
    public function get_cont(){ 
        $obj = new ClearContent($this->urls);
        $this->obj = $obj;
        return $this->obj;
    }
    public function file_get_content(){ 
        $get_cont = $this->obj;
        $get_cont = $get_cont->file_get_contents();
        return $get_cont;
    }
    public function preg_much(){
        $much = $this->obj->preg_much($this->preg_much_string,$this->file_get_content());
        return $much;
    }
    public function clear(){
        $clear = $this->obj->clear_content($this->preg_much());
        return $clear;
    }
    public function structure(){
        $this->obj->structure($this->clear());
    }

}



?>