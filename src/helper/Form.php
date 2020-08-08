<?php


namespace  Psiko\helper;


class form
{


    public function __construct()
    {
    }

    public function inputInt(string $name, string $label, ?int $value=0, ?bool $required=true)
    {
        $require = ($required) ? 'required' : '';
        $class = $this->getInputClass($name);
        return '
            <div class="form-group">
            <label for="'.$name.'" class="'.$class .'-label">'.$label.'</label> <br>
            <input id="'.$name.'" class="'.$class .'" name="'.$name.'" value="'.$value.'" type="number" '.$require.' >
            </div>';
    }

    public function inputDate(string $name, string $label, string $min, string $max, ?bool $required=true)
    {
        $require = ($required) ? 'required' : '';
        $class = $this->getInputClass($name);
        return '
            <div class="form-group">
            <label for="'.$name.'" class="'.$class .'-label">'.$label.'</label> <br>
            <input id="'.$name.'" class="'.$class .'" name="'.$name.'" value="'.date("Y-m-d").'" min="'.$min.'" max="'.$max.'" type="date" '.$require.' >
            </div>';
    }

    public function inputSelect(string $name, string $label, array $option, ?String $select, ?bool $required=true)
    {
        $require = ($required) ? 'required' : '';
        $class = $this->getInputClass($name);
        $return = '
            <div class="form-group">
            <label for="'.$name.'" class="'.$class .'-label">'.$label.'</label> <br>
            <select id="'.$name.'" class="'.$class .'" name="'.$name.'" '.$require.' >';
            foreach ($option as $key => $value) {
                if ($select === $key)
                {
                    $return = $return . '<option value="'.$key.'" selected="selected">'.$value.'</option>';
                }
                else
                {
                    $return = $return . '<option value="'.$key.'">'.$value.'</option>';
                }
            }

            return $return.'</select></div>';
    }


    public function textarea(string $name, string $label, ?string $value="", ?bool $required=true)
    {
        $require = ($required) ? 'required' : '';
        $class = $this->getInputClass($name);
        return '
            <div class="form-group">
            <label for="'.$name.'" class="'.$class .'-label">'.$label.'</label> <br>
            <textarea id="'.$name.'" class="'.$class .'" name="'.$name.'" type="number" '.$require.' >'.$value.'</textarea>
            </div>';
    }

   private function getInputClass(string $key): string
    {
        $inputClass = "form-control";
        return $inputClass;
    }


    public function input(string $name, ?string $label, ?string $inputType,?bool $hasBr =true , ?String $placeholder="", ?bool $required=true): string
    {
        $value = "";
        $type = 'text';
        $br = '<br>';
        $placeholder = ($placeholder == "") ? "" :  "Exemple : ".$placeholder;
        $class = $this->getInputClass($name);
        if (isset($inputType)) $type = 'type = "' . $inputType . '"';
        $require = ($required) ? 'required' : '';
        if (!$hasBr)
        {
            $br = '';
            $class = 'checkbox';
        }
        return '
            <div class="form-group">
            <label for="'.$name.'" class="'.$class .'-label">'.$label.'</label> '.$br.'
            <input id="'.$name.'" class="'.$class .'" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"'.$type.' '.$require.' >
            </div>';
    }

    public function inputFile(string $name, string $label, ?string $accept="")
    {
        $value = "";
        $accept = ($accept == "") ? $accept : "accept='".$accept."'";
        $class = $this->getInputClass($name);
        return '
            <div class="form-group">
            <label for="'.$name.'" class="'.$class .'-label">'.$label.'</label> 
            <input id="'.$name.'" class="'.$class .'" name="'.$name.'" value="'.$value.'" '.$accept.' type="file" >
            </div>';
    }


}