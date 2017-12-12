<?php 

class MyTags extends Phalcon\Tag
{
    public static function button($parameters)
    {
        // Converting parameters to array if it is not
        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }

        // Determining attributes "id" and "name"
        if (!isset($parameters[0])) {
            $parameters[0] = $parameters["id"];
        }

        $id = $parameters[0];

        if (!isset($parameters["name"])) {
            $parameters["name"] = $id;
        } else {
            if (!$parameters["name"]) {
                $parameters["name"] = $id;
            }
        }

        // \Phalcon\Tag::setDefault() allows to set the widget value
        if (isset($parameters["value"])) {
            $value = $parameters["value"];

            unset($parameters["value"]);
        } else {
            $value = self::getValue($id);
        }

        // Generate the tag code
        $code = '<button id="' . $id . '" ';

        foreach ($parameters as $key => $attributeValue) {
            if (!is_integer($key)) {
                $code.= $key . '="' . $attributeValue . '" ';
            }
        }

        $code.= ">" . $value . "</button >";

        return $code;
    }

    public static function listitemlink($parameters)
    {
        // Converting parameters to array if it is not
        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }

        // Determining attributes "id" and "name"
        if (!isset($parameters[0])) {
            $parameters[0] = $parameters["id"];
        }

        $id = $parameters[0];

        if (!isset($parameters["name"])) {
            $parameters["name"] = $id;
        } else {
            if (!$parameters["name"]) {
                $parameters["name"] = $id;
            }
        }

        // \Phalcon\Tag::setDefault() allows to set the widget value
        if (isset($parameters["value"])) {
            $value = $parameters["value"];

            unset($parameters["value"]);
        } else {
            $value = self::getValue($id);
        }

        // Generate the tag code
        $code = '<li id="' . $id . '" ';

        foreach ($parameters as $key => $attributeValue) {
            if (!is_integer($key)) {
                $code.= $key . '="' . $attributeValue . '" ';
            }
        }

        $code.= ">" . $value . "</li >";

        return $code;
    }
}