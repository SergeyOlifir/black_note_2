<?php
namespace Orm;

class Observer_ImageSaver extends Observer{
    
	public function before_save(Model $obj){
                    return $this->save_image($obj);
	}

	public function save_image($obj){ 
                    $config = \Config::get('upload.img');
                    $logo_path = $config['upload']['path'].'/events/event_'.$obj->event_id;
                        foreach( \Upload::get_files() as $file ) {
                            if($file['field'] == 'image') {
                                $obj->origin = $file['saved_as'];
                                $logo_name = $file['saved_as'];
                                    foreach($config['sizes'] as $name => $size) {
                                        if($name != 'thumb_foursquare'){
                                            $new_logo_name = str_replace(".{$file['extension']}", "{$name}." . \Str::lower($file['extension']) , $file['saved_as']);
                                            \Image::load($logo_path . DS . $logo_name)->resize($size['width'], $size['height'], true, false)->save($logo_path . DS . $new_logo_name);
                                            $obj->set($name, $new_logo_name);
                                        } else{
                                                $new_logo_name = str_replace(".{$file['extension']}", "{$name}." . \Str::lower($file['extension']) , $file['saved_as']);
                                                \Image::load($logo_path . DS . $logo_name)->crop_resize($size['width'], $size['height'])->save($logo_path . DS . $new_logo_name);
                                                $obj->set($name, $new_logo_name);
                                            }
                                    }
                                return true;
                            }
                        }
                        return false;
	}
}
