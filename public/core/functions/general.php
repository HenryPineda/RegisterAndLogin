<?php

function sanitize($mysql, $data)
{
    return mysqli_real_escape_string($mysql, $data);
}