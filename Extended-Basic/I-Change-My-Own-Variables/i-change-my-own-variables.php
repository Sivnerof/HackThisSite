<?php
        $password = 'IWantToCow';
        foreach ($_GET as $key => $value)
        {
          $$key = $value;
        }
        if ($userpass == $password)
        {
                ok();
        }
        else
        {
                echo "&lt;form&gt;&lt;input type='text' name='usertext' /&gt;&lt;input type='submit'&gt;&lt;form&gt;";
        }
?>